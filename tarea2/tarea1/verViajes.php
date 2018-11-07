<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>ver viajes</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
  include("config.php");

  $mysqli = new mysqli('localhost', 'root', '', 'tarea2');
  $mysqli->set_charset("utf8");
?>
<style type="text/css">
button {
    background-color: #4CAF50; /* Green */
    border: 1px solid green;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    width: 200px;
    border-radius: 15px;
}
table, th, td {
    border: 1px solid black;
}
</style>
</head>

<body>
<div class="container-fluid">
  <div class="row bg-dark">
    <div class="col">
      <h1 class="text-center text-white">Viajes</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2 bg-secondary">
      <button onclick="Volver()" id="bottonVolver">Volver</button>
    </div>

    <div class="col bg-secondary">
      <div class =row">
        <div class="col bg-secondary" id="id1">
          <table style="width:100%">
            <tr>
              <th>Origen</th>
              <th>Destino</th> 
              <th>Fecha viaje</th>
              <th>Espacio</th> 
              <th>Kilos</th> 
              <th>Email</th> 
            </tr>

            <div id="paginar">
           <?php
              if (!array_key_exists('estado', $_POST)) {
                $e0=0;
              }else{
                $e0=$_POST["estado"];
              }
                echo $e0;
                $e=$e0*5;
                $e2=($e0+1)*5;



                $var_consulta= "select * from viaje where id>=$e AND id<$e2";
                $var_resultado = $mysqli->query($var_consulta);

                while ($var_fila=$var_resultado->fetch_array())
                  {

                  

                  $idOrigen=$var_fila["origen"];
                  
                  

                  $origen=$mysqli->query("SELECT c.nombre AS nombreComuna,r.nombre AS nombreRegion, r.id AS regionId FROM comuna c,region r WHERE c.id='$idOrigen' AND c.region_id=r.id;");
                  $origenArray=$origen->fetch_assoc();
                  

                  $idDestino=$var_fila["destino"];
                  $destino=$mysqli->query("SELECT c.nombre AS nombreComuna,r.nombre AS nombreRegion, r.id AS regionId FROM comuna c,region r WHERE c.id='$idDestino' AND c.region_id=r.id;");
                  $destinoArray=$destino->fetch_assoc();


                  $idEspacio=$var_fila["espacio_disponible"];
                  $espacio=$mysqli->query("SELECT valor FROM espacio_encargo WHERE id='$idEspacio';");
                  $espacioArray=$espacio->fetch_assoc();


                  $idKilos=$var_fila["kilos_disponible"];
                  $kilos=$mysqli->query("SELECT valor FROM kilos_encargo WHERE id='$idKilos';");
                  $kilosArray=$kilos->fetch_assoc();


                  $var1ComunaOrigen=$idOrigen;
                  $var2RegionOrigen=$origenArray["regionId"];

                  $var3ComunaDestino=$idDestino;
                  $var4RegionDestino=$destinoArray["regionId"];

                  $var5FechaIda=$var_fila["fecha_ida"];
                  $var6FechaRegreso=$var_fila["fecha_regreso"];

                  $var7Espacio=$espacioArray['valor'];
                  $var8Kilos=$kilosArray['valor'];
                  
                  $var9EmailViajero=$var_fila["email_viajero"];
                  $var10CelularViajero=$var_fila["celular_viajero"];

                  echo "<tr onclick=\"verInfo('$var1ComunaOrigen','$var2RegionOrigen','$var3ComunaDestino','$var4RegionDestino','$var5FechaIda','$var6FechaRegreso','$var7Espacio','$var8Kilos','$var9EmailViajero','$var10CelularViajero','$e0')\">";
                  echo "<th>".$origenArray['nombreRegion']."/".$origenArray['nombreComuna']."</th>";

                  echo "<th>".$destinoArray['nombreRegion']."/".$origenArray['nombreComuna']."</th>";

                  echo "<th>".$var_fila["fecha_ida"]."</th>";
                  echo "<th>".$espacioArray["valor"]."</th>";
                  echo "<th>".$kilosArray["valor"]."</th>";

                  echo "<th>".$var_fila["email_viajero"]."</th>";
                  echo "<tr>";
                  }

                  if ($result= $mysqli->query("SELECT * from viaje")) {
                    $aux=$result->num_rows;
                    $aux=floor($aux/5);
                    
                  }
                  
                  echo "<form method=\"post\" action=\"verViajes.php\" name=\"Form\" id=\"Form\">";
                  echo  "<input type=\"HIDDEN\" id=\"estado\" name=\"estado\" value=$e0>";
                  echo  "<input type=\"HIDDEN\" id=\"rows\" name=\"rows\" value=$aux>";
                  echo "</form>";
                  

                  

                  echo "<div id=\"idForm\">";
                  echo "<form method=\"post\" action=\"infoViajes.php\" name=\"Form2\" id=\"Form2\">";
                  echo "</form>";
                  echo "</div>";





              
              
            ?>
          </div>

          </table>
        </div>
      </div>

      <div class="row">
        <div class="col bg-secondary">
          <button onclick="paginarPrev(-1)" id="buttonPrev">prev</button>
          <button onclick="paginarNext(1)">next</button>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  function paginarPrev(n){
    var e=parseInt(document.getElementById("estado").value);
    if(e>0){
      document.getElementById("estado").value=n+e;
      document.getElementById("Form").submit();
    }
    
  }

  function paginarNext(n){
    var e=parseInt(document.getElementById("estado").value);
    var aux=parseInt(document.getElementById("rows").value);
    if(e<aux){
      document.getElementById("estado").value=n+e;
      document.getElementById("Form").submit();
    }
    
  }
</script>

<script>
function Volver() {
  window.location.href="home.php"
}
</script>

<script>
function verTablaAnterior() {
   window.location.href="verviajes"
}
</script>

<script>
function verInfo(str1,str2,str3,str4,str5,str6,str7,str8,str9,str10,e0) {
   document.getElementById("Form2").innerHTML="<input type=\"HIDDEN\" id=\"i1\" name=\"comunaOrigen\" value="+str1+">"+
   "<input type=\"HIDDEN\" id=\"i2\" name=\"regionOrigen\" value="+str2+">"
   +"<input type=\"HIDDEN\" id=\"i3\" name=\"comunaDestino\" value="+str3+">"
   +"<input type=\"HIDDEN\" id=\"i4\" name=\"regionDestino\" value="+str4+">"
   +"<input type=\"HIDDEN\" id=\"i5\" name=\"fecha_ida\" value="+str5+">"
   +"<input type=\"HIDDEN\" id=\"i6\" name=\"fecha_regreso\" value="+str6+">"
   +"<input type=\"HIDDEN\" id=\"i7\" name=\"espacio\" value="+str7+">"
   +"<input type=\"HIDDEN\" id=\"i8\" name=\"kilos\" value="+str8+">"
   +"<input type=\"HIDDEN\" id=\"i9\" name=\"email_viajero\" value="+str9+">"
   +"<input type=\"HIDDEN\" id=\"i10\" name=\"celular_viajero\" value="+str10+">"
   +"<input type=\"HIDDEN\" id=\"i11\" name=\"e0\" value="+e0+">";
   document.getElementById("Form2").submit();

}
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>