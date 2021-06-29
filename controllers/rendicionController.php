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
        $fileName = "../RENDICION.xlsx";
    
        $chk_ext = explode(".", $fileName);
        if (strtolower(end($chk_ext)) == "csv" || strtolower(end($chk_ext)) == "xls" || strtolower(end($chk_ext)) == "xlsx") {

            /**  Identify the type of $fileName  **/
            $fileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($fileName);

            /**  Create a new Reader of the type that has been identified  **/
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($fileType);

            /**  Load $fileName to a Spreadsheet Object  **/
            $spreadsheet = $reader->load($fileName);

            /**  Convert Spreadsheet Object to an Array for ease of use  **/
            $data = $spreadsheet->getActiveSheet()->toArray();
            $header = 0;
            $object=[];
            $objectFail = [];
            foreach( $data as $elements )
            {     
                if($header === 0){
                   if($elements[0] !== 'terminal' || $elements[1] !== 'serie' || $elements[2] !== 'identificacion'){
                    echo "el encabezado es incorrecto, debe ser terminal,serie,identificacion";return;
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
                $this->showTickets($object,$objectFail);
            }
        }else{
            echo "formato incorrecto";
        }
       
        
    }


    public function showTickets($object,$fail){
        require_once '../resources/fpdf/fpdf.php';
        require_once '../views/rendicion/posnet.php';
    }
}