<?php if (!isset($_SESSION["username"])) {
    header('Location:' . base_url);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?= base_url ?>estilos/imagenes/logo/logo.png">
    <title>Express || Logistica</title>
    <script src="<?= base_url ?>estilos/personal/js/jquery.min.js"></script>
    <script src="<?= base_url ?>estilos/personal/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/reclute/recursos_recolector.css?v=05042021">
    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/sidebarper.css">

</head>

<body>
    <div class="loader">

    </div>

    <div class="fondoimagen" id="fondoimagen">


        <img class="logo-main" id="logodos" src="<?= base_url ?>estilos/imagenes/logo2.png" alt="">

        <img class="logo-main-dos" id="logouno" src="<?= base_url ?>estilos/imagenes/logo.png" alt="">

    </div>
   
        <div class="contenedordemenu">
            <ul>
                <li>
                    <a href="<?= base_url ?>">

                        <div class="fondocirculodelicono">
                            <i class="iconoadentrodelcirculo fas fa-home"></i>
                        </div>

                        <p class="textoicono">Inicio</p>

                    </a>
                </li>
                <li>
                    <a href="<?= base_url ?>express/nosotros">

                        <div class="fondocirculodelicono">
                            <i class="iconoadentrodelcirculo fas fa-building"></i>
                        </div>

                        <p class="textoicono">#Express</p>

                    </a>
                </li>
                <li>
                    <a href="<?= base_url ?>express/productos">

                        <div class="fondocirculodelicono">
                            <i class="iconoadentrodelcirculo fas fa-box-open"></i>
                        </div>

                        <p class="textoicono">Productos</p>

                    </a>
                </li>
                <li>
                    <a href="<?= base_url ?>express/contacto">

                        <div class="fondocirculodelicono">
                            <i class="iconoadentrodelcirculo fas fa-phone"></i>
                        </div>

                        <p class="textoicono">Contacto</p>

                    </a>
                </li>

            </ul>
        </div>
    


    <input type="checkbox" id="cuadraditocheck">
    <label for="cuadraditocheck">
        <i class="fas fa-bars" id="boton"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebarper completo">
        <header>Express</header>
        <ul class="completo">
            <li>
                <a href="<?= base_url ?>"><i class="fas fa-home"></i>Inicio</a>
            </li>
            <li>
                <a href="<?= base_url ?>express/corporativo"><i class="fas fa-truck"></i>Logistica inversa</a>
            </li>
            <li>
                <a href="<?= base_url ?>express/traslados"><i class="fas fa-stream"></i>Distribución</a>
            </li>
            <li>
                <a href="<?= base_url ?>express/ecommerce"><i class="fas fa-laptop"></i>Ecommerce</a>
            </li>
            <li>
                <a href="<?= base_url ?>express/contacto"><i class="fas fa-phone"></i>Contacto</a>
            </li>
        </ul>
    </div>