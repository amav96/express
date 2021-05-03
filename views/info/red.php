<?php require_once 'views/layout/header.php'; ?>

<link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/parcel/recursos_parcel.css">

<div class="container-artisan">

    <div class="container-titulo-red">
        <span class="titulo">El cliente elige que prefiere de la red Express.</span>
        <br>
        <br>
        <span class="interval" id="r1">Más fácil</span>
        <span class="interval" id="r2">Gratis</span>
        <span class="interval" id="r3">Rápido</span>
        <span class="interval" id="r4">Donde sea</span>
    </div>


    <div class="container-parcel">
        <div class="box-parcel">


            <div class="padre-box">

                <div class="cuadro-parcel">
                    <a href="https://api.whatsapp.com/send?phone=+5491138622964&text=Hola%20Express%20,%20solicito%20cupon%20para%20devolver%20mi%20equipo%20en%20un%20comercio%20cerca%20de%20mi%20domicilio.%20Encontré%20este%20medio%20de%20devolución%20en%20la%20Web%20Oficial" target="_blank">

                        <!-- <div class="box-medios-de-entrega"> -->

                        <img class="img-parcel" src="<?= base_url ?>estilos/imagenes/front/shop.png" alt="">
                        <span><strong>Red de comercios Express</strong></span>
                           <span> Express cuenta con una extensa cantidad de comercios adheridos a nivel nacional e
                            internacional para recepcionar y entregar equipos, paquetes e insumos. </span>
                        <!-- </div> -->

                    </a>
                </div>

                <div class="cuadro-parcel">
                    <a href="https://api.whatsapp.com/send?phone=+5491138622964&text=Hola%20Express%20,%20solicito%20cupon%20para%20devolver%20mi%20equipo%20en%20un%20comercio%20cerca%20de%20mi%20domicilio.%20Encontré%20este%20medio%20de%20devolución%20en%20la%20Web%20Oficial" target="_blank">

                        <!-- <div class="box-medios-de-entrega"> -->

                        <img class="img-touch" src="<?= base_url ?>estilos/imagenes/front/chose.png" alt="">

                        <!-- </div> -->

                    </a>
                </div>


                <div class="cuadro-parcel">
                    <a href="https://api.whatsapp.com/send?phone=+5491138622964&text=Hola%20Express%20,%20solicito%20cupon%20para%20devolver%20mi%20equipo%20por%20correo.%20Encontré%20este%20medio%20de%20devolución%20en%20la%20Web%20Oficial" target="_blank">

                        <!-- <div class="box-medios-de-entrega"> -->


                        <img class="img-parcel" src="<?= base_url ?>estilos/imagenes/front/correo.png" alt="">
                        <span><strong>Correo publico y privados</strong></span>
                        <span>El cliente puede elegir la opción de entregarlo en el correo mas cercano a su
                            domicilio, buscamos siempre la comodidad del cliente, totalmente gratis.
                        </span>


                        <!-- </div> -->

                    </a>
                    <button id="descargarCupon" class="btn btn-danger">Descargar cupón</button>
                </div>

                <div class="cuadro-parcel">
                    <a href="https://api.whatsapp.com/send?phone=+5491138622964&text=Hola%20Express%20,%20solicito%20cupon%20para%20devolver%20mi%20equipo%20en%20una%20terminal%20de%20omnibus.%20Encontré%20este%20medio%20de%20devolución%20en%20la%20Web%20Oficial" target="_blank">

                        <!-- <div class="box-medios-de-entrega"> -->

                        <img class="img-parcel" src="<?= base_url ?>estilos/imagenes/front/autobus.png" alt="">
                        <span><strong>Terminales de omnibus</strong></span>
                        <span>Tenemos aliados en territorio nacional e internacional, por lo cual contamos con las
                            Terminales de omnibus asociadas a Express para recepcionar y enviar paquetes totalmente
                            gratis.</span>




                        <!-- </div> -->
                    </a>
                </div>

                <div class="cuadro-parcel">
                    <a href="https://api.whatsapp.com/send?phone=+5491138622964&text=Hola%20Express%20,%20solicito%20visita%20pactada%20para%20devolver%20mi%20équipo%20.%20Encontré%20este%20medio%20de%20devolución%20en%20la%20Web%20Oficial" target="_blank">

                        <!-- <div class="box-medios-de-entrega"> -->

                        <img class="img-parcel" src="<?= base_url ?>estilos/imagenes/front/car2.png" alt="">
                        <span><strong>Visita pactada</strong></span>
                        <span>Si el cliente decide que para el es mas comodo que un recolector de Express lo visite
                            en su domicilio y retirarle el equipo. El cliente entre tantas opciones escogera la mas
                            comoda. </span>


                        <!-- </div> -->
                    </a>
                </div>

            </div>
        </div>
    </div>


    <div class="container-segundo-titulo">
        <div class="segundo-titulo-box arriba">
            <span class="taitel">Tengo un equipo y quiero entregarlo!</span>
        </div>
        <div class="segundo-titulo-box abajo">
            <!-- <span class="trabajopor">Sabemos en que ambiente se mueve el cliente y como hacerlo sentir comodo.</span> -->
            <a href="https://api.whatsapp.com/send?phone=+5491138622964&text=Hola%20Express%20,%20solicito%20información%20para%20devolver%20mi%20équipo%20.%20Encontré%20este%20medio%20de%20devolución%20en%20la%20Web%20Oficial" target="_blank">
                <img src="https://media.giphy.com/media/DRinNvjCXc5Iexx0CH/giphy.gif">
            </a>
        </div>
    </div>



    <div class="container-titulo-territorio">
        <div class="box-territorio">
            <span class="titulo-terriorio">
                ¿Donde opera la red Express?
            </span>
        </div>
    </div>


    <div class="container-mapas-territorio">
        <div class="box-mapa">
            <span class="taitel-mapa">
                Argentina
            </span>
            <img src="<?= base_url ?>estilos/imagenes/front/argentina.png" alt="">
        </div>
        <div class="box-mapa">
            <span class="taitel-mapa">
                Uruguay
            </span>
            <img src="<?= base_url ?>estilos/imagenes/front/uruguay.png" alt="">
        </div>
    </div>


    <div class="preguntas-frecuentes text-center">
        <h4>Preguntas frecuentes</h4>
    </div>


    <div class="accordion">

        <div class="accordion-item">

            <div class="accordion-item-header">
                ¿Que es un comercio Express y que ventajas tiene?
            </div>
            <div class="accordion-item-body">
                <div class="accordion-item-body-content">
                    Un comercio express es una sucursal adherida a Express metropolitana, cumple la funcion de
                    recepcionar equipos previamente pactados. Esta opción es la mejor para generar ingresos extras
                    en tu comercio.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-item-header">
                ¿Que es un Recolector / Repartidor?
            </div>
            <div class="accordion-item-body">
                <div class="accordion-item-body-content">
                    <ul>
                        <li>
                            Recolector : Se encarga de visitar los domicilios donde estan ubicadas los equipos a
                            recuperar, para su busqueda y rendición.
                        </li>
                        <li>
                            Repartidor : Se encarga de buscar equipos, repuestos, documentos y objetos que se
                            necesiten para trasladar desde un punto A determinado a otro punto B, es un tiempo
                            estimado.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-item-header">
                ¿Cuales son los horarios de recuperación y que ventajas ofrece para los clientes?
            </div>
            <div class="accordion-item-body">
                <div class="accordion-item-body-content">
                    <ul style="padding-left: 1rem;">
                        La distribución es de lunes a viernes de 08 a 18 hs, Sabados y domingos.
                    </ul>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-item-header">
                ¿Que dispónibilidad horaria tienen los recolectores?
            </div>
            <div class="accordion-item-body">
                <div class="accordion-item-body-content">
                    La distribución es de lunes a viernes de 08 a 18 hs, Sabados y domingos.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-item-header">
                ¿Como solicito los servicios Express?
            </div>
            <div class="accordion-item-body">
                <div class="accordion-item-body-content">
                    <ul style="padding-left: 1rem;">
                        Podés solicitar el servicio a través de Express Productos, donde eligiras el producto que
                        mas se ajuste a tus necesidades.
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(window).on("load", function() {

        $(document).ready(function() {
            showEquipos()
        })

    });


    $(document).on("click", "#descargarCupon", function() {


        Swal.fire({
            title: '<i class="fa fa-thumbs-up"></i>' + ' ' + '<i class="far fa-file-alt"></i>',
            text: "Al tener el cupon a tu disposición, llenas los datos correspondientes y contactese con nosotros por los siguientes medios  1) Escribirnos al +541138622964. 2) Hacer click en cualquier opción de la red Express. 3) Hacer click en la imagen de Whatsapp en la parte inferior 4) Ingresar a al sección de contacto https://expressmetropolitana.com/views/company/contacto.html. ",


            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Salir',
            confirmButtonText: 'Cupón'
        }).then((result) => {
            if (result.isConfirmed) {



                window.open('http://postalmarketing.com.ar/vap2.jpg', '_blank');
            }
        })

    })


    function showEquipos() {

        setTimeout(function() {
            $("#r1").fadeIn()
            $("#r2").hide()
            $("#r3").hide()
            $("#r4").hide()
        }, 2000);

        setTimeout(function() {
            $("#r1").hide()
            $("#r2").fadeIn()
            $("#r3").hide()
            $("#r4").hide()
        }, 3500);

        setTimeout(function() {
            $("#r1").hide()
            $("#r2").hide()
            $("#r3").fadeIn()
            $("#r4").hide()
        }, 5000);

        setTimeout(function() {
            $("#r1").hide()
            $("#r2").hide()
            $("#r3").hide()
            $("#r4").fadeIn()
        }, 6500);

        setTimeout(function() {
            showEquipos()
        }, 8000);





    }
</script>

<?php require_once 'views/layout/footer.php'; ?>