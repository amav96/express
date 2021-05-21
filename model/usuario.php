<?php 



 class Usuario{


            private $username;
            private $password;
            private $passwordHash;
            private $nombre;
            private $apellido;
            private $email;
            private $via_conocimiento;
            private $pais;
            private $provincia;
            private $localidad;
            private $domicilio;
            private $codigoPostal;
            private $dni;
            private $nro_dni;
            private $monotributo;
            private $caracteristica;
            private $tipo_vehiculo;
            private $horario_disponible;
            private $telefono_celular;
            private $bank;
            private $cbu;
            private $cuit;
            private $tipo;
            private $tipo_usuario;
            private $horarioSolicitud;
            private $imagenCuilRut;
            private $imagenDocFront;
            private $imagenDocPost;
            private $imagenMonotributo;
            private $imagenComprobanteDomicilio;
            private $imagenPersona;
            private $imagenComercio;
            private $imagenFirma;
            private $fechaNacimiento;
            private $venceDocumento;
            private $seguroDesempleo;
            private $seguroDeseVence;
            private $estadoCivil;
            private $hijos;
            private $estudiosFinalizados;
            private $venceLicencia;
            private $vehiculoMarca;
            private $patente;
            private $vehiculoModelo;
            private $ultEmpleoUno;
            private $fechaInicioEmpleoUno;
            private $fechaFinEmpleoUno;
            private $ultEmpleoDos;
            private $fechaInicioEmpleoDos;
            private $fechaFinEmpleoDos;
            private $ultEmpleoTres;
            private $fechaInicioEmpleoTres;
            private $fechaFinEmpleoTres;
            private $antecedentesRestricciones;
            private $observaciones;
            private $idenviado;
            private $motionDate;
            private $status;
            private $descripcion;
            private $id_country;
            private $id_province;
            
        
            private $db;

            public function __construct(){
                $this->db=Database::connect();
            }

            public function getUsername(){
                return $this->username;
            }
            public function getPassword(){

                return $this->db->real_escape_string($this->password);
                
            }

            public function getPasswordHash(){

                return password_hash($this->db->real_escape_string(($this->passwordHash)),PASSWORD_BCRYPT, ['cost' => 4]);
                
            }
        
            public function getNombre(){
                return $this->nombre;
            }
            public function getApellido(){
                return $this->apellido;
            }
            public function getEmail(){
                return $this->email;
            }
            public function getVia_conocimiento(){
                return $this->via_conocimiento;
            }
            public function getPais(){
                return $this->pais;
            }
            public function getProvincia(){
                return $this->provincia;
            }
            public function getLocalidad(){
                return $this->localidad;
            }
            public function getDomicilio(){
                return $this->domicilio;
            }
            public function getCodigoPostal(){
                return $this->codigoPostal;
            }
            public function getDni(){
                return $this->dni;
            }
            public function getNro_dni(){
                return $this->nro_dni;
            }
            public function getMonotributo(){
                return $this->monotributo;
            }
            public function getCaracteristica(){
                return $this->caracteristica;
            }
            public function getTipo_vehiculo(){
                return $this->tipo_vehiculo;
            }
            public function getHorario_disponible(){
                return $this->horario_disponible;
            }
            public function getTelefono_celular(){
                return $this->telefono_celular;
            }
            public function getBank(){
                    return $this->bank;
                }
            public function getCbu(){
                return $this->cbu;
            }
            public function getCuit(){
                return $this->cuit;
            }
            public function getTipo(){
                return $this->tipo;
            }
            public function getTipoUsuario(){
                return $this->tipo_usuario;
            }
            public function getHorarioSolicitud(){
                return $this->horarioSolicitud;
            }
            public function getImagenCuilRut(){
                return $this->imagenCuilRut;
            }
            public function getImagenDocFront(){
                return $this->imagenDocFront;
            }
            public function getImagenDocPost(){
                return $this->imagenDocPost;
            }
            public function getImagenMonotributo(){
                return $this->imagenMonotributo;
            }
            public function getImagenComprobanteDomicilio(){
                return $this->imagenComprobanteDomicilio;
            }
            public function getImagenPersona(){
                return $this->imagenPersona;
            }
            public function getImagenComercio(){
                return $this->imagenComercio;
            }

            public function getImagenFirma(){
                return $this->imagenFirma;
            }

        
            public function getFechaNacimiento(){
                return $this->fechaNacimiento;
            }
            public function getVenceDocumento(){
                return $this->venceDocumento;
            }
            public function getSeguroDesempleo(){
                return $this->seguroDesempleo;
            }
            public function getSeguroDeseVence(){
                return $this->seguroDeseVence;
            }
            public function getEstadoCivil(){
                return $this->estadoCivil;
            }
            public function getHijos(){
                return $this->hijos;
            }
            public function getEstudiosFinalizados(){
                return $this->estudiosFinalizados;
            }
            public function getVenceLicencia(){
                return $this->venceLicencia;
            }
            public function getVehiculoModelo(){
                return $this->vehiculoModelo;
            }
            public function getVehiculoMarca(){
                return $this->vehiculoMarca;
            }
            public function getPatente(){
                 return $this->patente;
            }
            public function getUltEmpleoUno(){
                return $this->ultEmpleoUno;
            }
            public function getFechaInicioEmpleoUno(){
                return $this->fechaInicioEmpleoUno;
            }
            public function getFechaFinEmpleoUno(){
                return $this->fechaFinEmpleoUno;
            }
            public function getUltEmpleoDos(){
                return $this->ultEmpleoDos;
            }
            public function getFechaInicioEmpleoDos(){
                return $this->fechaInicioEmpleoDos;
            }
            public function getFechaFinEmpleoDos(){
                return $this->fechaFinEmpleoDos;
            }
            public function getUltEmpleoTres(){
                return $this->ultEmpleoTres;
            }
            public function getFechaInicioEmpleoTres(){
                return $this->fechaInicioEmpleoTres;
            }
            public function getFechaFinEmpleoTres(){
                return $this->fechaFinEmpleoTres;
            }
            public function getAntecedentesRestricciones(){
                return $this->antecedentesRestricciones;
            }
            public function getObservaciones(){
                return $this->observaciones;
            }
            public function getIdenviado(){
                return $this->idenviado;
            }
            public function getMotionDate(){
                return $this->motionDate;
            }
            public function getStatus(){
                return $this->status;
            }
            public function getDescripcion(){
                return $this->descripcion;
            }
            public function getId_country(){
                return $this->id_country;
            }
            public function getId_province(){
                return $this->id_province;
            }
        
        
                public function setUsername($username){

                    $this->username =$this->db->real_escape_string($username);
                }
                public function setPassword($password){

                    $this->password = $this->db->real_escape_string($password);
                }

                public function setPasswordHash($passwordHash){

                    $this->passwordHash = $passwordHash;
                }
                public function setNombre($nombre){

                    $this->nombre = $this->db->real_escape_string($nombre);
                }
                public function setApellido($apellido){

                    $this->apellido = $this->db->real_escape_string($apellido);
                }
                public function setEmail($email){

                    $this->email = $this->db->real_escape_string($email);
                }
                public function setVia_conocimiento($via_conocimiento){

                    $this->via_conocimiento = $this->db->real_escape_string($via_conocimiento);
                }
                public function setPais($pais){

                    $this->pais = $this->db->real_escape_string($pais);
                }
                public function setProvincia($provincia){

                    $this->provincia = $this->db->real_escape_string($provincia);
                }
                public function setLocalidad($localidad){

                    $this->localidad = $this->db->real_escape_string($localidad);
                }
                public function setDomicilio($domicilio){

                    $this->domicilio = $this->db->real_escape_string($domicilio);
                }
                public function setCodigoPostal($codigoPostal){

                    $this->codigoPostal = $this->db->real_escape_string($codigoPostal);
                }
                public function setDni($dni){

                    $this->dni = $this->db->real_escape_string($dni);
                }
                public function setNro_dni($nro_dni){

                    $this->nro_dni = $this->db->real_escape_string($nro_dni);
                }
                public function setMonotributo($monotributo){

                    $this->monotributo = $this->db->real_escape_string($monotributo);
                }
                public function setCaracteristica($caracteristica){

                    $this->caracteristica = $this->db->real_escape_string($caracteristica);
                }
                public function setTipo_vehiculo($tipo_vehiculo){

                    $this->tipo_vehiculo = $this->db->real_escape_string($tipo_vehiculo);
                }
                public function setHorario_disponible($horario_disponible){

                    $this->horario_disponible = $this->db->real_escape_string($horario_disponible);
                }
                public function setTelefono_celular($telefono_celular){

                    $this->telefono_celular = $this->db->real_escape_string($telefono_celular);
                }
                public function setBank($bank){
                        $this->bank=$this->db->real_escape_string($bank);
                    }
                public function setCbu($cbu){

                    $this->cbu = $this->db->real_escape_string($cbu);
                }
                public function setCuit($cuit){
                    $this->cuit=$this->db->real_escape_string($cuit);
                }
            
                public function setHorarioSolicitud($horarioSolicitud){

                    $this->horarioSolicitud =$horarioSolicitud;
                }

                public function setTipo($tipo){

                    $this->tipo = $tipo;
                }

                public function setTipoUsuario($tipo_usuario){

                    $this->tipo_usuario = $tipo_usuario;
                }
                public function setImagenCuilRut($imagenCuilRut){

                    $this->imagenCuilRut = $imagenCuilRut;
                }
                public function setImagenDocFront($imagenDocFront){

                    $this->imagenDocFront = $imagenDocFront;
                }
                public function setImagenDocPost($imagenDocPost){

                    $this->imagenDocPost = $imagenDocPost;
                }
                public function setImagenMonotributo($imagenMonotributo){

                    $this->imagenMonotributo = $imagenMonotributo;
                }
                public function setImagenComprobanteDomicilio($imagenComprobanteDomicilio){

                    $this->imagenComprobanteDomicilio = $imagenComprobanteDomicilio;
                }

                public function setImagenPersona($imagenPersona){
                    $this->imagenPersona = $imagenPersona;
                }

                public function setImagenComercio($imagenComercio){
                    $this->imagenComercio = $imagenComercio;
                }

                public function setImagenFirma($imagenFirma){
                    $this->imagenFirma=$imagenFirma;
                }

                public function setFechaNacimiento($fechaNacimiento){

                    $this->fechaNacimiento = $fechaNacimiento;
                }
                public function setVenceDocumento($venceDocumento){

                    $this->venceDocumento = $venceDocumento;
                }
                public function setSeguroDesempleo($seguroDesempleo){

                    $this->seguroDesempleo = $seguroDesempleo;
                }
                public function setSeguroDeseVence($seguroDeseVence){

                    $this->seguroDeseVence = $seguroDeseVence;
                }
                public function setEstadoCivil($estadoCivil){

                    $this->estadoCivil = $estadoCivil;
                }

                public function setHijos($hijos){

                    $this->hijos = $hijos;
                }
                public function setEstudiosFinalizados($estudiosFinalizados){

                    $this->estudiosFinalizados = $estudiosFinalizados;
                }
                public function setVenceLicencia($venceLicencia){

                    $this->venceLicencia = $venceLicencia;
                }
                public function setVehiculoMarca($vehiculoMarca){
                    $this->vehiculoMarca=$this->db->real_escape_string($vehiculoMarca);
                }

                public function setVehiculoModelo($vehiculoModelo){

                    $this->vehiculoModelo = $vehiculoModelo;
                }
                public function setPatente($patente){
                     $this->patente=$this->db->real_escape_string($patente);
                }
                public function setUltEmpleoUno($ultEmpleoUno){

                    $this->ultEmpleoUno = $ultEmpleoUno;
                }

                public function setFechaInicioEmpleoUno($fechaInicioEmpleoUno){

                    $this->fechaInicioEmpleoUno = $fechaInicioEmpleoUno;
                }
                public function setFechaFinEmpleoUno($fechaFinEmpleoUno){

                    $this->fechaFinEmpleoUno = $fechaFinEmpleoUno;
                }
                public function setUltEmpleoDos($ultEmpleoDos){

                    $this->ultEmpleoDos = $ultEmpleoDos;
                }
                public function setFechaInicioEmpleoDos($fechaInicioEmpleoDos){

                    $this->fechaInicioEmpleoDos = $fechaInicioEmpleoDos;
                }
                public function setFechaFinEmpleoDos($fechaFinEmpleoDos){

                    $this->fechaFinEmpleoDos = $fechaFinEmpleoDos;
                }

                public function setUltEmpleoTres($ultEmpleoTres){

                    $this->ultEmpleoTres = $ultEmpleoTres;
                }
                public function setFechaInicioEmpleoTres($fechaInicioEmpleoTres){

                    $this->fechaInicioEmpleoTres = $fechaInicioEmpleoTres;
                }
                public function setFechaFinEmpleoTres($fechaFinEmpleoTres){

                    $this->fechaFinEmpleoTres = $fechaFinEmpleoTres;
                }
                public function setAntecedentesRestricciones($antecedentesRestricciones){

                    $this->antecedentesRestricciones = $antecedentesRestricciones;
                }
                public function setObservaciones($observaciones){

                    $this->observaciones = $observaciones;
                }
                public function setIdenviado($idenviado){

                    $this->idenviado = $idenviado;
                }

                public function setMotionDate($motionDate){

                    $this->motionDate = $motionDate;
                }

                public function setStatus($status){

                    $this->status = $status;
                }

                public function setDescripcion($descripcion){

                    $this->descripcion = $descripcion;
                }
                public function setId_country($id_country){

                    $this->id_country = $id_country;
                }
                public function setId_province($id_province){

                    $this->id_province = $id_province;
                }
                

                public function setRegisterOneStep(){

                    $nombre = !empty($this->getNombre()) ?$this->getNombre() : false;
                    $email = !empty($this->getEmail()) ?$this->getEmail() : false;
                    $getPassword = !empty($this->getPassword()) ?$this->getPassword() : false;
                    $passwordHash = !empty($this->getPasswordHash()) ?$this->getPasswordHash() : false;
                    $motionDate = !empty($this->getMotionDate()) ?$this->getMotionDate() : false;
                    $tipo = !empty($this->getTipo()) ? $this->getTipo() : false ;
                    $getLocateOnEstep = !empty($this->getLocalidad()) ? $this->getLocalidad() : false ;
                    $getPostalCodeOnEstep = !empty($this->getCodigoPostal()) ? $this->getCodigoPostal() : false ;
                    $textpais = !empty($this->getId_country()) ? $this->getId_country() : false ;
                    $textprovincia = !empty($this->getId_province()) ? $this->getId_province() : false ;

                    if($nombre && $email && $passwordHash && $getPassword && $tipo){
                         $password = md5($getPassword);
                         $mailHash =  md5($email);
                        
                        $result = false;
                        $sql= "INSERT INTO users (name,email,email_hash,password,password_hash,country,province,location,postal_code,type_request,role,status_process,status_notifications,created_at) values ('$nombre','$email','$mailHash','$password','$passwordHash','$textpais','$textprovincia','$getLocateOnEstep','$getPostalCodeOnEstep','$tipo','{$this->getTipoUsuario()}','first','nueva','$motionDate')";

                        $register = $this->db->query($sql);
                        if($register){
                            
                            $result = $this->getRegister($mailHash,$password);

                        }else{
                            $result = 'noinsert';
                           
                        }

                        return $result;

                       }
                }

                public function getRegister($email,$pass){

                    $result = false;
                    $sql ="SELECT id,email,email_hash,PASSWORD,password_hash,country,
                    name,type_request,role,status_process  from users where password='$pass' and email_hash='$email' and status_process='first'";
                  
                
                    $getReclute = $this->db->query($sql);
                    if($getReclute && $getReclute->num_rows>0){

                        $result = $getReclute;

                    }else{
                        $result = false;
                    }

                    return $result;

                }

                public function validateEmail(){
                    
                    $id = !empty($this->getIdenviado()) ?$this->getIdenviado() : false;
                    $email = !empty($this->getEmail()) ?$this->getEmail() : false;
                    $getPassword = !empty($this->getPassword()) ?$this->getPassword() : false;

                        if($id && $email && $getPassword){

                            $result = false;
                            $sql ="UPDATE users SET email_verified_at='verify', status_notifications ='nueva' WHERE PASSWORD='$getPassword' AND id
                            ='$id' AND email_hash='$email'";

                           
    
                            $modificarStatusEmail = $this->db->query($sql);

                            if($modificarStatusEmail){
                                $result = $this->getRegister($email,$getPassword);
                            }else{
                                $result = false;
                            }
                            return $result;

                        }
                }

                public function getTelefonosAndIdOperator(){

                    $result = false;
                    $sql="SELECT users.id,users.name, numeros_operators.telefono, 
                    postal_code.postal_code, postal_code.province
                    FROM numeros_operators
                    INNER JOIN users ON users.id= numeros_operators.id_user
                    INNER JOIN postal_code ON postal_code.id_user = numeros_operators.id_user
                    WHERE postal_code.postal_code='{$this->getCodigoPostal()}' GROUP BY 
                    numeros_operators.telefono";

                 
                    $telefonosYId = $this->db->query($sql);
                    
                    if($telefonosYId && $telefonosYId->num_rows>0){
                        $result = $telefonosYId;

                    }else{
                        $result = false;
                    }
                    return $result;

                }

                private function validateDocument($documento){

                    $result = true;

                    $dni = $this->getNro_dni();
                    $sql = "SELECT * FROM users where id_number='$dni'";
                    $documento = $this->db->query($sql);

                    if($documento && $documento->num_rows>0){
                        $result = false;
                    }

                    return $result;
                }

                public function getValidateEmail(){
              
                    $email = !empty($this->getEmail()) ? $this->getEmail() : false ;
                    $status = !empty($this->getStatus()) ? $this->getStatus() : false ;
                    $pass = !empty($this->getPassword()) ? $this->getPassword() : false ;
                    $id = !empty($this->getIdenviado()) ? $this->getIdenviado() : false ;
                    $tipo = !empty($this->getTipo()) ? $this->getTipo() : false ;

                    if($email && $status && !$pass && !$id && !$tipo){
                       
                      
                        $result = false;
                        $sql = "SELECT id,password,email_hash,email,name from users where email ='$email' ";

                       
                        $validar = $this->db->query($sql);
                        if($validar && $validar->num_rows>0){
                            if($this->setStatusPass($email,$status)){
                                $result = $validar;
                               
                            }else{
                                $result = 'noupdate';
                            }
                        }else{
                            $result = 'noresult';
                        }

                        return $result;

                    }

                    if($email && !$status && $pass && $id  && !$tipo){
                   
                        
                        $result = false;
                        $sql = "SELECT id,password,email_hash,email,name from users where email_hash ='$email' and id='$id' and
                        password='$pass' and status_pass='checkEmailToRestore'";
                        
                        $validar = $this->db->query($sql);
                        
                        if($validar && $validar->num_rows>0){
                            
                            if($this->setStatusPass($email,'restorationInProcess')){
                               
                                $result = $validar;
                            }
                           
                        }else{
                            $result = false;
                        }
                     
                    } if($email && $pass && $id && !$status && $tipo){
                       
                        $result = false;
                        $sql = "SELECT id,password,email_hash,email,name from users where email_hash ='$email' and id='$id' and
                        password='$pass' and status_pass='checkEmailToRestore'";
                       
                        $validar = $this->db->query($sql);
                        
                        if($validar && $validar->num_rows>0){

                               $result = $validar;
                                                  
                        }else{
                            $result = false;
                        }
                        return $result;
                      
                    }
                }

                private function setStatusPass($email,$stat){

                    $result = false;
                      if($stat==='checkEmailToRestore'){
                          //esto es cuando es solicitado restablecer la contrase単a por vez primera
                        $sql ="UPDATE users set status_pass='$stat' where email ='$email'";

                      }else if($stat==='restorationInProcess'){
                          //esto es cuando verifica el email para restablecer la contrase単a
                        $sql ="UPDATE users set status_pass='$stat' where email_hash ='$email'";            
                      }

                    $setStatus = $this->db->query($sql);
                    if($setStatus){
                         $result =true;
                    }else{
                        $result =false;
                    }
                    return $result;
                }


                public function restoreVerify(){
                //   empezar proceso para restablecer      
                    $result = false;
                    $id = !empty($this->getIdenviado()) ? $this->getIdenviado() : false ;
                    $pass = !empty($this->getPassword()) ? $this->getPassword() : false ;
                    $email = !empty($this->getEmail()) ? $this->getEmail(): false ;
                    $tipo = !empty($this->getTipo()) ? $this->getTipo() : false ;

                    

                    if($id && $pass && $email && $tipo){

                    
                        if($this->getValidateEmail()){
                         
                           $result = $this->getValidateEmail();
                        }else{
                           
                            $result = false;
                        }

                        return $result;
                    }

                }

                public function updatePassword(){
                    $id = !empty($this->getIdenviado()) ? $this-> getIdenviado(): false ;
                    $newPass = !empty($this->getPasswordHash()) ? $this->getPasswordHash() : false ;
                    $passHash = !empty($this->getPassword()) ? $this->getPassword() : false ;
                    $mailHash = !empty($this->getEmail()) ? $this->getEmail() : false ;

                   if($id &&   $newPass && $passHash && $mailHash ){
                       $result = false;
                       $sql = "UPDATE users set password_hash = '$newPass',status_pass='restoredComplete', date_pass=now() where email_hash='$mailHash'
                       and id='$id' and password ='$passHash' ";
                       
                      
                       $update = $this->db->query($sql);
                       if($update){
                           
                        $result ='update';
                       }
                       else{
                           $result ='noupdate';
                       }
                       return $result;
                   }

                }

                public function login(){

                    $result = false;
                    $password = $this->passwordHash;
                    $sql ="SELECT email_hash,password,password_hash,id,type_request,role, status_process,name,email,img_person,id_number,country
                    FROM users WHERE email='{$this->getUsername()}'";
                    $login= $this->db->query($sql);
                    if($login && $login->num_rows == 1){
                        $result = $login;
                    }else{
                        $result = false;
                    }
                    
                    return $result;
                }

                public function registerComplete(){

                        $result = false;
                        $sql = "update users set home_address='{$this->getDomicilio()}',cuit='{$this->getCuit()}', type_document='{$this->getDni()}',id_number='{$this->getNro_dni()}',phone_number='{$this->getTelefono_celular()}',knowledge_path='{$this->getVia_conocimiento()}',img_monotribute='{$this->getImagenMonotributo()}',img_document_front='{$this->getImagenDocFront()}',img_document_post='{$this->getImagenDocPost()}',img_cuil_rut='{$this->getImagenCuilRut()}',img_home='{$this->getImagenComprobanteDomicilio()}',img_person='{$this->getImagenPersona()}',created_at='{$this->getMotionDate()}',status_process='registered',status_notifications ='nueva' ";

                        if(!empty($this->getImagenComercio())){
                            $sql.=",img_commerce='{$this->getImagenComercio()}',created_at='{$this->getMotionDate()}',status_process='registered',status_notifications ='nueva' where id ='{$this->getIdenviado()}'";
                          }else{
                              $sql.=",created_at='{$this->getMotionDate()}',status_process='registered',status_notifications ='nueva' where id ='{$this->getIdenviado()}'";
                          }

                        $registered = $this->db->query($sql);
                        if($registered){
                           $result = 'registered';
                        }else{
                            $result = 'noregistered';
                        }
                        return $result;
                
                }

                public function gettersDocument(){

                    $result= false;
                    $sql = "SELECT id_number FROM users WHERE id_number='{$this->getNro_dni()}';";
                   
                    $validateDocument = $this->db->query($sql);
                    if($validateDocument && $validateDocument->num_rows>0){
                      $result = 'existe';
                    }else{
                        $result = 'noexiste';
                    }

                    return $result;

                }
    
                
                public function getDocument(){


                    $query = "SELECT id,name from reclute where id_number='{$this->getNro_dni()}'";

                    $documento = $this->db->query($query);

                    
                    if($documento && $documento->num_rows>0){
                        $user = $documento->fetch_object();

                        $objeto[]=array(
                        'result' => true,
                        'id_number' => $user->id_number,
                        'first_name' => $user->name
                        );

                    }else {

                        $objeto[]=array(
                            'result' => false
                        );

                    }

                    $jsonstring= json_encode($objeto);
                    echo $jsonstring;

                }

                
                public function getPaisOperativos(){

                    $query = "SELECT * FROM pais";
                    $result= $this->db->query($query);

                    $json = array();
                        
                        
                        while($row = $result->fetch_object()){

                            $json[]= array(
                                'nomPais' => $row->pais,
                                'idPais' => $row->id_pais,
                            );

                        }

                    $jsonstring =json_encode($json);
                    echo $jsonstring;

                }

            
                public function countNotifications(){

                    $zone = !empty($this->getPais()) ? $this->getPais() : false ;
                    $result = false;

                    $sql = "SELECT COUNT(status_notifications) AS 'cantidadNotificacion'
                     FROM users where status_process !='first' 
                     AND status_notifications ='nueva'  AND country='$zone' GROUP BY
                     status_notifications ORDER BY created_at DESC";

                     $count = $this->db->query($sql);
                     if($count && $count->num_rows>0){

                       $result = $count;
                       
                     }else{
                         $result = false;
                     }

                     return $result;
                }

                public function getAllNotifications(){

                    $zone = !empty($this->getPais()) ? $this->getPais() : false ;
                    
                    $result = false;
                    $sql ="SELECT email,id,name,role,type_request,status_process,
                    status_notifications,province,postal_code,location,created_at,img_person from 
                    users where status_process !='first' and country = '$zone' ORDER BY created_at DESC;";

                    $notificaciones = $this->db->query($sql);

                    if($notificaciones && $notificaciones->num_rows>0){

                        $result  = $notificaciones;

                    }else{
                        $result = false;
                    }

                    return $result;

                    

                }

                public function notificationComplete(){

                 
                    $notif_id = !empty($this->getIdenviado()) ? $this->getIdenviado() : false ;
                
                    if($notif_id){
                        $result= false;    
                        $sql ="SELECT * FROM users where id='$notif_id'";
                       
                        $notificacion = $this->db->query($sql);

                        if($notificacion && $notificacion->num_rows>0){

                            
                            $result = $notificacion;
                        }else{
                            $result = false;
                        }
                        return $result;
                    }

                }

                public function getUsers(){
                      
                    $id = !empty($this->getIdenviado()) ? $this->getIdenviado() : false ;
                    $mail = !empty($this->getEmail()) ? $this->getEmail() : false ;
                    
                         
                        $result = false;
                        $sql ="";
                        $sql.="SELECT * FROM users ";
                        if($id && !$mail){
                        $sql.= "where id_number='$id' ORDER by created_at DESC ";
                        }else if($id && $mail){
                            $sql.= "where id_number='$id' and email_hash='$mail' ORDER by created_at DESC";
                        }

                       
                        $usuarios = $this->db->query($sql);

                        if($usuarios && $usuarios->num_rows>0){

                            $result = $usuarios;
                        }else{
                            $result = false;
                        }

                        return $result;

                   

                    if(isset($_POST["key"]) && $_POST["key"] === 'all'){

                        $result = false;
                        $sql ="SELECT * FROM users ORDER by created_at DESC";
                        $usuarios = $this->db->query($sql);

                        if($usuarios && $usuarios->num_rows>0){

                            $result = $usuarios;
                        }else{
                            $result = false;
                        }

                        return $result;

                    }

                    
                }

                 public function setStatusUser(){
                    
                    $id = !empty($this->getIdenviado()) ? $this->getIdenviado() : false ;
                    $id_managent = !empty($this->getUsername()) ? $this->getUsername() : false ;
                    $status = !empty($this->getStatus()) ? $this->getStatus() : false ;
                    $motivo = !empty($this->getObservaciones()) ? $this->getObservaciones() : false ;
                    $descripcion = !empty($this->getDescripcion()) ? $this->getDescripcion() : '' ;
                    date_default_timezone_set('America/Argentina/Buenos_Aires');
                    $momento = date('Y-m-d H:i:s');

                    $result = false;
                    if($id && $status && $id_managent){
                     $sql = "";
                     $sql.="UPDATE users set status_process='$status',user_managent_id='$id_managent',status_notifications='nueva', new_section = 'new', updated_at = '$momento' ";
                     if($motivo){
                     $sql .=",motive='$motivo',description='$descripcion' ";
                     }
                     $sql .=" where id_number='$id'";
                  
                     $setStatus = $this->db->query($sql);
                     if($setStatus){
                          
                        $result = 'update';
                     }else{
                         $result= 'noupdate';
                     }

                     return $result;

                    }


                }


                public function setStatusNotifications(){

                    $notif_id = !empty($this->getIdenviado()) ? $this->getIdenviado() : false ;
                  
                    $result = false;
                    $sql ="UPDATE users set status_notifications='leida' where
                    id='$notif_id'";
                    $notificacion = $this->db->query($sql);
                   
                    if($notificacion){
                        $result = 'update';

                    }else{
                        $result = 'noupdate';
                    }

                    return $result;

                }

                public function settersSigned(){

                    if($_REQUEST){
                            
                        $result = false;
                        $base_to_php = explode(',', $this->getImagenFirma());
                        $data = base64_decode($base_to_php[1]);
                        $filepath ='../resources/firmas/'.'contrato'.$this->getHorarioSolicitud().$this->getnro_dni().'.png';

                        file_put_contents($filepath, $data, FILE_APPEND);

                        if(file_exists($filepath)){
                           if($this->setContractEnded()){
                              $result= 'actualizado';
                           }else {
                              $result = 'no-actualizado';
                           }
          
                        }else{
                            
                            $result= 'no-ingreso-firma';
                        }

          
                        return $result;
                  }
                }

                private function setContractEnded(){

                    $nameImg = 'contrato'.$this->getHorarioSolicitud().$this->getNro_dni().'.png'; 
            
                    $result = false;
                    $sql = "";
                    $sql.= "UPDATE users set cbu='{$this->getCbu()}',bank='{$this->getBank()}',status_process='signed_contract',status_notifications='nueva',img_signed='$nameImg',signed_date='{$this->getHorarioSolicitud()}',vehicle_brand='{$this->getVehiculoMarca()}',vehicle_model='{$this->getVehiculoModelo()}',patent='{$this->getPatente()}',name_alternative='{$this->getNombre()}',customer_service_hours='{$this->getHorario_disponible()}',account_type='{$this->getTipo()}' where id_number='{$this->getNro_dni()}'";

                    $actualizar = $this->db->query($sql); 
                   
                    if($actualizar){
                        
                        $result = true;
                        
                    }else {
                       
                        $result = false;
            
                    }
                    return $result;
                 
            
                }
    
                public function setcompleteThePhotoRequirements(){
                    $imagenMonotributo = !empty($this->getImagenMonotributo()) ? $this->getImagenMonotributo() : false ;
                    $id_number = !empty($this->getNro_dni()) ? $this->getNro_dni() : false ;

                    if($imagenMonotributo && $id_number){

                       $sql ="UPDATE users set img_monotribute='$imagenMonotributo', monotribute='si' where
                       id_number='$id_number' ";
                       $actualizar = $this->db->query($sql);
                       if($actualizar){
                           $result = 'update';

                       }else{
                           $result= 'noupdate';
                       }

                       return $result;

                    }
                }

                public function validateCuit(){

                    $cuit = !empty($this->getCuit()) ? $this->getCuit() : false ;
                    $sql ="SELECT cuit FROM users WHERE cuit = '$cuit'";
                    $validateCuit = $this->db->query($sql);
                    if($validateCuit->num_rows>0){
                        $result = false;
                    }else{
                        $result = true;
                    }
                    
                    return $result;
                }

                //SCOPE

                public function getUsersCommerce(){
                    $sql = "SELECT id,name_alternative as 'name_user',country,province,location,home_address,customer_service_hours FROM users WHERE role = 'comercio' AND status_process = 'active'";

                    $getUsersCommerce =  $this->db->query($sql);
                    if($getUsersCommerce && $getUsersCommerce->num_rows>0){
                        $result = $getUsersCommerce;
                    }else {
                        $result = false;
                    }
                    return $result;
                }

 }