<?php require_once 'views/layout/headerReclute.php'; ?>
<link rel="stylesheet" href="<?= base_url ?>estilos/personal/css/reclute/recursos_form_step_finish.css">

<div class="container-artisan">

    <div class="container-fill-in" id="container-fill-in">
        <div class="box-fill-in">
            <span class="titulo-fill-in">Ingrese N° Documento para completar solicitud</span>
        </div>
    </div>


    <div class="container-compruebo-doc" id="container-compruebo-doc">
        <form class="form-compruebo" id="form-compruebo">
            <input type="text" id="idparacomprobar" class="idparacomprobar" placeholder="Documento">
            <button class="boton-compurebodoc" id="boton-compurebodoc">Empezar</button>
        </form>
    </div>

</div>

<!-- <style>
    .form-first{
        display: none;
    }
</style> -->

<div class="container form-finish" id="container-form">


    <header>Hola <span id="nombreUsuario" class="usuario_ingresando"></span> Documento <span id="idas"></span> Completa tu informacion para formar parte de Express!</header>
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
                        Fecha Nacimiento</div>
                    <input type="date" name="fechaNacimiento" id="fechaNacimiento">
                </div>
                <div class="field">
                    <div class="label">
                        Estudios finalizados</div>
                    <input type="text" name="estudiosFinalizados" id="estudiosFinalizados" placeholder="Carreras, cursos, talleres.">
                </div>


                <div class="field">
                    <div class="label" style="font-size: 0.8rem;">
                        Tenés seguro de desempleo?</div>
                    <select name="seguroDesempleo" id="seguroDesempleo">
                        <option value="si">Si</option>
                        <option value="no">No</option>

                    </select>
                </div>
                <div class="field">
                    <div class="label">
                        Cuando vence?</div>

                    <input type="date" name="seguroDeseVence" id="seguroDeseVence">
                </div>


                <div class="field">
                    <button class="firstNext next">Siguiente</button>
                </div>
            </div>
            <div class="page">

                <div class="field">
                    <div class="label">
                        Estado Civil</div>
                    <select name="estadoCivil" id="estadoCivil">
                        <option value="soltero">Soltero(a)</option>
                        <option value="casado">Casado(a)</option>

                    </select>
                </div>
                <div class="field">
                    <div class="label">
                        Hijos</div>
                    <input type="text" name="hijos" id="hijos">

                    </select>
                </div>

                <div class="field">
                    <div class="label">
                        Licencia Conducir Vence</div>
                    <input type="date" name="venceLicencia" id="venceLicencia">
                </div>
                <div class="field">
                    <div class="label">
                        Modelo de vehiculo</div>
                    <input type="text" name="vehiculoModelo" id="vehiculoModelo" placeholder="Marca, modelo o tipo.">

                </div>

                <div class="field btns">
                    <button class="prev-1 prev">Atras</button>
                    <button class="next-1 next">Siguiente</button>
                </div>
            </div>


            <div class="page">

                <div class="field">
                    <div class="label">
                        Ultimo empleo 1</div>
                    <input type="text" name="ultEmpleoUno" id="ultEmpleoUno" placeholder="Empresa y Rubro">
                </div>
                <div class="field">
                    <div class="label">
                        Fecha inicio y final </div>
                    <input type="date" name="fechaInicioEmpleoUno" id="fechaInicioEmpleoUno" placeholder="Empresa y Rubro">
                    <input type="date" name="fechaFinEmpleoUno" id="fechaFinEmpleoUno" placeholder="Empresa y Rubro">
                </div>
                <div class="field">
                    <div class="label">
                        Ultimo empleo 2</div>
                    <input type="text" name="ultEmpleoDos" id="ultEmpleoDos" placeholder="Empresa y Rubro">
                </div>
                <div class="field">
                    <div class="label">
                        Fecha inicio y final </div>
                    <input type="date" name="fechaInicioEmpleoDos" id="fechaInicioEmpleoDos" placeholder="Empresa y Rubro">
                    <input type="date" name="fechaFinEmpleoDos" id="fechaFinEmpleoDos" placeholder="Empresa y Rubro">
                </div>

                <div class="field btns">
                    <button class="prev-2 prev">Atras</button>
                    <button class="next-2 next">Siguiente</button>
                </div>
            </div>

            <div class="page">

                <div class="field">
                    <div class="label">
                        Ultimo empleo 3</div>
                    <input type="text" name="ultEmpleoTres" id="ultEmpleoTres" placeholder="Empresa y Rubro">
                </div>
                <div class="field">
                    <div class="label">
                        Fecha inicio y final </div>
                    <input type="date" name="fechaInicioEmpleoTres" id="fechaInicioEmpleoTres" placeholder="Empresa y Rubro">
                    <input type="date" name="fechaFinEmpleoTres" id="fechaFinEmpleoTres" placeholder="Empresa y Rubro">
                </div>

                <div class="field">
                    <div class="label especial">
                        Antecedentes o Restricciones</div>
                    <input type="text" name="antecedentesRestricciones" id="antecedentesRestricciones">
                </div>
                <div class="field">
                    <div class="label">
                        Observaciones</div>
                    <input type="text" name="observaciones" id="observaciones" placeholder="Deseas agregar algo?">
                </div>
                <input type="hidden" id="tipo" value="Empleado-Completado" readonly>
                <span style="color: black;" id="procesando" class="procesando">Enviando...</span>
                <input type="hidden" id="horario_solicitud" name="horario_solicitud" readonly>
                <div class="field btns">

                    <button class="prev-3 prev">Atras</button>
                    <button type="submit" class="submit" id="submit">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container-artisan">

    <div class="container-mensaje-exito" id="container-mensaje-exito">
        <div class="box-mensaje-exito">
            <div class="imagen-exito">
                <img class="imagen-exito" src="<?= base_url ?>estilos/imagenes/front/confirmed.png" alt="">
            </div>
            <div class="box-texto-mensaje">
                <h4>Estamos revisando tu solicitud!</h4>
                <p>¡Nos estaremos comunicando con vos en minutos!</p>
            </div>
        </div>
    </div>

    <div class="container-mensaje-no-existe" id="container-mensaje-no-existe">

        <div class="box-mensaje-no">

            <div class="box-texto-no">
                <h4>No tenemos registro de este documento</h4>
                <div class="volver">¡Vuelve a intentarlo!</div>
            </div>
        </div>
    </div>


</div>

<script src="<?= base_url ?>assets/trabajo/data-employee-completed.js"></script>
<script src="<?= base_url ?>estilos/personal/js/work/form.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</body>

</html>