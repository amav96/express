
<?php




 if (isset($_SESSION["tipo"])) {

     if ($_SESSION["tipo"]["tipo"] != 'admin') {
         header("Location: ../../index.html");
     }
     require_once '../../helpers/utils.php';
     require_once '../../config/db.php';
     require_once "../../model/adm/M_normalizacion.php";
 } else {
     header("Location: ../../");
 }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Express procesando</title>

   

    <script src="../../estilos/personal/js/jquery.min.js"></script>
	<script src="../../estilos/personal/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="../../estilos/personal/fontawesome/css/all.css">

	<link rel="stylesheet" href="../../estilos/personal/css/bootstrap/bootstrap.min.css">

    <link rel="stylesheet" href="../../estilos/personal/css/adm/recursos_panel.css">

    <link rel="stylesheet" href="../../estilos/personal/css/sidebarper.css">

     <!--datables CSS básico-->
     <!-- <link rel="stylesheet" type="text/css" href="../../estilos/personal/datatables/datatables.min.css"/> -->
    <!--datables estilo bootstrap 4 CSS-->  
    <!-- <link rel="stylesheet"  type="text/css" href="../../estilos/personal/datatables/DataTables-1.10.22/css/dataTables.bootstrap4.min.css"> -->

    <link rel="stylesheet" type="text/css" href="../../estilos/personal/datatables/DataTables-1.10.22/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="../../estilos/personal/datatables/AutoFill-2.3.5/css/autoFill.dataTables.css"/>

    
</head>

<body>

    <div class="fondoimagen" id="fondoimagen">


        <img class="logo-main" id="logodos" src="../../estilos/imagenes/logo2.png" alt="">

        <img class="logo-main-dos" id="logouno" src="../../estilos/imagenes/logo.png" alt="">

    </div>

    <!--Carousel Wrapper-->


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
                <a href="../../index.html"><i class="fas fa-home"></i>Inicio</a>
            </li>
            
            <li>
                <a href="../../views/adm/panel.php"><i class="fas fa-solar-panel"></i>Panel Administracoón</a>
            </li>
            <li>
                <a href="../../views/adm/normalizacion_limpiar_telefonos.php"><i class="fas fa-filter"></i> (1) Limpiar telefonos</a>
            </li>
            <li>
                <a href="../../views/adm/normalizacion_juntar_telefonos_clientes.php"><i class="fas fa-sort-amount-up-alt"></i> (2) Ordenar telefonos</a>
            </li>
            <li>
                <a href="../../views/adm/normalizacion_validar_telefonos.php"><i class="fas fa-tasks"></i></i> (3) Validar telefonos</a>
            </li>
            <li>
                <a href="../../views/adm/normalizacion_limpiar_validados.php"><i class="fas fa-phone"></i> (4) Limpiar telefonos validados</a>
            </li>
            <li>
                <a href="../../views/adm/ingresar_base.php"><i class="fas fa-database"></i>Ingresar Base Express</a>
            </li>
            
          

            <li>
                <a href="../../views/adm/destroy.php"><i class="fas fa-sign-out-alt"></i>Salir</a>
            </li>



        </ul>



    </div>

   