<?php

class AdmisionistaModel{

    protected $db;
    protected $registros;

    public function __construct(){
        $this->db = Conexion::conectar();
        $this->registros = array();
    }


    public function getAllResults(){
        
        $sql = "SELECT persona_paciente.numero_documento as dni, persona_paciente.nombre as nombre_paciente, 
                        persona_medico.nombre as nombre_medico, cita.detalle as detalle , cita.estado as estado , atencion_cita.entrada as entrada,
                        atencion_cita.salida as salida , cita.fecha_cita as fechaCita ,atencion_cita.id_atencion as id
                FROM atencion_cita  INNER JOIN cita on atencion_cita.id_cita = cita.id_cita
                                    INNER JOIN paciente ON cita.id_paciente = paciente.id_paciente
                                    INNER JOIN persona AS persona_paciente ON persona_paciente.id_persona = paciente.id_persona
                                    INNER JOIN usuario ON usuario.id_usuario = cita.id_medico 
                                    INNER JOIN persona AS persona_medico ON persona_medico.id_persona = usuario.id_persona
                                    WHERE atencion_cita.salida IS NULL";
        $consulta = $this->db->query($sql);

        while($row = $consulta->fetch_assoc()){
            $this->registros[] = $row;
        }
        return $this->registros;
    }

    public function getAllDoctores(){
        $sql = "SELECT * FROM persona WHERE tipo_persona = 2";
        $consulta = $this->db->query($sql);
        $registros = array();
        while ($row = $consulta->fetch_assoc()) {
            $registros[] = $row;
        }
        return $registros;
    }

    public function getAllEspecialidad(){
        $sql = "SELECT * FROM especialidad";
        $consulta = $this->db->query($sql);
        $registros = array();
        while ($row = $consulta->fetch_assoc()) {
            $registros[] = $row;
        }
        return $registros;
    }

    public function getAllCitasPagos(){
        $sql = "SELECT persona.nombre as nombre , persona.sexo as sexo , 
                        persona.numero_documento as dni, cita.fecha_cita as fecha , pagos.precio as precio 
                    from  pagos INNER JOIN cita ON cita.id_cita = pagos.id_cita
                                INNER JOIN paciente on paciente.id_paciente = cita.id_paciente
                                INNER JOIN persona on paciente.id_persona = persona.id_persona";
        $consulta = $this->db->query($sql);
        while($row = $consulta->fetch_assoc()){
            $this->registros[] = $row;
        }
        return $this->registros;
    }
    public function getAllCitas(){
        $sql = "SELECT persona.nombre AS nombre, persona.numero_documento AS dni, paciente.id_paciente AS id
                        FROM cita INNER JOIN paciente ON paciente.id_paciente = cita.id_paciente
                                  INNER JOIN persona ON persona.id_persona = paciente.id_persona";
        $consulta = $this->db->query($sql);
        while($row = $consulta->fetch_assoc()){
            $this->registros[] = $row;
        }
        return $this->registros;
    }

    public function getAllCitasAtender(){
        $sql = "SELECT persona.nombre as nombre, cita.detalle as detalle, cita.fecha_cita as fecha, historia.resultado as historia
        FROM cita
        INNER JOIN paciente ON cita.id_paciente = paciente.id_paciente 
        INNER JOIN persona ON persona.id_persona = paciente.id_persona
        INNER JOIN historia ON historia.id_paciente = paciente.id_paciente
        INNER JOIN atencion_cita ON atencion_cita.id_cita = cita.id_cita
        where atencion_cita.salida IS NOT NULL";

        $consulta = $this->db->query($sql);
        $registros = array();
        while ($row = $consulta->fetch_assoc()) {
            $registros[] = $row;
        }
        return $registros;
    }
    public function getAllCitasAtendido(){
        $sql = "SELECT persona.nombre as nombres, cita.detalle as detalles, atencion_cita.entrada as entrada , atencion_cita.salida as salida
        FROM atencion_cita
        INNER JOIN cita ON atencion_cita.id_cita = cita.id_cita
        INNER JOIN paciente ON paciente.id_paciente = cita.id_paciente
        INNER JOIN persona ON persona.id_persona = paciente.id_persona 
        WHERE atencion_cita.salida IS NULL";


         $consulta = $this->db->query($sql);
        $registros = array();
        while ($row = $consulta->fetch_assoc()) {
            $registros[] = $row;
        }
        return $registros;
    }



    public function save($data){
        $sql = "INSERT INTO cita(nombres,
                                     apPaterno,
                                     apMaterno,
                                     correo,
                                     usuario,
                                     contrasenia,
                                     idPerfil)
                        VALUES('".$data["nombres"]."',
                               '".$data["apPaterno"]."',
                               '".$data["apMaterno"]."',
                               '".$data["correo"]."',
                               '".$data["usuario"]."',
                               '".$data["contrasenia"]."',
                               '".$data["perfil"]."')";
        $this->db->query($sql);
    }

    public function setInicio($id){
        $sql = "UPDATE atencion_cita SET entrada = CURRENT_TIME() where id_atencion = '$id'";
        $this->db->query($sql);

    }
    public function setFin($id){
        $sql = "UPDATE atencion_cita SET salida = CURRENT_TIME() where id_atencion = '$id'";
        $this->db->query($sql);

    }
    
}