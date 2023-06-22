<?php

#funcion para validar si un controlador es válido
function validarControlador($controller){
    $controlador = $controller."Controller";
    $file = "controllers/".$controlador.".php";

    if(!is_file($file)){
        //echo "Controlador no definido";
        mostraError();
    }else{
      require_once $file;
      $control = new $controlador();
      return $control;
    }
}

#funcion para validar las acciones
function validarAccion($controller, $action, $id=null){
    if(isset($action) && method_exists($controller, $action) ){
        if($id==null){
            $controller->$action(); 
            
 
        }else{
            $controller->$action($id);  
        }
       

    }else{
        //echo "No existe la funcion en la clase";
        mostraError();
    }
}

function mostraError(){
    $data["contenido"] = ERROR_404;
    require_once TEMPLATE;
}



