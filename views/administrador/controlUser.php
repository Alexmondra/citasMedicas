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
                    </p>

                    <div class="ml-auto">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#edit-modal" data-backdrop="static" data-keyboard="false">
                            <i class="fas fa-user-plus"></i> &nbsp;&nbsp; NUEVO USUARIO
                        </button>
                    </div>
                </div>
                <div class="d-flex flex-column flex-md-row">
                    <div id="tabla_usuario_length"><label>Mostrar <select name="tabla_usuario_length"
                                aria-controls="tabla_usuario" class="form-control-sm mr-2">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> registros</label>
                    </div>
                    <div class="ml-auto">
                        <input type="text" class="form-control" id="buscar" placeholder="Buscar">
                    </div>

                </div>

            </header><!-- /.page-title-bar -->
            <!-- .page-section -->

            <div class="section-block">
                <!-- metric row -->
                <div class="metric-row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <!-- .table -->
                            <table id="tabla_usuario" class="display table-bordered" style="width:100%">
                                <!-- thead -->
                                <thead class="thead-">
                                    <tr>
                                        <th> # </th>
                                        <th> nombre</th>
                                        <th> DNI</th>
                                        <th> tipo usuario </th>
                                        <th> Estado</th>
                                        <th> Opciones </th>
                                    </tr>
                                </thead><!-- /thead -->
                                <!-- tbody -->
                                <tbody>
                                    <?php $cont=0; foreach($data["usuarios"] as $row): $cont++;?>
                                    <tr>
                                        <td><?php echo $cont;?></td>
                                        <td><?php echo $row["nombre"]?></td>
                                        <td><?php echo $row["dni"]?></td>
                                        <td> <?php echo $row["rol"]?></td>
                                        <th>
                                            <?php if ($row["estado"] == "1"){ ?>
                                            <span class="badge badge-success badge-pill m-r-5 m-b-5">ACTIVO</span>
                                            <?php }else { ?>
                                            <span class="badge badge-danger badge-pill m-r-5 m-b-5">INACTIVO</span>
                                            <?php } ?>
                                        </th>

                                        <th>
                                            <button class="btn btn-sm btn-icon btn-secondary" data-toggle="modal"
                                                data-target="#edit-modal" data-backdrop="static" data-keyboard="false">
                                                <i class="fas fa-user-edit"></i>
                                                <span class="sr-only">Edit</span>
                                            </button>

                                            <a href="<?php echo BASE_URL ?>/administrador/eliminar/<?php echo $row["id"] ?>"
                                                class="btn btn-sm btn-icon btn-secondary btn-confirm-delete">
                                                <i class="fas fa-trash-alt"></i>
                                                <span class="sr-only">Remove</span>
                                            </a>
                                            <?php if ($_SESSION["session"]["user_permisos"]  = "c" ){ ?>
                                                <?php if ($row["estado"] == "1"){ ?>
                                                <a href="<?php echo BASE_URL ?>/administrador/inhabilitar/<?php echo $row["id"] ?>"
                                                    class="btn btn-sm btn-icon btn-secondary">
                                                    <i class="fas fa-user-slash"></i>
                                                    <span class="sr-only">inabilitar</span>
                                                </a>
                                            <?php }else { ?>
                                                <a href="<?php echo BASE_URL ?>/administrador/habilitar/<?php echo $row["id"] ?>"
                                                    class="btn btn-sm btn-icon btn-secondary">
                                                    <i class="fas fa-user"></i>
                                                    <span class="sr-only">inabilitar</span>
                                                </a> 
                                            <?php } ?>
                                            <?php } ?>






                                            </td>

                                    </tr>
                                    <?php endforeach?>
                                </tbody><!-- /tbody -->
                            </table><!-- /.table -->
                        </div>
                    </div><!-- metric column -->
                </div><!-- /metric row -->
            </div><!-- /.section-block -->
        </div><!-- /.page-section -->
    </div><!-- /.page-inner -->
</div><!-- /.page -->
</div>



<div class="modal fade" id="edit-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST">
                    <div class="col-md-8">
                        <label for="validationDefault01" class="form-label">NOMBRE COMPLETO </label>
                        <input type="text" class="form-control" id="validationDefault01" value="Mark">
                    </div>
                    <div class="col-md-6">
                        <label for="validationDefault02" class="form-label">USUARIO</label>
                        <input type="text" class="form-control" id="validationDefault02">
                    </div>
                    <div class="col-md-6">
                        <label for="validationDefault03" class="form-label">DIRECCION</label>
                        <input type="text" class="form-control" id="validationDefault03" required>
                    </div>
                    <div class="col-md-3">
                        <label for="validationDefault05" class="form-label">ESPECIALIDADES</label>
                        <input type="text" class="form-control" id="validationDefault05" required>
                    </div>

                    <div class="col-md-3">
                        <label for="validationDefault04" class="form-label">State</label>
                        <select class="form-select" id="validationDefault04" required>
                            <option value="1">ACTIVO</option>
                            <option value="0">INACTIVO</option>

                        </select>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <a href="" class="btn btn-width btn-secondary btn-flat">CANCELAR</a>
                        <button type="button" class="btn btn-width btn-success btn-flat" id="btnRegistrar"
                            data-dismiss="modal" onclick="registrataDatos()">REGISTRAR DATOS</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function() {
        $("#nuevo-registro-btn").click(function() {
            $("#form-nuevo").toggle();
            var btn = document.getElementById('nuevo-registro-btn');
            var icono = document.getElementById('icono-registro');
            if (btn.classList.contains('clicleado')) {
                btn.classList.remove('clicleado');
                icono.classList.remove('fa-eye-slash');
                icono.classList.add('fa-save');
            } else {
                btn.classList.add('clicleado');
                icono.classList.remove('fa-save');
                icono.classList.add('fa-eye-slash');
            }
        });
    });


    function verHorario(token) {
        $.ajax({
            url: "<?php echo BASE_URL ?>medico/verhorario/" + token,
            type: "GET",
            success: function(response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                $("#txtFecha").val(jsonData.data.fecha);
                $("#txtHoInicio").val(jsonData.data.hora_inicio);
                $("#txtHoFin").val(jsonData.data.hora_fin);
                $("#txtCupos").val(jsonData.data.cupos);

                $("#btnRegistrar").attr("onclick", "actualizarDatos('" + jsonData.data.token + "')");
            }

        });
    }

    function actualizarDatos(token) {
        console.log(token);
        $.ajax({
            url: "<?php echo BASE_URL; ?>medico/actualizarhorario/" + token,
            type: "POST",
            data: $("#formModulos").serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                if (jsonData.statusCode == 200) {
                    $("#modal-horario").modal('hide');
                    window.location.href = '<?php echo BASE_URL ?>medico/horario';

                }
            }
        });
    }
    </script>