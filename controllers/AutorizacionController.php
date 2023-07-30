<?php

require_once "ValController.php";
require_once "models/AutorizacionModel.php";
      
class AutorizacionController{ 

    // constructor de modulos - perfiles - roles


    protected $db;
    protected $errores;
    protected $validation;


    protected $modulos;
    protected $roles;

    public function __construct()
    {
        session_start();
        if(empty($_SESSION["session"]["loggin_in"])){
            $url= BASE_URL.'login';
            header("Location: $url");
            die();
        }
        if(empty($_SESSION["session"]["loggin_in"])){
            $url= BASE_URL.'login';
            header("Location: $url");
            die();
        }

        $this->db = new AutorizacionModel(); 
        $this->validation = new ValController();
        $this->errores = array();
    }

    /// controller modulos 

    public function index()
    {
        $data = array(
            "contenido" => "views/administrador/modulo.php",
            "titulo"    => "Administración de modulosss",
            "modulos"   => $this->db->getSubModulos(),
            "registros" => $this->db->getAllResultados() 
        );

        require_once TEMPLATE;
    }

    public function registrarModulos()
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
                    $this->db->saveModulo($dataModulo);
                } else {
                    $dataSubModulo = [
                        "descripcion" => $descripcion,
                        "url"         => $url,
                        "submodulo"   => $cboModulo
                    ];
                    $this->db->saveSubModulo($dataSubModulo);
                }

                $_SESSION["mensaje"] = "Datos registrados correctamente";

                echo json_encode(array("statusCode" => 200));
            }
        } else {
            $data["contenido"] = ERROR_404;
            require_once TEMPLATE;
        }
    }

    public function verModuloID($id){
        $data = $this->db->getResultID($id);
        echo json_encode(array("data" => $data));
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

    public function eliminarModulo($id)
    {

        if ($this->db->deleteModulo($id)) {
            $_SESSION["mensaje"] = "Datos eliminados correctamente";
        } else {
            $_SESSION["mensaje"] = "Error al eliminar el registro";
        }

        $url = BASE_URL . "modulos";
        header("Location: $url");
    }


    private function validarIcon($valor)
    {
        if (!$this->validation->validarRequeridos($valor)) {
            $this->errores["icon"] = "Debe ingresar un valor en ICON";
        }
        return $this->errores;
    }

    private function validarDescripcion($valor)
    {
        if (!$this->validation->validarRequeridos($valor)) {
            $this->errores["descripcion"] = "Debe ingresar un valor en DESCRIPCION";
        }
    }

    private function validarURL($valor)
    {
        if (!$this->validation->validarRequeridos($valor)) {
            $this->errores["url"] = "Debe ingresar un valor en URL";
        }
    }


    /// controller de perfiles 


    public function indexPerfil()
    {
        $data = array(
            "contenido" => "views/administrador/perfiles.php",
            "titulo"    => "Administración de Perfiles",
        );

        require_once TEMPLATE;
    }

    public function verRegistros()
    {
        echo json_encode(array("registros" => $this->db->getAllResults()));
    }

    public function registrarPerfiles()
    { 
        error_reporting(0);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nomArchivo = $_FILES["file"]["name"]; //obtener el nombre del archivo
            $nomTemporal = $_FILES["file"]["tmp_name"]; //nombre temporal para subir el archivo
            $fileSize = $_FILES["file"]["size"]; //obtener el tamño del archivo
            $extension = pathinfo($nomArchivo, PATHINFO_EXTENSION); //obtener la extensión del archivo
            $nomArchivo = substr(md5(time()), 0, 10) . "." . $extension;

            $perfil     = $_POST["txtPerfil"];
            $activo     = isset($_POST["chkEstado"]) ? 1 : 0;

            $this->validarPerfil($perfil);
            $this->validarImagen($extension, $fileSize);

            if ($this->errores) {
                echo json_encode(array("statusCode" => 500, "errores" => $this->errores));
            } else {
                move_uploaded_file($nomTemporal, "public/perfiles/" . $nomArchivo);
                $dataPerfil = [
                    "imagen" => $nomArchivo,
                    "perfil" => $perfil,
                    "estado" => $activo,
                ];
                $this->db->savePerfil($dataPerfil);

                echo json_encode(array("statusCode" => 200));
            }
        } else {
            $data["contenido"] = ERROR_404;
            require_once TEMPLATE;
        }
    }

    public function verPerfilID($id)
    {
        $data = $this->db->getResultIDPerfil($id); 
        echo json_encode(array("data" => $data));
    }

    public function actualizarPerfiles($id)
    {
        error_reporting(0);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nomArchivo = $_FILES["file"]["name"]; //obtener el nombre del archivo
            $nomTemporal = $_FILES["file"]["tmp_name"]; //nombre temporal para subir el archivo
            $fileSize = $_FILES["file"]["size"]; //obtener el tamño del archivo
            $extension = pathinfo($nomArchivo, PATHINFO_EXTENSION); //obtener la extensión del archivo
            $nomArchivo = substr(md5(time()), 0, 10) . "." . $extension;

            $perfil     = $_POST["txtPerfil"];
            $activo     = isset($_POST["chkEstado"]) ? 1 : 0;

            $img = $_POST["txtImg"];

            $this->validarPerfil($perfil);

            if ($nomTemporal != "") {
                $this->validarImagen($extension, $fileSize);
                $ruta = "public/perfiles/" . $img;
            } else {
                $nomArchivo = $img;
                $ruta = "";
            }

            if ($this->errores) {
                echo json_encode(array("statusCode" => 500, "errores" => $this->errores));
            } else {
                move_uploaded_file($nomTemporal, "public/perfiles/" . $nomArchivo);
                if ($ruta != "") {
                    unlink($ruta);
                }
                unlink($ruta);
                $dataPerfil = [
                    "imagen" => $nomArchivo,
                    "perfil" => $perfil,
                    "estado" => $activo,
                ];
                $this->db->updatePerfil($id, $dataPerfil);

                echo json_encode(array("statusCode" => 200));
            }
        } else {
            $data["contenido"] = ERROR_404;
            require_once TEMPLATE;
        }
    }

    public function eliminarPerfil($id)
    {
        $consulta  = $this->db->getResultID($id);
        $ruta = "public/perfiles/" . $consulta["imagen"];

        if ($this->db->deletePerfil($id)) {
            unlink($ruta);
            echo json_encode(array("mensaje" => "Datos eliminados correctamente"));
        } else {
            echo json_encode(array("mensaje" => "Error al eliminar el registro"));
        }
    }


    private function validarPerfil($valor)
    {
        if (!$this->validation->validarRequeridos($valor)) {
            $this->errores["perfil"] = "Debe ingresar un valor en Perfil";
        }
        return $this->errores;
    }


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


    // controller de roles 


    public function administracionR($id_perfil)
    {
        $data = $this->db->getAllResultados(); 
        $filas = "";
        $cont1 = 0;
        foreach ($data as $row) {
            if ($row["submodulo"] == "") {
                $filas .= "<tr>";
                $filas .= "<td colspan='6' class='col-4'> <strong>" . $row["descripcion"] . "</strong></td>";
                $filas .= "</tr>";
            } else {
                $cont1++;
                $filas .= "<tr>";
                $filas .= "<td><input type='hidden' name='Modulo[]' value='" . $row["id_modulo"] . "' > " . $row["descripcion"] . "</td>";
                $filas .= "<td class='text-center'> 
                                <input type='checkbox' id='read". ($cont1 - 1) ."' name = 'chkRead[".($cont1-1)."]' ".$this->db->getRoles($row["id_modulo"],$id_perfil,'r').">
                            </td>";
                $filas .= "<td class='text-center'> 
                                <input type='checkbox' id='create". ($cont1 - 1) ."' name = 'chkCreate[".($cont1-1)."]' ".$this->db->getRoles($row["id_modulo"],$id_perfil,'c').">
                            </td>";
                $filas .= "<td class='text-center'>
                                <input type='checkbox' id='update". ($cont1 - 1) ."' name = 'chkUpdate[".($cont1-1)."]' ".$this->db->getRoles($row["id_modulo"],$id_perfil,'u').">
                            </td>";
                $filas .= "<td class='text-center'> 
                                <input type='checkbox' id='delete". ($cont1 - 1) ."' name = 'chkDelete[".($cont1-1)."]' ".$this->db->getRoles($row["id_modulo"],$id_perfil,'d').">
                            </td>";
                $filas .= "<td class='text-center'> 
                                <input type='checkbox' id='print". ($cont1 - 1) ."' name = 'chkPrint[".($cont1-1)."]' ".$this->db->getRoles($row["id_modulo"],$id_perfil,'p').">
                            </td>";
            }
        }
        echo json_encode(array("modulos" => $filas));
    }

    public function actualizarRoles($id_perfil){
        error_reporting(0);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $this->db->deleteRoles($id_perfil);
            
            $modulo     = $_POST["Modulo"];
            $create     = $_POST["chkCreate"];
            $read       = $_POST["chkRead"];
            $update     = $_POST["chkUpdate"];
            $delete     = $_POST["chkDelete"];
            $print      = $_POST["chkPrint"];

            for($i=0; $i<count($modulo);$i++){
                if($create[$i]==0 &&
                   $read[$i] ==0 &&
                   $update[$i]==0 &&
                   $delete[$i]==0 &&
                   $print[$i]==0
                ){
                    continue;
                }else{
                    $data = [
                        "id_modulo" =>$modulo[$i],
                        "id_perfil" =>$id_perfil,
                        "c"         =>empty($create[$i])?0:1,
                        "r"         =>empty($read[$i])?0:1,
                        "u"         =>empty($update[$i])?0:1,
                        "d"         =>empty($delete[$i])?0:1,
                        "p"         =>empty($print[$i])?0:1,
                    ];
                    $this->db->saveRoles($data);
                }
                 
                    
            }
            echo json_encode(array("mensaje"=>"Permisos actualizados correctamente"));
           
        } else {
            $data["contenido"] = ERROR_404;
            require_once TEMPLATE;
        }
    }


    // permisos en cada modulo (vista)

    public function getmoduloActual(){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $remainingUrl = $_POST["remainingUrl"];
            $moduloId = $this->db->getModuloIdByURL($remainingUrl);
             echo $moduloId;
            }
        }
    }

?>