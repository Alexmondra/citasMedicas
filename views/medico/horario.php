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

                        <button type="button" class="btn btn-flat btn-info" id="nuevo-registro-btn">
                            <i id="icono-registro" class="far fa-save"></i> &nbsp;&nbsp; REGISTRO
                        </button>
                    </div>

                </div>

            </header><!-- /.page-title-bar -->
            <!-- .page-section -->

            <div class="page-section">

                <form action ="<?php echo BASE_URL;?>medico/registrarNuevo" method="POST" class="row gx-3 gy-2 align-items-center" id="form-nuevo" style="display: none;">
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="specificSizeSelect">fecha</label>
                        <input type="date" class="form-control" id="txtdate" name="txtdate">
                    </div>
                    <div class="col-sm-3">
                        <div>
                            <label class="visually-hidden" for="specificSizeInputName">hora inicio </label>
                            <input type="time" class="form-control" id="txtinicio" name="txtinicio">
                        </div>
                        <div>
                            <label class="visually-hidden" for="specificSizeInputName">Fin</label>
                            <input type="time" class="form-control" id="txtfin" name="txtfin">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="col-md-8">
                            <label class="visually-hidden" for="specificSizeInputName">cupos</label>
                            <input type="number" class="form-control" id="txtcupos" name="txtcupos">
                        </div>
                        <br>

                        <div class="col-sm-8  ">
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                        </div>

                    </div>

                </form>

                <div class="section-block">
                    <!-- metric row -->
                    <div class="metric-row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <!-- .table -->
                                <table class="table table-bordered border-primary">
                                    <!-- thead -->
                                    <thead class="thead-">
                                        <tr>
                                            <th> # </th>
                                            <th> Fecha</th>
                                            <th> Hora Inicio </th>
                                            <th> Hora Fin </th>
                                            <th> Cupos </th>
                                            <th> Opciones </th>
                                        </tr>
                                    </thead><!-- /thead -->
                                    <!-- tbody -->
                                    <tbody>

                                        <?php $cont=0; foreach($data["horario"] as $row): $cont++;?>
                                        <tr>
                                            <td><?php echo $cont;?></td>
                                            <td><?php echo $row["fecha"]?></td>
                                            <td><?php echo $row["hora_inicio"]?></td>
                                            <td> <?php echo $row["hora_fin"]?></td>
                                            <td> <?php echo $row["cupos"]?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-icon btn-secondary"
                                                    data-toggle="modal" data-target="#modal-horario"
                                                    data-backdrop="static" data-keyboard="false"
                                                    onclick="verHorario(<?php echo $row['id_horario']; ?>)">
                                                    <i class="fa fa-pencil-alt"></i>
                                                    <span class="sr-only">Edit</span>
                                                </button>

                                                <a href="<?php echo BASE_URL ?>/medico/eliminarhorario/<?php echo $row["id_horario"] ?>"
                                                    class="btn btn-sm btn-icon btn-secondary btn-confirm-delete">
                                                    <i class="fa fa-eraser"></i>
                                                    <span class="sr-only">Remove</span>
                                                </a>
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



<div class="modal form-modal" id="modal-horario" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <h4 class="modal-title" id="title">ACTUALIZACION DE HORARIO </h4>
                    <hr>
                </div>
            </div>
            <form id="formModulos" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group row" id="divFecha">
                        <label for="exampleInputEmail1" class="col-sm-4 col-form-label text-right">FECHA</label>
                        <div class="col-md-7">
                            <input type="date" class="form-control" id="txtFecha" name="txtFecha">
                        </div>
                    </div>
                    <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Hora de inicio atencion</label>
                    <div class="form-group row" id="divInicio">
                        <div class="col-sm-7">
                            <input type="time" name="txtHoInicio" id="txtHoInicio" class="form-control">
                        </div>
                    </div>
                    <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Hora de fin atencion</label>
                    <div class="form-group row" id="divFin">
                        <div class="col-sm-7">
                            <input type="time" name="txtHoFin" id="txtHoFin" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row" id="divFecha">
                        <label for="exampleInputEmail1" class="col-sm-4 col-form-label text-right">CUPOS</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" id="txtCupos" name="txtCupos">
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <a href="" class="btn btn-width btn-secondary btn-flat">CANCELAR</a>
                    <button type="button" class="btn btn-width btn-success btn-flat" id="btnRegistrar"
                        data-dismiss="modal" onclick="">ACTUALIZAR DATOS</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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


function verHorario(id) {
    $.ajax({
        url: "<?php echo BASE_URL ?>medico/verhorario/" + id,
        type: "GET",
        success: function(response) {
            var jsonData = JSON.parse(response);
            console.log(jsonData);
            $("#txtFecha").val(jsonData.data.fecha);
            $("#txtHoInicio").val(jsonData.data.hora_inicio);
            $("#txtHoFin").val(jsonData.data.hora_fin);
            $("#txtCupos").val(jsonData.data.cupos);

            $("#btnRegistrar").attr("onclick", "actualizarDatos('" + jsonData.data.id_horario + "')");
        }

    });
}

function actualizarDatos(id) {
    console.log("hola");
    $.ajax({
        url: "<?php echo BASE_URL; ?>medico/actualizarhorario/" + id,
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