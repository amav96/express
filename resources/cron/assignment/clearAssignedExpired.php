<?php 
$mysqli = new mysqli("localhost", "root", "", "reality2_postalmarketing");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$sql ="UPDATE equipos SET id_user_assigned = NULL, date_finish_assigned = null , 
type_assigned = 'pendiente'
WHERE 
(date_finish_assigned IS NOT NULL ) 
AND 
(id_user_assigned != '' AND id_user_assigned IS NOT NULL)
AND
DATEDIFF(date_finish_assigned,CURDATE()) < 1";

$exe = $mysqli->query($sql);
if($exe){
    echo "ejecutado";
}else{
    echo "no se ejecuto";
}
