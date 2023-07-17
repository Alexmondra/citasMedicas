<?php

require_once "ValController.php";
require_once "models/AdministradorModel.php";
      
class AdministradorController{
    
   protected $administrador;
   protected $errores;
   protected $validation;

   public function __construct(){
    session_start();
    if(empty($_SESSION["session"]["loggin_in"])){
        $url= BASE_URL.'login';
        header("Location: $url");
        die();
    }
       $this->administrador = new AdministradorModel();
       $this->validation = new ValController();
       $this->errores = array(); 
   }

   public function index(){

      $data = array(
      "contenido" => "views/administrador/especialidades.php",
      "titulo"    => "control de especialidades", 
      "especialidades" =>$this->administrador->getAllEspecialidades() 
      );

      require_once TEMPLATE;
   }

    public function especialidades(){
        $data = array(
            "contenido" => "views/administrador/especialidades.php",
            "titulo"    => "control de especialidades",
            "especialidades" =>$this->administrador->getAllEspecialidades()    
        );
        require_once TEMPLATE;
     }  
     
     public function registrar(){
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
             $especialidad = $_POST["txtEspeci"];
             $descripcion  = $_POST["txtDescripcion"];
             $precio  = $_POST["txtPrecio"];
             $token =md5($_POST["txtEspeci"]);
             if ($this->errores) {
                 echo json_encode(array("statusCode" => 500, "errores" => $this->errores));
             } else {
                     $dataEspecialidad = [
                       
                        "especialidad" =>$especialidad,
                        "descripcion" => $descripcion,
                        "token" =>$token
                        
                     ];
                     
                     $dataPrecio = [
                        "precio" =>$precio,
                        "especialidad" =>$especialidad
                     ];
                     $this->administrador->saveEspecialidad($dataEspecialidad);
                     $this->administrador->savePrecio($dataPrecio);
                     
                 $_SESSION["mensaje"] = "Datos registrados correctamente";
 
                 echo json_encode(array("statusCode" => 200));
             }
         } else {
             $data["contenido"] = ERROR_404;
             require_once TEMPLATE;
         }
     }
 
     public function ver($id)
     {
         $data = $this->administrador->getResultID($id);
         echo json_encode(array("data" => $data));
         //die(json_encode($data));
     }
 
     public function actualizarModulos($id)
     {
         error_reporting(0);
 
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
             $tipoOpcion = $_POST["cboOpcion"];
             $icon       = $_POST["txtIcon"];
             $cboModulo  = $_POST["cboModulo"];
             $url        = $_POST["txtUrl"];
             $descripcion = $_POST["txtDescripcion"];
 
             if ($tipoOpcion == 1) {
                 $this->validarIcon($icon);
                 $this->validarDescripcion($descripcion);
             } else {
                 $this->validarDescripcion($descripcion);
                 $this->validarURL($url);
             }
 
             if ($this->errores) {
                 echo json_encode(array("statusCode" => 500, "errores" => $this->errores));
             } else {
 
                 if ($tipoOpcion == 1) {
                     $dataModulo = [
                         "descripcion" => $descripcion,
                         "icon"        => $icon,
                     ];
                     $this->db->updateModulo($id, $dataModulo);
                 } else {
                     $dataSubModulo = [
                         "descripcion" => $descripcion,
                         "url"         => $url,
                         "submodulo"   => $cboModulo
                     ];
                     $this->db->updateSubModulo($id, $dataSubModulo);
                 }
 
                 $_SESSION["mensaje"] = "Datos actualizados correctamente";
 
                 echo json_encode(array("statusCode" => 200));
             }
         } else {
             $data["contenido"] = ERROR_404;
             require_once TEMPLATE;
         }
     }





     /// controlador de perfiles 


     
}