<?php
if (isset($_GET['geocoding'])) {
    session_start();
    $accion = $_GET['geocoding'];
    $usuario = new geocodingController();
    $usuario->$accion();
} 

class geocodingController
{
    public function geocoding(){
        $home_address = isset($_GET['home_address']) ? $_GET['home_address'] : false ;
        $locate = isset($_GET['locate']) ? $_GET['locate'] : false ;
        $province = isset($_GET['province']) ? $_GET['province'] : false ;
        $country = isset($_GET['country']) ? $_GET['country'] : false ;
        $string = $home_address.','.$locate.','.$province.','.$country;
        $address = preg_replace('/\s+/','+',$string);
       
         // url encode the address
        $address = urlencode($address);
        
    
        // google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyDasdhwGs_A9SbZUezcx9VhSSGkxl46bko";
    
        // get the json response
        $resp_json = file_get_contents($url);
        
        // decode the json
        $resp = json_decode($resp_json, true);
       
        if($resp["status"] === 'OK'){
                // if($resp["results"][0]["geometry"]["location_type"] === 'ROOFTOP' ){
                    // get the important data
                    $lat = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
                    $long = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
                    $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";

                    if($lat && $long && $formatted_address){
                        // put the data in the array
                        $object = array(
                            'result'            => true,
                            'lat'               => $lat,
                            'lng'               => $long,
                            'formatted_addess'  => $formatted_address
                        );  
                    }else {
                        $object = array(
                            'error' => 'has_not_provided'
                        );
                    }
            // }else{
            //     $object = array(
            //         'error' => 'not_precise'
            //     );
            // }
        }else{
            $object = array(
                'error' => 'not_result'
            );
        }
        $jsonstring = json_encode($object);
        echo $jsonstring;
    }

}