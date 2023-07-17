<?php

class ValController{


    //método para escape de caracteres
    public function test_input($valor) {
        $data = trim($valor);
        $data = stripslashes($valor);
        $data = htmlspecialchars($valor);
        return $data;
    }
    
    //metodo para validar datos requeridos u obligatorios
    public function validarRequeridos($valor){
        if($valor!=""){
            return true;
        }else{
            return false;
        }
    }

    //método para validar longitudes de campos
    public function validarLongitudes($valor, $opciones){
        $longitud = strlen($valor);
        if(filter_var($longitud, FILTER_VALIDATE_INT, $opciones)===false){
            return false;
        }else{
            return true;
        }
    }

    //método para validar email
    public function validarCorreo($valor){
        if(filter_var($valor, FILTER_VALIDATE_EMAIL)=== false){
            return false;
        }else{
            return true;
        }
    }

}

