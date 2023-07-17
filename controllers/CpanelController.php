<?php

class CpanelController{

    public function __construct(){
        session_start();
        if(empty($_SESSION["session"]["loggin_in"])){
            $url= BASE_URL.'login';
            header("Location: $url");
            die();
        }
     
    }

    public function index(){

       $data["titulo"] = "Administración principal";
       //$data["contenido"]= "views/inicio/login.php";
       $data["contenido"] ="views/dashboard/content.php";
       require_once TEMPLATE;
    }
    
}
