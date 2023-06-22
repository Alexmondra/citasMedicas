<?php

class CpanelController{

    public function __construct(){
        #echo "Este es el controlador por defecto - CPANEL";
    }

    public function index(){

       $data["titulo"] = "Administración principal";
       $data["contenido"] ="views/dashboard/content.php";
       require_once TEMPLATE;
    }
    
}
