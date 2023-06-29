<?php

require_once "ValController.php";
require_once "models/PacienteModel.php";
      
class VistaController{
    
   protected $paciente;
   protected $errores;
   protected $validation;

   public function __construct(){
       session_start();
       // $this->paciente = new PacienteModel();
       //$this->validation = new ValController();
       //$this->errores = array();
   }

   public function index(){

      $data = array(
         "contenido" => "views/inicio/especialidades.php",
      );

      require_once TEMPLATEPAG;
   }

   public function login(){
        require_once "views/inicio/login.php";
   }
}   
?>