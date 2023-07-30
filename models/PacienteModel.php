<?php

class PacienteModel {
    protected $db;
    protected $registros;

    public function __construct() {
        $this->db = Conexion::Conectar();
        $this->registros = array();
    }

    public function getAllEspecialidad() {
        $sql = "SELECT * FROM especialidad where estado = 1 ";
        $consulta = $this->db->query($sql);
        $registros = array();
        while ($row = $consulta->fetch_assoc()) {
            $registros[] = $row;
        }
        return $registros;
    }

    public function getMedicosPorEspecialidad($id) {
        $sql = "SELECT persona.nombre as nombre , usuario.id_usuario as id_medico  from especialidad 
                    INNER JOIN usuario_especialidad on usuario_especialidad.id_especialidad = especialidad.id_especialidad
                    INNER JOIN usuario on usuario_especialidad.id_usuario = usuario.id_usuario 
                    INNER JOIN persona on usuario.id_persona = persona.id_persona
                where especialidad.id_especialidad = $id";
        $consulta = $this->db->query($sql);    
    
        if ($consulta === false) {
            throw new Exception($this->db->error);
        }
    
        $registros = array();
        while ($row = $consulta->fetch_assoc()) {
            $registros[] = $row;
        }
        return $registros;
    }

    public function getCuposDisponibles($id_medico, $fecha) {
        $sql = "SELECT cupos FROM horario WHERE id_usuario = ? AND fecha = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $id_medico, $fecha);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['cupos'];
        } else {
            return 0;
        }
    }

    public function obtenerPrecioActualEspecialidad($id_especialidad)
    {
        $sql = "SELECT precio FROM precios WHERE id_especialidad = $id_especialidad
         ORDER BY fecha DESC LIMIT 1";

        $consulta = $this->db->query($sql);
        $row =  $consulta->fetch_assoc();
        return $row;
    }



    public function getPersonaDni($dni){
        $sql = "SELECT *
		        FROM persona WHERE numero_documento = $dni";
        $consulta = $this->db->query($sql);
        $row =  $consulta->fetch_assoc();
        return $row;
    }

    public function saveNuevo($data) {
        // Insertar en la tabla persona
        $sql = "INSERT INTO persona (tipo_documento, numero_documento, apellido_p, apellido_m, nombre, fecha_nacimiento, sexo, direccion, estado_civil, telefono, img)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            "sssssssssss",
            $data["tipo_documento"],
            $data["numero_documento"],
            $data["apellido_p"],
            $data["apellido_m"],
            $data["nombre"],
            $data["fecha_nacimiento"],
            $data["sexo"],
            $data["direccion"],
            $data["estado_civil"],
            $data["telefono"],
            $data["img"]
        );
        $stmt->execute();
    
        // Obtener el último ID insertado en la tabla persona
        $lastInsertIdPersona = $stmt->insert_id;
    
        // Insertar en la tabla paciente
        $sql = "INSERT INTO paciente (id_persona, ocupacion, alergias, descripcion_alergias, creado, actualizado, eliminado)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $createdDate = date("Y-m-d H:i:s");
        $stmt->bind_param(
            "issssss",
            $lastInsertIdPersona,
            $data["ocupacion"],
            $data["alergias"],
            $data["descripcion_alergias"],
            $createdDate,
            $createdDate,
            $createdDate
        );
        $stmt->execute();
    
        // Obtener el último ID insertado en la tabla paciente
        $lastInsertIdPaciente = $stmt->insert_id;
    
        // Insertar en la tabla cita
        $sql = "INSERT INTO cita (id_paciente, id_medico, detalle, estado, persona_responsable, intervenciones, vacunas_completas, fecha_cita, especialidad, precio, numero_persona_responsable, estado_pago)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)"; // Establecemos estado_pago en 0
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param(
            "iisssssssds", // Utilizamos "d" para el campo de tipo float
            $lastInsertIdPaciente,
            $data["id_medico"],
            $data["detalle"],
            $data["estado"],
            $data["persona_responsable"],
            $data["intervenciones"],
            $data["vacunas_completas"],
            $data["fecha_cita"],
            $data["especialidad"],
            $data["precio"],
            $data["numero_persona_responsable"]
        );
        $stmt->execute();
    
        // Obtener el último ID insertado en la tabla cita
        $lastInsertIdCita = $stmt->insert_id;
    
        // Retornar el último ID de la cita insertada
        return $lastInsertIdCita;
    }
    

}