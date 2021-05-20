<?php
class Utils{

    public $id;
    
    public function __construct()
    {
        $this->db = Database::connect();
    }

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

    
}