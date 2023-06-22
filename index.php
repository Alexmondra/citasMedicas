<?php

/*
var_dump($_GET);
echo "<br>". $_GET["controller"];
echo "<br>". $_GET["action"];
echo "<br>". $_GET["id"];

*/
require_once "core/routes.php";
require_once "config/config.php";
require_once "config/Conexion.php";


if(!empty($_GET["controller"])){
    $controller = validarControlador($_GET["controller"]);

    if(!empty($_GET["action"])){
        
        if(!empty($_GET["id"])){
            validarAccion($controller, $_GET["action"],$_GET["id"]);
        }else{
            validarAccion($controller, $_GET["action"]);
        }
    
    }else{
        validarAccion($controller, ACCION_DEFAULT);
    }


}else{
    $controller = validarControlador(CONTROLADOR_DEFAULT);
    $action= ACCION_DEFAULT;
    $controller->$action();
}



