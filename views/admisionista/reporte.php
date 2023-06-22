<div class="wrapper">
    <!-- .page -->
    <div class="page">
        <!-- .page-inner -->
        <div class="page-inner">
            <!-- .page-title-bar -->
            <header class="page-title-bar">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="lead">
                            <span class="font-weight-bold"><?php echo $data["titulo"]?></span>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="start">Fecha:</label>
                        <input type="date" id="start" name="fecha" min="yyyy-mm-dd" max="yyyy-mm-dd">
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row">
                    <div class="justify-content-center align-items-center">
                        <div class="form-group">
                            <select name="mi-selector" class="form-control" style="max-width: 200px;">
                                <?php foreach ($data["especialidad"] as $row): ?>
                                <option value="<?php echo $row["nombre"]; ?>"><?php echo $row["nombre"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mx-auto">
                        <div class="form-group">
                            <select name="mi-selector" class="form-control" style="max-width: 200px;">
                                <?php foreach ($data["doctor"] as $row): ?>
                                <option value="<?php echo $row["nombre"]; ?>"><?php echo $row["nombre"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>


            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="page-section">
                <!-- .section-block -->
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="table-container overflow-auto" style="max-height: 300px;">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">paciente</th>
                                            <th scope="col">detalle</th>
                                            <th scope="col">Hora</th>
                                            <th scope="col">historia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cont=0; foreach($data["reporteAtender"] as $row): $cont++;?>
                                        <tr>
                                            <td><?php echo $cont;?></td>
                                            <td><?php echo $row["nombre"]?></td>
                                            <td><?php echo $row["detalle"]?></td>
                                            <td><?php echo $row["fecha"]?></td>
                                            <td><?php echo $row["historia"]?></td>
                                        </tr>
                                        <?php endforeach?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="h4 mt-4">CITAS ATENDIAS POR EL MEDICO:</p>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="table-container overflow-auto" style="max-height: 300px;">
                                <table class="table table-striped table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">paciente</th>
                                            <th scope="col">detalle</th>
                                            <th scope="col">entrada</th>
                                            <th scope="col">salida</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $conta=0; foreach($data["reporteAtendido"] as $row): $conta++;?>
                                        <tr>
                                            <td><?php echo $conta;?></td>
                                            <td><?php echo $row["nombres"]?></td>
                                            <td><?php echo $row["detalles"]?></td>
                                            <td><?php echo $row["entrada"]?></td>
                                            <td><?php echo $row["salida"]?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.section-block -->

        </div><!-- /.page-section -->
    </div><!-- /.page-inner -->
</div><!-- /.page -->
</div>