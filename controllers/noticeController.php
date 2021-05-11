<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['notice'])) {

  require '../resources/phpmailer/phpmailer/src/Exception.php';
  require '../resources/phpmailer/phpmailer/src/PHPMailer.php';
  require '../resources/phpmailer/phpmailer/src/SMTP.php';

  require_once '../model/notice.php';
  require_once '../config/db.php';
  require_once '../helpers/utils.php';
  require_once "../vendor/autoload.php";

  session_start();
  $accion = $_GET['notice'];
  $notice = new noticeController();
  $notice->$accion();
} else {

  require_once 'model/notice.php';
  require 'resources/phpmailer/phpmailer/src/Exception.php';
  require 'resources/phpmailer/phpmailer/src/PHPMailer.php';
  require 'resources/phpmailer/phpmailer/src/SMTP.php';
  require_once "vendor/autoload.php";
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class noticeController
{

  public function avisos()
  {
    Utils::AuthOperative();
    $info = $this->detect();
    require_once 'views/avisos/avisos.php';
  }

  public function admin()
  {

    Utils::AuthAdmin();
    $info = $this->detect();
    require_once 'vue/src/view/admin/avisos.php';
  }

  public function setNotice()
  {
    if ($_POST) {

      $aviso = isset($_POST['aviso']) ? $_POST['aviso'] : false;
      $contacto = isset($_POST['contacto']) ? $_POST['contacto'] : false;
      $country = isset($_POST['country']) ? $_POST['country'] : false;
      $created_at = isset($_POST['created_at']) ? $_POST['created_at'] : false;
      $order = isset($_POST['order']) ? $_POST['order'] : false;
      $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : false;
      $identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : false;
      $lat = isset($_POST['lat']) ? $_POST['lat'] : false;
      $lng = isset($_POST['lng']) ? $_POST['lng'] : false;
      $medio = isset($_POST['medio']) ? $_POST['medio'] : false;


      $setNotice = new Notice();
      $setNotice->setAviso($aviso);
      $setNotice->setContacto($contacto);
      $setNotice->setCountry($country);
      $setNotice->setCreated_at($created_at);
      $setNotice->setOrder($order);
      $setNotice->setId_user($id_user);
      $setNotice->setIdentificacion($identificacion);
      $setNotice->setLat($lat);
      $setNotice->setLng($lng);
      $setNotice->setMedio($medio);
      $setNotice = $setNotice->setNotice();

      if ($setNotice) {

        $object[] = array(
          'result' => true
        );
      } else {

        $object[] = array(
          'result' => false
        );
      }

      $jsonstring = json_encode($object);
      echo $jsonstring;
    }
  }

  public function setNoticeLoop()
  {
    if ($_POST) {


      $aviso = isset($_POST['aviso']) ? $_POST['aviso'] : false;
      $contacto = isset($_POST['contacto']) ? $_POST['contacto'] : false;
      $country = isset($_POST['country']) ? $_POST['country'] : false;
      $created_at = isset($_POST['created_at']) ? $_POST['created_at'] : false;
      $order = isset($_POST['order']) ? $_POST['order'] : false;
      $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : false;
      $identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : false;
      $lat = isset($_POST['lat']) ? $_POST['lat'] : false;
      $lng = isset($_POST['lng']) ? $_POST['lng'] : false;
      $medio = isset($_POST['medio']) ? $_POST['medio'] : false;
      $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : false;
      $nameCustomer = isset($_POST['nameCustomer']) ? $_POST['nameCustomer'] : false;
      $locate = isset($_POST['locate']) ? $_POST['locate'] : false;


      $search = strpos($contacto, ',');
      if (!$search) {
        // Si hay solo un correo
        $objectSend = [
          'aviso' => $aviso,
          'contacto' => $contacto,
          'empresa' => $empresa,
          'fecha' => $created_at,
          'pais' => $country,
          'aviso' => $aviso,
          'locate' => $locate,
          'nameCustomer' => $nameCustomer,
          'identificacion' => $identificacion
        ];

        $emailSendLoop = $this->emailSendLoop($objectSend);
        if ($emailSendLoop) {

          $setNotice = new Notice();
          $setNotice->setAviso($aviso);
          $setNotice->setContacto($contacto);
          $setNotice->setCountry($country);
          $setNotice->setCreated_at($created_at);
          $setNotice->setOrder($order);
          $setNotice->setId_user($id_user);
          $setNotice->setIdentificacion($identificacion);
          $setNotice->setLat($lat);
          $setNotice->setLng($lng);
          $setNotice->setMedio($medio);
          $setNotice = $setNotice->setNotice();
          if ($setNotice) {
            $response = array(
              'result' => true
            );
          } else {
            $response = array(
              'result' => false
            );
          }
        }
      } else {
        // Si hay mas de un correo 
        $convertContactArray = explode(',', $contacto);
        $countArray = sizeof($convertContactArray);
        $countForResponse = $countArray;

        for ($i = 0; $i < $countArray; $i++) {

          $objectSend = [
            'aviso' => $aviso,
            'contacto' => $convertContactArray[$i],
            'empresa' => $empresa,
            'fecha' => $created_at,
            'pais' => $country,
            'aviso' => $aviso,
            'locate' => $locate,
            'nameCustomer' => $nameCustomer,
            'identificacion' => $identificacion
          ];

          $emailSendLoop = $this->emailSendLoop($objectSend);
          if ($emailSendLoop) {
            $countForResponse--;
            $setNotice = new Notice();
            $setNotice->setAviso($aviso);
            $setNotice->setContacto($convertContactArray[$i]);
            $setNotice->setCountry($country);
            $setNotice->setCreated_at($created_at);
            $setNotice->setOrder($order);
            $setNotice->setId_user($id_user);
            $setNotice->setIdentificacion($identificacion);
            $setNotice->setLat($lat);
            $setNotice->setLng($lng);
            $setNotice->setMedio($medio);
            $setNotice = $setNotice->setNotice();
          }
        }
        if ($countForResponse === 0 && $setNotice) {
          $response = array(
            'result' => true
          );
          // si es igual a cero es porque a medida que se envia el email va restando a la cantidad de email por enviar

        } else {
          $response = array(
            'result' => false
          );
        }
      }

      $jsonstring = json_encode($response);
      echo $jsonstring;
    }
  }

  public function setNoticeManagement()
  {
    if ($_POST) {

      $aviso = isset($_POST['aviso']) ? $_POST['aviso'] : false;
      $contacto = isset($_POST['contacto']) ? $_POST['contacto'] : false;
      $country = isset($_POST['country']) ? $_POST['country'] : false;
      $created_at = isset($_POST['created_at']) ? $_POST['created_at'] : false;
      $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : false;
      $identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : false;
      $lat = isset($_POST['lat']) ? $_POST['lat'] : false;
      $lng = isset($_POST['lng']) ? $_POST['lng'] : false;
      $medio = isset($_POST['medio']) ? $_POST['medio'] : false;


      $setNoticeManagement = new Notice();
      $setNoticeManagement->setAviso($aviso);
      $setNoticeManagement->setContacto($contacto);
      $setNoticeManagement->setCountry($country);
      $setNoticeManagement->setCreated_at($created_at);
      $setNoticeManagement->setId_user($id_user);
      $setNoticeManagement->setIdentificacion($identificacion);
      $setNoticeManagement->setLat($lat);
      $setNoticeManagement->setLng($lng);
      $setNoticeManagement->setMedio($medio);
      $setNoticeManagement = $setNoticeManagement->setNoticeManagement();

      if ($setNoticeManagement) {

        $object[] = array(
          'result' => true
        );
      } else {

        $object[] = array(
          'result' => false
        );
      }

      $jsonstring = json_encode($object);
      echo $jsonstring;
    }
  }

  public function setNoticeManagementLoop()
  {
    if ($_POST) {

      $aviso = isset($_POST['aviso']) ? $_POST['aviso'] : false;
      $contacto = isset($_POST['contacto']) ? $_POST['contacto'] : false;
      $country = isset($_POST['country']) ? $_POST['country'] : false;
      $created_at = isset($_POST['created_at']) ? $_POST['created_at'] : false;
      $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : false;
      $identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : false;
      $lat = isset($_POST['lat']) ? $_POST['lat'] : false;
      $lng = isset($_POST['lng']) ? $_POST['lng'] : false;
      $medio = isset($_POST['medio']) ? $_POST['medio'] : false;
      $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : false;
      $nameCustomer = isset($_POST['nameCustomer']) ? $_POST['nameCustomer'] : false;
      $locate = isset($_POST['locate']) ? $_POST['locate'] : false;


      $search = strpos($contacto, ',');
      if (!$search) {
        // Si hay solo un correo
        $objectSend = [
          'aviso' => $aviso,
          'contacto' => $contacto,
          'empresa' => $empresa,
          'fecha' => $created_at,
          'pais' => $country,
          'aviso' => $aviso,
          'locate' => $locate,
          'nameCustomer' => $nameCustomer,
          'identificacion' => $identificacion
        ];

        $emailSendLoop = $this->emailSendLoop($objectSend);
        if ($emailSendLoop) {

          $setNoticeManagement = new Notice();
          $setNoticeManagement->setAviso($aviso);
          $setNoticeManagement->setContacto($contacto);
          $setNoticeManagement->setCountry($country);
          $setNoticeManagement->setCreated_at($created_at);
          $setNoticeManagement->setId_user($id_user);
          $setNoticeManagement->setIdentificacion($identificacion);
          $setNoticeManagement->setLat($lat);
          $setNoticeManagement->setLng($lng);
          $setNoticeManagement->setMedio($medio);
          $setNoticeManagement = $setNoticeManagement->setNoticeManagement();
          if ($setNoticeManagement) {
            $response = array(
              'result' => true
            );
          } else {
            $response = array(
              'result' => false
            );
          }
        }
      } else {
        // Si hay mas de un correo 
        $convertContactArray = explode(',', $contacto);
        $countArray = sizeof($convertContactArray);
        $countForResponse = $countArray;

        for ($i = 0; $i < $countArray; $i++) {

          $objectSend = [
            'aviso' => $aviso,
            'contacto' => $convertContactArray[$i],
            'empresa' => $empresa,
            'fecha' => $created_at,
            'pais' => $country,
            'aviso' => $aviso,
            'locate' => $locate,
            'nameCustomer' => $nameCustomer,
            'identificacion' => $identificacion
          ];

          $emailSendLoop = $this->emailSendLoop($objectSend);
          if ($emailSendLoop) {
            $countForResponse--;
            $setNoticeManagement = new Notice();
            $setNoticeManagement->setAviso($aviso);
            $setNoticeManagement->setContacto($convertContactArray[$i]);
            $setNoticeManagement->setCountry($country);
            $setNoticeManagement->setCreated_at($created_at);
            $setNoticeManagement->setId_user($id_user);
            $setNoticeManagement->setIdentificacion($identificacion);
            $setNoticeManagement->setLat($lat);
            $setNoticeManagement->setLng($lng);
            $setNoticeManagement->setMedio($medio);
            $setNoticeManagement = $setNoticeManagement->setNoticeManagement();
          }
        }
        if ($countForResponse === 0 && $setNoticeManagement) {
          $response = array(
            'result' => true
          );
          // si es igual a cero es porque a medida que se envia el email va restando a la cantidad de email por enviar

        } else {
          $response = array(
            'result' => false
          );
        }
      }

      $jsonstring = json_encode($response);
      echo $jsonstring;
    }
  }

  public function emailSendLoop($Request)
  {

    $credentials = $this->countAndChangeEmail();
    $email = $credentials->email;
    $password = $credentials->password;

    $destino = $Request["contacto"];
    $host = 'smtp.gmail.com';
    $user = $email;
    $password = $password;
    $name = $email;
    $identificacion =  $Request["identificacion"];
    $empresa = $Request["empresa"];
    $fecha = $Request["fecha"];
    $pais = $Request["pais"];
    $aviso = $Request["aviso"];
    $locate = $Request["locate"];
    $nameCustomer = $Request["nameCustomer"];
    $URL_IMG = '';
    $footer = '';

    $fechaAcortada = substr($fecha, 0, 10);

    if ($pais === 'Argentina') {

      $footer = '0810-362-283 Lunes a Viernes 8 - 17 hs';
    }

    if ($pais === 'Uruguay') {
      $footer = '598 97 438238 Lunes a Viernes 8 - 17 hs';
    }

    switch ($empresa) {
      case 'LAPOS';
        $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/crelapos.png';
        $asuntoSegundario = 'Terminal Pos';
        break;
      case 'POSNET';
        $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/creposnet.png';
        $asuntoSegundario = 'Terminal Pos';
        break;
      case 'ANTINA';
        $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/creantina.png';
        $asuntoSegundario = 'Decodificador';
        break;
      case 'INTV';
        $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/creintv.png';
        $asuntoSegundario = 'Decodificador';
        break;
      case 'IPLAN';
        $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/creiplan.png';
        $asuntoSegundario = 'Modem';
        break;
      case 'METROTEL';
        $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/cremetrotel.png';
        $asuntoSegundario = 'Modem';
        break;
      case 'CABLEVISION';
        $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/crecablevision.png';
        $asuntoSegundario = 'Canalera';
        break;
      case 'SUPERCANAL' || 'SUPER CANAL';
        $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/cresupercanal.png';
        $asuntoSegundario = 'Decodificador';
        break;
      case 'MOVISTAR';
        $URL_IMG = 'https://devuelvoya.com/estilos/imagenes/empresas/cremovistar.png';
        $asuntoSegundario = 'Decodificador';
        break;
    }


    $infoTemplate = (object) [
      'identificacion' => $identificacion,
      'empresa' => $empresa,
      'footer' => $footer,
      'URL_IMG' => $URL_IMG,
      'fechaAcortada' => $fechaAcortada,
    ];
    try {

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
      $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

      $mail->setFrom($name, $empresa);
      $mail->addAddress($destino);

      $mail->isHTML(true);
      $mail->CharSet = 'UTF-8';

      $mail->Subject = $asuntoSegundario . ' /' . ' ' . $nameCustomer . ' - ' . ' ' . $locate;
      if ($aviso === 'manana') {
        $html = $this->tomorrow($infoTemplate);
      }
      if ($aviso === 'ruta') {
        $html = $this->inRoute($infoTemplate);
      }
      if ($aviso === 'domicilio') {
        $html = $this->inHome($infoTemplate);
      }

      $mail->Body = $html;
      if ($mail->send()) {
        $data = [
          'result' => true
        ];
      }
    } catch (Exception $e) {
      $data = [
        'result' => false
      ];
    }
    return $data;
  }
  public function searchNewSection()
  {
    if ($_POST) {
      $id = isset($_POST['id_user']) ? $_POST['id_user'] : false;

      $searchNewSection = new Notice();

      $searchNewSection->setId_user($id);
      $searchNewSection =  $searchNewSection->searchNewSection();

      if ($searchNewSection) {

        $object[] = array(
          'result' => true
        );
      } else {
        $object[] = array(
          'result' => false
        );
      }

      $jsonstring = json_encode($object);
      echo $jsonstring;
    }
  }
  public function removeNewSection()
  {
    if ($_POST) {
      $id = isset($_POST['id_user']) ? $_POST['id_user'] : false;

      $removeNewSection = new Notice();
      $removeNewSection->setId_user($id);
      $removeNewSection = $removeNewSection->removeNewSection();

      if ($removeNewSection) {

        $object[] = array(
          'result' => true
        );
      } else {
        $object[] = array(
          'result' => false
        );
      }

      $jsonstring = json_encode($object);
      echo $jsonstring;
    }
  }

  public function emptyContact()
  {
    if ($_POST) {

      $postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : false;

      $emptyContact = new Notice();
      $emptyContact->setPostalCode($postal_code);
      $emptyContact = $emptyContact->emptyContact();

      if (is_object($emptyContact)) {

        foreach ($emptyContact as $element) {

          $object[] = array(
            'result' => true,
            'telefono' => $element["telefono"]
          );
        }
      } else {
        $object[] = array(
          'result' => false
        );
      }

      $jsonstring = json_encode($object);
      echo $jsonstring;
    }
  }

  //COUNT NOTICES

  public function countNoticeByWord()
  {

    if ($_GET) {
      $word = isset($_GET['word']) ? $_GET['word'] : false;

      $countNoticeByWord = new Notice();
      $countNoticeByWord->setWord($word);
      $countNoticeByWord = $countNoticeByWord->countNoticeByWord();

      if (is_object($countNoticeByWord)) {

        foreach ($countNoticeByWord as $element)

          $objeto = array(
            'result' => true,
            'count' => $element["count"]
          );
      } else {
        $objeto = array(
          'result' => false,
        );
      }

      $jsonstring = json_encode($objeto);
      echo $jsonstring;
    }
  }

  public function countNoticeRangeDate()
  {

    if ($_GET) {

      $dateStart = isset($_GET['dateStart']) ? $_GET['dateStart'] : false;
      $dateEnd = isset($_GET['dateEnd']) ? $_GET['dateEnd'] : false;

      $countNoticeRangeDate = new Notice();
      $countNoticeRangeDate->setDateStart($dateStart);
      $countNoticeRangeDate->setDateEnd($dateEnd);
      $countNoticeRangeDate = $countNoticeRangeDate->countNoticeRangeDate();

      if (is_object($countNoticeRangeDate)) {

        foreach ($countNoticeRangeDate as $element)

          $objeto = array(
            'result' => true,
            'count' => $element["count"]
          );
      } else {
        $objeto = array(
          'result' => false,
        );
      }

      $jsonstring = json_encode($objeto);
      echo $jsonstring;
    }
  }

  public function countNoticeRangeDateAndWord()
  {

    if ($_GET) {

      $dateStart = isset($_GET['dateStart']) ? $_GET['dateStart'] : false;
      $dateEnd = isset($_GET['dateEnd']) ? $_GET['dateEnd'] : false;
      $word = isset($_GET['word']) ? $_GET['word'] : false;

      $countNoticeRangeDateAndWord = new Notice();
      $countNoticeRangeDateAndWord->setDateStart($dateStart);
      $countNoticeRangeDateAndWord->setDateEnd($dateEnd);
      $countNoticeRangeDateAndWord->setId_recolector($word);
      $countNoticeRangeDateAndWord = $countNoticeRangeDateAndWord->countNoticeRangeDateAndWord();

      if (is_object($countNoticeRangeDateAndWord)) {

        foreach ($countNoticeRangeDateAndWord as $element)

          $objeto = array(
            'result' => true,
            'count' => $element["count"]
          );
      } else {
        $objeto = array(
          'result' => false,
        );
      }

      $jsonstring = json_encode($objeto);
      echo $jsonstring;
    }
  }

  //FILTER COUNT CONTROLLER
  public function  countFilterSearchController()
  {

    if ($_GET) {

      $dataRequest = json_decode($_GET['dataRequest']);
      $dateStart = isset($dataRequest->dateStart) ? $dataRequest->dateStart : false;
      $dateEnd = isset($dataRequest->dateEnd) ? $dataRequest->dateEnd : false;
      $filter = isset($dataRequest->filter) ? $dataRequest->filter : false;
      $word = isset($dataRequest->word) ? $dataRequest->word : false;


      if ($dateStart && $dateEnd  && $filter && !$word) {
        // busqueda por fecha y filtro
        $countFilterSearchController =  new Notice();
        $countFilterSearchController->setDateStart($dateStart);
        $countFilterSearchController->setDateEnd($dateEnd);
        $countFilterSearchController->setFilter($filter);
        $countFilterSearchController = $countFilterSearchController->countFilterToNoticeByDateAndFilter();
      }

      // if(!$dateStart && !$dateEnd && $word && $filter){
      //     $countFilterSearchController =  new Notice();
      //     $countFilterSearchController->setFilter($filter);
      //     $countFilterSearchController= $countFilterSearchController->countFilterToGestionByFilter();

      // }

      if ($dateStart && $dateEnd && $word && $filter) {
        // busqueda por fecha , palabra(recolector) Y  filtro
        $countFilterSearchController =  new Notice();
        $countFilterSearchController->setDateStart($dateStart);
        $countFilterSearchController->setDateEnd($dateEnd);
        $countFilterSearchController->setWord($word);
        $countFilterSearchController->setFilter($filter);
        $countFilterSearchController = $countFilterSearchController->countFilterToNoticeByWordAndDateAndFilter();
      }


      if (is_object($countFilterSearchController)) {

        foreach ($countFilterSearchController as $element) {

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

  //DATA NOTICES

  public function noticeByWord()
  {

    if ($_GET) {

      $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false;
      $request =  json_decode($dataRequest);

      $word = !empty($request->word) ? $request->word : false;
      $fromRow = $request->fromRow;
      $limit = $request->limit;

      $noticeByWord = new Notice();
      $noticeByWord->setWord($word);
      $noticeByWord->setFromRow($fromRow);
      $noticeByWord->setLimit($limit);
      $noticeByWord = $noticeByWord->noticeByWord();

      if (is_object($noticeByWord)) {

        foreach ($noticeByWord as $element)

          $objeto[] = array(
            'result' => true,
            'id' => $element["id"],
            'direccion' => $element["direccion"],
            'localidad' => $element["localidad"],
            'provincia' => $element["provincia"],
            'nombre_cliente' => $element["nombre_cliente"],
            'aviso' => $element["aviso"],
            'contacto' => $element["contacto"],
            'country' => $element["country"],
            'id_user' => $element["id_user"],
            'name' => $element["name"],
            'identificacion' => $element["identificacion"],
            'latAviso' => $element["latAviso"],
            'lngAviso' => $element["lngAviso"],
            'means' => $element["means"],
            'fecha_aviso_visita' => $element["created_at"],
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

  public function noticeRangeDate()
  {

    if ($_GET) {

      $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false;
      $request =  json_decode($dataRequest);

      $dateStart = !empty($request->dateStart) ? $request->dateStart : false;
      $dateEnd = !empty($request->dateEnd) ? $request->dateEnd : false;
      $fromRow = $request->fromRow;
      $limit = $request->limit;


      $noticeRangeDate = new Notice();
      $noticeRangeDate->setDateStart($dateStart);
      $noticeRangeDate->setDateEnd($dateEnd);
      $noticeRangeDate->setFromRow($fromRow);
      $noticeRangeDate->setLimit($limit);
      $noticeRangeDate = $noticeRangeDate->noticeRangeDate();

      if (is_object($noticeRangeDate)) {

        foreach ($noticeRangeDate as $element)

          $objeto[] = array(
            'result' => true,
            'id' => $element["id"],
            'direccion' => $element["direccion"],
            'localidad' => $element["localidad"],
            'provincia' => $element["provincia"],
            'nombre_cliente' => $element["nombre_cliente"],
            'aviso' => $element["aviso"],
            'contacto' => $element["contacto"],
            'country' => $element["country"],
            'id_user' => $element["id_user"],
            'name' => $element["name"],
            'identificacion' => $element["identificacion"],
            'latAviso' => $element["latAviso"],
            'lngAviso' => $element["lngAviso"],
            'means' => $element["means"],
            'fecha_aviso_visita' => $element["created_at"],
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

  public function noticeRangeDateAndWord()
  {

    if ($_GET) {

      $dataRequest = isset($_GET['dataRequest']) ? $_GET['dataRequest'] : false;
      $request =  json_decode($dataRequest);
      $dateStart = !empty($request->dateStart) ? $request->dateStart : false;
      $dateEnd = !empty($request->dateEnd) ? $request->dateEnd : false;
      $word = !empty($request->word) ? $request->word : false;

      $fromRow = $request->fromRow;
      $limit = $request->limit;

      $noticeRangeDateAndWord = new Notice();
      $noticeRangeDateAndWord->setDateStart($dateStart);
      $noticeRangeDateAndWord->setDateEnd($dateEnd);
      $noticeRangeDateAndWord->setWord($word);
      $noticeRangeDateAndWord->setFromRow($fromRow);
      $noticeRangeDateAndWord->setLimit($limit);
      $noticeRangeDateAndWord = $noticeRangeDateAndWord->noticeRangeDateAndWord();

      if (is_object($noticeRangeDateAndWord)) {

        foreach ($noticeRangeDateAndWord as $element)

          $objeto[] = array(
            'result' => true,
            'id' => $element["id"],
            'direccion' => $element["direccion"],
            'localidad' => $element["localidad"],
            'provincia' => $element["provincia"],
            'nombre_cliente' => $element["nombre_cliente"],
            'aviso' => $element["aviso"],
            'contacto' => $element["contacto"],
            'country' => $element["country"],
            'id_user' => $element["id_user"],
            'name' => $element["name"],
            'identificacion' => $element["identificacion"],
            'latAviso' => $element["latAviso"],
            'lngAviso' => $element["lngAviso"],
            'means' => $element["means"],
            'fecha_aviso_visita' => $element["created_at"],
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

  //FILTER DATA CONTROLLER
  public function getDataSearchWordNoticeController()
  {

    if ($_GET) {

      $dataRequest = json_decode($_GET['dataRequest']);

      $dateStart = isset($dataRequest->dateStart) ? $dataRequest->dateStart : false;
      $dateEnd = isset($dataRequest->dateEnd) ? $dataRequest->dateEnd : false;
      $filter = isset($dataRequest->filter) ? $dataRequest->filter : false;
      $word = isset($dataRequest->word) ? $dataRequest->word : false;
      $fromRow = isset($dataRequest->fromRow) ? $dataRequest->fromRow : false;
      $limit = isset($dataRequest->limit) ? $dataRequest->limit : false;

      if ($dateStart && $dateEnd && $filter && !$word) {
        // buscar por fecha y filtro
        $getDataSearchWordGestionController =  new Notice();
        $getDataSearchWordGestionController->setDateStart($dateStart);
        $getDataSearchWordGestionController->setDateEnd($dateEnd);
        $getDataSearchWordGestionController->setFilter($filter);
        $getDataSearchWordGestionController->setFromRow($fromRow);
        $getDataSearchWordGestionController->setLimit($limit);
        $getDataSearchWordGestionController = $getDataSearchWordGestionController->getDataFilterToNoticeByDateAndFilter();
      }
      if ($dateStart && $dateEnd && $filter && $word) {

        $getDataSearchWordGestionController =  new Notice();
        $getDataSearchWordGestionController->setDateStart($dateStart);
        $getDataSearchWordGestionController->setDateEnd($dateEnd);
        $getDataSearchWordGestionController->setId_recolector($word);
        $getDataSearchWordGestionController->setFilter($filter);
        $getDataSearchWordGestionController->setFromRow($fromRow);
        $getDataSearchWordGestionController->setLimit($limit);
        $getDataSearchWordGestionController = $getDataSearchWordGestionController->getDataFilterToNoticeByDateAndWordAndFilter();
      }

      // if(!$dateStart && !$dateEnd && $filter){

      //     $getDataSearchWordGestionController =  new Notice();
      //     $getDataSearchWordGestionController->setFilter($filter);
      //     $getDataSearchWordGestionController->setFromRow($fromRow);
      //     $getDataSearchWordGestionController->setLimit($limit);
      //     $getDataSearchWordGestionController = $getDataSearchWordGestionController->getDataFilterToGestionByWord();
      // }


      if (is_object($getDataSearchWordGestionController)) {

        foreach ($getDataSearchWordGestionController as $element) {

          $objeto[] = array(
            'result' => true,
            'id' => $element["id"],
            'direccion' => $element["direccion"],
            'localidad' => $element["localidad"],
            'provincia' => $element["provincia"],
            'nombre_cliente' => $element["nombre_cliente"],
            'aviso' => $element["aviso"],
            'contacto' => $element["contacto"],
            'country' => $element["country"],
            'id_user' => $element["id_user"],
            'name' => $element["name"],
            'identificacion' => $element["identificacion"],
            'latAviso' => $element["latAviso"],
            'lngAviso' => $element["lngAviso"],
            'means' => $element["means"],
            'fecha_aviso_visita' => $element["created_at"],
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
  //EXPORT EXCEL 

  public function exportNotice()
  {
    if ($_GET) {

      $dataRequest = json_decode($_GET['dataRequest']);
      $dateStart = !empty($dataRequest->dateStart) ? $dataRequest->dateStart : false;
      $dateEnd = !empty($dataRequest->dateEnd) ? $dataRequest->dateEnd : false;
      $filter = !empty($dataRequest->filter) ? $dataRequest->filter : false;
      $word = !empty($dataRequest->word) ? $dataRequest->word : false;

      if ($word && !$dateStart && !$dateEnd && !$filter) {
        //busqueda input word(identificacion,terminal,serie,etc)
        $exportNotice =  new Notice();
        $exportNotice->setWord($word);
        $exportNotice =  $exportNotice->getDataManagementExportByWord();
      }

      if ($dateStart && $dateEnd && !$filter && !$word) {
        //busqueda inputs rango de fecha
        $exportNotice =  new Notice();
        $exportNotice->setDateStart($dateStart);
        $exportNotice->setDateEnd($dateEnd);
        $exportNotice =  $exportNotice->getDataNoticeExportByDateRange();
      }

      if ($dateStart && $dateEnd && $filter && !$word) {
        //busqueda inputs rango de fecha y filtro

        $exportNotice =  new Notice();
        $exportNotice->setDateStart($dateStart);
        $exportNotice->setDateEnd($dateEnd);
        $exportNotice->setFilter($filter);
        $exportNotice =  $exportNotice->getDataNoticeExportByDateRangeAndFilter();
      }

      if ($dateStart && $dateEnd && $word && !$filter) {
        //busqueda inputs rango de fecha y palabra(recolector)
        $exportNotice =  new Notice();
        $exportNotice->setDateStart($dateStart);
        $exportNotice->setDateEnd($dateEnd);
        $exportNotice->setId_recolector($word);
        $exportNotice =  $exportNotice->getDataManagementExportByDateRangeAndWord();
      }

      if ($dateStart && $dateEnd && $word && $filter) {
        //busqueda inputs rango de fecha , palabra(recolector) y filtro
        $exportNotice =  new Notice();
        $exportNotice->setDateStart($dateStart);
        $exportNotice->setDateEnd($dateEnd);
        $exportNotice->setId_recolector($word);
        $exportNotice->setFilter($filter);
        $exportNotice =  $exportNotice->getDataManagementExportByDateRangeAndWordAndFilter();
      }

      if (is_object($exportNotice)) {

        $response = $this->excelNoticetManagement($exportNotice);
        if ($response) {
          $objectResponse = array(
            'result' => true,
            'path' => $response
          );
        } else {
          $objectResponse = array(
            'result' => false
          );
        }
      }
      $jsonString = json_encode($objectResponse);
      echo $jsonString;
    }
  }

  public function excelNoticetManagement($exportNotice)
  {

    foreach ($exportNotice as $element) {
      $arrayRow[] =  array(
        'id' => $element["id"],
        'direccion' => $element["direccion"],
        'localidad' => $element["localidad"],
        'provincia' => $element["provincia"],
        'nombre_cliente' => $element["nombre_cliente"],
        'aviso' => $element["means"],
        'contacto' => $element["contacto"],
        'country' => $element["country"],
        'id_user' => $element["id_user"],
        'name' => $element["name"],
        'identificacion' => $element["identificacion"],
        'latAviso' => $element["latAviso"],
        'lngAviso' => $element["lngAviso"],
        'fecha_aviso_visita' => $element["fecha_aviso_visita"],
      );
    }
    $header = array(
      'id',
      'direccion',
      'localidad',
      'provincia',
      'nombre_cliente',
      'aviso',
      'contacto',
      'Pais',
      'id recolector',
      'Nombre recolector',
      'Identificacion',
      'lat',
      'lng',
      'fecha',

    );
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray([$header], NULL, 'A1');

    $columnArray = array_chunk($arrayRow, 1);
    $rowCount = 1;
    foreach ($columnArray as $element) {
      $rowCount++;
      $lat = (string)$element[0]["latAviso"];
      $lng = (string)$element[0]["lngAviso"];
      $sheet->setCellValue('A' . $rowCount, $element[0]["id"]);
      $sheet->setCellValue('B' . $rowCount, $element[0]["direccion"]);
      $sheet->setCellValue('C' . $rowCount, $element[0]["localidad"]);
      $sheet->setCellValue('D' . $rowCount, $element[0]["provincia"]);
      $sheet->setCellValue('E' . $rowCount, $element[0]["nombre_cliente"]);
      $sheet->setCellValue('F' . $rowCount, $element[0]["aviso"]);
      $sheet->setCellValue('G' . $rowCount, $element[0]["contacto"]);
      $sheet->setCellValue('H' . $rowCount, $element[0]["country"]);
      $sheet->setCellValue('I' . $rowCount, $element[0]["id_user"]);
      $sheet->setCellValue('J' . $rowCount, $element[0]["name"]);
      $sheet->setCellValue('K' . $rowCount, $element[0]["identificacion"]);
      $sheet->setCellValue('L' . $rowCount, $lat);
      $sheet->setCellValue('M' . $rowCount, $lng);
      $sheet->setCellValue('N' . $rowCount, $element[0]["fecha_aviso_visita"]);
    }
    $writer = new Xlsx($spreadsheet);
    # Le pasamos la ruta de guardado
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $momento = date('d-m-Y H-i-s');
    //Este formato de hora esta asi para poder crear el archivo
    $path = '../resources/excel/reporteAviso' . $momento . '.xlsx';
    $pathFront = 'reporteAviso' . $momento . '.xlsx';
    $writer->save($path);

    if (file_exists($path)) {
      $result = $pathFront;
    } else {
      $result = false;
    }

    return $result;
  }

  // templates emails for Loops Especific

  public function headNoticeVisit()
  {
    $html = "";
    $html = '<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Transactional Email</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      
      /*All the styling goes here*/
      
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; 
      }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; 
      }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; 
      }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; 
      }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; 
      }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        margin: 0 auto;
        max-width: 580px;
        padding: 10px; 
      }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; 
      }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; 
      }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        margin-top: 10px;
        text-align: center;
        width: 100%; 
      }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; 
      }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px; 
      }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; 
      }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        margin-bottom: 15px; 
      }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; 
      }

      a {
        color: #3498db;
        text-decoration: underline; 
      }

      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; 
      }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; 
      }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; 
      }

      .btn-primary table td {
        background-color: #3498db; 
      }

      .btn-primary a {
      
        border-color: #3498db;
        color: #ffffff; 
      }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; 
      }

      .first {
        margin-top: 0; 
      }

      .align-center {
        text-align: center; 
      }

      .align-right {
        text-align: right; 
      }

      .align-left {
        text-align: left; 
      }

      .clear {
        clear: both; 
      }

      .mt0 {
        margin-top: 0; 
      }

      .mb0 {
        margin-bottom: 0; 
      }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; 
      }

      .powered-by a {
        text-decoration: none; 
      }

      hr {
        border: 0;
        border-bottom: 1px solid #bdbdbd;
        margin: 20px 0; 
      }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; 
        }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; 
        }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; 
        }
        table[class=body] .content {
          padding: 0 !important; 
        }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; 
        }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; 
        }
        table[class=body] .btn table {
          width: 100% !important; 
        }
        table[class=body] .btn a {
          width: 100% !important; 
        }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; 
        }
      }

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; 
        }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; 
        }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; 
        }
        #MessageViewBody a {
          color: inherit;
          text-decoration: none;
          font-size: inherit;
          font-family: inherit;
          font-weight: inherit;
          line-height: inherit;
        }
      
        
      }

        </style>
      </head>';
        return $html;
      }
      public function inHome($infoTemplate)
      {
        $html = "";
        $html .= '<!doctype html>
              <html>';
        $html .= $this->headNoticeVisit();
        $html .= '<body class="">
        <span class="preheader">Para la devolucion del equipo ' . $infoTemplate->empresa . '.</span>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
          <tr>
            <td>&nbsp;</td>
            <td class="container">
              <div class="content">

                <!-- START CENTERED WHITE CONTAINER -->
                <table role="presentation" class="main">

                  <!-- START MAIN CONTENT AREA -->
                  <tr>
                    <td class="wrapper">
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>
                            <h4><strong>Aviso de Visita /Cliente: ' . $infoTemplate->identificacion . ' / ' . $infoTemplate->empresa . ' </strong></h4>
                            <hr>
                            <p style="color:black;" >En el dia de la fecha hemos visitado su domicilio, para realizar el retiro de los equipos. Por tal solicitamos, tener a mano <strong>NUEVAMENTE</strong>. Responda por este medio o consulte al ' . $infoTemplate->footer . '</p>
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                              <tbody>
                                <tr>
                                  <td align="center">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                      <tbody>
                                        <tr>
                                            <td  > <a href="#" target="_blank"> <img style="width:200px;height:60px;" src="' . $infoTemplate->URL_IMG . '" alt="Imagen ' . $infoTemplate->empresa . '"></a> </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <p>Fecha : ' . $infoTemplate->fechaAcortada . '</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                <!-- END MAIN CONTENT AREA -->
                </table>
                <!-- END CENTERED WHITE CONTAINER -->

            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </body>
    </html>';

    return $html;
  }
  public function inRoute($infoTemplate)
  {
    $html = "";
    $html .= '<!doctype html>
          <html>';
    $html .= $this->headNoticeVisit();
    $html .= '<body class="">
      <span class="preheader">Para la devolucion del equipo ' . $infoTemplate->empresa . '.</span>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
          <td>&nbsp;</td>
          <td class="container">
            <div class="content">
  
              <!-- START CENTERED WHITE CONTAINER -->
              <table role="presentation" class="main">
  
                <!-- START MAIN CONTENT AREA -->
                <tr>
                  <td class="wrapper">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>
                          <h4><strong>Aviso de Visita / Equipos en comodato / Cliente: ' . $infoTemplate->identificacion . '</strong></h4>
                          <hr>
                          <p style="color:black;" >Como le anticipamos y por indicación de ' . $infoTemplate->empresa . ' visitaremos en la fecha  su domicilio para realizar el retiro de los equipos. Recuerde disponer dicho equipo a mano. Ante dudas responder a este número o consulte al ' . $infoTemplate->footer . '</p>
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                            <tbody>
                              <tr>
                                <td align="center">
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                      <tr>
                                          <td  > <a href="#" target="_blank"> <img style="width:200px;height:60px;" src="' . $infoTemplate->URL_IMG . '" alt="Imagen ' . $infoTemplate->empresa . '"></a> </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <p>Fecha : ' . $infoTemplate->fechaAcortada . '</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
  
              <!-- END MAIN CONTENT AREA -->
              </table>
              <!-- END CENTERED WHITE CONTAINER -->
  
          </td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </body>
    </html>';
    return $html;
  }
  public function tomorrow($infoTemplate)
  {
    $html = "";
    $html .= '<!doctype html>
            <html>';
    $html .= $this->headNoticeVisit();
    $html .= '
    <body class="">
        <span class="preheader">Para la devolucion del equipo ' . $infoTemplate->empresa . '.</span>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
          <tr>
            <td>&nbsp;</td>
            <td class="container">
              <div class="content">
    
                <!-- START CENTERED WHITE CONTAINER -->
                <table role="presentation" class="main">
    
                  <!-- START MAIN CONTENT AREA -->
                  <tr>
                    <td class="wrapper">
                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>
                          <h4><strong>Aviso de Visita / Equipos en comodato / Cliente: ' . $infoTemplate->identificacion . '</strong></h4>
                          <hr>
                          <p style="color:black;" >Por indicación de ' . $infoTemplate->empresa . ' en el día de mañana visitaremos su domicilio para realizar el retiro de los equipos. Por tal solicitamos, disponer equipo a mano. Ante dudas responder a este número o consulte al ' . $infoTemplate->footer . '</p>
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                              <tbody>
                                <tr>
                                  <td align="center">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                      <tbody>
                                        <tr>
                                            <td  > <a href="#" target="_blank"> <img style="width:200px;height:60px;" src="' . $infoTemplate->URL_IMG . '" alt="Imagen ' . $infoTemplate->empresa . '"></a> </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <p>Fecha : ' . $infoTemplate->fechaAcortada . '</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </body>
    </html>';
    return $html;
  }

  public static function countAndChangeEmail()
  {
    $email = '';
    $countAndChangeEmail = new Notice();
    $getAllEmail = $countAndChangeEmail->getAllEmail();
    if ($getAllEmail) {
      $addCount = $countAndChangeEmail->addCount($getAllEmail->email);
      $addCount ? $email = $getAllEmail : $email = false;
    } else {
      $resetCount = $countAndChangeEmail->resetCount();
      $resetCount ? $getAllEmail = $countAndChangeEmail->getAllEmail() : $email = false;
      $getAllEmail ? $email =  $getAllEmail : $email = false;
    }
    return $email;
  }
}
