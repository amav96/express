<?php 

session_start();
require_once '../../config/db.php';
require_once '../../model/admin/M_normalizacion.php';



if(isset($_REQUEST["botonImportar"])){

    $fecha = $_POST["fechaImportadoLimpiar"];
    $operador = trim($_POST["operadorLimpiar"]);
    $empresa = $_POST["empresaLimpiar"];
    $cartera = $_POST["carteralimpiar"];

    $_SESSION["carteraData"] = $cartera;
    $_SESSION["empresaData"] = $empresa;
    $_SESSION["fechaData"] = $fecha;
    
    importarDataLimpiar($cartera,$empresa,$fecha,$operador,$connection);
}

if(isset($_REQUEST["botonImportar_Ordenar"])){

    $fecha = $_POST["fechaImportadoOrdenar"];
    $operador = trim($_POST["operadorOrdenar"]);
    $empresa = $_POST["empresaOrdenar"];
    $cartera = $_POST["carteraOrdenar"];

    $_SESSION["carteraData"] = $cartera;
    $_SESSION["empresaData"] = $empresa;
    $_SESSION["fechaData"] = $fecha;

    importarDataParaOrdenar($cartera,$empresa,$fecha,$operador,$connection);
}

if(isset($_REQUEST["botonImportarValidar"])){
   

    $fecha = $_POST["fechaImportadoValidar"];
    $operador = trim($_POST["operadorValidar"]);
    $empresa = $_POST["empresaValidar"];
    $cartera = $_POST["carteraValidar"];

    $_SESSION["carteraData"] = $cartera;
    $_SESSION["empresaData"] = $empresa;
    $_SESSION["fechaData"] = $fecha;

    
    importarDataParaValidar($cartera,$empresa,$fecha,$operador,$connection);
}

if(isset($_REQUEST["botonImportar_Base"])){
   
   

    importarDataBase($connection);

    
}




if(isset($_REQUEST["botonImportar_LimpiarValidados"])){
   
 
    importarDataParaLimpiarValidados($connection);
}





if(isset($_GET["action"])){

        if($_GET["action"] ==="mostrarEmpresas"){

        mostrarEmpresas($connection);

        }

        if($_GET["action"] === 'buscarTablaLimpiador'){
            
            

                 $fecha = isset($_POST["fechaBuscarLimpiador"]) ? $_POST["fechaBuscarLimpiador"] : false;
                 $empresa = isset($_POST["empresaBuscarLimpiador"]) ? $_POST["empresaBuscarLimpiador"] : false;
                 $cartera = isset($_POST["carteraBuscarLimpiador"]) ? $_POST["carteraBuscarLimpiador"] : false;
 
                 if($fecha && $empresa){

                   buscarTablaLimpiador($cartera,$fecha,$empresa,$connection);
                         
                    $_SESSION["fechaLimpiar"] = $fecha;
                    $_SESSION["empresaLimpiar"] = $empresa;
                    $_SESSION["carteraLimpiar"] = $cartera;
                   

                 }else {

                     $_SESSION["mostrarTabla"] = 'error';
                 }

                 header("Location: ../../views/admin/normalizacion_limpiar_telefonos.php");

        }

        if($_GET["action"] === 'buscarTablaOrdenar'){
                
                

                $fecha = isset($_POST["fechaBuscarOrdenador"]) ? $_POST["fechaBuscarOrdenador"] : false;
                $empresa = isset($_POST["empresaBuscarOrdenador"]) ? $_POST["empresaBuscarOrdenador"] : false;
                $cartera = isset($_POST["carteraBuscarOrdenador"]) ? $_POST["carteraBuscarOrdenador"] : false;

                    if($fecha && $empresa && $cartera){

                        buscarTablaOrdenar($cartera,$fecha,$empresa,$connection);

                        $_SESSION["fechaOrdenar"] = $fecha;
                        $_SESSION["empresaOrdenar"] = $empresa;
                        $_SESSION["carteraOrdenar"] = $cartera;
                        
                        $_SESSION["importado"] = "borrarMensaje";

                    }else {

                        $_SESSION["mostrarTabla"] = 'error';
                    }
                    

                    header("Location: ../../views/admin/normalizacion_juntar_telefonos_clientes.php");

        }

        if($_GET["action"] === 'buscarTablaValidar'){
                
                

            $fecha = isset($_POST["fechaBuscarValidar"]) ? $_POST["fechaBuscarValidar"] : false;
            $empresa = isset($_POST["empresaBuscarValidar"]) ? $_POST["empresaBuscarValidar"] : false;
            $cartera = isset($_POST["carteraBuscarValidar"]) ? $_POST["carteraBuscarValidar"] : false;

                if($fecha && $empresa && $cartera){

                        $_SESSION["fechaValidar"] = $fecha;
                        $_SESSION["empresaValidar"] = $empresa;
                        $_SESSION["carteraValidar"] = $cartera;

                    //    mostrarReferenciaCompleta($connection);
                       buscarTablaValidar($cartera, $fecha, $empresa, $connection);

                        
                    $_SESSION["importado"] = "borrarMensaje";

                } else {

                    $_SESSION["mostrarTabla"] = 'error';
                }
                
                header("Location: ../../views/admin/normalizacion_validar_telefonos.php");

        }

        if($_GET["action"] === 'mostrarTablaFinal') {


            $fecha = isset($_POST["fechaBuscarTablaFinal"]) ? $_POST["fechaBuscarTablaFinal"] : false;
            $empresa = isset($_POST["empresaBuscarFinal"]) ? $_POST["empresaBuscarFinal"] : false;
            $cartera = isset($_POST["carteraBuscarFinal"]) ? $_POST["carteraBuscarFinal"] : false;
            $accion = isset($_POST["accionARealizar"]) ? $_POST["accionARealizar"] : false;


                if($fecha && $empresa && $cartera && $accion){

                    if($accion === 'final'){

                        $_SESSION["accionTabla"] = 'final';
                    }
                    if($accion === 'evaluar'){
                        $_SESSION["accionTabla"] = 'evaluar';
                    }
                    if($accion === 'invalidos'){
                        $_SESSION["accionTabla"] = 'invalidos';
                    }

                        $_SESSION["fechaFinal"] = $fecha;
                        $_SESSION["empresaFinal"] = $empresa;
                        $_SESSION["carteraFinal"] = $cartera;

                    mostrarTelefonosFinal($cartera,$fecha,$empresa,$connection);


                    $_SESSION["importado"] = "borrarMensaje";

                } else {

                    $_SESSION["mostrarTabla"] = 'error';
            }

            header("Location: ../../views/admin/normalizacion_limpiar_validados.php");  
        }

        if($_GET["action"] === 'buscarTablaBase') {

           

            $fecha = isset($_POST["fechaBuscarBase"]) ? $_POST["fechaBuscarBase"] : false;
            $empresa = isset($_POST["empresaBuscarBase"]) ? $_POST["empresaBuscarBase"] : false;
            $cartera = isset($_POST["carteraBuscarBase"]) ? $_POST["carteraBuscarBase"] : false;
        
                if($fecha && $empresa && $cartera){

                        $_SESSION["fechaBase"] = $fecha;
                        $_SESSION["empresaBase"] = $empresa;
                        $_SESSION["carteraBase"] = $cartera;


                    mostrarBase($cartera,$fecha,$empresa,$connection);


                    $_SESSION["importado"] = "borrarMensaje";

                } else {

                    $_SESSION["mostrarTabla"] = 'error';
            }

            header("Location: ../../views/admin/ingresar_base.php");  
        }

       

    
}


