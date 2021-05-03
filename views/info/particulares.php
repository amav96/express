<?php require_once 'views/layout/header.php'; ?>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">
    <link rel="stylesheet" href="<?=base_url?>estilos/personal/css/slider_blog.css">

    <link rel="stylesheet" href="<?=base_url?>estilos/personal/css/particulares/recursos_particulares.css">


<section class="banner">
    <div class="container-artisan">
        <div class="aumenta-ventas">
        <div class="row pr-lg-4">
            <div class="col-md-5 d-flex align-items-center">
                <div>

                    <h2 class="">Envia lo que quieras.</h2>
                    <p class="">Express sin limites</p>
                    <div class="text-center">
                       <a href="<?=base_url?>express/contacto"><button class="btn btn-info " type="submit">Solicitar</button></a> 
                    </div>
                </div>
            </div>
            <div class="col-md-7 mb-4">

                <div class="view">
                    <div class="text-center">
                        <img src="<?=base_url?>estilos/imagenes/front/pedir.png" style="width: 20rem;" class="redondeotargetasuavemin"
                            alt="smaple image">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</section>
    <div class="container-artisan">
        <div class="titulo-principal-beneficios">
            <h2>¿Cómo funciona?</h2>

        </div>
    </div>
    <div class="container-artisan">
        <div class="contenedor-como-funciona" >
            <div class="box-como-funciona">
                <div class="ilustracion-como-funciona">
                    <img class="imagen-como-funciona" src="<?=base_url?>estilos/imagenes/como_funciona/technology.png" alt="">
                    <p>Recibimos tu pedido</p>
                </div>
            </div>
            <div class="box-como-funciona">
                <div class="ilustracion-como-funciona">
                    <img class="imagen-como-funciona" src="<?=base_url?>estilos/imagenes/como_funciona/delivery.png" alt="">
                    <p>Enviamos un mensajero</p>
                </div>
            </div>
            <div class="box-como-funciona">
                <div class="ilustracion-como-funciona">
                    <img class="imagen-como-funciona" src="<?=base_url?>estilos/imagenes/como_funciona/box.png" alt="">


                    <p>Recogemos el paquete</p>
                </div>
            </div>
            <div class="box-como-funciona">
                <div class="ilustracion-como-funciona">
                    <img class="imagen-como-funciona" src="<?=base_url?>estilos/imagenes/como_funciona/product.png" alt="">
                    <p>Entregamos en destino</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-artisan">
        <div class="titulo-principal-beneficios-dos">
            <h2>Es muy fácil</h2>

        </div>
    </div>

    <div class="container-artisan">
        <aside class="section-slider">
            <div class="slider-ecommerce" >
                <div class="swiper-wrapper">
                    <div class="slider-item swiper-slide">
                        <div class="slide-img">
                            <img src="<?=base_url?>estilos/imagenes/car/entregando1.jpg" alt="">
                        </div>

                        <div class="content-slider">
                            <div class="title-slider">¡Entregas Express!</div>
                            <div class="text-slider">Rápido y fiable. Así es como quiere recibir su envío. Y,
                                precisamente
                                así, es como Express -en nombre del remitente- quiere entregárselo.

                                .</div>
                            <span class="time-slider">Express</span>
                            <a href="<?=base_url?>express/contacto" class="button-slider">Enviar</a>
                        </div>
                    </div>
                    <div class="slider-item swiper-slide">
                        <div class="slide-img">
                            <img src="<?=base_url?>estilos/imagenes/car/send.jpg" alt="">
                        </div>

                        <div class="content-slider">
                            <div class="title-slider">¡Pide y envia lo que sea!</div>
                            <div class="text-slider">Envia tus paquetes con total seguridad y rapidez.</div>
                            <span class="time-slider">Express</span>
                            <a href="<?=base_url?>express/contacto" class="button-slider">Enviar</a>
                        </div>
                    </div>
                </div>
                <div class="slider-pagination"></div>
            </div>
    </div>
    </aside>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"> </script>
    <script src="<?=base_url?>estilos/personal/js/blog.js"></script>
<?php require_once 'views/layout/footer.php'; ?>