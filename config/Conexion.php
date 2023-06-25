<?php

class Conexion{

    public static function Conectar(){
       try {
            $host = "bwkaescheczk2jl0iegf-mysql.services.clever-cloud.com";
            $pass = "gG6HrE6MKUbpfdxqj1zg";
            $bd ="bwkaescheczk2jl0iegf";
            $user = "ughazad9u9sepkyt";

            $host1 = "bscb1actyqfwnbmpq8w9-mysql.services.clever-cloud.com";
            $pass1 = "jI6WXMLB9wVxRx8WYAXS";
            $bd1 ="bscb1actyqfwnbmpq8w9";
            $user1 = "unp31mqern8zd8qk";
            

            //$conn = new mysqli("$host","$user","$pass","$bd");

            $conn = new mysqli("localhost","root","root","citas_regional");
        if($conn->connect_error){
            throw new Excepcion($conn->connect_error);
        }else{
            return $conn;
        }
       } catch (Excepcion $e) {
            echo "Error: ".$e->getMessage();
       }
    }
}

?>

