<div class="wrapper">
    <!-- .page -->
    <div class="page">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <div class="d-flex flex-column flex-md-row">
                    <p class="lead">
                        <span class="font-weight-bold"><?php echo $data["titulo"]?></span>
                        <!--<span class="d-block text-muted">Here’s what’s happening with your business today.</span>-->
                    </p>
                    <div class="ml-auto">
                        <!-- .dropdown -->
                        <div class="dropdown">
                        </div><!-- /.dropdown -->
                    </div>
                </div>
            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <!-- .section-block -->
                <div class="section-block">
                    <!-- metric row -->
                    <div class="metric-row">
                        <div class="col-lg-12">
                            <form
                                action="<?php echo BASE_URL;?>userdatos/editar/<?php echo $data["datos"]["id_usuario"]?>"
                                method="POST" autocomplete="off" onsubmit="return validarFormulario()">
                                <div class="row mx-4">
                                    <div class="d-flex align-items-center col-md-4">
                                        <label class="col-md-4 control-label" for="selectTipoDocumento">Tipo de
                                            documento:</label>
                                        <div class="col-md-8">
                                            <select id="selectTipoDocumento" name="selectTipoDocumento"
                                                class="form-control">
                                                <option value="1"
                                                    <?php echo($data["datos"]["tipo_documento"]=='1')? "selected" :"";?>>
                                                    DNI
                                                </option>
                                                <option value="2"
                                                    <?php echo($data["datos"]["tipo_documento"]=='2')? "selected" :"";?>>
                                                    carnet</option>
                                                <option value="3"
                                                    <?php echo($data["datos"]["tipo_documento"]=='3')? "selected" :"";?>>
                                                    pasaporte</option>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center col-md-4">
                                        <label class="col-md-8 control-label" for="textinput">Numero Documento :</label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="txtNumDocum" type="text"
                                                value="<?php echo $data["datos"]["numero_documento"]?>"
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mx-4">
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="textinput">Apellido Paterno:</label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="txtApPaterno" type="text"
                                                value="<?php echo $data["datos"]["apellido_p"]?>"
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="textinput">Apellido Materno:</label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="txtApMaterno" type="text"
                                                value="<?php echo $data["datos"]["apellido_m"]?>"
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="textinput">Nombres:</label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="txtNombres" type="text"
                                                value="<?php echo $data["datos"]["nombre"]?>"
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mx-4">
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="dateinput">Fecha de
                                            nacimiento:</label>
                                        <div class="col-md-8">
                                            <input readonly id="dateinput" name="dateinput" type="date"
                                                value="<?php echo $data["datos"]["fecha_nacimiento"]?>"
                                                class="form-control input-md">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="selectSexo">Sexo:</label>
                                        <div class="col-md-8">
                                            <select id="selectSexo" name="cboSexo" class="form-control">
                                                <option value="M"
                                                    <?php echo( $data["datos"]["sexo"]=='M')? "selected" :"";?>>
                                                    MASCULINO
                                                </option>
                                                <option value="F"
                                                    <?php echo($data["datos"]["sexo"]=='F')? "selected" :"";?>>
                                                    FEMENINO</option>
                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label"
                                            for="textinputDireccion">Dirección:</label>
                                        <div class="col-md-8">
                                            <input id="textinputDireccion" name="txtDireccion" type="text"
                                                value="<?php echo $data["datos"]["direccion"]?>"
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-4">
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="textinputOcupacion">Telefono:</label>
                                        <div class="col-md-8">
                                            <input id="numberTelefono" name="numberTelefono" type="number"
                                                value="<?php echo $data["datos"]["telefono"]?>"
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="selectEstadoCivil">Estado
                                            civil:</label>
                                        <div class="col-md-8">
                                            <input id="textEstadoCiv" name="textEstadoCiv" type="text"
                                                value="<?php echo $data["datos"]["estado_civil"]?>"
                                                class="form-control input-md">

                                        </div>
                                    </div>

                                </div>

                                <div class="container-fluid"> <br> <br>
                                    <div class="row mx-4">
                                        <div class="d-flex align-items-center col-md-4">
                                            <label class="col-md-4 control-label"
                                                for="selectTipoDocumento">usuario</label>
                                            <div class="col-md-8">
                                                <input id="txtUser" name="txtUser" type="text"
                                                    value="<?php echo $data["datos"]["usuario"]?>"
                                                    class="form-control input-md">
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center col-md-4">
                                            <label class="col-md-8 control-label" for="textinput">new password</label>
                                            <div class="col-md-8">
                                                <input id="txtpassw" name="txtpassw" type="password"
                                                    class="form-control input-md">
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-8">
                                    <label class="col-md-4 control-label" for="button1id"></label>
                                    <div class="col-md-6">
                                        <input type="submit" value="ACTULAZAR DATOS" class="btn btn-success"
                                            onchange="">
                                        <a href="<?php echo BASE_URL?>cpanel" class="btn btn-danger">CANCELAR
                                        </a>
                                    </div>
                                </div>

                            </form>
                        </div><!-- metric column -->

                    </div><!-- /metric row -->
                </div><!-- /.section-block -->

            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
</div>

<script>
function validarFormulario() {
    const passwordValue = document.getElementById("txtpassw").value;

    if (passwordValue.trim() === "") {
        document.getElementById("txtpassw").value = "<?php echo $data['datos']['clave']; ?>";
    }

    return true;
}
</script>