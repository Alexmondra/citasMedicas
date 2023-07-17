<!DOCTYPE html>
<html lang="es">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Sign In | Looper - Bootstrap 4 Admin Theme </title>
    <meta property="og:title" content="Sign In">
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
        "headline": "Sign In",
        "@context": "http://schema.org"
    }
    </script><!-- End SEO tag -->
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <meta name="theme-color" content="#3063A0"><!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet"
        href="<?php echo BASE_URL ?>/views/dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/views/dashboard/assets/stylesheets/theme.min.css"
        data-skin="default">

    <link rel="stylesheet" href="<?php echo BASE_URL ?>/views/dashboard/assets/stylesheets/theme-dark.min.css"
        data-skin="dark">
    <link rel="stylesheet" href="assets/stylesheets/custom.css">
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

<body class="bg-info d-flex justify-content-center align-items-center vh-100">
    <form class="auth-form" method="post" autocomplete="off" action="<?php echo BASE_URL ?>login/validarCredenciales">
        <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 25rem">

            <div class="d-flex justify-content-center">
                <img src="<?php echo BASE_URL?>public/img/logoazuloriginal.png" alt="login-icon" style="height: 5rem" />
            </div>
            <div class="text-center fs-1 fw-bold">Login</div>
            <div class="input-group mt-4">
                <div class="input-group-text bg-info">
                    <img src="<?php echo BASE_URL?>public/img/username-icon.svg" alt="username-icon"
                        style="height: 1rem" />
                </div>
                <input type="text" id="txtUsuario" name="txtUsuario" class="form-control" placeholder="Username"
                    autofocus="" value="<?php echo $_REQUEST["txtUsuario"]?>">
                <?php if (isset($data["errores"]["usuario"])) : ?>
                <div class="text-danger">
                    <?php echo $data["errores"]["usuario"] ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="input-group mt-1">
                <div class="input-group-text bg-info">
                    <img src="<?php echo BASE_URL?>public/img/password-icon.svg" alt="password-icon"
                        style="height: 1rem" />
                </div>
                <input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Password"
                    value="<?php echo $_REQUEST["txtPassword"]?>"> 
                <?php if (isset($data["errores"]["password"])) : ?>
                <div class="text-danger">
                    <?php echo $data["errores"]["password"] ?>
                </div>
                <?php endif; ?>
            </div>
    </form>
    <div class="d-flex justify-content-around mt-1">
        <div class="d-flex align-items-center gap-1">
            <input class="form-check-input" type="checkbox" />
            <div class="pt-1" style="font-size: 0.9rem">Remember me</div>
        </div>
        <div class="pt-1">
            <a href="#" class="text-decoration-none text-info fw-semibold fst-italic" style="font-size: 0.9rem">Forgot
                your password?</a>
        </div>
    </div>
    <div class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm">
        Login
    </div>

    <div class="p-3">
        <div class="border-bottom text-center" style="height: 0.9rem">
            <span class="bg-white px-3">or</span>
        </div>
    </div>
    <div class="btn d-flex gap-2 justify-content-center border mt-3 shadow-sm">
        <img src="<?php echo BASE_URL?>img/google-icon.svg" alt="google-icon" style="height: 1.6rem" />
        <div class="fw-semibold text-secondary">Solicitar unirse</div>
    </div>
    </div>


    <script src="<?php echo BASE_URL ?>views/dashboard/assets/vendor/jquery/jquery.min.js"></script>

    <script src="<?php echo BASE_URL ?>views/dashboard/assets/vendor/popper.js/umd/popper.min.js"></script>

    <script src="<?php echo BASE_URL ?>views/dashboard/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- BEGIN PLUGINS JS -->

    <script src="<?php echo BASE_URL ?>views/dashboard/assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
</body>

</html>