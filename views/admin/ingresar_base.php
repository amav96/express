 
<?php require_once('../../views/include/admin/superior_normalizacion.php'); ?>

<div class="container-titulo-usuario">
    <div class="box-titulo-usuario">
        <h4>Administrador: <?php echo $_SESSION["tipo"]["nombre"]; ?></h4>


        <h2>Ingresar Base Original

        <i class="fas fa-database"></i>
        </h2>
    </div>
</div>



<div class="contendor-botonera">

    <button class="btn btn-danger" id="importarBase">Importar base original</button>




    <button class="btn btn-danger" id="mostrarDatosBase">Mostrar Datos</button>

</div>

<br>
<br>

<?php if (isset($_SESSION["importado"])) {
    if ($_SESSION["importado"] === "importadoBase") {
        $fechaHoy = getdate();
        ?>
        <div class="d-flex justify-content-center">
            <div class="w-50 text-center alert alert-success" role="alert">
                <h3>Importado con éxito</h3>
                <h4><?php echo $_SESSION["cantidad"] . ' ' . 'filas insertadas.' ?> </h4>
                <h4><?php echo 'Fecha de ingreso : '. $fechaHoy['year'].'-'.$fechaHoy['mon'].'-'.$fechaHoy['mday'];; ?> </h4>
               
            </div>
        </div>
<?php } elseif ($_SESSION["importado"] === "borrarMensaje") {
    }
}
?>

<?php if (isset($_SESSION["formato"]) && $_SESSION["formato"] === 'failedBase') { ?>

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


<?php if (isset($_SESSION["estructura"]) && $_SESSION["estructura"] === 'failedBase') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">
            <h4>Encabezados incorrectos.</h4>
            <h5>La segunda fila debe tener los siguientes encabezados.</h5>
            <h6> id_local | cod_empresa | tipo | empresa | equipo | tarjeta | terminal | serie | serie_base | idd | id_orden | id_actividad | identificacion | nombre_cliente	|direccion | localidad | codigo_postal | provincia | fecha_creacion | telefono1 | telefono2 | telefono_fijo1 | telefono_fijo2 | telefono_fijo3 | telefono_fijo4 | telefono_fijo5 | telefono_fijo6 | fecha_de_envio | cartera | baja | id_recolector | id_fecha_recolector | remito_rend | remito_cv | fecha_rend_cv | id_operador_ren | id_motivo_ren | master_box | id_operador | fecha | id_motivo | tabla_oper | multiples | cable_hdmi | cable_av | fuente | control_1 | email_enviado | otros | remito_sub | fecha_remito_sub | fecha_asignado | sub_asignado | ciclo | zona | fecha_premio | mes_base | r1 | r2 | r3 | operador | tipo_de_recupero | semanas | ano_semana | fecha_de_liquidacion | hist_pactados | latitude | longitude
</h6>
        </div>
    </div>
<?php } ?>


<?php if (isset($_SESSION["mostrarTabla"])) {
    if ($_SESSION["mostrarTabla"] === "mostrarBase") { ?>


        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="table-responsive" id="data-tabla-html">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr>
                                    <th>id_servidor</th>
                                            <th>id_local</th>
                                            <th>cod_empresa </th>
                                            <th>tipo</th>
                                            <th>empresa</th>
                                            <th>equipo</th>
                                            <th>tarjeta</th>
                                            <th>terminal </th>
                                            <th>serie</th>
                                            <th>serie_base</th>
                                            <th>idd</th>
                                            <th>id_orden</th>
                                            <th>id_actividad </th>
                                            <th>identificacion</th>
                                            <th>nombre_cliente</th>
                                            <th>direccion</th>
                                            <th>localidad</th>
                                            <th>codigo_postal </th>
                                            <th>provincia</th>
                                            <th>fecha_creacion</th>
                                            <th>telefono1</th>
                                            <th>telefono2</th>
                                            <th>telefono_fijo1 </th>
                                            <th>telefono_fijo2</th>
                                            <th>telefono_fijo3</th>
                                            <th>telefono_fijo4</th>
                                            <th>telefono_fijo5</th>
                                            <th>telefono_fijo6 </th>
                                            <th>fecha_de_envio</th>
                                            <th>cartera</th>
                                            <th>baja</th>
                                            <th>id_recolector</th>
                                            <th>id_fecha_recolector </th>
                                            <th>remito_rend</th>
                                            <th>remito_cv</th>
                                            <th>fecha_rend_cv</th>
                                            <th>id_operador_ren</th>
                                            <th>id_motivo_ren </th>
                                            <th>master_box</th>
                                            <th>id_operador</th>
                                            <th>fecha</th>
                                            <th>id_motivo</th>
                                            <th>tabla_oper </th>
                                            <th>multiples</th>
                                            <th>cable_hdmi</th>
                                            <th>cable_av</th>
                                            <th>fuente</th>
                                            <th>control_1 </th>
                                            <th>email_enviado</th>
                                            <th>otros</th>
                                            <th>remito_sub</th>
                                            <th>fecha_remito_sub</th>
                                            <th>fecha_asignado </th>
                                            <th>sub_asignado</th>
                                            <th>ciclo</th>
                                            <th>zona</th>
                                            <th>fecha_premio</th>
                                            <th>mes_base </th>
                                            <th>r1</th>
                                            <th>r2</th>
                                            <th>r3</th>
                                            <th>operador</th>
                                            <th>tipo_de_recupero </th>
                                            <th>semanas</th>
                                            <th>ano_semana</th>
                                            <th>fecha_de_liquidacion</th>
                                            <th>hist_pactados</th>
                                            <th>latitude </th>
                                            <th>longitude</th>
                                    
                                    

                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                isset($_SESSION["fechaBase"])
                                    ? $fecha = $_SESSION["fechaBase"]
                                    : false;
                                isset($_SESSION["carteraBase"])
                                    ? $cartera = $_SESSION["carteraBase"]
                                    : false;
                                isset($_SESSION["empresaBase"])
                                    ? $empresa = $_SESSION["empresaBase"]
                                    : false;

                                $datosBase = mostrarBase($cartera, $fecha, $empresa, $connection);
                                
                                if(is_object($datosBase)){

                                    
                                
                                    while($base = mysqli_fetch_assoc($datosBase)){ ?>
                            <tr>
                            <td><?php echo $base["id_servidor"] ?></td>
                                            <td><?php echo $base["id_local"] ?></td>
                                            <td><?php echo $base["cod_empresa"]  ?></td>
                                            <td><?php echo $base["tipo"] ?></td>
                                            <td><?php echo $base["empresa"] ?></td>
                                            <td><?php echo $base["equipo"] ?></td>
                                            <td><?php echo $base["tarjeta"] ?></td>
                                            <td><?php echo $base["terminal"]  ?></td>
                                            <td><?php echo $base["serie"] ?></td>
                                            <td><?php echo $base["serie_base"] ?></td>
                                            <td><?php echo $base["idd"] ?></td>
                                            <td><?php echo $base["id_orden"] ?></td>
                                            <td><?php echo $base["id_actividad"]  ?></td>
                                            <td><?php echo $base["identificacion"] ?></td>
                                            <td><?php echo $base["nombre_cliente"] ?></td>
                                            <td><?php echo $base["direccion"] ?></td>
                                            <td><?php echo $base["localidad"] ?></td>
                                            <td><?php echo $base["codigo_postal"]  ?></td>
                                            <td><?php echo $base["provincia"] ?></td>
                                            <td><?php echo $base["fecha_creacion"] ?></td>
                                            <td><?php echo $base["telefono1"] ?></td>
                                            <td><?php echo $base["telefono2"] ?></td>
                                            <td><?php echo $base["telefono_fijo1"]  ?></td>
                                            <td><?php echo $base["telefono_fijo2"] ?></td>
                                            <td><?php echo $base["telefono_fijo3"] ?></td>
                                            <td><?php echo $base["telefono_fijo4"] ?></td>
                                            <td><?php echo $base["telefono_fijo5"] ?></td>
                                            <td><?php echo $base["telefono_fijo6"]  ?></td>
                                            <td><?php echo $base["fecha_de_envio"] ?></td>
                                            <td><?php echo $base["cartera"] ?></td>
                                            <td><?php echo $base["baja"] ?></td>
                                            <td><?php echo $base["id_recolector"] ?></td>
                                            <td><?php echo $base["id_fecha_recolector"]  ?></td>
                                            <td><?php echo $base["remito_rend"] ?></td>
                                            <td><?php echo $base["remito_cv"] ?></td>
                                            <td><?php echo $base["fecha_rend_cv"] ?></td>
                                            <td><?php echo $base["id_operador_ren"] ?></td>
                                            <td><?php echo $base["id_motivo_ren"]  ?></td>
                                            <td><?php echo $base["master_box"] ?></td>
                                            <td><?php echo $base["id_operador"] ?></td>
                                            <td><?php echo $base["fecha"] ?></td>
                                            <td><?php echo $base["id_motivo"] ?></td>
                                            <td><?php echo $base["tabla_oper"]  ?></td>
                                            <td><?php echo $base["multiples"] ?></td>
                                            <td><?php echo $base["cable_hdmi"] ?></td>
                                            <td><?php echo $base["cable_av"] ?></td>
                                            <td><?php echo $base["fuente"] ?></td>
                                            <td><?php echo $base["control_1"]  ?></td>
                                            <td><?php echo $base["email_enviado"] ?></td>
                                            <td><?php echo $base["otros"] ?></td>
                                            <td><?php echo $base["remito_sub"] ?></td>
                                            <td><?php echo $base["fecha_remito_sub"] ?></td>
                                            <td><?php echo $base["fecha_asignado"]  ?></td>
                                            <td><?php echo $base["sub_asignado"] ?></td>
                                            <td><?php echo $base["ciclo"] ?></td>
                                            <td><?php echo $base["zona"] ?></td>
                                            <td><?php echo $base["fecha_premio"] ?></td>
                                            <td><?php echo $base["mes_base"]  ?></td>
                                            <td><?php echo $base["r1"] ?></td>
                                            <td><?php echo $base["r2"] ?></td>
                                            <td><?php echo $base["r3"] ?></td>
                                            <td><?php echo $base["operador"] ?></td>
                                            <td><?php echo $base["tipo_de_recupero"]  ?></td>
                                            <td><?php echo $base["semanas"] ?></td>
                                            <td><?php echo $base["ano_semana"] ?></td>
                                            <td><?php echo $base["fecha_de_liquidacion"] ?></td>
                                            <td><?php echo $base["hist_pactados"] ?></td>
                                            <td><?php echo $base["latitude"]  ?></td>
                                            <td><?php echo $base["longitude"] ?></td>
                            </tr>

                                  <?php  }
                                }
                                ?>

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


        <?php require_once('../../views/include/admin/inferior_normalizacion.php'); ?>