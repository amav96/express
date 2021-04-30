<?php if (isset($_GET['geocoding'])) {

    require_once '../model/rest/geocoding.php';
    require_once '../config/db.php';

    session_start();
    $accion = $_GET['geocoding'];
    $geocoding = new geocodingController();
    $geocoding->$accion();
} else {

    require_once 'model/rest/geocoding.php';
}

class geocodingController
{


    public function rest()
    {


        $id_country = isset($_POST['object']['id_country']) ? $_POST['object']['id_country'] : false;
        if ($id_country == '1') {
            $country = 'Argentina';
        } else if ($id_country == '2') {
            $country = 'Uruguay';
        }
        $province = isset($_POST['object']['province']) ? $_POST['object']['province'] : false;
        $locate = isset($_POST['object']['locate']) ? $_POST['object']['locate'] : false;
        $home_address = isset($_POST['object']['home_address']) ? $_POST['object']['home_address'] : false;

            // $geocoding =  new geocoding();
            // $geocoding -> setCountry($country);
            // $geocoding -> setProvince($province);
            // $geocoding -> setLocate($locate);
            // $geocoding -> setHome_address($home_address);
            // $geocoding = $geocoding -> sendGet();

          $geocoding =  new geocoding();
        //   $geocoding->setCountry('uruguay');
        //   $geocoding->setProvince('paysandu');
        //   $geocoding->setLocate('san felix');
        //   $geocoding->setHome_address('uruguay paysandu san felix calle democracia y san felix');
        //   $geocoding = $geocoding->sendGet();

        $geocoding->setCountry('argentina');
        $geocoding->setProvince('ciudad autonoma de buenos aires');
        $geocoding->setLocate('parque patricios');
        $geocoding->setHome_address('cachi 408');
        $geocoding = $geocoding->sendGet();
        $arr=[];

        if ($geocoding) {

        
            $format = json_decode($geocoding);

            
            if (empty($format->results)) {

                $object[] = array(
                    'result' => '3',
                );
            } else {
                     

              

                //aca recorro lo que me trae la api y lo convierto en array 

                // var filtered_array = data.results[0].address_components.filter(function(address_component){
                //     return address_component.types.includes("administrative_area_level_2");
                // }); 
                // var county = filtered_array.length ? filtered_array[0].long_name: "";

                // echo '<pre>';
                // print_r($format);
                // echo '</pre>';
                // die();
                //rrecorro el array y lo devuelvo al front

                foreach ($format as $ubication) {

                     $arr[] =  $ubication;
            
                }
            }
        } 
           else {

            $object[] = array(
                'result' => '2',
            );

        }

        echo '<pre>';
        print_r($arr);
        echo '</pre>';
        die();

        // $jsonstring = json_encode($object);
        //  echo $jsonstring;

        // echo '<pre>';
        // print_r($jsonstring);
        // echo '</pre>';
        // die();

    }
}
