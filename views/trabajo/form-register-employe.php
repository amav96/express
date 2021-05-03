<?php require_once 'views/layout/headerReclute.php'; ?>


<style>
    .requisitos {
        display: flex;
        justify-content: center;
        text-align: center;
        flex-direction: column;
        margin: 2rem auto;
    }
</style>

<?php


echo '<pre>';
print_r($_SESSION);
echo '</pre>';




if (isset($_SESSION["username"])) {
    if ($_SESSION["username"]->status_process === 'first') { ?>


        <h5></h5>

        <div class="requisitos" id="requisitos">
            A continuacion se te solcitaran los siguienre requitos. te recomendamos que los tengas listos
            lo completaras en menos de 3 minutos
            <ul>
                <li>
                    Nro de telefono movil
                </li>
                <li>
                    Provincia, localidad, domicilio, codigo postal
                </li>
                <li>
                    Constancia de monostributo (Si no lo tenes, podes darle de alta en plena gestion)
                </li>
                <li>
                    foto frontal y posterior del documento de identidad
                </li>
                <li>
                    foto de una constancia de dommicilio
                </li>
                <li>
                    foto de tu cuit/rut
                </li>
                <li>
                    foto frontal de tu cara
                </li>

            </ul>
            <button id="empezar">Muy bien, estoy listo para empezar!</button>
        </div>

        <div class="container form-first" id="container-form">


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
                <div class="step">
                    <p>
                    </p>
                    <div class="bullet">
                        <span>4</span>
                    </div>
                    <div class="check fas fa-check">
                    </div>
                </div>
            </div>
            <div class="form-outer">
                <form action="" id="datosPost" enctype="multipart/form-data">
                    <div class="page slide-page">




                        <div class="field">
                            <div class="label">
                                Pais</div>
                            <select name="pais" id="pais">

                            </select>
                        </div>
                        <div class="field">
                            <div class="label">
                                Provincia</div>
                            <select name="provincia" id="provincia">

                            </select>
                        </div>
                        <div class="field">
                            <div class="label">
                                Localidad</div>
                            <input type="text" id="localidad">
                        </div>

                        <div class="field">
                            <div class="label">
                                Codigo Postal</div>
                            <input type="text" id="codigoPostal">
                        </div>
                        <div class="box-cp">
                            <!-- <a class="cp" href="https://www.correoargentino.com.ar/formularios/cpa" target="_blank">Consulta tu Codigo Postal</a> -->



                            <!-- <a class="cp" href="https://www.correo.com.uy/codigospostales" target="_blank">Consulta tu Codigo Postal</a> -->
                        </div>

                        <div class="field">
                            <button class="firstNext next" id="primer-siguiente">Siguiente</button>
                        </div>
                    </div>


                    <div class="page">
                        <div class="field">
                            <div class="label">
                                Domicilio</div>
                            <input type="text" id="domicilio">
                        </div>
                        <div class="field">
                            <div class="label">
                                Documento</div>
                            <select id="tipo-documento" class="caracteristica">
                                <option value="dni">DNI</option>
                                <option value="enrolamiento">Cedula</option>
                                <option value="pasaporte">Pasaporte</option>
                                <option value="civ">L.Civica</option>
                                <option value="enrolamiento">L. Enrolamiento</option>
                            </select>

                            <input type="text" id="numero-documento" placeholder="Documento">
                        </div>



                        <div class="field">
                            <div class="label" style="font-size:13px;">
                                Posees Monotributo / AFIP / o Mides </div>
                            <select id="monotributo">
                                <option value="0">Seleccione opción</option>
                                <option value="si">si</option>
                                <option value="no">no</option>

                            </select>
                        </div>
                        <div class="field">
                            <div class="label">
                                Constancia de inscripción</div>
                            <input type="file" name="imgMonotributo" id="imgMonotributo">
                            <!-- <input type="text" placeholder="id usuario zona" id="id_user_zona_corresponde"> -->
                        </div>
                        <!-- MENSAJE -->
                        <div class="container-monotributo" id="container-monotributo">
                            <div class="box-monitributo" id="box-monitributo">
                            </div>
                        </div>



                        <div class="field btns">
                            <button class="prev-1 prev" id="secondPrev">Atras</button>
                            <button class="next-1 next" id="secondNext">Siguiente</button>
                        </div>
                    </div>


                    <div class="page">
                        <!-- <div class="title">
    Contact Info:</div> -->


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
                                Foto CUIL o RUT</div>
                            <input type="file" name="imgCuilRut" id="imgCuilRut">
                        </div>
                        <div class="field">
                            <div class="label" style="font-size: 1rem;">
                                Comprobante de domicilio / Servicio</div>
                            <input type="file" name="imgComprobanteDomicilio" id="imgComprobanteDomicilio">
                        </div>


                        <!-- FIN DEL MENSAJE -->

                        <div class="field btns">
                            <button class="prev-2 prev">Atras</button>
                            <button class="next-2 next" id="thridNext">Siguiente</button>
                        </div>
                    </div>
                    

                    <div class="page">

                        <div class="field">
                            <div class="label">
                                Foto frontal "Selfie"</div>
                            <input type="file" name="imgFrontalPersona" id="imgFrontalPersona">
                        </div>


                        <div class="field">
                            <div class="label">Telefono</div>
                            <input type="text" id="telefono_celular">
                        </div>


                        <div class="field">
                            <div class="label">
                                ¿Como nos conociste?</div>
                            <select id="via_conocimiento">
                                <option value="facebook">Facebook</option>
                                <option value="instagram">Instagram</option>
                                <option value="google">Google</option>
                                <option value="gallito-luis">Gallito Luis</option>
                                <option value="empleo-clarin">Empleos clarin</option>
                                <option value="otros">Otros</option>

                            </select>
                        </div>

                        <input type="hidden" id="id_reclute_guia" value="<?= $_SESSION["username"]->id_user ?>">

                        <span style="color: black;" id="procesando" class="procesando">Enviando...</span>
                        <div class="field btns">
                            <button class="prev-3 prev">Atras</button>
                            <button type="submit" class="submit" id="submit">Enviar</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    <?php }
} else if ($_SESSION["username"]->status_process === 'first' || $_SESSION["username"]->status_process === 'sign_contract' || $_SESSION["username"]->status_process === 'signed_contract' || $_SESSION["username"]->status_process === 'active') { ?>

    <style>
        .stand-user {
            display: flex;
            justify-content: center;
            align-items: center;
            align-content: center;
            flex-direction: column;
            margin: 6rem auto;
        }
    </style>


    <div class="stand-user">
        <h4 class="text-center"> ¡Hola! <?= $_SESSION["username"]->name ?> </h4>
        <h5 class="text-center">Gracias por querer ser parte de Express! <div class="spinner-border text-primary" role="status"></div>
        </h5>

        <img style="width:10rem; height:10rem;" src="<?= base_url ?>estilos/imagenes/logo.png" alt="">
    </div>


<?php }

?>


<?php require_once 'views/layout/footerReclute.php'; ?>