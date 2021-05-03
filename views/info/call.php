
    
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
                        <img src="<?=base_url?>estilos/imagenes/car/cel.png">
                    </div>
                    <div class="contentBx">
                        <h2>Smartphone</h2>
                        <div class="size">
                            <h3>Estado</h3>
                            <span>Disponbile</span>

                        </div>
                        <div class="color">

                            <span><i class="fas fa-coins"></i></span>
                            <span><i class="far fa-calendar-check"></i></span>
                            <span><i class="fas fa-user"></i></span>

                        </div>
                        <a id="celular"   href="<?=base_url?>usuario/Register">Trabajar ya!</a>
                    </div>
                </div>
            </div>






           

            <!-- Card -->

            <div class="containercarta">
                <div class="cardcarta">
                    <div class="imgBx">
                        <img src="<?=base_url?>estilos/imagenes/car/laptop.png">
                    </div>
                    <div class="contentBx">
                        <h2>Nootebok / Pc</h2>
                        <div class="size">
                            <h3>Estado</h3>
                            <span>Disponbile</span>
                        </div>
                        <div class="color">

                            <span><i class="fas fa-coins"></i></span>
                            <span><i class="far fa-calendar-check"></i></span>
                            <span><i class="fas fa-user"></i></span>
                        </div>
                        <a id="computadora"  href="<?=base_url?>usuario/Register">Trabajar ya!</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
     
    
    <div class="container-artisan">
        <section class="intro-area white" id="intro">

            <div class="intro-block">
                <span class="intro-icon"><i class="fas fa-money-check-alt"></i></span>
                <h3>Tu compensación</h3>
                <p>
                    Lo que ganás depende de tu esfuerzo y efectividad.
                </p>
            </div>


            <div class="intro-block">
                <span class="intro-icon"><i class="fas fa-calendar-alt"></i></span>
                <h3>Tus tiempos los manejas vos</h3>
                <p>
                    Elige tus horarios para trabajar con total libertad.
                </p>
            </div>


            <div class="intro-block">
                <span class="intro-icon"><i class="fas fa-laptop"></i></span>
                <h3>Lo que vas a necesitar</h3>
                <p>
                    Un iPhone , un dispositivo Android o tener computadora / Nootebook y tener la mejor
                    predisposición.
                </p>
            </div>

    </section>
    </div>

    <script>

  $(document).on("click","#celular",function(){
      localStorage.setItem('tipo','celular')
     
  })

  $(document).on("click","#computadora",function(){
      localStorage.setItem('tipo','computadora')
  })

  
    </script>
<?php require_once 'views/layout/footer.php'; ?>