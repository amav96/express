      <?php require_once 'views/layout/header.php'; ?>

      <link rel="stylesheet" href="<?=base_url?>estilos/personal/css/reclute/recursos_empleado.css">

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
                    <img src="<?=base_url?>estilos/imagenes/car/autoreco1.png">
                </div>
                <div class="contentBx">
                    <h2>Auto</h2>
                    <div class="size">
                        <h3>Estado</h3>
                        <span>Disponbile</span>

                    </div>
                    <div class="color">

                        <span><i class="fas fa-coins"></i></span>
                        <span><i class="far fa-calendar-check"></i></span>
                        <span><i class="fas fa-user"></i></span>

                    </div>
                    <a id="empleado" href="<?=base_url?>usuario/Register">Trabajar ya!</a>
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
                Traslada con total libertad. Elegí las zonas que queres y como lo haces.
            </p>
        </div>


        <div class="intro-block">
            <span class="intro-icon"><i class="fas fa-truck"></i></span>
            <h3>Lo que vas a necesitar</h3>
            <p>
                Tu vehículo (moto, bicicleta o auto), un iPhone o un dispositivo Android y tener la mejor
                predisposición.
            </p>
        </div>

    </section>



    <div class="container-complete-info">
        <div class="box-complete">
            <div class="texto-complete">
                <span class="fuente-texto">Si ya te registraste por primera vez, ingresa aqui para completar tu solicitud</span>

            </div>
            <a href="<?=base_url?>usuario/finishDataEmployee">
                <div class="boton-complete">
                    Completar solicitud
                </div>
            </a>
        </div>

    </div>
</div>

<script>

$(document).on("click","#empleado",function(){
      localStorage.setItem('tipo','empleado')
     
  })
</script>

<?php require_once 'views/layout/footer.php'; ?>