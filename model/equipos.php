<?php

class Equipos
{

    protected $id_recolector;
    protected $id_user_update;
    protected $orden;
    protected $ordenHash;
    protected $cartera;
    protected $identificacionCliente;
    protected $idd;
    protected $guia_equipo;
    protected $id_equipo;
    protected $terminal;
    protected $serie;
    protected $serie_base;
    protected $chip_alternativo;
    protected $tarjeta;
    protected $estado;
    protected $motivoRetiro;
    protected $accesorioUno;
    protected $accesorioDos;
    protected $accesorioTres;
    protected $accesorioCuatro;
    protected $accesorios;
    protected $empresa;
    protected $modelo;
    protected $fecha_momento;
    protected $aclaracion;
    protected $imagen;
    protected $fechaStart;
    protected $fechaEnd;
    protected $contacto;
    protected $lat;
    protected $lng;
    protected $order;
    protected $tipo;
    protected $created_at;
    protected $fromRow;
    protected $limit;
    protected $word;
    protected $filter;
   

    public function __construct()
    {

        $this->db = Database::connect();
    }

    public function getId_recolector()
    {
        return $this->id_recolector;
    }
    public function getId_user_update()
    {
        return $this->id_user_update;
    }
    public function getOrden()
    {
        return $this->orden;
    }

    public function getOrdenHash()
    {
        return $this->ordenHash;
    }

    public function getCartera()
    {
        return $this->cartera;
    }

    public function getIdentificacionCliente()
    {
        return $this->identificacionCliente;
    }
    public function getIdd()
    {
        return $this->idd;
    }

    public function getGuiaEquipo()
    {
        return $this->guia_equipo;
    }
    
    public function getId_equipo()
    {
        return $this->id_equipo;
    }


    public function getTerminal()
    {
        return $this->terminal;
    }

    public function getSerie()
    {
        return $this->serie;
    }

    public function getSerie_base()
    {
        return $this->serie_base;
    }

    public function getChip_alternativo()
    {
        return $this->chip_alternativo;
    }

    public function getTarjeta()
    {
        return $this->tarjeta;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getMotivoRetiro()
    {
        return $this->motivoRetiro;
    }

    public function getAccesorioUno()
    {
        return $this->accesorioUno;
    }

    public function getAccesorioDos()
    {
        return $this->accesorioDos;
    }

    public function getAccesorioTres()
    {
        return $this->accesorioTres;
    }

    public function getAccesorioCuatro()
    {
        return $this->accesorioCuatro;
    }

    public function getAccesorios()
    {
        return $this->accesorios;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }
    public function getModelo()
    {
        return $this->modelo;
    }

    public function getFecha_momento()
    {
        return $this->fecha_momento;
    }

    public function getAclaracion()
    {
        return $this->aclaracion;
    }
    public function getImagen()
    {
        return $this->imagen;
    }

    public function getEmail()
    {
        return $this->email;
    }
   

    public function getfechaStart()
    {
        return $this->fechaStart;
    }
    public function getfechaEnd()
    {
        return $this->fechaEnd;
    }
    public function getContacto()
    {
        return $this->contacto;
    }
    public function getTipo()
    {
        return $this->tipo;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function getLng()
    {
        return $this->lng;
    }

    public function getFromRow()
    {
        return (string)$this->fromRow;
    }

    public function getLimit()
    {
        return (string)$this->limit;
    }

    public function getWord()
    {
        return $this->word;
    }

    public function getFilter()
    {
        return $this->filter;
    }



    public function setId_recolector($id_recolector)
    {
        $this->id_recolector = $this->db->real_escape_string($id_recolector);
    }

    public function setId_user_update($id_user_update)
    {
        $this->id_user_update = $this->db->real_escape_string($id_user_update);
    }


    public function setOrden($orden)
    {
        $this->orden = $this->db->real_escape_string($orden);
    }
    public function setOrdenHash($ordenHash)
    {
        $this->ordenHash = $ordenHash;
    }
    public function setCartera($cartera)
    {
        $this->cartera = $this->db->real_escape_string($cartera);
    }
    public function setIdentificacionCliente($identificacionCliente)
    {
        $this->identificacionCliente = $this->db->real_escape_string($identificacionCliente);
    }
    public function setIdd($idd)
    {
        $this->idd = $this->db->real_escape_string($idd);
    }


    public function setGuiaEquipo($guia_equipo)
    {
        $this->guia_equipo = $guia_equipo;
    }

    public function setId_equipo($id_equipo)
    {
        $this->id_equipo = $id_equipo;
    }



    public function setTerminal($terminal)
    {
        $this->terminal = $this->db->real_escape_string($terminal);
    }
    public function setSerie($serie)
    {
        $this->serie = $this->db->real_escape_string($serie);
    }
    public function setSerie_base($serie_base)
    {
        $this->serie_base = $this->db->real_escape_string($serie_base);
    }
    public function setChip_alternativo($chip_alternativo)
    {
        $this->chip_alternativo = $this->db->real_escape_string($chip_alternativo);
    }
    public function setTarjeta($tarjeta)
    {
        $this->tarjeta = $this->db->real_escape_string($tarjeta);
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function setMotivoRetiro($motivoRetiro)
    {
        $this->motivoRetiro = $motivoRetiro;
    }
    public function setAccesorioUno($accesorioUno)
    {
        $this->accesorioUno = $accesorioUno;
    }
    public function setAccesorioDos($accesorioDos)
    {
        $this->accesorioDos = $accesorioDos;
    }
    public function setAccesorioTres($accesorioTres)
    {
        $this->accesorioTres = $accesorioTres;
    }
    public function setAccesorioCuatro($accesorioCuatro)
    {
        $this->accesorioCuatro = $accesorioCuatro;
    }
    public function setAccesorios($accesorios)
    {
        $this->accesorios = $this->db->real_escape_string($accesorios);
    }
    public function setEmpresa($empresa)
    {
        $this->empresa = $this->db->real_escape_string($empresa);
    }

    public function setModelo($modelo)
    {
        $this->modelo = $this->db->real_escape_string($modelo);
    }
    public function setFecha_momento($fecha_momento)
    {
        $this->fecha_momento = $fecha_momento;
    }
    public function setAclaracion($aclaracion)
    {
        $this->aclaracion = $aclaracion;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }
   

    public function setFechaStart($fechaStart)
    {
        $this->fechaStart = $this->db->real_escape_string($fechaStart);
    }
    public function setFechaEnd($fechaEnd)
    {
        $this->fechaEnd = $this->db->real_escape_string($fechaEnd);
    }

    public function setContacto($contacto)
    {
        $this->contacto = $contacto;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function setLat($lat)
    {
        $this->lat = $lat;
    }
    public function setLng($lng)
    {
        $this->lng = $lng;
    }
    public function setFromRow($fromRow){
        $this->fromRow = $fromRow;
    }

    
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }
    public function setWord($word)
    {
        $this->word = $word;
    }
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }
   

  //Metodos ::::::::::::::::

    public function setTransaccion()
    {


        $sql = "INSERT INTO ordenes (id_user,created_at) VALUES ({$this->getId_recolector()},'{$this->getFecha_momento()}')";

       
        $result = $this->db->query($sql);

        if ($result) {

            $orden = $this->getOneTransaccion($this->getId_recolector());
        }

        return $orden;
    }


    public function setTransito()
    {

        $sql = "INSERT INTO  gestion (id_equipo,id_orden_pass,id_orden,id_user,identificacion,terminal,
            serie,serie_base,tarjeta,chip_alternativo,accesorio_uno,accesorio_dos,accesorio_tres,
            accesorio_cuatro,estado,motivo,lat,lng,created_at,accesorios,status_gestion) values ('{$this->getGuiaEquipo()}','{$this->getOrdenHash()}','{$this->getOrden()}',{$this->getId_recolector()},'{$this->getIdentificacionCliente()}','{$this->getTerminal()}','{$this->getSerie()}','{$this->getSerie_base()}','{$this->getTarjeta()}','{$this->getChip_alternativo()}','{$this->getAccesorioUno()}','{$this->getAccesorioDos()}','{$this->getAccesorioTres()}','{$this->getAccesorioCuatro()}','{$this->getEstado()}','{$this->getMotivoRetiro()}','{$this->getLat()}','{$this->getLng()}','{$this->getFecha_momento()}','{$this->getAccesorios()}','transito');";

        
        $equipos = $this->db->query($sql);

        $result =  false;
        if ($equipos) {

            if ($this->getCurrentId($this->getGuiaEquipo())) {

                $this->updateCurrentClientStatus($this->getEstado(), $this->getFecha_momento(), $this->getGuiaEquipo());
            }

            $result = true;
        }
        return $result;
    }

    private function getCurrentId($string)
    {

        $result = false;

        $sql = "SELECT id, estado FROM equipos where id='{$this->getGuiaEquipo()}'";
        $ejecutar = $this->db->query($sql);

           

        if ($ejecutar && $ejecutar->num_rows > 0) {

            $result = true;
        } else {

            $result = false;
        }

        return $result;
    }

    private function updateCurrentClientStatus($estado, $fecha, $idGuia)
    {

        if($this->getEstado() !== 'AUTORIZAR'){

                $sql = "UPDATE equipos set estado='$estado', created_at='$fecha' where id='$idGuia'";
                $ejecutar = $this->db->query($sql);

            }
    }

    public function getAllEquipos()
    {
        if($_POST){

        $sql = "SELECT e.id , e.identificacion as 'eidentificacion', e.terminal AS 'terminal',
                e.tarjeta AS 'etarjeta',e.serie as 'eserie', e.idd as 'idd',
                e.serie_base as 'serie_base', e.nombre_cliente AS 'enombre',e.direccion AS 'edireccion',
                e.localidad AS 'elocalidad', e.provincia AS 'eprovincia', e.codigo_postal AS 'ecodigo_postal' ,
                e.telefono_cel4, e.telefono_cel5, e.telefono_cel6, e.emailcliente, e.estado AS 'estado',e.telefono1 as 'telefono', e.empresa 
                FROM equipos e
                LEFT JOIN gestion g ON g.id = e.id
                WHERE e.identificacion ='{$this->getIdentificacionCliente()}' OR e.serie ='{$this->getIdentificacionCliente()}' OR e.terminal ='{$this->getIdentificacionCliente()}' GROUP BY e.id ;";

            
        $result = $this->db->query($sql);
        return $result;
        
        }
    }

    private function getOneTransaccion($string){
        $sql = "SELECT id,created_at,id_user from ordenes where id_user='$string' ORDER BY id DESC LIMIT 1";
        
        $result = $this->db->query($sql);

        if ($result && $result->num_rows === 1) {

            $orden = $result->fetch_object();
        }

        return $orden;
    }


    public function getAllEmpresa(){

        $sql = "SELECT empresa,id FROM empresas";
        $modelos = $this->db->query($sql);
        $result = false;

        if ($modelos->num_rows > 0) {

            $result = $modelos;
        } else {
            $result = false;
        }

        return $result;
    }


    public function getAllModelo(){


        $sql = "SELECT modelo,id from modelos_equipos where id_empresa='{$this->getModelo()}'";
        
        $modelos = $this->db->query($sql);
        $result = false;

        if ($modelos->num_rows > 0) {

            $result = $modelos;
        } else {
            $result = false;
        }

        return $result;
    }

    public function gettersSerieTerminal(){

        $terminal = !empty($this->getTerminal()) ? $this->getTerminal() : false ;
        $serie = !empty($this->getSerie()) ? $this->getSerie() : false ;
            
        $equipo = false;
        if($terminal){

            $sql = "SELECT terminal FROM gestion where terminal='$terminal'";

        }else if ($serie){

            $sql = "SELECT serie FROM gestion where serie='$serie'";
        }     

        $result = $this->db->query($sql);

        if ($result) {

            if ($result->num_rows > 0) {

                $equipo = false;
            } else {
                $equipo = true;
            }
        }

        return $equipo;
    }


    public function gettersValidateID(){
        $id_local =  !empty($this->getGuiaEquipo()) ?$this->getGuiaEquipo() : false;
        if($id_local){
            $result = false;
            $sql = "SELECT id_local from equipos where id_local='$id_local'";
           
            $validar = $this->db->query($sql);
            if($validar && $validar->num_rows>0){
              $result= 'existe';
            }else{
                $result= 'no-existe';
            }
            return $result;
        }

    }

    public function gettersValidateSerieBase(){
        $serie =  !empty($this->getSerie()) ?$this->getSerie() : false;
        if($serie){
            $result = false;
            $sql = "SELECT serie from equipos where serie='$serie'";
           
            $validar = $this->db->query($sql);
            if($validar && $validar->num_rows>0){
              $result= 'existe';
            }else{
                $result= 'no-existe';
            }
            return $result;
        }
    }

    public function gettersValidateTerminalBase(){
        $terminal =  !empty($this->getTerminal()) ?$this->getTerminal() : false;
        if($terminal){
            $result = false;
            $sql = "SELECT terminal from equipos where terminal='$terminal'";
           
           
            $validar = $this->db->query($sql);
            if($validar && $validar->num_rows>0){
              $result= 'existe';
            }else{
                $result= 'no-existe';
            }
            return $result;
        }

    }

    public function settersFirma(){

            $sentinelaFirma = false;

            if ($_POST) {
                // Nuestro base64 contiene un esquema Data URI (data:image/png;base64,)
                // que necesitamos remover para poder guardar nuestra imagen
                // Usa explode para dividir la cadena de texto en la , (coma)
                $base_to_php = explode(',', $this->getImagen());

                // El segundo item del array base_to_php contiene la información que necesitamos (base64 plano)
                // y usar base64_decode para obtener la información binaria de la imagen
                $data = base64_decode($base_to_php[1]); // BBBFBfj42Pj4....

                // Proporciona una locación a la nueva imagen (con el nombre y formato especifico)
                $filepath = '../resources/firmas/' . $this->getFecha_momento().$this->getOrden().'.png'; // or image.jpg

            
                // Finalmente guarda la imágen en el directorio especificado y con la informacion dada
                $guardarimagen = file_put_contents($filepath, $data, FILE_APPEND);


                if ($guardarimagen) {
                    $nombre_fichero = '../resources/firmas/' . $this->getFecha_momento() . $this->getOrden() . '.png';

                    if (file_exists($nombre_fichero)) {

                        $firma = $this->setfirma($this->getOrden(), $this->getFecha_momento(), $this->getAclaracion(), $this->getIdentificacionCliente());


                        if (!$firma) {
                            $sentinelaFirma = false;
                        } else {
                            $sentinelaFirma = true;
                        }
                    }
                }
            }
            return $sentinelaFirma;
    }

    private function setfirma($orden, $fecha, $aclaracion, $documento){

            $result = false;
            
            $sql = "INSERT INTO firmas (pass_id,aclaracion,documento,created_at) VALUES('$orden','$aclaracion','$documento','$fecha')";
            
            $firma = $this->db->query($sql);

            if ($firma) {
                $result = true;
            } else {
                $result = false;
            }
            return  $result;
    }

    public function obtainCustomerDataToIssueInvoice(){
          
        $sql= "SELECT e.emailcliente AS 'email',e.identificacion as 'identificacion', e.nombre_cliente as 'nombre', e.direccion as 'direccion', e.provincia as 'provincia', e.localidad as 'localidad',
        e.codigo_postal as 'codigo_postal',e.telefono1 AS 'telefono1', g.id_orden_pass as 'id_orden_pass', g.id_orden as 'orden', g.estado as 'estado', g.motivo as 'motivo',
         g.created_at, g.id_user as 'id_user'
        from gestion g 
        left join equipos e on e.identificacion = g.identificacion 
        where g.estado IN('RECUPERADO','AUTORIZAR')  and g.status_gestion = 'transito' AND g.id_orden_pass = '{$this->getOrden()}'
        GROUP BY g.id ;";

    
        $result = $this->db->query($sql);

          return $result;
    }

    public function obtainEquipmentDataToIssueInvoice(){
        $sql = "SELECT e.equipo as 'equipo', e.tipo as 'tipo', g.terminal as 'terminal', g.serie as 'serie', g.serie_base as 'serie_base', g.tarjeta as 'tarjeta', g.chip_alternativo
        as 'sim_alternativo',g.accesorio_uno as 'accesorio_uno', g.accesorio_dos as 'accesorio_dos',g.accesorio_tres 
        as 'accesorio_tres', g.accesorio_cuatro as 'accesorio_cuatro', g.estado as 'estado', g.motivo as 'motivo',
        g.created_at ,g.accesorios as 'accesorios'
        from gestion g
        left join equipos e on e.id= g.id_equipo
        where g.estado IN('RECUPERADO','AUTORIZAR') AND g.id_orden_pass = '{$this->getOrden()}'
        and g.status_gestion = 'transito' GROUP BY g.id ;";

        $result = $this->db->query($sql);
        return $result;
    }

    public function getSignatureData(){
        $sql ="SELECT f.pass_id AS 'orden_general', f.created_at , f.aclaracion,
        f.documento from firmas f 
        left join gestion g on g.id_orden_pass = f.pass_id 
        WHERE f.pass_id='{$this->getOrden()}'
        GROUP BY f.pass_id;";
         $result = $this->db->query($sql);
        
        return $result;
  
    }

    public function getDataCustomerOnConsignment(){
        $sql = "SELECT documento,numero_documento ,nombre,apellido,direccion,provincia,localidad,
        codigo_postal,telefono,email,
        empresa,created_at,id_user from clientes_consignacion 
        where numero_documento = '{$this->getIdentificacionCliente()}'";
        $result = $this->db->query($sql);
        return $result;          
    }
            
    public function getDataEquipmentOnConsignment(){
        $sql = "SELECT terminal,serie,modelo,motivo_solicitud,created_at from clientes_consignacion where numero_documento ='{$this->getIdentificacionCliente()}'";
        
        $result = $this->db->query($sql);
        return $result;
        
    }

    public function getAllCustomers(){

                if($_POST){
                     
            $result = false;
            $sql = "SELECT empresa,identificacion,terminal,serie_base,serie,tarjeta,order_rec,emailcliente,updated_at,estado,localidad,
            provincia,codigo_postal,direccion,id_orden_pass,nombre_cliente,cable_hdmi,cable_av,fuente,control_1,id_user
            FROM equipos where identificacion='{$this->getIdentificacionCliente()}' or serie='{$this->getIdentificacionCliente()}' OR tarjeta='{$this->getIdentificacionCliente()}' OR terminal='{$this->getIdentificacionCliente()}' ORDER BY updated_at DESC";

                $equipos = $this->db->query($sql);
    
                if($equipos->num_rows>0){
                $result = $equipos;
                }else{
                    $result = false;
                }
                return $result;
        
                }
        
    }

    public function getTransit(){

        $result = false;
        $sql = "SELECT g.id_equipo,g.id,g.id_orden_pass, g.id_orden, g.id_user, g.terminal, g.serie, g.serie_base,g.tarjeta,
        g.chip_alternativo,g.accesorio_uno, g.accesorio_dos, g.accesorio_tres,g.accesorio_cuatro,g.estado, 
        g.motivo,g.created_at,g.identificacion,e.nombre_cliente, e.direccion, e.provincia, e.localidad, e.empresa, 
        e.codigo_postal,e.telefono2,u.name,g.lat as 'latGestion' ,g.lng as 'lngGestion',n.lat as 'latAviso',n.lng as 'lngAviso' ,n.means,n.contacto,n.created_at as 'fecha_aviso_visita' from gestion g 
        inner join equipos e on e.identificacion = g.identificacion
        LEFT JOIN users u ON u.id = g.id_user
        LEFT JOIN notice n ON g.id_orden_pass = n.id_orden 
        WHERE g.status_gestion !='OUT' AND  g.identificacion= '{$this->getIdentificacionCliente()}' OR g.terminal= '{$this->getIdentificacionCliente()}' OR g.serie= '{$this->getIdentificacionCliente()}'  GROUP BY g.id;";
      
        $transito = $this->db->query($sql);
        if($transito && $transito->num_rows>0){
        
            $result=$transito;
        }
        return $result;
    } 

    //CONTADORES DE GESTION PARA PAGINACIONES

    public function countEquiposByWord(){
        $word = !empty($this->getWord()) ? $this->getWord() : false ;
        $wordArray = explode(' ',$word);

        if(is_array($wordArray)){
            $wordPush = [];
            for($i=0;$i<count($wordArray);$i++){
                array_push($wordPush,'+"'.$wordArray[$i].'"');
            }
            $wordFinally = implode(",",$wordPush);
            $wordClean = str_replace(","," ",$wordFinally);
        }

        $sql ="";
        $sql.="SELECT COUNT(*) as 'count' FROM equipos  ";
        $sql.="WHERE ( MATCH (empresa,terminal,serie,identificacion,direccion,localidad,codigo_postal,provincia,emailcliente,estado)  ";
        $sql.="AGAINST ('$wordClean' IN BOOLEAN MODE) ) ";
        
        $countGestionByWord = $this->db->query($sql);
        if($countGestionByWord && $countGestionByWord->num_rows>0){
            $result = $countGestionByWord;
        }else {
            $result = false;
        }
        return $result;
    }

    public function countGestionByWord(){
        $word = !empty($this->getWord()) ? $this->getWord() : false ;
        $wordArray = explode(' ',$word);

        if(is_array($wordArray)){
            $wordPush = [];
            for($i=0;$i<count($wordArray);$i++){
                array_push($wordPush,'+"'.$wordArray[$i].'"');
            }
            $wordFinally = implode(",",$wordPush);
            $wordClean = str_replace(","," ",$wordFinally);
        }

        $sql ="";
        $sql.="SELECT COUNT(*) as 'count' ";
        $sql.="FROM gestion g ";
        $sql.="INNER JOIN equipos e ON (g.id_equipo = e.id) ";
        $sql.="WHERE ";
        $sql.="( MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
        $sql.="AGAINST ('$wordClean' IN BOOLEAN MODE) ) ";
       
        $countGestionByWord = $this->db->query($sql);
        if($countGestionByWord && $countGestionByWord->num_rows>0){
            $result = $countGestionByWord;
        }else {
            $result = false;
        }
        return $result;
    }

    public function countGestionRangeDate(){
       
        $dateStart = ($this->getfechaStart())?$this->getfechaStart() : false ;
        $dateEnd = ($this->getfechaEnd())?$this->getfechaEnd() : false ;

        $sql = "SELECT COUNT(DISTINCT(g.id)) as 'count' FROM gestion g
        inner join equipos e on e.identificacion = g.identificacion 
        WHERE g.estado IN('RECUPERADO','AUTORIZAR','NO-TUVO-EQUIPO','NO-COINCIDE-SERIE','RECHAZADA','EN-USO',
        'N/TEL-EQUIVOCADO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO','ZONA-PELIGROSA',
        'DESCONOCIDO-TIT','DESHABITADO','EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
        'ENTREGO-EN-SUCURSAL') and g.status_gestion='transito' 
        and g.created_at BETWEEN('$dateStart') and ('$dateEnd 23:59:59');";
    
        $countGetGestionRangeDate = $this->db->query($sql);
        if($countGetGestionRangeDate && $countGetGestionRangeDate->fetch_object()->count > '0'){
            $result = $countGetGestionRangeDate;
        }else {
            $result = false;
        }
        
        return $result;
    }

    public function countGestionByWordAndDateRange(){

        $word = ($this->getWord())?$this->getWord() : false ;
        $dateStart = ($this->getFechaStart())?$this->getFechaStart() : false ;
        $dateEnd = ($this->getFechaEnd())?$this->getFechaEnd() : false ;

        $sql = "SELECT COUNT(DISTINCT(g.id)) as 'count' FROM gestion g
        inner join equipos e on e.identificacion = g.identificacion 
        WHERE g.estado IN('RECUPERADO','AUTORIZAR','NO-TUVO-EQUIPO','NO-COINCIDE-SERIE','RECHAZADA','EN-USO',
        'N/TEL-EQUIVOCADO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO','ZONA-PELIGROSA',
        'DESCONOCIDO-TIT','DESHABITADO','EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
        'ENTREGO-EN-SUCURSAL') and g.status_gestion='transito' 
        and g.id_user =$word and g.created_at BETWEEN('$dateStart') and ('$dateEnd 23:59:59');";

        $countGestionByWordAndDateRange = $this->db->query($sql);
        if($countGestionByWordAndDateRange && $countGestionByWordAndDateRange->fetch_object()->count > '0'){
            $result = $countGestionByWordAndDateRange;
        }else {
            $result = false;
        }
        
        return $result;
    }

    public function countFilterToGestionByFilter(){
        $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;

        $filterArray = explode(' ',$filter);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT COUNT(*) as 'count' ";
        $sql.="FROM  ";
        $sql.="equipos e INNER JOIN gestion g ON (g.id_equipo = e.id) ";
        $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
        $sql.="INNER JOIN users u ON (u.id = g.id_user) ";
        $sql.="WHERE ";
        $sql.="  ( ";
        $sql.="MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
        $sql.="AGAINST ('$filterClean' IN BOOLEAN MODE) ";
        $sql.=" )";

        $countFilterToGestionByFilter =  $this->db->query($sql);
        if($countFilterToGestionByFilter->num_rows>0){
            $result = $countFilterToGestionByFilter;
        }else {
            $result = false;
        }
        return $result;
    }

    public function countFilterToGestionByDateAndFilter(){

        $dateStart = !empty($this->getFechaStart()) ? $this-> getFechaStart(): false ;
        $dateEnd = !empty($this->getFechaEnd()) ? $this-> getFechaEnd(): false ;
        $filter = !empty($this->getFilter()) ? $this-> getFilter(): false ;
        $filterArray = explode(' ',$filter);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT COUNT(*) as 'count' ";
        $sql.="FROM  ";
        $sql.="equipos e INNER JOIN gestion g ON (g.id_equipo = e.id) ";
        $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
        $sql.="INNER JOIN users u ON (u.id = g.id_user) ";
        $sql.="WHERE ";
        $sql.="  ( ";
        $sql.="MATCH (e.empresa,e.identificacion,e.terminal,e.serie,e.provincia,e.localidad,
        e.direccion,e.codigo_postal,e.emailcliente) ";
        $sql.="AGAINST ";
        $sql.="('$filterClean' IN BOOLEAN MODE) ";
        $sql.="OR  ";
        $sql.="MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
        $sql.="AGAINST ('$filterClean' IN BOOLEAN MODE) ";
        $sql.="OR "; 
        $sql.="u.name LIKE '%$filter%') and g.created_at
        BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')";

        $countFilterToGestionByDateAndFilter =  $this->db->query($sql);
        if($countFilterToGestionByDateAndFilter->num_rows>0){
            $result = $countFilterToGestionByDateAndFilter;
        }else {
            $result = false;
        }
        return $result;
    }

    public function countFilterToGestionByWordAndDateAndFilter(){
        
        
        $dateStart = !empty($this->getFechaStart()) ? $this-> getFechaStart(): false ;
        $dateEnd = !empty($this->getFechaEnd()) ? $this-> getFechaEnd(): false ;
        $id_recolector = !empty($this->getId_recolector()) ? $this-> getId_recolector(): false ;
        $filter = !empty($this->getFilter()) ? $this-> getFilter(): false ;
        $filterArray = explode(' ',$filter);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT COUNT(*) as 'count' ";
        $sql.="FROM  ";
        $sql.="equipos e INNER JOIN gestion g ON (g.id_equipo = e.id) ";
        $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
        $sql.="INNER JOIN users u ON (u.id = g.id_user) ";
        $sql.="WHERE ";
        $sql.="  ( ";
        $sql.="MATCH (e.empresa,e.identificacion,e.terminal,e.serie,e.provincia,e.localidad,
        e.direccion,e.codigo_postal,e.emailcliente) ";
        $sql.="AGAINST ";
        $sql.="('$filterClean' IN BOOLEAN MODE) ";
        $sql.="OR  ";
        $sql.="MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
        $sql.="AGAINST ('$filterClean' IN BOOLEAN MODE) ";
        $sql.="OR "; 
        $sql.="u.name LIKE '%$filter%') and g.id_user = $id_recolector and g.created_at
        BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')";

    
        $countFilterToGestionByDateAndFilter =  $this->db->query($sql);
        if($countFilterToGestionByDateAndFilter->num_rows>0){
            $result = $countFilterToGestionByDateAndFilter;
        }else {
            $result = false;
        }
        return $result;
    }


    public function countEstadoGestionByRangeDate(){

        $dateStart = !empty($this->getfechaStart())?$this->getfechaStart() : false;
        $dateEnd = !empty($this->getfechaEnd())?$this->getfechaEnd() : false;   
        $result = false;
        $sql="";
        $sql.="SELECT IFNULL(g.estado,'Total') AS 'estado', COUNT(g.estado) as 'cantidadEstado'
        FROM gestion g INNER JOIN equipos e
        ON e.id=g.id_equipo
        WHERE g.estado IN('RECUPERADO','AUTORIZAR','NO-TUVO-EQUIPO','NO-COINCIDE-SERIE','RECHAZADA','EN-USO','N/TEL-EQUIVOCADO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO','ZONA-PELIGROSA','DESCONOCIDO-TIT','DESHABITADO','EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO','ENTREGO-EN-SUCURSAL') and status_gestion='transito' and ";
        $sql.= "g.created_at BETWEEN('$dateStart') and ('$dateEnd 23:59:59') GROUP BY g.estado WITH ROLLUP";

        $contador = $this->db->query($sql);
        if($contador && $contador->num_rows>0){

            $result = $contador;
        }else {
            $result = false;
        }
        return $result;
             
    }

    public function countEstadoGestionByWordAndRangeDate(){

        $word = !empty($this->getWord())?$this->getWord() : false;
        $dateStart = !empty($this->getfechaStart())?$this->getfechaStart() : false;
        $dateEnd = !empty($this->getfechaEnd())?$this->getfechaEnd() : false;
                
        $result = false;
        $sql="";
        $sql.="SELECT IFNULL(g.estado,'Total') AS 'estado', COUNT(g.estado) as 'cantidadEstado'
        FROM gestion g INNER JOIN equipos e
        ON e.id=g.id_equipo
        WHERE g.estado IN('RECUPERADO','AUTORIZAR','NO-TUVO-EQUIPO','NO-COINCIDE-SERIE','RECHAZADA','EN-USO','N/TEL-EQUIVOCADO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO','ZONA-PELIGROSA','DESCONOCIDO-TIT','DESHABITADO','EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO','ENTREGO-EN-SUCURSAL') and status_gestion='transito' ";
        $sql.= "and g.id_user = $word and g.created_at BETWEEN('$dateStart') and ('$dateEnd 23:59:59') GROUP BY g.estado WITH ROLLUP";

        $contador = $this->db->query($sql);

        if($contador && $contador->num_rows>0){

            $result = $contador;
        }else {
            $result = false;
        }

        return $result;
             
    }

    public function countEstadoGestionByWord(){

        $word = !empty($this->getWord())?$this->getWord() : false;
        
        $wordArray = explode(' ',$word);

        if(is_array($wordArray)){
            $wordPush = [];
            for($i=0;$i<count($wordArray);$i++){
                array_push($wordPush,'+"'.$wordArray[$i].'"');
            }
            $wordFinally = implode(",",$wordPush);
            $wordClean = str_replace(","," ",$wordFinally);
        }

        $result = false;
        $sql="";
        $sql.="SELECT IFNULL(g.estado,'Total') AS 'estado', COUNT(g.estado) as 'cantidadEstado'
        FROM gestion g INNER JOIN equipos e
        ON e.id=g.id_equipo
        WHERE g.estado IN('RECUPERADO','AUTORIZAR','NO-TUVO-EQUIPO','NO-COINCIDE-SERIE','RECHAZADA','EN-USO','N/TEL-EQUIVOCADO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO','ZONA-PELIGROSA','DESCONOCIDO-TIT','DESHABITADO','EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO','ENTREGO-EN-SUCURSAL') and status_gestion='transito' ";
        $sql.="and ( MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
        $sql.="AGAINST ('$wordClean' IN BOOLEAN MODE) ) ";
        $sql.= "GROUP BY g.estado WITH ROLLUP";

        $contador = $this->db->query($sql);

        if($contador && $contador->num_rows>0){

            $result = $contador;
        }else {
            $result = false;
        }

        return $result;

    }
   
    //BUSCADORES DIRECTOS DE GESTION PARA TABLAS

    public function equiposByWord(){

        $word = ($this->getWord())?$this->getWord() : false ;
        $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
        $limit = ($this->getLimit())?$this->getLimit() : false ;
        if(gettype($fromRow) !==  'string'){
            $fromRow = '0';
        }
        $wordArray = explode(' ',$word);

        if(is_array($wordArray)){
            $wordPush = [];
            for($i=0;$i<count($wordArray);$i++){
                array_push($wordPush,'+"'.$wordArray[$i].'"');
            }
            $wordFinally = implode(",",$wordPush);
            $wordClean = str_replace(","," ",$wordFinally);
        }

        
        $sql ="";
        $sql.= "SELECT g.id,g.id_orden_pass, g.id_orden, g.id_user, g.terminal, g.serie,
        g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,
        g.accesorio_tres,g.accesorio_cuatro,g.estado,g.motivo,g.created_at,e.empresa,e.identificacion,e.nombre_cliente,e.direccion, e.provincia, e.localidad, e.codigo_postal ,u.name,u.name,g.lat as 'latGestion' ,g.lng as 'lngGestion',n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.contacto,n.created_at as 'fecha_aviso_visita' ";
        $sql.="FROM  ";
        $sql.="equipos e LEFT JOIN gestion g ON (g.id_equipo = e.id) ";
        $sql.="LEFT JOIN users u ON (u.id = g.id_user) ";
        $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
        $sql.="WHERE ";
        $sql.="(";
        $sql.="MATCH (e.empresa,e.terminal,e.serie,e.identificacion,e.direccion,e.localidad,e.codigo_postal,e.provincia,e.emailcliente,e.estado) ";
        $sql.="AGAINST ('$wordClean' IN BOOLEAN MODE) ) ";
        $sql.="limit $fromRow,$limit ";

    
        $gestionByWord = $this->db->query($sql);
        if($gestionByWord && $gestionByWord->num_rows>0){
            $result = $gestionByWord;
        }else {
            $result = false;
        }

        return $result;

}

    public function gestionByWord(){

                $word = ($this->getWord())?$this->getWord() : false ;
                $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
                $limit = ($this->getLimit())?$this->getLimit() : false ;
                if(gettype($fromRow) !==  'string'){
                    $fromRow = '0';
                }
                $wordArray = explode(' ',$word);

                if(is_array($wordArray)){
                    $wordPush = [];
                    for($i=0;$i<count($wordArray);$i++){
                        array_push($wordPush,'+"'.$wordArray[$i].'"');
                    }
                    $wordFinally = implode(",",$wordPush);
                    $wordClean = str_replace(","," ",$wordFinally);
                }

                $sql ="";
                $sql.= "SELECT g.id,g.id_orden_pass, g.id_orden, g.id_user, g.terminal, g.serie,
                g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,
                g.accesorio_tres,g.accesorio_cuatro,g.estado,g.motivo,g.created_at,e.empresa,e.identificacion,e.nombre_cliente,e.direccion, e.provincia, e.localidad, e.codigo_postal ,u.name,u.name,g.lat as 'latGestion' ,g.lng as 'lngGestion',n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.contacto,n.created_at as 'fecha_aviso_visita' ";
                $sql.="FROM  ";
                $sql.="equipos e INNER JOIN gestion g ON (g.id_equipo = e.id) ";
                $sql.="INNER JOIN users u ON (u.id = g.id_user) ";
                $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
                $sql.="WHERE ";
                $sql.="(";
                $sql.="MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
                $sql.="AGAINST ('$wordClean' IN BOOLEAN MODE) ) ";
                $sql.="order BY g.created_at desc limit $fromRow,$limit ";

            
                $gestionByWord = $this->db->query($sql);
                if($gestionByWord && $gestionByWord->num_rows>0){
                    $result = $gestionByWord;
                }else {
                    $result = false;
                }

                return $result;

    }

    public function gestionByRangeDate(){
           
        $dateStart = ($this->getfechaStart())?$this->getfechaStart() : false ;
        $dateEnd = ($this->getfechaEnd())?$this->getfechaEnd() : false ;
        $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
        $limit = ($this->getLimit())?$this->getLimit() : false ;
        if(gettype($fromRow) !==  'string'){
            $fromRow = '0';
        }
            $result = false;
            $sql ="";
            $sql.= "SELECT g.id,g.id_orden_pass, g.id_orden, g.id_user, g.terminal, g.serie,
            g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,
            g.accesorio_tres,g.accesorio_cuatro,g.estado,g.motivo,g.created_at,e.empresa,e.identificacion,e.nombre_cliente,e.direccion, e.provincia, e.localidad, e.codigo_postal ,u.name,u.name,g.lat as 'latGestion' ,g.lng as 'lngGestion',n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.contacto,n.created_at as 'fecha_aviso_visita' ";
            $sql.= "from gestion g inner join equipos e on e.identificacion = g.identificacion left join users u ON u.id = g.id_user
            LEFT JOIN notice n ON g.id_orden_pass = n.id_orden  ";  
            $sql.="WHERE g.estado IN('RECUPERADO','AUTORIZAR','NO-TUVO-EQUIPO','NO-COINCIDE-SERIE','RECHAZADA','EN-USO','N/TEL-EQUIVOCADO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO','ZONA-PELIGROSA','DESCONOCIDO-TIT','DESHABITADO','EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO','ENTREGO-EN-SUCURSAL') and g.status_gestion='transito' ";
            $sql.="and g.created_at BETWEEN('$dateStart') and ('$dateEnd 23:59:59') GROUP BY g.id ORDER BY g.created_at DESC LIMIT $fromRow,$limit";
        
            $transito = $this->db->query($sql);
            
            if($transito && $transito->num_rows>0){
                $result = $transito;
            
            }else{
                $result = false;
            }
            return $result;
               
    }

    public function gestionByWordAndRangeDate(){

        $dateStart = ($this->getfechaStart())?$this->getfechaStart() : false ;
        $dateEnd = ($this->getfechaEnd())?$this->getfechaEnd() : false ;
        $word = ($this->getWord())?$this->getWord() : false ;
        $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
        $limit = ($this->getLimit())?$this->getLimit() : false ;
        if(gettype($fromRow) !==  'string'){
            $fromRow = '0';
        }
            $result = false;
            $sql ="";
            $sql.= "SELECT g.id,g.id_orden_pass, g.id_orden, g.id_user, g.terminal, g.serie,
            g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,
            g.accesorio_tres,g.accesorio_cuatro,g.estado,g.motivo,g.created_at,e.empresa,e.identificacion,e.nombre_cliente,e.direccion, e.provincia, e.localidad, e.codigo_postal ,u.name,u.name,g.lat as 'latGestion' ,g.lng as 'lngGestion',n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.contacto,n.created_at as 'fecha_aviso_visita' ";
            $sql.= "from gestion g inner join equipos e on e.identificacion = g.identificacion left join users u ON u.id = g.id_user
            LEFT JOIN notice n ON g.id_orden_pass = n.id_orden  ";  
            $sql.="WHERE g.estado IN('RECUPERADO','AUTORIZAR','NO-TUVO-EQUIPO','NO-COINCIDE-SERIE','RECHAZADA','EN-USO','N/TEL-EQUIVOCADO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO','ZONA-PELIGROSA','DESCONOCIDO-TIT','DESHABITADO','EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO','ENTREGO-EN-SUCURSAL') and g.status_gestion='transito' ";
            $sql.="and g.id_user = $word and g.created_at BETWEEN('$dateStart') and ('$dateEnd 23:59:59') GROUP BY g.id ORDER BY g.created_at DESC LIMIT $fromRow,$limit";

            $getGestionByWordAndRangeDate = $this->db->query($sql);
            
            if($getGestionByWordAndRangeDate && $getGestionByWordAndRangeDate->num_rows>0){
                $result = $getGestionByWordAndRangeDate;
            
            }else{
                $result = false;
            }
            return $result;
       
    }
     // filter word

    public function getDataFilterToGestionByWord(){
        $word = !empty($this->getWord()) ? $this->getWord() : false ;
        $fromRow = !empty($this->getFromRow()) ? $this->getFromRow() : false ;
        $limit = !empty($this->getLimit()) ? $this->getLimit() : false ;
        if(gettype($fromRow) !==  'string'){
            $fromRow = '0';
        }
        $wordArray = explode(' ',$word);

        if(is_array($wordArray)){
            $wordPush = [];
            for($i=0;$i<count($wordArray);$i++){
                array_push($wordPush,'+"'.$wordArray[$i].'"');
            }
            $wordFinally = implode(",",$wordPush);
            $wordClean = str_replace(","," ",$wordFinally);
        }
       
        $sql ="";
        $sql.="SELECT e.empresa,e.nombre_cliente,e.direccion,localidad,e.codigo_postal,e.provincia,e.emailcliente,e.nombre_cliente,g.id,
        g.id_orden_pass,g.id_orden,g.id_user,g.identificacion,g.terminal,g.serie,g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,g.accesorio_tres,g.accesorio_cuatro,g.motivo,g.created_at,g.lat as 'latGestion',g.lng as 'lngGestion',g.estado,u.name,n.means,n.contacto,n.lat as 'latAviso',n.lng as 'lngAviso',
        n.created_at AS 'fecha_aviso_visita' ";
        $sql.="FROM  ";
        $sql.="equipos e INNER JOIN gestion g ON (g.id_equipo = e.id) ";
        $sql.="INNER JOIN users u ON (u.id = g.id_user) ";
        $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
        $sql.="WHERE ";
        $sql.="(";
        $sql.="MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
        $sql.="AGAINST ('$wordClean' IN BOOLEAN MODE) )";
        $sql.="limit $fromRow,$limit ";

        $getDataFilterToGestionByWord =  $this->db->query($sql);
        if($getDataFilterToGestionByWord->num_rows>0){
            $result = $getDataFilterToGestionByWord;
        }else {
            $result = false;
        }

        return $result;

    }

    public function getDataFilterToGestionByDateAndFilter(){

            $dateStart = !empty($this->getFechaStart()) ? $this->getFechaStart() : false ;
            $dateEnd = !empty($this->getFechaEnd()) ? $this->getFechaEnd() : false ;
            $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;
            $fromRow = !empty($this->getFromRow()) ? $this->getFromRow() : false ;
            $limit = !empty($this->getLimit()) ? $this->getLimit() : false ;
            if(gettype($fromRow) !==  'string'){
                $fromRow = '0';
            }
            $filterArray = explode(' ',$filter);

                if(is_array($filterArray)){
                    $filterPush = [];
                    for($i=0;$i<count($filterArray);$i++){
                        array_push($filterPush,'+"'.$filterArray[$i].'"');
                    }
                    $filterFinally = implode(",",$filterPush);
                    $filterClean = str_replace(","," ",$filterFinally);
                }
           
           
            $sql ="";
            $sql.="SELECT e.empresa,e.nombre_cliente,e.direccion,localidad,e.codigo_postal,e.provincia,e.emailcliente,e.nombre_cliente,g.id,
            g.id_orden_pass,g.id_orden,g.id_user,g.identificacion,g.terminal,g.serie,g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,g.accesorio_tres,g.accesorio_cuatro,g.motivo,g.created_at,g.lat as 'latGestion',g.lng as 'lngGestion',g.estado,u.name,n.means,n.contacto,n.lat as 'latAviso',n.lng as 'lngAviso',
            n.created_at AS 'fecha_aviso_visita' ";
            $sql.="FROM  ";
            $sql.="equipos e INNER JOIN gestion g ON (g.id_equipo = e.id) ";
            $sql.="INNER JOIN users u ON (u.id = g.id_user) ";
            $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
            $sql.="WHERE ";
            $sql.="(";
            $sql.="MATCH (e.empresa,e.identificacion,e.terminal,e.serie,e.provincia,e.localidad,
            e.direccion,e.codigo_postal,e.emailcliente) AGAINST ";
            $sql.="('$filterClean' IN BOOLEAN MODE) ";
            $sql.="OR  ";
            $sql.="MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
            $sql.="AGAINST ('$filterClean' IN BOOLEAN MODE) ";
            $sql.="OR "; 
            $sql.="u.name LIKE '%$filter%') and g.created_at
            BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')";
            $sql.="limit $fromRow,$limit ";
            
            $getDataFilterToGestionByDateAndFilter =  $this->db->query($sql);
            if($getDataFilterToGestionByDateAndFilter->num_rows>0){
                $result = $getDataFilterToGestionByDateAndFilter;
            }else {
                $result = false;
            }
    
            return $result;
    }

    public function getDataFilterToGestionByDateAndWordAndFilter(){

        $dateStart = !empty($this->getFechaStart()) ? $this-> getFechaStart(): false ;
        $dateEnd = !empty($this->getFechaEnd()) ? $this-> getFechaEnd(): false ;
        $id_recolector = !empty($this->getId_recolector()) ? $this-> getId_recolector(): false ;
        $filter = !empty($this->getFilter()) ? $this-> getFilter(): false ;
        $fromRow = !empty($this->getFromRow()) ? $this->getFromRow() : false ;
        $limit = !empty($this->getLimit()) ? $this->getLimit() : false ;
        if(gettype($fromRow) !==  'string'){
            $fromRow = '0';
        }
        $filterArray = explode(' ',$filter);
        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT e.empresa,e.nombre_cliente,e.direccion,localidad,e.codigo_postal,e.provincia,e.emailcliente,e.nombre_cliente,g.id,
        g.id_orden_pass,g.id_orden,g.id_user,g.identificacion,g.terminal,g.serie,g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,g.accesorio_tres,g.accesorio_cuatro,g.motivo,g.created_at,g.lat as 'latGestion',g.lng as 'lngGestion',g.estado,u.name,n.means,n.contacto,n.lat as 'latAviso',n.lng as 'lngAviso',
        n.created_at AS 'fecha_aviso_visita' ";
        $sql.="FROM  ";
        $sql.="equipos e INNER JOIN gestion g ON (g.id_equipo = e.id) ";
        $sql.="INNER JOIN users u ON (u.id = g.id_user) ";
        $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
        $sql.="WHERE ";
        $sql.="(";
        $sql.="MATCH (e.empresa,e.identificacion,e.terminal,e.serie,e.provincia,e.localidad,
        e.direccion,e.codigo_postal,e.emailcliente) AGAINST ";
        $sql.="('$filterClean' IN BOOLEAN MODE) ";
        $sql.="OR  ";
        $sql.="MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
        $sql.="AGAINST ('$filterClean' IN BOOLEAN MODE) ";
        $sql.="OR "; 
        $sql.="u.name LIKE '%$filter%') and g.id_user = $id_recolector  and g.created_at
        BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')";
        $sql.="limit $fromRow,$limit ";
        
        $getDataFilterToGestionByDateAndFilter =  $this->db->query($sql);
        if($getDataFilterToGestionByDateAndFilter->num_rows>0){
            $result = $getDataFilterToGestionByDateAndFilter;
        }else {
            $result = false;
        }

        return $result;


    }

    // end filter word

    // export

    public function getDataManagementExportByWord(){

        $word = !empty($this->getWord()) ? $this->getWord() : false ;
        $wordArray = explode(' ',$word);
        if(is_array($wordArray)){
            $wordPush = [];
            for($i=0;$i<count($wordArray);$i++){
                array_push($wordPush,'+"'.$wordArray[$i].'"');
            }
            $wordFinally = implode(",",$wordPush);
            $wordClean = str_replace(","," ",$wordFinally);
        }

        $sql ="";
        $sql.="SELECT e.empresa,e.nombre_cliente,e.direccion,localidad,e.codigo_postal,e.provincia,e.emailcliente,e.nombre_cliente,
        g.id_orden_pass,g.id_orden,g.id_user,g.identificacion,g.terminal,g.serie,g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,g.accesorio_tres,g.accesorio_cuatro,g.motivo,g.created_at,g.lat as 'latGestion',g.lng as 'lngGestion',g.estado,u.name,n.means,n.contacto,n.lat as 'latAviso',n.lng as 'lngAviso',
        n.created_at AS 'fecha_aviso_visita' ";
        $sql.="FROM  ";
        $sql.="equipos e INNER JOIN gestion g ON (g.id_equipo = e.id) ";
        $sql.="INNER JOIN users u ON (u.id = g.id_user) ";
        $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
        $sql.="WHERE ";
        $sql.="(";
        $sql.="MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
        $sql.="AGAINST ('$wordClean' IN BOOLEAN MODE) )";

        $getDataManagementExportByWord =  $this->db->query($sql);
        if($getDataManagementExportByWord->num_rows>0){
            $result = $getDataManagementExportByWord;
        }else {
            $result = false;
        }

        return $result;


    }

    public function getDataManagementExportByDateRange(){

        $dateStart = !empty($this->getFechaStart()) ? $this->getFechaStart() : false ;
        $dateEnd = !empty($this->getFechaEnd()) ? $this->getFechaEnd() : false ;

        $sql ="";
        $sql.= "SELECT g.id_orden_pass, g.id_orden, g.id_user, g.terminal, g.serie,
        g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,
        g.accesorio_tres,g.accesorio_cuatro,g.estado,g.motivo,g.created_at,e.empresa,e.identificacion,e.nombre_cliente,e.direccion, e.provincia, e.localidad, e.codigo_postal ,u.name,g.lat as 'latGestion' ,g.lng as 'lngGestion',n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.contacto,n.created_at as 'fecha_aviso_visita' ";
        $sql.= "from gestion g inner join equipos e on e.identificacion = g.identificacion left join users u ON u.id = g.id_user
        LEFT JOIN notice n ON g.id_orden_pass = n.id_orden  ";  
        $sql.="WHERE g.estado IN('RECUPERADO','AUTORIZAR','NO-TUVO-EQUIPO','NO-COINCIDE-SERIE','RECHAZADA','EN-USO','N/TEL-EQUIVOCADO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO','ZONA-PELIGROSA','DESCONOCIDO-TIT','DESHABITADO','EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO','ENTREGO-EN-SUCURSAL') and g.status_gestion='transito' and g.created_at BETWEEN('$dateStart') and ('$dateEnd 23:59:59') GROUP BY g.id ORDER BY g.created_at";

       

        $getDataManagementExportByDateRange = $this->db->query($sql);
        if($getDataManagementExportByDateRange->num_rows>0){
            $result = $getDataManagementExportByDateRange;
        }else {
            $result = false;
        }

        return $result;

    }

    public function getDataManagementExportByDateRangeAndFilter(){
        $dateStart = !empty($this->getFechaStart()) ? $this->getFechaStart() : false ;
        $dateEnd = !empty($this->getFechaEnd()) ? $this->getFechaEnd() : false ;
        $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;

        $filterArray = explode(' ',$filter);

                if(is_array($filterArray)){
                    $filterPush = [];
                    for($i=0;$i<count($filterArray);$i++){
                        array_push($filterPush,'+"'.$filterArray[$i].'"');
                    }
                    $filterFinally = implode(",",$filterPush);
                    $filterClean = str_replace(","," ",$filterFinally);
                }

        $sql ="";
        $sql.="SELECT e.empresa,e.nombre_cliente,e.direccion,localidad,e.codigo_postal,e.provincia,e.emailcliente,e.nombre_cliente,
        g.id_orden_pass,g.id_orden,g.id_user,g.identificacion,g.terminal,g.serie,g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,g.accesorio_tres,g.accesorio_cuatro,g.motivo,g.created_at,g.lat as 'latGestion',g.lng as 'lngGestion',g.estado,u.name,n.means,n.contacto,n.lat as 'latAviso',n.lng as 'lngAviso',
        n.created_at AS 'fecha_aviso_visita' ";
        $sql.="FROM  ";
        $sql.="equipos e INNER JOIN gestion g ON (g.id_equipo = e.id) ";
        $sql.="INNER JOIN users u ON (u.id = g.id_user) ";
        $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
        $sql.="WHERE ";
        $sql.="(";
        $sql.="MATCH (e.empresa,e.identificacion,e.terminal,e.serie,e.provincia,e.localidad,
        e.direccion,e.codigo_postal,e.emailcliente) AGAINST ";
        $sql.="('$filterClean' IN BOOLEAN MODE) ";
        $sql.="OR  ";
        $sql.="MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
        $sql.="AGAINST ('$filterClean' IN BOOLEAN MODE) ";
        $sql.="OR "; 
        $sql.="u.name LIKE '%$filter%') and g.created_at
        BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')";

        $getDataManagementExportByDateRangeAndFilter =  $this->db->query($sql);
        if($getDataManagementExportByDateRangeAndFilter->num_rows>0){
            $result = $getDataManagementExportByDateRangeAndFilter;
        }else {
            $result = false;
        }

        return $result;


    }

    public function getDataManagementExportByDateRangeAndWord(){

        $dateStart = !empty($this->getFechaStart()) ? $this->getFechaStart() : false ;
        $dateEnd = !empty($this->getFechaEnd()) ? $this->getFechaEnd() : false ;
        $word = !empty($this->getWord()) ? $this->getWord() : false ;

        $sql ="";
        $sql.= "SELECT g.id_orden_pass, g.id_orden, g.id_user, g.terminal, g.serie,
        g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,
        g.accesorio_tres,g.accesorio_cuatro,g.estado,g.motivo,g.created_at,e.empresa,e.identificacion,e.nombre_cliente,e.direccion, e.provincia, e.localidad, e.codigo_postal ,u.name,g.lat as 'latGestion' ,g.lng as 'lngGestion',n.lat as 'latAviso',n.lng as 'lngAviso',n.means,n.contacto,n.created_at as 'fecha_aviso_visita' ";
        $sql.= "from gestion g inner join equipos e on e.identificacion = g.identificacion left join users u ON u.id = g.id_user
        LEFT JOIN notice n ON g.id_orden_pass = n.id_orden  ";  
        $sql.="WHERE g.estado IN('RECUPERADO','AUTORIZAR','NO-TUVO-EQUIPO','NO-COINCIDE-SERIE','RECHAZADA','EN-USO','N/TEL-EQUIVOCADO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO','ZONA-PELIGROSA','DESCONOCIDO-TIT','DESHABITADO','EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO','ENTREGO-EN-SUCURSAL') and g.status_gestion='transito' and g.id_user = $word and g.created_at BETWEEN('$dateStart') and ('$dateEnd 23:59:59') GROUP BY g.id ORDER BY g.created_at";

        $getDataManagementExportByDateRangeAndWord = $this->db->query($sql);
        if($getDataManagementExportByDateRangeAndWord->num_rows>0){
            $result = $getDataManagementExportByDateRangeAndWord;
        }else {
            $result = false;
        }

        return $result;

    }
    
    public function getDataManagementExportByDateRangeAndWordAndFilter(){
        
        $dateStart = !empty($this->getFechaStart()) ? $this->getFechaStart() : false ;
        $dateEnd = !empty($this->getFechaEnd()) ? $this->getFechaEnd() : false ;
        $word = !empty($this->getWord()) ? $this->getWord() : false ;
        $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;
        $filterArray = explode(' ',$filter);

        if(is_array($filterArray)){
            $filterPush = [];
            for($i=0;$i<count($filterArray);$i++){
                array_push($filterPush,'+"'.$filterArray[$i].'"');
            }
            $filterFinally = implode(",",$filterPush);
            $filterClean = str_replace(","," ",$filterFinally);
        }

        $sql ="";
        $sql.="SELECT e.empresa,e.nombre_cliente,e.direccion,localidad,e.codigo_postal,e.provincia,e.emailcliente,e.nombre_cliente,
        g.id_orden_pass,g.id_orden,g.id_user,g.identificacion,g.terminal,g.serie,g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorio_uno,g.accesorio_dos,g.accesorio_tres,g.accesorio_cuatro,g.motivo,g.created_at,g.lat as 'latGestion',g.lng as 'lngGestion',g.estado,u.name,n.means,n.contacto,n.lat as 'latAviso',n.lng as 'lngAviso',
        n.created_at AS 'fecha_aviso_visita' ";
        $sql.="FROM  ";
        $sql.="equipos e INNER JOIN gestion g ON (g.id_equipo = e.id) ";
        $sql.="INNER JOIN users u ON (u.id = g.id_user) ";
        $sql.="LEFT JOIN notice n ON (n.id_orden = g.id_orden_pass) ";
        $sql.="WHERE ";
        $sql.="(";
        $sql.="MATCH (e.empresa,e.identificacion,e.terminal,e.serie,e.provincia,e.localidad,
        e.direccion,e.codigo_postal,e.emailcliente) AGAINST ";
        $sql.="('$filterClean' IN BOOLEAN MODE) ";
        $sql.="OR  ";
        $sql.="MATCH (g.id_orden_pass,g.identificacion,g.terminal,g.serie,g.tarjeta,g.estado) ";
        $sql.="AGAINST ('$filterClean' IN BOOLEAN MODE) ";
        $sql.="OR "; 
        $sql.="u.name LIKE '%$filter%') and g.id_user= $word and g.created_at
        BETWEEN('$dateStart') AND ('$dateEnd 23:59:59')";

        $getDataManagementExportByDateRangeAndWordAndFilter =  $this->db->query($sql);
        if($getDataManagementExportByDateRangeAndWordAndFilter->num_rows>0){
            $result = $getDataManagementExportByDateRangeAndWordAndFilter;
        }else {
            $result = false;
        }

        return $result;
    }
    //export

    public function getStatus(){
        $sql = "select estado from estado";
        $getstatus = $this->db->query($sql);
        if($getstatus->num_rows>0){
            $result = $getstatus;
        }else {
            $result = false;
        }
        return $result;
    }

    
    public function updateGestion(){

            $id_equipo = !empty($this->getId_equipo()) ?$this->getId_equipo() :false ;
            $id_user_update = !empty($this->getId_user_update()) ?$this->getId_user_update() :false ;
            $fecha_update = !empty($this->getFecha_momento()) ?$this->getFecha_momento() :false ;
            $terminal = !empty($this->getTerminal()) ?$this->getTerminal() :false ;
            $serie = !empty($this->getSerie()) ?$this->getSerie() :false ;
            $accesorio_uno = !empty($this->getAccesorioUno()) ?$this->getAccesorioUno() :false ;
            $accesorio_dos = !empty($this->getAccesorioDos()) ?$this->getAccesorioDos() :false ;
            $accesorio_tres = !empty($this->getAccesorioTres()) ?$this->getAccesorioTres() :false ;
            $accesorio_cuatro = !empty($this->getAccesorioCuatro()) ?$this->getAccesorioCuatro() :false ;
            $estado = !empty($this->getEstado()) ?$this->getEstado() :false ;

            $sql ="UPDATE gestion set updated_at='$fecha_update', id_user_update='$id_user_update', terminal='$terminal',serie='$serie',accesorio_uno= '$accesorio_uno', accesorio_dos='$accesorio_dos', accesorio_tres='$accesorio_tres', accesorio_cuatro='$accesorio_cuatro',estado='$estado' where id = $id_equipo";

            $updateGestion = $this->db->query($sql);
            if($updateGestion){
                $result = true;
            }else {
                $result = false;
            }

            return $result;

    }

    public function deleteGestion(){
        $id_equipo = !empty($this->getId_equipo()) ?$this->getId_equipo() :false ;
        $id_user_update = !empty($this->getId_user_update()) ?$this->getId_user_update() :false ;
        $fecha_update = !empty($this->getFecha_momento()) ?$this->getFecha_momento() :false ;

        $sql ="UPDATE gestion set status_gestion='OUT' , updated_at='$fecha_update', id_user_update=$id_user_update where id = $id_equipo";

        $deleteGestion = $this->db->query($sql);
        if($deleteGestion){
            $result = true;
        }else {
            $result = false;
        }
        return $result;
        
    }

    public function getStatusCustomer(){
      
              $result = false;

              
              $sql ="SELECT IFNULL(t.estado,'Total') AS 'estado', 
              COUNT(t.estado) AS 'cantidadEstado' FROM gestion t WHERE 
              t.identificacion='{$this->getIdentificacionCliente()}' and status_gestion='transito' GROUP BY t.estado WITH ROLLUP";
             
              $count = $this->db->query($sql);
             
              if($count && $count->num_rows>0){
                $result = $count;

              }else{
                  $result = false;
              }
              return $result;
          
    }

    public function getReportTransit(){
        $recolector =  !empty($this->getId_recolector()) ? $this->getId_recolector(): false ;
        $fechaStart =  !empty($this->getFechaStart()) ? $this->getFechaStart(): false ;
        $fechaEnd =  !empty($this->getfechaEnd()) ? $this->getfechaEnd(): false ;

         $result = false;
        if($recolector && $fechaStart && $fechaEnd){


            $sql ="	SELECT IFNULL(e.provincia,'Total por Provincias') AS 'provincia',IFNULL(e.localidad,'Total por localidad') AS 'localidad',IFNULL(e.codigo_postal,' Total por Codigo Postal') AS 'codigo_postal',
            SUM(CASE WHEN g.estado='RECUPERADO'  THEN 1 ELSE 0 END)  AS 'recuperado',
             SUM(CASE WHEN g.estado='AUTORIZAR'   THEN 1 ELSE 0 END)  AS 'autorizar',
             SUM(CASE WHEN g.estado='NO-TUVO-EQUIPO'   THEN 1 ELSE 0 END)  AS 'no-tuvo-equipo',
             SUM(CASE WHEN g.estado='NO-COINCIDE-SERIE'   THEN 1 ELSE 0 END)  AS 'no-coincide-serie',
             SUM(CASE WHEN g.estado='RECHAZADA'   THEN 1 ELSE 0 END)  AS 'rechazada',
             SUM(CASE WHEN g.estado='EN-USO'   THEN 1 ELSE 0 END)  AS 'en-uso',
             SUM(CASE WHEN g.estado='N/TEL-EQUIVOCADO'   THEN 1 ELSE 0 END)  AS 'n/tel-equivocado',
             SUM(CASE WHEN g.estado='NO-EXISTE-NUMERO'   THEN 1 ELSE 0 END)  AS 'no-existe-numero',
             SUM(CASE WHEN g.estado='NO-RESPONDE'   THEN 1 ELSE 0 END)  AS 'no-responde',
             SUM(CASE WHEN g.estado='TIEMPO-ESPERA'   THEN 1 ELSE 0 END)  AS 'tiempo-espera',
             SUM(CASE WHEN g.estado='SE-MUDO'   THEN 1 ELSE 0 END)  AS 'se-mudo',
             SUM(CASE WHEN g.estado='YA-RETIRADO'   THEN 1 ELSE 0 END)  AS 'ya-retirado',
             SUM(CASE WHEN g.estado='ZONA-PELIGROSA'   THEN 1 ELSE 0 END)  AS 'zona-peligrosa',
             SUM(CASE WHEN g.estado='DESHABITADO'   THEN 1 ELSE 0 END)  AS 'deshabitado',
             SUM(CASE WHEN g.estado='EXTRAVIADO'   THEN 1 ELSE 0 END)  AS 'extraviado',
             SUM(CASE WHEN g.estado='FALLECIO'   THEN 1 ELSE 0 END)  AS 'fallecio',
             SUM(CASE WHEN g.estado='FALTAN-DATOS'   THEN 1 ELSE 0 END)  AS 'faltan-datos',
             SUM(CASE WHEN g.estado='RECONECTADO'   THEN 1 ELSE 0 END)  AS 'reconectado',
             SUM(CASE WHEN g.estado='ROBADO'   THEN 1 ELSE 0 END)  AS 'robado',
             SUM(CASE WHEN g.estado='ENTREGO-EN-SUCURSAL'   THEN 1 ELSE 0 END)  AS 'entrego-en-sucursal',
             SUM(CASE WHEN e.empresa='POSNET'   THEN 1 ELSE 0 END)  AS 'posnet',
             SUM(CASE WHEN e.empresa='ANTINA'   THEN 1 ELSE 0 END)  AS 'antina',
             SUM(CASE WHEN e.empresa='INTV'   THEN 1 ELSE 0 END)  AS 'intv',
             SUM(CASE WHEN e.empresa='IPLAN'   THEN 1 ELSE 0 END)  AS 'iplan',
             SUM(CASE WHEN e.empresa='METROTEL'   THEN 1 ELSE 0 END)  AS 'metrotel',
             SUM(CASE WHEN e.empresa='LAPOS'   THEN 1 ELSE 0 END)  AS 'lapos',
             SUM(CASE WHEN e.empresa='CABLEVISION'   THEN 1 ELSE 0 END)  AS 'cablevision',
             SUM(CASE WHEN e.empresa='CABLEVISION URUGUAY'   THEN 1 ELSE 0 END)  AS 'cablevision uruguay',
             SUM(CASE WHEN g.created_at >= '$fechaStart' AND g.created_at <= '$fechaEnd%' and g.id_user='$recolector' THEN 1 ELSE 0 END)  AS 'total'
            
             FROM equipos AS e
             INNER JOIN gestion as g ON e.id=g.id_equipo
             where g.status_gestion ='transito' and g.id_user='$recolector' and g.created_at >= '$fechaStart' AND g.created_at <= '$fechaEnd%'
             GROUP BY e.codigo_postal ORDER BY e.codigo_postal ASC";
            

             
             $informe = $this->db->query($sql);
             if($informe && $informe->num_rows>0){

                 $result = $informe;
             }else{
                 $result = false;
             }
             return $result;
             
        }
        if(!$recolector && $fechaStart && $fechaEnd ){


            $sql ="	SELECT IFNULL(e.provincia,'Total por Provincias') AS 'provincia',IFNULL(e.localidad,'Total por localidad') AS 'localidad',IFNULL(e.codigo_postal,' Total por Codigo Postal') AS 'codigo_postal',
            SUM(CASE WHEN g.estado='RECUPERADO' THEN 1 ELSE 0 END)  AS 'recuperado',
             SUM(CASE WHEN g.estado='AUTORIZAR'  THEN 1 ELSE 0 END)  AS 'autorizar',
             SUM(CASE WHEN g.estado='NO-TUVO-EQUIPO'  THEN 1 ELSE 0 END)  AS 'no-tuvo-equipo',
             SUM(CASE WHEN g.estado='NO-COINCIDE-SERIE'  THEN 1 ELSE 0 END)  AS 'no-coincide-serie',
             SUM(CASE WHEN g.estado='RECHAZADA'  THEN 1 ELSE 0 END)  AS 'rechazada',
             SUM(CASE WHEN g.estado='EN-USO'  THEN 1 ELSE 0 END)  AS 'en-uso',
             SUM(CASE WHEN g.estado='N/TEL-EQUIVOCADO'  THEN 1 ELSE 0 END)  AS 'n/tel-equivocado',
             SUM(CASE WHEN g.estado='NO-EXISTE-NUMERO'  THEN 1 ELSE 0 END)  AS 'no-existe-numero',
             SUM(CASE WHEN g.estado='NO-RESPONDE'  THEN 1 ELSE 0 END)  AS 'no-responde',
             SUM(CASE WHEN g.estado='TIEMPO-ESPERA'  THEN 1 ELSE 0 END)  AS 'tiempo-espera',
             SUM(CASE WHEN g.estado='SE-MUDO'  THEN 1 ELSE 0 END)  AS 'se-mudo',
             SUM(CASE WHEN g.estado='YA-RETIRADO'  THEN 1 ELSE 0 END)  AS 'ya-retirado',
             SUM(CASE WHEN g.estado='ZONA-PELIGROSA'  THEN 1 ELSE 0 END)  AS 'zona-peligrosa',
             SUM(CASE WHEN g.estado='DESHABITADO'  THEN 1 ELSE 0 END)  AS 'deshabitado',
             SUM(CASE WHEN g.estado='EXTRAVIADO'  THEN 1 ELSE 0 END)  AS 'extraviado',
             SUM(CASE WHEN g.estado='FALLECIO'  THEN 1 ELSE 0 END)  AS 'fallecio',
             SUM(CASE WHEN g.estado='FALTAN-DATOS'  THEN 1 ELSE 0 END)  AS 'faltan-datos',
             SUM(CASE WHEN g.estado='RECONECTADO'  THEN 1 ELSE 0 END)  AS 'reconectado',
             SUM(CASE WHEN g.estado='ROBADO'  THEN 1 ELSE 0 END)  AS 'robado',
             SUM(CASE WHEN g.estado='ENTREGO-EN-SUCURSAL'  THEN 1 ELSE 0 END)  AS 'entrego-en-sucursal',
             SUM(CASE WHEN e.empresa='POSNET'  THEN 1 ELSE 0 END)  AS 'posnet',
             SUM(CASE WHEN e.empresa='ANTINA'  THEN 1 ELSE 0 END)  AS 'antina',
             SUM(CASE WHEN e.empresa='INTV'  THEN 1 ELSE 0 END)  AS 'intv',
             SUM(CASE WHEN e.empresa='IPLAN'  THEN 1 ELSE 0 END)  AS 'iplan',
             SUM(CASE WHEN e.empresa='METROTEL'  THEN 1 ELSE 0 END)  AS 'metrotel',
             SUM(CASE WHEN e.empresa='LAPOS'  THEN 1 ELSE 0 END)  AS 'lapos',
             SUM(CASE WHEN e.empresa='CABLEVISION'  THEN 1 ELSE 0 END)  AS 'cablevision',
             SUM(CASE WHEN e.empresa='CABLEVISION URUGUAY'  THEN 1 ELSE 0 END)  AS 'cablevision uruguay',
             SUM(CASE WHEN  g.created_at >= '$fechaStart' AND g.created_at <= '$fechaEnd%' THEN 1 ELSE 0 END)  AS 'total'
            
             FROM equipos AS e
             INNER JOIN gestion as g ON e.id=g.id_equipo
             where g.status_gestion ='transito' and g.created_at >= '$fechaStart' AND g.created_at <= '$fechaEnd%'
             GROUP BY e.codigo_postal ORDER BY e.codigo_postal ASC";

             
             $informe = $this->db->query($sql);
             if($informe && $informe->num_rows>0){

                 $result = $informe;
             }else{
                 $result = false;
             }
             return $result;


        }
        
      
        
    }

    public function getReportAllCollector(){
        $fechaStart =  !empty($this->getfechaStart()) ? $this->getfechaStart() : false;
        $fechaEnd = !empty($this->getfechaEnd()) ? $this->getfechaEnd() : false;

        if($fechaStart && $fechaEnd){
            $result = false;
            $sql = "SELECT  IFNULL(g.id_user,'Total') AS 'recolector',IFNULL(u.name,'recolector') AS 'name',
             SUM(CASE WHEN g.estado='RECUPERADO'  THEN 1 ELSE 0 END)  AS 'recuperado',
             SUM(CASE WHEN g.estado='AUTORIZAR'  THEN 1 ELSE 0 END)  AS 'autorizar',
             SUM(CASE WHEN g.estado='NO-TUVO-EQUIPO'  THEN 1 ELSE 0 END)  AS 'no-tuvo-equipo',
             SUM(CASE WHEN g.estado='NO-COINCIDE-SERIE'  THEN 1 ELSE 0 END)  AS 'no-coincide-serie',
             SUM(CASE WHEN g.estado='RECHAZADA'  THEN 1 ELSE 0 END)  AS 'rechazada',
             SUM(CASE WHEN g.estado='EN-USO'  THEN 1 ELSE 0 END)  AS 'en-uso',
             SUM(CASE WHEN g.estado='N/TEL-EQUIVOCADO'  THEN 1 ELSE 0 END)  AS 'n/tel-equivocado',
             SUM(CASE WHEN g.estado='NO-EXISTE-NUMERO'  THEN 1 ELSE 0 END)  AS 'no-existe-numero',
             SUM(CASE WHEN g.estado='NO-RESPONDE'  THEN 1 ELSE 0 END)  AS 'no-responde',
             SUM(CASE WHEN g.estado='TIEMPO-ESPERA'  THEN 1 ELSE 0 END)  AS 'tiempo-espera',
             SUM(CASE WHEN g.estado='SE-MUDO'  THEN 1 ELSE 0 END)  AS 'se-mudo',
             SUM(CASE WHEN g.estado='YA-RETIRADO'  THEN 1 ELSE 0 END)  AS 'ya-retirado',
             SUM(CASE WHEN g.estado='ZONA-PELIGROSA'  THEN 1 ELSE 0 END)  AS 'zona-peligrosa',
             SUM(CASE WHEN g.estado='DESHABITADO'  THEN 1 ELSE 0 END)  AS 'deshabitado',
             SUM(CASE WHEN g.estado='EXTRAVIADO'  THEN 1 ELSE 0 END)  AS 'extraviado',
             SUM(CASE WHEN g.estado='FALLECIO'  THEN 1 ELSE 0 END)  AS 'fallecio',
             SUM(CASE WHEN g.estado='FALTAN-DATOS'  THEN 1 ELSE 0 END)  AS 'faltan-datos',
             SUM(CASE WHEN g.estado='RECONECTADO'  THEN 1 ELSE 0 END)  AS 'reconectado',
             SUM(CASE WHEN g.estado='ROBADO'  THEN 1 ELSE 0 END)  AS 'robado',
             SUM(CASE WHEN g.estado='ENTREGO-EN-SUCURSAL'  THEN 1 ELSE 0 END)  AS 'entrego-en-sucursal',
             SUM(CASE WHEN e.empresa='POSNET'  THEN 1 ELSE 0 END)  AS 'posnet',
             SUM(CASE WHEN e.empresa='ANTINA'  THEN 1 ELSE 0 END)  AS 'antina',
             SUM(CASE WHEN e.empresa='INTV'  THEN 1 ELSE 0 END)  AS 'intv',
             SUM(CASE WHEN e.empresa='IPLAN'  THEN 1 ELSE 0 END)  AS 'iplan',
             SUM(CASE WHEN e.empresa='METROTEL'  THEN 1 ELSE 0 END)  AS 'metrotel',
             SUM(CASE WHEN e.empresa='LAPOS'  THEN 1 ELSE 0 END)  AS 'lapos',
             SUM(CASE WHEN e.empresa='CABLEVISION'  THEN 1 ELSE 0 END)  AS 'cablevision',
             SUM(CASE WHEN e.empresa='CABLEVISION URUGUAY'  THEN 1 ELSE 0 END)  AS 'cablevision_uruguay',
             SUM(CASE WHEN g.estado IN('RECUPERADO','AUTORIZAR')  THEN 1 ELSE 0 END)  AS 'total_recuperados',
             SUM(CASE WHEN g.id_user=g.id_user and g.created_at >= '$fechaStart' AND g.created_at <= '$fechaEnd%' THEN 1 ELSE 0 END) AS 'total_gestionados'
             FROM equipos AS e 
             INNER JOIN gestion as g ON e.id=g.id_equipo
             left join users u on u.id = g.id_user
             where g.status_gestion ='transito' and g.created_at >= '$fechaStart' AND g.created_at <= '$fechaEnd%' 
             GROUP BY g.id_user WITH ROLLUP";

          

        
             $recolectores = $this->db->query($sql);
             if($recolectores && $recolectores->num_rows>0){
                

                $result = $recolectores;
             }else{
                 $result = false;
             }
             return $result;
        }
    }

}

    class EquiposExtra extends Equipos
    {
       
        protected $telefonoNuevo;
        protected $nombre;
        protected $apellido;
        protected $tipoDocNuevo;
        protected $tabla;
        protected $cod;
        protected $email;
        protected $pais;
        protected $provincia;
        protected $localidad;
        protected $direccion;
        protected $codigoPostal;
        protected $elemento;

        //get::::::
        
        public function getTelefonoNuevo()
        {
            return $this->telefonoNuevo;
        }
    
        public function getNombre()
        {
            return $this->nombre;
        }
        public function getApellido()
        {
            return $this->apellido;
        }
        public function getTipoDocNuevo()
        {
            return $this->tipoDocNuevo;
        }
        public function getTabla()
        {
            return $this->tabla;
        }
        public function getCod()
        {
            return $this->cod;
        }
        public function getElemento()
        {
            return $this->elemento;
        }

        public function getPais()
        {
            return $this->pais;
        }
    
        public function getProvincia()
        {
                return $this->provincia;
        }

        public function getLocalidad()
        {
            return $this->localidad;
        }

        public function getDireccion()
        {
            return $this->direccion;
        }
    
        public function getCodigoPostal()
        {
                return $this->codigoPostal;
        }

        //set::::::

        public function setTelefonoNuevo($telefonoNuevo)
        {
            $this->telefonoNuevo = $this->db->real_escape_string($telefonoNuevo);
        }
        
        public function setNombre($nombre)
        {
            $this->nombre = $this->db->real_escape_string($nombre);
        }
        public function setApellido($apellido)
        {
            $this->apellido = $this->db->real_escape_string($apellido);
        }
        public function setTipoDocNuevo($tipoDocNuevo)
        {
            $this->tipoDocNuevo = $this->db->real_escape_string($tipoDocNuevo);
        }
        public function setTabla($tabla)
        {
            $this->tabla = $this->db->real_escape_string($tabla);
        }

        public function setCod($cod)
        {
            $this->cod = $this->db->real_escape_string($cod);
        }

        public function setElemento($elemento)
        {
            $this->elemento = $elemento;
        }

        public function setPais($pais)
        {
            $this->pais = $this->db->real_escape_string($pais);
        } 

        public function setProvincia($provincia)
        {
                $this->provincia = $this->db->real_escape_string($provincia);
        }

        public function setLocalidad($localidad)
        {

            $this->localidad = $this->db->real_escape_string($localidad);
        }

        public function setDireccion($direccion)
        {
            $this->direccion = $this->db->real_escape_string($direccion);
        }
       
        
        public function setCodigoPostal($codigoPostal)
        {
            $this->codigoPostal = $this->db->real_escape_string($codigoPostal);
        }


        //metodos 



        public function addNewCostumer()
        {

            if ($_POST) {

                $result = false;
                if ($this->getTabla() === 'nuevos_clientes') {
                    $status = 'nuevo-cliente';
                }
                if ($this->getTabla() === 'clientes_consignacion') {
                    $status = 'A-consignacion';
                }

                $sql = "INSERT INTO {$this->getTabla()} (documento,numero_documento,nombre,apellido,
                            direccion,provincia,localidad,codigo_postal,telefono,email,
                            empresa,terminal,serie,modelo,motivo_solicitud,created_at,motivo_interno,
                            id_user) values ('{$this->getTipoDocNuevo()}','{$this->getIdentificacionCliente()}','{$this->getNombre()}','{$this->getApellido()}','{$this->getDireccion()}','{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getCodigoPostal()}','{$this->getTelefonoNuevo()}','{$this->getEmail()}','{$this->getEmpresa()}','{$this->getTerminal()}','{$this->getSerie()}','{$this->getModelo()}','{$this->getMotivoRetiro()}','{$this->getFecha_momento()}','$status',{$this->getId_recolector()})";

                        

                $cliente = $this->db->query($sql);

                if ($cliente) {

                    $result = true;
                } else {
                    $result = false;
                }
                return $result;
            }
        }
        public function addNewCustomersInBase(){
            if($_POST){
                $result = false;
                $sql = "INSERT INTO equipos (id_local,cod_empresa,empresa,identificacion,idd,
                provincia,localidad,direccion,codigo_postal,serie,terminal,tarjeta,nombre_cliente,emailcliente,telefono1,cartera,id_user,fecha_add) values ('{$this->getGuiaEquipo()}','{$this->getCod()}','{$this->getEmpresa()}','{$this->getIdentificacionCliente()}','{$this->getIdd()}','{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}','{$this->getCodigoPostal()}','{$this->getSerie()}','{$this->getTerminal()}','{$this->getTarjeta()}','{$this->getNombre()}','{$this->getEmail()}','{$this->getTelefonoNuevo()}','{$this->getCartera()}','{$this->getId_user_update()}','{$this->getFecha_momento()}')";
            
                $cliente = $this->db->query($sql);

                if($cliente){

                    $result = 'insert';
                }else {
                    $result = 'noinsert';
                }
                return $result;
            }
        }

        public function saveDataCustomer(){
            $id_recolector = !empty($this->getId_recolector()) ? $this->getId_recolector() : false ;
            $orden = !empty($this->getOrden()) ? $this->getOrden() : false ;
            $identificacionCliente = !empty($this->getIdentificacionCliente()) ? $this->getIdentificacionCliente() : false ;
            $telefono = !empty($this->getTelefonoNuevo()) ? $this->getTelefonoNuevo() : '' ;
            $email = !empty($this->getEmail()) ? $this->getEmail() : '' ;
            $fecha = !empty($this->getFecha_momento()) ? $this->getFecha_momento() : '' ;
            $elemento = !empty($this->getElemento()) ? $this->getElemento() : '' ;

            $sql ="";
            $sql.="INSERT INTO datos_digitales (id_user,identificacion,id_orden,telefono,mail,created_at,elemento) values ($id_recolector,'$identificacionCliente','$orden','$telefono','$email','$fecha','$elemento')";
        
            $this->db->query($sql);

        }

        public function getAllPais(){
            $result = false;
            $sql = "SELECT * FROM country";
        
            
            $pais = $this->db->query($sql);
            if($pais && $pais->num_rows>0){
             $result = $pais;
            }else {
                $result = false;
            }
            return $result;
    
        }
    
        public function getSomeProvincia(){
            $result = false;
            
            $sql = "SELECT * FROM province where id_country='{$this->getPais()}' ORDER BY province asc";
           
            $province = $this->db->query($sql);
            if($province && $province->num_rows>0){
             $result = $province;
            }else {
                $result = false;
            }
            return $result;
    
        }

        public function getSomeLocalidad(){

            $id_provincia = !empty($this->getProvincia()) ?$this->getProvincia() :false ; 
    
            $result = false;
            if($id_provincia){
                
            $sql = "SELECT * from localities where id_province='{$this->getProvincia()}'";
             $localidad = $this->db->query($sql);
              if($localidad && $localidad->num_rows>0){
                  $result = $localidad;
    
              }else{
                  $result = false;
              }
    
              return $result;
    
            }
    
        }
    
       
    

        
    }
