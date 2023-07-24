<div class="wrapper">
    <!-- .page -->
    <div class="page">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <div class="mx-auto">
                    <p class="lead">
                        <span class="font-weight-bold"><?php echo $data["titulo"]?></span>
                    </p>
                </div>
                <div class="d-flex flex-column flex-md-row">
                    <div>
                        <p>Buscar por:</p>
                        <input type="radio" name="opcion_busqueda" value="dni" id="radio_dni">
                        <label for="radio_dni">DNI</label>
                        <input type="radio" name="opcion_busqueda" value="nombre" id="radio_nombre">
                        <label for="radio_nombre">Nombre</label>
                    </div>


                    <div class="ml-auto"> 
                        <!-- .dropdown -->
                        <div class="dropdown">
                            <input type="text" class="form-control" id="buscar" placeholder="Buscar">
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
                            <div class="table-responsive">
                                <!-- .table -->
                                <table class="table table-striped">
                                    <!-- thead -->
                                    <thead class="thead-">
                                        <tr>
                                            <th> # </th>
                                            <th> Nombre Completo </th>
                                            <th> sexo </th>
                                            <th> nº documento</th>
                                            <th> fecha consulta</th>
                                            <th> pago</th>
                                            <th> opcion</th>
                                        </tr>
                                    </thead><!-- /thead -->
                                    <!-- tbody -->
                                    <tbody id="tablaDat">
                                        <?php $cont=0; foreach($data["citaPendientes"] as $row): $cont++;?>
                                        <tr>
                                            <td><?php echo $cont;?></td>
                                            <td><?php echo $row["nombre"]?></td>
                                            <td><?php echo $row["sexo"]?></td>
                                            <td><?php echo $row["dni"]?></td>
                                            <td><?php echo $row["fecha"]?></td>
                                            <td><?php echo $row["precio"]?></td> 
                                            <td>
                                                <button type="button" class="btn btn-flat btn-success"
                                                    data-toggle="modal" data-target="#modal-pagos"
                                                    data-backdrop="static" data-keyboard="false"
                                                    onclick="registrarDatos(<?php echo $row['id_cita']; ?>)">
                                                    REGISTRAR PAGO
                                                </button>
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


<div class="modal form-modal" id="modal-pagos" style=" display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <h4 class="modal-title" id="title">Realizar pago</h4>
                    <hr>
                </div>
            </div>
            <form id="formModulos" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group row" id="divmonto">
                        <label for="exampleInputEmail1" class="col-sm-4 col-form-label text-right">ingrese el
                            monto:</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" id="txtIcon" name="txtIcon">
                            <small class="text-danger "><b id="errtxtIcon"></b></small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Tipo pago:</label>
                        <div class="col-sm-7">
                            <select name="cboOpcion" id="cboOpcion" class="form-control" onchange="showControls()">
                                <option value="1">Efectivo</option>
                                <option value="2">trasferencia</option>
                                <option value="3">Tarjeta</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row d-none" id="divQR">
                        <div class="col-12 text-center">
                            <img src="<?php echo BASE_URL?>public/img/QR.png" height="300">
                            <small class="text-danger "><b id="errcboCategoria"></b></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabel" class="col-sm-4 col-form-label text-right">Estado:</label>
                        <div class="col-sm-7">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="chkEstado" name="chkEstado">
                                <label class="form-check-label" for="chkEstado">
                                    cancelado/moroso
                                </label>
                            </div>
                            <small class="text-danger "><b id="errchkEstado"></b></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="" class="btn btn-width btn-secondary btn-flat">CANCELAR</a>
                    <button type="button" class="btn btn-width btn-success btn-flat" id="btnRegistrar"
                        data-dismiss="modal" onclick="registrarDatos(<?php echo $row['id_cita']; ?>, '2')">
                        REGISTRAR DATOS
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
$(document).ready(function() {
    $("#buscar").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tablaDat tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

function showControls() {
    valor = $("#cboOpcion").val();
    if (valor == 1) {
        $("#divQR").addClass("d-none");
        $("#divmonto").removeClass("d-none");

    } else if (valor == 2) {

        $("#divQR").removeClass("d-none");
        $("#divmonto").addClass("d-none");
    }
}


function registrarDatos(id){
    $.ajax({
        url: "<?php echo BASE_URL; ?>admicionista/registrarModulos",
        type: "POST",
        data: $("#formModulos").serialize(),
        success: function(response) {
            var jsonData = JSON.parse(response);

            if (jsonData.statusCode == 200) {
                $("#modal-modulos").modal('hide');
                window.location.href = '<?php echo BASE_URL ?>modulos';

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