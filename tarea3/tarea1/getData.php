<?php
$q = $_REQUEST["q"];
include("config.php");

$mysqli = new mysqli('localhost', 'root', '', 'tarea2');
$mysqli->set_charset("utf8");

$q = $_REQUEST["q"];
$var_consulta= "select * from encargo where id='".$q."';";
$var_resultado = $mysqli->query($var_consulta);

$var_fila=$var_resultado->fetch_array();


$idOrigen=$var_fila["origen"];
                    
                    

$origen=$mysqli->query("SELECT c.nombre AS nombreComuna,r.nombre AS nombreRegion, r.id AS regionId FROM comuna c,region r WHERE c.id='$idOrigen' AND c.region_id=r.id;");
$origenArray=$origen->fetch_assoc();
                    

$idDestino=$var_fila["destino"];
$destino=$mysqli->query("SELECT c.nombre AS nombreComuna,r.nombre AS nombreRegion, r.id AS regionId FROM comuna c,region r WHERE c.id='$idDestino' AND c.region_id=r.id;");
$destinoArray=$destino->fetch_assoc();


$idEspacio=$var_fila["espacio"];
$espacio=$mysqli->query("SELECT valor FROM espacio_encargo WHERE id='$idEspacio';");
$espacioArray=$espacio->fetch_assoc();


$idKilos=$var_fila["kilos"];
$kilos=$mysqli->query("SELECT valor FROM kilos_encargo WHERE id='$idKilos';");
$kilosArray=$kilos->fetch_assoc();

$foto=$var_fila["foto"];


$var1ComunaOrigen=$idOrigen;
$var2RegionOrigen=$origenArray["regionId"];

$var3ComunaDestino=$idDestino;
$var4RegionDestino=$destinoArray["regionId"];


$var7Espacio=$espacioArray['valor'];
$var8Kilos=$kilosArray['valor'];
                    
$var9EmailViajero=$var_fila["email_encargador"];
$var10CelularViajero=$var_fila["celular_encargador"];
$comentario=$var_fila["descripcion"];

echo $origenArray["nombreComuna"];
echo "#";
echo $origenArray["nombreRegion"];
echo "#";
echo $destinoArray["nombreComuna"];
echo "#";
echo $destinoArray["nombreRegion"];
echo "#";
echo $espacioArray["valor"];
echo "#";
echo $kilosArray["valor"];
echo "#";
echo $var_fila["email_encargador"];
echo "#";
echo $var_fila["celular_encargador"];
echo "#";
echo $var_fila["descripcion"];
echo "#";
echo $var_fila["foto"]
?>