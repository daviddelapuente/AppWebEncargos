<?php
include("config.php");

$mysqli = new mysqli('localhost', 'root', '', 'tarea2');
$mysqli->set_charset("utf8");

$q = $_REQUEST["q"];
$var_consulta= "select * from encargo where descripcion LIKE '".$q."%';";
$var_resultado = $mysqli->query($var_consulta);

while ($var_fila=$var_resultado->fetch_array()){
	
	echo $var_fila["id"];
	echo "~";
	echo $var_fila["descripcion"];
	echo "#";
}

?>