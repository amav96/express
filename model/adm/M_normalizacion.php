<?php


function clean($str)
{
    // IMPORTANTE ','=>'.'. ES PARA IMPORTAR TEXTO PARA QUE PUEDA ENTRAR EL ARCHIVO
    $unwanted_array = array(
        "'" => '', ',' => '', ' ' => '', '(' => '', ')' => '', '-' => '', '*' => '', '#' => '',
         '$' => '', '%' => '', '&' => '', '?' => '', '¿' => '', '!' => '', '¡' => '', '<' => '', 
         '>' => '', '_' => '', '{' => '', '}' => '', '[' => '', ']' => '', '+' => '', '~' => '',
          '@' => '', 'a' => '', 'b' => '', 'c' => '', 'd' => '', 'e' => '', 'f' => '', 'g' => '',
           'h' => '', 'i' => '', 'j' => '', 'k' => '', 'l' => '', 'm' => '', 'n' => '', 'ñ' => '',
            'o' => '', 'p' => '', 'q' => '', 'r' => '', 's' => '', 't' => '', 'u' => '', 'v' => '',
             'w' => '', 'y' => '', 'z' => '', 'A' => '', 'B' => '', 'C' => '', 'D' => '', 'E' => '',
              'F' => '', 'G' => '', 'H' => '', 'I' => '', 'J' => '', 'K' => '', 'L' => '', 'M' => '',
               'N' => '', 'Ñ' => '', 'O' => '', 'P' => '', 'Q' => '', 'R' => '', 'S' => '', 'T' => '',
                'U' => '', 'V' => '', 'W' => 'Y', 'Z' => '', 'á' => '', 'é' => '', 'í' => '', 'ó' => '',
                 'ú' => '', '.' => '' 
    );

    return strtr($str, $unwanted_array);
}

function cleanBase($str)
{
    // IMPORTANTE ','=>'.'. ES PARA IMPORTAR TEXTO PARA QUE PUEDA ENTRAR EL ARCHIVO
    $unwanted_array = array(
        "'" => '', ',' => '', '.' => '' 
    );

    return strtr($str, $unwanted_array);
}

function mostrarEmpresas($connection)
{

    $sql = "SELECT * from empresas_para_modelos";
    $empresas = mysqli_query($connection, $sql);

    if ($empresas && $empresas->num_rows > 0) {

        while ($empresa = mysqli_fetch_assoc($empresas)) {

            $objeto[] = array(
                'empresa' => $empresa["empresa"]
            );
        }

        $jsonstring = json_encode($objeto);
        echo $jsonstring;
    }
}


function  importarDataLimpiar($cartera, $empresa, $fecha, $operador, $connection)
{



    $sql = "SELECT * from normalizacion_telefonos_limpiar where cartera ='$cartera';";
    $carteraExe = mysqli_query($connection, $sql);

    if ($carteraExe && $carteraExe->num_rows > 0) {
        $_SESSION["cartera"] = 'existe';
        header("Location: ../../views/admin/normalizacion_limpiar_telefonos.php");
    } else {

        $row = 1;

        //Aquí es donde seleccionamos nuestro csv
        $fname = $_FILES['dataImportar']['name'];
        echo 'Cargando nombre del archivo: ' . $fname . ' <br>';
        $chk_ext = explode(".", $fname);


        if (strtolower(end($chk_ext)) == "csv") {
            //si es correcto, entonces damos permisos de lectura para subir
            $filename = $_FILES['dataImportar']['tmp_name'];


            $handle = fopen($filename, "r");
            // la cantidad del bloque *- prueba con un archivo de 50 lineas y prueba colocando 10 a ver si todo va como quieres. 

            $qtyToInsert = 1500;
            $totals = 0;
            // block lo uso para contar cuantos tengo en el bloque actual 
            $block = 0;
            $sqlInsert = "INSERT INTO normalizacion_telefonos_limpiar (id,id_local,documento,telefono_uno,telefono_dos,telefono_tres,telefono_cuatro,fecha_ingresado,operador,empresa,cartera,codigo_postal) VALUES ";

            $insertNumber = 0;
            $entries = 0;
            $cabecera = 0;

            while (($cabeza = fgetcsv($handle, 9999, ";")) !== FALSE) {

                if ($cabecera == 0) {

                    if ($cabeza[0] === 'id_local' && $cabeza[1] === 'codigo_postal' && $cabeza[2] === 'documento' && $cabeza[3] === 'telefono1' && $cabeza[4] === 'telefono2' && $cabeza[5] === 'telefono3' && $cabeza[6] === 'telefono4') {


                        while (($entrie = fgetcsv($handle, 9999, ";")) !== FALSE) {

                            //echo json_encode($entrie)."<br><br>";                   
                            $entries++;
                            // si no es la primera recuerda agregar una coma
                            if ($block != 0) {
                                $sqlInsert .= ',';
                            }
                            //agregas nueva linea


                            $id_local = (!empty($entrie[0])) ? $entrie[0] : '0';
                            $codigo_postal = (!empty($entrie[1])) ? $entrie[1] : '0';
                            $documento = (!empty($entrie[2])) ? $entrie[2] : '0';
                            $telefono1 = (!empty($entrie[3])) ? $entrie[3] : '0';
                            $telefono2 = (!empty($entrie[4])) ? $entrie[4] : '0';
                            $telefono3 = (!empty($entrie[5])) ? $entrie[5] : '0';
                            $telefono4 = (!empty($entrie[6])) ? $entrie[6] : '0';
                            $fechaIngresada = $fecha;
                            $operadorIngresado = $operador;
                            $empresaIngresada = $empresa;
                            $carteraIngresada = $cartera;
                             

                            $sqlInsert .=
                                "(null,'" . clean($id_local) . "','" . clean($documento) . "', '" . clean($telefono1) . "', '" . clean($telefono2) . "', '" . clean($telefono3) . "', '" . clean($telefono4) . "','" . $fechaIngresada . "', '" . $operadorIngresado . "', '" . $empresaIngresada . "', '" . $carteraIngresada . "', '" . $codigo_postal . "')";

                            $block++;
                            if ($block >= $qtyToInsert) {
                                $execute = mysqli_query($connection, $sqlInsert);
                                // echo $sqlInsert;

                                $insertNumber++;
                                // reinicias block 
                                $block = 0;
                                // reinicias sentencia sql
                                $sqlInsert = "INSERT INTO normalizacion_telefonos_limpiar (id,id_local,documento,telefono_uno,telefono_dos,telefono_tres,telefono_cuatro,fecha_ingresado,operador,empresa,cartera,codigo_postal) VALUES ";
                            }




                            // esto solo es el total de todos 
                            $totals++;
                        }

                        // al salir si hay cosas pendientes ejecutas la ultima - no lo olvides
                        if ($block > 0) {
                            $execute = mysqli_query($connection, $sqlInsert);
                            //echo $sqlInsert;
                            $insertNumber++;
                        }

                        if ($execute) {

                            $_SESSION["importado"] = "importado";
                            $_SESSION["cantidad"] = $entries;

                            header("Location: ../../views/admin/normalizacion_limpiar_telefonos.php");
                        } else {

                            $_SESSION["importado"] = "error";

                            echo "error :" . mysqli_error($connection);
                            header("Location: ../../views/admin/normalizacion_limpiar_telefonos.php");
                        }
                    } else {

                        $_SESSION["estructura"] = 'failedLimpiar';
                        header("Location: ../../views/admin/normalizacion_limpiar_telefonos.php");
                    }
                    $cabecera++;
                }
            }
        } else {
            $_SESSION["formato"] = 'failedLimpiar';
            header("Location: ../../views/admin/normalizacion_limpiar_telefonos.php");
        }
    }
}

function importarDataParaOrdenar($cartera, $empresa, $fecha, $operador, $connection)
{

    $sql = "SELECT * from normalizacion_telefonos_dividir_ordenar where cartera ='$cartera';";
    $carteraExe = mysqli_query($connection, $sql);

    if ($carteraExe && $carteraExe->num_rows > 0) {
        $_SESSION["cartera"] = 'existe';
        header("Location: ../../views/admin/normalizacion_juntar_telefonos_clientes.php");
    } else {


        //conexiones, conexiones everywhere
        // ini_set('display_errors', 1);
        // error_reporting(E_ALL);
        // mysqli_report(MYSQLI_REPORT_ERROR);
        $row = 1;

        //Aquí es donde seleccionamos nuestro csv
        $fname = $_FILES['dataImportarOrdenar']['name'];
        echo 'Cargando nombre del archivo: ' . $fname . ' <br>';
        $chk_ext = explode(".", $fname);


        if (strtolower(end($chk_ext)) == "csv") {
            //si es correcto, entonces damos permisos de lectura para subir
            $filename = $_FILES['dataImportarOrdenar']['tmp_name'];


            $handle = fopen($filename, "r");
            // la cantidad del bloque *- prueba con un archivo de 50 lineas y prueba colocando 10 a ver si todo va como quieres. 


            $qtyToInsert = 1500;
            $totals = 0;
            // block lo uso para contar cuantos tengo en el bloque actual 
            $block = 0;
            $sqlInsert = "INSERT INTO normalizacion_telefonos_dividir_ordenar (id,id_local,documento,telefono_uno,telefono_uno_uno,telefono_uno_dos,telefono_dos,telefono_dos_uno,telefono_dos_dos,telefono_tres,telefono_tres_uno,telefono_tres_dos,telefono_cuatro,telefono_cuatro_uno,telefono_cuatro_dos,fecha_ingresado,operador,empresa,cartera) VALUES ";


            $insertNumber = 0;
            $entries = 0;
            $cabecera = 0;

            while (($cabeza = fgetcsv($handle, 9999, ";")) !== FALSE) {
                $cabeza++;
                $cabecera++;

                if ($cabecera === 1) {
                    if ($cabeza[0] !== 'Express procesando') {

                        $_SESSION["primeraFila"] = 'failedOrdenar';

                        header("Location: ../../views/admin/normalizacion_juntar_telefonos_clientes.php");
                    } else {

                        $cabecera++;

                        if ($cabecera === 2) {
                            $cabecera++;
                            $archivo = file($filename);

                            $conversionAFila = explode(';', $archivo[1]);


                            if (trim($conversionAFila[0]) === 'id_local' && trim($conversionAFila[1]) === 'documento' && trim($conversionAFila[2]) === 'tlf 1'  && trim($conversionAFila[3]) === 'tlf 1.1' && trim($conversionAFila[4]) === 'tlf 1.2' && trim($conversionAFila[5]) === 'tlf 2' && trim($conversionAFila[6]) === 'tlf 2.1' && trim($conversionAFila[7]) === 'tlf 2.2' && trim($conversionAFila[8]) === 'tlf 3' && trim($conversionAFila[9]) === 'tlf 3.1' && trim($conversionAFila[10]) === 'tlf 3.2' && trim($conversionAFila[11]) === 'tlf 4' && trim($conversionAFila[12]) === 'tlf 4.1' && trim($conversionAFila[13]) === 'tlf 4.2') {



                                $cuentoFilasParaIngrear = 1;
                                while (($entrie = fgetcsv($handle, 9999, ";")) !== FALSE) {

                                    //echo json_encode($entrie)."<br><br>";                   
                                    $entries++;


                                    if ($cuentoFilasParaIngrear === 1) {

                                        $cuentoFilasParaIngrear++;
                                        continue;
                                    }


                                    // si no es la primera recuerda agregar una coma
                                    if ($block != 0) {
                                        $sqlInsert .= ',';
                                    }
                                    //agregas nueva linea



                                    $id_local = (!empty($entrie[0])) ? $entrie[0] : '0';
                                    $documento = (!empty($entrie[1])) ? $entrie[1] : '0';
                                    $telefono1 = (!empty($entrie[2])) ? $entrie[2] : '0';
                                    $telefono1_1 = (!empty($entrie[3])) ? $entrie[3] : '0';
                                    $telefono1_2 = (!empty($entrie[4])) ? $entrie[4] : '0';
                                    $telefono2 = (!empty($entrie[5])) ? $entrie[5] : '0';
                                    $telefono2_1 = (!empty($entrie[6])) ? $entrie[6] : '0';
                                    $telefono2_2 = (!empty($entrie[7])) ? $entrie[7] : '0';
                                    $telefono3 = (!empty($entrie[8])) ? $entrie[8] : '0';
                                    $telefono3_1 = (!empty($entrie[9])) ? $entrie[9] : '0';
                                    $telefono3_2 = (!empty($entrie[10])) ? $entrie[10] : '0';
                                    $telefono4 = (!empty($entrie[11])) ? $entrie[11] : '0';
                                    $telefono4_1 = (!empty($entrie[12])) ? $entrie[12] : '0';
                                    $telefono4_2 = (!empty($entrie[13])) ? $entrie[13] : '0';
                                    $fechaIngresada = $fecha;
                                    $operadorIngresada = $operador;
                                    $empresaIngresada = $empresa;
                                    $carteraIngresada = $cartera;


                                    $sqlInsert .=
                                        "(null,'" . clean($id_local) . "','" . clean($documento) . "', '" . clean($telefono1) . "', '" . clean($telefono1_1) . "', '" . clean($telefono1_2) . "', '" . clean($telefono2) . "', '" . clean($telefono2_1) . "', '" . clean($telefono2_2) . "', '" . clean($telefono3) . "', '" . clean($telefono3_1) . "', '" . clean($telefono3_2) . "', '" . clean($telefono4) . "', '" . clean($telefono4_1) . "', '" . clean($telefono4_2) . "', '" . $fechaIngresada . "', '" . $operadorIngresada . "', '" . $empresaIngresada . "', '" . $carteraIngresada . "')";


                                    $block++;


                                    if ($block >= $qtyToInsert) {
                                        $execute = mysqli_query($connection, $sqlInsert);
                                        // echo $sqlInsert;

                                        $insertNumber++;
                                        // reinicias block 
                                        $block = 0;
                                        // reinicias sentencia sql
                                        $sqlInsert = "INSERT INTO normalizacion_telefonos_dividir_ordenar (id,id_local,documento,telefono_uno,telefono_uno_uno,telefono_uno_dos,telefono_dos,telefono_dos_uno,telefono_dos_dos,telefono_tres,telefono_tres_uno,telefono_tres_dos,telefono_cuatro,telefono_cuatro_uno,telefono_cuatro_dos,fecha_ingresado,operador,empresa,cartera) VALUES ";
                                    }

                                    // esto solo es el total de todos 
                                    $totals++;
                                }

                                // al salir si hay cosas pendientes ejecutas la ultima - no lo olvides
                                if ($block > 0) {
                                    $execute = mysqli_query($connection, $sqlInsert);
                                    //echo $sqlInsert;
                                    $insertNumber++;
                                }

                                if ($execute) {

                                    $_SESSION["importado"] = "importadoOrdenar";


                                    header("Location: ../../views/admin/normalizacion_juntar_telefonos_clientes.php");

                                    $_SESSION["cantidad"] = $entries - 1;
                                } else {

                                    $_SESSION["importado"] = "error";

                                   
                                    header("Location: ../../views/admin/normalizacion_juntar_telefonos_clientes.php");
                                }
                            } else {

                                $_SESSION["estructura"] = 'failedOrdenar';
                                header("Location: ../../views/admin/normalizacion_juntar_telefonos_clientes.php");
                            }
                            $cabecera++;
                        } else {

                            $_SESSION["importado"] = "error";
                        }
                    }
                }
            }
        } else {
            $_SESSION["formato"] = 'failedOrdenar';
            header("Location: ../../views/admin/normalizacion_juntar_telefonos_clientes.php");
        }
    }
}
function importarDataParaValidar($cartera, $empresa, $fecha, $operador, $connection)
{


    $sql = "SELECT * from normalizacion_telefonos_validar where cartera ='$cartera';";
    $carteraExe = mysqli_query($connection, $sql);

    if ($carteraExe && $carteraExe->num_rows > 0) {
        $_SESSION["cartera"] = 'existe';
        header("Location: ../../views/admin/normalizacion_validar_telefonos.php");
    } else {


        //conexiones, conexiones everywhere
        // ini_set('display_errors', 1);
        // error_reporting(E_ALL);
        // mysqli_report(MYSQLI_REPORT_ERROR);
        $row = 1;

        //Aquí es donde seleccionamos nuestro csv
        $fname = $_FILES['dataImportarParaValidar']['name'];
        echo 'Cargando nombre del archivo: ' . $fname . ' <br>';
        $chk_ext = explode(".", $fname);


        if (strtolower(end($chk_ext)) == "csv") {
            //si es correcto, entonces damos permisos de lectura para subir
            $filename = $_FILES['dataImportarParaValidar']['tmp_name'];


            $handle = fopen($filename, "r");
            // la cantidad del bloque *- prueba con un archivo de 50 lineas y prueba colocando 10 a ver si todo va como quieres. 


            $qtyToInsert = 1500;
            $totals = 0;
            // block lo uso para contar cuantos tengo en el bloque actual 
            $block = 0;
            $sqlInsert = "INSERT INTO normalizacion_telefonos_validar (id,id_local,documento,telefono,fecha_ingresado,operador,empresa,cartera) VALUES ";

            $insertNumber = 0;
            $entries = 0;
            $cabecera = 0;

            while (($cabeza = fgetcsv($handle, 9999, ";")) !== FALSE) {
                $cabeza++;
                $cabecera++;
                
                if ($cabecera === 1) {
                    
                    if ($cabeza[0] !== 'Express procesando') {
                        
                        $_SESSION["primeraFila"] = 'failedValidar';

                        header("Location: ../../views/admin/normalizacion_validar_telefonos.php");
                    } else {
                        $cabecera++;

                        
                        if($cabecera === 2){

                            $cabecera++;
                            $archivo = file($filename);

                            $conversionAFila = explode(';', $archivo[1]);

                            
                             if (trim($conversionAFila[0]) === 'id_local' && trim($conversionAFila[1]) === 'documento' && trim($conversionAFila[2]) === 'telefono' ) {

                              
                             


                                $cuentoFilasParaIngrear = 1;
                    while (($entrie = fgetcsv($handle, 9999, ";")) !== FALSE) {

                        //echo json_encode($entrie)."<br><br>";                   
                        $entries++;

                        if ($cuentoFilasParaIngrear === 1) {

                            $cuentoFilasParaIngrear++;
                            continue;
                        }
                        // si no es la primera recuerda agregar una coma
                        if ($block != 0) {
                            $sqlInsert .= ',';
                        }
                        //agregas nueva linea


                        $id_local = (!empty($entrie[0])) ? $entrie[0] : '0';
                        $guia = (!empty($entrie[1])) ? $entrie[1] : '0';
                        $telefono = (!empty($entrie[2])) ? $entrie[2] : '0';
                        $fechaIngresada = $fecha;
                        $operadorIngresada = $operador;
                        $empresaIngresada = $empresa;
                        $carteraIngresada = $cartera;

                        $sqlInsert .=
                            "(null,'" . clean($id_local) . "','" . clean($guia) . "', '" . clean($telefono) . "', '" . $fechaIngresada . "', '" . $operadorIngresada . "', '" . $empresaIngresada . "', '" . $carteraIngresada . "') ";
                            
                        $block++;


                        if ($block >= $qtyToInsert) {
                            $execute = mysqli_query($connection, $sqlInsert);
                            // echo $sqlInsert;

                            $insertNumber++;
                            // reinicias block 
                            $block = 0;
                            // reinicias sentencia sql
                            $sqlInsert = "INSERT INTO normalizacion_telefonos_validar (id,id_local,documento,telefono,fecha_ingresado,operador,empresa,cartera) VALUES ";
                        }
                        

                        // esto solo es el total de todos 
                        $totals++;
                    }
                
                    // al salir si hay cosas pendientes ejecutas la ultima - no lo olvides
                    if ($block > 0) {
                        $execute = mysqli_query($connection, $sqlInsert);
                        //echo $sqlInsert;
                        $insertNumber++;
                    }

                    if ($execute) {

                        $_SESSION["importado"] = "importadoValidar";
                        $_SESSION["cantidad"] = $entries -1;

                        header("Location: ../../views/admin/normalizacion_validar_telefonos.php");
                    } else {

                        $_SESSION["importado"] = "error";
                       
                        header("Location: ../../views/admin/normalizacion_validar_telefonos.php");
                    }

                
                }else {
                    $_SESSION["estructura"] = 'failedValidar';
                    header("Location: ../../views/admin/normalizacion_validar_telefonos.php");

                  }
                
                  $cabecera++;
                } else {

                    $_SESSION["importado"] = "error";
                }
              }
            }
        }
     } else {
            $_SESSION["formato"] = 'failedValidar';
            header("Location: ../../views/admin/normalizacion_validar_telefonos.php");
            print_r($_SESSION["formato"]);
            die();
        }
    }
}

function importarDataParaLimpiarValidados($connection)
{


    
        //conexiones, conexiones everywhere
        // ini_set('display_errors', 1);
        // error_reporting(E_ALL);
        // mysqli_report(MYSQLI_REPORT_ERROR);
        $row = 1;

        //Aquí es donde seleccionamos nuestro csv
        $fname = $_FILES['dataImportarLimpiarValidados']['name'];
        echo 'Cargando nombre del archivo: ' . $fname . ' <br>';
        $chk_ext = explode(".", $fname);


        if (strtolower(end($chk_ext)) == "csv") {
            //si es correcto, entonces damos permisos de lectura para subir
            $filename = $_FILES['dataImportarLimpiarValidados']['tmp_name'];


            $handle = fopen($filename, "r");
            // la cantidad del bloque *- prueba con un archivo de 50 lineas y prueba colocando 10 a ver si todo va como quieres. 

    
            $qtyToInsert = 1500;
            $totals = 0;
            // block lo uso para contar cuantos tengo en el bloque actual 
            $block = 0;
            $sqlInsert = "INSERT INTO normalizacion_limpiar_validados (id,id_local,documento,telefono,localidad,sin_15,reemplazar,longitud,modalidad,operador,empresa,cartera,fecha_ingresado) VALUES ";

            $insertNumber = 0;
            $entries = 0;
            $cabecera = 0;

            while (($cabeza = fgetcsv($handle, 9999, ";")) !== FALSE) {
                $cabeza++;
                $cabecera++;
                
                if ($cabecera === 1) {
                    
                    if ($cabeza[0] !== 'Express procesando') {
                        
                        $_SESSION["primeraFila"] = 'failedLimpiarValidados';

                        header("Location: ../../views/admin/normalizacion_limpiar_validados.php");
                    } else {
                        $cabecera++;

                        
                        if($cabecera === 2){

                            $cabecera++;
                            $archivo = file($filename);

                            $conversionAFila = explode(';', $archivo[1]);

                            
                             if (trim($conversionAFila[0]) === 'id_local' && trim($conversionAFila[1]) === 'documento' && trim($conversionAFila[2]) === 'telefono'  && trim($conversionAFila[3]) === 'localidad' && trim($conversionAFila[4]) === 'sin_15' && trim($conversionAFila[5]) === 'reemplazar'  && trim($conversionAFila[6]) === 'longitud' && trim($conversionAFila[7]) === 'modalidad' && trim($conversionAFila[8]) === 'operador' && trim($conversionAFila[9]) === 'empresa' && trim($conversionAFila[10]) === 'cartera' && trim($conversionAFila[11]) === 'fecha_ingresado')   {
                                 

                               
                                $cuentoFilasParaIngrear = 1;
                                
                        while (($entrie = fgetcsv($handle, 9999, ";")) !== FALSE) {
                        //echo json_encode($entrie)."<br><br>";                   
                        $entries++;
                        if ($cuentoFilasParaIngrear === 1) {

                            $cuentoFilasParaIngrear++;
                            continue;
                        }
                        // si no es la primera recuerda agregar una coma
                        if ($block != 0) {
                            $sqlInsert .= ',';
                        }
                        //agregas nueva linea

                        $id_local = (!empty($entrie[0])) ? $entrie[0] : '0';
                        $documento = (!empty($entrie[1])) ? $entrie[1] : '0';
                        $telefono = (!empty($entrie[2])) ? $entrie[2] : '0';
                        $localidad = (!empty($entrie[3])) ? $entrie[3] : '0';
                        $sin_15 = (!empty($entrie[4])) ? $entrie[4] : '0';
                        $reemplazar = (!empty($entrie[5])) ? $entrie[5] : '0';
                        $longitud = (!empty($entrie[6])) ? $entrie[6] : '0';
                        $modalidad = (!empty($entrie[7])) ? $entrie[7] : '0';
                        $operador = (!empty($entrie[8])) ? $entrie[8] : '0';
                        $empresa = (!empty($entrie[9])) ? $entrie[9] : '0';
                        $cartera = (!empty($entrie[10])) ? $entrie[10] : '0';
                        $fecha_ingreso = (!empty($entrie[11])) ? $entrie[11] : '0';
            
                        $transformar_fecha = str_replace('/', '-', $fecha_ingreso);
            
                        $fecha2 = date_create_from_format('j-m-Y', $transformar_fecha);
                        $fechaFinalAGuardar = date_format($fecha2, 'Y-m-d');


                        $_SESSION["carteraData"] = $cartera;
                        $_SESSION["empresaData"] = $empresa;
                        $_SESSION["fechaData"] = $fecha_ingreso;

            
                        $sqlInsert .=
                            "(null,'" . $id_local . "','" . $documento . "', '" . $telefono . "', '" . $localidad . "', '" . $sin_15 . "', '" . $reemplazar . "', '" . $longitud . "', '" . $modalidad . "', '" . $operador . "', '" . $empresa . "', '" . $cartera . "', '" . $fechaFinalAGuardar . "') ";
                            
                        $block++;
                        
                       

                        if ($block >= $qtyToInsert) {
                            $execute = mysqli_query($connection, $sqlInsert);
                            // echo $sqlInsert;

                            $insertNumber++;
                            // reinicias block 
                            $block = 0;
                            // reinicias sentencia sql
                            $sqlInsert = "INSERT INTO normalizacion_limpiar_validados (id,id_local,documento,telefono,localidad,sin_15,reemplazar,longitud,modalidad,operador,empresa,cartera,fecha_ingresado) VALUES ";
                        }
                        

                        // esto solo es el total de todos 
                        $totals++;
                    }
                
                    // al salir si hay cosas pendientes ejecutas la ultima - no lo olvides
                    if ($block > 0) {
                        $execute = mysqli_query($connection, $sqlInsert);
                        //echo $sqlInsert;
                        $insertNumber++;
                    }

                    if ($execute) {

                        $_SESSION["importado"] = "importadoLimpiarValidados";
                        $_SESSION["cantidad"] = $entries -1;

                        header("Location: ../../views/admin/normalizacion_limpiar_validados.php");
                    } else {

                        $_SESSION["importado"] = "error";
                       
                        header("Location: ../../views/admin/normalizacion_limpiar_validados.php");
                    }

                
                }else {
                    $_SESSION["estructura"] = 'failedLimpiarValidados';
                    header("Location: ../../views/admin/normalizacion_limpiar_validados.php");

                  }
                
                  $cabecera++;
                } else {

                    $_SESSION["importado"] = "error";
                }
              }
            }
        }
     } else {
            $_SESSION["formato"] = 'failedLimpiarValidados';
            header("Location: ../../views/admin/normalizacion_limpiar_validados.php");
            
        }
    
}


function importarDataBase($connection){
  
    
     //conexiones, conexiones everywhere
        // ini_set('display_errors', 1);
        // error_reporting(E_ALL);
        // mysqli_report(MYSQLI_REPORT_ERROR);
        $row = 1;

        //Aquí es donde seleccionamos nuestro csv
        $fname = $_FILES['dataImportarBase']['name'];
        echo 'Cargando nombre del archivo: ' . $fname . ' <br>';
        $chk_ext = explode(".", $fname);


        if (strtolower(end($chk_ext)) == "csv") {
            //si es correcto, entonces damos permisos de lectura para subir
            $filename = $_FILES['dataImportarBase']['tmp_name'];


            $handle = fopen($filename, "r");
            // la cantidad del bloque *- prueba con un archivo de 50 lineas y prueba colocando 10 a ver si todo va como quieres. 

            $qtyToInsert = 1500;
            $totals = 0;
            // block lo uso para contar cuantos tengo en el bloque actual 
            $block = 0;
            $sqlInsert = "INSERT INTO express (id_servidor,id_local,cod_empresa,tipo,empresa,equipo,tarjeta,terminal,serie,serie_base,idd,id_orden,id_actividad,identificacion,nombre_cliente,direccion,localidad,codigo_postal,provincia,fecha_creacion,telefono1,telefono2,telefono_fijo1,telefono_fijo2,telefono_fijo3,telefono_fijo4,telefono_fijo5,telefono_fijo6,fecha_de_envio,cartera,baja,id_recolector,id_fecha_recolector,remito_rend,remito_cv,fecha_rend_cv,id_operador_ren,id_motivo_ren,master_box,id_operador,fecha,id_motivo,tabla_oper,multiples,cable_hdmi,cable_av,fuente,control_1,email_enviado,otros,remito_sub,fecha_remito_sub,fecha_asignado,sub_asignado,ciclo,zona,fecha_premio,mes_base,r1,r2,r3,operador,tipo_de_recupero,semanas,ano_semana,fecha_de_liquidacion,hist_pactados,latitude,longitude,emailcliente,data,fecha_ingreso) VALUES ";

            $insertNumber = 0;
            $entries = 0;

            $cabecera = 0;

            while (($cabeza = fgetcsv($handle, 9999, ";")) !== FALSE) {

                if ($cabecera == 0) {
                
                    
                

                            if ($cabeza[0] === 'id_local' && $cabeza[1] === 'cod_empresa' && $cabeza[2] === 'tipo' && $cabeza[3] === 'empresa' && $cabeza[4] === 'equipo' && $cabeza[5] === 'tarjeta' && $cabeza[6] === 'terminal' && $cabeza[7] === 'serie' && $cabeza[8] === 'serie_base' && $cabeza[9] === 'idd' && $cabeza[10] === 'id_orden' && $cabeza[11] === 'id_actividad' && $cabeza[12] === 'identificacion' && $cabeza[13] === 'nombre_cliente' && $cabeza[14] === 'direccion' && $cabeza[15] === 'localidad' && $cabeza[16] === 'codigo_postal' && $cabeza[17] === 'provincia' && $cabeza[18] === 'fecha_creacion' && $cabeza[19] === 'telefono1' && $cabeza[20] === 'telefono2' && $cabeza[21] === 'telefono_fijo1' && $cabeza[22] === 'telefono_fijo2' && $cabeza[23] === 'telefono_fijo3' && $cabeza[24] === 'telefono_fijo4' && $cabeza[25] === 'telefono_fijo5' && $cabeza[26] === 'telefono_fijo6' && $cabeza[27] === 'fecha_de_envio' && $cabeza[28] === 'cartera' && $cabeza[29] === 'baja' && $cabeza[30] === 'id_recolector' && $cabeza[31] === 'id_fecha_recolector' && $cabeza[32] === 'remito_rend' && $cabeza[33] === 'remito_cv' && $cabeza[34] === 'fecha_rend_cv' && $cabeza[35] === 'id_operador_ren' && $cabeza[36] === 'id_motivo_ren' && $cabeza[37] === 'master_box' && $cabeza[38] === 'id_operador' && $cabeza[39] === 'fecha' && $cabeza[40] === 'id_motivo' && $cabeza[41] === 'tabla_oper' && $cabeza[42] === 'multiples' && $cabeza[43] === 'cable_hdmi' && $cabeza[44] === 'cable_av' && $cabeza[45] === 'fuente' && $cabeza[46] === 'control_1' && $cabeza[47] === 'email_enviado' && $cabeza[48] === 'otros' && $cabeza[49] === 'remito_sub' && $cabeza[50] === 'fecha_remito_sub' && $cabeza[51] === 'fecha_asignado' && $cabeza[52] === 'sub_asignado' && $cabeza[53] === 'ciclo' && $cabeza[54] === 'zona' && $cabeza[55] === 'fecha_premio' && $cabeza[56] === 'mes_base' && $cabeza[57] === 'r1' && $cabeza[58] === 'r2' && $cabeza[59] === 'r3' && $cabeza[60] === 'operador' && $cabeza[61] === 'tipo_de_recupero' && $cabeza[62] === 'semanas' && $cabeza[63] === 'ano_semana' && $cabeza[64] === 'fecha_de_liquidacion' && $cabeza[65] === 'hist_pactados' && $cabeza[66] === 'latitude' && $cabeza[67] === 'longitude' && $cabeza[68] === 'emailcliente') {

                                

                        while (($entrie = fgetcsv($handle, 9999, ";")) !== FALSE) {

                        

                            //echo json_encode($entrie)."<br><br>";                   
                            $entries++;
                            // si no es la primera recuerda agregar una coma
                            if ($block != 0) {
                                $sqlInsert .= ',';
                            }
                            //agregas nueva linea


                            $id_local = (!empty($entrie[0])) ? $entrie[0] : '';
                            $cod_empresa = (!empty($entrie[1])) ? $entrie[1] : '';
                            $tipo = (!empty($entrie[2])) ? $entrie[2] : '';
                            $empresa = (!empty($entrie[3])) ? $entrie[3] : '';
                            $equipo = (!empty($entrie[4])) ? $entrie[4] : '';
                            $tarjeta = (!empty($entrie[5])) ? $entrie[5] : '';
                            $terminal = (!empty($entrie[6])) ? $entrie[6] : '';
                            $serie = (!empty($entrie[7])) ? $entrie[7] : '';
                            $serie_base = (!empty($entrie[8])) ? $entrie[8] : '';
                            $idd = (!empty($entrie[9])) ? $entrie[9] : '';
                            $id_orden = (!empty($entrie[10])) ? $entrie[10] : '';
                            $id_actividad = (!empty($entrie[11])) ? $entrie[11] : '';
                            $identificacion = (!empty($entrie[12])) ? $entrie[12] : '';
                            $nombre_cliente = (!empty($entrie[13])) ? $entrie[13] : '';
                            $direccion = (!empty($entrie[14])) ? $entrie[14] : '';
                            $localidad = (!empty($entrie[15])) ? $entrie[15] : '';
                            $codigo_postal = (!empty($entrie[16])) ? $entrie[16] : '';
                            $provincia = (!empty($entrie[17])) ? $entrie[17] : '';
                            $fecha_creacion = (!empty($entrie[18])) ? $entrie[18] : '';
                            $telefono1 = (!empty($entrie[19])) ? $entrie[19] : '';
                            $telefono2 = (!empty($entrie[20])) ? $entrie[20] : '';
                            $telefono_fijo1 = (!empty($entrie[21])) ? $entrie[21] : '';
                            $telefono_fijo2 = (!empty($entrie[22])) ? $entrie[22] : '';
                            $telefono_fijo3 = (!empty($entrie[23])) ? $entrie[23] : '';
                            $telefono_fijo4 = (!empty($entrie[24])) ? $entrie[24] : '';
                            $telefono_fijo5 = (!empty($entrie[25])) ? $entrie[25] : '';
                            $telefono_fijo6 = (!empty($entrie[26])) ? $entrie[26] : '';
                            $fecha_de_envio = (!empty($entrie[27])) ? $entrie[27] : '';
                            $cartera = (!empty($entrie[28])) ? $entrie[28] : '';
                            $baja = (!empty($entrie[29])) ? $entrie[29] : '';
                            $id_recolector = (!empty($entrie[30])) ? $entrie[30] : '';
                            $id_fecha_recolector = (!empty($entrie[31])) ? $entrie[31] : '';
                            $remito_rend = (!empty($entrie[32])) ? $entrie[32] : '';
                            $remito_cv = (!empty($entrie[33])) ? $entrie[33] : '';
                            $fecha_rend_cv = (!empty($entrie[34])) ? $entrie[34] : '';
                            $id_operador_ren = (!empty($entrie[35])) ? $entrie[35] : '';
                            $id_motivo_ren = (!empty($entrie[36])) ? $entrie[36] : '';
                            $master_box = (!empty($entrie[37])) ? $entrie[37] : '';
                            $id_operador = (!empty($entrie[38])) ? $entrie[38] : '';
                            $fecha = (!empty($entrie[39])) ? $entrie[39] : '';
                            $id_motivo = (!empty($entrie[40])) ? $entrie[40] : '';
                            $tabla_oper = (!empty($entrie[41])) ? $entrie[41] : '';
                            $multiples = (!empty($entrie[42])) ? $entrie[42] : '';
                            $cable_hdmi = (!empty($entrie[43])) ? $entrie[43] : '';
                            $cable_av = (!empty($entrie[44])) ? $entrie[44] : '';
                            $fuente = (!empty($entrie[45])) ? $entrie[45] : '';
                            $control_1 = (!empty($entrie[46])) ? $entrie[46] : '';
                            $email_enviado = (!empty($entrie[47])) ? $entrie[47] : '';
                            $otros = (!empty($entrie[48])) ? $entrie[48] : '';
                            $remito_sub = (!empty($entrie[49])) ? $entrie[49] : '';
                            $fecha_remito_sub = (!empty($entrie[50])) ? $entrie[50] : '';
                            $fecha_asignado = (!empty($entrie[51])) ? $entrie[51] : '';
                            $sub_asignado = (!empty($entrie[52])) ? $entrie[52] : '';
                            $ciclo = (!empty($entrie[53])) ? $entrie[53] : '';
                            $zona = (!empty($entrie[54])) ? $entrie[54] : '';
                            $fecha_premio = (!empty($entrie[55])) ? $entrie[55] : '';
                            $mes_base = (!empty($entrie[56])) ? $entrie[56] : '';
                            $r1 = (!empty($entrie[57])) ? $entrie[57] : '';
                            $r2 = (!empty($entrie[58])) ? $entrie[58] : '';
                            $r3 = (!empty($entrie[59])) ? $entrie[59] : '';
                            $operador = (!empty($entrie[60])) ? $entrie[60] : '';
                            $tipo_de_recupero = (!empty($entrie[61])) ? $entrie[61] : '';
                            $semanas = (!empty($entrie[62])) ? $entrie[62] : '';
                            $ano_semana = (!empty($entrie[63])) ? $entrie[63] : '';
                            $fecha_de_liquidacion = (!empty($entrie[64])) ? $entrie[64] : '';
                            $hist_pactados = (!empty($entrie[65])) ? $entrie[65] : '';
                            $latitude = (!empty($entrie[66])) ? $entrie[66] : '';
                            $longitude = (!empty($entrie[67])) ? $entrie[67] : '';
                            $emailcliente = (!empty($entrie[68])) ? $entrie[68] : '';
                            
                            
                            
                        
                            $sqlInsert .=
                                "(null,'" . cleanBase($id_local) . "','" . cleanBase($cod_empresa) . "','" . cleanBase($tipo) . "','" . cleanBase($empresa) . "','" . cleanBase($equipo) . "','" . cleanBase($tarjeta) . "','" . cleanBase($terminal) . "','" . cleanBase($serie) . "','" . cleanBase($serie_base) . "','" . cleanBase($idd) . "','" . cleanBase($id_orden) . "','" . cleanBase($id_actividad) . "','" . $identificacion . "','" . cleanBase($nombre_cliente) . "','" . cleanBase($direccion) . "','" . cleanBase($localidad) . "','" . cleanBase($codigo_postal) . "','" . cleanBase($provincia) . "','" . cleanBase($fecha_creacion) . "','" . cleanBase($telefono1) . "','" . cleanBase($telefono2) . "','" . cleanBase($telefono_fijo1) . "','" . cleanBase($telefono_fijo2) . "','" . cleanBase($telefono_fijo3) . "','" . cleanBase($telefono_fijo4) . "','" . cleanBase($telefono_fijo5) . "','" . cleanBase($telefono_fijo6) . "','" . cleanBase($fecha_de_envio) . "','" . cleanBase($cartera) . "','" . cleanBase($baja) . "','" . cleanBase($id_recolector) . "','" . cleanBase($id_fecha_recolector) . "','" . cleanBase($remito_rend) . "','" . cleanBase($remito_cv) . "','" . cleanBase($fecha_rend_cv) . "','" . cleanBase($id_operador_ren) . "','" . cleanBase($id_motivo_ren) . "','" . cleanBase($master_box) . "','" . cleanBase($id_operador) . "','" . cleanBase($fecha) . "','" . cleanBase($id_motivo) . "','" . cleanBase($tabla_oper) . "','" . cleanBase($multiples) . "','" . cleanBase($cable_hdmi) . "','" . cleanBase($cable_av) . "','" . cleanBase($fuente) . "','" . cleanBase($control_1) . "','" . cleanBase($email_enviado) . "','" . cleanBase($otros) . "','" . cleanBase($remito_sub) . "','" . cleanBase($fecha_remito_sub) . "','" . cleanBase($fecha_asignado) . "','" . cleanBase($sub_asignado) . "','" . cleanBase($ciclo) . "','" . cleanBase($zona) . "','" . cleanBase($fecha_premio) . "','" . cleanBase($mes_base) . "','" . cleanBase($r1) . "','" . cleanBase($r2) . "','" . cleanBase($r3) . "','" . cleanBase($operador) . "','" . cleanBase($tipo_de_recupero) . "','" . cleanBase($semanas) . "','" . cleanBase($ano_semana) . "','" . cleanBase($fecha_de_liquidacion) . "','" . cleanBase($hist_pactados) . "','" . cleanBase($latitude) . "','" . cleanBase($longitude) . "','" . cleanBase($emailcliente) . "',null,curdate())";

                            

                            
                            $block++;
                            if ($block >= $qtyToInsert) {
                                $execute = mysqli_query($connection, $sqlInsert);
                                // echo $sqlInsert;

                                $insertNumber++;
                                // reinicias block 
                                $block = 0;
                                // reinicias sentencia sql
                                $sqlInsert = "INSERT INTO express (id_servidor,id_local,cod_empresa,tipo,empresa,equipo,tarjeta,terminal,serie,serie_base,idd,id_orden,id_actividad,identificacion,nombre_cliente,direccion,localidad,codigo_postal,provincia,fecha_creacion,telefono1,telefono2,telefono_fijo1,telefono_fijo2,telefono_fijo3,telefono_fijo4,telefono_fijo5,telefono_fijo6,fecha_de_envio,cartera,baja,id_recolector,id_fecha_recolector,remito_rend,remito_cv,fecha_rend_cv,id_operador_ren,id_motivo_ren,master_box,id_operador,fecha,id_motivo,tabla_oper,multiples,cable_hdmi,cable_av,fuente,control_1,email_enviado,otros,remito_sub,fecha_remito_sub,fecha_asignado,sub_asignado,ciclo,zona,fecha_premio,mes_base,r1,r2,r3,operador,tipo_de_recupero,semanas,ano_semana,fecha_de_liquidacion,hist_pactados,latitude,longitude,emailcliente,data,fecha_ingreso) VALUES ";
                            }

                            // esto solo es el total de todos 
                            $totals++;
                        }

                        // al salir si hay cosas pendientes ejecutas la ultima - no lo olvides
                        if ($block > 0) {
                            $execute = mysqli_query($connection, $sqlInsert);
                            //echo $sqlInsert;
                            $insertNumber++;
                        }

                        if ($execute) {

                            $_SESSION["importado"] = "importadoBase";
                            $_SESSION["cantidad"] = $entries;

                            header("Location: ../../views/admin/ingresar_base.php");
                        } else {

                            $_SESSION["importado"] = "error";

                            echo "error :" . mysqli_error($connection);
                            header("Location: ../../views/admin/ingresar_base.php");
                        }
                    } else {

                        $_SESSION["estructura"] = 'failedBase';
                        header("Location: ../../views/admin/ingresar_base.php");
                    }
                    $cabecera++;
                }
            }

                    }
                




}


function buscarTablaLimpiador($cartera, $fecha, $empresa, $connection)
{

    $sql = "SELECT * FROM normalizacion_telefonos_limpiar where fecha_ingresado ='$fecha' and empresa= '$empresa' and cartera='$cartera';";
   
    $telefonos = mysqli_query($connection, $sql);

    $telefonoLimpio = array();
    if ($telefonos && mysqli_num_rows($telefonos) >= 1) {
        $telefonoLimpio = $telefonos;

        $_SESSION["mostrarTabla"] = 'mostrarLimpiar';
    } else {
        $_SESSION["mostrarTabla"] = 'noHayDatosLimpiar';
    }

    return $telefonoLimpio;
}

function buscarTablaOrdenar($cartera, $fecha, $empresa, $connection)
{



    $sql = "SELECT * FROM normalizacion_telefonos_dividir_ordenar where fecha_ingresado ='$fecha' and empresa= '$empresa' and cartera='$cartera';";
    $telefonos = mysqli_query($connection, $sql);




    $result = array();
    if ($telefonos && mysqli_num_rows($telefonos) >= 1) {
        $result = $telefonos;

        $_SESSION["mostrarTabla"] = 'mostrarOrdenar';
    } else {
        $_SESSION["mostrarTabla"] = 'noHayDatosOrdenar';
    }


    return $result;
}

function buscarTablaValidar($cartera, $fecha, $empresa, $connection)
{

     $sql = "SELECT n.id_local,n.documento,n.telefono,n.fecha_ingresado,n.operador,n.empresa as 'empresaImportada',n.cartera,r.sin_15, r.tipo, r.empresa as 'empresaValidar',r.modalidad,
     r.localidad,r.reemplazar_por,
     r.caracteres from normalizacion_telefonos_validar n
     left join referencia_completa r ON
     n.telefono like CONCAT('%',r.sin_15,'%') 
      WHERE n.fecha_ingresado='$fecha' AND n.cartera='$cartera' AND n.empresa= '$empresa'
      GROUP by n.id;";

    //  $sql ="SELECT * from normalizacion_telefonos_validar where fecha_ingresado='$fecha' AND cartera='$cartera' AND empresa= '$empresa'";

      $validacion = mysqli_query($connection, $sql);

    $result = array();
    if ($validacion && $validacion->num_rows > 0) {
        $result = $validacion;

        $_SESSION["mostrarTabla"] = 'mostrarValidar';
    } else {

        $_SESSION["mostrarTabla"] = 'noHayDatosFinal';
    }

    return $result;
}

function mostrarTelefonosFinal($cartera, $fecha, $empresa, $connection)
{

    $sql = "SELECT * from normalizacion_limpiar_validados where fecha_ingresado='$fecha' and empresa='$empresa' and cartera='$cartera' ORDER BY id_local;";


    $telefonosFinal = mysqli_query($connection, $sql);

    $result = array();

    if ($telefonosFinal && $telefonosFinal->num_rows > 0) {
        $result = $telefonosFinal;

        $_SESSION["mostrarTabla"] = 'importadoLimpiarValidados';
    } else {
        $_SESSION["mostrarTabla"] = 'noHayDatosTablaFinal';
    }

    return $result;
}

function mostrarBase($cartera,$fecha,$empresa,$connection){

   $sql = "SELECT * FROM express where cartera='$cartera' and empresa='$empresa' and fecha_ingreso='$fecha'";
   $datos= mysqli_query($connection,$sql);

   $result = array();
   if($datos && $datos->num_rows>0){
      $result = $datos;
 
      $_SESSION["mostrarTabla"] = 'mostrarBase';
   }else {
    $_SESSION["mostrarTabla"] = 'noHayDatosBase';
   }
   return $result;

}



function mostrarReferenciaCompleta($connection){



    $sql = "SELECT sin_15, empresa,localidad FROM referencia_completa";
        $referenciaExecute = mysqli_query($connection,$sql);
        $result = array();
        if($referenciaExecute && $referenciaExecute->num_rows>0){
            $result = $referenciaExecute;

            $_SESSION["mostrarTabla"] = 'mostrarTablaFinal';
        }
        return $result;
}




