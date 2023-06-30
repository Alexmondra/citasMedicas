<?php

require_once "ValController.php";
require_once "models/AdmisionistaModel.php";
      
class AdmisionistaController{
    
   protected $admisionista;
   protected $errores;
   protected $validation;

   public function __construct(){
       session_start();
       $this->admisionista = new AdmisionistaModel();
       $this->validation = new ValController();
       $this->errores = array(); 
   }

   public function index(){

      $data = array(
      "contenido" => "views/admisionista/validar.php",
      "titulo"    => "validar citas registradas",
      "cita"  => $this->admisionista->getAllResults(), 
      "doctor" => $this->admisionista->getAllDoctores()    
      );

      require_once TEMPLATE;
   }

    public function pagos(){
        $data = array(
         "contenido" => "views/admisionista/pagos.php",
         "titulo"    => "Registro de pagos",
         "pagos" => $this->admisionista->getAllCitasPagos()   
        );
        require_once TEMPLATE;
     }
   public function cancelacion(){
      $data = array(
       "contenido" => "views/admisionista/cancelacion.php",
       "titulo"    => "cancelacion de citas",
       "citas"      =>$this->admisionista->getAllCitas()
      );
      require_once TEMPLATE;
   }
   public function reporte(){
      $data = array(
       "contenido" => "views/admisionista/reporte.php",
       "titulo"    => "reportes de citas",
       "reporteAtender" => $this->admisionista->getAllCitasAtender(),
       "reporteAtendido" => $this->admisionista->getAllCitasAtendido(),
       "doctor" => $this->admisionista->getAllDoctores(),
       "especialidad" => $this->admisionista->getAllEspecialidad()
      
      );
      require_once TEMPLATE;
      }

   public function reprogramar(){
         $data = array(
          "contenido" => "views/admisionista/reprogramaciones.php",
          "titulo"    => "reprogramaciones ",
          "cita"  => $this->admisionista->getAllResults(),         
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

   
   public function inicio($id){
      if($_SERVER["REQUEST_METHOD"]=="GET"){
        // $idd = $_GET["id"];
         $this->admisionista->setInicio($id);

      $_SESSION['mensaje'] = "inicio de la consulta";
      $url = BASE_URL."admisionista";
      header("Location: $url");
   }
  }

  public function fin($id){
   if($_SERVER["REQUEST_METHOD"]=="GET"){
     // $idd = $_GET["id"];
      $this->admisionista->setFin($id);

   $_SESSION['mensaje'] = "fin de la consulta";
   $url = BASE_URL."admisionista";
   header("Location: $url");
    }
   }

  


    
}