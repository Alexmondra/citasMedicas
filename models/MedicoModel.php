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
                        cita.detalle as detalle ,persona_paciente.fecha_nacimiento as Fdate ,atencion_cita.id_atencion as id
                FROM atencion_cita  INNER JOIN cita on atencion_cita.id_cita = cita.id_cita
                INNER JOIN paciente ON cita.id_paciente = paciente.id_paciente
                INNER JOIN persona AS persona_paciente ON persona_paciente.id_persona = paciente.id_persona
                INNER JOIN usuario ON usuario.id_usuario = cita.id_medico 
                INNER JOIN persona AS persona_medico ON persona_medico.id_persona = usuario.id_persona
                WHERE atencion_cita.salida IS  NULL and atencion_cita.entrada IS NOT NULL";
                    
        $consulta = $this->db->query($sql);
        
        $this->row = $consulta->fetch_assoc();

        return $this->row; 
    }

    public function getHistorias(){
        $sql = " SELECT historia.motivo as motivo , historia.fecha as fecha ,historia.resultado as resultado
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

    public function gethorario(){
        $sql = " SELECT * FROM horario";
                    
        $consulta = $this->db->query($sql); 

        while($row = $consulta->fetch_assoc()){
            $this->registros[] = $row;
        }
        return $this->registros;


    }

    public function getResultID($id){
        $sql = "SELECT * FROM horario
                WHERE id_horario = $id";
        $consulta = $this->db->query($sql); 
        $row =  $consulta->fetch_assoc();
        return $row;
    }


    public function updatehorario($id, $data)
    {
        $sql = "UPDATE horario SET   
                                    fecha = '" . $data["fecha"] . "',
                                    hora_inicio = '" . $data["ho_inicio"] . "', 
                                    hora_fin = '" . $data["ho_fin"] . "',
                                    cupos= '" . $data["cupos"] . "'
                                    WHERE id_horario = $id ";

        $this->db->query($sql);
    }
    public function deleteHorario($id){
        $sql = "DELETE FROM horario where id_horario = '$id'";
        $this->db->query($sql);
    }
    
    public function saveHorario($data)
    {
        $sql = " INSERT INTO horario(id_usuario,
                            fecha,
                            hora_inicio,
                            hora_fin,
                            cupos)
                        VALUES('1',
                               '". $data["fecha"] ."',
                               '". $data["ho_inicio"] ."',
                               '". $data["ho_fin"] ."',
                               '". $data["cupos"] . "')";


        $this->db->query($sql);
    }

}