<div class="wrapper">
    <div class="page">
        <div class="page-inner">
            <header class="page-title-bar">
                <div class="d-flex flex-column flex-md-row">
                    <p class="lead">
                        <span class="font-weight-bold"><?php echo $data["titulo"]?></span>
                    </p>
                    <div class="ml-auto">
                        <div class="dropdown">
                        </div>
                    </div>
                </div>
            </header>
            <div class="page-section">
                <div class="section-block">
                    <div class="metric-row">
                        <div class="col-lg-12">
                            <form class="form-horizontal" action="<?php echo BASE_URL;?>paciente/registrarDatos"
                                method="POST" autocomplete="off">
                                <div class="container-fluid">
                                    <p>Seleccionar la fecha y hora de la cita</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="date" name="txtFechaCita" class="form-control"
                                                            id="txtFechaCita" min="<?php echo date('Y-m-d'); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="time" name="txtHora" class="form-control"
                                                            id="timepicker">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="col-md-4 control-label"
                                            for="selectEspecialidadDoctor">Especialidad:</label>
                                        <div class="form-group">
                                            <select name="selectorEspe" class="form-control" style="max-width: 200px;"
                                                onchange="getMedicos(this.value)">
                                                <?php foreach ($data["especialidad"] as $row): ?>
                                                <option value="<?php echo $row["id_especialidad"]; ?>">
                                                    <?php echo $row["nombre"]; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-md-4 control-label" for="selectDoctor">Doctor:</label>
                                        <div class="form-group">
                                            <select name="selectorMedi" class="form-control" style="max-width: 200px;"
                                                onchange="getcupos(this.value, document.getElementById('txtFechaCita').value)">
                                                <?php foreach ($data["medico"] as $row): ?>
                                                <option value="<?php echo $row["id_medico"]; ?>">
                                                    <?php echo $row["nombre"]; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="col-md-4 control-label">Cupos:</label>
                                        <div class="col-md-8">
                                            <input readonly name="txtCupos" type="number" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="col-md-4 control-label">Precio:</label>
                                        <div class="col-md-8">
                                            <input readonly name="txtPrecio" type="number" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                </div>

                                <div id="seccionAdicional" style="display: none;">

                                    <div class="row mx-4">
                                        <div class="d-flex align-items-center col-md-4">
                                            <label class="col-md-4 control-label" for="selectTipoDocumento">Tipo de
                                                documento:</label>
                                            <div class="col-md-8">
                                                <select id="cboTipoDocumento" name="cboTipoDocumento"
                                                    class="form-control">
                                                    <option value="dni">DNI</option>
                                                    <option value="carnet">Carnet</option>
                                                    <option value="pasaporte">Pasaporte</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center col-md-4">
                                            <label class="col-md-8 control-label" for="textinput">Numero
                                                Documento:</label>
                                            <div class="col-md-8">
                                                <input id="txtNumeroDocumento" name="txtNumeroDocumento" type="text"
                                                    class="form-control input-md" oninput="buscarDatos(event)">

                                                <?php if (isset($data["errores"]["Número de Documento"])) : ?>
                                                <div style="color:red">
                                                    <?php echo $data["errores"]["Número de Documento"] ?>
                                                </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-4">
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="textinput">Apellido
                                                Paterno:</label>
                                            <div class="col-md-8">
                                                <input type="text" name="txtApellidoPaterno" id="txtApellidoPaterno"
                                                    class="form-control input-md">
                                                <?php if (isset($data["errores"]["Apellido Paterno"])) : ?>
                                                <div style="color:red">
                                                    <?php echo $data["errores"]["Apellido Paterno"] ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="textinput">Apellido
                                                Materno:</label>
                                            <div class="col-md-8">
                                                <input id="txtApellidoMaterno" name="txtApellidoMaterno" type="text"
                                                    class="form-control input-md">
                                                <?php if (isset($data["errores"]["Apellido Materno"])) : ?>
                                                <div style="color:red">
                                                    <?php echo $data["errores"]["Apellido Materno"] ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="textinput">Nombres:</label>

                                            <input id="txtNombre" name="txtNombre" type="text" placeholder=""
                                                class="form-control input-md">
                                            <?php if (isset($data["errores"]["nombre"])) : ?>
                                            <div style="color:red">
                                                <?php echo $data["errores"]["nombre"] ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row mx-4">
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="dateinput">Fecha de
                                                nacimiento:</label>
                                            <div class="col-md-8">
                                                <input id="txtFechaNacimiento" name="txtFechaNacimiento" type="date"
                                                    placeholder="" class="form-control input-md">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="selectSexo">Sexo:</label>
                                            <div class="col-md-8">
                                                <select id="cboSexo" name="cboSexo" class="form-control">
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label"
                                                for="textinputDireccion">Dirección:</label>
                                            <div class="col-md-8">
                                                <input id="txtDireccion" name="txtDireccion" type="text" placeholder=""
                                                    class="form-control input-md">
                                                <?php if (isset($data["errores"]["Dirección"])) : ?>
                                                <div style="color:red">
                                                    <?php echo $data["errores"]["Dirección"] ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-4 d-flex align-items-center">
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="selectEstadoCivil">Estado
                                                civil:</label>
                                            <div class="col-md-8">
                                                <select id="cboEstadoCivil" name="cboEstadoCivil" class="form-control">
                                                    <option value="soltero">Soltero(a)</option>
                                                    <option value="casado">Casado(a)</option>
                                                    <option value="divorciado">Divorciado(a)</option>
                                                    <option value="viudo">Viudo(a)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label"
                                                for="textinputDireccion">Telefono:</label>
                                            <div class="col-md-8">
                                                <input id="txtTelefono" name="txtTelefono" type="text"
                                                    class="form-control input-md">
                                                <?php if (isset($data["errores"]["Número de Document"])) : ?>
                                                <div style="color:red">
                                                    <?php echo $data["errores"]["Número de Document"] ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label">
                                                <div class="col-md-8">
                                                    <input type="file" class="custom-file-input" id="file" name="file">
                                                    <label class="custom-file-label" for="customFile"
                                                        id="customFile"></label>
                                                </div>
                                            </label>
                                            <small class="text-danger"><b id="errFile"></b></small>
                                        </div>
                                    </div>


                                    <div class="row mx-4">
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label"
                                                for="textinputOcupacion">Ocupación:</label>
                                            <div class="col-md-8">
                                                <input id="txtOcupacion" name="txtOcupacion" type="text"
                                                    class="form-control input-md">
                                                <?php if (isset($data["errores"]["Ocupación"])) : ?>
                                                <div style="color:red">
                                                    <?php echo $data["errores"]["Ocupación"] ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="selectAlergias">Alergias:</label>
                                            <div class="col-md-8">
                                                <select id="txtAlergias" name="txtAlergias" class="form-control">
                                                    <option value="1">si</option>
                                                    <option value="2">no </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="textinputOcupacion">Descripcion
                                                Alergia:</label>
                                            <div class="col-md-8">
                                                <input id="txtDescripcion" name="txtDescripcion" type="text"
                                                    class="form-control input-md">
                                                <?php if (isset($data["errores"]["descripcion de las alergias"])) : ?>
                                                <div style="color:red">
                                                    <?php echo $data["errores"]["descripcion de las alergias"] ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="row mx-4">
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="textinputResponsable">Persona
                                                responsable:</label>
                                            <div class="col-md-8">
                                                <input id="txtResponsable" name="txtResponsable" type="text"
                                                    class="form-control input-md">
                                                <?php if (isset($data["errores"]["Persona Responsable"])) : ?>
                                                <div style="color:red">
                                                    <?php echo $data["errores"]["Persona Responsable"] ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="textinputResponsable">numero
                                                respondable</label>
                                            <div class="col-md-8">
                                                <input id="txtnumeroPersRes" name="txtnumeroPersRes" type="text"
                                                    class="form-control input-md">
                                                <?php if (isset($data["errores"]["numero de persona respondable"])) : ?>
                                                <div style="color:red">
                                                    <?php echo $data["errores"]["numero de persona respondable"] ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="selectVacunas">Vacunas
                                                completas:</label>
                                            <div class="col-md-8">
                                                <select id="txtVacunasCompletas" name="txtVacunasCompletas"
                                                    class="form-control">
                                                    <option value="1">si</option>
                                                    <option value="2">no</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mx-4">
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label"
                                                for="selectIntervenciones">Intervenciones
                                                quirúrgicas:</label>
                                            <div class="col-md-8">
                                                <input id="txtIntervenciones" name="txtIntervenciones" type="text"
                                                    class="form-control input-md">
                                                <?php if (isset($data["errores"]["Intervenciones"])) : ?>
                                                <div style="color:red">
                                                    <?php echo $data["errores"]["Intervenciones"] ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-8 control-label" for="selectVacunas">detalle de
                                                consulta</label>
                                            <input id="txtDetalle" name="txtDetalle" type="text"
                                                class="form-control input-md">
                                            <?php if (isset($data["errores"]["detalle de la cita"])) : ?>
                                            <div style="color:red">
                                                <?php echo $data["errores"]["detalle de la cita"] ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="col-md-4 control-label" for="button1id"></label>
                                        <div class="col-md-6">
                                            <input type="submit" value="REGISTRAR DATOS" class="btn btn-success">
                                            <a href="<?php echo BASE_URL?>paciente" class="btn btn-danger">CANCELAR
                                                REGISTRO</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
const fechaCitaInput = document.getElementById('txtFechaCita');
const fechaActual = new Date().toISOString().slice(0, 10);
fechaCitaInput.value = fechaActual;


function getMedicos(especialidadId) {
    $.ajax({
        url: '<?php echo BASE_URL; ?>paciente/getMedicos/' + especialidadId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var selectMedicos = document.getElementsByName('selectorMedi')[0];
            selectMedicos.innerHTML = '';

            for (var i = 0; i < data.length; i++) {
                var option = document.createElement('option');
                option.value = data[i].id_medico;
                option.text = data[i].nombre;
                selectMedicos.appendChild(option);
            }

            $.ajax({
                    url: '<?php echo BASE_URL; ?>paciente/precios/' + especialidadId, 
                    type: 'GET', 
                    dataType: 'json',
                    success: function (response) {
                        $('input[name="txtPrecio"]').val(response.precio.precio);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error al obtener el precio de la especialidad:', error);
                    }
                });

            const medicoId = selectMedicos.value;
            const fechaCita = document.getElementById('txtFechaCita').value;
            getcupos(medicoId, fechaCita);
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener la lista de médicos:', error);
        }
    });
}


fechaCitaInput.addEventListener('change', function() {
    const nuevaFechaCita = fechaCitaInput.value;
    const selectorMedi = document.getElementsByName('selectorMedi')[0];
    const medicoId = selectorMedi.value;
    getcupos(medicoId, nuevaFechaCita);
});

function getcupos(medicoId, fecha) {
    $.ajax({
        url: '<?php echo BASE_URL ?>paciente/getCupos/',
        type: 'POST',
        data: {
            medicoId: medicoId,
            fecha: fecha
        },
        dataType: 'json',
        success: function(data) {
            const cupos = parseInt(data.data);
            $('input[name="txtCupos"]').val(cupos);
            const seccionAdicional = document.getElementById('seccionAdicional');
            if (cupos > 0) {
                seccionAdicional.style.display = 'block';
            } else {
                seccionAdicional.style.display = 'none';
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los cupos disponibles:', error);
        }
    });
}

function limpiarCasillas() {
    $("#txtApellidoPaterno").val("").prop('readonly', false);
    $("#txtApellidoMaterno").val("").prop('readonly', false);
    $("#txtNombre").val("").prop('readonly', false);
    $("#txtFechaNacimiento").val("").prop('readonly', false);
    $("#cboSexo").val("").prop('disabled', false);
    $("#txtDireccion").val("").prop('readonly', false);
    $("#cboEstadoCivil").val("").prop('disabled', false);
    $("#txtTelefono").val("").prop('disabled', false);
    $("#file").val("");
}

function buscarDatos(event) {
    const numeroDocumento = document.getElementById('txtNumeroDocumento').value;
    if (numeroDocumento.length === 8) {

        limpiarCasillas();
        $.ajax({
            url: "<?php echo BASE_URL ?>paciente/buscar/" + numeroDocumento,
            type: "GET",
            success: function(response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                $("#txtApellidoPaterno").val(jsonData.data.apellido_p).prop('readonly', true);
                $("#txtApellidoMaterno").val(jsonData.data.apellido_m).prop('readonly', true);
                $("#txtNombre").val(jsonData.data.nombre).prop('readonly', true);
                $("#txtFechaNacimiento").val(jsonData.data.fecha_nacimiento).prop('readonly', true);
                $("#cboSexo").val(jsonData.data.sexo).prop('disabled',
                    true);
                $("#txtDireccion").val(jsonData.data.direccion).prop('readonly', true);
                $("#cboEstadoCivil").val(jsonData.data.estado_civil).prop('disabled',
                    true);
                $("#txtTelefono").val(jsonData.data.telefono).prop('readonly', true);
                $("#file").val(jsonData.data.img);
            }
        });

    } else {
        if (txtNombre.readOnly) {
            limpiarCasillas();
        }
    }
}
</script>