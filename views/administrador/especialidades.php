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
                        <button class="btn btn-primary" id="toggle-display">Cambiar vista</button>
                        <button type="button" class="btn btn-flat btn-success" data-toggle="modal"
                            data-target="#modal-especialidad" data-backdrop="static" data-keyboard="false">
                            <i class="far fa-save"></i> &nbsp;&nbsp; NUEVO ESPECIALIDAD
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
                            <div class="table-responsive" id="table-view">
                                <!-- .table -->
                                <table class="table">
                                    <!-- thead -->
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Precio</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cont = 0;
                                        foreach ($data["especialidades"] as $row) : $cont++; ?>
                                        <tr>
                                            <td> <?php echo $cont; ?></td>
                                            <td><?php echo $row["nombre"] ?></td>
                                            <td><?php echo $row["descripcion"] ?></td>
                                            <td><?php echo $row["precio"] ?></td>
                                            <td>
                                                <button class="activar btn btn-warning" disabled=""><i
                                                        class="fa fa-check"></i></button>
                                                <button class=" btn btn-danger"><i
                                                        class="fa fa-times-circle"></i></button>
                                                <button type="button" class="btn btn-sm btn-icon btn-secondary"
                                                    data-toggle="modal" data-target="#modal-especialidad"
                                                    data-backdrop="static" data-keyboard="false"
                                                    onclick="verEspecialdiad(<?php echo $row['id_especialidad']; ?>)">
                                                    <i class="fa fa-pencil-alt"></i>
                                                    <span class="sr-only">Edit</span>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?> 
                                    </tbody>
                                </table><!-- /.table -->
                            </div><!-- /.table-responsive -->

                            <div class="grid-view" id="grid-view" style="display: none;">
                                <div class="row">
                                    <?php foreach ($data["especialidades"] as $row) : ?>
                                    <div class="col-md-4">
                                        <div class="item">
                                            <h4><?php echo $row["nombre"] ?></h4>
                                            <p><?php echo $row["descripcion"] ?></p>
                                            <p>Precio: <?php echo $row["precio"] ?></p>
                                            <div class="item-options">
                                                <button class="activar btn btn-warning" disabled=""><i
                                                        class="fa fa-check"></i></button>
                                                <button class="btn btn-danger"><i
                                                        class="fa fa-times-circle"></i></button>
                                                <button class="btn btn-sm btn-icon btn-secondary"><i
                                                        class="fa fa-pencil-alt"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div><!-- /.row -->
                            </div><!-- /.grid-view -->
                        </div><!-- /.card-body -->
                    </div>
                </div><!-- /.section-block -->
            </div><!-- /.page-section-->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
</div>
  

<div class="modal form-modal" id="modal-especialidad" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <h4 class="modal-title" id="title">Nuevo Especialidad</h4>
                    <hr>
                </div>
            </div>
            <form id="formModulos" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group row" id="divEspecialidad">
                        <label for="exampleInputEmail1" class="col-sm-4 col-form-label text-right">Especialidad</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="txtEspeci" name="txtEspeci">
                        </div>
                    </div>
                    <div class="form-group row" id="divDescripcion">
                        <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Descripción:</label>
                        <div class="col-sm-7">
                            <input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row" id="divPrecio">
                        <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Precio</label>
                        <div class="col-sm-7">
                            <input type="text" name="txtPrecio" id="txtPrecio" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="" class="btn btn-width btn-secondary btn-flat">CANCELAR</a>
                    <button type="button" class="btn btn-width btn-success btn-flat" id="btnRegistrar"
                        data-dismiss="modal" onclick="registrataDatos()">REGISTRAR DATOS</button>

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>

    document.addEventListener("DOMContentLoaded", function () {
        const toggleButton = document.getElementById("toggle-display");
        const tableView = document.getElementById("table-view");
        const gridView = document.getElementById("grid-view");

        toggleButton.addEventListener("click", function () {
            if (tableView.style.display === "none") {
                tableView.style.display = "block";
                gridView.style.display = "none";
            } else {
                tableView.style.display = "none";
                gridView.style.display = "block";
            }
        });
    });


function registrataDatos() {
    $.ajax({
        url: "<?php echo BASE_URL; ?>administrador/registrar",
        type: "POST",
        data: $("#formModulos").serialize(),
        success: function(response) {
            var jsonData = JSON.parse(response);
            if (jsonData.statusCode == 200) {
                $("#modal-especialidad").modal('hide');
                window.location.href = '<?php echo BASE_URL ?>administrador';
            }

        }
    });
}


function verEspecialdiad(id) {
    $("#title").text("Actualizar Especialdiad");
    $.ajax({
        url: "<?php echo BASE_URL ?>administrador/ver/" + id,
        type: "GET",
        success: function(response) {
            var jsonData = JSON.parse(response);
            
            $("#txtEspeci").val(jsonData.data.nombre);
            $("#txtDescripcion").val(jsonData.data.descripcion);
            $("#txtPrecio").val(jsonData.data.precio);

            $("#btnRegistrar").text("Actualizar Datos");
            $("#btnRegistrar").attr("onclick", "actualizarDatos('" + jsonData.data.id_especialidad + "')");
        }

    });
}

function actualizarDatos(id) {
    $.ajax({
        url: "<?php echo BASE_URL; ?>administrador/actualizarModulos/" + id,
        type: "POST",
        data: $("#formModulos").serialize(),
        success: function(response) {
            var jsonData = JSON.parse(response);
            if (jsonData.statusCode == 200) {
                $("#modal-especialidad").modal('hide');
                window.location.href = '<?php echo BASE_URL ?>modulos/';

            } else if (jsonData.statusCode == 500) {
                $("#modal-especialidad").modal('show');

            }

        }
    });
}
</script>