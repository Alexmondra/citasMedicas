<?php

class PacienteModel{

    protected $db;
    protected $registros;

    public function __construct(){
        $this->db = Conexion::conectar();
        $this->registros = array();
    }
    
    public function getAllEspecialidad(){
        $sql = "SELECT * FROM especialidad WHERE estado = 1";
        $consulta = $this->db->query($sql);
        $registros = array();
        while ($row = $consulta->fetch_assoc()) {
            $registros[] = $row;
        }
        return $registros;
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





    public function getAllResults(){
        
        $sql = "SELECT * FROM persona";

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
