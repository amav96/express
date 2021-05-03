<?php if (isset($_GET['normalizacion'])) {

    require_once '../model/normalizacion.php';
    require_once '../config/db.php';

    session_start();
    $accion = $_GET['normalizacion'];
    $normalizacion = new normalizacionController();
    $normalizacion->$accion();
} else {

    require_once 'model/normalizacion.php';
}

class normalizacionController{

    // public function index(){

    //      Utils::AuthAdmin();
         
    //     require_once  'views/admin/N_limpiar.php';
    // }

    public function baseGeneral(){

        Utils::AuthAdmin();
        require_once  'views/admin/N_base_original.php';
    }

    
    public function verificarBaseOriginal(){

        $fname = isset($_FILES['dataImportarBO']) ? $_FILES['dataImportarBO'] : false ;
        $fecha = isset($_POST['fechaImportadoBO']) ? $_POST['fechaImportadoBO'] : false ;
        $operador = isset($_POST['operadorBO']) ? $_POST['operadorBO'] : false ;

        if($fname && $fecha && $operador){

            $fname = $_FILES['dataImportarBO']['name'];
            echo 'Cargando nombre del archivo: ' . $fname . ' <br>';
            $chk_ext = explode(".", $fname);
            $count = 0;
            $verificar="";
            if (strtolower(end($chk_ext)) == "csv") {
                 
                $filename = $_FILES['dataImportarBO']['tmp_name'];
                $handle = fopen($filename, "r");
                while (($cabeza = fgetcsv($handle, 9999, ";")) !== FALSE) {

                    if($count === 0){

                    
                     if ($cabeza[0] === 'id_local' && $cabeza[1] === 'cod_empresa' && $cabeza[2] === 'tipo' && $cabeza[3] === 'empresa' && $cabeza[4] === 'equipo' && $cabeza[5] === 'tarjeta' && $cabeza[6] === 'terminal' && $cabeza[7] === 'serie' && $cabeza[8] === 'serie_base' && $cabeza[9] === 'idd' && $cabeza[10] === 'id_orden' && $cabeza[11] === 'id_actividad' && $cabeza[12] === 'identificacion' && $cabeza[13] === 'nombre_cliente' && $cabeza[14] === 'direccion' && $cabeza[15] === 'localidad' && $cabeza[16] === 'codigo_postal' && $cabeza[17] === 'provincia' && $cabeza[18] === 'fecha_creacion' && $cabeza[19] === 'telefono1' && $cabeza[20] === 'telefono2' && $cabeza[21] === 'telefono_fijo1' && $cabeza[22] === 'telefono_fijo2' && $cabeza[23] === 'telefono_fijo3' && $cabeza[24] === 'telefono_fijo4' && $cabeza[25] === 'telefono_fijo5' && $cabeza[26] === 'telefono_fijo6' && $cabeza[27] === 'fecha_de_envio' && $cabeza[28] === 'cartera' && $cabeza[29] === 'baja' && $cabeza[30] === 'emailcliente') {
                       
                         $verificar = true;
                        
                     }else{
                      $verificar = false;
                     }
                    }



                   $count ++;
                }
                
               if(!$verificar){
                   echo "error de encabezado";
               }else{
                
                $_SESSION["mostrarTabla"] = 'success';
                require_once 'views/admin/N_base_original.php';

                
               }
            }else{
                echo "formato incorrecto";
            }

           
        }

        
    }


    public function importarBaseOriginal(){

        $fname = isset($_FILES['dataImportarBO']) ? $_FILES['dataImportarBO'] : false ;
        $fecha = isset($_POST['fechaImportadoBO']) ? $_POST['fechaImportadoBO'] : false ;
        $operador = isset($_POST['operadorBO']) ? $_POST['operadorBO'] : false ;

        if($fname && $fecha && $operador){

            $fname = $_FILES['dataImportarBO']['name'];
            $chk_ext = explode(".", $fname);
            $count = 0;
            $verificar="";
            if (strtolower(end($chk_ext)) == "csv") {
                 
                $filename = $_FILES['dataImportarBO']['tmp_name'];
                $handle = fopen($filename, "r");
                while (($cabeza = fgetcsv($handle, 9999, ";")) !== FALSE) {

                    if($count === 0){


                     if (trim($cabeza[0] )=== 'id_local' && trim($cabeza[1] )=== 'cod_empresa' && trim($cabeza[2] )=== 'tipo' && trim($cabeza[3] )=== 'empresa' && trim($cabeza[4] )=== 'equipo' && trim($cabeza[5] )=== 'tarjeta' && trim($cabeza[6] )=== 'terminal' && trim($cabeza[7] )=== 'serie' && trim($cabeza[8] )=== 'serie_base' && trim($cabeza[9] )=== 'idd' && trim($cabeza[10]) === 'id_orden' && trim($cabeza[11]) === 'id_actividad' && trim($cabeza[12]) === 'identificacion' && trim($cabeza[13]) === 'nombre_cliente' && trim($cabeza[14]) === 'direccion' && trim($cabeza[15]) === 'localidad' && trim($cabeza[16]) === 'codigo_postal' && trim($cabeza[17]) === 'provincia' && trim($cabeza[18]) === 'fecha_creacion' && trim($cabeza[19]) === 'telefono1' && trim($cabeza[20]) === 'telefono2' && trim($cabeza[21]) === 'telefono_fijo1' && trim($cabeza[22]) === 'telefono_fijo2' && trim($cabeza[23]) === 'telefono_fijo3' && trim($cabeza[24]) === 'telefono_fijo4' && trim($cabeza[25]) === 'telefono_fijo5' && trim($cabeza[26]) === 'telefono_fijo6' && trim($cabeza[27]) === 'fecha_de_envio' && trim($cabeza[28]) === 'cartera' && trim($cabeza[29]) === 'baja' && trim($cabeza[30]) === 'emailcliente') {
                      
                         $verificar = true;

                        
                     }else{
                        
                      $verificar = false;
                     }
                    }
                    if ($count === 1){
                        $_SESSION["dataImport"] =  array(
                             'cartera' => trim($cabeza[28]),
                              'fecha' => $fecha,
                        );
                    }

                   $count ++;
                }
                
               if(!$verificar){
                $_SESSION["errorUp"] = 'header';
                header("Location:".base_url.'normalizacion/baseGeneral');
               }else{

                $importarBaseOriginal = new normalizacion();
                $importarBaseOriginal->setFecha_ingresado($fecha);
                $importarBaseOriginal->setOperador($operador);

                $importarBaseOriginal = $importarBaseOriginal->importarBaseOriginal();
                if($importarBaseOriginal){

                   $cartera = $_SESSION["dataImport"]["cartera"];
                   $fechaData = $_SESSION["dataImport"]["fecha"];

                    $_SESSION["importar"] = 'importado';
                    header("Location:".base_url.'normalizacion/showImport&cr='.$cartera.'&fe='.$fechaData);
                    
                }else{
                    $_SESSION["errorUp"] = 'noInsert';
                    header("Location:".base_url.'normalizacion/baseGeneral');
                }
               }
            }else{
                $_SESSION["errorUp"] = 'formato';
                header("Location:".base_url.'normalizacion/baseGeneral');
            }   
        }

       
    }

    public function showImport(){

        $cartera = isset($_GET['cr']) ? $_GET['cr'] : false ;
        $fecha = isset($_GET['fe']) ? $_GET['fe'] : false ;

        if($cartera && $fecha){

            $showImport = new normalizacion();
            $showImport->setCartera($cartera);
            $showImport->setFecha_ingresado($fecha);
            $showImport = $showImport->showImport();

            if(is_object($showImport)){

                require_once  'views/admin/N_base_original.php';

            }else{
                $_SESSION["dataExist"] = 'noExist';
                header("Location:".base_url.'normalizacion/baseGeneral');
            }

        }

         require_once  'views/admin/N_base_original.php';

    }

    public function limpiarIngreso(){
        
        $fname = isset($_FILES['dataImportar']) ? $_FILES['dataImportar'] : false ;
        $fecha = isset($_POST['fechaImportadoLimpiar']) ? $_POST['fechaImportadoLimpiar'] : false ;
        $operador = isset($_POST['operadorLimpiar']) ? $_POST['operadorLimpiar'] : false ;
        $empresa = isset($_POST['empresaLimpiar']) ? $_POST['empresaLimpiar'] : false ;
        $cartera = isset($_POST['carteralimpiar']) ? $_POST['carteralimpiar'] : false ;
      
        if($fname && $fecha && $operador && $empresa && $cartera ){

            $fname = $_FILES['dataImportar']['name'];
            echo 'Cargando nombre del archivo: ' . $fname . ' <br>';
            $chk_ext = explode(".", $fname);
            $count = 0;
            $verificar="";
            if (strtolower(end($chk_ext)) == "csv") {
                 
                $filename = $_FILES['dataImportar']['tmp_name'];
                $handle = fopen($filename, "r");
                while (($cabeza = fgetcsv($handle, 9999, ";")) !== FALSE) {
                   if($count === 0){
                    if ($cabeza[0] === 'id_local' && $cabeza[1] === 'codigo_postal' && $cabeza[2] === 'documento' && $cabeza[3] === 'telefono1' && $cabeza[4] === 'telefono2' && $cabeza[5] === 'telefono3' && $cabeza[6] === 'telefono4') {
                       
                        $verificar = true;
                    }else{
                     $verificar = false;
                    }
                   }
                   $count ++;
                }
                
               if(!$verificar){
                   echo "error de encabezado";
               }else{

                $limpiarIngreso = new normalizacion();
                $limpiarIngreso->setFecha_ingresado($fecha);
                $limpiarIngreso->setOperador($operador);
                $limpiarIngreso->setEmpresa($empresa);
                $limpiarIngreso->setCartera($cartera);
                $limpiarIngreso = $limpiarIngreso->limpiarIngreso();

                if($limpiarIngreso){
                    echo '<pre>';
                    print_r($_SESSION["insert"]);
                    echo '</pre>';
                    unset($_SESSION["insert"]);
                    
                }else{
                    echo "problema al insertar";
                }
               }
            }else{
                echo "formato incorrecto";
            }

           
        }

         
       
        

    
    }

    public function validateKey(){
       if($_POST){

        $key = isset($_POST['object']['key']) ? $_POST['object']['key'] : false ;

        $validateKey = new normalizacion();
        $validateKey->setKey($key);
        $validateKey =$validateKey->validateKey();

        if($validateKey){
            $objeto= array(
                'result' => '1'
            );

        }else{
            $objeto= array(
                'result' => '2'
            );
        }

        $jsonstring = json_encode($objeto);
        echo $jsonstring;

       }
        
    }

    

   

}