<?php

require_once "ValController.php";
require_once "models/UserdatosModel.php";
      
class UserdatosController{
    
   protected $user;
   protected $errores;
   protected $validation;

   public function __construct(){
      session_start();
      if(empty($_SESSION["session"]["loggin_in"])){
         $url= BASE_URL.'login';
         header("Location: $url");
         die();
     }

       $this->user = new UserdatosModel();
       $this->validation = new ValController();
       $this->errores = array(); 
   }

   public function index(){

      $data = array(
         "contenido" => "views/edit/userEdit.php",
         "titulo"    => "Editar registro de usuario ",
         "datos" => $this->user->getUserID($_SESSION["session"]["user_id"]),
      );

      require_once TEMPLATE;
   } 

   public function editar($id){
      if($_SERVER["REQUEST_METHOD"]=="POST"){
         
         $tipoD = $_POST["selectTipoDocumento"];
         $numeroD = $_POST["txtNumDocum"];
         $apeP = $_POST["txtApPaterno"];
         $apeM = $_POST["txtApMaterno"];
         $nombre = $_POST["txtNombres"];
         $direccion = $_POST["txtDireccion"];
         $numeroT = $_POST["numberTelefono"];
         $estadoC = $_POST["textEstadoCiv"];
         $user = $_POST["txtUser"];
         $password = $_POST["txtpassw"];
         
         //$this->validarNombre($nombre);
        // $this->validarPrecio($precio);
          
         if($this->errores){
            $data = array(
               "contenido" => "views/productos/frmEditar.php",
               "titulo"    => "Formulario de registro de productos",
               "errores"   => $this->errores    
              );
              require_once TEMPLATE;
         }else{
            $datauser = [
              "tipoD" => $tipoD,
              "numeroD" => $numeroD,
              "apeP" =>  $apeP,
              "apeM" => $apeM,
              "nombre" => $nombre,
              "direccion" => $direccion,
              "numeroT" =>  $numeroT,
              "estadoC" => $estadoC,
              "user" =>  $user,
              "password" => $password,
            ];

            $this->user->actualizar($datauser,$id);
  
            $_SESSION["mensaje"] ="Datos actualizados correctamente";
  
            $url = BASE_URL."userdatos";
            header("Location: $url");
         }
        
      }else{
         $data["contenido"] = ERROR_404;
         require_once TEMPLATE;
      }

   }
   

}