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

    public function gethorario($idMedico){
        $sql = " SELECT * FROM horario WHERE id_usuario = $idMedico";
                    
        $consulta = $this->db->query($sql); 

        while($row = $consulta->fetch_assoc()){
            $this->registros[] = $row;
        }
        return $this->registros;
    }

    public function getResultID($token){
        $sql = "SELECT * FROM horario WHERE token = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }


    public function updatehorario($id, $data)
    {
        $sql = "UPDATE horario SET   
                                    fecha = '" . $data["fecha"] . "',
                                    hora_inicio = '" . $data["ho_inicio"] . "', 
                                    hora_fin = '" . $data["ho_fin"] . "',
                                    cupos= '" . $data["cupos"] . "'
                                    WHERE token ='" . $id . "'";

        $this->db->query($sql);
    }
    public function deleteHorario($id){
        $sql = "DELETE FROM horario where id_horario = '$id'";
        $this->db->query($sql);
    }
    
    public function saveHorario($data,$userID)
    {
        $sql = " INSERT INTO horario(id_usuario,
                            fecha,
                            hora_inicio,
                            hora_fin,
                            cupos,
                            token)
                        VALUES('" . $userID . "',
                               '". $data["fecha"] ."',
                               '". $data["ho_inicio"] ."',
                               '". $data["ho_fin"] ."',
                               '". $data["cupos"] . "',
                               '". $data["token"] . "')";


        $this->db->query($sql); 
    }

    public function getAtencionesMedico(){
        $sql = " SELECT persona.nombre as nombre , persona.apellido_p as apellidoP , 
                        persona.apellido_m as apellidoM , cita.detalle as detalle,
                        cita.intervenciones as intervenciones, atencion_cita.entrada as hora
                from atencion_cita inner join  cita on atencion_cita.id_cita = cita.id_cita 
                    inner join paciente on cita.id_paciente = paciente.id_paciente
                    inner join persona on paciente.id_persona = persona.id_persona
                    WHERE atencion_cita.salida IS NOT NULL";
                    
        $consulta = $this->db->query($sql); 

        while($row = $consulta->fetch_assoc()){
            $this->registros[] = $row;
        } 
        return $this->registros;

    }

}