<?php require_once 'views/layout/headerNormalizacion.php';?>

<?php if (isset($_SESSION["flag"]) && $_SESSION["flag"] === 'no-aprobado') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger" role="alert">

            <h3>De la base que se intenta importar: El campo id_local</h3> <br>
            <?php foreach ($_SESSION["revisionBase"] as $repetidos) {

                print_r($repetidos . ', ');
            } ?>
            <h3>existe/n en la base original</h3>

        </div>
    </div>

<?php } else if (isset($_SESSION["flag"]) && $_SESSION["flag"] === 'aprobado') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-success" role="alert">

            <h3>Base verificada y aceptada, puedes importarla.</h3>

        </div>
    </div>

<?php   } ?>


<?php if (isset($_SESSION["importar"]) && $_SESSION["importar"] === 'importado') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-success" role="alert">

            <h3><?= $_SESSION["cantidadInsert"] ?> registro/s importado/s con exito! </h3>

        </div>
    </div>

<?php   } ?>


<?php if (isset($_SESSION["errorUp"])) {


    if ($_SESSION["errorUp"] === 'formato') { ?>


        <div class="d-flex justify-content-center">
            <div class="w-50 text-center alert alert-danger" role="alert">

                <h3>El archivo a importar tiene que tener formato CSV.</h3>

            </div>
        </div>

    <?php   } else if ($_SESSION["errorUp"] === 'noInsert') { ?>

        <div class="d-flex justify-content-center">
            <div class="w-50 text-center alert alert-danger" role="alert">

                <h3>No se insertaron los datos correctamente, comunicarse con sistemas.</h3>

            </div>
        </div>

    <?php } else if ($_SESSION["errorUp"] === 'header') { ?>

        <div class="d-flex justify-content-center">
            <div class="w-50 text-center alert alert-danger" role="alert">

                <h3>El archivo debe tener la siguiente cabecera: </h3>
                <h5>id_local | cod_empresa | tipo | empresa | equipo | tarjeta | terminal | serie | serie_base | idd | id_orden | id_actividad | identificacion | nombre_cliente | direccion | localidad | codigo_postal | provincia | fecha_creacion | telefono1 | telefono2 | telefono_fijo1 | telefono_fijo2 | telefono_fijo3 | telefono_fijo4 | telefono_fijo5 | telefono_fijo6 | fecha_de_envio | cartera | baja | emailcliente
                </h5>

            </div>
        </div>

<?php  }
} ?>

<?php if(isset($_SESSION["dataExist"]) &&  $_SESSION["dataExist"]==='noExist'){ ?>


    <div class="d-flex justify-content-center">
            <div class="w-50 text-center alert alert-danger" role="alert">

                <h4>No se puede mostrar los registros importados por estos posibles motivos:</h4> <br>
               
                <h5>1) Los registros fueron modificados despues de realizar la importación.</h5>
                <h5>2) Los registros fueron borrados despues de realizar la importación.</h5>
            </div>
        </div>
    

 <?php } ?>

<div class="container-titulo-normalizacion d-flex justify-content-center m-2">
    <div class="box-titulo-usuario">
        <h2>Importar Base General
            <i class="fas fa-filter"></i>
        </h2>
    </div>
</div>

<div class="contendor-botonera">

    <?php // if (!isset($_SESSION["flag"]) || $_SESSION["flag"] === 'no-aprobado') { 
    ?>

    <button class="btn btn-danger" id="importarBO">Importar</button>

    <!-- <?php // } else if (isset($_SESSION["flag"]) && $_SESSION["flag"] === 'aprobado') { 
            ?>

        <button class="btn btn-primary" id="importarBO">Importar</button>

    <?php // } 
    ?> -->


    <!-- <button class="btn btn-danger" id="mostrarDatosBO">Mostrar Datos</button> -->
</div>

<br>
<br>




<?php if (isset($_SESSION["cartera"]) && $_SESSION["cartera"] === 'existe') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">
            <h4>La cartera ya existe.</h4>

        </div>
    </div>
<?php } ?>



<?php if (isset($showImport) && is_object($showImport)) {   ?>



    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="table-responsive" id="data-tabla-html">
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
                        <thead>

                            <tr>
                                <th>id_local</th>
                                <th>cod_empresa</th>
                                <th>tipo</th>
                                <th>empresa</th>
                                <th>equipo</th>
                                <th>tarjeta</th>
                                <th>terminal</th>
                                <th>serie</th>
                                <th>serie_base</th>
                                <th>idd</th>
                                <th>id_orden</th>
                                <th>id_actividad</th>
                                <th>identificacion</th>
                                <th>nombre_cliente</th>
                                <th>direccion</th>
                                <th>localidad</th>
                                <th>codigo_postal</th>
                                <th>provincia</th>
                                <th>fecha_creacion</th>
                                <th>telefono1</th>
                                <th>telefono2</th>
                                <th>telefono_fijo1</th>
                                <th>telefono_fijo2</th>
                                <th>telefono_fijo3</th>
                                <th>telefono_fijo4</th>
                                <th>telefono_fijo5</th>
                                <th>telefono_fijo6</th>
                                <th>fecha_de_envio</th>
                                <th>cartera</th>
                                <th>baja</th>
                                <th>emailcliente</th>
                                <th>Fecha Ingresado</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php foreach ($showImport as $element) { ?> 
                                <tr>
                                   
                                    <td><?=$element["id_local"]?></td>
                                <td><?=$element["cod_empresa"]?></td>
                                <td><?=$element["tipo"]?></td>
                                <td><?=$element["empresa"]?></td>
                                <td><?=$element["equipo"]?></td>
                                <td><?=$element["tarjeta"]?></td>
                                <td><?=$element["terminal"]?></td>
                                <td><?=$element["serie"]?></td>
                                <td><?=$element["serie_base"]?></td>
                                <td><?=$element["idd"]?></td>
                                <td><?=$element["id_orden"]?></td>
                                <td><?=$element["id_actividad"]?></td>
                                <td><?=$element["identificacion"]?></td>
                                <td><?=$element["nombre_cliente"]?></td>
                                <td><?=$element["direccion"]?></td>
                                <td><?=$element["localidad"]?></td>
                                <td><?=$element["codigo_postal"]?></td>
                                <td><?=$element["provincia"]?></td>
                                <td><?=$element["fecha_creacion"]?></td>
                                <td><?=$element["telefono1"]?></td>
                                <td><?=$element["telefono2"]?></td>
                                <td><?=$element["telefono_fijo1"]?></td>
                                <td><?=$element["telefono_fijo2"]?></td>
                                <td><?=$element["telefono_fijo3"]?></td>
                                <td><?=$element["telefono_fijo4"]?></td>
                                <td><?=$element["telefono_fijo5"]?></td>
                                <td><?=$element["telefono_fijo6"]?></td>
                                <td><?=$element["fecha_de_envio"]?></td>
                                <td><?=$element["cartera"]?></td>
                                <td><?=$element["baja"]?></td>
                                <td><?=$element["emailcliente"]?></td>
                                <td><?=$element["created_at"]?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

        <?php } ?>

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



            </div>
        </div>
    </div>


    <?php require_once 'views/layout/footerNormalizacion.php'; ?>

    <?php
    Utils::deleteSession('flag');
    Utils::deleteSession('revisionBase');
    Utils::deleteSession('CountRepetidos');
    Utils::deleteSession('cantidadInsert');
    Utils::deleteSession('importar');
    Utils::deleteSession('errorUp');
    Utils::deleteSession('dataImport');
    Utils::deleteSession('dataExist');
    
    ?>