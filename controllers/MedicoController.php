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

   public function horario(){
      $data = array(
         "contenido" => "views/medico/horario.php",
         "titulo"    => "ELECCION DE HORARIO DE ATENCION",
         "horario"  => $this->medico->gethorario()
         );
   
         require_once TEMPLATE;
   }

   public function verhorario($id){
      $data = $this->medico->getResultID($id);
      echo json_encode(array("data" => $data));
      //die(json_encode($data));
   }

   public function registrarNuevo(){
      if($_SERVER["REQUEST_METHOD"]=="POST"){
         //obtener valores del formulario mediante POST
         $fecha   = $_POST["txtdate"];
         $inicio  = $_POST["txtinicio"];
         $fin     = $_POST["txtfin"];
         $cupos   = $_POST["txtcupos"];

         //$this->validarCupos($cupos);
        // $this->validarApPaterno($apPaterno);

            $dataHorario = [

               "fecha" => $fecha,
               "ho_inicio"  => $inicio,
               "ho_fin" => $fin,
               "cupos" => $cupos

            ];

            $this->medico->saveHorario($dataHorario);

            $_SESSION["mensaje"] ="Nuevo horario registrados correctamente";

            $url = BASE_URL."medico/horario";
            header("Location: $url");
      }else{
         $data["contenido"] = ERROR_404;
         require_once TEMPLATE;
      }
   }



   public function actualizarhorario($id)
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
                   $this->medico->updatehorario($id, $dataHorario);
    
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