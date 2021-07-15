<?php 
$mysqli = new mysqli("localhost", "root", "", "reality2_postalmarketing");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$sql ="UPDATE equipos SET id_usuario_asignado = NULL, fecha_final_asignado = null , 
asignado_tipo = 'v'
WHERE 
(fecha_final_asignado IS NOT NULL ) 
AND 
(id_usuario_asignado != '' AND id_usuario_asignado IS NOT NULL)
AND
DATEDIFF(fecha_final_asignado,CURDATE()) < 1";

$exe = $mysqli->query($sql);
if($exe){
    echo "ejecutado";
}else{
    echo "no se ejecuto";
}
