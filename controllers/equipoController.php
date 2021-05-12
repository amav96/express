<?php
if (isset($_GET['equipo'])) {
    session_start();
    require_once '../model/equipos.php';
    require_once '../config/db.php';
    require_once "../vendor/autoload.php";

    $accion = $_GET['equipo'];
    $usuario = new equipoController();
    $usuario->$accion();
} else {

    require_once 'model/equipos.php';
    require_once "vendor/autoload.php";
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class equipoController
{


    public function collector()
    {
        
         Utils::AuthCollector();
         $info = $this->detect();
         require_once 'views/equipos/panel_recolector.php';
    }


    public function credencial(){

         Utils::AuthCollector();
         $info = $this->detect();
         require_once 'views/equipos/credencial.php';
    }

    public function transaccion()
    {
        if ($_POST) {
            $id_recolector = $_POST['id_recolector'];
            $fechaMomento = $_POST['fechaMomento'];

            $transaccion = new Equipos();
            $transaccion->setId_recolector($id_recolector);
            $transaccion->setFecha_momento($fechaMomento);
            $transaccion = $transaccion->setTransaccion();

            if (is_object($transaccion)) {
                $ordenHash = md5($transaccion->id);

                $objeto = array(
                    'result' => '1',
                    'ordenInt' => $transaccion->id,
                    'ordenHash' => $ordenHash,
                    'created_at' => $transaccion->created_at,
                    'id_recolector' => $transaccion->id_user,
                );
            } else {
                $objeto = array(
                    'result' => '2',
                );
            }

            $jsonstring = json_encode($objeto);
            echo  $jsonstring;
        }
    }

    public function ver()
    {
        if ($_POST) {

            if (!empty($_POST["datoIngresadoABuscar"])) {

                if (!preg_match("/^[-a-zA-Z0-9.]+$/", $_POST["datoIngresadoABuscar"])) {
                    $objeto[] = array(
                        'result' => false,
                    );
                } else {

                    $dataSearch = $_POST["datoIngresadoABuscar"];

                    $ver = new Equipos();
                    $ver->setIdentificacionCliente($dataSearch);

                    $ver = $ver->getAllEquipos();

                    if (is_object($ver)) {

                        if ($ver->num_rows > 0) {

                            while ($equipos = $ver->fetch_object()) {

                            
                                $objeto[] = array(
                                    'result' => true,
                                    'id' => $equipos->id,
                                    'identificacion' => $equipos->eidentificacion,
                                    'terminal' => $equipos->terminal,
                                    'tarjeta' => $equipos->etarjeta,
                                    'serie' => $equipos->eserie,
                                    'seriebase' => $equipos->serie_base,
                                    'idd' => $equipos->idd,
                                    'nombreCli' => $equipos->enombre,
                                    'direccion' => $equipos->edireccion,
                                    'localidad' => $equipos->elocalidad,
                                    'provincia' => $equipos->eprovincia,
                                    'cp' => $equipos->ecodigo_postal,
                                    'estadoEquipo' => $equipos->estado,
                                    'telefono' => $equipos->telefono,
                                    'empresa' => $equipos->empresa,
                                    'telefono_cel4' => $this->clean($equipos->telefono_cel4),
                                    'telefono_cel5' =>  $this->clean($equipos->telefono_cel5),
                                    'telefono_cel6' =>  $this->clean($equipos->telefono_cel6),
                                    'emailcliente' => $equipos->emailcliente
                                    
                                );
                            }
                        } else {

                            $objeto[] = array(
                                'result' => false,
                            );
                        }

                        $jsonstring = json_encode($objeto);
                        echo $jsonstring;
                    } else {

                        $objeto[] = array(
                            'result' => false,
                        );
                        $jsonstring = json_encode($objeto);
                        echo $jsonstring;
                    }
                }
            }
        }else{
            echo "Error POST 516(?#4F´{F,GFÑHDFS´LKMM";
        }
    }

    public function clean($str)
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

    public function recuperar()
    {

        if ($_POST) {

            $data = $_POST["sendData"];


            if (is_array($data)) {

                $count = count($data);
                $resultado =  false;
                for ($i = 0; $i < $count; $i++) {


                    $estado =  $data[$i]["estado"];
                    $motivoRetiro =  $data[$i]["motivoRetiro"];
                    $accesorioUnoLS =  $data[$i]["accesorioUnoLS"];
                    $accesorioDosLS =  $data[$i]["accesorioDosLS"];
                    $accesorioTresLS =  $data[$i]["accesorioTresLS"];
                    $accesorioCuatroLS =  $data[$i]["accesorioCuatroLS"];
                    $accesorios =  $data[$i]["accesorios"];
                    $id =  $data[$i]["id"];
                    $terminal =  $data[$i]["terminal"];
                    $identificacion =  strtoupper($data[$i]["identificacion"]);
                    $serie =  $data[$i]["serie"];
                    $serie_base =  $data[$i]["serie_base"];
                    $chipAlternativo =  $data[$i]["chipAlternativo"];
                    $tarjeta =  $data[$i]["tarjeta"];
                    $codHash =  $data[$i]["codHash"];
                    $codOrden =  $data[$i]["codOrden"];
                    $codUser =  $data[$i]["codUser"];
                    $dateTime =  $data[$i]["dateTime"];
                    $lat =  $data[$i]["lat"];
                    $lng =  $data[$i]["lng"];

                    $recuperar = new Equipos();

                    $recuperar->setEstado($estado);
                    $recuperar->setMotivoRetiro($motivoRetiro);
                    $recuperar->setAccesorioUno($accesorioUnoLS);
                    $recuperar->setAccesorioDos($accesorioDosLS);
                    $recuperar->setAccesorioTres($accesorioTresLS);
                    $recuperar->setAccesorioCuatro($accesorioCuatroLS);
                    $recuperar->setAccesorios($accesorios);
                    $recuperar->setGuiaEquipo($id);
                    $recuperar->setTerminal($terminal);
                    $recuperar->setIdentificacionCliente($identificacion);
                    $recuperar->setSerie($serie);
                    $recuperar->setSerie_base($serie_base);
                    $recuperar->setChip_alternativo($chipAlternativo);
                    $recuperar->setTarjeta($tarjeta);
                    $recuperar->setOrdenHash($codHash);
                    $recuperar->setOrden($codOrden);
                    $recuperar->setId_recolector($codUser);
                    $recuperar->setFecha_momento($dateTime);
                    $recuperar->setLat($lat);
                    $recuperar->setLng($lng);
                    $resultado = $recuperar->setTransito();
                }


                if ($resultado) {
                    echo '1';
                } else {
                    echo '2';
                }
            } else {
                echo "3";
            }
        }
    }

    public function validar()
    {

        if ($_POST) {
            
            $campo  = $_POST["campo"];

            if($campo === '1'){
                $buscar = $_POST["EnviarParaValidar"];
                $validar = new Equipos();
                $validar->setSerie($buscar);
                $validar = $validar->gettersSerieTerminal();

            }else if($campo === '2'){

                $buscar = $_POST["EnviarParaValidar"];
                $validar = new Equipos();
                $validar->setTerminal($buscar);
                $validar = $validar->gettersSerieTerminal();

            }

            
            if ($validar) {

                $objeto[] = array(
                    'result' => 1,
                );
            } else {
                $objeto[] = array(
                    'result' => 2,
                );
            }

            $jsonstring = json_encode($objeto);
            echo $jsonstring;
        }
    }

    public function pais(){
       $pais = new EquiposExtra();
       $pais = $pais->getAllPais();
       
       if(is_object($pais)){
           foreach($pais as $element){

                $objeto[]= array(
                    'result' => '1',
                    'id' => $element["id"],
                    'country' => $element["country"],
                );
                  
           }

       }else{
        $objeto[]= array(
            'result' => '2',
            
        );
       }
       
       $jsonstring = json_encode($objeto);
       echo $jsonstring;

    }

    public function provincias(){

        if($_POST){

            $id_pais = isset($_POST["idPais"]) ?$_POST["idPais"] :false ;

            if($id_pais){
                $provincia = new EquiposExtra();
                $provincia->setPais($id_pais);
                $provincia = $provincia->getSomeProvincia();

            }
       if(is_object($provincia)){
           foreach($provincia as $element){

                $objeto[]= array(
                    'result' => '1',
                    'id' => $element["id"],
                    'province' => $element["province"],
                );
                  
           }

       }else{
        $objeto[]= array(
            'result' => '2',
            
        );
       }
       
       $jsonstring = json_encode($objeto);
       echo $jsonstring;


        }
        

    }

    public function localidades(){


        if($_POST){

            $id_provincia = isset($_POST["idProvincia"]) ?$_POST["idProvincia"] :false ;

            if($id_provincia){
                $localidad = new EquiposExtra();
                $localidad->setProvincia($id_provincia);
                $localidad = $localidad->getSomeLocalidad();

            }
            
       if(is_object($localidad)){
           foreach($localidad as $element){

                $objeto[]= array(
                    'result' => '1',
                    'id' => $element["id"],
                    'locate' => $element["locate"],
                    'codigo_postal' => $element["postal_code"],
                );
           }
       }else{
        $objeto[]= array(
            'result' => '2',
        );
       }
       
       $jsonstring = json_encode($objeto);
       echo $jsonstring;
        }
    }

    public function empresa()
    {

        if ($_POST) {

            

            $empresa = $_POST["pedirEmpresas"];
            $listar = new Equipos();
            $listar = $listar->getAllEmpresa();

            if (is_object($listar)) {

                while ($empresas = $listar->fetch_object()) {

                 

                    $objeto[] = array(
                        'empresa' => $empresas->empresa,
                        'id' => $empresas->id,
                    );
                }
            } else {
                $objeto[] = array(
                    'result' => false,
                );
            }
        } else {

            $objeto[] = array(
                'result' => false,
            );
        }

        $jsonstring = json_encode($objeto);
        echo $jsonstring;
    }

    public function validateExistID(){
        if($_POST){
            
            $objeto = isset($_POST["objeto"]) ?$_POST["objeto"] :false ;

            if($objeto){

                $validar = new Equipos();
                $validar->setGuiaEquipo($objeto);
               $validar = $validar->gettersValidateID();

               if($validar === 'existe'){

                echo "2";

               }if($validar === 'no-existe'){
                   
               echo "1";
               
               }
            }

        }

    }

    public function validateExistSerie(){

        if($_POST){
            
            $objeto = isset($_POST["objeto"]) ?$_POST["objeto"] :false ;

            if($objeto){
                $validar = new Equipos();
                $validar->setSerie($objeto);
               $validar = $validar->gettersValidateSerieBase();

               if($validar === 'existe'){

                echo "2";

               }if($validar === 'no-existe'){
                   
               echo "1";
               
               }
            }

        }

    }


    public function validateExisTerminal(){

        if($_POST){
            
            $objeto = isset($_POST["objeto"]) ?$_POST["objeto"] :false ;

            if($objeto){
                $validar = new Equipos();
                $validar->setTerminal($objeto);
               $validar = $validar->gettersValidateTerminalBase();

               if($validar === 'existe'){

                echo "2";

               }if($validar === 'no-existe'){
                   
               echo "1";
               
               }
            }

        }
    }

    public function addNewCustomers(){
        if($_POST){

            
              $id_local = isset($_POST["id_local_add"]) ?$_POST["id_local_add"] : false;
              $cartera_add = isset($_POST["cartera_add"]) ?$_POST["cartera_add"] : false;
              
              $identificacion_add = isset($_POST["identificacion_add"]) ?$_POST["identificacion_add"] : false;
              $empresa_add = isset($_POST["empresa_add"]) ? strtoupper($_POST["empresa_add"]) : false ;
              $provincia_add = isset($_POST["provincia_add"]) ?$_POST["provincia_add"] :false ;
              $localidad_add = isset($_POST["localidad_add"]) ?$_POST["localidad_add"] :false ;
              $domicilio_add = isset($_POST["domicilio_add"]) ?$_POST["domicilio_add"] : false;
              $codigo_postal_add = isset($_POST["codigo_postal_add"]) ?$_POST["codigo_postal_add"] :false ;
              $serie_add = isset($_POST["serie_add"]) ?$_POST["serie_add"] :true ;
              $terminal_add = isset($_POST["terminal_add"]) ?$_POST["terminal_add"] : true;
              $sim_add = isset($_POST["sim_add"]) ?$_POST["sim_add"] :true ;
              $nombre_add = isset($_POST["nombre_add"]) ?$_POST["nombre_add"] :false ;
              $email_add = isset($_POST["email_add"]) ?$_POST["email_add"] : false;
              $telefono_add = isset($_POST["telefono_add"]) ? $_POST["telefono_add"]: false;
              $id_user_add = isset($_POST["id_user_add"]) ?$_POST["id_user_add"] :false ;
              $fecha = isset($_POST["fecha"]) ?$_POST["fecha"] :false ;

              $cod_empresa = substr($empresa_add,0,2);

              $reemplazar = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','Y','Z','.'];
              $lastIdentificacion = str_replace($reemplazar,'',$identificacion_add);

              if(!empty($terminal_add)){
                $idd = $terminal_add.'@'.$lastIdentificacion;
              }else{
                $idd = $id_local.'@'.$lastIdentificacion;
        }
              
              
              if($id_local && $empresa_add && $cartera_add && $identificacion_add && $idd && $provincia_add && $localidad_add && $domicilio_add && $codigo_postal_add && $nombre_add && $email_add && $telefono_add && $id_user_add && $fecha){

        
                 $add = new EquiposExtra();
                 $add->setGuiaEquipo($id_local);
                 $add->setEmpresa($empresa_add);
                 $add->setCartera($cartera_add); 
                 $add->setCod($cod_empresa);
                 $add->setIdentificacionCliente($identificacion_add); 
                 $add->setIdd($idd); 
                 $add->setProvincia($provincia_add);
                 $add->setLocalidad($localidad_add);
                 $add->setDireccion($domicilio_add);
                 $add->setCodigoPostal($codigo_postal_add);
                 $add->setSerie($serie_add);
                 $add->setTerminal($terminal_add);
                 $add->setTarjeta($sim_add);
                 $add->setNombre($nombre_add);
                 $add->setEmail($email_add);
                 $add->setTelefonoNuevo($telefono_add);
                 $add->setId_user_update($id_user_add);
                 $add->setFecha_momento($fecha);
                 
                 $add = $add->addNewCustomersInBase();


                 if($add === 'insert'){
                      echo '1';
                 }if($add === 'noinsert'){
                     echo '2';
                 }
              }else{
                  echo '3';
              }
              
        }
    }

    public function modelo()
    {
        if ($_POST) {


            $empresa = $_POST["valor"];
            $listar = new Equipos();
            $listar->setModelo($empresa);
            $listar = $listar->getAllModelo();

            if (is_object($listar)) {

                while ($empresas = $listar->fetch_object()) {

                   
                    $objeto[] = array(
                        'modelo' => $empresas->modelo,
                        'id' => $empresas->id,
                    );
                }
            } else {
                $objeto[] = array(
                    'result' => false,
                );
            }
        } else {

            $objeto[] = array(
                'result' => false,
            );
        }

        $jsonstring = json_encode($objeto);
        echo $jsonstring;
    }

    public function cliente()
    {
        if ($_POST) {

            $nombreNuevo = $_POST["nombreNuevoINPUT"];
            $apellidoNuevo = $_POST["apellidoNuevoINPUT"];
            $documentoNuevo = $_POST["documentoNuevoINPUT"];
            $direccionNuevo = $_POST["direccionNuevoINPUT"];
            $provinciaNuevo = $_POST["provinciaNuevoINPUT"];
            $localidadNuevo = $_POST["localidadNuevoINPUT"];
            $codigoPostalNuevo = $_POST["codigoPostalNuevoINPUT"];
            $telefonoNuevo = $_POST["telefonoNuevoINPUT"];
            $emailNuevo = $_POST["emailNuevoINPUT"];
            $empresaNuevo = $_POST["empresaNuevoINPUT"];
            $terminalNuevo = $_POST["terminalNuevoINPUT"];
            $serieNuevo = $_POST["serieNuevoINPUT"];
            $modeloNuevo = $_POST["modeloNuevoINPUT"];
            $motivoNuevo = $_POST["motivoNuevoINPUT"];
            $tipoDocNuevo = $_POST["tipoDocNuevo"];
            $momento =  $_POST["fechaMomento"];
            $recolector =  $_POST["idrec"];
            $tabla = $_POST["tabla"];

            $cliente = new EquiposExtra();
            $cliente->setNombre($nombreNuevo);
            $cliente->setApellido($apellidoNuevo);
            $cliente->setIdentificacionCliente($documentoNuevo);
            $cliente->setDireccion($direccionNuevo);
            $cliente->setProvincia($provinciaNuevo);
            $cliente->setLocalidad($localidadNuevo);
            $cliente->setCodigoPostal($codigoPostalNuevo);
            $cliente->setTelefonoNuevo($telefonoNuevo);
            $cliente->setEmail($emailNuevo);
            $cliente->setEmpresa($empresaNuevo);
            $cliente->setTerminal($terminalNuevo);
            $cliente->setSerie($serieNuevo);
            $cliente->setModelo($modeloNuevo);
            $cliente->setMotivoRetiro($motivoNuevo);
            $cliente->setTipoDocNuevo($tipoDocNuevo);
            $cliente->setFecha_momento($momento);
            $cliente->setId_recolector($recolector);
            $cliente->setTabla($tabla);
            $cliente =  $cliente->addNewCostumer();

            if ($cliente) {
                $objeto[] = array(
                    'result' => true,
                );
            } else {
                $objeto[] = array(
                    'result' => false,
                );
            }

            $jsonstring = json_encode($objeto);
            echo $jsonstring;
        }
    }

    public function firma()
    {

        if ($_POST) {
            $fecha = $_POST['fecha'];
            $idOrdenAComprobar = $_POST["idfirmar"];
            $baseFromJavascript = $_POST['dataUrl'];


            $documento = $_POST["documento"];
            $aclaracion = $_POST["aclaracion"];



            $filepath = '../resources/firmas/' . $fecha . $idOrdenAComprobar . '.png';


            if (!file_exists($filepath)) {
                // no existe la firma, puedes seguir

                $firma = new Equipos();
                $firma->setFecha_momento($fecha);
                $firma->setOrden($idOrdenAComprobar);
                $firma->setImagen($baseFromJavascript);
                $firma->setIdentificacionCliente($documento);
                $firma->setAclaracion($aclaracion);
                $firma = $firma->settersFirma();

                if (!$firma) {

                    $objeto[] = array(
                        'result' => 'failInsert',
                    );
                } else {

                    $objeto[] = array(
                        'result' => true,
                    );
                }
            } else {
                // ya existe un remito con esta firma, deberas, cancelar transaccion, e iniciar nuevamente una transaccion. Gracias! 

                $objeto[] = array(
                    'result' => 'existeFirma',
                );
            }

            $jsonString = json_encode($objeto);
            echo $jsonString;
        }
    }
    public function remito()
    {
      
        if (isset($_GET["cd"]) && isset($_GET["tp"])) {
            if (!preg_match("/^[0-9A-Za-z]+$/", $_GET["cd"])) {
                echo "Error 404: KFKCWWDFDFW(EX-RE-G);";
            } else {
                $caracteres = array('-', '"', '*', '"\","\\"', '?', '¿', '=', '-');
                $cod = $_GET["cd"];
                $codClean = str_replace($caracteres, '', $cod);

                if ($_GET["tp"] === 'rmkcmmownloqwld') {

                    $remito = new Equipos();
                    $remito->setOrden($codClean);
                    $cliente = $remito->obtainCustomerDataToIssueInvoice();

                    $equipo = $remito->obtainEquipmentDataToIssueInvoice();
                    $firma = $remito->getSignatureData();

                    if ($cliente->num_rows > 0) {
                       
                        $getCliente = $cliente->fetch_object();

                        $idEmpresa = $getCliente->identificacion;
                        $antina = 'AN';
                        $lapos = 'LA';
                        $intv = 'IN';
                        $iplan = 'IP';
                        $metrotel = 'MT';
                        $cablevision = 'CV';
                        $posnet = 'PS';
                        $supercanal = 'SC';
                        $movistar = 'MV';
                        $geocom = 'GC';
                        $cadena = substr($idEmpresa, 0, 2);
                        ($cadena == $antina) ? require_once 'views/remitos/antina.php' : null;
                        ($cadena == $lapos) ? require_once 'views/remitos/lapos.php' : null;
                        ($cadena == $intv) ? require_once 'views/remitos/intv.php' : null;
                        ($cadena === $iplan) ? require_once 'views/remitos/iplan.php' : null;
                        ($cadena == $metrotel) ? require_once 'views/remitos/metrotel.php' : null;
                        ($cadena == $cablevision) ? require_once 'views/remitos/cablevision.php' : null;
                        ($cadena == $supercanal) ? require_once 'views/remitos/supercanal.php' : null;
                        ($cadena == $posnet) ? require_once 'views/remitos/posnet.php' : null;
                        ($cadena == $movistar) ? require_once 'views/remitos/movistar.php' : null;
                        ($cadena == $geocom) ? require_once 'views/remitos/geocom.php' : null;
                    } else {
                        echo "Error 505: (RE-NO-EXIST) REPORTED ;";
                    }
                }
                else if ($_GET["tp"] === 'okghvmnatrqzopo') {

                  
                    $remito = new Equipos();
                    $remito->setIdentificacionCliente($codClean);
                    $datosCliente = $remito->getDataCustomerOnConsignment();
                    $datosEquipo = $remito->getDataEquipmentOnConsignment();

                    

                    if ($datosCliente->num_rows > 0) {
                        $getCliente = $datosCliente->fetch_object();
                        require_once 'views/remitos/consignacion.php';
                    } else {

                        echo "Error 707: (CON-NO-EXIST) REPORTED ;";
                    }
                }else{
                    header("Location:".base_url.'error');
                }
            }
        }else{
            header("Location:".base_url.'error');
        }
    }

    public function clienteEnBase()
    {

        if ($_POST) {

            $search = isset($_POST["BuscarDato"]) ? $_POST["BuscarDato"] : false;

            $equipos = new Equipos();
            $equipos->setIdentificacionCliente($search);
            $equipos = $equipos->getAllCustomers();
            if (is_object($equipos)) {

                foreach ($equipos as $element) {


                    $objeto[] = array(
                        'result' => '1',
                        'identificacion' => $element["identificacion"],
                        'empresa'  => $element["empresa"],
                        'terminal' => $element["terminal"],
                        'serie' => $element["serie"],
                        'serie_base' => $element["serie_base"],
                        'tarjeta' => $element["tarjeta"],
                        'cableHdmi' => $element["cable_hdmi"],
                        'cableAv' => $element["cable_av"],
                        'fuente' => $element["fuente"],
                        'control' => $element["control_1"],
                        'nombreCliente' => $element["nombre_cliente"],
                        'direccion' => $element["direccion"],
                        'provincia' => $element["provincia"],
                        'localidad' => $element["localidad"],
                        'codigoPostal' => $element["codigo_postal"],
                        'estadoRec' => $element["estado"],
                    );
                }
            } else {
                $objeto[] = array(
                    'result' => '2',
                );
            }

            $jsonstring = json_encode($objeto);
            echo $jsonstring;
        }
    }

    public function countEquiposByWord(){

        if($_GET){
            $word = isset($_GET['word']) ? $_GET['word'] : false ;

            $countEquiposByWord = new Equipos();
            $countEquiposByWord->setWord($word);
            $countEquiposByWord = $countEquiposByWord->countEquiposByWord();

            if (is_object($countEquiposByWord)) {
                foreach ($countEquiposByWord as $element) {
                      $objeto = array(
                          'result' => true,
                          'count' => $element["count"]
                      );
                }
            } else {
                $objeto = array(
                    'result' => false,
                );
            }

            $jsonString = json_encode($objeto);
            echo $jsonString;

        }

    }
   
    public function countGestionByWord(){

        if($_GET){

            $word = isset($_GET['word']) ? $_GET['word'] : false ;

            $countGestionByWord = new Equipos();
            $countGestionByWord->setWord($word);
            $countGestionByWord = $countGestionByWord->countGestionByWord();

            if (is_object($countGestionByWord)) {
                foreach ($countGestionByWord as $element) {
                      $objeto = array(
                          'result' => true,
                          'count' => $element["count"]
                      );
                }
            } else {
                $objeto = array(
                    'result' => false,
                );
            }

            $jsonString = json_encode($objeto);
            echo $jsonString;

        }

    }

    public function countGestionRangeDate(){
        if ($_GET) {

            $dateStart = isset($_GET["dateStart"]) ? $_GET["dateStart"] : false;
            $dateEnd = isset($_GET["dateEnd"]) ? $_GET["dateEnd"] : false;

            $countGestionRangeDate = new Equipos();
            $countGestionRangeDate->setFechaStart($dateStart);
            $countGestionRangeDate->setFechaEnd($dateEnd);
            $countGestionRangeDate =$countGestionRangeDate->countGestionRangeDate();
        
            if (is_object($countGestionRangeDate)) {
                foreach ($countGestionRangeDate as $element) {
                   
                      $objeto = array(

                          'result' => true,
                          'count' => $element["count"]
                      );
                }
            } else {
                $objeto = array(
                    'result' => false,
                );
            }

            
             $jsonstring = json_encode($objeto);
             echo $jsonstring;
        }
    }

    public function countGestionByWordAndDateRange(){

        if ($_GET) {

            $word = isset($_GET["word"]) ? $_GET["word"] : false;
            $dateStart = isset($_GET["dateStart"]) ? $_GET["dateStart"] : false;
            $dateEnd = isset($_GET["dateEnd"]) ? $_GET["dateEnd"] : false;
            
            $countGestionByWordAndDateRange = new Equipos();
            $countGestionByWordAndDateRange->setFechaStart($dateStart);
            $countGestionByWordAndDateRange->setFechaEnd($dateEnd);
            $countGestionByWordAndDateRange->setWord($word);
            $countGestionByWordAndDateRange =$countGestionByWordAndDateRange->countGestionByWordAndDateRange();
        
            if (is_object($countGestionByWordAndDateRange)) {
               
                foreach ($countGestionByWordAndDateRange as $element) {
                      $objeto = array(
                          'result' => true,
                          'count' => $element["count"]
                      );
                }
            } else {
                $objeto = array(
                    'result' => false,
                );
            }

             $jsonstring = json_encode($objeto);
             echo $jsonstring;
        }

    }
  
    public function countGestion()
    {
     
        if ($_GET) {
            $id = isset($_GET["id"]) ? $_GET["id"] : false;
            $gestion = new Equipos();
            $gestion->setIdentificacionCliente($id);

            $gestion = $gestion->getTransit();

            if (is_object($gestion)) {

                foreach ($gestion as $element) {
                     $objeto[] = array(
                         'result' => true,
                         'identificacion' => $element["identificacion"],
                         'estado' => $element["estado"],
                         'empresa' => $element["empresa"],
                         'terminal' => $element["terminal"],
                         'serie' => $element["serie"],
                         'orden' => $element["id_orden"],
                         'recolector' => $element["id_user"],
                         'name' => $element["name"],
                         'serie_base' => $element["serie_base"],
                         'tarjeta' => $element["tarjeta"],
                         'chip_alternativo' => $element["chip_alternativo"],
                         'accesorio_uno' => $element["accesorio_uno"],
                         'accesorio_dos' => $element["accesorio_dos"],
                         'accesorio_tres' => $element["accesorio_tres"],
                         'accesorio_cuatro' => $element["accesorio_cuatro"],
                         'motivo' => $element["motivo"],
                         'created_at' => $element["created_at"],
                         'nombre_cliente' => $element["nombre_cliente"],
                         'direccion' => $element["direccion"],
                         'provincia' => $element["provincia"],
                         'localidad' => $element["localidad"],
                         'codigo_postal' => $element["codigo_postal"],
                         'remito' => $element["id_orden_pass"],
                         'id' => $element["id"],
                         'id_equipo' => $element["id_equipo"],
                         'latGestion' => $element["latGestion"],
                         'lngGestion' => $element["lngGestion"],
                         'lat' => $element["lat"],
                         'lng' => $element["lng"],
                         'means' => $element["means"],
                         'contacto' => $element["contacto"],
                         'fecha_aviso_visita' => $element["fecha_aviso_visita"],
                     );
                }
            } else {

                $objeto[] = array(
                    'result' => false,
                );
            }

            $jsonstring = json_encode($objeto);
            echo $jsonstring;
        }
    }

    public function countStatusCustomer()
    {
        if ($_POST) {

            $identificacion = isset($_POST["object"]) ? $_POST["object"] : false;


            if ($identificacion) {

                $status = new Equipos();
                $status->setIdentificacionCliente($identificacion);
                $status = $status->getStatusCustomer();
                if (is_object($status)) {

                    foreach ($status as $element) {
                        $objeto[] = array(
                            'result' => 'count',
                            'estado' => $element["estado"],
                            'cantidadEstado' => $element["cantidadEstado"],
                        );
                    }
                } else {
                    $objeto[] = array(
                        'result' => '2',
                    );
                }

                $jsonstring = json_encode($objeto);
                echo  $jsonstring;
            }
        }
    }

    public function countStatusGestion()
    {

        if ($_GET) {

            $word = isset($_GET["word"]) ? $_GET["word"] : false;
            $dateStart = isset($_GET["dateStart"]) ? $_GET["dateStart"] : false;
            $dateEnd = isset($_GET["dateEnd"]) ? $_GET["dateEnd"] : false;

            $status = new Equipos();
            if (!$word && $dateStart &&  $dateEnd) {
                $status->setFechaStart($dateStart);
                $status->setFechaEnd($dateEnd);
                $status = $status->countEstadoGestionByRangeDate();
                 
            }
            if ($word && $dateStart &&  $dateEnd) {
                $status->setWord($word);
                $status->setFechaStart($dateStart);
                $status->setFechaEnd($dateEnd);
                $status = $status->countEstadoGestionByWordAndRangeDate();
                
            }
            if($word && !$dateStart &&  !$dateEnd){
                // id recolector es la identificacion / terminal / serie, etc que entra
                $status->setWord($word);
                $status = $status->countEstadoGestionByWord();

            }

            if (is_object($status)) {
                foreach ($status as $element) {

                    $objeto[] = array(
                        'result' => true,
                        'estado' => $element["estado"],
                        'cantidadEstado' => $element["cantidadEstado"],
                    );
                }
            } else {
                $objeto[] = array(
                    'result' => false,

                );
            }

            $jsonstring = json_encode($objeto);
            echo $jsonstring;
        }
    }

    public function countFilterSearchController(){


        if($_GET){

            $dataRequest = json_decode($_GET['dataRequest']);
            $dateStart = isset($dataRequest->dateStart) ? $dataRequest->dateStart : false ; 
            $dateEnd = isset($dataRequest->dateEnd) ? $dataRequest->dateEnd : false ;
            $filter = isset($dataRequest->filter) ? $dataRequest->filter : false ;  
            $word = isset($dataRequest->word) ? $dataRequest->word : false ; 


            if($dateStart && $dateEnd  && $filter){
                $countFilterSearchController =  new Equipos();
                $countFilterSearchController->setFechaStart($dateStart);
                $countFilterSearchController->setFechaEnd($dateEnd);
                $countFilterSearchController->setFilter($filter);
                $countFilterSearchController = $countFilterSearchController->countFilterToGestionByDateAndFilter();
            }

            if(!$dateStart && !$dateEnd && $word && $filter){
                $countFilterSearchController =  new Equipos();
                $countFilterSearchController->setFilter($filter);
                $countFilterSearchController= $countFilterSearchController->countFilterToGestionByFilter();

            }

            if($dateStart && $dateEnd && $word && $filter){
               
                $countFilterSearchController =  new Equipos();
                $countFilterSearchController->setFechaStart($dateStart);
                $countFilterSearchController->setFechaEnd($dateEnd);
                $countFilterSearchController->setId_recolector($word);
                $countFilterSearchController->setFilter($filter);
                $countFilterSearchController = $countFilterSearchController->countFilterToGestionByWordAndDateAndFilter();
            }

           
            if(is_object($countFilterSearchController)){
               
                 foreach ($countFilterSearchController as $element) {
                   
                     $objeto = array(
    
                         'result' => true,
                         'count' => $element["count"]
                     );
                 }
            }else {
                $objeto = array(
    
                    'result' => false,
            
                );
            }
            $jsonString = json_encode($objeto);
            echo $jsonString;
        }
       
    }

    //BUSCADORES DIRECTOS DE GESTION PARA TABLAS

    public function equiposByWord(){

        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $request =  json_decode($dataRequest);
        $word = isset($request->word) ? $request->word : false; 
        $fromRow = isset($request->fromRow) ? $request->fromRow : false; 
        $limit = isset($request->limit) ? $request->limit : false;

        $equiposByWord = new Equipos();

        $equiposByWord->setWord($word);
        $equiposByWord->setFromRow($fromRow);
        $equiposByWord->setLimit($limit);
        $equiposByWord = $equiposByWord->equiposByWord();

        if (is_object($equiposByWord)) {

            foreach ($equiposByWord as $element) {
               
                 $objeto[] = array(

                     'result' => true,
                     'id_equipo' => $element["id_equipo"],
                     'id' => $element["id"],
                     'identificacion' => $element["identificacion"],
                     'estado' => $element["estado"],
                     'empresa' => $element["empresa"],
                     'terminal' => $element["terminal"],
                     'serie' => $element["serie"],
                     'orden' => $element["id_orden"],
                     'recolector' => $element["id_user"],
                     'serie_base' => $element["serie_base"],
                     'tarjeta' => $element["tarjeta"],
                     'chip_alternativo' => $element["chip_alternativo"],
                     'accesorio_uno' => $element["accesorio_uno"],
                     'accesorio_dos' => $element["accesorio_dos"],
                     'accesorio_tres' => $element["accesorio_tres"],
                     'accesorio_cuatro' => $element["accesorio_cuatro"],
                     'motivo' => $element["motivo"],
                     'created_at' => $element["created_at"],
                     'nombre_cliente' => $element["nombre_cliente"],
                     'direccion' => $element["direccion"],
                     'provincia' => $element["provincia"],
                     'localidad' => $element["localidad"],
                     'codigo_postal' => $element["codigo_postal"],
                     'emailcliente' => $element["emailcliente"],
                     'remito' => $element["id_orden_pass"],
                     'name' => $element["name"],
                     'latAviso' => $element["latAviso"],
                     'lngAviso' => $element["lngAviso"],
                     'latGestion' => $element["latGestion"],
                     'lngGestion' => $element["lngGestion"],
                     'means' => $element["means"],
                     'contacto' => $element["contacto"],
                     'fecha_aviso_visita' => $element["fecha_aviso_visita"],
                     
                 );
            }
        } else {
            $objeto[] = array(
                'result' => false,
            );
        }

        
         $jsonstring = json_encode($objeto);
         echo $jsonstring;
        
    }

    public function gestionByWord(){

        $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
        $request =  json_decode($dataRequest);
        $word = isset($request->word) ? $request->word : false; 
        $fromRow = isset($request->fromRow) ? $request->fromRow : false; 
        $limit = isset($request->limit) ? $request->limit : false;

        $gestionByWord = new Equipos();

        $gestionByWord->setWord($word);
        $gestionByWord->setFromRow($fromRow);
        $gestionByWord->setLimit($limit);
        $gestionByWord = $gestionByWord->gestionByWord();

        if (is_object($gestionByWord)) {

            foreach ($gestionByWord as $element) {
               
                 $objeto[] = array(

                     'result' => true,
                     'id_equipo' => $element["id_equipo"],
                     'id' => $element["id"],
                     'identificacion' => $element["identificacion"],
                     'estado' => $element["estado"],
                     'empresa' => $element["empresa"],
                     'terminal' => $element["terminal"],
                     'serie' => $element["serie"],
                     'orden' => $element["id_orden"],
                     'recolector' => $element["id_user"],
                     'serie_base' => $element["serie_base"],
                     'tarjeta' => $element["tarjeta"],
                     'chip_alternativo' => $element["chip_alternativo"],
                     'accesorio_uno' => $element["accesorio_uno"],
                     'accesorio_dos' => $element["accesorio_dos"],
                     'accesorio_tres' => $element["accesorio_tres"],
                     'accesorio_cuatro' => $element["accesorio_cuatro"],
                     'motivo' => $element["motivo"],
                     'created_at' => $element["created_at"],
                     'nombre_cliente' => $element["nombre_cliente"],
                     'direccion' => $element["direccion"],
                     'provincia' => $element["provincia"],
                     'localidad' => $element["localidad"],
                     'codigo_postal' => $element["codigo_postal"],
                     'emailcliente' => $element["emailcliente"],
                     'remito' => $element["id_orden_pass"],
                     'name' => $element["name"],
                     'latAviso' => $element["latAviso"],
                     'lngAviso' => $element["lngAviso"],
                     'latGestion' => $element["latGestion"],
                     'lngGestion' => $element["lngGestion"],
                     'means' => $element["means"],
                     'contacto' => $element["contacto"],
                     'fecha_aviso_visita' => $element["fecha_aviso_visita"],
                     
                 );
            }
        } else {
            $objeto[] = array(
                'result' => false,
            );
        }

        
         $jsonstring = json_encode($objeto);
         echo $jsonstring;
        
    }

    public function gestionRangeDate()
    {
        if($_GET){
            $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
            $request =  json_decode($dataRequest);
            $dateStart = !empty($request->dateStart) ? $request->dateStart: false; 
            $dateEnd = !empty($request->dateEnd) ? $request->dateEnd: false; 
            $fromRow = $request->fromRow;
            $limit = $request->limit;
    
            $gestion = new Equipos();
            $gestion->setFechaStart($dateStart);
            $gestion->setFechaEnd($dateEnd);
            $gestion->setFromRow($fromRow);
            $gestion->setLimit($limit);
            $gestion = $gestion->gestionByRangeDate();

            if (is_object($gestion)) {
                foreach ($gestion as $element) {
                    
                        $objeto[] = array(
    
                            'result' => true,
                            'id_equipo' => $element["id_equipo"],
                            'id' => $element["id"],
                            'identificacion' => $element["identificacion"],
                            'estado' => $element["estado"],
                            'empresa' => $element["empresa"],
                            'terminal' => $element["terminal"],
                            'serie' => $element["serie"],
                            'orden' => $element["id_orden"],
                            'recolector' => $element["id_user"],
                            'serie_base' => $element["serie_base"],
                            'tarjeta' => $element["tarjeta"],
                            'chip_alternativo' => $element["chip_alternativo"],
                            'accesorio_uno' => $element["accesorio_uno"],
                            'accesorio_dos' => $element["accesorio_dos"],
                            'accesorio_tres' => $element["accesorio_tres"],
                            'accesorio_cuatro' => $element["accesorio_cuatro"],
                            'motivo' => $element["motivo"],
                            'created_at' => $element["created_at"],
                            'nombre_cliente' => $element["nombre_cliente"],
                            'direccion' => $element["direccion"],
                            'provincia' => $element["provincia"],
                            'localidad' => $element["localidad"],
                            'codigo_postal' => $element["codigo_postal"],
                            'emailcliente' => $element["emailcliente"],
                            'remito' => $element["id_orden_pass"],
                            'name' => $element["name"],
                            'latAviso' => $element["latAviso"],
                            'lngAviso' => $element["lngAviso"],
                            'latGestion' => $element["latGestion"],
                            'lngGestion' => $element["lngGestion"],
                            'means' => $element["means"],
                            'contacto' => $element["contacto"],
                            'fecha_aviso_visita' => $element["fecha_aviso_visita"],
                            
                        );
                }
            } else {
                $objeto[] = array(
                    'result' => false,
                );
            }
                $jsonstring = json_encode($objeto);
                echo $jsonstring;
           }

           
    }

    public function gestionWordAndRangeDate(){

        if($_GET){

            $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false ;
            $request =  json_decode($dataRequest);
            $word = !empty($request->word) ? $request->word: false; 
            $dateStart = !empty($request->dateStart) ? $request->dateStart: false; 
            $dateEnd = !empty($request->dateEnd) ? $request->dateEnd: false; 
            $fromRow = $request->fromRow;
            $limit = $request->limit;
    
            $gestion = new Equipos();
            $gestion->setWord($word);
            $gestion->setFechaStart($dateStart);
            $gestion->setFechaEnd($dateEnd);
            $gestion->setFromRow($fromRow);
            $gestion->setLimit($limit);
            $gestion = $gestion->gestionByWordAndRangeDate();

            if (is_object($gestion)) {
                foreach ($gestion as $element) {
                        $objeto[] = array(
                            'result' => true,
                            'id_equipo' => $element["id_equipo"],
                            'id' => $element["id"],
                            'identificacion' => $element["identificacion"],
                            'estado' => $element["estado"],
                            'empresa' => $element["empresa"],
                            'terminal' => $element["terminal"],
                            'serie' => $element["serie"],
                            'orden' => $element["id_orden"],
                            'recolector' => $element["id_user"],
                            'serie_base' => $element["serie_base"],
                            'tarjeta' => $element["tarjeta"],
                            'chip_alternativo' => $element["chip_alternativo"],
                            'accesorio_uno' => $element["accesorio_uno"],
                            'accesorio_dos' => $element["accesorio_dos"],
                            'accesorio_tres' => $element["accesorio_tres"],
                            'accesorio_cuatro' => $element["accesorio_cuatro"],
                            'motivo' => $element["motivo"],
                            'created_at' => $element["created_at"],
                            'nombre_cliente' => $element["nombre_cliente"],
                            'direccion' => $element["direccion"],
                            'provincia' => $element["provincia"],
                            'localidad' => $element["localidad"],
                            'codigo_postal' => $element["codigo_postal"],
                            'emailcliente' => $element["emailcliente"],
                            'remito' => $element["id_orden_pass"],
                            'name' => $element["name"],
                            'latAviso' => $element["latAviso"],
                            'lngAviso' => $element["lngAviso"],
                            'latGestion' => $element["latGestion"],
                            'lngGestion' => $element["lngGestion"],
                            'means' => $element["means"],
                            'contacto' => $element["contacto"],
                            'fecha_aviso_visita' => $element["fecha_aviso_visita"],
                            
                        );
                }
            } else {
                $objeto[] = array(
                    'result' => false,
                );
            }
                $jsonstring = json_encode($objeto);
                echo $jsonstring;
           }
       

    }

    public function getDataSearchWordGestionController(){

        if($_GET){

            $dataRequest = json_decode($_GET['dataRequest']);

            $dateStart = isset($dataRequest->dateStart) ? $dataRequest->dateStart : false ; 
            $dateEnd = isset($dataRequest->dateEnd) ? $dataRequest->dateEnd : false ; 
            $filter = isset($dataRequest->filter) ? $dataRequest->filter : false ; 
            $word = isset($dataRequest->word) ? $dataRequest->word : false ; 
            $fromRow = isset($dataRequest->fromRow) ? $dataRequest->fromRow : false ; 
            $limit = isset($dataRequest->limit) ? $dataRequest->limit : false ; 

            if($dateStart && $dateEnd && $filter){
                $getDataSearchWordGestionController =  new Equipos();
                $getDataSearchWordGestionController->setFechaStart($dateStart);
                $getDataSearchWordGestionController->setFechaEnd($dateEnd);
                $getDataSearchWordGestionController->setFilter($filter);
                $getDataSearchWordGestionController->setFromRow($fromRow);
                $getDataSearchWordGestionController->setLimit($limit);
                $getDataSearchWordGestionController = $getDataSearchWordGestionController->getDataFilterToGestionByDateAndFilter();
            }
            if($dateStart && $dateEnd && $filter && $word){
                
                $getDataSearchWordGestionController =  new Equipos();
                $getDataSearchWordGestionController->setFechaStart($dateStart);
                $getDataSearchWordGestionController->setFechaEnd($dateEnd);
                $getDataSearchWordGestionController->setId_recolector($word);
                $getDataSearchWordGestionController->setFilter($filter);
                $getDataSearchWordGestionController->setFromRow($fromRow);
                $getDataSearchWordGestionController->setLimit($limit);
                $getDataSearchWordGestionController = $getDataSearchWordGestionController->getDataFilterToGestionByDateAndWordAndFilter();
            }

            if(!$dateStart && !$dateEnd && $filter){
                
                $getDataSearchWordGestionController =  new Equipos();
                $getDataSearchWordGestionController->setFilter($filter);
                $getDataSearchWordGestionController->setFromRow($fromRow);
                $getDataSearchWordGestionController->setLimit($limit);
                $getDataSearchWordGestionController = $getDataSearchWordGestionController->getDataFilterToGestionByWord();
            }

          
            if (is_object($getDataSearchWordGestionController)) {

                 foreach ($getDataSearchWordGestionController as $element) {
                   
                      $objeto[] = array(
    
                          'result' => true,
                          'id_equipo' => $element["id_equipo"],
                          'id' => $element["id"],
                          'identificacion' => $element["identificacion"],
                          'estado' => $element["estado"],
                          'empresa' => $element["empresa"],
                          'terminal' => $element["terminal"],
                          'serie' => $element["serie"],
                          'orden' => $element["id_orden"],
                          'recolector' => $element["id_user"],
                          'serie_base' => $element["serie_base"],
                          'tarjeta' => $element["tarjeta"],
                          'chip_alternativo' => $element["chip_alternativo"],
                          'accesorio_uno' => $element["accesorio_uno"],
                          'accesorio_dos' => $element["accesorio_dos"],
                          'accesorio_tres' => $element["accesorio_tres"],
                          'accesorio_cuatro' => $element["accesorio_cuatro"],
                          'motivo' => $element["motivo"],
                          'created_at' => $element["created_at"],
                          'nombre_cliente' => $element["nombre_cliente"],
                          'direccion' => $element["direccion"],
                          'provincia' => $element["provincia"],
                          'localidad' => $element["localidad"],
                          'codigo_postal' => $element["codigo_postal"],
                          'emailcliente' => $element["emailcliente"],
                          'remito' => $element["id_orden_pass"],
                          'name' => $element["name"],
                          'latAviso' => $element["latAviso"],
                          'lngAviso' => $element["lngAviso"],
                          'latGestion' => $element["latGestion"],
                          'lngGestion' => $element["lngGestion"],
                          'means' => $element["means"],
                          'contacto' => $element["contacto"],
                          'fecha_aviso_visita' => $element["fecha_aviso_visita"],
                         
                      );
                 }
            } else {
                $objeto[] = array(
                    'result' => false,
                );
            }

            $jsonString = json_encode($objeto);
            echo $jsonString;  
        }
    } 
    
    // EXPORT EXCEL

    public function exportEquipos(){
        if($_GET){

            $dataRequest = json_decode($_GET['dataRequest']);
            $dateStart = !empty($dataRequest->dateStart) ? $dataRequest->dateStart : false ; 
            $dateEnd = !empty($dataRequest->dateEnd) ? $dataRequest->dateEnd : false ; 
            $filter = !empty($dataRequest->filter) ? $dataRequest->filter : false ; 
            $word = !empty($dataRequest->word) ? $dataRequest->word : false ; 

            if($word && !$dateStart && !$dateEnd && !$filter){
                //busqueda input word(identificacion,terminal,serie,etc)
                 $exportEquipos =  new Equipos();
                 $exportEquipos->setWord($word);
                 $exportEquipos =  $exportEquipos->getDataManagementExportByWord();
             }

            if($dateStart && $dateEnd && !$filter && !$word){
                //busqueda inputs rango de fecha
                $exportEquipos =  new Equipos();
                $exportEquipos->setFechaStart($dateStart);
                $exportEquipos->setFechaEnd($dateEnd);
                $exportEquipos =  $exportEquipos->getDataManagementExportByDateRange();
            }
           
             if($dateStart && $dateEnd && $filter){
                 //busqueda inputs rango de fecha y filtro
                
                 $exportEquipos =  new Equipos();
                 $exportEquipos->setFechaStart($dateStart);
                 $exportEquipos->setFechaEnd($dateEnd);
                 $exportEquipos->setFilter($filter);
                 $exportEquipos =  $exportEquipos->getDataManagementExportByDateRangeAndFilter();
             }

             if($dateStart && $dateEnd && $word && !$filter){
                //busqueda inputs rango de fecha y palabra(recolector)
                $exportEquipos =  new Equipos();
                $exportEquipos->setFechaStart($dateStart);
                $exportEquipos->setFechaEnd($dateEnd);
                $exportEquipos->setWord($word);
                $exportEquipos =  $exportEquipos->getDataManagementExportByDateRangeAndWord();
            }

            if($dateStart && $dateEnd && $word && $filter){
                //busqueda inputs rango de fecha , palabra(recolector) y filtro
                $exportEquipos =  new Equipos();
                $exportEquipos->setFechaStart($dateStart);
                $exportEquipos->setFechaEnd($dateEnd);
                $exportEquipos->setWord($word);
                $exportEquipos->setFilter($filter);
                $exportEquipos =  $exportEquipos->getDataManagementExportByDateRangeAndWordAndFilter();
            }

            
            if(is_object($exportEquipos)){

                    $response = $this->excelEquipmentManagement($exportEquipos);
                    if($response){
                        $objectResponse = array(
                            'result' => true,
                            'path' => $response
                        );
                    }else{
                        $objectResponse = array(
                            'result' => false
                            
                        );
                    }
                
            }
            $jsonString = json_encode($objectResponse);
            echo $jsonString;
        }
    }

    public function excelEquipmentManagement($exportEquipos){

        foreach($exportEquipos as $element){
            $arrayRow[] =  array(
                'identificacion' => $element["identificacion"],
                'estado' => $element["estado"],
                'empresa' => $element["empresa"],
                'terminal' => $element["terminal"],
                'serie' => $element["serie"],
                'serie_base' => $element["serie_base"],
                'tarjeta' => $element["tarjeta"],
                'chip_alternativo' => $element["chip_alternativo"],
                'accesorio_uno' => $element["accesorio_uno"],
                'accesorio_dos' => $element["accesorio_dos"],
                'accesorio_tres' => $element["accesorio_tres"],
                'accesorio_cuatro' => $element["accesorio_cuatro"],
                'motivo' => $element["motivo"],
                'created_at' => $element["created_at"],
                'id_recolector' =>  $element["id_user"],
                'nombre_recolector'  => $element["name"],
                'nombre_cliente' => $element["nombre_cliente"],
                'direccion' => $element["direccion"],
                'provincia' => $element["provincia"],
                'localidad' => $element["localidad"],
                'codigo_postal' => $element["codigo_postal"],
                'remito' => $element["id_orden_pass"],
                'means' => $element["means"],
                'contacto' => $element["contacto"],
                'fecha_aviso_visita' => $element["fecha_aviso_visita"],
            );
        }
            $header=array(
                'identificacion',
                'estado',
                'empresa',
                'terminal',
                'serie',
                'serie_base',
                'tarjeta/C.Red',
                'chip_alternativo',
                'HDMI/C.Tlf',
                'AV/Sim',
                'fuente/cargador',
                'control/base',
                'motivo',
                'fecha',
                'id_recolector',
                'nombre_recolector',
                'nombre_cliente',
                'direccion',
                'provincia',
                'localidad',
                'codigo_postal',
                'remito',
                'medio de contacto',
                'contacto',
                'fecha aviso visita'
            );
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([$header], NULL, 'A1');
        
                $columnArray = array_chunk($arrayRow, 1);
                $rowCount = 1;
                foreach($columnArray as $element){
                    $rowCount++;
                    $sheet->setCellValue('A'.$rowCount, $element[0]["identificacion"]);
                    $sheet->setCellValue('B'.$rowCount, $element[0]["estado"]);
                    $sheet->setCellValue('C'.$rowCount, $element[0]["empresa"]);
                    $sheet->setCellValue('D'.$rowCount, $element[0]["terminal"]);
                    $sheet->setCellValue('E'.$rowCount, $element[0]["serie"]);
                    $sheet->setCellValue('F'.$rowCount, $element[0]["serie_base"]);
                    $sheet->setCellValue('G'.$rowCount, $element[0]["tarjeta"]);
                    $sheet->setCellValue('H'.$rowCount, $element[0]["chip_alternativo"]);
                    $sheet->setCellValue('I'.$rowCount, $element[0]["accesorio_uno"]);
                    $sheet->setCellValue('J'.$rowCount, $element[0]["accesorio_dos"]);
                    $sheet->setCellValue('K'.$rowCount, $element[0]["accesorio_tres"]);
                    $sheet->setCellValue('L'.$rowCount, $element[0]["accesorio_cuatro"]);
                    $sheet->setCellValue('M'.$rowCount, $element[0]["motivo"]);
                    $sheet->setCellValue('N'.$rowCount, $element[0]["created_at"]);
                    $sheet->setCellValue('O'.$rowCount, $element[0]["nombre_recolector"]);
                    $sheet->setCellValue('P'.$rowCount, $element[0]["id_recolector"]);
                    $sheet->setCellValue('Q'.$rowCount, $element[0]["nombre_cliente"]);
                    $sheet->setCellValue('R'.$rowCount, $element[0]["direccion"]);
                    $sheet->setCellValue('S'.$rowCount, $element[0]["provincia"]);
                    $sheet->setCellValue('T'.$rowCount, $element[0]["localidad"]);
                    $sheet->setCellValue('U'.$rowCount, $element[0]["codigo_postal"]);
                    $sheet->setCellValue('V'.$rowCount, $element[0]["remito"]);
                    $sheet->setCellValue('W'.$rowCount, $element[0]["means"]);
                    $sheet->setCellValue('X'.$rowCount, $element[0]["contacto"]);
                    $sheet->setCellValue('Y'.$rowCount, $element[0]["fecha_aviso_visita"]);
                }
        $writer = new Xlsx($spreadsheet);
        # Le pasamos la ruta de guardado
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $momento = date('d-m-Y H-i-s');
        //Este formato de hora esta asi para poder crear el archivo
        $path = '../resources/excel/reporteGestion'.$momento.'.xlsx';
        $pathFront = 'reporteGestion'.$momento.'.xlsx';
        $writer->save($path);

        if(file_exists($path)){
            $result = $pathFront;
        }else {
            $result = false;
        }

        return $result ;
        
        // 1) crear archivo con el objeto devuelto por la consulta
        // 2) consultar cuando exista archivo, enviar response con true y ubicacion del archivo
        // 3) guardar archivo con nombre fecha y hora especifico en resources/excel 
        // 4) devolver link al front para hacer click en descargar 
    }

    public function estados(){
     

         $estados = new Equipos();
         $estados = $estados->getStatus();

         if($estados){
            
            foreach($estados as $element){
                $object[]= array(
                    'result' => true,
                    'estado' => $element["estado"]
                );
               
            }
         }else {
            $object[]= array(
                'result' => false
            );
         }

         $jsonstring = json_encode($object);
         echo $jsonstring;
      
    }

    public function informeRecolectoresYFecha()
    {

        if ($_POST) {

            $recolector = isset($_POST["recolector"]) ?  $_POST["recolector"] : false;
            $fechaStart = isset($_POST["fechaStart"]) ?  $_POST["fechaStart"] : false;
            $fechaEnd = isset($_POST["fechaEnd"]) ?  $_POST["fechaEnd"] : false;

           


            $informe = new Equipos();

            if ($recolector && $fechaStart && $fechaEnd) {

                $informe->setId_recolector($recolector);
                $informe->setFechaStart($fechaStart);
                $informe->setFechaEnd($fechaEnd);
                $informe = $informe->getReportTransit();
            }
            if(!$recolector && $fechaStart && $fechaEnd){

                $informe->setFechaStart($fechaStart);
                $informe->setFechaEnd($fechaEnd);
                $informe = $informe->getReportTransit();
                
            }

            if (is_object($informe)) {

                foreach ($informe as $element) {

                    $objeto[] = array(
                        'result' => '1',
                        'provincia' => $element["provincia"],
                        'localidad' => $element["localidad"],
                        'codigo_postal' => $element["codigo_postal"],
                        'recuperado' => $element["recuperado"],
                        'a_confirmar' => $element["autorizar"],
                        'no_tuvo_equipo' => $element["no-tuvo-equipo"],
                        'no_coincide_serie' => $element["no-coincide-serie"],
                        'rechazada' => $element["rechazada"],
                        'en_uso' => $element["en-uso"],
                        'n_tel_equivocado' => $element["n/tel-equivocado"],
                        'no_existe_numero' => $element["no-existe-numero"],
                        'no_responde' => $element["no-responde"],
                        'tiempo_espera' => $element["tiempo-espera"],
                        'se_mudo' => $element["se-mudo"],
                        'ya_retirado' => $element["ya-retirado"],
                        'zona_peligrosa' => $element["zona-peligrosa"],
                        'deshabitado' => $element["deshabitado"],
                        'extraviado' => $element["extraviado"],
                        'fallecio' => $element["fallecio"],
                        'faltan_datos' => $element["faltan-datos"],
                        'reconectado' => $element["reconectado"],
                        'robado' => $element["robado"],
                        'entrego_en_sucursal' => $element["entrego-en-sucursal"],
                        'posnet' => $element["posnet"],
                        'antina' => $element["antina"],
                        'intv' => $element["intv"],
                        'iplan' => $element["iplan"],
                        'metrotel' => $element["metrotel"],
                        'lapos' => $element["lapos"],
                        'cablevision' => $element["cablevision"],
                        'cablevision_uruguay' => $element["cablevision uruguay"],
                        'total' => $element["total"],
                        
                    );
                  }
                }else {
                    $objeto[] = array(
                        'result' => '2',
                    );  
                }

                $jsonstring = json_encode($objeto);
                echo $jsonstring;

        }
    }

    //ACCIONES DE GESTION

    public function updateGestion()
    {

        $dataRequest = json_decode($_GET['dataRequest']);
        $id_equipo = isset($dataRequest->id_equipo) ?$dataRequest->id_equipo : false ; 
        $id = isset($dataRequest->id) ?$dataRequest->id : false ; 
        $estado = isset($dataRequest->estado) ?$dataRequest->estado : false ; 
        $serie = isset($dataRequest->serie) ?$dataRequest->serie : false ; 
        $terminal = isset($dataRequest->terminal) ?$dataRequest->terminal : false ; 
        $accesorio_uno = isset($dataRequest->accesorio_uno) ?$dataRequest->accesorio_uno : false ; 
        $accesorio_dos = isset($dataRequest->accesorio_dos) ?$dataRequest->accesorio_dos : false ; 
        $accesorio_tres = isset($dataRequest->accesorio_tres) ?$dataRequest->accesorio_tres : false ; 
        $accesorio_cuatro = isset($dataRequest->accesorio_cuatro) ?$dataRequest->accesorio_cuatro : false ; 
        $fecha_update = isset($dataRequest->created_at) ?$dataRequest->created_at : false ; 
        $id_user_update = isset($dataRequest->id_user_update) ?$dataRequest->id_user_update : false ;

        $updateGestion = new Equipos();
        $updateGestion->setGuiaEquipo($id);
        $updateGestion->setId_user_update($id_user_update);
        $updateGestion->setFecha_momento($fecha_update);
        $updateGestion->setTerminal($terminal);
        $updateGestion->setSerie($serie);
        $updateGestion->setAccesorioUno($accesorio_uno);
        $updateGestion->setAccesorioDos($accesorio_dos);
        $updateGestion->setAccesorioTres($accesorio_tres);
        $updateGestion->setAccesorioCuatro($accesorio_cuatro);
        $updateGestion->setEstado($estado);
        $updateGestion = $updateGestion->updateGestion();

        if($updateGestion){

            $updateEquipo = new Equipos();
            $updateEquipo->setId_equipo($id_equipo);
            $updateEquipo->setEstado($estado);
            $updateEquipo->setFecha_momento($fecha_update);
            $updateEquipo->setId_user_update($id_user_update);

            $updateEquipo = $updateEquipo->updateEquipo();
            if($updateEquipo){
                $object = array(
                    'result' => true
                );
            }else {
                $object = array(
                    'result' => false
                );
            }
        }else {
            $object = array(
                'result' => false
            );
        }
            $jsonstring = json_encode($object);
            echo $jsonstring;
    }

    public function deleteGestion(){

        $dataRequest = json_decode($_GET['dataRequest']);

        $id = isset($dataRequest->id) ?$dataRequest->id : false ; 
        $fecha_update = isset($dataRequest->created_at) ?$dataRequest->created_at : false ; 
        $id_user_update = isset($dataRequest->id_user_update) ?$dataRequest->id_user_update : false ;

        $deleteGestion = new Equipos();
        $deleteGestion->setId_equipo($id);
        $deleteGestion->setId_user_update($id_user_update);
        $deleteGestion->setFecha_momento($fecha_update);

        $deleteGestion = $deleteGestion->deleteGestion();

        if($deleteGestion){
            $object= array(
                'result' => true
            );
        }else {
            $object= array(
                'result' => false
            );
        }

        $jsonstring = json_encode($object);
        echo $jsonstring;
        
    }

    public function gestionRecolectores(){
        if($_POST){
            $fechaStart= isset($_POST["fechaStart"]) ? $_POST["fechaStart"]: false ;
            $fechaEnd= isset($_POST["fechaEnd"]) ? $_POST["fechaEnd"]: false ;

            if($fechaStart && $fechaEnd){

                $recolectores = new Equipos();
                $recolectores->setFechaStart($fechaStart);
                $recolectores->setFechaEnd($fechaEnd);
                $recolectores = $recolectores->getReportAllCollector();

                if(is_object($recolectores)){
                
                    foreach($recolectores as $element){

                        $objeto[]=array(
                          'result' => '1',
                          'recolector' => $element["recolector"],
                          'recuperado' => $element["recuperado"],
                          'a_confirmar' => $element["autorizar"],
                          'no_tuvo_equipo' => $element["no-tuvo-equipo"],
                          'no_coincide_serie' => $element["no-coincide-serie"],
                          'rechazada' => $element["rechazada"],
                          'en_uso' => $element["en-uso"],
                          'n_tel_equivocado' => $element["n/tel-equivocado"],
                          'no_existe_numero' => $element["no-existe-numero"],
                          'no_responde' => $element["no-responde"],
                          'tiempo_espera' => $element["tiempo-espera"],
                          'se_mudo' => $element["se-mudo"],
                          'ya_retirado' => $element["ya-retirado"],
                          'zona_peligrosa' => $element["zona-peligrosa"],
                          'deshabitado' => $element["deshabitado"],
                          'extraviado' => $element["extraviado"],
                          'fallecio' => $element["fallecio"],
                          'faltan_datos' => $element["faltan-datos"],
                          'reconectado' => $element["reconectado"],
                          'robado' => $element["robado"],
                          'entrego_en_sucursal' => $element["entrego-en-sucursal"],
                          'posnet' => $element["posnet"],
                          'antina' => $element["antina"],
                          'intv' => $element["intv"],
                          'iplan' => $element["iplan"],
                          'metrotel' => $element["metrotel"],
                          'lapos' => $element["lapos"],
                          'cablevision' => $element["cablevision"],
                          'cablevision_uruguay' => $element["cablevision_uruguay"],
                          'total_recuperados' => $element["total_recuperados"],
                          'total_gestionados' => $element["total_gestionados"],
                          'name' => $element["name"],

                        );
                    }

                }else{
                    $objeto[]=array(
                        'result' => '2',
                    );
                }

                $jsonstring = json_encode($objeto);
                echo $jsonstring;
            }
        }
    }

    public function saveDataCustomer(){
        if($_POST){

            $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : false ;
            $id_orden = isset($_POST['id_orden']) ? $_POST['id_orden'] : false ;
            $identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : false ;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false ;
            $mail = isset($_POST['mail']) ? $_POST['mail'] : false ;
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : date('d-m-y');
            $elemento = isset($_POST['elemento']) ? $_POST['elemento'] : false ;

            if($id_user && $id_orden && $identificacion || $telefono || $mail){

                $saveData = new EquiposExtra();
                $saveData->setId_recolector($id_user);
                $saveData->setOrden($id_orden);
                $saveData->setIdentificacionCliente($identificacion);
                $saveData->setTelefonoNuevo($telefono);
                $saveData->setEmail($mail);
                $saveData->setFecha_momento($fecha);
                $saveData->setElemento($elemento);
                $saveData = $saveData->saveDataCustomer();

            }

        }
    }

    public function detect()
     {
          $browser = array("IE", "OPERA", "MOZILLA", "NETSCAPE", "FIREFOX", "SAFARI", "CHROME");
          $os = array("WIN", "MAC", "LINUX");

          # definimos unos valores por defecto para el navegador y el sistema operativo
          $info['browser'] = "OTHER";
          $info['os'] = "OTHER";

          # buscamos el navegador con su sistema operativo
          foreach ($browser as $parent) {
               $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
               $f = $s + strlen($parent);
               $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
               $version = preg_replace('/[^0-9,.]/', '', $version);
               if ($s) {
                    $info['browser'] = $parent;
                    $info['version'] = $version;
               }
          }

          # obtenemos el sistema operativo
          foreach ($os as $val) {
               if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $val) !== false)
                    $info['os'] = $val;
          }

          # devolvemos el array de valores
          return $info;
     }
    }