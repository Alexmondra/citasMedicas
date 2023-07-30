<?php

class UserdatosModel{

    protected $db;
    protected $registros;

    public function __construct(){
        $this->db = Conexion::conectar();
        $this->registros = array();
    }

    public function getUserID($id){
        $sql = " SELECT * FROM usuario 
                           INNER JOIN persona ON persona.id_persona = usuario.id_persona  
                            WHERE usuario.id_usuario = $id";
            
            $consulta = $this->db->query($sql);
            $row =  $consulta->fetch_assoc();
            return $row;
 
    }

    public function actualizar($data, $id){

        $sql = "UPDATE persona AS per 
                       INNER JOIN usuario as us ON per.id_persona = us.id_persona
                            SET per.tipo_documento='" . $data["tipoD"] . "' , 
                                per.numero_documento = '" . $data["numeroD"] . "', 
                                per.apellido_p='" . $data["apeP"] . "' , 
                                per.apellido_m ='" . $data["apeM"] . "', 
                                per.nombre = '" . $data["nombre"] . "',
                                per.direccion = '" . $data["direccion"] . "',
                                per.telefono = '" . $data["numeroT"] . "',
                                per.estado_civil = '" . $data["estadoC"] . "',
                                us.usuario = '" . $data["user"] . "',
                                us.clave = '" . $data["password"] . "'

                where us.id_usuario = '$id'"; 

        $this->db->query($sql);

    }
}