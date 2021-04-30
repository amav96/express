<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="../../../estilos/personal/js/jquery.min.js"></script>


    <script src="../../../estilos/personal/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../estilos/personal/fontawesome/css/all.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="../../../estilos/personal/css/bootstrap/bootstrap.min.css">

    <!-- <link rel="stylesheet" href="../../../estilos/personal/css/reclute/carta_trabaja_ya.css"> -->

    <!-- <link rel="stylesheet" href="../../../estilos/personal/css/reclute/cardinfo.css"> -->
    <!-- <link rel="stylesheet" href="../../../estilos/personal/css/reclute/carticas.css"> -->
    <link rel="stylesheet" href="../../../estilos/personal/css/adm/recursos_panel.css">
    <link rel="stylesheet" href="../../../estilos/personal/css/adm/recursos_request_shipping.css">
    <link rel="stylesheet" href="../../../estilos/personal/css/sidebarper.css">


</head>

<body>

     <div class="fondoimagen" id="fondoimagen">
        
       
        <img class="logo-main" id="logodos" src="estilos/imagenes/logo2.png" alt="">
    
        <img class="logo-main-dos" id="logouno" src="estilos/imagenes/logo.png" alt="">
    
    </div>
    <nav>
        <div class="contenedordemenu">
            <ul>
                <li>
                    <a href="../../index.html">

                        <div class="fondocirculodelicono">
                            <i class="iconoadentrodelcirculo fas fa-home"></i>
                        </div>

                        <p class="textoicono">Inicio</p>

                    </a>
                </li>
                <li>
                    <a href="../../nosotros.html">

                        <div class="fondocirculodelicono">
                            <i class="iconoadentrodelcirculo fas fa-box-open"></i>
                        </div>

                        <p class="textoicono">#Express</p>

                    </a>
                </li>
                <li>
                    <a href="../../productos.html">

                        <div class="fondocirculodelicono">
                            <i class="iconoadentrodelcirculo fas fa-mobile-alt"></i>
                        </div>

                        <p class="textoicono">Productos</p>

                    </a>
                </li>
                <li>
                    <a href="../../contacto.html">

                        <div class="fondocirculodelicono">
                            <i class="iconoadentrodelcirculo fas fa-phone"></i>
                        </div>

                        <p class="textoicono">Contacto</p>

                    </a>
                </li>
                <li>
                    <a href="">

                        <div class="fondocirculodelicono adm">
                            <i class="iconoadentrodelcirculo fas fa-user"></i>
                        </div>

                        <p class="textoicono">Login</p>

                    </a>
                </li>
                <li>
                    <div class="solicitudes" id="solicitudes">
                        <div class="caja-notificacion" id="caja-notificacion">
            
                        </div>
                    
                        <div class="fondocirculodelicono adm">
                            <i class="iconoadentrodelcirculo fas fa-bell"></i>
                        </div>

                        <p class="textoicono">Solicitudes</p>
                    </div>
                        <div class="despliegue-notificacion" id="despliegue-notificacion">
            

                        </div>

                   
                </li>
            </ul>
        </div>
    </nav>
   
    <!--Carousel Wrapper-->



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
                <a href="../../views/products/corporativo.html"><i class="fas fa-truck"></i>Logistica inversa</a>
            </li>
            <li>
                <a href="../../views/products/corp-traslados.html"><i class="fas fa-stream"></i>Distribución</a>
            </li>
            <li>
                <a href="../../views/products/ecommerce.html"><i class="fas fa-laptop"></i>Ecommerce</a>
            </li>
            <li>
                <a href="../../views/products/particulares.html"><i class="fas fa-box-open"></i>Particulares</a>
            </li>
            
            <li>
                <a href="../../views/products/productos.html"><i class="fas fa-shopping-bag"></i>Productos</a>
            </li>
            <li>
                <a href="../../views/company/nosotros.html"><i class="fas fa-envelope"></i>#Express</a>
            </li>
            <li>
                <a href="../../views/company/contacto.html"><i class="fas fa-phone"></i>Contacto</a>
            </li>
            <li>
                <a href="../../views/login/loginUs.php"><i class="fas fa-users"></i>Login</a>
            </li>

        </ul>



    </div>




<?php include_once('../../model/parcel/request-data.php'); 

echo $_GET['id'];?>
     <!-- --------------------------------2------------------------------------------->
 <div class="container-artisan">

    <!-- -----------------POST NOTIFICACION-------------->
    <div class="container-request" id="container-request">
        <div class="box-request">
            <div class="mini-box-request">
                <div class="informacion" id="informacion">

                </div>
            </div>
        </div>
    </div>

   <!-- -----------------MUESTRO SOLICITUD-------------->


<div class="container-show-data">
    <div class="box-show-data">
        <div class="mini-box-show-data">
            <div class="informacion-show-data" id="data_completed">
                 
            </div>
        </div>
    </div>
</div>

</div>


    <script src="../../../assets/parcel/notificaciones.js"></script>
    <script src="../../estilos/personal/js/logo.js"> </script>


</body>

</html>



