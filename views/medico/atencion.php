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
            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <?php if (!empty($data["atencion"]["id"])) { ?>
            <div class="row">
                <div class="col-md-6">
                    <img src="https://robohash.org/<?php echo $data["atencion"]["id"]?>" alt="Imagen" width="290"
                        height="250">
                    <br><br>
                    <h4 class="text-center mt-4">Historias:</h4>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">fecha</th>
                                <th scope="col">motivo</th>
                                <th scope="col">resultado</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cont=0; foreach ($data["historias"] as $row): $cont++?>
                            <tr>
                                <td><?php echo $cont;?></td>
                                <td><?php echo $row["fecha"]?></td>
                                <td><?php echo $row["motivo"]?></td>
                                <td> <?php echo $row["resultado"]?></td>
                                <td>
                                    <button class="btn btn-sm btn-icon btn-secondary">
                                        <i class="fas fa-low-vision"></i>
                                        <span class="sr-only">Edit</span>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">

                    <h3 class="text-center">Datos paciente</h3>
                    <div class="patient-details">
                        <label class="fw-bold">DNI:</label>
                        <span class="ms-2"><?php echo $data["atencion"]["dni"]; ?></span> <br>
                        <label class="fw-bold">Nombre:</label>
                        <span class="ms-2"><?php echo $data["atencion"]["nombre_paciente"]; ?></span> <br>
                        <label class="fw-bold">Edad:</label>
                        <span
                            class="ms-2"><?php echo date_diff(date_create($data["atencion"]["Fdate"]), new DateTime())->format('%y años, %m meses y %d días'); ?></span>
                        <br>
                        <label class="fw-bold">DETALLE:</label>
                        <span class="ms-5"><?php echo $data["atencion"]["detalle"]; ?></span> <br>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary">CREAR HISTORIA</button>
                        <button class="btn btn-secondary">ESCRIBIR RECETA</button>
                        <button class="btn btn-success"> GENERAR INFORME</button>
                    </div>
                </div>
            </div>

            <?php }else{ ?>

            <div class="container">
                <h1 class="text-center mt-5 animate__animated animate__infinite animate__bounce">No tiene paciente por
                    atender</h1>
            </div>


            <?php } ?>





        </div>

    </div><!-- /.page-section -->
</div><!-- /.page-inner -->
</div><!-- /.page -->
</div>
