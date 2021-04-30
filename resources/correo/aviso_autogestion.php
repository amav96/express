<?php



 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

require '../../resources/phpmailer/phpmailer/src/Exception.php';
require '../../resources/phpmailer/phpmailer/src/PHPMailer.php';
require '../../resources/phpmailer/phpmailer/src/SMTP.php';


 if(!empty($_POST["emailAltRecogida"])){
     $emailAltRecogida=$_POST["emailAltRecogida"];
         DatosParaCorreo($emailAltRecogida);
   }

   if($_POST["emailAltRecogida"] === ''){

        $json[] = array();

        $json=array(
            'result' => 4,
        );

        $jsonstring=json_encode($json);
        echo $jsonstring;
    
  }
   
  


  function DatosParaCorreo($emailAltRecogida){
      
      $identificacionRecogida=$_POST["identificacionBusco"];
      $codigoPostalBusco=$_POST["codigoPostalBusco"];
      $nombreCliente=$_POST["nombreCliente"];
      $provinciaCliente=$_POST["provinciaCliente"];
      $direccionCliente=$_POST["direccionCliente"];
      $localidadCliente=$_POST["localidadCliente"];
      $horaRecogida=$_POST["horaRecogida"];
      $diaRecogida=$_POST["diaRecogida"];
      $cantidadRecogida=$_POST["cantidadRecogida"];
      $caracteristicaRecogida=$_POST["caracteristicaRecogida"];
      $numeroRecogida=$_POST["numeroRecogida"];
      $domicilioAltRecogida=$_POST["domicilioAltRecogida"];
      $emailAltRecogida=$_POST["emailAltRecogida"];
      $identificacionBusco=$_POST["identificacionBusco"];
      $fechaYHoraE=$_POST["fechaYHoraE"]; 
      
      



 $mail = new PHPMailer(true);

 try {
     //Server settings

     $mail->SMTPDebug = false; 
     $mail->do_debug = 0; 
                           // Enable verbose debug output
     $mail->isSMTP();                                            // Send using SMTP
     $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
     $mail->Username   = 'informes@postalmarketing.com.ar';                     // SMTP username
     $mail->Password   = 'informes';                               // SMTP password
     $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
     $mail->Port       = 587; 
     $mail->SMTPOptions = array ( 
        'ssl' => array ( 
        'verify_peer' => false, 
        'verify_peer_name' => false, 
        'allow_self_signed' => true 
        ) 
        );                                   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
     //Recipients
     $mail->setFrom('alvaroamav96@gmail.com', 'Informes-Express');
     $mail->addAddress($emailAltRecogida);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
     //$mail->addCC('cc@example.com');
     //$mail->addBCC('bcc@example.com');
 
     // Attachments
     //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
     //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
 
     // Content
     $mail->isHTML(true); 
     $mail->CharSet = 'UTF-8';                                 // Set email format to HTML
     $mail->Subject = 'comprobante';
     $mail->Body ='<!DOCTYPE html>
     <html>
     
     <head>
         <title></title>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta http-equiv="X-UA-Compatible" content="IE=edge" />
         <style type="text/css">
             body,
             table,
             td,
             a {
                 -webkit-text-size-adjust: 100%;
                 -ms-text-size-adjust: 100%;
             }
     
             table,
             td {
                 mso-table-lspace: 0pt;
                 mso-table-rspace: 0pt;
             }
     
             img {
                 -ms-interpolation-mode: bicubic;
             }
     
             img {
                 border: 0;
                 height: auto;
                 line-height: 100%;
                 outline: none;
                 text-decoration: none;
             }
     
             table {
                 border-collapse: collapse !important;
             }
     
             body {
                 height: 100% !important;
                 margin: 0 !important;
                 padding: 0 !important;
                 width: 100% !important;
             }
     
             a[x-apple-data-detectors] {
                 color: inherit !important;
                 text-decoration: none !important;
                 font-size: inherit !important;
                 font-family: inherit !important;
                 font-weight: inherit !important;
                 line-height: inherit !important;
             }
     
             @media screen and (max-width: 480px) {
                 .mobile-hide {
                     display: none !important;
                 }
     
                 .mobile-center {
                     text-align: left !important;
                 }
             }
     
             div[style*="margin: 16px 0;"] {
                 margin: 0 !important;
             }
         </style>
     
     <body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">
         <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
             Remito Electronico.
         </div>
         <table border="0" cellpadding="0" cellspacing="0" width="100%">
             <tr>
                 <td align="left" style="background-color: #eeeeee;" bgcolor="#eeeeee">
                     
                                 </div>
                                 <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;" class="mobile-hide">
                                     <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                         <tr>
                                             <td align="right" valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                                                 <table cellspacing="0" cellpadding="0" border="0" align="right">
                                                     
                                                 </table>
                                             </td>
                                         </tr>
                                     </table>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                     <tr>
                                         <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                                             <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Gracias por su atención! </h2>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                             <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;text-align: center">Queda a disposición su remito electronico.</p>
                                         </td>
                                     </tr>
                                    
                         </tr>
                         <tr>
                             <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                 
                             </td>
                         </tr>
                         <tr>
                             <td align="center" style=" padding: 35px; background-color: #67CAF9;" bgcolor="#1b9ba3">
                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                     <tr>
                                         <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                             <h2 style="font-size: 24px; font-weight: 800; line-height: 30px; color: #ffffff; margin: 0;"> Haga Click en DESCARGAR. </h2>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td align="center" style="padding: 25px 0 15px 0;">
                                             <table border="0" cellspacing="0" cellpadding="0">
                                                 <tr>
                                                     <td align="center" style="border-radius: 5px;" bgcolor="#66b3b7"> <a href="wwww.postalmarketing.com.ar/pdfsend/pdfpowerconfirmar.php?cod_orden=' .$identificacionRecogida. '&submit=send" target="_blank" style="font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #F44336; padding: 15px 30px; border: 1px solid #F44336; display: block;">DESCARGAR</a> </td>
                                                 </tr>
                                             </table>
                                         </td>
                                     </tr>
                                 </table>
                             </td>
                         </tr>
                         <tr>
                             <td align="center" style="padding: 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                     
                                     <tr>
                                         <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px; padding: 5px 0 10px 0;">
                                             <p style="font-size: 14px; font-weight: 800; line-height: 18px; color: #333333;">
                                         </td>
                                     </tr>
                                     <tr>
                                         <td align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                                             
                                         </td>
                                     </tr>
                                 </table>
                             </td>
                         </tr>
                     </table>
                 </td>
             </tr>
         </table>
     </body>
     
     </html>
     
     
     
     ';
     
 
     if(!$mail->send()){
        $json[] = array();

        $json=array(
            'result' => 2,
        );

        $jsonstring=json_encode($json);
        echo $jsonstring;
     }
     if($mail->send()){
        $json[] = array();

        $json=array(
            'result' => 1,
        );
        $jsonstring=json_encode($json);
        echo $jsonstring;
     }
 } catch (Exception $e) {
    $json[] = array();

    $json=array(
        'result' => 3,
    );
    $jsonstring=json_encode($json);
    echo $jsonstring;
 }

}

