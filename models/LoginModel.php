<?php

class LoginModel
{

    protected $db, $registros;

    public function __construct()
    {
        $this->db = Conexion::conectar();
        $this->registros = array();
    }

    
    public function getAllResultados($user, $pass){
        
        $sql = "SELECT * FROM usuario INNER JOIN persona ON persona.id_persona = usuario.id_persona
                                      INNER JOIN perfiles ON perfiles.id_perfil = usuario.id_perfil
                WHERE usuario.usuario='".$user."' AND usuario.clave='".$pass."' AND  usuario.eliminado IS NULL";
        $consulta = $this->db->query($sql);
        $row = $consulta->fetch_assoc();
        return $row;
    }


    /*
    public function getAllResultados($user, $pass)
    {
        $sql = "SELECT * FROM personas
                INNER JOIN perfiles on perfiles.id_perfil = personas.idPerfil
                WHERE usuario = ?";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row && password_verify($pass, $row['contrasenia'])) {
            return $row; // Contraseña válida
        } else {
            return null; // Contraseña incorrecta o usuario no encontrado
        }
    }
    */

    public function getModulo($idPerfil){
        $this->registros = array();
        $sql = "SELECT 
        roles.id_perfil, sub.id_modulo, sub.descripcion, sub.icon
    FROM roles
    INNER JOIN modulos ON modulos.id_modulo = roles.id_modulo
    INNER JOIN modulos sub ON sub.id_modulo = modulos.submodulo
    WHERE roles.id_perfil = $idPerfil
    GROUP BY sub.descripcion";
        $consulta = $this->db->query($sql);

        while($row=$consulta->fetch_assoc()){
            $this->registros[] =$row;
        }
        return $this->registros;

    }

    public function getSubModulo($id_perfil, $id_modulo){
        $this->registros= array();
        $sql = "SELECT 
                modulos.descripcion, modulos.url
                FROM roles
                INNER JOIN modulos on modulos.id_modulo = roles.id_modulo
                WHERE modulos.submodulo=$id_modulo AND roles.id_perfil=$id_perfil";
         $consulta = $this->db->query($sql);

         while($row=$consulta->fetch_assoc()){
             $this->registros[] =$row;
         }
         return $this->registros;        
    }

    public function getPermisos($id_perfil)
    {
        $sql = "SELECT id_modulo, c, r, u, d, p FROM roles WHERE id_perfil = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_perfil);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $permisosPorModulo = array();
        while ($row = $result->fetch_assoc()) {
            $idModulo = $row['id_modulo'];
            unset($row['id_modulo']); 
            $permisosPorModulo[$idModulo] = $row;
        }
    
        return $permisosPorModulo;
    }
    
    

 



    public function actualizarIntentosFallidos($nombreUser, $numIntentos)
    {
        $sql = "UPDATE usuario SET intentos = '" . $numIntentos. "'  
        WHERE usuario = '" . $nombreUser . "'AND  usuario.eliminado IS NULL";
        $this->db->query($sql);
    }

    public function retornarUsuarioIntentos($user)
    {
        $sql = "SELECT * FROM usuario
        INNER JOIN perfiles on perfiles.id_perfil = usuario.id_perfil
        WHERE usuario='".$user."'AND  usuario.eliminado IS NULL";
        $consulta = $this->db->query($sql);
        $row = $consulta->fetch_assoc();
        return $row;
    }


}