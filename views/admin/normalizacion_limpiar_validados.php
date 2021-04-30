<?php require_once('../../views/include/adm/superior_normalizacion.php'); ?>

<div class="container-titulo-usuario">
    <div class="box-titulo-usuario">
        <h4>Administrador: <?php echo $_SESSION["tipo"]["nombre"]; ?></h4>

        <h2>Limpiar Telefonos Validados

        <i class="fas fa-database"></i>
        </h2>
    </div>
</div>

<div class="contendor-botonera">

    <button class="btn btn-danger" id="importarLimpiarValidados">Importar teléfonos validados</button>

    <button class="btn btn-danger" id="mostrarDatosValidadosFinal">Mostrar datos</button>

</div>

<!--Ejemplo tabla con DataTables-->
<br>
<br>




<?php
if (isset($_SESSION["importado"])) {
    if ($_SESSION["importado"] === "importadoLimpiarValidados") { ?>


        <div class="d-flex justify-content-center">
            <div class="w-50 text-center alert alert-success" role="alert">
                <h3>Importado con éxito</h3>
                <h4><?php echo $_SESSION["cantidad"] . ' ' . 'filas insertadas.' ?> </h4>
                <h4><?php echo 'Cartera: ' . $_SESSION["carteraData"] . ' ' . '|' . ' ' . 'Fecha : ' . $_SESSION["fechaData"] . ' ' . '|' . ' ' . 'Empresa : ' . $_SESSION["empresaData"]  ?> </h4>
            </div>
        </div>

<?php } elseif ($_SESSION["importado"] === "borrarMensaje") {
    }
}
?>


<?php if (isset($_SESSION["primeraFila"]) && $_SESSION["primeraFila"] === 'failedLimpiarValidados') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">
            <h4>La primera fila antes del encabezado de columnas debe tener como titulo: Express procesando</h4>
        </div>

    </div>


<?php } ?>

<?php if (isset($_SESSION["formato"]) && $_SESSION["formato"] === 'failedLimpiarValidados') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">
            <h4>Extensión de archivo incorrecto.</h4>
            <h5>El archivo debe cumplir con el formato CSV </h5>
        </div>

    </div>

<?php } ?>


<?php if (isset($_SESSION["estructura"]) && $_SESSION["estructura"] === 'failedLimpiarValidados') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">
            <h4>Encabezados incorrectos.</h4>
            <h5>La segunda fila debe tener los siguientes encabezados.</h5>
            <h6> id_local | documento | telefono | localidad | sin_15 | reemplazar | longitud | modalidad | operador | empresa | cartera | fecha_ingresado </h6>
        </div>

    </div>


<?php } ?>




<?php
if (isset($_SESSION["mostrarTabla"])) {

    if ($_SESSION["mostrarTabla"] === "importadoLimpiarValidados") {

?>

        <?php if (isset($_SESSION["accionTabla"]) && $_SESSION["accionTabla"] === 'final') { ?>

            <div class="d-flex justify-content-center">
                <div class="w-50 text-center alert alert-info">
                    <h4>Telefonos válidos de 10 y 12 digitos.</h4>
                </div>

            </div>

        <?php } ?>

        <?php if (isset($_SESSION["accionTabla"]) && $_SESSION["accionTabla"] === 'evaluar') { ?>

            <div class="d-flex justify-content-center">
                <div class="w-50 text-center alert alert-info">
                    <h4>Telefonos de hasta 8 digitos, no válidos.</h4>
                </div>

            </div>

        <?php } ?>


        <?php if (isset($_SESSION["accionTabla"]) && $_SESSION["accionTabla"] === 'invalidos') { ?>

            <div class="d-flex justify-content-center">
                <div class="w-50 text-center alert alert-info">
                    <!-- <h4>Telefonos de 9 y 11 digitos, largo mayor a 12 y menor o igual a 8.</h4> -->
                    <h4>Telefonos inválidos.</h4> 
                </div>

            </div>
        <?php } ?>


        <div class="container">
            <div class="row">
                <div class="col-lg-12">


                    <?php


                    isset($_SESSION["fechaFinal"])
                        ? $fecha = $_SESSION["fechaFinal"]
                        : false;
                    isset($_SESSION["carteraFinal"])
                        ? $cartera = $_SESSION["carteraFinal"]
                        : false;
                    isset($_SESSION["empresaFinal"])
                        ? $empresa = $_SESSION["empresaFinal"]
                        : false;


                    $telefonosLimpiarValidados = mostrarTelefonosFinal($cartera, $fecha, $empresa, $connection); ?>

                    <div class="table-responsive" id="data-tabla-html">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr>
                                    
                                    <th>cartera</th>
                                    <th>id_local</th>
                                    <th>documento</th>
                                    <th>telefono1</th>
                                    <th>telefono2</th>
                                    <th>telefono3</th>
                                    <th>telefono4</th>
                                    <th>telefono5</th>
                                    <th>telefono6</th>
                                    <th>telefono7</th>
                                    <th>telefono8</th>
                                    <th>telefono9</th>
                                    <th>telefono10</th>
                                    <th>telefono11</th>
                                    <th>telefono12</th>
                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                function cerrarFila(int $cantidadTelefonos)
                                {
                                    while ($cantidadTelefonos < 12) {
                                        echo "<td></td>";
                                        $cantidadTelefonos++;
                                    }
                                    echo "</tr>";
                                }
                                if (isset($_SESSION["accionTabla"]) && $_SESSION["accionTabla"] === 'final') {
                                    if (is_object($telefonosLimpiarValidados)) {

                                        $ultimoUsuario = "";
                                        $ultimoTelefono = "";
                                        $cantidadTelefonos = 12;

                                        while ($recorroTelefonos = mysqli_fetch_assoc($telefonosLimpiarValidados)) {
                                            $usuario = $recorroTelefonos["id_local"];
                                            $telefono = $recorroTelefonos["telefono"];

                                            $largo = strlen($telefono);
                                            if ($largo != 10 && $largo != 12) continue;
                                            if ($recorroTelefonos["sin_15"] === '0') continue;

                                            if ($usuario != $ultimoUsuario) {
                                                if ($cantidadTelefonos < 12) cerrarFila($cantidadTelefonos);
                                                $modalidadTlf = substr($recorroTelefonos['modalidad'],0,1);
                                                $modalidadTlfFinal = $modalidadTlf.'.54';

                                                echo "<tr>
                                                
                                                <td>{$recorroTelefonos['cartera']}</td>
                                                <td>$usuario</td>
                                                <td>{$recorroTelefonos['documento']}</td>
                                                <td>$modalidadTlfFinal$telefono</td> ";
                                                $cantidadTelefonos = 1;
                                            } else {
                                                if ($telefono != $ultimoTelefono) {

                                                    $modalidad =substr($recorroTelefonos['modalidad'],0,1);
                                                    $modalidadFin = $modalidad.'.54';

                                                    echo "<td>$modalidadFin$telefono</td>";
                                                    $cantidadTelefonos++;
                                                }
                                            }

                                            $ultimoUsuario = $usuario;
                                            $ultimoTelefono = $telefono;
                                        }
                                        cerrarFila($cantidadTelefonos);
                                    }
                                }

                                if (isset($_SESSION["accionTabla"]) && $_SESSION["accionTabla"] === 'evaluar') {

                                    if (is_object($telefonosLimpiarValidados)) {

                                        $ultimoUsuario = "";
                                        $ultimoTelefono = "";
                                        $cantidadTelefonos = 12;

                                        while ($recorroTelefonos = mysqli_fetch_assoc($telefonosLimpiarValidados)) {
                                            $usuario = $recorroTelefonos["id_local"];
                                            $telefono = $recorroTelefonos["telefono"];

                                            $largo = strlen($telefono);
                                            if ($largo > 8 && $largo != 8) continue;
                                            if ($recorroTelefonos["sin_15"] != '0') continue;

                                            if ($usuario != $ultimoUsuario) {
                                                if ($cantidadTelefonos < 12) cerrarFila($cantidadTelefonos);
                                                
                                                echo "<tr>
                                                
                                                <td>{$recorroTelefonos['cartera']}</td>
                                                <td>$usuario</td>
                                                <td>{$recorroTelefonos['documento']}</td>
                                                <td>$telefono</td> ";
                                                $cantidadTelefonos = 1;
                                            } else {
                                                if ($telefono != $ultimoTelefono) {
                                                
                                                    echo "<td>$telefono</td>";
                                                    $cantidadTelefonos++;
                                                }
                                            }

                                            $ultimoUsuario = $usuario;
                                            $ultimoTelefono = $telefono;
                                        }
                                        cerrarFila($cantidadTelefonos);
                                    }
                                }


                                if (isset($_SESSION["accionTabla"]) && $_SESSION["accionTabla"] === 'invalidos') {

                                    if (is_object($telefonosLimpiarValidados)) {

                                        $ultimoUsuario = "";
                                        $ultimoTelefono = "";
                                        $cantidadTelefonos = 12;

                                        while ($recorroTelefonos = mysqli_fetch_assoc($telefonosLimpiarValidados)) {
                                            $usuario = $recorroTelefonos["id_local"];
                                            $telefono = $recorroTelefonos["telefono"];

                                            $largo = strlen($telefono);
                                            // if ($largo != 9 && $largo != 11 && $largo <= 12 && $largo > 8) continue;
                                            if ($recorroTelefonos["sin_15"] != '0') continue;

                                            if ($usuario != $ultimoUsuario) {
                                                if ($cantidadTelefonos < 12) cerrarFila($cantidadTelefonos);
                                                
                                                echo "<tr>
                                                
                                                <td>{$recorroTelefonos['cartera']}</td>
                                                <td>$usuario</td>
                                                <td>{$recorroTelefonos['documento']}</td>
                                                
                                                <td>$telefono</td> 
                                                
                                                ";

                                                $cantidadTelefonos = 1;
                                            } else {
                                                if ($telefono != $ultimoTelefono) {
                                                    
                                                    echo "<td>$telefono</td>";
                                                    $cantidadTelefonos++;
                                                }
                                            }

                                            $ultimoUsuario = $usuario;
                                            $ultimoTelefono = $telefono;
                                        }
                                        cerrarFila($cantidadTelefonos);
                                    }
                                }


                                ?>
                            </tbody>
                        </table>
                    </div>

                <?php
            } else { ?>
                    <div class="d-flex justify-content-center">
                        <div class="w-50 text-center alert alert-danger">
                            <h4> Los datos ingresados son incorrectos</h4>
                        </div>

                    </div>
            <?php    }
        }

            ?>



            <?php
            if (isset($_SESSION["importado"])) {
                if ($_SESSION["importado"] === "error") { ?>
                    <div class="estado-accion">
                        <div class="d-flex justify-content-center">
                            <div class="w-50 text-center alert alert-danger">
                                <h2>Hubo un error</h2>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            <?php } ?>


            <?php
            Utils::deleteSession('mostrarTabla');
            Utils::deleteSession('fechaFinal');
            Utils::deleteSession('empresaFinal');
            Utils::deleteSession('carteraFinal');
            //borra mensaje
            Utils::deleteSession('importado');
            Utils::deleteSession('formato');
            Utils::deleteSession('estructura');
            Utils::deleteSession('cartera');
            Utils::deleteSession('primeraFila');
            Utils::deleteSession('accionTabla');
            Utils::deleteSession('carteraData');
            Utils::deleteSession('empresaData');
            Utils::deleteSession('fechaData');
            
            

            ?>

                </div>
            </div>
        </div>

        <?php require_once('../../views/include/adm/inferior_normalizacion.php'); ?>