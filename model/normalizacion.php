<?php 


class normalizacion {

    private $file; 
    private $id_local; 
    private $documento;
    private $telefono_uno;
    private $telefono_uno_uno;
    private $telefono_uno_dos;
    private $telefono_dos; 
    private $telefono_dos_uno;
    private $telefono_dos_dos;
    private $telefono_tres;
    private $telefono_tres_uno;
    private $telefono_tres_dos; 
    private $telefono_cuatro;
    private $telefono_cuatro_uno;
    private $telefono_cuatro_dos;
    private $localidad;
    private $sin_15; 
    private $reemplazar;
    private $longitud;
    private $modalidad;
    private $operador;
    private $empresa;
    private $cartera;
    private $fecha_ingresado;
    private $codigo_postal;
    private $bloque;
    private $key;
   
    public function __construct(){
        $this->db=Database::connect();
    }
 
    public function getFile(){
        return $this->file;
    }

    public function getId_local(){
        return $this->id_local;
    }
    public function getDocumento(){
        return $this->documento;
    }
    public function getTelefono_uno(){
        return $this->telefono_uno;
    }
    public function getTelefono_uno_uno(){
        return $this->telefono_uno_uno;
    }
    public function getTelefono_uno_dos(){
        return $this->telefono_uno_dos;
    }
    public function getTelefono_dos(){
        return $this->telefono_dos;
    }
    public function getTelefono_dos_uno(){
        return $this->telefono_dos_uno;
    }
    public function getTelefono_dos_dos(){
        return $this->telefono_dos_dos;
    }
    public function getTelefono_tres(){
        return $this->telefono_tres;
    }
    public function getTelefono_tres_uno(){
        return $this->telefono_tres_uno;
    }
    public function getTelefono_tres_dos(){
        return $this->telefono_tres_dos;
    }
    public function getTelefono_cuatro(){
        return $this->telefono_cuatro;
    }
    public function getTelefono_cuatro_uno(){
        return $this->telefono_cuatro_uno;
    }
    public function getTelefono_cuatro_dos(){
        return $this->telefono_cuatro_dos;
    }
    public function getLocalidad(){
        return $this->localidad;
    }
    public function getSin_15(){
        return $this->sin_15;
    }
    public function getReemplazar(){
        return $this->reemplazar;
    }
    public function getLongitud(){
        return $this->longitud;
    }
    public function getModalidad(){
        return $this->modalidad;
    }
    public function getOperador(){
        return $this->operador;
    }
    public function getEmpresa(){
        return $this->empresa;
    }
    public function getCartera(){
        return $this->cartera;
    }
    public function getFecha_ingresado(){
        return $this->fecha_ingresado;
    }
    public function getCodigo_postal(){
        return $this->codigo_postal;
    }

    public function getBloque(){
        return $this->bloque;
    }

    public function getKey(){
        return $this->key;
    }




    public function setFile($file){
        $this->file=$file;
    }

    public function setId_local($id_local){
        $this->id_local=$id_local;
    }
    public function setDocumento($documento){
        $this->documento=$documento;
    }
    public function setTelefono_uno($telefono_uno){
        $this->telefono_uno=$telefono_uno;
    }
    public function setTelefono_uno_uno($telefono_uno_uno){
        $this->telefono_uno_uno=$telefono_uno_uno;
    }
    public function setTelefono_uno_dos($telefono_uno_dos){
        $this->telefono_uno_dos=$telefono_uno_dos;
    }
    public function setTelefono_dos($telefono_dos){
        $this->telefono_dos=$telefono_dos;
    }
    public function setTelefono_dos_uno($telefono_dos_uno){
        $this->telefono_dos_uno=$telefono_dos_uno;
    }
    public function setTelefono_dos_dos($telefono_dos_dos){
        $this->telefono_dos_dos=$telefono_dos_dos;
    }
    public function setTelefono_tres($telefono_tres){
        $this->telefono_tres=$telefono_tres;
    }
    public function setTelefono_tres_uno($telefono_tres_uno){
        $this->telefono_tres_uno=$telefono_tres_uno;
    }
    public function setTelefono_tres_dos($telefono_tres_dos){
        $this->telefono_tres_dos=$telefono_tres_dos;
    }
    public function setTelefono_cuatro($telefono_cuatro){
        $this->telefono_cuatro=$telefono_cuatro;
    }
    public function setTelefono_cuatro_uno($telefono_cuatro_uno){
        $this->telefono_cuatro_uno=$telefono_cuatro_uno;
    }
    public function setTelefono_cuatro_dos($telefono_cuatro_dos){
        $this->telefono_cuatro_dos=$telefono_cuatro_dos;
    }
    public function setLocalidad($localidad){
        $this->localidad=$localidad;
    }
    public function setSin_15($sin_15){
        $this->sin_15=$sin_15;
    }
    public function setReemplazar($reemplazar){
        $this->reemplazar=$reemplazar;
    }
    public function setLongitud($longitud){
        $this->longitud=$longitud;
    }
    public function setModalidad($modalidad){
        $this->modalidad=$modalidad;
    }
    public function setOperador($operador){
        $this->operador=$operador;
    }
    public function setEmpresa($empresa){
        $this->empresa=$empresa;
    }
    public function setCartera($cartera){
        $this->cartera=$cartera;
    }
    public function setFecha_ingresado($fecha_ingresado){
        $this->fecha_ingresado=$fecha_ingresado;
    }
    public function setCodigo_postal($codigo_postal){
        $this->codigo_postal=$codigo_postal;
    }
    public function setBloque($bloque){
        $this->bloque=$bloque;
    }
    public function setKey($key){
        $this->key=$key;
    }
    

    public function verificarBaseOriginal(){

        
        $result = false;
        $filename = $_FILES['dataImportarBO']['tmp_name'];
        $handle = fopen($filename, "r");
        $count = 0;
        $CountRepetidos=0;
        $CountNoRepeat="";
        while (($entrie = fgetcsv($handle, 9999, ";")) !== FALSE) {

            if($count>0){

               $id_local_verify = $entrie[0];

               $sql= "SELECT id_local from express where id_local='$id_local_verify'";

               $cliente = $this->db->query($sql);
              if($cliente && $cliente->num_rows>0){
                $_SESSION['revisionBase'][] = $id_local_verify;
                $_SESSION['CountRepetidos'] = $CountRepetidos;
               
                  $CountRepetidos++;
                
              }else{

               $CountNoRepeat = 0;

              }
            }

            $count++;
        
        }

        if($CountRepetidos >0){
            $_SESSION["flag"]= 'no-aprobado';
            header("Location:".base_url.'/normalizacion/baseGeneral');
        }else{
            $_SESSION["flag"]= 'aprobado';
            header("Location:".base_url.'/normalizacion/baseGeneral');

        }

    }

    public function importarBaseOriginal(){

        $result = false;
        $filename = $_FILES['dataImportarBO']['tmp_name'];
        $handle = fopen($filename, "r");
        
        $count = 0;
        // la cantidad del bloque *- prueba con un archivo de 50 lineas y prueba colocando 10 a ver si todo va como quieres. 
        $qtyToInsert = 50;
        $totals = 0;
        // block lo uso para contar cuantos tengo en el bloque actual 
        $block = 0;
        $sql = "INSERT INTO equipos (id,id_local ,cod_empresa ,tipo ,empresa ,equipo ,tarjeta ,terminal ,serie ,serie_base ,idd ,id_orden ,id_actividad ,identificacion ,nombre_cliente ,direccion ,localidad ,codigo_postal ,provincia ,fecha_creacion ,telefono1 ,telefono2 ,telefono_fijo1 ,telefono_fijo2 ,telefono_fijo3 ,telefono_fijo4 ,telefono_fijo5 ,telefono_fijo6 ,fecha_de_envio ,cartera ,baja ,emailcliente,created_at) VALUES ";

        $insertNumber = 0;
        $entries = 0;

       while (($cabeza = fgetcsv($handle, 9999, ";")) !== FALSE) {

            if($count>=0){

        while (($entrie = fgetcsv($handle, 9999, ";")) !== FALSE) {

            $entries++;

            // si no es la primera recuerda agregar una coma
            if ($block != 0) {
                $sql .= ',';
            }

             $id_local = $this->cleanTxt($entrie[0]);
             $cod_empresa = $this->cleanTxt($entrie[1]);
             $tipo = $this->cleanTxt($entrie[2]);
             $empresa = $this->cleanTxt($entrie[3]);
             $equipo = $this->cleanTxt($entrie[4]);
             $tarjeta = $this->cleanTxt($entrie[5]); 
             $terminal = $this->cleanTxt($entrie[6]); 
             $serie = $this->cleanTxt($entrie[7]); 
             $serie_base = $this->cleanTxt($entrie[8]);
             $idd = $this->cleanTxt($entrie[9]);
             $id_orden = $this->cleanTxt($entrie[10]);
             $id_actividad = $this->cleanTxt($entrie[11]);
             $identificacion = $this->cleanTxt($entrie[12]); 
             $nombre_cliente = $this->cleanTxt($entrie[13]);
             $direccion = $this->cleanTxt($entrie[14]); 
             $localidad = $this->cleanTxt($entrie[15]);
             $codigo_postal = $this->clean($entrie[16]); 
             $provincia = $this->cleanTxt($entrie[17]); 
             $fecha_creacion = $this->cleanTxt($entrie[18]); 
             $telefono1 = $this->cleanTxt($entrie[19]);
             $telefono2 = $this->cleanTxt($entrie[20]); 
             $telefono_fijo1 = $this->cleanTxt($entrie[21]);
             $telefono_fijo2 = $this->cleanTxt($entrie[22]);
             $telefono_fijo3 = $this->cleanTxt($entrie[23]); 
             $telefono_fijo4 = $this->cleanTxt($entrie[24]);
             $telefono_fijo5 = $this->cleanTxt($entrie[25]); 
             $telefono_fijo6 = $this->cleanTxt($entrie[26]); 
             $fecha_de_envio = $this->cleanTxt($entrie[27]); 
             $cartera = $this->cleanTxt($entrie[28]);
             $baja = $this->cleanTxt($entrie[29]);
             $emailcliente = $this->cleanTxt($this->cleanTxt($entrie[30]));
             $fecha_ingresado = $this->getFecha_ingresado();

            $sql .="(null,'" .$id_local . "','" . $cod_empresa . "', '" . $tipo . "', '" . $empresa . "', '" . $equipo . "', '" . $tarjeta . "', '" . $terminal . "', '" . $serie . "', '" . $serie_base . "', '" . $idd . "', '" . $id_orden . "', '" . $id_actividad . "', '" . $identificacion . "', '" . $nombre_cliente . "', '" . $direccion . "', '" . $localidad . "', '" . $codigo_postal . "', '" . $provincia . "', '" . $fecha_creacion . "', '" . $telefono1 . "', '" . $telefono2 . "', '" . $telefono_fijo1 . "', '" . $telefono_fijo2 . "', '" . $telefono_fijo3 . "', '" . $telefono_fijo4 . "', '" . $telefono_fijo5 . "', '" . $telefono_fijo6 . "', '" . $fecha_de_envio . "', '" . $cartera . "', '" . $baja . "', '" . $emailcliente . "', '" . $fecha_ingresado . "') ";

            $block++;
         

            if ($block >= $qtyToInsert) {

                $insertar = $this->db->query($sql);
                if(!$insertar){ 
                  $_SESSION["errorUp"] = 'error';
                }
            
                $insertNumber++;
                // reinicias block 
                $block = 0;
        
                // reinicias sentencia sql
                $sql = "INSERT INTO equipos (id,id_local ,cod_empresa ,tipo ,empresa ,equipo ,tarjeta ,terminal ,serie ,serie_base ,idd ,id_orden ,id_actividad ,identificacion ,nombre_cliente ,direccion ,localidad ,codigo_postal ,provincia ,fecha_creacion ,telefono1 ,telefono2 ,telefono_fijo1 ,telefono_fijo2 ,telefono_fijo3 ,telefono_fijo4 ,telefono_fijo5 ,telefono_fijo6 ,fecha_de_envio ,cartera ,baja ,emailcliente,created_at) VALUES ";
            }
            // esto solo es el total de todos 
            
            $totals++;
            $count ++;
      }
    
            if ($block > 0) {
                 $insertar = $this->db->query($sql);

                 if(!$insertar){ 
                    $_SESSION["errorUp"] = 'errorBloque';
                  }
                $insertNumber++;                
            }

    
             if($insertar){
                 $result = true;
                 
             }else {
                 $result = false;
             }

             
            }
            $count ++;
        }
        
             $_SESSION["cantidadInsert"] = $totals++;
            //}
              return $result;
    }

    public function limpiarIngreso(){


        $fecha = !empty($this->getFecha_ingresado()) ? $this->getFecha_ingresado() : false ;
        $operador = !empty($this->getOperador()) ? $this->getOperador() : false ;
        $empresa = !empty($this->getEmpresa()) ? $this->getEmpresa() : false ;
        $cartera = !empty($this->getCartera()) ? $this->getCartera() : false ;
        
        $result = false;
        $filename = $_FILES['dataImportar']['tmp_name'];
        $handle = fopen($filename, "r");
        $count = 0;
        // la cantidad del bloque *- prueba con un archivo de 50 lineas y prueba colocando 10 a ver si todo va como quieres. 
        $qtyToInsert = 1;
        $totals = 0;
        // block lo uso para contar cuantos tengo en el bloque actual 
        $block = 0;
        $sql = "INSERT INTO n_limpiar_ingreso (id,codigo_postal,id_local,documento,telefono_uno,telefono_dos,telefono_tres,telefono_cuatro,fecha_ingresado,operador,empresa,cartera) VALUES ";

        $insertNumber = 0;
        $entries = 0;
    
        while (($entrie = fgetcsv($handle, 9999, ";")) !== FALSE) {

            $entries++;

            if($count !== 0){
               
                $id_local = !empty($entrie[0]) ? $entrie[0] : '0' ;
                $codigo_postal = !empty($entrie[1]) ? $entrie[2] : '0' ;
                $documento = !empty($entrie[2]) ? $entrie[2] : '0' ;
                $telefono1 = !empty($entrie[3]) ? $entrie[3] : '0' ;
                $telefono2 = !empty($entrie[4]) ? $entrie[4] : '0' ;
                $telefono3 = !empty($entrie[5]) ? $entrie[5] : '0' ;
                $telefono4 = !empty($entrie[6]) ? $entrie[6] : '0' ;
               
                // echo json_encode($sql)."<br><br>";   
            // si no es la primera recuerda agregar una coma
            if ($block != 0) {
                $sql .= ',';
            }

            $sql .="(null,'" .$id_local . "','" . $codigo_postal . "', '" . $documento . "', '" . $this->clean($telefono1) . "', '" . $this->clean($telefono2) . "', '" . $this->clean($telefono3) . "', '" . $this->clean($telefono4) . "','" . $fecha . "', '" . $operador . "', '" . $empresa . "', '" . $cartera . "' ) ";

            $block++;

            if ($block >= $qtyToInsert) {

                 $insertar = $this->db->query($sql);
                
                $insertNumber++;
                // reinicias block 
                $block = 0;
               
                // reinicias sentencia sql
                $sql = "INSERT INTO n_limpiar_ingreso (id,codigo_postal,id_local,documento,telefono_uno,telefono_dos,telefono_tres,telefono_cuatro,fecha_ingresado,operador,empresa,cartera) VALUES ";
            }
            // esto solo es el total de todos 
            $totals++;
            
        }
        $count ++;
      }
            if ($block > 0) {
                $insertar = $this->db->query($sql);

                $insertNumber++;
            }

            if($insertar){
                $result = true;
            }else {
                $result = false;
            }
        
            $_SESSION["insert"] = $count;
            return $result;

    
    }

    public function showImport(){
        $cartera = !empty($this->getCartera()) ? $this->getCartera() : false ;
        $fecha = !empty($this->getFecha_ingresado()) ? $this->getFecha_ingresado() : false ;

        if($cartera && $fecha){
            $sql = "SELECT id_local,cod_empresa,tipo,empresa,equipo,tarjeta,terminal,serie,serie_base,idd,id_orden,id_actividad,identificacion,nombre_cliente,direccion,localidad,codigo_postal,provincia,fecha_creacion,telefono1,telefono2,telefono_fijo1,telefono_fijo2,telefono_fijo3,telefono_fijo4,telefono_fijo5,telefono_fijo6,fecha_de_envio,cartera,baja,emailcliente,created_at FROM equipos where 
            cartera='$cartera' and created_at='$fecha';";
            
            $showImport = $this->db->query($sql);
            if($showImport && $showImport->num_rows>0){

                $result = $showImport;
            }else{
                $result =false;
            }
            return $result;
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

    public function cleanTxt($str)
    {
        // IMPORTANTE ','=>'.'. ES PARA IMPORTAR TEXTO PARA QUE PUEDA ENTRAR EL ARCHIVO
        $unwanted_array = array(
            ','=>'.', "'" => '.' , '"' => '.'
        );

        return strtr($str, $unwanted_array);
    }

    public function validateKey(){
        $key = !empty($this->getKey()) ? $this->getKey() : false ;
        
        if($key){

            $sql = "SELECT clave from keyss where clave = '$key'";
            $validateKey = $this->db->query($sql);
            if($validateKey && $validateKey->num_rows>0){
                
                $result = true;
            }else {
                $result = false;
            }

            return $result;

        }
    }



}