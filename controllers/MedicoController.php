<?php

require_once "ValController.php";
require_once "models/MedicoModel.php";
      
class MedicoController{
    
   protected $medico;
   protected $errores;
   protected $validation;

   public function __construct(){
       session_start();
       $this->medico = new MedicoModel();
       $this->validation = new ValController();
       $this->errores = array(); 
   }

   public function index(){

      $data = array(
      "contenido" => "views/medico/atencion.php",
      "titulo"    => "atender cita actual",
      "atencion"  => $this->medico->getAtencion(),
      "historias" => $this->medico->getHistorias()
      );

      require_once TEMPLATE;
   }

   public function reporteAtencion(){

      $data = array(
      "contenido" => "views/medico/reporteAtencion.php",
      "titulo"    => "reporte de atenciones"
      );

      require_once TEMPLATE;
   }

     public function registrarDatos(){
      if($_SERVER["REQUEST_METHOD"]=="POST"){
         //obtener valores del formulario mediante POST
         $nombre = $_POST["txtNombres"];
         $apPaterno = $_POST["txtApPaterno"];
         $apMaterno = $_POST["txtApMaterno"];
         $correo = $_POST["txtCorreo"];
         $usuario = $_POST["txtUsuario"];
         $contrasenia =$_POST["txtContrasenia"];
         $perfil = $_POST["cboPerfil"];
         
         $this->validarNombre($nombre);
         $this->validarApPaterno($apPaterno);

         if($this->errores){
            $data = array(
               "contenido" => "views/personas/frmRegistrar.php",
               "titulo"    => "Formulario de registro de usuarios",
               "errores"   => $this->errores    
              );
              require_once TEMPLATE;
         }else{
            //arreglo asociativo de los datos enviados por POST
            $dataPersona = [
               "nombres" => $nombre,
               "apPaterno" => $apPaterno,
               "apMaterno" =>$apMaterno,
               "correo" =>$correo,
               "usuario" =>$usuario,
               "contrasenia" => $this->validation->sanitizacion($contrasenia),
               "perfil" =>$perfil
            ];
            $this->db->save($dataPersona);

            $_SESSION["mensaje"] ="Datos registrados correctamente";

            $url = BASE_URL."persona";
            header("Location: $url");
         }
        
      }else{
         $data["contenido"] = ERROR_404;
         require_once TEMPLATE;
      }
   }


   private function validarNombre($valor){

      $opciones = array(
         "options" => array(
            "min_range" =>3,
            "max_range" =>10
         )
      );

      if(!$this->validation->validarRequeridos($valor)){
         $this->errores["nombre"] ="Debe ingresar un valor en nombres";
         
      }else if(!$this->validation->validarLongitudes($valor,$opciones)){
         $this->errores["nombre"] ="Valores Permitidos: [3-10]";
      }
      return $this->errores;

   }
   private function validarApPaterno($valor){

      if(!$this->validation->validarRequeridos($valor)){
         $this->errores["paterno"] ="Debe ingresar un valor en Ap. Paterno";
      }
      return $this->errores;

   }

   
   public function eliminar($id){
      if($_SERVER["REQUEST_METHOD"]=="GET"){
        // $idd = $_GET["id"];
         $this->db->delete($id);

      }

      $_SESSION['mensaje'] = "Datos eliminados correctamente";
      $url = BASE_URL."persona";
      header("Location: $url");
  }


    

}