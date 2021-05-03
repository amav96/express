<?php require_once('../../views/include/adm/superior_normalizacion.php'); ?>

<div class="container-titulo-usuario">
    <div class="box-titulo-usuario">
        <h4>Administrador: <?php echo $_SESSION["tipo"]["nombre"]; ?></h4>

        <h2>Limpiar Teléfonos
        <i class="fas fa-filter"></i>
        </h2>
    </div>
</div>

<div class="contendor-botonera">

    <button class="btn btn-danger" id="importar">Importar teléfonos para limpiar</button>


    <button class="btn btn-danger" id="mostrarDatosLimpiar">Mostrar Datos</button>

</div>

<br>
<br>

<?php if (isset($_SESSION["importado"])) {
    if ($_SESSION["importado"] === "importado") { ?>

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


<?php if (isset($_SESSION["formato"]) && $_SESSION["formato"] === 'failedLimpiar') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">
        <h4>Extensión de archivo incorrecto.</h4>
        <h5>El archivo debe cumplir con el formato CSV </h5>
</div>
    </div>

<?php } ?>


<?php if (isset($_SESSION["estructura"]) && $_SESSION["estructura"] === 'failedLimpiar') { ?>

    <div class="d-flex justify-content-center">
        <div class="w-50 text-center alert alert-danger">
        <h4>Encabezados incorrectos.</h4>
        <h5>La primera fila debe ser la siguiente: </h5>
        <h6> id_local | codigo_postal | documento | telefono1 | telefono2 | telefono3 | telefono4</h6>
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





<?php if (isset($_SESSION["mostrarTabla"])) {

    if ($_SESSION["mostrarTabla"] === "mostrarLimpiar") { ?>





        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="table-responsive" id="data-tabla-html">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr>
                                   
                                    <th>id_local</th>
                                    <th>documento</th>
                                    <th> tlf 1 </th>
                                    <th> tlf 1.1 </th>
                                    <th> tlf 1.2 </th>
                                    <th> tlf 2 </th>
                                    <th> tlf 2.1 </th>
                                    <th> tlf 2.2 </th>
                                    <th> tlf 3 </th>
                                    <th> tlf 3.1 </th>
                                    <th> tlf 3.2 </th>
                                    <th> tlf 4 </th>
                                    <th> tlf 4.1 </th>
                                    <th> tlf 4.2 </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                isset($_SESSION["fechaLimpiar"])
                                    ? $fecha = $_SESSION["fechaLimpiar"]
                                    : false;
                                isset($_SESSION["carteraLimpiar"])
                                    ? $cartera = $_SESSION["carteraLimpiar"]
                                    : false;
                                isset($_SESSION["empresaLimpiar"])
                                    ? $empresa = $_SESSION["empresaLimpiar"]
                                    : false;

                                $objetoTelefonoLimpiar = buscarTablaLimpiador($cartera, $fecha, $empresa, $connection);

                                if (is_object($objetoTelefonoLimpiar)) {

                                    while ($telefono = mysqli_fetch_assoc($objetoTelefonoLimpiar)) {

                                ?>

                                        <tr>
                                        
                                            <td><?php echo $telefono["id_local"] ?></td>
                                            <td><?php echo $telefono["documento"] ?></td>

                                            <!-- tlf 1 -->
                                            <?php $telefono_uno_dividido = explode("/", $telefono["telefono_uno"]);
                                            // echo "<pre>";
                                            // print_r($telefono_uno_dividido);
                                            // echo "</pre>";
                                            ?>

                                            <?php if (!empty($telefono_uno_dividido[0])) {
                                                      
                                                      if(preg_match("/^54/", $telefono_uno_dividido[0])){
                                                          $longitud = strlen($telefono_uno_dividido[0]);
                                                          $telefonoSin54 = substr($telefono_uno_dividido[0],2,$longitud-2);

                                                          $longitudComprobar8 = strlen($telefonoSin54);

                                                          if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                            <td><?php echo '11'.$telefonoSin54; ?></td>
                                                         <?php  }else{ ?>
                                                            <td><?php echo $telefonoSin54; ?></td>
                                                        <?php  }
                                                            } else { ?>

                                                            <?php if (preg_match("/^0/", $telefono_uno_dividido[0])) {
                                                    $cadena_limpiada = ltrim($telefono_uno_dividido[0], 0);
                                                    $longitudComprobar8 = strlen($cadena_limpiada);

                                                    if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                        <td><?php echo '11'.$cadena_limpiada; ?></td>
                                                   <?php  }else {?>
                                                    <td><?php echo $cadena_limpiada; ?></td>
                                                  <?php }  
                                                 } else { 
                                                    $longitudComprobar8 = strlen($telefono_uno_dividido[0]);
                                                    if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>

                                                    <td><?php echo '11'.$telefono_uno_dividido[0]; ?> </td>
                                                   <?php  }else { ?>
                                                    <td><?php echo $telefono_uno_dividido[0]; ?> </td>
                                                  <?php  }
                                                       } ?>
                                                       <?php  } 
                                                            
                                            } else { ?>
                                                <td><?php echo '';
                                                } ?></td>
                                                <!-- aca termina la primera columna de tlf 1  ------->


                                                <!-- tlf 1.1 -->

                                                <?php if (!empty($telefono_uno_dividido[1])) {
                                                  if(preg_match("/^54/", $telefono_uno_dividido[1])){
                                                    $longitud = strlen($telefono_uno_dividido[1]);
                                                    $telefonoSin54 = substr($telefono_uno_dividido[1],2,$longitud-2);

                                                    $longitudComprobar8 = strlen($telefonoSin54);

                                                    if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                      <td><?php echo '11'.$telefonoSin54; ?></td>
                                                   <?php  }else{ ?>
                                                      <td><?php echo $telefonoSin54; ?></td>
                                                  <?php  }
                                                      } else { ?>

                                                      <?php if (preg_match("/^0/", $telefono_uno_dividido[1])) {
                                              $cadena_limpiada = ltrim($telefono_uno_dividido[1], 0);
                                              $longitudComprobar8 = strlen($cadena_limpiada);

                                              if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                  <td><?php echo '11'.$cadena_limpiada; ?></td>
                                             <?php  }else {?>
                                              <td><?php echo $cadena_limpiada; ?></td>
                                            <?php }  
                                           } else { 
                                              $longitudComprobar8 = strlen($telefono_uno_dividido[1]);
                                              if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>

                                              <td><?php echo '11'.$telefono_uno_dividido[1]; ?> </td>
                                             <?php  }else { ?>
                                              <td><?php echo $telefono_uno_dividido[1]; ?> </td>
                                            <?php  }
                                                 } ?>
                                                 <?php  } 
                                                      
                                      } else { ?>
                                          <td><?php echo '';
                                          } ?></td>

                                                    <!-- aca termina la primera columna de tlf 1.1  --------->



                                                    <!-- tlf 1.2 -->

                                                    <?php if (!empty($telefono_uno_dividido[2])) {
                                                        if(preg_match("/^54/", $telefono_uno_dividido[2])){
                                                            $longitud = strlen($telefono_uno_dividido[2]);
                                                            $telefonoSin54 = substr($telefono_uno_dividido[2],2,$longitud-2);
  
                                                            $longitudComprobar8 = strlen($telefonoSin54);
  
                                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                              <td><?php echo '11'.$telefonoSin54; ?></td>
                                                           <?php  }else{ ?>
                                                              <td><?php echo $telefonoSin54; ?></td>
                                                          <?php  }
                                                              } else { ?>
  
                                                              <?php if (preg_match("/^0/", $telefono_uno_dividido[2])) {
                                                      $cadena_limpiada = ltrim($telefono_uno_dividido[2], 0);
                                                      $longitudComprobar8 = strlen($cadena_limpiada);
  
                                                      if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                          <td><?php echo '11'.$cadena_limpiada; ?></td>
                                                     <?php  }else {?>
                                                      <td><?php echo $cadena_limpiada; ?></td>
                                                    <?php }  
                                                   } else { 
                                                      $longitudComprobar8 = strlen($telefono_uno_dividido[2]);
                                                      if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
  
                                                      <td><?php echo '11'.$telefono_uno_dividido[2]; ?> </td>
                                                     <?php  }else { ?>
                                                      <td><?php echo $telefono_uno_dividido[2]; ?> </td>
                                                    <?php  }
                                                         } ?>
                                                         <?php  } 
                                                              
                                              } else { ?>
                                                  <td><?php echo '';
                                                  } ?></td>

                                        <!-- aca termina la primera columna de tlf 1.2 -------->


                                        <!-- tlf 2 -->

                                        <?php $telefono_dos_dividido = explode("/", $telefono["telefono_dos"]); ?>

                                        <?php if (!empty($telefono_dos_dividido[0])) {
                                            if(preg_match("/^54/", $telefono_dos_dividido[0])){
                                                $longitud = strlen($telefono_dos_dividido[0]);
                                                $telefonoSin54 = substr($telefono_dos_dividido[0],2,$longitud-2);

                                                $longitudComprobar8 = strlen($telefonoSin54);

                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                    <td><?php echo '11'.$telefonoSin54; ?></td>
                                                <?php  }else{ ?>
                                                    <td><?php echo $telefonoSin54; ?></td>
                                                <?php  }
                                                    } else { ?>

                                                    <?php if (preg_match("/^0/", $telefono_dos_dividido[0])) {
                                            $cadena_limpiada = ltrim($telefono_dos_dividido[0], 0);
                                            $longitudComprobar8 = strlen($cadena_limpiada);

                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                <td><?php echo '11'.$cadena_limpiada; ?></td>
                                            <?php  }else {?>
                                            <td><?php echo $cadena_limpiada; ?></td>
                                        <?php }  
                                        } else { 
                                            $longitudComprobar8 = strlen($telefono_dos_dividido[0]);
                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>

                                            <td><?php echo '11'.$telefono_dos_dividido[0]; ?> </td>
                                            <?php  }else { ?>
                                            <td><?php echo $telefono_dos_dividido[0]; ?> </td>
                                        <?php  }
                                                } ?>
                                                <?php  } 
                                                    
                                    } else { ?>
                                        <td><?php echo '';
                                        } ?></td>

                                            <!-- aca termina la primera columna de tlf 2  --------->

                                            <!-- tlf 2.1 -->


                                            <?php if (!empty($telefono_dos_dividido[1])) {
                                                if(preg_match("/^54/", $telefono_dos_dividido[1])){
                                                $longitud = strlen($telefono_dos_dividido[1]);
                                                $telefonoSin54 = substr($telefono_dos_dividido[1],2,$longitud-2);

                                                $longitudComprobar8 = strlen($telefonoSin54);

                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                    <td><?php echo '11'.$telefonoSin54; ?></td>
                                                <?php  }else{ ?>
                                                    <td><?php echo $telefonoSin54; ?></td>
                                                <?php  }
                                                    } else { ?>

                                                    <?php if (preg_match("/^0/", $telefono_dos_dividido[1])) {
                                            $cadena_limpiada = ltrim($telefono_dos_dividido[1], 0);
                                            $longitudComprobar8 = strlen($cadena_limpiada);

                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                <td><?php echo '11'.$cadena_limpiada; ?></td>
                                            <?php  }else {?>
                                            <td><?php echo $cadena_limpiada; ?></td>
                                        <?php }  
                                        } else { 
                                            $longitudComprobar8 = strlen($telefono_dos_dividido[1]);
                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>

                                            <td><?php echo '11'.$telefono_dos_dividido[1]; ?> </td>
                                            <?php  }else { ?>
                                            <td><?php echo $telefono_dos_dividido[1]; ?> </td>
                                        <?php  }
                                                } ?>
                                                <?php  } 
                                                    
                                    } else { ?>
                                        <td><?php echo '';
                                        } ?></td>

                                                <!-- aca termina la primera columna de tlf 2.1  -------->


                                                <!-- tlf 2.2 -->

                                                <?php if (!empty($telefono_dos_dividido[2])) {
                                                    if(preg_match("/^54/", $telefono_dos_dividido[2])){
                                                    $longitud = strlen($telefono_dos_dividido[2]);
                                                    $telefonoSin54 = substr($telefono_dos_dividido[2],2,$longitud-2);

                                                    $longitudComprobar8 = strlen($telefonoSin54);

                                                    if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                        <td><?php echo '11'.$telefonoSin54; ?></td>
                                                    <?php  }else{ ?>
                                                        <td><?php echo $telefonoSin54; ?></td>
                                                    <?php  }
                                                        } else { ?>

                                                        <?php if (preg_match("/^0/", $telefono_dos_dividido[2])) {
                                                $cadena_limpiada = ltrim($telefono_dos_dividido[2], 0);
                                                $longitudComprobar8 = strlen($cadena_limpiada);

                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                    <td><?php echo '11'.$cadena_limpiada; ?></td>
                                                <?php  }else {?>
                                                <td><?php echo $cadena_limpiada; ?></td>
                                            <?php }  
                                            } else { 
                                                $longitudComprobar8 = strlen($telefono_dos_dividido[2]);
                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>

                                                <td><?php echo '11'.$telefono_dos_dividido[2]; ?> </td>
                                                <?php  }else { ?>
                                                <td><?php echo $telefono_dos_dividido[2]; ?> </td>
                                            <?php  }
                                                    } ?>
                                                    <?php  } 
                                                        
                                        } else { ?>
                                            <td><?php echo '';
                                            } ?></td>


                                            <!-- aca termina la primera columna de tlf 2.2  --------->

                                            <!-- tlf 3 -->
                                            <?php $telefono_tres_dividido = explode("/", $telefono["telefono_tres"]); ?>

                                            <?php if (!empty($telefono_tres_dividido[0])) {
                                                if(preg_match("/^54/", $telefono_tres_dividido[0])){
                                                    $longitud = strlen($telefono_tres_dividido[0]);
                                                    $telefonoSin54 = substr($telefono_tres_dividido[0],2,$longitud-2);

                                                    $longitudComprobar8 = strlen($telefonoSin54);

                                                    if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                        <td><?php echo '11'.$telefonoSin54; ?></td>
                                                    <?php  }else{ ?>
                                                        <td><?php echo $telefonoSin54; ?></td>
                                                    <?php  }
                                                        } else { ?>

                                                        <?php if (preg_match("/^0/", $telefono_tres_dividido[0])) {
                                                $cadena_limpiada = ltrim($telefono_tres_dividido[0], 0);
                                                $longitudComprobar8 = strlen($cadena_limpiada);

                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                    <td><?php echo '11'.$cadena_limpiada; ?></td>
                                                <?php  }else {?>
                                                <td><?php echo $cadena_limpiada; ?></td>
                                            <?php }  
                                            } else { 
                                                $longitudComprobar8 = strlen($telefono_tres_dividido[0]);
                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>

                                                <td><?php echo '11'.$telefono_tres_dividido[0]; ?> </td>
                                                <?php  }else { ?>
                                                <td><?php echo $telefono_tres_dividido[0]; ?> </td>
                                            <?php  }
                                                    } ?>
                                                    <?php  } 
                                                        
                                        } else { ?>
                                            <td><?php echo '';
                                            } ?></td>
                                                <!-- aca termina la primera columna de tlf 3  -------->


                                                <!-- tlf 3.1 -------->

                                                <?php if (!empty($telefono_tres_dividido[1])) {

                                            if(preg_match("/^54/", $telefono_tres_dividido[1])){
                                                $longitud = strlen($telefono_tres_dividido[1]);
                                                $telefonoSin54 = substr($telefono_tres_dividido[1],2,$longitud-2);

                                                $longitudComprobar8 = strlen($telefonoSin54);

                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                <td><?php echo '11'.$telefonoSin54; ?></td>
                                            <?php  }else{ ?>
                                                <td><?php echo $telefonoSin54; ?></td>
                                            <?php  }
                                                } else { ?>

                                                <?php if (preg_match("/^0/", $telefono_tres_dividido[1])) {
                                            $cadena_limpiada = ltrim($telefono_tres_dividido[1], 0);
                                            $longitudComprobar8 = strlen($cadena_limpiada);

                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                            <td><?php echo '11'.$cadena_limpiada; ?></td>
                                            <?php  }else {?>
                                            <td><?php echo $cadena_limpiada; ?></td>
                                            <?php }  
                                            } else { 
                                            $longitudComprobar8 = strlen($telefono_tres_dividido[1]);
                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>

                                            <td><?php echo '11'.$telefono_tres_dividido[1]; ?> </td>
                                            <?php  }else { ?>
                                            <td><?php echo $telefono_tres_dividido[1]; ?> </td>
                                            <?php  }
                                            } ?>
                                            <?php  } 
                                                
                                            } else { ?>
                                            <td><?php echo '';
                                            } ?></td>

                                                        <!-- aca termina la primera columna de tlf 3.1  -->

                                                            <!-- tlf 3.2 -------->

                                        <?php if (!empty($telefono_tres_dividido[2])) {

                                        if(preg_match("/^54/", $telefono_tres_dividido[2])){
                                            $longitud = strlen($telefono_tres_dividido[2]);
                                            $telefonoSin54 = substr($telefono_tres_dividido[2],2,$longitud-2);

                                            $longitudComprobar8 = strlen($telefonoSin54);

                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                            <td><?php echo '11'.$telefonoSin54; ?></td>
                                        <?php  }else{ ?>
                                            <td><?php echo $telefonoSin54; ?></td>
                                        <?php  }
                                            } else { ?>

                                            <?php if (preg_match("/^0/", $telefono_tres_dividido[2])) {
                                        $cadena_limpiada = ltrim($telefono_tres_dividido[2], 0);
                                        $longitudComprobar8 = strlen($cadena_limpiada);

                                        if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                        <td><?php echo '11'.$cadena_limpiada; ?></td>
                                        <?php  }else {?>
                                        <td><?php echo $cadena_limpiada; ?></td>
                                        <?php }  
                                        } else { 
                                        $longitudComprobar8 = strlen($telefono_tres_dividido[2]);
                                        if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>

                                        <td><?php echo '11'.$telefono_tres_dividido[2]; ?> </td>
                                        <?php  }else { ?>
                                        <td><?php echo $telefono_tres_dividido[2]; ?> </td>
                                        <?php  }
                                        } ?>
                                        <?php  } 
                                            
                                        } else { ?>
                                        <td><?php echo '';
                                        } ?></td>

                                        <!-- aca termina la primera columna de tlf 3.2  -->

                                        <!-- tlf 4 -->

                                        <?php $telefono_cuatro_dividido = explode("/", $telefono["telefono_cuatro"]); ?>

                                        <?php if (!empty($telefono_cuatro_dividido[0])) {
                                            if(preg_match("/^54/", $telefono_cuatro_dividido[0])){
                                                $longitud = strlen($telefono_cuatro_dividido[0]);
                                                $telefonoSin54 = substr($telefono_cuatro_dividido[0],2,$longitud-2);
    
                                                $longitudComprobar8 = strlen($telefonoSin54);
    
                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                <td><?php echo '11'.$telefonoSin54; ?></td>
                                            <?php  }else{ ?>
                                                <td><?php echo $telefonoSin54; ?></td>
                                            <?php  }
                                                } else { ?>
    
                                                <?php if (preg_match("/^0/", $telefono_cuatro_dividido[0])) {
                                            $cadena_limpiada = ltrim($telefono_cuatro_dividido[0], 0);
                                            $longitudComprobar8 = strlen($cadena_limpiada);
    
                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                            <td><?php echo '11'.$cadena_limpiada; ?></td>
                                            <?php  }else {?>
                                            <td><?php echo $cadena_limpiada; ?></td>
                                            <?php }  
                                            } else { 
                                            $longitudComprobar8 = strlen($telefono_cuatro_dividido[0]);
                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
    
                                            <td><?php echo '11'.$telefono_cuatro_dividido[0]; ?> </td>
                                            <?php  }else { ?>
                                            <td><?php echo $telefono_cuatro_dividido[0]; ?> </td>
                                            <?php  }
                                            } ?>
                                            <?php  } 
                                                
                                            } else { ?>
                                            <td><?php echo '';
                                            } ?></td>

                                            <!-- aca termina la primera columna de tlf 4  -->

                                            <!-- tlf 4.1 -->
                                            <?php if (!empty($telefono_cuatro_dividido[1])) {
                                               if(preg_match("/^54/", $telefono_cuatro_dividido[1])){
                                                $longitud = strlen($telefono_cuatro_dividido[1]);
                                                $telefonoSin54 = substr($telefono_cuatro_dividido[1],2,$longitud-2);
    
                                                $longitudComprobar8 = strlen($telefonoSin54);
    
                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                <td><?php echo '11'.$telefonoSin54; ?></td>
                                            <?php  }else{ ?>
                                                <td><?php echo $telefonoSin54; ?></td>
                                            <?php  }
                                                } else { ?>
    
                                                <?php if (preg_match("/^0/", $telefono_cuatro_dividido[1])) {
                                            $cadena_limpiada = ltrim($telefono_cuatro_dividido[1], 0);
                                            $longitudComprobar8 = strlen($cadena_limpiada);
    
                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                            <td><?php echo '11'.$cadena_limpiada; ?></td>
                                            <?php  }else {?>
                                            <td><?php echo $cadena_limpiada; ?></td>
                                            <?php }  
                                            } else { 
                                            $longitudComprobar8 = strlen($telefono_cuatro_dividido[1]);
                                            if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
    
                                            <td><?php echo '11'.$telefono_cuatro_dividido[1]; ?> </td>
                                            <?php  }else { ?>
                                            <td><?php echo $telefono_cuatro_dividido[1]; ?> </td>
                                            <?php  }
                                            } ?>
                                            <?php  } 
                                                
                                            } else { ?>
                                            <td><?php echo '';
                                            } ?></td>

                                                <!-- aca termina la primera columna de tlf 4.1  -->

                                                <!-- tlf 4.2 -->
                                                <?php if (!empty($telefono_cuatro_dividido[2])) {
                                                   if(preg_match("/^54/", $telefono_cuatro_dividido[2])){
                                                    $longitud = strlen($telefono_cuatro_dividido[2]);
                                                    $telefonoSin54 = substr($telefono_cuatro_dividido[2],2,$longitud-2);
        
                                                    $longitudComprobar8 = strlen($telefonoSin54);
        
                                                    if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                    <td><?php echo '11'.$telefonoSin54; ?></td>
                                                <?php  }else{ ?>
                                                    <td><?php echo $telefonoSin54; ?></td>
                                                <?php  }
                                                    } else { ?>
        
                                                    <?php if (preg_match("/^0/", $telefono_cuatro_dividido[2])) {
                                                $cadena_limpiada = ltrim($telefono_cuatro_dividido[2], 0);
                                                $longitudComprobar8 = strlen($cadena_limpiada);
        
                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
                                                <td><?php echo '11'.$cadena_limpiada; ?></td>
                                                <?php  }else {?>
                                                <td><?php echo $cadena_limpiada; ?></td>
                                                <?php }  
                                                } else { 
                                                $longitudComprobar8 = strlen($telefono_cuatro_dividido[2]);
                                                if($longitudComprobar8 === 8 && $telefono["codigo_postal"] >=1000 && $telefono["codigo_postal"] <= 1900 ){ ?>
        
                                                <td><?php echo '11'.$telefono_cuatro_dividido[2]; ?> </td>
                                                <?php  }else { ?>
                                                <td><?php echo $telefono_cuatro_dividido[2]; ?> </td>
                                                <?php  }
                                                } ?>
                                                <?php  } 
                                                    
                                                } else { ?>
                                                <td><?php echo '';
                                                } ?></td>

                                                            <!-- aca termina la primera columna de tlf 4.2  -->
                                        </tr>

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

            <?php   }
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
            Utils::deleteSession('importado');
            Utils::deleteSession('fechaLimpiar');
            Utils::deleteSession('empresaLimpiar');
            Utils::deleteSession('carteraLimpiar');
            Utils::deleteSession('estructura');
            Utils::deleteSession('formato');
            Utils::deleteSession('cartera');
            Utils::deleteSession('carteraData');
            Utils::deleteSession('empresaData');
            Utils::deleteSession('fechaData');




            ?>

                </div>
            </div>
        </div>


        <?php require_once('../../views/include/adm/inferior_normalizacion.php'); ?>