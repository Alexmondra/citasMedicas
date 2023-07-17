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
                                            <th> NOMBRE PACIENTE </th>
                                            <th> MOTIVO </th>
                                            <th> HORA </th>
                                            <th> INTERVENCIONES</th>
                                        </tr>
                                    </thead><!-- /thead -->
                                    <!-- tbody -->
                                    <tbody>
                                        <?php $cont=0; foreach($data["atenciones"] as $row): $cont++;?>
                                        <tr>
                                            <td><?php echo $cont;?></td>
                                            <td><?php echo $row["nombre"]." " . $row["apellidoP"] . " " . $row["apellidoM"] ?></td>
                                            <td><?php echo $row["detalle"]?></td>
                                            <th><?php echo $row["hora"]?></th>
                                            <td> <?php echo $row["intervenciones"]?></td>
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