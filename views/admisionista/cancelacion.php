<div class="wrapper">

    <div class="page">

        <div class="page-inner">

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
                        <div class="dropdown">
                            <input type="text" class="form-control" id="buscar" placeholder="Buscar">
                        </div>
                    </div>
                </div>
            </header>
            <div class="row" id ="tablaDat">

            
                <?php $cont=0; foreach($data["citas"] as $row): $cont++;?>
                <div class="col-12 col-lg-12 col-xl-4">
                    <div class="card card-fluid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="https://robohash.org/<?php echo $row["id"]?>" alt="Imagen" width="60"
                                        height="60">
                                </div>
                                <div class="col-md-9">
                                    <h3 class="card-title mb-4">Datos paciente</h3>
                                    <p class="dni">DNI: <span class="dni-value"><?php echo $row['dni']; ?></span>
                                    </p>
                                </div>
                                <p class="name">Nombre: <span class="name-value"><?php echo $row['nombre']; ?></span>
                                    <select id="estado" name="estado">
                                        <option value="cancelar">Cancelar</option>
                                        <option value="activo" selected>Activo</option>
                                    </select>
                                </p>


                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach?>
            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(function(){
         $("#buscar").on("keyup", function() {
            var value = $(this).val().toLowerCase();
        $("#tablaDat .card").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
    </script>