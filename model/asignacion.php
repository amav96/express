<?php 

class Asignacion{

      private $id;
      private $id_admin;
      private $id_user;
      private $postal_code;
      private $id_country;
      private $digit;
      private $created_at;
      private $postal_code_start;
      private $postal_code_end;
      private $cartera;
      private $fromRow;
      private $limit;
      private $word;
      private $filter;
      private $condition;

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

      public function getPostal_code_start(){
            return $this->postal_code_start;
      }

      public function getPostal_code_end(){
            return $this->postal_code_end;
      }

      public function getCartera(){
            return $this->cartera;
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

      public function getCondition(){
            return $this->condition;
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

      public function setPostal_code_start($postal_code_start){
            $this->postal_code_start = $postal_code_start;
      }

      public function setPostal_code_end($postal_code_end){
            $this->postal_code_end = $postal_code_end;
      }

      public function setCartera($cartera){
            $this->cartera= $cartera;
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

      public function setCondition($condition){
            $this->condition = $condition;
      }

      public function __construct(){
            $this->db=Database::Connect();
      }

      // COUNT

      public function countAllEquipos(){
            $condition = $this->getCondition();

            $sql = "SELECT count(*) as 'count' from equipos where ";
            if(isset($condition) && $condition !== null){
                  if($condition){
                        $sql.=" (id_user_assigned != '' and id_user_assigned IS NOT null) and ";
                  }else{
                        $sql.=" (id_user_assigned = '' or id_user_assigned IS null) and ";
                  }
            }
            $sql.="( cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
                  'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
                        AND 
                        (
                        estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
                        'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
                        'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
                        'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
                        'ENTREGO-EN-SUCURSAL') OR estado IS NULL
                        )
                  )";

            $exe = $this->db->query($sql);
            if($exe && $exe->fetch_object()->count > 0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      public function countEquiposByPostalCodeRangeAndCountry(){
            $cp_start = !empty($this->getPostal_code_start()) ? $this->getPostal_code_start() : false ;
            $cp_end = !empty($this->getPostal_code_end()) ? $this->getPostal_code_end() : false ;
            $id_country = !empty($this->getId_country()) ? $this->getId_country() : false ;

            $condition = $this->getCondition();
            

            $sql="SELECT count(*) as 'count'
            from equipos e
            left join users u on u.id = e.id_user_assigned
            WHERE ";
            if(isset($condition) && $condition !== null){
            if($condition){$sql.=" (e.id_user_assigned != '' and e.id_user_assigned IS NOT null) and ";}
            else{$sql.=" (e.id_user_assigned = '' or e.id_user_assigned IS null) and ";}
            }
            $sql.=" (
                  e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
                  'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
                 AND (
                       e.estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
                       'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
                       'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
                       'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
                       'ENTREGO-EN-SUCURSAL') OR e.estado IS NULL
                     )
            ) AND (cast(e.codigo_postal as SIGNED) >= $cp_start AND cast(e.codigo_postal as SIGNED) <=$cp_end AND e.pais= '$id_country')
            order by cast(e.codigo_postal as SIGNED) ASC ";

            $exe = $this->db->query($sql);
            if($exe && $exe->fetch_object()->count > 0){$result = $exe;}
            else {$result = false;}
            return $result;


      }

      public function countEquiposByPurse(){
            $cartera = !empty($this->getCartera()) ? $this->getCartera() : false ;
            $condition = $this->getCondition();
            $sql="SELECT count(*) as count  
            from equipos e
            left join users u on u.id = e.id_user_assigned
            WHERE ";

            if(isset($condition) && $condition !== null){
            if($condition){$sql.=" (e.id_user_assigned != '' and e.id_user_assigned IS NOT null) and ";}
            else{$sql.=" (e.id_user_assigned = '' or e.id_user_assigned IS null) and ";}
            }
            $sql.=" (
              e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
              'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
             AND (
                   e.estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
                   'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
                   'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
                   'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
                   'ENTREGO-EN-SUCURSAL') OR e.estado IS NULL
                 )
             AND e.cartera = '$cartera'
            ) ";

      
            $exe = $this->db->query($sql);
            if($exe && $exe->fetch_object()->count > 0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      public function countEquiposByUserAssigned(){

            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ;
            $sql="SELECT count(*) as 'count'
            from equipos e
            left join users u on u.id = e.id_user_assigned
            WHERE 
            (
              e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
              'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
             AND e.id_user_assigned = '$id_user'
            )";
            $exe = $this->db->query($sql);
            if($exe && $exe->fetch_object()->count > 0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      // COUNT FILTER

      public function countFilterEquipos(){

            $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;
            $condition = $this->getCondition();

            $sql="SELECT count(*) as 'count'
            from equipos e 
            left join users u on u.id = e.id_user_assigned
            WHERE MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
            e.localidad,e.codigo_postal,e.provincia,e.estado) AGAINST('$filter')
            AND (
               e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
               'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
					  AND (
						  e.estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
						  'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
						  'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
						  'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
	                 'ENTREGO-EN-SUCURSAL') OR e.estado IS NULL
						  )
            	  ) OR e.cartera = '$filter' ";
                     if(isset($condition) && $condition !== null){
                        if($condition){
                              $sql.="and (id_user_assigned != '' and id_user_assigned IS NOT null) ";
                        }else{
                              $sql.="and (id_user_assigned = '' or id_user_assigned IS null) ";
                        }
                  }
                  
                    
            $exe = $this->db->query($sql);
            if($exe && $exe->fetch_object()->count > 0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      public function countFilterEquiposByPostalCodeRangeAndCountry(){

            $cp_start = !empty($this->getPostal_code_start()) ? $this->getPostal_code_start() : false ;
            $cp_end = !empty($this->getPostal_code_end()) ? $this->getPostal_code_end() : false ;
            $id_country = !empty($this->getId_country()) ? $this->getId_country() : false ;
            $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;
            $condition = $this->getCondition();

            $sql="SELECT count(*) as 'count'
            from equipos e 
            left join users u on u.id = e.id_user_assigned
            WHERE (cartera = '$filter' and ".$this->sqlPurseAndStatus()." ) and
            (
            cast(e.codigo_postal as SIGNED) >= '$cp_start' 
            AND cast(e.codigo_postal as SIGNED) <= '$cp_end' 
            AND e.pais = '$id_country'
            )
            OR  
            (
                  MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
                  e.localidad,e.codigo_postal,e.provincia,e.estado)
                  AGAINST('$filter') 
                  AND (cast(e.codigo_postal as SIGNED) >= '$cp_start' 
                  AND cast(e.codigo_postal as SIGNED) <= '$cp_end' 
                  AND e.pais = '$id_country')
            )
            AND ".$this->sqlPurseAndStatus()." ";
            if(isset($condition) && $condition !== null){
                  if($condition){$sql.=" and (e.id_user_assigned != '' and e.id_user_assigned IS NOT null) ";}
                  else{$sql.=" and (e.id_user_assigned = '' or e.id_user_assigned IS null) ";}
            }

            $exe = $this->db->query($sql);
            if($exe && $exe->fetch_object()->count > 0){$result = $exe;}
            else {$result = false;}
            return $result;

      }

      public function countFilterEquiposByPurse(){
            $cartera = !empty($this->getCartera()) ? $this->getCartera() : false ;
            $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;
            $condition = $this->getCondition();

            $sql ="SELECT count(*) as 'count'
            from equipos e 
            left join users u on u.id = e.id_user_assigned
            WHERE ";
            if(isset($condition) && $condition !== null){
            if($condition){$sql.=" (e.id_user_assigned != '' and e.id_user_assigned IS NOT null) and ";}
            else{$sql.=" (e.id_user_assigned = '' or e.id_user_assigned IS null) and ";}
            }
            $sql.=" MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
            e.localidad,e.codigo_postal,e.provincia,e.estado)
            AGAINST('$filter') and e.cartera = '$cartera'
            AND (
               e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
               'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
                     AND (
                           e.estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
                           'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
                           'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
                           'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
                     'ENTREGO-EN-SUCURSAL') OR e.estado IS NULL
                           )
                     )";

            $exe = $this->db->query($sql);
            if($exe && $exe->fetch_object()->count > 0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      public function countFilterEquiposByUserAssigned(){

            $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;
            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ;
           
            $sql="SELECT count(*) as 'count'
            from equipos e
            left join users u on u.id = e.id_user_assigned
            WHERE 
                  (
                  e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
                  'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
                  AND e.id_user_assigned = '$id_user'
                  ) 
                  AND 
                  (
                        MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
                        e.localidad,e.codigo_postal,e.provincia,e.estado)
                        AGAINST('$filter') OR e.cartera = '$filter'
                  )";

            $exe = $this->db->query($sql);
            if($exe && $exe->fetch_object()->count > 0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      // DATA

      public function getAllEquipos(){

            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            $condition = $this->getCondition();
            
            if(gettype($fromRow) !==  'string'){$fromRow = '0';}

            $sql = "SELECT e.id,e.identificacion,e.estado,e.empresa,e.terminal,e.serie,e.serie_base,e.tarjeta,e.cartera,e.created_at,e.nombre_cliente,e.direccion,e.provincia,e.localidad,e.codigo_postal,e.digito,e.id_user_assigned,e.cartera,e.pais, u.name, u.name_alternative
            from equipos e 
            left join users u on u.id = e.id_user_assigned
            where ";
            if(isset($condition) && $condition !== null){
                  if($condition){
                        $sql.=" (id_user_assigned != '' and id_user_assigned IS NOT null) and ";
                  }else{
                        $sql.=" (id_user_assigned = '' or id_user_assigned IS null) and ";
                  }
            }
            $sql.=" (
                  e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
                  'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
                        AND 
                        (
                              e.estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
                              'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
                              'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
                              'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
                              'ENTREGO-EN-SUCURSAL') OR e.estado IS NULL
                        )
                  ) 
                  order by cast(e.codigo_postal as SIGNED)   asc limit $fromRow,$limit ";
                  $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;

      }

      public function getEquiposByPostalCodeRangeAndCountry(){
            $cp_start = !empty($this->getPostal_code_start()) ? $this->getPostal_code_start() : false ;
            $cp_end = !empty($this->getPostal_code_end()) ? $this->getPostal_code_end() : false ;
            $id_country = !empty($this->getId_country()) ? $this->getId_country() : false ;
            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            if(gettype($fromRow) !==  'string'){$fromRow = '0';}
            $condition = $this->getCondition();


           $sql="SELECT e.id,e.identificacion,e.estado,e.empresa,e.terminal,e.serie,e.serie_base,e.tarjeta,
           e.cartera,e.created_at,e.nombre_cliente,e.direccion,e.provincia,e.localidad,e.codigo_postal,
           e.digito,e.id_user_assigned,e.cartera,e.pais, u.name, u.name_alternative 
           from equipos e
           left join users u on u.id = e.id_user_assigned
           WHERE ";
           if(isset($condition) && $condition !== null){
            if($condition){$sql.=" (e.id_user_assigned != '' and e.id_user_assigned IS NOT null) and ";}
            else{$sql.=" (e.id_user_assigned = '' or e.id_user_assigned IS null) and ";}
            }
           $sql.=" (
                 e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
                 'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
                AND (
                      e.estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
                      'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
                      'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
                      'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
                      'ENTREGO-EN-SUCURSAL') OR e.estado IS NULL
                    )
           ) AND (cast(e.codigo_postal as SIGNED) >= $cp_start AND cast(e.codigo_postal as SIGNED) <=$cp_end AND e.pais= '$id_country')
           order by cast(e.codigo_postal as SIGNED) ASC limit $fromRow,$limit;";

           
            $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;
      }


      public function getEquiposByPurse(){
            $cartera = !empty($this->getCartera()) ? $this->getCartera() : false ;
            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            if(gettype($fromRow) !==  'string'){$fromRow = '0';}
            $condition = $this->getCondition();


           $sql="SELECT e.id,e.identificacion,e.estado,e.empresa,e.terminal,e.serie,e.serie_base,e.tarjeta,
           e.cartera,e.created_at,e.nombre_cliente,e.direccion,e.provincia,e.localidad,e.codigo_postal,
           e.digito,e.id_user_assigned,e.cartera,e.pais, u.name, u.name_alternative 
           from equipos e
           left join users u on u.id = e.id_user_assigned
           WHERE ";

            if(isset($condition) && $condition !== null){
            if($condition){$sql.=" (e.id_user_assigned != '' and e.id_user_assigned IS NOT null) and ";}
            else{$sql.=" (e.id_user_assigned = '' or e.id_user_assigned IS null) and ";}
            }
            $sql.=" (
             e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
             'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
            AND (
                  e.estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
                  'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
                  'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
                  'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
                  'ENTREGO-EN-SUCURSAL') OR e.estado IS NULL
                )
            AND e.cartera = '$cartera'
           )  ORDER BY e.codigo_postal ASC limit $fromRow,$limit;";
           
            $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      public function getEquiposByUserAssigned(){

            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ;
            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            if(gettype($fromRow) !==  'string'){$fromRow = '0';}

            $sql="SELECT e.id,e.identificacion,e.estado,e.empresa,e.terminal,e.serie,e.serie_base,e.tarjeta,
            e.cartera,e.created_at,e.nombre_cliente,e.direccion,e.provincia,e.localidad,e.codigo_postal,
            e.digito,e.id_user_assigned,e.cartera,e.pais, u.name, u.name_alternative 
            from equipos e
            left join users u on u.id = e.id_user_assigned
            WHERE 
            (
              e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
              'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
             AND e.id_user_assigned = '$id_user'
            ) ORDER BY e.codigo_postal ASC, e.updated_at_assigned desc limit $fromRow,$limit;";

            $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      // DATA FILTER

      public function getFilterEquipos(){
            $condition = $this->getCondition();
            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;
            if(gettype($fromRow) !==  'string'){$fromRow = '0';}

            $sql="SELECT e.id,e.identificacion,e.localidad,e.cartera,e.estado,e.empresa,e.terminal,e.serie,e.serie_base,e.tarjeta,
            e.cartera,e.created_at,e.nombre_cliente,e.direccion,e.provincia,
            e.codigo_postal,e.digito,e.id_user_assigned,e.pais, u.name, u.name_alternative,
            MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
            e.localidad,e.codigo_postal,e.provincia,e.estado)
            AGAINST('$filter') AS relevance,
            MATCH (e.empresa) 
            AGAINST('$filter') AS relevanceEmpresa,
            MATCH (e.localidad) 
            AGAINST('$filter') AS relevanceLocalidad
            from equipos e 
            left join users u on u.id = e.id_user_assigned
            WHERE MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
            e.localidad,e.codigo_postal,e.provincia,e.estado)
            AGAINST('$filter') 
            AND (
               e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
               'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
                        AND (
                              e.estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
                              'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
                              'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
                              'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
                              'ENTREGO-EN-SUCURSAL') OR e.estado IS NULL
                        )
            	  )
                    OR e.cartera = '$filter' ";
                     if(isset($condition) && $condition !== null){
                        if($condition){
                              $sql.="and (id_user_assigned != '' and id_user_assigned IS NOT null) ";
                        }else{
                              $sql.="and (id_user_assigned = '' or id_user_assigned IS null) ";
                        }
                  }
                  $sql.=" ORDER BY relevanceLocalidad DESC, relevanceEmpresa desc, relevance  DESC, e.cartera  limit $fromRow,$limit ";

            $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      public function getFilterEquiposByPostalCodeRangeAndCountry(){

            $cp_start = !empty($this->getPostal_code_start()) ? $this->getPostal_code_start() : false ;
            $cp_end = !empty($this->getPostal_code_end()) ? $this->getPostal_code_end() : false ;
            $id_country = !empty($this->getId_country()) ? $this->getId_country() : false ;
            $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;
            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            $condition = $this->getCondition();
            if(gettype($fromRow) !==  'string'){$fromRow = '0';}

            $sql="SELECT e.id,e.identificacion,e.localidad,e.cartera,e.estado,e.empresa,e.terminal,e.serie,
            e.serie_base,e.tarjeta,e.created_at,e.nombre_cliente,e.direccion,e.provincia,
            e.codigo_postal,e.digito,e.id_user_assigned,e.pais, u.name, u.name_alternative,
            MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
            e.localidad,e.codigo_postal,e.provincia,e.estado)
            AGAINST('$filter') AS relevance,
            MATCH (e.empresa) 
            AGAINST('$filter') AS relevanceEmpresa
            from equipos e 
            left join users u on u.id = e.id_user_assigned
            WHERE (cartera = '$filter' and ".$this->sqlPurseAndStatus()." ) and
            (
            cast(e.codigo_postal as SIGNED) >= '$cp_start' 
            AND cast(e.codigo_postal as SIGNED) <= '$cp_end' 
            AND e.pais = '$id_country'
            )
            OR  
            (
                  MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
                  e.localidad,e.codigo_postal,e.provincia,e.estado)
                  AGAINST('$filter') 
                  AND (cast(e.codigo_postal as SIGNED) >= '$cp_start' 
                  AND cast(e.codigo_postal as SIGNED) <= '$cp_end' 
                  AND e.pais = '$id_country')
            )
            AND ".$this->sqlPurseAndStatus()." ";
            if(isset($condition) && $condition !== null){
                  if($condition){$sql.=" and (e.id_user_assigned != '' and e.id_user_assigned IS NOT null) ";}
                  else{$sql.=" and (e.id_user_assigned = '' or e.id_user_assigned IS null) ";}
            }
            $sql.=" ORDER BY relevance  DESC, e.codigo_postal asc, relevanceEmpresa desc,e.cartera limit $fromRow,$limit";
          

      
            $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;

      }

      public function getFilterEquiposByPurse(){

            $cartera = !empty($this->getCartera()) ? $this->getCartera() : false ;
            $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;
            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            if(gettype($fromRow) !==  'string'){$fromRow = '0';}
            $condition = $this->getCondition();

            $sql ="SELECT e.id,e.identificacion,e.localidad,e.cartera,e.estado,e.empresa,e.terminal,e.serie,
            e.serie_base,e.tarjeta,e.created_at,e.nombre_cliente,e.direccion,e.provincia,
            e.codigo_postal,e.digito,e.id_user_assigned,e.pais, u.name, u.name_alternative,
            MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
            e.localidad,e.codigo_postal,e.provincia,e.estado)
            AGAINST('$filter') AS relevance,
            MATCH (e.empresa) 
            AGAINST('$filter') AS relevanceEmpresa
            from equipos e 
            left join users u on u.id = e.id_user_assigned
            WHERE ";
            if(isset($condition) && $condition !== null){
            if($condition){$sql.=" (e.id_user_assigned != '' and e.id_user_assigned IS NOT null) and ";}
            else{$sql.=" (e.id_user_assigned = '' or e.id_user_assigned IS null) and ";}
            }
            $sql.=" MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
            e.localidad,e.codigo_postal,e.provincia,e.estado)
            AGAINST('$filter') and e.cartera = '$cartera'
            AND (
               e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
               'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
                     AND (
                           e.estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
                           'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
                           'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
                           'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
                     'ENTREGO-EN-SUCURSAL') OR e.estado IS NULL
                           )
                     )
            
            ORDER BY relevance  DESC, e.codigo_postal asc, relevanceEmpresa desc,e.cartera limit $fromRow,$limit";

           

            $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      public function getFilterEquiposByUserAssigned(){

            $filter = !empty($this->getFilter()) ? $this->getFilter() : false ;
            $id_user = !empty($this->getId_user()) ? $this->getId_user() : false ;
            $fromRow = ($this->getFromRow())?$this->getFromRow() : false ;
            $limit = ($this->getLimit())?$this->getLimit() : false ;
            if(gettype($fromRow) !==  'string'){$fromRow = '0';}

            $sql="SELECT e.id,e.identificacion,e.estado,e.empresa,e.terminal,e.serie,e.serie_base,e.tarjeta,
            e.cartera,e.created_at,e.nombre_cliente,e.direccion,e.provincia,e.localidad,e.codigo_postal,
            e.digito,e.id_user_assigned,e.cartera,e.pais, u.name, u.name_alternative 
            from equipos e
            left join users u on u.id = e.id_user_assigned
            WHERE 
                  (
                  e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
                  'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
                  AND e.id_user_assigned = '$id_user'
                  ) 
                  AND (MATCH(e.empresa,e.terminal,e.serie,e.identificacion,
		            e.localidad,e.codigo_postal,e.provincia,e.estado)
		            AGAINST('$filter') OR e.cartera = '$filter')
            ORDER BY e.codigo_postal ASC, e.updated_at_assigned desc limit $fromRow,$limit;";

         
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

      public function removeAssign(){

            $id = !empty($this->getId()) ? $this->getId() : false ;
            $created_at = !empty($this->getCreated_at()) ? $this->getCreated_at() : false ;
            $id_admin = !empty($this->getId_admin()) ? $this->getId_admin() : false ;

            $sql="UPDATE equipos set id_user_assigned = null ,id_user_update_management_assigned='$id_admin', updated_at_assigned = '$created_at' where id = '$id' ";
            $exe = $this->db->query($sql);
            if($exe){return true;}
            else{return false;}

      }

      // HELPERS

      public function getAllWallets(){
            
            $sql ="SELECT cartera FROM equipos WHERE (cartera !='' AND cartera IS NOT NULL ) GROUP BY cartera ORDER BY cartera asc,fecha_de_envio ASC ";

            $exe = $this->db->query($sql);
            if($exe && $exe->num_rows>0){$result = $exe;}
            else {$result = false;}
            return $result;
      }

      public function sqlPurseAndStatus(){
            $sql= '';
            $sql.=" (
                        e.cartera not in('AUTORIZADO T','AUTORIZADOS','ESPECIAL',
                        'PEDIDOS ESPECIALES','AUTORIZADO','AUTORIZAR') 
                        AND (
                              e.estado not IN('AUTORIZAR','RECUPERADO','NO-TUVO-EQUIPO',
                              'NO-COINCIDE-SERIE','RECHAZADA','EN-USO','NO-RESPONDE',
                              'SE-MUDO','YA-RETIRADO','DESCONOCIDO-TIT','DESHABITADO',
                              'EXTRAVIADO','FALLECIO','FALTAN-DATOS','RECONECTADO','ROBADO',
                        'ENTREGO-EN-SUCURSAL') OR e.estado IS NULL
                              )
                  ) ";
            return $sql;

      }
}
