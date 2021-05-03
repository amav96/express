<?php
class Utils{

    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function AuthCollector(){
        if(isset($_SESSION["username"])){

         

            if($_SESSION["username"]->role === 'call'){
                header("Location:".base_url);
                return;
            }

            if($_SESSION["username"]->status_process !== 'active'){
                header("Location:".base_url.'usuario/viewLogin');
                return;
            }

            if($_SESSION["username"]->role !== 'admin' && $_SESSION["username"]->role !== 'recolector' && $_SESSION["username"]->role !== 'comercio' ){
                header("Location:".base_url.'usuario/viewLogin');
                return;
            }
        }else{
            header("Location:".base_url.'usuario/viewLogin');
            return;
        }
       
    }

    public static function AuthOperative(){
        if(isset($_SESSION["username"])){

            if($_SESSION["username"]->status_process !== 'active'){
                header("Location:".base_url.'usuario/viewLogin');
            }

        }else{
            header("Location:".base_url.'usuario/viewLogin');
        }
       
    }

    public static function AuthAdmin(){


        if(isset($_SESSION["username"])){

            if($_SESSION["username"]->role !== 'admin'){

                header("Location:".base_url.'usuario/viewLogin');

            }

        }
        else{
            header("Location:".base_url.'usuario/viewLogin');
        }
       
    }


    public static function pais(){

        $pais = new EquiposExtra();
        $pais = $pais->getAllPais();
        
        if(is_object($pais)){
            foreach($pais as $element){
 
                 $objeto[]= array(
                     'result' => '1',
                     'id' => $element["id"],
                     'country' => $element["country"],
                 );
                   
            }
 
        }else{
         $objeto[]= array(
             'result' => '2',
             
         );
        }
        
        $jsonstring = json_encode($objeto);
        echo $jsonstring;
 
     }
 
    
}