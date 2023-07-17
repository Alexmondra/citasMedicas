<?php

class AutorizacionModel{

    /// inicio 

    protected $db, $registros;

    public function __construct()
    {
        $this->db = Conexion::conectar();
        $this->registros = array();
    }

    // model de modulos  

    public function getAllResultados()
    {
        $this->registros = array();
        $sql = "SELECT * FROM modulos WHERE submodulo is null";
        $consulta = $this->db->query($sql);

        while ($row = $consulta->fetch_assoc()) {
            $this->registros[] = $row;
            
            $id_modul = $row["id_modulo"];
            $sql1 = "SELECT * FROM modulos WHERE submodulo = $id_modul"; 
            $consulta1 = $this->db->query($sql1);
            while ($row = $consulta1->fetch_assoc()) {
                $this->registros[] = $row;
            }
        }
        return $this->registros;
    }

    public function getSubModulos()
    {
        $this->registros = array();
        $sql = "SELECT *FROM modulos WHERE submodulo is null";
        $consulta = $this->db->query($sql);

        while ($row = $consulta->fetch_assoc()) { 
            $this->registros[] = $row;
        }

        return $this->registros;
    }

    public function saveModulo($data)
    {
        $sql = "INSERT INTO modulos (descripcion, 
                                      icon) 
                VALUES ('" . $data["descripcion"] . "', 
                        '" . $data["icon"] . "')";
        $this->db->query($sql);
    }

    public function saveSubModulo($data)
    {
        $sql = "INSERT INTO modulos (descripcion,
                                    url, 
                                      submodulo) 
                VALUES ('" . $data["descripcion"] . "',
                        '" . $data["url"] . "', 
                        '" . $data["submodulo"] . "')";

        $this->db->query($sql);
    }

    public function getResultID($id){
        $sql = "SELECT * FROM modulos WHERE id_modulo = $id";
        $consulta = $this->db->query($sql);
        $row =  $consulta->fetch_assoc();
        return $row;
    }

    public function updateModulo($id, $data)
    {
      
        $sql = "UPDATE modulos SET  descripcion = '".$data["descripcion"]."', 
                                    icon = '".$data["icon"]."' 
                                WHERE modulos.id_modulo = $id";
        $this->db->query($sql);
    }

    public function updateSubModulo($id, $data)
    {
        $sql = "UPDATE modulos SET  descripcion = '" . $data["descripcion"] . "',
                                    url = '" . $data["url"] . "', 
                                    submodulo= '" . $data["submodulo"] . "'
                               WHERE id_modulo = $id     
                                    ";

        $this->db->query($sql);
    }

    public function deleteModulo($id){
        $sql = "DELETE FROM modulos WHERE id_modulo = $id ";

        if($this->db->query($sql)===TRUE){
            return true;
        }else{
            return false;
        }
    }


    /// model de perfiles 

    public function getAllResults()
    {
        $sql = "SELECT *FROM perfiles ORDER BY id_perfil DESC";
        $consulta = $this->db->query($sql);

        if (!$consulta) {
            $this->registros[] ="Sin registros que mostrar";
        } {
            while ($row = $consulta->fetch_assoc()) {
                $this->registros[] = $row;
            }
        }
        return $this->registros;
    
    }

    public function getResultIDPerfil($id){
        $sql = "SELECT * FROM perfiles WHERE id_perfil = $id";
        $consulta = $this->db->query($sql);
        $row =  $consulta->fetch_assoc();
        return $row;
    }


    public function savePerfil($data)
    {
        $sql = "INSERT INTO perfiles (imagen, 
                                      perfil,
                                      estado) 
                VALUES ('" . $data["imagen"] . "', 
                        '" . $data["perfil"] . "',
                        '" . $data["estado"] . "')";
        $this->db->query($sql);
    }

    public function updatePerfil($id, $data){
        $sql = "UPDATE perfiles SET imagen = '".$data["imagen"]."', 
                                    perfil = '".$data["perfil"]."', 
                                    estado = '".$data["estado"]."' 
                                WHERE perfiles.id_perfil = $id";
        $this->db->query($sql);
    }


    public function deletePerfil($id){
        $sql = "DELETE FROM perfiles WHERE id_perfil = $id ";

        if($this->db->query($sql)===TRUE){
            return true;
        }else{
            return false;
        }
    }


    /// model de roles 


    public function getRoles($modulo, $perfil, $columna)
    {
        $estado = "";
        
        $sql = "SELECT $columna FROM roles where id_modulo= $modulo and id_perfil=$perfil";
        $consulta = $this->db->query($sql);
        $row =  $consulta->fetch_assoc();
        if (isset($row)) {
            if ($row["$columna"] == 1) {
                $estado = "checked";
            } else {
                $estado = "";
            }
        }
        return $estado;
    }

    public function saveRoles($data)
    {

        $sql = "INSERT INTO roles (id_modulo, id_perfil, c, r, u, d, p) 
                        VALUES ('".$data["id_modulo"]."', 
                                '".$data["id_perfil"]."', 
                                '".$data["c"]."', 
                                '".$data["r"]."', 
                                '".$data["u"]."', 
                                '".$data["d"]."', 
                                '".$data["p"]."')";
        $this->db->query($sql);
    }

    public function deleteRoles($id_perfil){
        $sql = "DELETE FROM roles WHERE id_perfil = $id_perfil";
        $this->db->query($sql);
    }




}