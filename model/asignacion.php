<?php 

class Asignacion{

      private $id;
      private $id_admin;
      private $id_user;
      private $postal_code;
      private $id_country;
      private $digit;
      private $created_at;
      private $fromRow;
      private $limit;
      private $word;
      private $filter;

      public function getId(){
            return $this->id;
      }
      public function getId_admin(){
            return $this->id_admin;
      }
      public function getId_user(){
            return $this->id_user;
      }
      public function getPostal_code(){
            return $this->postal_code;
      }
      public function getId_country(){
            return $this->id_country;
      }
      public function getDigit(){
            return $this->digit;
      }

      public function getCreated_at(){
            return $this->created_at;
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


      public function setId($id){
            $this->id = $id;
      }
      public function setId_admin($id_admin){
            $this->id_admin = $id_admin;
      }
      public function setId_user($id_user){
            $this->id_user = $id_user;
      }
      public function setPostal_code($postal_code){
            $this->postal_code = $postal_code;
      }
      public function setId_country($id_country){
            $this->id_country = $id_country;
      }
      public function setDigit($digit){
            $this->digit = $digit;
      }

      public function setCreated_at($created_at){
            $this->created_at = $created_at;
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

            $sql = "SELECT e.id,e.identificacion,e.estado,e.empresa,e.terminal,e.serie,e.serie_base,e.tarjeta,e.cartera,e.created_at,e.nombre_cliente,e.direccion,e.provincia,e.localidad,e.codigo_postal,e.digito,e.id_user_assigned,e.cartera,e.pais, u.name, u.name_alternative
            from equipos e 
            left join users u on u.id = e.id_user_assigned
            group by e.codigo_postal order by cast(e.codigo_postal as SIGNED)   asc limit $fromRow,$limit ";

            // where localidad like '%MENDOZA%' 
            $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;

      }

      // GET

      public function getZoneByUserAndDigit(){

            $postal_code = !empty($this->getPostal_code()) ? $this->getPostal_code() : false ;
            $id_country = !empty($this->getId_country()) ? $this->getId_country() : false ;

            $sql ="SELECT c.id_user,u.name FROM coverage c
            inner join users u on u.id = c.id_user
            WHERE c.TYPE = 'recolector'
            AND c.postal_code = '$postal_code' AND c.id_country = '$id_country' group by c.id_user";
      


            $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;
            


      }

      // action

      public function automaticallyAssign(){
            $id = !empty($this->getId()) ? $this->getId() : false ;
            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ;
            $created_at = !empty($this->getCreated_at()) ? $this->getCreated_at() : false ;
            $id_admin = !empty($this->getId_admin()) ? $this->getId_admin() : false ;

            $sql="UPDATE equipos set id_user_assigned = '$id_user',id_user_update_management_assigned='$id_admin', updated_at_assigned = '$created_at' where id = '$id' ";

            $exe = $this->db->query($sql);
            if($exe){return true;}
            else{return false;}
      }
}
