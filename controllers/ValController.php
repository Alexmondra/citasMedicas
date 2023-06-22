<?php

class ValController{

    //método para sanitizar datos
    public function sanitizacion($valor){
        $valor = trim($valor); //eliminar espacios en blanco 
        $valor = stripslashes($valor); //eliminar \/
        $valor = htmlspecialchars($valor); //convertir a texto unicode
        return $valor;
    }

    //método para validar campos requeridos
    public function validarRequeridos($valor){
        if($valor!=""){
            return true;
        }else{
            return false;
        }
    }

    public function validarLongitudes($valor,$options){

        $longitud = strlen($valor);
        
        if(filter_var($longitud, FILTER_VALIDATE_INT, $options)===false){
            return false;
        }else{
            return true;
        }
    }

}

