<div class="wrapper">
    <!-- .page -->
    <div class="page">
        <!-- .page-inner -->
        <div class="page-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="carousel-17432" class="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" alt="Carousel Bootstrap First"
                                        src="https://www.layoutit.com/img/sports-q-c-1600-500-1.jpg" />
                                    <div class="carousel-caption text-center d-flex">
                                        <div>
                                            <h4>Especialidades</h4>
                                            <p>Contamos con más de 20 especialidades a tu disposición.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" alt="Carousel Bootstrap Second"
                                        src="https://www.layoutit.com/img/sports-q-c-1600-500-2.jpg" />
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" alt="Carousel Bootstrap Third"
                                        src="https://www.layoutit.com/img/sports-q-c-1600-500-3.jpg" />
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carousel-17432" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-17432" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row page-inner">
                <?php $cont=0; foreach($data["especialidad"] as $row): $cont++;?>
                <div class="col-12 col-lg-12 col-xl-4">
                    <div class="card card-fluid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="<?php echo BASE_URL?>/public/especialidades/<?php echo $row['imagen']; ?>" alt="Imagen"
                                        width="60" height="60">
                                </div>
                                <h3 class="name"><span class="name-value"><?php echo $row['nombre']; ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach?>
            </div>
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
</div>