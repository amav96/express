<?php 

class errorController{

    public function index(){
        $info = $this->detect();
        require_once 'views/error/error.php';
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


}