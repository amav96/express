<?php 

class Asignacion{


      protected $fromRow;
      protected $limit;
      protected $word;
      protected $filter;


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

      public function setFromRow($fromRow){
            $this->fromRow = $fromRow;
      }

      
      public function setLimit($limit)
      {
            $this->limit = $limit;
      }
      public function setWord($word)
      {
            $this->word = $this->db->real_escape_string($word);
      }
      public function setFilter($filter)
      {
            $this->filter = $this->db->real_escape_string($filter);
      }

      public function __construct(){
            $this->db=Database::Connect();
      }

      // COUNT

      public function countAllEquipos(){

            $sql = "SELECT count(*) as 'count' from equipos";
     
            $exe = $this->db->query($sql);
            if($exe && $exe->fetch_object()->count > 0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      // DATA

      public function getAllEquipos(){

          
            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            if(gettype($fromRow) !==  'string'){$fromRow = '0';}

            $sql = "SELECT e.id,e.identificacion,e.estado,e.empresa,e.terminal,e.serie,e.serie_base,e.tarjeta,e.created_at,e.nombre_cliente,e.direccion,e.provincia,e.localidad,e.codigo_postal,e.digito,e.id_user_assigned, u.name, u.name_alternative
            from equipos e 
            left join users u on u.id = e.id_user_assigned
            GROUP BY codigo_postal order by codigo_postal  asc limit $fromRow,$limit ";

            // where localidad like '%MENDOZA%' 
            $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;

      }

}
