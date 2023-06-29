<!doctype html>
<html lang="es">

<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Dashboard | Looper - Bootstrap 4 Admin Theme </title>
    <meta property="og:title" content="Dashboard">
    <meta name="author" content="Beni Arisandi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Responsive admin theme build on top of Bootstrap 4">
    <meta property="og:description" content="Responsive admin theme build on top of Bootstrap 4">
    <link rel="canonical" href="https://uselooper.com">
    <meta property="og:url" content="https://uselooper.com">
    <meta property="og:site_name" content="Looper - Bootstrap 4 Admin Theme">
    <script type="application/ld+json">
    {
        "name": "Looper - Bootstrap 4 Admin Theme",
        "description": "Responsive admin theme build on top of Bootstrap 4",
        "author": {
            "@type": "Person",
            "name": "Beni Arisandi"
        },
        "@type": "WebSite",
        "url": "",
        "headline": "Dashboard",
        "@context": "http://schema.org"
    }
    </script><!-- End SEO tag -->
    <!-- FAVICONS -->
    <link rel="apple-touch-icon" sizes="144x144" href="assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <meta name="theme-color" content="#3063A0"><!-- End FAVICONS -->
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End GOOGLE FONT -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet"
        href="<?php echo BASE_URL?>/views/dashboard/assets/vendor/open-iconic/font/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet"
        href="<?php echo BASE_URL?>/views/dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/views/dashboard/assets/vendor/flatpickr/flatpickr.min.css">
    <!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->

    <!-- END PLUGINS STYLES -->
    <link rel="stylesheet" href="<?php echo BASE_URL?>/views/dashboard/assets/stylesheets/theme.min.css"
        data-skin="default">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/views/dashboard/assets/stylesheets/theme-dark.min.css"
        data-skin="dark">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/views/dashboard/assets/stylesheets/custom.css">

    <link rel="stylesheet" href="<?php echo BASE_URL?>/views/dashboard/assets/vendor/sweetalert/sweetalert.css">

    <script src="<?php echo BASE_URL?>views/dashboard/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo BASE_URL?>/views/dashboard/assets/vendor/sweetalert/sweetalert.js"></script>

    <script>
    var skin = localStorage.getItem('skin') || 'default';
    var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
    // Disable unused skin immediately
    disabledSkinStylesheet.setAttribute('rel', '');
    disabledSkinStylesheet.setAttribute('disabled', true);
    // add loading class to html immediately
    document.querySelector('html').classList.add('loading');
    </script><!-- END THEME STYLES -->
</head>

<body>

    <header>
        <nav>
            <div class="col-md-6 d-flex justify-content-end align-items-start">
                <footer class="aside-footer border-top p-2">
                    <button class="btn btn-light btn-block text-primary" data-toggle="skin"><span
                            class="d-compact-menu-none">Night
                            mode</span> <i class="fas fa-moon ml-1"></i></button>
                    <ul class="d-flex">
                        <li><a href="<?php echo BASE_URL?>vista/login" class="mr-3">INICIAR SESIÓN</a></li>
                        <li><a href="../index.html" class="mr-3">REGISTRARSE</a></li>
                    </ul>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="row">

                </div>
                <a class="navbar-brand" href="#">
                    <img src="<?php echo BASE_URL?>img/logoazuloriginal.png" height="28">
                </a>
                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">inicion <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">Nosotros</a>
                        </li>
                        <li class="nav-item" id="productos">
                            <a class="nav-link" href="#" id="navbarDropdown">Productos </a>
                        </li>
                        <li class="nav-item " id="tiendas">
                            <a class="nav-link" href="#">Tiendas </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL?>paciente/">Agendar cita</a>
                        </li>
                    </ul>
                </div>
            </nav>

        </nav>

    </header>
    <?php require_once $data["contenido"];?>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>ubicanos</h4>
                    <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
                        <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div>
                        <script>
                        (function() {
                            var setting = {
                                "query": "Hospital Regional, Chiclayo, Perú",
                                "width": 200,
                                "height": 200,
                                "satellite": true,
                                "zoom": 17,
                                "placeId": "ChIJbXJ7TuXuTJARVJBQHfNliMk",
                                "cid": "0xc98865f31d509054",
                                "coords": [-6.7620558, -79.8629334],
                                "lang": "es",
                                "queryString": "Hospital Regional, Chiclayo, Perú",
                                "centerCoord": [-6.7620558, -79.8629334],
                                "id": "map-9cd199b9cc5410cd3b1ad21cab2e54d3",
                                "embed_id": "951377"
                            };
                            var d = document;
                            var s = d.createElement('script');
                            s.src = 'https://1map.com/js/script-for-user.js?embed_id=951377';
                            s.async = true;
                            s.onload = function(e) {
                                window.OneMap.initMap(setting)
                            };
                            var to = d.getElementsByTagName('script')[0];
                            to.parentNode.insertBefore(s, to);
                        })();
                        </script><a href="https://1map.com/es/map-embed">1 Map</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4>Acerca de Nosotros</h4>
                    <ul>
                        <li>mision</li>
                        <li>vision</li>
                        <li>historia</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Siguenos</h4>
                    <ul>
                        <li><a href="enlace1">  <i class="fa fa-play"></i></a></li>
                        <li><a href="enlace2">  <i class="fa fa-play"></i></a></li>
                        <li><a href="enlace3">  <i class="fa fa-play"></i></a></li>
                    </ul>

                </div>
            </div>
            <hr>
            <p class="text-center">© 2023 Tu Empresa. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- BEGIN BASE JS -->
    <script src="<?php echo BASE_URL?>views/dashboard/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo BASE_URL?>views/dashboard/assets/vendor/popper.js/umd/popper.min.js"></script>
    <script src="<?php echo BASE_URL?>views/dashboard/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="<?php echo BASE_URL?>views/dashboard/assets/vendor/pace-progress/pace.min.js"></script>
    <script src="<?php echo BASE_URL?>views/dashboard/assets/vendor/stacked-menu/js/stacked-menu.min.js"></script>
    <script src="<?php echo BASE_URL?>views/dashboard/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js">
    </script>
    <script src="<?php echo BASE_URL?>views/dashboard/assets/vendor/flatpickr/flatpickr.min.js"></script>
    <script src="<?php echo BASE_URL?>views/dashboard/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="<?php echo BASE_URL?>views/dashboard/assets/vendor/chart.js/Chart.min.js"></script>
    <!-- END PLUGINS JS -->
    <script src="<?php echo BASE_URL?>/views/dashboard/assets/vendor/sweetalert/sweetalert.js"></script>
    <!-- BEGIN THEME JS -->
    <script src="<?php echo BASE_URL?>views/dashboard/assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo BASE_URL?>views/dashboard/assets/javascript/pages/dashboard-demo.js"></script>
    <!-- END PAGE LEVEL JS -->


</body>

</html>