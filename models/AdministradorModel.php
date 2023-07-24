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
        precios.precio , especialidad.estado as estado ,
        especialidad.id_especialidad as id 
         FROM especialidad INNER JOIN precios on especialidad.id_especialidad = precios.id_especialidad";
        $consulta = $this->db->query($sql);
        $registros = array();
        while ($row = $consulta->fetch_assoc()) {
            $registros[] = $row;
        }
        return $registros;
    }

    public function saveEspecialidad($data) {
        $sql = "INSERT INTO especialidad(nombre, 
                                      descripcion,
                                      estado,
                                      token,
                                      imagen) 
                VALUES ('" . $data["especialidad"] . "', 
                        '" . $data["descripcion"] . "', '1' , 
                        '" . $data["token"] ."',
                        '" . $data["imagen"] ."')";
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

    public function getResultIdEspeci($id){
        $sql = "SELECT *
		        FROM especialidad
                INNER JOIN precios ON especialidad.id_especialidad = precios.id_especialidad
     WHERE especialidad.id_especialidad = $id";
        $consulta = $this->db->query($sql);
        $row =  $consulta->fetch_assoc();
        return $row;
    }

    public function activarEs($id){ 
        $sql1 ="UPDATE especialidad SET estado = 1 WHERE id_especialidad = '".$id."'";

        $this->db->query($sql1); 

    }
    public function desactivarEs($id){ 
        $sql1 ="UPDATE especialidad SET estado = 0 WHERE id_especialidad = '".$id."'";

        $this->db->query($sql1); 

    }
    


    

    
}

?>