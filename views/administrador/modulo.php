<div class="wrapper">
    <!-- .page -->
    <div class="page">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <div class="d-flex flex-column flex-md-row">
                    <p class="lead">
                        <span class="font-weight-bold"><?php echo $data["titulo"]; ?></span>
                    </p>

                    <div class="ml-auto">
                        <button type="button" class="btn btn-flat btn-success" data-toggle="modal" data-target="#modal-modulos" data-backdrop="static" data-keyboard="false">
                            <i class="far fa-save"></i> &nbsp;&nbsp; NUEVO REGISTRO
                        </button>
                    </div>
                </div>
            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <!-- .section-block -->
                <div class="section-block">
                    
                    <div class="card card-fluid">
                        <!-- .card-body -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- .table -->
                                <table class="table">
                                    <!-- thead -->
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Descripción Módulo</th>
                                            <th>URL</th>
                                            <th>Icon font</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cont = 0;
                                        foreach ($data["registros"] as $row) : $cont++; ?>
                                            <?php if ($row["submodulo"] == null) : ?>
                                                <tr style="font-weight:bold;color:blue">
                                                    <td><?php echo $cont; ?></td>
                                                    <td><?php echo $row["descripcion"] ?></td>
                                                    <td><?php echo $row["url"] ?></td>
                                                    <td><?php echo $row["icon"] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-icon btn-secondary" data-toggle="modal" data-target="#modal-modulos" data-backdrop="static" data-keyboard="false" onclick="verModuloId(<?php echo $row['id_modulo']; ?>)">
                                                            <i class="fa fa-pencil-alt"></i>
                                                            <span class="sr-only">Edit</span>
                                                        </button>
                                                        <a href="<?php echo BASE_URL ?>/modulos/eliminarModulo/<?php echo $row["id_modulo"] ?>" class="btn btn-sm btn-icon btn-secondary btn-confirm-delete">
                                                            <i class="far fa-trash-alt"></i>
                                                            <span class="sr-only">Remove</span>
                                                        </a>

                                                    </td>
                                                </tr>
                                            <?php else : ?>
                                                <tr>
                                                    <td><?php echo $cont; ?></td>
                                                    <td style="padding-left:25px;"><?php echo $row["descripcion"] ?></td>
                                                    <td><?php echo $row["url"] ?></td>
                                                    <td><?php echo $row["icon"] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-icon btn-secondary" data-toggle="modal" data-target="#modal-modulos" data-backdrop="static" data-keyboard="false" onclick="verModuloId(<?php echo $row['id_modulo']; ?>)">
                                                            <i class="fa fa-pencil-alt"></i>
                                                            <span class="sr-only">Edit</span>
                                                        </button>
                                                        <a href="<?php echo BASE_URL ?>/modulos/eliminarModulo/<?php echo $row["id_modulo"] ?>" class="btn btn-sm btn-icon btn-secondary btn-confirm-delete">
                                                            <i class="far fa-trash-alt"></i>
                                                            <span class="sr-only">Remove</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table><!-- /.table -->
                            </div><!-- /.table-responsive -->
                        </div><!-- /.card-body -->
                    </div>
                </div><!-- /.section-block -->
            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
</div>


<div class="modal form-modal" id="modal-modulos" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <h4 class="modal-title" id="title">Nuevo Registro</h4>
                    <hr>
                </div>
            </div>
            <form id="formModulos" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Tipo opción:</label>
                        <div class="col-sm-7">
                            <select name="cboOpcion" id="cboOpcion" class="form-control" onchange="showControls()">
                                <option value="1">Módulo</option>
                                <option value="2">Submódulo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="divIcon">
                        <label for="exampleInputEmail1" class="col-sm-4 col-form-label text-right">Icon Font:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="txtIcon" name="txtIcon">
                            <small class="text-danger "><b id="errtxtIcon"></b></small>
                        </div>
                    </div>
                    <div class="form-group row d-none" id="divCCategoria">
                        <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Módulo:</label>
                        <div class="col-sm-7">
                            <select name="cboModulo" id="cboModulo" class="form-control">
                                <?php foreach ($data["modulos"] as $row) : ?>
                                    <option value="<?php echo $row["id_modulo"] ?>"> <?php echo $row["descripcion"] ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger "><b id="errcboCategoria"></b></small>
                        </div>
                    </div>
                    <div class="form-group row d-none" id="divSubCat">
                        <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Url:</label>
                        <div class="col-sm-7">
                            <input type="text" name="txtUrl" id="txtUrl" class="form-control">
                            <small class="text-danger "><b id="errtxtUrl"></b></small>
                        </div>
                    </div>
                    <div class="form-group row" id="divDescripcion">
                        <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Descripción:</label>
                        <div class="col-sm-7">
                            <input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control">
                            <small class="text-danger "><b id="errtxtDescripcion"></b></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="" class="btn btn-width btn-secondary btn-flat">CANCELAR</a>
                    <button type="button" class="btn btn-width btn-success btn-flat" id="btnRegistrar" data-dismiss="modal" onclick="registrarDatos()">REGISTRAR DATOS</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    function showControls() {
        valor = $("#cboOpcion").val();
        if (valor == 1) {
            $("#divCategoria").removeClass("d-none");
            $("#divIcon").removeClass("d-none");
            $("#divCCategoria").addClass("d-none");
            $("#divSubCat").addClass("d-none");
        } else if (valor == 2) {
            $("#divCategoria").addClass("d-none");
            $("#divIcon").addClass("d-none");
            $("#divCCategoria").removeClass("d-none");
            $("#divSubCat").removeClass("d-none");
            $("#errtxtDescripcion").text("");
        }
    }


    function registrarDatos() {
        $.ajax({
            url: "<?php echo BASE_URL; ?>autorizacion/registrarModulos",
            type: "POST",
            data: $("#formModulos").serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);

                if (jsonData.statusCode == 200) {
                    $("#modal-modulos").modal('hide');
                    window.location.href = '<?php echo BASE_URL ?>autorizacion';

                } else if (jsonData.statusCode == 500) {
                    $("#modal-modulos").modal('show');

                    if (jsonData.errores.icon) {
                        $("#errtxtIcon").text(jsonData.errores.icon);
                    } else {
                        $("#errtxtIcon").text("");
                    }

                    if (jsonData.errores.descripcion) {
                        $("#errtxtDescripcion").text(jsonData.errores.descripcion);
                    } else {
                        $("#errtxtDescripcion").text("");
                    }

                    if (jsonData.errores.url) {
                        $("#errtxtUrl").text(jsonData.errores.url);
                    } else {
                        $("#errtxtUrl").text("");
                    }

                }

            }
        });
    }


    function verModuloId(id) {
        $("#title").text("Actualizar Registro");
        $('#cboOpcion').removeAttr('onchange');
        $.ajax({
            url: "<?php echo BASE_URL ?>autorizacion/verModuloID/" + id,
            type: "GET",
            success: function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.data.submodulo == null) {
                    $("#txtDescripcion").val(jsonData.data.descripcion);
                    $("#txtIcon").val(jsonData.data.icon);
                    $("#divCategoria").removeClass("d-none");
                    $("#divIcon").removeClass("d-none");
                    $("#divCCategoria").addClass("d-none");
                    $("#divSubCat").addClass("d-none");
                } else {
                    $("#divCategoria").addClass("d-none");
                    $("#divIcon").addClass("d-none");
                    $("#divCCategoria").removeClass("d-none");
                    $("#divSubCat").removeClass("d-none");
                    $("#errtxtDescripcion").text("");
                    $("#cboOpcion option[value='2']").attr('selected',true);
                    $("#txtDescripcion").val(jsonData.data.descripcion);
                    $("#cboModulo option[value='" + jsonData.data.submodulo + "']").attr("selected", true);
                    $("#txtUrl").val(jsonData.data.url);
                }

                $("#btnRegistrar").text("Actualizar Datos");
                $("#btnRegistrar").attr("onclick", "actualizarDatos('" + jsonData.data.id_modulo + "')");
            }
        });
    }

    function actualizarDatos(id){
        $.ajax({
            url: "<?php echo BASE_URL; ?>autorizacion/actualizarModulos/"+id,
            type: "POST",
            data: $("#formModulos").serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.statusCode == 200) {
                    $("#modal-modulos").modal('hide');
                    window.location.href = '<?php echo BASE_URL ?>autorizacion';

                } else if (jsonData.statusCode == 500) {
                    $("#modal-modulos").modal('show');

                    if (jsonData.errores.icon) {
                        $("#errtxtIcon").text(jsonData.errores.icon);
                    } else {
                        $("#errtxtIcon").text("");
                    }

                    if (jsonData.errores.descripcion) {
                        $("#errtxtDescripcion").text(jsonData.errores.descripcion);
                    } else {
                        $("#errtxtDescripcion").text("");
                    }

                    if (jsonData.errores.url) {
                        $("#errtxtUrl").text(jsonData.errores.url);
                    } else {
                        $("#errtxtUrl").text("");
                    }

                }

            } 
        });
    }
</script>