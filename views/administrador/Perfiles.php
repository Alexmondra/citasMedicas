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
                        <button type="button" class="btn btn-flat btn-success" data-toggle="modal" data-target="#modal-perfiles" data-backdrop="static" data-keyboard="false">
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
                                            <th>#</th>
                                            <th>Imagen</th>
                                            <th>Perfil</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblPerfiles">

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


<div class="modal form-modal" id="modal-perfiles" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <h4 class="modal-title" id="title">Nuevo Registro</h4>
                    <hr>
                </div>
            </div>
            <form id="formPerfiles" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Imagen:</label>
                        <input type="hidden" id="txtImg" name="txtImg">
                        <div class="col-sm-7">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file">
                                <label class="custom-file-label" for="customFile" id="customFile"></label>
                            </div>
                            <small class="text-danger "><b id="errFile"></b></small>
                        </div>
                    </div>
                    <div class="form-group row" id="divIcon">
                        <label for="exampleInputEmail1" class="col-sm-4 col-form-label text-right">Perfil:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="txtPerfil" name="txtPerfil">
                            <small class="text-danger "><b id="errtxtPerfil"></b></small>
                        </div>
                    </div>
                    <div class="form-group row" id="divCCategoria">
                        <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Estado:</label>
                        <div class="col-sm-7">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="chkEstado" name="chkEstado" checked>
                                <label class="form-check-label" for="chkEstado">
                                    Activo/inactivo
                                </label>
                            </div>
                            <small class="text-danger "><b id="errchkEstado"></b></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <!--<a href="" class="btn btn-width btn-secondary btn-flat">CANCELAR</a>-->
                    <button type="button" class="btn btn-width btn-secondary btn-flat" data-dismiss="modal" onclick="limpiarControles()">CANCELAR</button>
                    <button type="button" class="btn btn-width btn-success btn-flat" id="btnRegistrar" data-dismiss="modal" onclick="registrarDatos()">REGISTRAR DATOS</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal form-modal" id="modal-roles" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title">Administración de Roles</h4>
            </div>
            <form id="formRoles">
                <input type="hidden" name="id" id="id" class="form-control">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered bg-light table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Módulos</th>
                                    <th class="text-center col-2">Lectura</th>
                                    <th class="text-center col-2">Registrar</th>
                                    <th class="text-center col-2">Actualizar</th>
                                    <th class="text-center col-2">Eliminar</th>
                                    <th class="text-center col-2">Imprimir</th>
                                </tr>
                            </thead>
                            <tbody id="tblRoles">


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="" class="btn btn-secondary btn-flat btn-width">CANCELAR</a>
                    <button type="button" class="btn btn-success btn-flat btn-width" id="btnRoles" data-dismiss="modal">REGISTRAR ROLES</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        listarDatos();
    })

    function limpiarControles() {
        listarDatos();
        $("#formPerfiles").trigger('reset');
        $("#errFile").text("");
        $("#errtxtPerfil").text("");
        $("#customFile").text("");
        $("#title").text("Nuevo Registro");
        $("#btnRegistrar").text("Nuevo Datos");
        $("#btnRegistrar").attr("onclick", "registrarDatos()");
    }

    function listarDatos() {
        $.ajax({
            url: "<?php echo BASE_URL; ?>autorizacion/verRegistros",
            type: 'POST',
            success: function(response) {
                var jsonData = JSON.parse(response);
                let cont = 0;
                filas = "";

                $.each(jsonData.registros, function(idx, val) {
                    cont++;
                    
                    if (val.estado == 1) {
                        estado = "Activo";
                    } else {
                        estado = "Inactivo";
                    }
                    filas += "<tr> <td>" + cont + "</td>\
                                   <td> <img src='public/perfiles/" + val.imagen + "' width='50' height='50'></td>\
                                   <td>" + val.perfil + "</td>\
                                   <td> Sin permisos asignados</td>\
                                   <td>" + estado + "</td>\
                                   <td> <button type='button' class='btn btn-sm btn-icon btn-secondary' data-toggle='modal' data-target='#modal-roles' data-backdrop='static' data-keyboard='false' onclick='administracionRole(" + val.id_perfil + ")'>\
                                                            <i class='fas fa-chalkboard-teacher'></i>\
                                                            <span class='sr-only'>Permisos</span>\
                                                        </button>\
                                                        <button type='button' class='btn btn-sm btn-icon btn-secondary' data-toggle='modal' data-target='#modal-perfiles' data-backdrop='static' data-keyboard='false' onclick='verPerfilId(" + val.id_perfil + ")'>\
                                                            <i class='fa fa-pencil-alt'></i>\
                                                            <span class='sr-only'>Edit</span>\
                                                        </button>\
                                                        <button type='button' class='btn btn-sm btn-icon btn-secondary' onclick='eliminarPerfilId(" + val.id_perfil + ")'>\
                                                            <i class='far fa-trash-alt'></i>\
                                                            <span class='sr-only'>Edit</span>\
                                                        </button></td>\
                              </tr>";
                });

                $("#tblPerfiles").html(filas);
            }
        });
    }

    function registrarDatos() { 
        $.ajax({
            url: "<?php echo BASE_URL; ?>autorizacion/registrarPerfiles",
            type: "POST",
            // data: $("#formPerfiles").serialize(),
            data: new FormData(document.getElementById('formPerfiles')),
            enctype: 'multipart/form-data',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.statusCode == 200) {
                    $("#modal-perfiles").modal('hide');
                    //window.location.href = '<?php echo BASE_URL ?>/modulos';
                    listarDatos();
                    Swal.fire({
                        width: 450,
                        timer: 6000,
                        timerProgressBar: true,
                        title: "Confirmación",
                        text: "Datos registrados correctamente",
                        icon: "success",
                        confirmButtonText: 'Aceptar'
                    });

                } else if (jsonData.statusCode == 500) {
                    $("#modal-perfiles").modal('show');

                    if (jsonData.errores.imagen) {
                        $("#errFile").text(jsonData.errores.imagen);
                    } else {
                        $("#errFile").text("");
                    }

                    if (jsonData.errores.perfil) {
                        $("#errtxtPerfil").text(jsonData.errores.perfil);
                    } else {
                        $("#errtxtPerfil").text("");
                    }
                }
            }
        });
    }


    function verPerfilId(id) {
        $("#title").text("Actualizar Registro");
        $("#btnRegistrar").text("Actualizar Datos");

        $.ajax({
            url: "<?php echo BASE_URL ?>autorizacion/verPerfilID/" + id,
            type: "POST",
            success: function(response) {
                var jsonData = JSON.parse(response);
                $("#customFile").text(jsonData.data.imagen)
                $("#txtPerfil").val(jsonData.data.perfil);
                if (jsonData.data.estado == 1) {
                    $("#chkEstado").prop("checked", true);
                } else {
                    $("#chkEstado").prop("checked", false);
                }

                $("#txtImg").val(jsonData.data.imagen);

                $("#btnRegistrar").attr("onclick", "actualizarDatos('" + jsonData.data.id_perfil + "')");
            }
        });
    }

    function actualizarDatos(id) {
        $.ajax({
            url: "<?php echo BASE_URL; ?>autorizacion/actualizarPerfiles/" + id,
            type: "POST",
            // data: $("#formPerfiles").serialize(),
            data: new FormData(document.getElementById('formPerfiles')),
            enctype: 'multipart/form-data',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.statusCode == 200) {
                    $("#modal-perfiles").modal('hide');
                    //window.location.href = '<?php echo BASE_URL ?>/modulos';
                    listarDatos();
                    Swal.fire({
                        width: 450,
                        timer: 6000,
                        timerProgressBar: true,
                        title: "Confirmación",
                        text: "Datos actualizados correctamente",
                        icon: "success",
                        confirmButtonText: 'Aceptar'
                    });

                } else if (jsonData.statusCode == 500) {
                    $("#modal-perfiles").modal('show');

                    if (jsonData.errores.imagen) {
                        $("#errFile").text(jsonData.errores.imagen);
                    } else {
                        $("#errFile").text("");
                    }

                    if (jsonData.errores.perfil) {
                        $("#errtxtPerfil").text(jsonData.errores.perfil);
                    } else {
                        $("#errtxtPerfil").text("");
                    }
                }
            }
        });
    }

    function eliminarPerfilId(id) {

        Swal.fire({
            width: 450,
            title: 'Confirmación',
            text: "¿Estás segurdo de eliminar el registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo BASE_URL ?>autorizacion/eliminarPerfil/' + id,
                    type: 'post',
                    success: function(response) {
                        var jsonData = JSON.parse(response);
                        listarDatos();
                        Swal.fire({
                            width: 450,
                            timer: 6000,
                            timerProgressBar: true,
                            title: "Confirmación",
                            text: jsonData.mensaje,
                            icon: "success",
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            }
        })
    }


    function administracionRole(id_perfil) { 
        $.ajax({ 
            url: '<?php echo BASE_URL ?>autorizacion/administracionR/' + id_perfil,
            type: 'post',
            success: function(response) {
                var jsonDate = JSON.parse(response);
                console.log(jsonDate);
                $("#btnRoles").attr("onclick", "registrarRoles('" + id_perfil + "')");
                $("#tblRoles").html(jsonDate.modulos);
            }
        });

    }

    function registrarRoles(id_perfil) {
        $.ajax({
            url: "<?php echo BASE_URL; ?>autorizacion/actualizarRoles/" + id_perfil,
            type: "post",
            data: $("#formRoles").serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);
                listarDatos();
                Swal.fire({
                    width: 450,
                    timer: 6000,
                    timerProgressBar: true,
                    title: "Confirmación",
                    text: jsonData.mensaje,
                    icon: "success",
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    }
</script>