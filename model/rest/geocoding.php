<?php 

class geocoding{


    private $id_country;
    private $country;
    private $province;
    private $locate;
    private $home_address;
    private $postal_code;
    private $latitud;
    private $longitud;

    public function __construct(){
        $this->db=Database::Connect();
    }

    public function setId_country($id_country){
        $this->id_country = $id_country;
    }
    public function setCountry($country){
        $this->country = $country;
    }

    public function setProvince($province){
        $this->province =  $province;
    }

    public function setLocate($locate){
        $this->locate = $locate;
    }

    public function setHome_address($home_address){
        $this->home_address = $home_address;
    }

    public function setPostal_code($postal_code){
        $this->postal_code = $postal_code;
    }

    public function setLatitud($latitud){
        $this->latitud = $latitud;
    }

    public function setLongitud($longitud){
        $this->longitud = $longitud;
    }



    public function getId_country(){
        return  $this->id_country;
    }
    public function getCountry(){
        return  $this->country;
    }

    public function getProvince(){
        return  $this->province;
    }

    public function getLocate(){
        return  $this->locate;
    }

    public function getHome_address(){
        return  $this->home_address;
    }

    public function getPostal_code(){
        return  $this->postal_code;
    }

    public function getLatitud(){
        return  $this->latitud;
    }

    public function getLongitud(){
        return  $this->longitud;
    }


    public function sendPost()
    {
        //datos a enviar
        $data = array('a' => 'a');

        //url contra la que atacamos
        $ch = curl_init("http://geo.correo.com.uy/serviciosv2/BusquedaDireccion");
        //a true, obtendremos una respuesta de la url, en otro caso, 
        //true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //establecemos el verbo http que queremos utilizar para la petición
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //enviamos el array data
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
        //obtenemos la respuesta
        $response = curl_exec($ch);
        // Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($ch);
        if(!$response) {
            return false;
        } else {
            return $response;
        }
    }

      
        public function sendPut()
        {
            //datos a enviar
            $data = array("a" => "a");
            //url contra la que atacamos
            $ch = curl_init("http://localhost/WebService/API_Rest/api.php");
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petición
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            //enviamos el array data
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
            if(!$response) {
                return false;
            }else{
                var_dump($response);
            }
        }

        public function sendGet()
        {

            $home_address = $this->getHome_address();
            $locate = $this->getLocate();
            $province = $this->getProvince();
            $country = $this->getCountry();
            $string = 'json?'.$home_address.','.$locate.','.$province.','.$country;
            $value = str_replace(' ','%20',$string);
        

            $api = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$value.'&key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko');

             return $api;

    

            
        }

        public function sendDelete()
        {
            //datos a enviar
            $data = array("a" => "a");
            //url contra la que atacamos
            $ch = curl_init("http://localhost/WebService/API_Rest/api.php");
            //a true, obtendremos una respuesta de la url, en otro caso, 
            //true si es correcto, false si no lo es
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //establecemos el verbo http que queremos utilizar para la petición
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            //enviamos el array data
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
            //obtenemos la respuesta
            $response = curl_exec($ch);
            // Se cierra el recurso CURL y se liberan los recursos del sistema
            curl_close($ch);
            if(!$response) {
                return false;
            }else{
                return $response;
            }
        }
    






}