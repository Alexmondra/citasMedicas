<?php

class MedicoModel{

    protected $db;
    protected $registros;

    public function __construct(){
        $this->db = Conexion::conectar();
        $this->registros = array();
    }

    public function getAtencion(){
        $sql = "SELECT * FROM persona where id_persona = 1";
                    
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