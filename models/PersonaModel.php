<?php

class PersonaModel{

    protected $db;
    protected $registros;

    public function __construct(){
        $this->db = Conexion::conectar();
        $this->registros = array();
    }


    public function getAllResults(){
        
        $sql = "SELECT * FROM personas";
        $consulta = $this->db->query($sql);

        while($row = $consulta->fetch_assoc()){
            $this->registros[] = $row;
        }
        return $this->registros;
    }

    public function save($data){
        $sql = "INSERT INTO personas(nombres,
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

    public function delete($id){

        $sql = "DELETE FROM personas where id_persona = '$id'";
        $this->db->query($sql);
    }
    
}
