<?php

require_once "ValController.php";
require_once "models/PacienteModel.php";

class PacienteController {
    protected $paciente;
    protected $validation;
    protected $errores;

    public function __construct() {
        session_start();
        $this->paciente = new PacienteModel();
        $this->validation = new ValController();
        $this->errores = array();

        $data_session = [
            "user_modulos"  => ""
        ];
            $_SESSION["session"] = $data_session;
      
    }


    public function index() {
        $data = array(
            "contenido" => "views/pacientes/frmRegistrar.php",
            "titulo" => "Formulario de registro",
            "especialidad" => $this->paciente->getAllEspecialidad()
        );
        require_once TEMPLATE;
    }

    public function getMedicos($id_espec) {
        $medicos = $this->paciente->getMedicosPorEspecialidad($id_espec);
        echo json_encode($medicos);
    }

    public function getCupos() {
        if (isset($_POST['medicoId']) && isset($_POST['fecha'])) {
            $id = $_POST['medicoId'];
            $fecha = $_POST['fecha'];
            $data = $this->paciente->getCuposDisponibles($id, $fecha);
            echo json_encode(array("data" => $data));
        } else {
            $data["contenido"] = ERROR_404;
            require_once TEMPLATE;   
        }
    }

    public function precios($id_especialidad)
    {
        $precioActual = $this->paciente->obtenerPrecioActualEspecialidad($id_especialidad);
        echo json_encode(array("precio" => $precioActual));
    }
    

    public function buscar($dni) {
        $data = $this->paciente->getPersonaDni($dni);
        echo json_encode(array("data" => $data));
    }


    




    public function registrarDatos() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //datos de persona  
            $txtApellidoPaterno = $_POST["txtApellidoPaterno"];
            $txtApellidoMaterno = $_POST["txtApellidoMaterno"];
            $txtNombre = $_POST["txtNombre"];
            $txtFechaNacimiento = $_POST["txtFechaNacimiento"];
            $cboSexo = $_POST["cboSexo"];
            $txtDireccion = $_POST["txtDireccion"];
            $cboEstadoCivil = $_POST["cboEstadoCivil"];
            $tipo_documento = $_POST["tipo_documento"];
            $numeroDocumento = $_POST["txtNumeroDocumento"];
            $telefono = $_POST["txtTelefono"];

            // datos de paciente 

            $ocupacion =$_POST["txtOcupacion"];
            $alergias = $_POST["txtAlergias"];
            $descripcion_Ale = $_POST["txtDescripcion"];
            

            // datos de cita

             $persona_R = $_POST["txtResponsable"];
             $intervenciones = $_POST["txtIntervenciones"];
             $vacunas = $_POST["txtVacunasCompletas"];
             $fecha_cita = $_POST["txtFechaCita"];
             $especialidad = $_POST["selectorEspe"];
             $precio = $_POST["txtPrecio"]; 
             $numero_pers_res = $_POST["txtnumeroPersRes"];
             $detalle_con = $_POST["txtDetalle"];

            // Validar campos persona
            $this->validarCampoRequerido($txtApellidoPaterno, "Apellido Paterno");
            $this->validarCampoRequerido($txtApellidoMaterno, "Apellido Materno");
            $this->validarNombre($txtNombre);
            $this->validarCampoRequerido($txtFechaNacimiento, "Fecha de Nacimiento");
            $this->validarCampoRequerido($cboSexo, "Sexo");
            $this->validarCampoRequerido($txtDireccion, "Dirección");
            $this->validarCampoRequerido($cboEstadoCivil, "Estado Civil");
            $this->validarCampoRequerido($tipo_documento, "Tipo de Documento");
            $this->validarCampoRequerido($numeroDocumento, "Número de Documento");
            $this->validarCampoRequerido($telefono, "telefono");

            //valida paciente 
            $this->validarCampoRequerido($ocupacion, "Ocupación");
            $this->validarCampoRequerido($alergias, "Alergias");
            $this->validarCampoRequerido($descripcion_Ale, "descripcion de las alergias");


            // valdia cita

            $this->validarCampoRequerido($persona_R, "Persona Responsable");
            $this->validarCampoRequerido($intervenciones, "Intervenciones");
            $this->validarCampoRequerido($vacunas, "Vacunas Completas");
            $this->validarCampoRequerido($especialidad, "especialidad");
            //$this->validarCampoRequerido($precio, "precio");
            $this->validarCampoRequerido($numero_pers_res, "numero de persona respondable");
            $this->validarCampoRequerido($detalle_con, "detalle de la cita");

            if ($this->errores) {
                $data =[
                    "contenido" => "views/pacientes/frmRegistrar.php",
                    "titulo" => "Formulario de registro",
                    "especialidad" => $this->paciente->getAllEspecialidad(),
                    "errores" => $this->errores
                ];
                require_once TEMPLATE;
            } else {
                // Arreglo asociativo de los datos enviados por POST
                $datosCombinados = [
                    "persona_responsable" => $personaResponsable,
                    "intervenciones" => $intervenciones,
                    "vacunas_completas" => $vacunasCompletas,
                    "fecha_cita" => $fechaCita,
                    "ocupacion" => $ocupacion,
                    "alergias" => $alergias,
                    "descripcion_Ale" => $descripcion_Ale,
                    "tipo_documento" => $tipo_documento,
                    "numero_documento" => $numeroDocumento,
                    "apellido_p" => $txtApellidoPaterno,
                    "apellido_m" => $txtApellidoMaterno,
                    "nombre" => $txtNombre,
                    "fecha_nacimiento" => $txtFechaNacimiento,
                    "sexo" => $cboSexo,
                    "direccion" => $txtDireccion,
                    "estado_civil" => $cboEstadoCivil,
                    "especialidad" => $selectorEspe,
                    "precio" => $txtPrecio,
                    "numero_pers_res" => $txtnumeroPersRes,
                    "detalle_con" => $txtDetalle
                ];

                $datosCita = array(
                    "persona_responsable" => $personaResponsable,
                    "intervenciones" => $intervenciones,
                    "vacunas_completas" => $vacunasCompletas,
                    "fecha_cita" => $fechaCita,
                    "especialidad" => $selectorEspe,
                    "precio" => $txtPrecio,
                    "numero_pers_res" => $txtnumeroPersRes,
                    "detalle_con" => $txtDetalle
                );

               if (empty($_POST['idPaciente'])){
                $this->paciente->saveNuevo($datosCombinados);
               }else{
                $this->paciente->saveCita($datosCita);
               }
                


                $_SESSION["mensaje"] = "Datos registrados correctamente";

                $url = BASE_URL . "paciente";
                header("Location: $url");
            }
        } else {
            $data["contenido"] = ERROR_404;
            require_once TEMPLATE;
        }
    }

    private function validarCampoRequerido($valor, $nombreCampo) {
        if (empty($valor)) {
            $this->errores[$nombreCampo] = "El campo $nombreCampo es requerido.";
        }
    }

    private function validarNombre($valor)
    {
        $opciones = array(
            "options" => array(
                "min_range" => 3,
                "max_range" => 10
            )
        );
        if (!$this->validation->validarRequeridos($valor)) {
            $this->errores["nombre"] = "Debe ingresar un nombre de usuario";
        } else if (!$this->validation->validarLongitudes($valor, $opciones)) {
            $this->errores["nombre"] = "longitud de caracteres permitido: [3-10]";
        }
        return $this->errores;
    }

    



    /// reprogramar 

    public function reprogramar() {
        $data = array(
            "contenido" => "views/pacientes/reprogramacion.php",
            "titulo" => "Reprogramación de citas",
        );
        require_once TEMPLATE;
    }

    public function resultados() {
        $data = array(
            "contenido" => "views/pacientes/resultados.php",
            "titulo" => "RESULTADOS",
        );
        require_once TEMPLATE;
    }

}
