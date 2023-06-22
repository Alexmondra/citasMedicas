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
                                    <tbody id ="tablaDat">
                                        <?php $cont=0; foreach($data["pagos"] as $row): $cont++;?>
                                        <tr>
                                            <td><?php echo $cont;?></td>
                                            <td><?php echo $row["nombre"]?></td>
                                            <td><?php echo $row["sexo"]?></td>
                                            <td><?php echo $row["dni"]?></td>
                                            <td><?php echo $row["fecha"]?></td>
                                            <td><?php echo $row["precio"]?></td>
                                            <td>
                                                <a class="btn btn-info btn-sm">editar
                                                    <i class="fa fa-edit"></i> </a>
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

<script>
        $(document).ready(function(){
         $("#buscar").on("keyup", function() {
            var value = $(this).val().toLowerCase();
        $("#tablaDat tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
    </script>