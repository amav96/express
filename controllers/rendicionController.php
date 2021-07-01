<?php
if (isset($_GET['rendicion'])) {
    session_start();
    require_once '../model/rendicion.php';
    require_once '../config/db.php';
    require_once "../vendor/autoload.php";

    $accion = $_GET['rendicion'];
    $rendicion = new rendicionController();
    $rendicion->$accion();

} else {
    require_once "vendor/autoload.php";
    require_once 'model/rendicion.php';
}

class rendicionController
{

    public function equipos(){
     
        Utils::AuthAdmin();
        require_once  'vue/src/view/admin/rendicion.php';
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

    public function readExcel(){
        if($_FILES){

            try{

                $file = $_FILES["file"];
                $fileName = $file["name"];

                if($file["tmp_name"] === ''){
                    $dataResponse = array('error' => 'No se reconoce el archivo, cambielo de ubicación o optimize su tamaño');
                    $jsonstring = json_encode($dataResponse);
                    echo $jsonstring;
                    return;
                }
                
                // $file = '../rendi.xlsx';
                
                $chk_ext = explode(".", $fileName);
            
                if (strtolower(end($chk_ext)) == "csv" || strtolower(end($chk_ext)) == "xls" || strtolower(end($chk_ext)) == "xlsx") {

                    /**  Identify the type of $fileName  **/
                    $fileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file["tmp_name"]);
                    // $fileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file);

                    

                    /**  Create a new Reader of the type that has been identified  **/
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($fileType);


                    /**  Load $fileName to a Spreadsheet Object  **/
                    $spreadsheet = $reader->load($file["tmp_name"]);
                    // $spreadsheet = $reader->load($file);

                
                    /**  Convert Spreadsheet Object to an Array for ease of use  **/
                    $data = $spreadsheet->getActiveSheet()->toArray();
                    $header = 0;
                    $object=[];
                    $objectFail = [];
                    $countRows = 0;
                    foreach( $data as $elements ){$countRows++;}

                    if($countRows>150){
                        $dataResponse = array('error' => 'El archivo supera la cantidad maxima de 150 registros. Nota : Las filas en blanco al final del archivo tambien seran contadas');
                        $jsonstring = json_encode($dataResponse);
                        echo $jsonstring;
                        return;
                    }

                    foreach( $data as $elements )
                    {     

                        if($header === 0){
                        if($elements[0] !== 'terminal' || $elements[1] !== 'serie' || $elements[2] !== 'identificacion'){
                            $dataResponse = array('error' => 'Los nombres de las columnas son incorrectos, deben respetar el orden y las minúsculas : terminal, serie,  identificacion', );
                            $jsonstring = json_encode($dataResponse);
                            echo $jsonstring;
                            return;
                        }
                        }else {
                            // foreach($elements as $single_element){
                                $get = new Rendicion();
                                $get->setTerminal($elements[0]);
                                $get->setSerie($elements[1]);
                                $get->setIdentificacion($elements[2]);
                                $get = $get->getRendicion();
                                if($get){
                                    foreach ($get as $element){
                                        array_push($object,$element);
                                    }
                                }else {
                                    $objectFail[]= array(
                                        'terminal' => $elements[0],
                                        'serie' => $elements[1],
                                        'identificacion' => $elements[2]
                                    );
                                }
                            // }
                        }
                    
                        $header ++;
                    }

                    if($object){
                        date_default_timezone_set('America/Argentina/Buenos_Aires');
                        $date_upload = date('d-m-Y h-i-s');
                        $empresa = $object[0]["empresa"];
                        $companyInitials = substr($object[0]["identificacion"],0,2);
                        $FileName = $date_upload.$empresa;
                        $this->showTickets($object,$objectFail,$FileName,$companyInitials);
                        $path = '../resources/pdf/rendicion'.$FileName.'.pdf';
                        $pathFront= 'rendicion'.$FileName.'.pdf';
                        if(file_exists($path)){
                            $dataResponse = array(
                                'success' => true,
                                'path' => $pathFront,
                                'fileName' => $FileName,
                                'fail' => $objectFail
                            );
                        
                        }else {$dataResponse = array('error' => 'No se pudo construir el PDF', );}
                        
                    }else{$dataResponse = array('error' => 'No se encontraron resultados en la lectura de equipos', );}
                }else{$dataResponse = array('error' => 'El formato del excel es incorrecto, debe ser .xlsx', );}

            }
            catch(Exception $e){
                $dataResponse = array('error' => $e);
                $jsonstring = json_encode($dataResponse);
                echo $jsonstring;
            }


        }else{$dataResponse = array('error' => 'No se recibio archivo');}

        $jsonstring = json_encode($dataResponse);
        echo $jsonstring;
    }


    public function showTickets($object,$fail,$FileName,$companyInitials){
       

      
       
        require_once '../resources/fpdf/fpdf.php';

        switch(strtoupper($companyInitials)){
            case 'LA';
               require_once '../views/rendicion/lapos.php';
               break;
            case 'PS';
               require_once '../views/rendicion/posnet.php';
               break;
            case 'AN';
               require_once '../views/rendicion/antina.php';
               break;
            case 'AP';
               require_once '../views/rendicion/antina.php';
               break;
            case 'AI';
               require_once '../views/rendicion/antina.php';
               break;
            case 'IN';
               require_once '../views/rendicion/intv.php';
               break;
            case 'IP';
               require_once '../views/rendicion/iplan.php';
               break;
            case 'MT';
               require_once '../views/rendicion/metrotel.php';
               break;
            case 'CV';
               require_once '../views/rendicion/cablevision.php';
               break;
            case 'SC';
               require_once '../views/rendicion/supercanal.php';
               break;
            case 'CL';
               require_once '../views/rendicion/claro.php';
               break;
        }

        
    }
}

