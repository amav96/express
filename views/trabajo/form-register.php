<?php require_once 'views/layout/headerReclute.php'; ?>
<style>
    .error {
        display: flex;
        justify-content: center;
        align-content: center;
        align-self: center;
        border-radius: 15px;
        padding: 5px;
        background: #D32F2F;

    }
</style>

<?php
if (isset($_SESSION["username"])) {

    if ($_SESSION["username"]->status_process === 'first') { ?>
        <div class="requisitos" id="requisitos" style="text-align:center;"><strong>A continuacion te solicitaremos lo siguiente:</strong>

            <p class="prequisito">
                -Constancia de monostributo (Si no lo tenés, podes darle de alta en plena gestión).
            </p>
            <p class="prequisito">
                -Foto frontal y dorsal del documento de identidad.
            </p>
            <p class="prequisito">
                -Foto de una constancia de domicilio.
            </p>
            <p class="prequisito">
                -Foto de tu cuit/rut.
            </p>
            <p class="prequisito">
                -Foto frontal de tu cara.
            </p>
            <?php if ($_SESSION["username"]->role === 'comercio') { ?>
                <p class="prequisito">
                    -Foto frontal del comercio.
                </p>
            <?php } ?>
            <p style="color:red;" class="prequisito">
                <strong class="nota">Nota : Recomendamos realizar el registro conectad@ a una red Wi fi. </strong>
            </p>
            <p style="margin:auto;text-align:center;">
                <img style="width:150px;height:90px;margin:auto;" src="../estilos/imagenes/front/car2.png" alt="">
            </p>

            <button id="empezar">Registrarme</button>

        </div>


        <div class="container form-first" id="container-form">

            <?php
            if (isset($_SESSION["register"])) {

                if ($_SESSION["register"] === 'failed') { ?>
                    <h5 class="alerta alerta-red">No te has podido registrar exitosamente. Comunicate con nosotros <a href="<?= base_url ?>express/contacto" target="_blank"> Contactar</a> </h5>

                <?php  } else if ($_SESSION["register"] === 'register-incomplete') { ?>
                    <h5 class="alerta alerta-red">No hemos podido registrarlo correctamente. Comunicate con nosotros <a href="<?= base_url ?>express/contacto" target="_blank"> Contactar</a> </h5>
                <?php } else if ($_SESSION["register"] === 'incomplete') { ?>
                    <h5 class="alerta alerta-red">No hemos recibido los requisitos necesarios para el registro. Vuelve a intentarlo</h5>
                <?php  } else if ($_SESSION["register"] === 'no-hay-tipo') { ?>
                    <h5 class="alerta alerta-red">No reconocemos la solicitud. Comunicate con nosotros <a href="<?= base_url ?>express/contacto" target="_blank"> Contactar</a< /h5>
                        <?php } else if ($_SESSION["register"] === 'incomplete-data') { ?>
                            <h5 class="alerta alerta-red">No hemos recibido los requisitos necesarios para el registro. Comunicate con nosotros <a href="<?= base_url ?>express/contacto" target="_blank"> Contactar</a></h5>
                    <?php }
                } ?>


                    <header>Registrate para empezar!</header>
                    <div class="progress-bar">
                        <div class="step">
                            <p>
                            </p>
                            <div class="bullet">
                                <span>1</span>
                            </div>
                            <div class="check fas fa-check">
                            </div>
                        </div>
                        <div class="step">
                            <p>
                            </p>
                            <div class="bullet">
                                <span>2</span>
                            </div>
                            <div class="check fas fa-check">
                            </div>
                        </div>
                        <div class="step">
                            <p>
                            </p>
                            <div class="bullet">
                                <span>3</span>
                            </div>
                            <div class="check fas fa-check">
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-outer">
                        <form action="<?= base_url ?>usuario/registerComplete" id="datosPost" method="POST" enctype="multipart/form-data">
                            <div class="page slide-page">

                                <div class="field">
                                    <div class="label" id="textDomicilio">
                                        Domicilio</div>
                                    <input type="text" name="domicilio" id="domicilio">
                                </div>
                                <div class="field">
                                    <div class="label">Documento <span style="color:red;font-size:11px;" id="errorDoc"> </span> </div>
                                    <select id="tipo-documento" name="tipo-documento" class="caracteristica">
                                        <option value="dni">DNI</option>
                                        <option value="enrolamiento">Cedula</option>
                                        <option value="pasaporte">Pasaporte</option>
                                        <option value="civ">L.Civica</option>
                                        <option value="enrolamiento">L. Enrolamiento</option>
                                    </select>

                                    <input type="text" name="numero-documento" id="numero-documento" placeholder="Documento">
                                </div>

                                <div class="field">
                                    <div class="label" style="font-size:13px;">
                                        <span id="textNroCuit">Monotributo</span> <span style="color:red;" id="textRut"></span>
                                    </div>
                                    <input type="text" name="monotributo" id="monotributo">
                                </div>

                                <div id="errorMonotribute" style="width:auto; transform: translateY(-5px);margin-bottom:50px;" class="error">

                                </div>

                                <div class="field">
                                    <div class="label">
                                        <div id="textImgConstancia" style="text-align:left; font-size:13px;"> Constancia de inscripción AFIP</div>
                                    </div>
                                    <input type="file" class="footer-dos-input" name="imgMonotributo" id="imgMonotributo">
                                    <!-- <input type="text" placeholder="id usuario zona" id="id_user_zona_corresponde"> -->
                                </div>
                                <!-- MENSAJE -->
                                <div class="container-monotributo" id="container-monotributo">
                                    <div class="box-monitributo" id="box-monitributo">
                                    </div>
                                </div>

                                <div class="field footer-dos">
                                    <button class="firstNext next" id="primer-siguiente">Siguiente</button>
                                </div>
                            </div>

                            <!-- --------------------------------------------------------- -->
                            <div class="page">

                                <div class="field">
                                    <div class="label">
                                        Foto frontal documento</div>
                                    <input type="file" name="imgDocumentoFrontal" id="imgDocumentoFrontal">
                                </div>
                                <div class="field">
                                    <div class="label">
                                        Foto dorsal documento</div>
                                    <input type="file" name="imgDocumentoDorsal" id="imgDocumentoDorsal">
                                </div>
                                <div class="field">
                                    <div class="label">
                                        <span id="textImgCuil">Foto CUIL/CUIT</span>
                                    </div>
                                    <input type="file" name="imgCuilRut" id="imgCuilRut">
                                </div>
                                <div class="field">
                                    <div class="label" style="font-size: 0.7rem;">
                                        Comprobante de domicilio / Servicio</div>
                                    <input type="file" name="imgComprobanteDomicilio" id="imgComprobanteDomicilio">
                                </div>

                                <div class="field btns ">
                                    <button class="prev-1 prev" id="secondPrev">Atras</button>
                                    <button class="next-1 next" id="secondNext">Siguiente</button>
                                </div>
                            </div>

                            <!-- --------------------------------------------------------- -->
                            <div class="page">

                            <div class="field" id="cont-selfie">
                                    <div class="label">
                                        Foto frontal "Selfie"</div>
                                    <input type="file" name="imgFrontalPersona" id="imgFrontalPersona">
                                </div>
                                <?php if ($_SESSION["username"]->role === 'comercio') { ?>

                                    <div class="field" id="cont-commerce">
                                        <div class="label">
                                            Foto frontal del comercio</div>
                                        <input type="file" name="imgFrontalCommerce" id="imgFrontalCommerce">
                                    </div>


                                <?php } ?>

                                <div class="field" id="cont-telefono">
                                    <div class="label">Telefono</div>
                                    <input type="text" name="telefono_celular" id="telefono_celular">
                                </div>


                                <div class="field" id="cont-conocimiento">
                                    <div class="label">¿Como nos conociste?</div>
                                    <select name="via_conocimiento" id="via_conocimiento">
                                        <option value="0">Seleccion opción</option>
                                        <option value="facebook">Facebook</option>
                                        <option value="instagram">Instagram</option>
                                        <option value="google">Google</option>
                                        <option value="gallito-luis">Gallito Luis</option>
                                        <option value="empleo-clarin">Empleos clarin</option>
                                        <option value="recomendacion-de-ex-contratista">Recomendación de alguien que presto servicio para Express</option>
                                        <option value="recomendacion-terceros">Recomendación de un tercero</option>
                                        <option value="otros">Otros</option>
                                    </select>
                                </div>

                                <!-- datos utiles -->
                                <input type="hidden" name="id_reclute_guia" id="id_reclute_guia" value="<?= $_SESSION["username"]->id ?>">
                                <input type="hidden" name="fecha" id="fecha">
                                <input type="hidden" value="<?= $_SESSION["username"]->role ?>" id="tipo-user">
                                <input type="hidden" value="<?= $_SESSION["username"]->country ?>" id="getPais">


                                <!-- FIN DEL MENSAJE -->

                                <div class="field btns" id="footer-btn">
                                    <button class="prev-2 prev">Atras</button>
                                    <button class="submit" id="preparar">Listo</button>
                                </div>
                                <div id="last-page"></div>
                                <div id="loaderSend"></div>
                            </div>

                          

                            <!-- --------------------------------------------------------- -->

                                <!-- <div class="field btns" id="footer-btn">
                                    <button class="prev-3 prev">Atras</button>
                                    <button class="submit" id="preparar">Listo</button>
                                </div> -->


                            <!-- </form> -->
                    </div>
        </div>


<?php }
} else {
    header('Location:' . base_url);
}
Utils::deleteSession('register');
?>


<?php require_once 'views/layout/footerReclute.php'; ?>