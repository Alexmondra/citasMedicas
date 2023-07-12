<?php

class AdministradorModel{

    protected $db;
    protected $registros;

    public function __construct(){
        $this->db = Conexion::conectar();
        $this->registros = array();
    }

    public function getAllEspecialidades(){
        $sql = "SELECT especialidad.nombre as nombre, especialidad.descripcion as descripcion,
        precios.precio, especialidad.id_especialidad as id_especialidad , especialidad.estado as estado
         FROM especialidad INNER JOIN precios on especialidad.id_especialidad = precios.id_especialidad";
        $consulta = $this->db->query($sql);
        $registros = array();
        while ($row = $consulta->fetch_assoc()) {
            $registros[] = $row;
        }
        return $registros;
    }

    public function saveEspecialidad($data)
    {
        $sql = "INSERT INTO especialidad(nombre, 
                                      descripcion,
                                      estado) 
                VALUES ('" . $data["especialidad"] . "', 
                        '" . $data["descripcion"] . "','1')";
        $this->db->query($sql);
    }

    public function savePrecio($data)
    {
        $sql = "INSERT INTO precios (fecha, precio, id_administrador, id_especialidad) 
        SELECT CURRENT_TIME(), '" . $data["precio"] . "', '1', id_especialidad 
        FROM especialidad 
        WHERE nombre = '" . $data["especialidad"] . "'";
        $this->db->query($sql);
    }

    public function getResultID($id){
        $sql = "SELECT *
		        FROM especialidad
                INNER JOIN precios ON especialidad.id_especialidad = precios.id_especialidad
     WHERE especialidad.id_especialidad = $id";
        $consulta = $this->db->query($sql);
        $row =  $consulta->fetch_assoc();
        return $row;
    }


}

?>