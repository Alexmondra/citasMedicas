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

                <div class="d-flex flex-column flex-md-row ">
                    <div class="d-flex align-items-center">
                        <p class="mr-2">mostrar:</p>
                        <input type="number" class="form-control form-control-sm mr-2">
                        <p>entradas</p>
                    </div>

                    <div class="ml-auto">
                        <input type="text" class="form-control" id="buscar" placeholder="Buscar">
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
                                            <th> Dni paciente </th>
                                            <th> Nombre paciente</th>
                                            <th> Doctor asignado</th>
                                            <th> Detalle consulta</th>
                                            <th> fecha consulta</th>
                                            <th> Reprogramar</th>
                                        </tr>
                                    </thead><!-- /thead -->
                                    <!-- tbody -->
                                    <tbody id ="tablaDat">

                                        <?php $cont=0; foreach($data["cita"] as $row): $cont++;?>
                                        <tr>
                                            <td><?php echo $cont;?></td>
                                            <td><?php echo $row["dni"]?></td>
                                            <td><?php echo $row["nombre_paciente"]?></td>
                                            <td><?php echo $row["nombre_medico"]?></td>
                                            <td><?php echo $row["detalle"]?></td>
                                            <td><?php echo $row["fechaCita"]?></td>
                                            <td>
                                                <a href="#"
                                                    class="btn btn-info btn-sm">Reprogramar
                                                    <i class="fa fa-edit"></i> </a>
                                            </td>

                                        </tr>
                                        <?php endforeach?>
                                    </tbody><!-- /tbody -->
                                </table><!-- /.table -->
                            </div>
                        </div><!-- metric column -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
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