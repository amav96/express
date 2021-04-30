<?php require_once('../../views/include/adm/superior_normalizacion.php'); ?>

<div class="container-titulo-usuario">
    <div class="box-titulo-usuario">
        <h4>Administrador: <?php echo $_SESSION["tipo"]["nombre"]; ?></h4>

        <h2><i class="fas fa-tasks"></i>
            Validar Telefonos
        
        <i class="fas fa-phone"></i>
        </h2>
    </div>
</div>

<div class="contendor-botonera">

    <button class="btn btn-danger" id="importarValidador">Importar teléfonos para validar</button>


    <button class="btn btn-danger" id="mostrarDatosValidador">Mostrar Validados</button>
   

</div>

<!--Ejemplo tabla con DataTables-->
<br>
<br>

<?php if (isset($_SESSION["importado"])) {
    if ($_SESSION["importado"] === "importadoValidar") { ?>

<div class="d-flex justify-content-center">
<div class="w-50 text-center alert alert-success" role="alert">
<h3>Importado con éxito</h3>
<h4><?php echo $_SESSION["cantidad"].' '.'filas insertadas con exito.' ?> </h4>
<h4><?php echo 'Cartera: '.$_SESSION["carteraData"].' '.'|'.' '.'Fecha : '.$_SESSION["fechaData"].' '.'|'.' '.'Empresa : '.$_SESSION["empresaData"]  ?>  </h4>
</div>
</div>
<?php } elseif ($_SESSION["importado"] === "borrarMensaje") {
    }
}
?>


<?php if(isset($_SESSION["primeraFila"]) && $_SESSION["primeraFila"] ==='failedValidar' ){?>

    <div class="d-flex justify-content-center">
<div class="w-50 text-center alert alert-danger">
<h4>La primera fila antes del encabezado de columnas debe tener como titulo: Express procesando</h4>
</div>

</div>
<?php } ?>

<?php if(isset($_SESSION["formato"]) && $_SESSION["formato"] ==='failedValidar' ){?>

 <div class="d-flex justify-content-center">
<div class="w-50 text-center alert alert-danger">
<h4>Extensión de archivo incorrecto.</h4>
<h5>El archivo debe cumplir con el formato CSV </h5>
</div>

</div>

<?php } ?>


<?php if(isset($_SESSION["estructura"]) && $_SESSION["estructura"] ==='failedValidar' ){?>

 <div class="d-flex justify-content-center">
<div class="w-50 text-center alert alert-danger">
<h4>Encabezados incorrectos.</h4>
<h5>La segunda fila debe tener los siguientes encabezados.</h5>
<h6> id_local | documento | telefono</h6>
</div>

</div>
<?php } ?>

<?php if(isset($_SESSION["cartera"]) && $_SESSION["cartera"] ==='existe' ){?>

 <div class="d-flex justify-content-center">
<div class="w-50 text-center alert alert-danger">

<h4>La cartera ya existe.</h4>


</div>

</div>
<?php } ?>


<?php if (isset($_SESSION["mostrarTabla"])) {

    if ($_SESSION["mostrarTabla"] === "mostrarValidar") { ?>


        <div class="container">
            <div class="row">
                <div class="col-lg-12">


                    <?php



                    isset($_SESSION["fechaValidar"])
                        ? $fecha = $_SESSION["fechaValidar"]
                        : false;
                    isset($_SESSION["carteraValidar"])
                        ? $cartera = $_SESSION["carteraValidar"]
                        : false;
                    isset($_SESSION["empresaValidar"])
                        ? $empresa = $_SESSION["empresaValidar"]
                        : false;


                    $telefonosValidados = buscarTablaValidar($cartera, $fecha, $empresa, $connection);




                    ?>

                    <div class="table-responsive" id="data-tabla-html">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr>
                                    <th>id_local</th>
                                    <th>documento</th>
                                    <th>telefono</th>
                                    <th>localidad</th>
                                    <th>sin_15</th>
                                    <th>reemplazar</th>
                                    <th>longitud</th>
                                    <th>modalidad</th>
                                    <th>operador</th>
                                    <th>empresa</th>
                                    <th>cartera</th>
                                    <th>fecha_ingresado</th>
                                      
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (is_object($telefonosValidados)) {

                                    while ($recorroTelefonos = mysqli_fetch_assoc($telefonosValidados)) { ?>

                                        <tr>
                                            <td><?php echo $recorroTelefonos["id_local"] ?></td>
                                            <td><?php echo $recorroTelefonos["documento"] ?></td>
                                            <td><?php echo $recorroTelefonos["telefono"] ?></td>
                                            <td><?php echo $recorroTelefonos["localidad"] ?></td>
                                            <td><?php echo $recorroTelefonos["sin_15"] ?></td>
                                            <td><?php echo $recorroTelefonos["reemplazar_por"] ?></td>
                                            <td><?php echo $recorroTelefonos["caracteres"] ?></td>
                                            <td><?php echo $recorroTelefonos["modalidad"] ?></td>
                                            <td><?php echo $recorroTelefonos["operador"] ?></td>
                                            <td><?php echo $recorroTelefonos["empresaImportada"] ?></td>
                                            <td><?php echo $recorroTelefonos["cartera"] ?></td>
                                            <td><?php echo $recorroTelefonos["fecha_ingresado"] ?></td>
                                        </tr>

                                <?php  }
                                } ?>
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

      <?php   }
    }
            if (isset($_SESSION["importado"])) {
                if ($_SESSION["importado"] === "error") { ?>
                   
 <div class="d-flex justify-content-center">
<div class="w-50 text-center alert alert-danger">
                   <div class="estado-accion">
                        <h2>Hubo un error</h2>
                    </div>
                  </div>

</div>

                <?php } ?>
            <?php } ?>


            <?php
            Utils::deleteSession('mostrarTabla');
            Utils::deleteSession('fechaValidar');
            Utils::deleteSession('carteraValidar');
            Utils::deleteSession('empresaValidar');
            //borra mensaje
            Utils::deleteSession('importado');
            Utils::deleteSession('formato');
            Utils::deleteSession('estructura');
            Utils::deleteSession('cartera');
            Utils::deleteSession('primeraFila');
            Utils::deleteSession('carteraData');
            Utils::deleteSession('empresaData');
            Utils::deleteSession('fechaData');
            ?>

                </div>
            </div>
        </div>

        <?php require_once('../../views/include/adm/inferior_normalizacion.php'); ?>