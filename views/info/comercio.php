
    
      <?php require_once 'views/layout/header.php'; ?>
    <link rel="stylesheet" href="<?=base_url?>estilos/personal/css/reclute/recursos_call.css">




    <div class="container-artisan">
        <div class="titulo-escoger">
                <h3>¡Escoge para empezar!</h3>
        </div>
    </div>

    <div class="container-artisan">
        <div class="te-controlo-cartas-trabajo">
            <div class="containercarta">
                <div class="cardcarta">
                    <div class="imgBx">
                        <img src="<?=base_url?>estilos/imagenes/car/local.png">
                    </div>
                    <div class="contentBx">
                        <h2>Comercio / Local </h2>
                        <div class="size">
                            <h3>Estado</h3>
                            <span>Disponbile</span>

                        </div>
                        <div class="color">

                            <span><i class="fas fa-coins"></i></span>
                            <span><i class="far fa-calendar-check"></i></span>
                            <span><i class="fas fa-user"></i></span>

                        </div>
                        <a  id="comercio" href="<?=base_url?>usuario/Register">Trabajar ya!</a>
                    </div>
                </div>
            </div>






            <!-- Card -->

            <div class="containercarta">
                <div class="cardcarta">
                    <div class="imgBx">
                        <img src="<?=base_url?>estilos/imagenes/front/super.png">
                    </div>
                    <div class="contentBx">
                        <h2>Almacen / Otros</h2>
                        <div class="size">
                            <h3>Estado</h3>
                            <span>Disponbile</span>

                        </div>
                        <div class="color">

                            <span><i class="fas fa-coins"></i></span>
                            <span><i class="far fa-calendar-check"></i></span>
                            <span><i class="fas fa-user"></i></span>

                        </div>
                        <a id="comercio" href="<?=base_url?>usuario/Register">Trabajar ya!</a>
                    </div>
                </div>


            </div>

        </div>
    </div>
       
    <div class="container-artisan">
        <section class="intro-area white" id="intro">

            <div class="intro-block">
                <span class="intro-icon"><i class="fas fa-money-check-alt"></i></span>
                <h3>Generá ingresos extras!</h3>
                <p>
                    Recibe equipos y productoss de nuestros clientes asociados. Cada equipo tiene un valor.
                </p>
            </div>


            <div class="intro-block">
                <span class="intro-icon"><i class="fas fa-calendar-alt"></i></span>
                <h3>Tus tiempos los manejas vos</h3>
                <p>
                   Sin restricciones de horarios.
                </p>
            </div>


            <div class="intro-block">
                <span class="intro-icon"><i class="fas fa-truck"></i></span>
                <h3>Lo que vas a necesitar</h3>
                <p>
                    Disponibilidad y buen trato con los clientes.
                </p>
            </div>

    </section>
    </div>

    <script>

$(document).on("click","#comercio",function(){
      localStorage.setItem('tipo','comercio')
     
  })




    </script>

    
<?php require_once 'views/layout/footer.php'; ?>