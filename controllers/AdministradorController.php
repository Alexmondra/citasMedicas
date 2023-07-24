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
     
     public function registrarEspe(){
         if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nomArchivo = $_FILES["file"]["name"]; //obtener el nombre del archivo
            $nomTemporal = $_FILES["file"]["tmp_name"]; //nombre temporal para subir el archivo
            $fileSize = $_FILES["file"]["size"]; //obtener el tamño del archivo
            $extension = pathinfo($nomArchivo, PATHINFO_EXTENSION); //obtener la extensión del archivo
            $nomArchivo = substr(md5(time()), 0, 10) . "." . $extension;

            
 
             $especialidad = $_POST["txtEspeci"];
             $descripcion  = $_POST["txtDescripcion"];
             $precio  = $_POST["txtPrecio"];
             $token = md5($_POST["txtEspeci"]);

             $this->validarImagen($extension, $fileSize);

             if ($this->errores) {
                 echo json_encode(array("statusCode" => 500, "errores" => $this->errores));
             } else {
                  move_uploaded_file($nomTemporal, "public/especialidades/" . $nomArchivo);

                     $dataEspecialidad = [
                    
                        "especialidad" =>$especialidad,
                        "descripcion" => $descripcion,
                        "token" =>$token,
                        "imagen" => $nomArchivo
                        
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
 
     public function verEspecialidad($id){
         $data = $this->administrador->getResultIdEspeci($id);
         echo json_encode(array("data" => $data));
     }

     public function ActivarEspecialidad($id){
        if($_SERVER["REQUEST_METHOD"]=="GET"){
           $this->administrador->activarEs($id);
           $_SESSION['mensaje'] = "especialidad en servicio";
           $url = BASE_URL."administrador";
           header("Location: $url");
         }
 }

     public function desactivarEspecialidad($id){
            if($_SERVER["REQUEST_METHOD"]=="GET"){
               $this->administrador->desactivarEs($id);
               $_SESSION['mensaje'] = "especialidad fuera de servicio";
               $url = BASE_URL."administrador";
               header("Location: $url");
             }
     }


     
     








     // validadciones 

     private function validarImagen($extension, $img)
     {
         $extensionesValidas = array("jpg", "png", "jpeg", "gif");
 
         $max_file_size = "5000000"; // convertido a MB representaria 50MB, tener en cuenta que un 1MB = 1024KB
 
         if (!in_array($extension, $extensionesValidas)) {
             $this->errores["imagen"] = "Extensión de archivo invalido o no se ha subido ningun valor";
         } else if ($img > $max_file_size) {
             $this->errores["imagen"] = "La imagen debe tener un tamaño inferior a 25MB";
         }
     }
     
}