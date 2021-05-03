<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="<?=base_url?>estilos/imagenes/logo/logo.png">
    <title>Express | ¿Necesitas nuestro servicio de logistica inversa y ultima milla?</title>

    <script src="<?= base_url ?>estilos/personal/js/jquery.min.js"></script>

    <script src="<?= base_url ?>estilos/personal/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/lightslider.css">
    <script src="//cdn.jsdelivr.net/jquery.color-animation/1/mainfile"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    
    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/bootstrap/mdb.min.css">
    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/bootstrap/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/sidebarper.css">

    <link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/index/recursos_index.css?v=05042021">
</head>

<body>
<!-- Código de instalación Cliengo para roberto@postalmarketing.com.ar --> 
<script type="text/javascript">(function () { var ldk = document.createElement('script'); ldk.type = 'text/javascript'; ldk.async = true; ldk.src = 'https://s.cliengo.com/weboptimizer/5f6ba7352e7977002a350241/5f6ba7362e7977002a350245.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ldk, s); })();</script>

  <div class="loader" >
      
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

    
          <?php   
        
          if(isset($_SESSION["username"])){

            if($_SESSION["username"]->role === 'recolector' || $_SESSION["username"]->role === 'call' && $_SESSION["username"]->status_process === 'first'  ||  $_SESSION["username"]->status_process === 'registered'){ ?>

                <li>
                    <div class="fondocirculodelicono adm">
                        <i class="iconoadentrodelcirculo fas fa-rocket"></i>
                    </div>

                    <p class="textoicono"> <strong><?=$_SESSION["username"]->name?></strong> </p>
                </li>

        <?php  }else if($_SESSION["username"]->role==='admin' && $_SESSION["username"]->status_process==='active'){ ?>

            <li>
                <a href="<?= base_url ?>usuario/admin">

                    <div class="fondocirculodelicono adm">
                        <i class="iconoadentrodelcirculo fas fa-rocket"></i>
                    </div>

                    <p class="textoicono">Panel</p>

                </a>
            </li>

            

     <?php   }
          }

            else{ ?>

               <li>
                     <a href="<?= base_url ?>usuario/viewLogin">
                    <div class="fondocirculodelicono adm">
                        <i class="iconoadentrodelcirculo fas fa-rocket"></i>
                    </div>

                    <p class="textoicono"> Login </p>
                   </a>
                </li>

         <?php } ?>


       
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

        <?php  if (!isset($_SESSION["username"]) ) { ?>
            <li>
            <a href="<?=base_url?>usuario/viewLogin"><i class="fas fa-users"></i>Login</a>
            </li>

        <?php } if(isset($_SESSION["username"])){ ?>
        <?php  if($_SESSION["username"]->role==='admin' && $_SESSION["username"]->status_process==='active'){ ?>

            <li>
                <a href="<?=base_url?>usuario/admin"><i class="fas fa-rocket"></i>Panel</a>
            </li>

<?php   } }?>
 
            <li>
                <a href="<?=base_url?>"><i class="fas fa-home"></i>Inicio</a>
            </li>
            <li>
                <a href="<?=base_url?>express/corporativo"><i class="fas fa-truck"></i>Logistica inversa</a>
            </li>
            <li>
                <a href="<?=base_url?>express/traslados"><i class="fas fa-stream"></i>Distribución</a>
            </li> 
            <li>
                <a href="<?=base_url?>express/ecommerce"><i class="fas fa-laptop"></i>Ecommerce</a>
            </li>
            
            <?php
           
            if($info["version"] != '87.0.4280.88'  && $info["version"] != '87.0.4280.86'){ ?>
                <li>
                <a href="<?=base_url?>express/trabajar"><i class="fas fa-truck"></i>Trabajar</a>
            </li>
            <?php }?>
            <li>
                <a href="<?=base_url?>express/contacto"><i class="fas fa-phone"></i>Contacto</a>
            </li>

            <?php   
          
          if(isset($_SESSION["username"])){
   
              if($_SESSION["username"]->status_process === 'registered' || $_SESSION["username"]->status_process === 'first'  ||  $_SESSION["username"]->status_process === 'sign_contract' || $_SESSION["username"]->status_process === 'signed_contract' ){
                  ?>
                  <li>
				  <a href="<?=base_url?>usuario/logOut" ><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</a>
                  </li>
           
                <li>
                <a href="<?=base_url?>usuario/waiting"><i class="far fa-address-card"></i>Mi postulación.</a>
                </li>
            
     

       <?php  } else if($_SESSION["username"]->status_process === 'active'){ ?>
                    <li>
				  <a href="<?=base_url?>usuario/logOut" ><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</a>
                  </li>

     <?php   } 
    } ?>
        </ul>
    </div>