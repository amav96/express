<?php 



 class Rendicion{


            private $terminal;
            private $serie;
            private $identificacion;
            private $db;

            public function __construct(){
                $this->db=Database::connect();
            }

            public function getTerminal(){
                return $this->terminal;
            }
            public function getSerie(){
                return $this->serie;
            }
            public function getIdentificacion(){
                return $this->identificacion;
            }

            public function setTerminal($terminal){
                $this->terminal = $terminal;
            }

            public function setSerie($serie){
                $this->serie =  $serie;
            }

            public function setIdentificacion($identificacion){
                $this->identificacion = $identificacion;
            }


            public function getRendicion(){
                $terminal = !empty($this->getTerminal()) ? $this-> getTerminal(): false ;
                $serie = !empty($this->getSerie()) ? $this-> getSerie(): false ;
                $identificacion = !empty($this->getIdentificacion()) ? $this-> getIdentificacion(): false ;

                if(!$terminal || $terminal === ''){$terminal = 'terminal no definida';}
                if(!$serie || $serie === ''){$serie = 'serie no definida';}

                $sql ="SELECT e.empresa,e.tipo,e.equipo,e.provincia,e.codigo_postal,e.localidad,e.direccion,e.nombre_cliente,
                e.telefono_cel4,telefono_cel5,telefono_cel6,e.emailcliente as 'email',g.identificacion,g.id_user,g.id_orden as 'orden',g.serie,g.terminal,g.serie_base,g.tarjeta,g.chip_alternativo,g.accesorios,g.id_orden_pass,g.accesorio_uno,g.accesorio_dos,
                g.accesorio_tres,g.accesorio_cuatro,g.motivo,g.estado,g.chip_alternativo,g.created_at,f.created_at as 'fecha_firma', f.aclaracion, f.documento
                from gestion g
                INNER JOIN equipos e ON g.id_equipo = e.id
                LEFT JOIN firmas f ON f.pass_id = g.id_orden_pass
                WHERE (g.terminal= '$terminal' OR g.serie = '$serie') AND
                (g.identificacion='$identificacion' AND g.estado IN('recuperado','autorizar'))
                ORDER BY g.created_at desc LIMIT 1";
               

                $exe = $this->db->query($sql);
                if($exe && $exe->num_rows>0){$result = $exe;}
                else {$result = false;}
                return $result;
            }
 }