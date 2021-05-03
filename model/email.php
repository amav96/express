<?php 

class Email {

    private $codigo;
    private $destino;
    private $_host;
    private $_user;
    private $_password;
    private $name;
    private $motivo;
    private $modo;
    
    public function getCodigo(){
    return $this->codigo;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getHost(){
        return $this->_host;
    }
    public function getUser(){
        return $this->_user;
    }
    public function getPassword(){
        return $this->_password;
    }
    public function getName(){
        return $this->name;
    }
    public function getMotivo(){
        return $this->motivo;
    }
    public function getModo(){
        return $this->modo;
    }
    

   
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }
    public function setDestino($destino){
       $this->destino=$destino;
    }
    public function setHost($_host){
        $this->_host=$_host;
     }
     public function setUser($_user){
        $this->_user=$_user;
     }
     public function setPassword($_password){
        $this->_password=$_password;
     }
    
    public function setName($name){
       $this->name=$name;
    }
    public function setMotivo($motivo){
        $this->motivo=$motivo;
     }
     public function setModo($modo){
        $this->modo=$modo;
     }
     

    public function sendRemito(){

        if($_POST){

            $objeto[]= array(
                'getCodigo' => $this->getCodigo(),
                'getDestino' => $this->getDestino(),
                'getHost' => $this->getHost(),
                'getUser' => $this->getUser(),
                'getPassword' => $this->getPassword(),
                'getName' => $this->getName(),
                'getMotivo' => $this->getMotivo(),
                'getModo' => $this->getModo(),
            );

            return $objeto;
    
      }


    }
}






