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
                            <form action="<?php echo BASE_URL;?>paciente/registrarDatos" method="POST"
                                autocomplete="off">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-md-4 control-label"
                                            for="selectEspecialidadDoctor">Especialidad:</label>
                                        <div class="form-group">
                                            <select name="selectorEspe" class="form-control" style="max-width: 200px;"onchange="<?php echo BASE_URL;?>paciente/medicoEspe(this.value)" >
                                                <?php foreach ($data["especialidad"] as $row): ?>
                                                <option value="<?php echo $row["id_especialidad"]; ?>">
                                                    <?php echo $row["nombre"]; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-md-4 control-label" for="selectDoctor">Doctor:</label>
                                        <div class="form-group">
                                            <select name="selectorMedi" class="form-control" style="max-width: 200px;">
                                                <?php foreach ($data["medico"] as $row): ?>
                                                <option value="<?php echo $row["nombre"]; ?>">
                                                    <?php echo $row["nombre"]; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label class="col-md-4 control-label">cupos</label>
                                        <div class="col-md-8">
                                            <input readonly name="txtCupos" type="text" class="form-control"  value <?php ?> >

                                        </div>
                                    </div>
                                </div>

                                <div class="row mx-4">
                                    <div class="d-flex align-items-center col-md-4">
                                        <label class="col-md-4 control-label" for="selectTipoDocumento">Tipo de
                                            documento:</label>
                                        <div class="col-md-8">
                                            <select id="selectTipoDocumento" name="cboTipoDocumento"
                                                class="form-control">
                                                <option value="dni">DNI</option>
                                                <option value="carnet">Carnet</option>
                                                <option value="pasaporte">Pasaporte</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center col-md-4">
                                        <label class="col-md-8 control-label" for="textinput">Numero Documento :</label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="txtNumDocum" type="text" placeholder=""
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mx-4">
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="textinput">Apellido Paterno:</label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="txtApPaterno" type="text" placeholder=""
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="textinput">Apellido Materno:</label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="txtApMaterno" type="text" placeholder=""
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="textinput">Nombres:</label>
                                        <div class="col-md-8">
                                            <input id="textinput" name="txtNombres" type="text" placeholder=""
                                                class="form-control input-md">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mx-4">
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="dateinput">Fecha de
                                            nacimiento:</label>
                                        <div class="col-md-8">
                                            <input id="dateinput" name="dateinput" type="date" placeholder=""
                                                class="form-control input-md">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="selectSexo">Sexo:</label>
                                        <div class="col-md-8">
                                            <select id="selectSexo" name="cboSexo" class="form-control">
                                                <option value="masculino">Masculino</option>
                                                <option value="femenino">Femenino</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label"
                                            for="textinputDireccion">Dirección:</label>
                                        <div class="col-md-8">
                                            <input id="textinputDireccion" name="txtDireccion" type="text"
                                                placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-4">
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label"
                                            for="textinputOcupacion">Ocupación:</label>
                                        <div class="col-md-8">
                                            <input id="textinputOcupacion" name="txtOcupacion" type="text"
                                                placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="selectEstadoCivil">Estado
                                            civil:</label>
                                        <div class="col-md-8">
                                            <select id="selectEstadoCivil" name="cboEstadoCivil" class="form-control">
                                                <option value="soltero">Soltero(a)</option>
                                                <option value="casado">Casado(a)</option>
                                                <option value="divorciado">Divorciado(a)</option>
                                                <option value="viudo">Viudo(a)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="textinputResponsable">Persona
                                            responsable:</label>
                                        <div class="col-md-8">
                                            <input id="textinputResponsable" name="txtResponsable" type="text"
                                                placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-4">
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="selectAlergias">Alergias:</label>
                                        <div class="col-md-8">
                                            <select id="selectAlergias" name="cboAlergias" class="form-control">
                                                <option value="alergia1">Alergia 1</option>
                                                <option value="alergia2">Alergia 2</option>
                                                <option value="alergia3">Alergia 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="selectIntervenciones">Intervenciones
                                            quirúrgicas:</label>
                                        <div class="col-md-8">
                                            <select id="selectIntervenciones" name="cboIntervenciones"
                                                class="form-control">
                                                <option value="intervencion1">Intervención 1</option>
                                                <option value="intervencion2">Intervención 2</option>
                                                <option value="intervencion3">Intervención 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-md-8 control-label" for="selectVacunas">Vacunas
                                            completas:</label>
                                        <div class="col-md-8">
                                            <select id="selectVacunas" name="cboVacunas" class="form-control">
                                                <option value="vacuna1">Vacuna 1</option>
                                                <option value="vacuna2">Vacuna 2</option>
                                                <option value="vacuna3">Vacuna 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <p>Selecionar la fecha y hora de la cita</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <input type="date" class="form-control" id="calendar">
                                                    </div>


                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <input type="time" class="form-control" id="timepicker">
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
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
                              
                            </form>
                        </div><!-- metric column -->

                    </div><!-- /metric row -->
                </div><!-- /.section-block -->

            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
</div>