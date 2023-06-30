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
                <div class="d-flex align-items-center">
                    <label for="mi-selector" class="font-weight-bold">MEDICO</label>

                </div>
            </header><!-- /.page-title-bar -->
            <!-- .page-section -->
            <div class="row">
                <div class="col-md-6">
                    <img src="https://robohash.org/<?php echo $data["atencion"]["id"]?>" alt="Imagen"
                        width="290" height="250">
                    <br><br>
                    <h4 class="text-center mt-4">Historias:</h4>
                    <div class="container">
                        <?php foreach ($data["historias"] as $row): ?>
                        <div class="story-container" style="max-width: 80px;">
                            <p><?php echo $row["fecha"]; ?></p>
                            <p><?php echo $row["motivo"]; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="card-title mb-4">Datos paciente</h3>
                    <p class="dni">DNI: <span
                            class="dni-value"><?php echo $data["atencion"]["dni"]; ?></span></p>
                    <p class="name">Nombre: <span class="name-value"><?php echo $data["atencion"]["nombre"]; ?></span>
                    </p>
                    <div class="mt-4">
                        <button class="btn btn-primary">CREAR HISTORIA</button>
                        <button class="btn btn-secondary">ESCRIBIR RECETA</button>
                        <button class="btn btn-success"> GENERAR INFORME</button>
                    </div>
                </div>
            </div>





        </div>

    </div><!-- /.page-section -->
</div><!-- /.page-inner -->
</div><!-- /.page -->
</div>