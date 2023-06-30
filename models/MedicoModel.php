<?php

class MedicoModel{

    protected $db;
    protected $registros;

    public function __construct(){
        $this->db = Conexion::conectar();
        $this->registros = array();
    }

    public function getAtencion(){
        $sql = "SELECT persona_paciente.numero_documento as dni, persona_paciente.nombre as nombre_paciente, 
                        persona_medico.nombre as nombre_medico, cita.detalle as detalle , cita.estado as estado , atencion_cita.entrada as entrada,
                        atencion_cita.salida as salida , cita.fecha_cita as fechaCita ,atencion_cita.id_atencion as id
                FROM atencion_cita  INNER JOIN cita on atencion_cita.id_cita = cita.id_cita
                    INNER JOIN paciente ON cita.id_paciente = paciente.id_paciente
                    INNER JOIN persona AS persona_paciente ON persona_paciente.id_persona = paciente.id_persona
                    INNER JOIN usuario ON usuario.id_usuario = cita.id_medico 
                    INNER JOIN persona AS persona_medico ON persona_medico.id_persona = usuario.id_persona
                    WHERE atencion_cita.salida IS  NULL and atencion_cita.entrada IS NOT NULL ";
                    
        $consulta = $this->db->query($sql);
        
        $this->row = $consulta->fetch_assoc();

        return $this->row; 
    }

    public function getHistorias(){
        $sql = " SELECT atencion_cita.fecha as fecha , cita.detalle as motivo
        FROM historia
        INNER JOIN paciente ON paciente.id_paciente = historia.id_paciente
        INNER JOIN cita ON cita.id_paciente = paciente.id_paciente
        INNER JOIN atencion_cita ON atencion_cita.id_cita = cita.id_cita
        WHERE atencion_cita.entrada IS NOT NULL AND atencion_cita.salida IS NULL";
                    
        $consulta = $this->db->query($sql); 

        while($row = $consulta->fetch_assoc()){
            $this->registros[] = $row;
        }
        return $this->registros;
    }


    public function delete($id){
        $sql = "DELETE FROM personas where id_persona = '$id'";
        $this->db->query($sql);
    }
    
}