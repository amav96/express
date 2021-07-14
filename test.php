<?php 
$mysqli = new mysqli("localhost", "root", "", "reality2_postalmarketing");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$sql ="SELECT * from equipos limit 10";

$resultado = $mysqli->query($sql);

echo '<pre>';
print_r($resultado->fetch_object());
echo '</pre>';
