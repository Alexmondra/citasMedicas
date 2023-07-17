<?php

require_once "ValController.php";
require_once "models/PacienteModel.php";
      
class VistaController{
    
   protected $vista;
   protected $errores;
   protected $validation;

   public function __construct(){
     

       $this->vista = new PacienteModel();
       //$this->validation = new ValController();
       //$this->errores = array();
   }

   public function index(){

      $data = array(
         "contenido" => "views/inicio/inicio.php",
      );

      require_once TEMPLATEPAG;
   }

   public function login(){
        require_once "views/inicio/login.php";
   }

   public function servicios(){

      $data = array(
         "contenido" => "views/inicio/servicios.php",
      );

      require_once TEMPLATEPAG;
   }

   public function especialidad(){

      $data = array(
         "contenido" => "views/inicio/especialidades.php",
          "especialidad" => $this->vista->getAllEspecialidad(),
      );

      require_once TEMPLATEPAG;
   }
}   
?>