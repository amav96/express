<?php require_once('../../views/include/adm/superior_normalizacion.php'); ?>

<div class="container-titulo-usuario">
    <div class="box-titulo-usuario">
        <h4>Administrador: <?php echo $_SESSION["tipo"]["nombre"]; ?></h4>

        <h2>Ordenar Teléfonos

        <i class="fas fa-sort-amount-up-alt"></i>
        </h2>
    </div>
</div>



<div class="contendor-botonera">

    <button class="btn btn-danger" id="importarOrdenador">Importar teléfonos a Ordenar</button>




    <button class="btn btn-danger" id="mostrarDatosOrdenador">Mostrar Datos</button>

</div>

<br>
<br>

<?php if (isset($_SESSION["importado"])) {
    if ($_SESSION["importado"] === "importadoOrdenar") { ?>
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



<?php if (isset($_SESSION["primeraFila"]) && $_SESSION["primeraFila"] === 'failedOrdenar') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">

            <h4>La primera fila antes del encabezado de columnas debe tener como titulo: Express procesando</h4>

        </div>
    </div>


<?php } ?>

<?php if (isset($_SESSION["formato"]) && $_SESSION["formato"] === 'failedOrdenar') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">
            <h4>Extensión de archivo incorrecto.</h4>
            <h5>El archivo debe cumplir con el formato CSV </h5>
        </div>
    </div>

<?php } ?>

<?php if (isset($_SESSION["cartera"]) && $_SESSION["cartera"] === 'existe') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">
            <h4>La cartera ya existe.</h4>
        </div>
    </div>

<?php } ?>


<?php if (isset($_SESSION["estructura"]) && $_SESSION["estructura"] === 'failedOrdenar') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">
            <h4>Encabezados incorrectos.</h4>
            <h5>La segunda fila debe tener los siguientes encabezados.</h5>
            <h6> id_local | documento | tlf1 | tlf1.1 | tlf1.2 | tlf2| tlf2.1 | tlf2.2 | tlf3 | tlf3.1 | tlf3.2 | tlf4 | tlf4.1 | tlf4.2</h6>
        </div>
    </div>
<?php } ?>


<?php if (isset($_SESSION["mostrarTabla"])) {
    if ($_SESSION["mostrarTabla"] === "mostrarOrdenar") { ?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="table-responsive" id="data-tabla-html">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr>
                                    <th>id_local</th>
                                    <th>documento</th>
                                    <th>telefono </th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                isset($_SESSION["fechaOrdenar"])
                                    ? $fecha = $_SESSION["fechaOrdenar"]
                                    : false;
                                isset($_SESSION["carteraOrdenar"])
                                    ? $cartera = $_SESSION["carteraOrdenar"]
                                    : false;
                                isset($_SESSION["empresaOrdenar"])
                                    ? $empresa = $_SESSION["empresaOrdenar"]
                                    : false;



                                $telefonosDesordenados = buscarTablaOrdenar($cartera, $fecha, $empresa, $connection);


                                if (is_object($telefonosDesordenados)) {

                                    while ($telefonosPorCliente = mysqli_fetch_assoc($telefonosDesordenados)) {

                                ?>


                                        <!-- telefono_uno -->
                                        <?php if (!empty($telefonosPorCliente["telefono_uno"])) {
                                            if ($telefonosPorCliente["telefono_uno"] != '0' && $telefonosPorCliente["telefono_uno"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_uno"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_uno_uno -->
                                        <?php if (!empty($telefonosPorCliente["telefono_uno_uno"])) {
                                            if ($telefonosPorCliente["telefono_uno_uno"] != '0'  && $telefonosPorCliente["telefono_uno_uno"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_uno_uno"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_uno_dos -->
                                        <?php if (!empty($telefonosPorCliente["telefono_uno_dos"])) {
                                            if ($telefonosPorCliente["telefono_uno_dos"] != '0'  && $telefonosPorCliente["telefono_uno_dos"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_uno_dos"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_dos -->
                                        <?php if (!empty($telefonosPorCliente["telefono_dos"])) {
                                            if ($telefonosPorCliente["telefono_dos"] != '0'  && $telefonosPorCliente["telefono_dos"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_dos"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_dos_uno -->
                                        <?php if (!empty($telefonosPorCliente["telefono_dos_uno"])) {
                                            if ($telefonosPorCliente["telefono_dos_uno"] != '0'  && $telefonosPorCliente["telefono_dos_uno"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_dos_uno"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_dos_dos -->
                                        <?php if (!empty($telefonosPorCliente["telefono_dos_dos"])) {
                                            if ($telefonosPorCliente["telefono_dos_dos"] != '0'  && $telefonosPorCliente["telefono_dos_dos"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_dos_dos"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_tres -->
                                        <?php if (!empty($telefonosPorCliente["telefono_tres"])) {
                                            if ($telefonosPorCliente["telefono_tres"] != '0'  && $telefonosPorCliente["telefono_tres"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_tres"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_tres_uno -->
                                        <?php if (!empty($telefonosPorCliente["telefono_tres_uno"])) {
                                            if ($telefonosPorCliente["telefono_tres_uno"] != '0'  && $telefonosPorCliente["telefono_tres_uno"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_tres_uno"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_tres_dos -->
                                        <?php if (!empty($telefonosPorCliente["telefono_tres_dos"])) {
                                            if ($telefonosPorCliente["telefono_tres_dos"] != '0'  && $telefonosPorCliente["telefono_tres_dos"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_tres_dos"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_cuatro -->
                                        <?php if (!empty($telefonosPorCliente["telefono_cuatro"])) {
                                            if ($telefonosPorCliente["telefono_cuatro"] != '0'  && $telefonosPorCliente["telefono_cuatro"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_cuatro"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_cuatro_uno -->
                                        <?php if (!empty($telefonosPorCliente["telefono_cuatro_uno"])) {
                                            if ($telefonosPorCliente["telefono_cuatro_uno"] != '0'  && $telefonosPorCliente["telefono_cuatro_uno"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_cuatro_uno"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                        <!-- telefono_cuatro_dos -->
                                        <?php if (!empty($telefonosPorCliente["telefono_cuatro_dos"])) {
                                            if ($telefonosPorCliente["telefono_cuatro_dos"] != '0'  && $telefonosPorCliente["telefono_cuatro_dos"] != '') { ?>
                                                <tr>
                                                    <td> <?php echo $telefonosPorCliente["id_local"] ?></td>
                                                    <td> <?php echo $telefonosPorCliente["documento"]  ?></td>
                                                    <td> <?php echo $telefonosPorCliente["telefono_cuatro_dos"] ?></td>
                                                </tr>
                                        <?php } else {
                                            }
                                        } ?>

                                    <?php  } ?>


                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>


                <?php } else { ?>

                    <div class="d-flex justify-content-center">
                        <div class="w-50 text-center alert alert-danger">
                            <h4> Los datos ingresados son incorrectos</h4>
                        </div>
                    </div>
            <?php  }
        }

            ?>








            <!--Ejemplo tabla con DataTables-->



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
            Utils::deleteSession('importado');
            Utils::deleteSession('fechaOrdenar');
            Utils::deleteSession('empresaOrdenar');
            Utils::deleteSession('carteraOrdenar');
            Utils::deleteSession('formato');
            Utils::deleteSession('estructura');
            Utils::deleteSession('primeraFila');
            Utils::deleteSession('cartera');
            Utils::deleteSession('carteraData');
            Utils::deleteSession('empresaData');
            Utils::deleteSession('fechaData');
            ?>



                </div>
            </div>
        </div>


        <?php require_once('../../views/include/adm/inferior_normalizacion.php'); ?>