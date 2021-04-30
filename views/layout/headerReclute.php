<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="shortcut icon" href="<?=base_url?>estilos/imagenes/logo/logo.png">
    <title>Express | ¿Necesitas nuestro servicio de logistica inversa? ¡Traslada!</title>
    
    <script src="<?=base_url?>estilos/personal/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="<?=base_url?>estilos/personal/fontawesome/css/all.css">
    
  
  <?php if(isset($_SESSION["estilo"]) && $_SESSION["estilo"] === 'register'){?>
<link rel="stylesheet" href="<?=base_url?>estilos/personal/css/reclute/recursos_form_step.css?v=05042021">
      
  <?php }else if(isset($_SESSION["estilo"]) && $_SESSION["estilo"]->status_process ==='sign_contract' ){ ?>
    <script src="<?=base_url?>estilos/personal/js/jquery.min.js"></script>
    <script src="<?=base_url?>estilos/personal/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?=base_url?>estilos/personal/css/bootstrap/bootstrap.min.css">
  <?php   } ?>
    <link rel="stylesheet" href="<?=base_url?>estilos/personal/css/sidebarper.css">
    <link rel="stylesheet" href="<?=base_url?>estilos/personal/css/reclute/recursos_recolector.css?v=05042021">
    
    
</head>
<body>



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
            
            <?php if(!isset($_SESSION["username"])){ ?>
            <li>
                <a href="<?= base_url ?>usuario/viewLogin">

                    <div class="fondocirculodelicono adm">
                        <i class="iconoadentrodelcirculo fas fa-users"></i>
                    </div>

                    <p class="textoicono">Login</p>

                </a>
            </li>
            
             <?php } ?>

           
            <?php if (isset($_SESSION["username"]) && $_SESSION["username"]->role === 'admin') { ?>

                <li>
                    <a href="<?= base_url ?>usuario/admin">

                        <div class="fondocirculodelicono adm">
                            <i class="iconoadentrodelcirculo fas fa-user"></i>
                        </div>

                        <p class="textoicono">Panel</p>

                    </a>
                </li>
            <?php } else if(isset($_SESSION["username"]) )  {
                if($_SESSION["username"]->role === 'recolector' || $_SESSION["username"]->role === 'call' && $_SESSION["username"]->status_process === 'first' ||  $_SESSION["username"]->status_process === 'registered' ){

                ?>

                <li>
                        <div class="fondocirculodelicono adm">
                            <i class="iconoadentrodelcirculo fas fa-rocket"></i>
                        </div>

                        <p class="textoicono"><strong><?=$_SESSION["username"]->name?></strong>  </p>

                    
                </li>
            <?php }   }?>
        </ul>
    </div>
    </nav>



    <input type="checkbox" id="cuadraditocheck">
    <label for="cuadraditocheck">
        <i class="fas fa-bars" id="boton"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebarper completo">
        <header>Express</header>
        <ul class="completo">
           
            <?php if(isset($_SESSION["username"])){
                if($_SESSION["username"]->role === 'recolector' || $_SESSION["username"]->role === 'call' && $_SESSION["username"]->status_process === 'first' ||  $_SESSION["username"]->status_process === 'registered'){   
                 ?>
                <li>
                <a href=""><i class="fas fa-rocket"></i><?=$_SESSION["username"]->name?></a>
                </li>

            <?php }else{ ?>

                <li>

                <a href="express/contacto"><i class="fas fa-users"></i>Login</a>
                </li>

                <?php    } 
                }  ?>

            <li>
                <a href="<?=base_url?>"><i class="fas fa-home"></i>Inicio</a>
            </li>
        

            <li>
                <a href="views/products/productos.html"><i class="fas fa-shopping-bag"></i>Productos</a>
            </li>

            

            <li>
                <a href="views/company/contacto.html"><i class="fas fa-phone"></i>Contacto</a>
            </li>
            
            <li>
                <a href="<?=base_url?>usuario/logOut"><i class="fas fa-sign-out-alt"></i>Salir</a>
            </li>

            <?php if(isset($_SESSION["username"])){ ?>
            <li>
				<a href="<?=base_url?>usuario/showContract&mh=<?=$_SESSION["username"]->mail_hash?>&idc=<?=$_SESSION["username"]->id_number?>" id="cerrarSesion"><i class="fas fa-users"></i>Mis datos</a>
			</li>



        <?php   
        } ?>
        </ul>
    </div>