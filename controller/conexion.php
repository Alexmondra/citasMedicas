<?php
$host = "db4free.net:3306";
$pass = "ussbdroot666";
$bd ="citas_medicas";
$user = "bdroot";

$mysqli = new mysqli("$host","$user","$pass","$bd");

if ($mysqli->connect_error) {
  die("error al conectar a a la base de datos");
  exit();
}
?>
