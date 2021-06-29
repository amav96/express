<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?=base_url?>estilos/imagenes/logo/logo.png">
    <title>Express | Necesitas nuestro servicio de logistica inversa y ultima milla?</title>


    <script src="<?= base_url ?>estilos/personal/js/jquery.min.js"></script>
    <script src="<?= base_url ?>estilos/personal/js/bootstrap.min.js"></script>



    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/fontawesome/css/all.css">

    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/bootstrap/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/admin/recursos_panel.css">

    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/sidebarper.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url ?>estilos/personal/datatables/DataTables-1.10.22/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url ?>estilos/personal/datatables/AutoFill-2.3.5/css/autoFill.dataTables.css" />


</head>

<body>

    <div class="fondoimagen" id="fondoimagen">
        <img class="logo-main" id="logodos" src="<?= base_url ?>estilos/imagenes/logo2.png" alt="">

        <img class="logo-main-dos" id="logouno" src="<?= base_url ?>estilos/imagenes/logo.png" alt="">
    </div>

    <!--Carousel Wrapper-->

    <?php

    if ($_SESSION["username"]->type_request === 'admin') { ?>



        <div class="container-titulo-usuario">
            <div class="box-titulo-usuario">
                <h4>Usuario/a: <?php echo $_SESSION["username"]->name ?></h4>
                <input type="hidden" id="id_user_default" value="<?= $_SESSION["username"]->id ?>">
                <input type="hidden" id="country_recolector" value="<?=$_SESSION["username"]->country?>">
            </div>
        </div>

        <div class="container-barra-panel">
        <div class="tamano-espacio-items">


            <div class="mini-box-panel" id="inicio">
                <div class="item">
                    <i class="fas fa-home"></i>
                </div>


            </div>
            <div class="mini-box-panel" id="mostrarpanel">
                <div class="item">
                    <i class="fas fa-search"></i>
                </div>

            </div>


            <div class="mini-box-panel" id="container-notification">
                <div class="solicitudes" id="solicitudes">
                    <div class="caja-notificacion" id="caja-notificacion">
                    </div>
                    <div class="item">
                        <i class="far fa-bell"></i>
                    </div>
                </div>
                <div class="despliegue-notificacion" id="despliegue-notificacion">


                </div>
            </div>
            <div class="mini-box-panel">
                <a style="text-decoration:none;color:black;" href="<?= base_url ?>usuario/managentUs">
                    <div class="item">
                        <i class="fas fa-users">

                        </i>
                    </div>
                </a>

            </div>

            <div class="mini-box-panel">
                <a style="text-decoration:none;color:black;" href="<?= base_url ?>notice/admin">
                    <div class="item">
                    <i class="fas fa-mail-bulk"></i>
                    </div>
                </a>

            </div>  

            <div class="mini-box-panel">
                <a style="text-decoration:none;color:black;" href="<?= base_url ?>normalizacion/baseGeneral">
                    <div class="item">
                        <i class="fas fa-database">

                        </i>
                    </div>
                </a>

            </div> 

         

            <div class="mini-box-panel" id="cerrar">
                <div class="item">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
            </div>
        </div>
    </div>


        <input class="input-form" type="checkbox" id="cuadraditocheck">
        <label class="titulo-label" for="cuadraditocheck">
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
                    <a href="<?= base_url ?>usuario/admin"><i class="fas fa-home"></i>Panel Coordinador/a</a>
                </li>
                <li>
                    <a href="<?= base_url ?>normalizacion/baseGeneral"><i class="fas fa-database"></i>Importa Base</a>
                </li>
                <li>
                <a href="<?= base_url ?>notice/admin"><i class="fas fa-mail-bulk"></i>Gesti���n de avisos</a>
                </li>
                <!-- <li>
                    <a href="<?= base_url ?>normalizacion/index"><i class="fas fa-phone"></i>Limpiar telefonos</a>
                </li> -->

                <li>
                    <a href="<?= base_url ?>usuario/logOut"><i class="fas fa-sign-out-alt"></i>Salir</a>
                </li>

            </ul>
        </div>

    <?php  } ?>