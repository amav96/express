<?php 

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../resources/phpmailer/phpmailer/src/Exception.php';
  require '../resources/phpmailer/phpmailer/src/PHPMailer.php';
  require '../resources/phpmailer/phpmailer/src/SMTP.php';


if(isset($_GET['email'])){

    session_start();
    require_once '../model/email.php';
    require_once '../config/db.php';

    
    $accion = $_GET['email'];
    $usuario = new emailController();
    $usuario->$accion();

}

class emailController{

    public function remito(){

      
        if($_POST){
            
            
            $destino = $_POST["emailDestino"];
            $orden = $_POST["codCapture"];
            $host = isset($_POST["host"])? $_POST["host"] : 'smtp.gmail.com';
            $user = isset($_POST["user"])? $_POST["user"] : 'informes@postalmarketing.com.ar';
            $password = isset($_POST["password"])? $_POST["password"] : 'decos2020';
            $name = isset($_POST["name"])? $_POST["name"] : 'informes@postalmarketing.com.ar';
            $motivo = isset($_POST["motivo"])? $_POST["motivo"] : 'Informes-Express';
            $modo = isset($_POST["modo"]) ? $_POST["modo"] : false;
            
            try{

             $mail = new PHPMailer(true);

             $mail->SMTPDebug = false; 
             $mail->do_debug = 0; 
                               
             $mail->isSMTP();                                            
             $mail->Host       = $host;                    
             $mail->SMTPAuth   = true;                                 
             $mail->Username   = $user;                  
             $mail->Password   = $password;                               
             $mail->SMTPSecure = 'tls';        
             $mail->Port       = 587; 
             $mail->SMTPOptions = array ( 
             'ssl' => array ( 
             'verify_peer' => false, 
             'verify_peer_name' => false, 
             'allow_self_signed' => true 
             ) 
             );  
            
             $mail->setFrom($name,$motivo);
             $mail->addAddress($destino);    

             $mail->isHTML(true); 
             $mail->CharSet = 'UTF-8';                               
             $mail->Subject = 'Remito Digital';
             ($modo=== 'remitoRecupero')
             ? $html = require_once '../views/email/equiposRecuperados.php'
             : $html = require_once '../views/email/equiposConsignacion.php';
            
               $mail->Body = $html;

             if($mail->send()){
                $json[] = array();
        
                $json=array(
                    'result' => 1,
                );
                
             }
         } catch (Exception $e) {
            $json[] = array();
        
            $json=array(
                'result' => 2,
            );
           
         }

         $jsonstring=json_encode($json);
         echo $jsonstring;


        }
    }
    public function validateEmailRegister(){

        if($_POST){

        
            $destino = $_POST["m"];
            $id = $_POST["i"];
            $mailpass = $_POST["mh"];
            $pass = $_POST["z"];
            $host = isset($_POST["host"])? $_POST["host"] : 'smtp.gmail.com';
            $user = isset($_POST["user"])? $_POST["user"] : 'informes@postalmarketing.com.ar';
            $password = isset($_POST["password"])? $_POST["password"] : 'decos2020';
            $name = isset($_POST["name"])? $_POST["name"] : 'informes@postalmarketing.com.ar';
            $motivo = isset($_POST["motivo"])? $_POST["motivo"] : 'Gracias por tu postulación';
            $getModo = isset($_POST["md"]) ? $_POST["md"] : false;
            $nombreDestino =  isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $getAsunto =  isset($_POST["as"]) ? $_POST["as"] : false;

            if($getAsunto === 'reonstp'){
              $asunto = 'Bienvenido a Express';
            }
            if( $getModo=== 'regtp'){
                $modo = 'validar_email_registro_primer_paso';
            }


            try{

             $mail = new PHPMailer(true);

             $mail->SMTPDebug = false; 
             $mail->do_debug = 0; 
                               
             $mail->isSMTP();                                            
             $mail->Host       = $host;                    
             $mail->SMTPAuth   = true;                                 
             $mail->Username   = $user;                  
             $mail->Password   = $password;                               
             $mail->SMTPSecure = 'tls';        
             $mail->Port       = 587; 
             $mail->SMTPOptions = array ( 
             'ssl' => array ( 
             'verify_peer' => false, 
             'verify_peer_name' => false, 
             'allow_self_signed' => true 
             ) 
             );  
            
             $mail->setFrom($name,$motivo);
             $mail->addAddress($destino);    

             $mail->isHTML(true); 
             $mail->CharSet = 'UTF-8';                               
             $mail->Subject = $asunto;
             if($modo=== 'validar_email_registro_primer_paso'){
                 $html = require_once '../views/email/trabajo/validateEmail.php';

             } 
               $mail->Body = $html;

             if($mail->send()){
                $json[] = array();
        
                $json=array(
                    'result' => '1',
                );
                
             }
         } catch (Exception $e) {
            $json[] = array();
        
            $json=array(
                'result' => '2',
            );
           
         }

         $jsonstring=json_encode($json);
         echo $jsonstring;


        }

    }
    public function userRegistrationProcess(){

    
        if($_POST){

            $destino = isset($_POST["object"]["mail"]) ?$_POST["object"]["mail"]:false  ;
            $action = isset($_POST["object"]["action"]) ? $_POST["object"]["action"] : false;
            $mailpass = isset($_POST["object"]["idmail"])?$_POST["object"]["idmail"] :false ;
            $id_number = isset($_POST["object"]["idnumber"])?$_POST["object"]["idnumber"]: false;
            $id_user = isset($_POST["object"]["id_user"])?$_POST["object"]["id_user"]: false;
            $host = isset($_POST["host"])? $_POST["host"] : 'smtp.gmail.com';
            $user = isset($_POST["user"])? $_POST["user"] : 'informes@postalmarketing.com.ar';
            $password = isset($_POST["password"])? $_POST["password"] : 'decos2020';
            $name = isset($_POST["name"])? $_POST["name"] : 'informes@postalmarketing.com.ar';
            $motivo = isset($_POST["object"]["motivo"])? $_POST["object"]["motivo"]: false;
            $nombreDestino =  isset($_POST["object"]["name"]) ? $_POST["object"]["name"] : false;
            $getAsunto =  isset($_POST["as"]) ? $_POST["as"] : false;
            $foo = "\xF0\x9F\x94\xA5 Express \xF0\x9F\x94\xA5 ";
            
        
            try{

             $mail = new PHPMailer(true);

             $mail->SMTPDebug = false; 
             $mail->do_debug = 0; 
                               
             $mail->isSMTP();                                            
             $mail->Host       = $host;                    
             $mail->SMTPAuth   = true;                                 
             $mail->Username   = $user;                  
             $mail->Password   = $password;                               
             $mail->SMTPSecure = 'tls';        
             $mail->Port       = 587; 
             $mail->SMTPOptions = array ( 
             'ssl' => array ( 
             'verify_peer' => false, 
             'verify_peer_name' => false, 
             'allow_self_signed' => true 
             ) 
             );  
            
             $mail->setFrom($name,$motivo);
             $mail->addAddress($destino);    

             $mail->isHTML(true); 
             $mail->CharSet = 'UTF-8'; 

             if($action=== 'enviarcontrato'){
                $mail->Subject = $motivo;
                 $html = require_once '../views/email/trabajo/contrato.php';

             }else if($action==='contratoEnviado'){
                $mail->Subject = 'Aviso postulación Express';
                $html = require_once '../views/email/trabajo/avisoContratoEnviado.php';
             } else if($action=== 'mensajeProntoActivo'){
                $mail->Subject = 'Aviso Activo Express';
                $html = require_once '../views/email/trabajo/avisoProntoActivo.php';
             }else if($action=== 'mensajeActivo' || $action=== 'otroAvisoActivo'){
                 
                $mail->Subject = $foo.'Felicitaciones '.$nombreDestino;
                $html = require_once '../views/email/trabajo/avisoActivo.php';
             }else if($action=== 'down'){
                $mail->setFrom($name,'Bajas');
                $mail->Subject = $foo.'Muchas gracias! '.$nombreDestino;
                $html = require_once '../views/email/trabajo/baja.php';
             }
               $mail->Body = $html;

             if($mail->send()){
                $json[] = array();
        
                $json=array(
                    'result' => '1',
                );
                
             }
         } catch (Exception $e) {
            $json[] = array();
        
            $json=array(
                'result' => '2',
            );
           
         }

         $jsonstring=json_encode($json);
         echo $jsonstring;


        }

    }
    public function validateEmailPass(){

        if($_POST){

        $id_user = isset($_POST["object"][0]['i']) ? $_POST["object"][0]['i'] : false ;
        $passHash = isset($_POST["object"][0]['p']) ? $_POST["object"][0]['p'] : false ;
        $mailHash = isset($_POST["object"][0]['mh']) ? $_POST["object"][0]['mh'] : false ;
        $destino = isset($_POST["object"][0]['m']) ? $_POST["object"][0]['m'] : false ;
        $host = isset($_POST["host"])? $_POST["host"] : 'smtp.gmail.com';
        $user = isset($_POST["user"])? $_POST["user"] : 'informes@postalmarketing.com.ar';
        $password = isset($_POST["password"])? $_POST["password"] : 'decos2020';
        $name = isset($_POST["name"])? $_POST["name"] : 'informes@postalmarketing.com.ar';
        $motivo = isset($_POST["motivo"])? $_POST["motivo"] : 'Recuperar contrasena';
        $action = isset($_POST["action"]) ? $_POST["action"] : false;
        $nombreDestino =  isset($_POST["nombre"]) ? $_POST["nombre"] : false;

        try{

            $mail = new PHPMailer(true);

            $mail->SMTPDebug = false; 
            $mail->do_debug = 0; 
                            
            $mail->isSMTP();                                            
            $mail->Host       = $host;                    
            $mail->SMTPAuth   = true;                                 
            $mail->Username   = $user;                  
            $mail->Password   = $password;                               
            $mail->SMTPSecure = 'tls';        
            $mail->Port       = 587; 
            $mail->SMTPOptions = array ( 
            'ssl' => array ( 
            'verify_peer' => false, 
            'verify_peer_name' => false, 
            'allow_self_signed' => true 
            ) 
            );  
        
            $mail->setFrom($name,$motivo);
            $mail->addAddress($destino);    

            $mail->isHTML(true); 
            $mail->CharSet = 'UTF-8'; 

            $mail->Subject = 'Express';
            $html = require_once '../views/email/login/restorePass.php';

            $mail->Body = $html;

            if($mail->send()){
            $json[] = array();
    
            $json=array(
                'result' => '1',
            );
            
            }
        } catch (Exception $e) {

        
        $json[] = array();
    
        $json=array(
            'result' => '2',
        );
        
        }

        $jsonstring=json_encode($json);
        echo $jsonstring;


        }




       
    }

    public function mailNotice(){

        $destino = isset($_POST["contacto"]) ? $_POST["contacto"] : false ;
        $host = isset($_POST["host"])? $_POST["host"] : 'smtp.gmail.com';
        $user = isset($_POST["user"])? $_POST["user"] : 'devolucioncomodato@postalmarketing.com.ar';
        $password = isset($_POST["password"])? $_POST["password"] : 'bajas2020';
        $name = 'devolucioncomodato@postalmarketing.com.ar';
        $identificacion =  isset($_POST["identificacion"]) ? $_POST["identificacion"] : false;
        $empresa = isset($_POST["empresa"]) ? $_POST["empresa"] : false;
        $fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : false;
        $pais = isset($_POST["pais"]) ? $_POST["pais"] : false;
        $aviso = isset($_POST["aviso"]) ? $_POST["aviso"] : false;
        $locate = isset($_POST["locate"]) ? $_POST["locate"] : false;
        $nameCustomer = isset($_POST["nameCustomer"]) ? $_POST["nameCustomer"] : false;
        $URL_IMG= '';
        $footer = '';

        $fechaAcortada = substr($fecha,0,10);

        if($pais === 'Argentina'){

            $footer = '0810-362-283 Lunes a Viernes 8 - 17 hs';
        }

        if($pais === 'Uruguay'){
            $footer = '598 97 438238 Lunes a Viernes 8 - 17 hs';
        }

        
        switch($empresa){
            case 'LAPOS';
               $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/crelapos.png';
               $asuntoSegundario = 'Terminal Pos' ;
               break;
            case 'POSNET';
               $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/creposnet.png';
               $asuntoSegundario = 'Terminal Pos' ;
               break;
            case 'ANTINA';
               $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/creantina.png';
               $asuntoSegundario = 'Decodificador' ;
               break;
            case 'INTV';
               $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/creintv.png';
               $asuntoSegundario = 'Decodificador' ;
               break;
            case 'IPLAN';
               $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/creiplan.png';
               $asuntoSegundario = 'Modem' ;
               break;
            case 'METROTEL';
               $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/cremetrotel.png';
               $asuntoSegundario = 'Modem' ;
               break;
            case 'CABLEVISION';
               $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/crecablevision.png';
               $asuntoSegundario = 'Canalera' ;
               break;
            case 'SUPERCANAL';
               $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/cresupercanal.png';
               $asuntoSegundario = 'Decodificador' ;
               break;
        }

        try{

            $mail = new PHPMailer(true);

            $mail->SMTPDebug = false; 
            $mail->do_debug = 0; 
                            
            $mail->isSMTP();                                            
            $mail->Host       = $host;                    
            $mail->SMTPAuth   = true;                                 
            $mail->Username   = $user;                  
            $mail->Password   = $password;                               
            $mail->SMTPSecure = 'tls';        
            $mail->Port       = 587; 
            $mail->SMTPOptions = array ( 
            'ssl' => array ( 
            'verify_peer' => false, 
            'verify_peer_name' => false, 
            'allow_self_signed' => true 
            ) 
            );  
            
            $mail->setFrom($name,$empresa);
            $mail->addAddress($destino);    

            $mail->isHTML(true); 
            $mail->CharSet = 'UTF-8'; 

            $mail-> Subject = $asuntoSegundario.' /'.' '.$nameCustomer.' - '.' '.$locate;
            if($aviso === 'manana'){
                $html = require_once '../views/email/avisos/tomorrow.php';
            }
            if($aviso === 'ruta'){
                $html = require_once '../views/email/avisos/inRoute.php';
            }
            if($aviso === 'domicilio'){
                $html = require_once '../views/email/avisos/inHome.php';
            }
            
            $mail->Body = $html;

            if($mail->send()){
            $json[] = array();
    
            $json=array(
                'result' => '1',
            );
            
            }
        } catch (Exception $e) {

        
        $json[] = array();
 
        $json=array(
            'result' => '2',
        );
        
        }

        $jsonstring=json_encode($json);
        echo $jsonstring;


        
        
    }

}