<?php
require_once "models/LoginModel.php";
require_once "ValController.php";

class  LoginController
{
    protected $db;
    protected $validation;
    protected $errores; 

    public function __construct()
    {
        session_start();
        $this->db = new LoginModel();
        $this->validation = new ValController();
        $this->errores = array();
    }

    public function index()
    {
        require_once "views/inicio/login.php";
    }

    public function validarCredenciales(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $usuario = $this->validation->test_input($_POST["txtUsuario"]);
            $password = $this->validation->test_input($_POST["txtPassword"]);

            $this->validarUsuario($usuario);
            $this->validarPassword($password);

            if ($this->errores) {
                $data = array("errores" => $this->errores);
                require_once "views/inicio/login.php";
            } else {
                $usuarioFrecuente = $this->db->retornarUsuarioIntentos($usuario);
                if (isset($usuarioFrecuente)){
                    if ($usuarioFrecuente["intentos"]<10 ){
                            $consulta = $this->db->getAllResultados($usuario, $password); 
               
                        if(isset($consulta)){
                            if($consulta["estado"]==1){
                                $this->db->actualizarIntentosFallidos($usuario, 0);
                                    $data_session = [
                                        "loggin_in"     =>1,
                                        "fullName"      =>$consulta["nombre"]." ".$consulta["apellido_p"]." ".$consulta["apellido_m"]." ",
                                        "user_id"       =>$consulta["id_usuario"],
                                        "user_profile"  =>$consulta["perfil"],
                                        "user_IDprofile"=>$consulta["id_perfil"],
                                        "img" =>$consulta["img"],
                                        "user_modulos"  => $this->menu($consulta["id_perfil"])
                                    ];
                                        $_SESSION["session"] = $data_session;
                                        $url = BASE_URL."cpanel";
                                        header("Location: $url");
                            }else{
                                    $data = array("msj_login"=>"Perfil deshabilitado. Contactarse con el administrador");
                                    require_once "views/inicio/login.php";
                            }
                        }else{
                            $intentosFallidos = isset($usuarioFrecuente["intentos"]) ? $usuarioFrecuente["intentos"] + 1 : 1;
                            $this->db->actualizarIntentosFallidos($usuario, $intentosFallidos);
                            $intentosRestantes = 11 - $intentosFallidos;

                            $data = array("msj_login" => "Usuario y/o contraseña incorrecto -> Intentos restantes: $intentosRestantes");
                            require_once "views/inicio/login.php";
                            //FUERZA BRUTA IMPLEMENTAR MECANISMO
                            //TOKENS PARA CSRF
                        }
                     }else{
                        $data = array("msj_login" => "DEMASIADOS INTENTOS FALLIDOS - USUARIO BLOQUEADO ");
                        require_once "views/inicio/login.php";
                    }
            }else{
                $data = array("msj_login" => "Usuario y/o contraseña incorrecto");
                require_once "views/inicio/login.php";
            }
            
        }
    }
}
    
    
    public function menu($idPerfil){
        $cadena = "";
        $modulo = $this->db->getModulo($idPerfil);
        foreach($modulo as $mod){

            $cadena.="<li class='menu-item has-child'>";
            $cadena.="<a href='' class='menu-link'>";
            $cadena.=$mod["icon"];
            $cadena.="<span class='menu-text'>".$mod["descripcion"]."</span></a>";

            $submodulo = $this->db->getSubModulo($idPerfil,$mod["id_modulo"]);
            
            $cadena.="<ul class='menu'>";
            foreach($submodulo as $sub){
                $cadena.= "<li class='menu-item'>";
                $cadena.= "<a href='".BASE_URL.$sub["url"]."' class='menu-link'>".$sub["descripcion"]." </a>";
                $cadena.="</li>";
            }
            $cadena.="</ul>";
            $cadena.="</li>";
        }
        return $cadena; 
    }
    

    public function logout(){
        session_unset();
        session_destroy();
        $url = BASE_URL."vista";
        header("Location: $url");
    }

    private function validarUsuario($valor)
    {
        if (!$this->validation->validarRequeridos($valor)) {
            $this->errores["usuario"] = "Debe ingresar un valor en Usuario";
        }
    }


    private function validarPassword($valor)
    {
        if (!$this->validation->validarRequeridos($valor)) {
            $this->errores["password"] = "Debe ingresar un valor en Password";
        }
    }
}