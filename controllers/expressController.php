<?php 
class expressController{

    public function index()
    {
         $info = $this->detect();
         require_once 'views/info/inicio.php';
    }

    public function nosotros()
    {
        $info = $this->detect();
        require_once 'views/info/nosotros.php';

    }
    public function resena()
    {
        $info = $this->detect();
        require_once 'views/info/resena.php';

    }
    public function productos()
    {
        $info = $this->detect();
        require_once 'views/info/productos.php';

    }

    public function corporativo(){
        $info = $this->detect();
        require_once 'views/info/corporativo.php';
    }

    public function traslados(){
        $info = $this->detect();
        require_once 'views/info/traslados.php';
    }

    public function ecommerce(){
        $info = $this->detect();
        require_once 'views/info/ecommerce.php';
    }

    public function particulares(){
        $info = $this->detect();
        require_once 'views/info/particulares.php';
    }

    public function cobertura(){
        $info = $this->detect();
        require_once 'views/info/cobertura.php';
    }

    public function contacto(){
        $info = $this->detect();
        require_once 'views/info/contacto.php';
    }

    public function red(){
        $info = $this->detect();
        require_once 'views/info/red.php';
    }

    public function recolector(){
        $info = $this->detect();
        require_once 'views/info/recolector.php';
    }
    public function call(){
        $info = $this->detect();
        require_once 'views/info/call.php';
    }
    public function comercio(){
        $info = $this->detect();
        require_once 'views/info/comercio.php';
    }

    public function empleado(){
        $info = $this->detect();
        require_once 'views/info/empleado.php';
    }
    public function carta(){
        require_once 'views/info/carta_documento.html';
    }
    public function contract(){
        $info = $this->detect();
        require_once 'views/trabajo/contract.php';
    }
    public function stand(){
        $info = $this->detect();
        require_once 'views/info/stand.php';
    }
    public function trabajar(){
        $info = $this->detect();
        require_once 'views/info/trabajar.php';
    }

    
    public function detect()
    {
         $browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
         $os=array("WIN","MAC","LINUX");
    
         # definimos unos valores por defecto para el navegador y el sistema operativo
         $info['browser'] = "OTHER";
         $info['os'] = "OTHER";
    
         # buscamos el navegador con su sistema operativo
         foreach($browser as $parent)
         {
              $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
              $f = $s + strlen($parent);
              $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
              $version = preg_replace('/[^0-9,.]/','',$version);
              if ($s)
              {
                   $info['browser'] = $parent;
                   $info['version'] = $version;
              }
         }
    
         # obtenemos el sistema operativo
         foreach($os as $val)
         {
              if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
                   $info['os'] = $val;
         }
    
         # devolvemos el array de valores
         return $info;
    }
   

}