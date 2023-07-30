<?php

require_once "ValController.php";
require_once "models/MedicoModel.php";
      
class MedicoController{
    
   protected $medico;
   protected $errores;
   protected $validation;

   public function __construct(){
      session_start();
      if(empty($_SESSION["session"]["loggin_in"])){
          $url= BASE_URL.'login';
          header("Location: $url");
          die();
      }
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
      "titulo"    => "reporte de atenciones",
      "atenciones" => $this->medico->getAtencionesMedico()
      );

      require_once TEMPLATE;
   }

   public function horario() {
     
  
      $data = array(
          "contenido" => "views/medico/horario.php",
          "titulo" => "ELECCION DE HORARIO DE ATENCION",
          "horario" => $this->medico->gethorario($_SESSION["session"]["user_id"]),
      );
  
      require_once TEMPLATE;
  }
  

 



  

   public function verhorario($token) {
      $data = $this->medico->getResultID($token);
      echo json_encode(array("data" => $data));
      //die(json_encode($data));
  }

   public function registrarNuevo($id){
      if($_SERVER["REQUEST_METHOD"]=="POST"){
         //obtener valores del formulario mediante POST
         $fecha   = $_POST["txtdate"];
         $inicio  = $_POST["txtinicio"];
         $fin     = $_POST["txtfin"];
         $cupos   = $_POST["txtcupos"];
         $token =md5($_POST["txtdate"]);

         //$this->validarCupos($cupos);
        // $this->validarApPaterno($apPaterno);

            $dataHorario = [

               "fecha" => $fecha,
               "ho_inicio"  => $inicio,
               "ho_fin" => $fin,
               "cupos" => $cupos,
               "token" =>$token

            ];

            $this->medico->saveHorario($dataHorario,$id);

            $_SESSION["mensaje"] ="Nuevo horario registrados correctamente";

            $url = BASE_URL."medico/horario";
            header("Location: $url");
      }else{
         $data["contenido"] = ERROR_404;
         require_once TEMPLATE;
      }
   }



   public function actualizarhorario($token)
   {
       error_reporting(0);

       if ($_SERVER["REQUEST_METHOD"] == "POST") {
         

           $fecha   = $_POST["txtFecha"];
           $inicio  = $_POST["txtHoInicio"];
           $fin     = $_POST["txtHoFin"];
           $cupos   = $_POST["txtCupos"];

                   $dataHorario = [
                       "fecha" => $fecha,
                       "ho_inicio"  => $inicio,
                       "ho_fin" => $fin,
                       "cupos" => $cupos
                      
                   ];
                   $this->medico->updatehorario($token, $dataHorario);
    
               $_SESSION["mensaje"] = "Datos actualizados correctamente";

               echo json_encode(array("statusCode" => 200));
           }
   }
   
   public function eliminarhorario($id){
      if($_SERVER["REQUEST_METHOD"]=="GET"){
         $this->medico->deleteHorario($id);

      } 

      $_SESSION['mensaje'] = "Datos eliminados correctamente";
      $url = BASE_URL."medico/horario";
      header("Location: $url");
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




    

}