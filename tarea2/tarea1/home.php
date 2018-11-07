<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Tarea1</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
  include("config.php");

  $mysqli = new mysqli('localhost', 'root', '', 'tarea2');
  $mysqli->set_charset("utf8");
?>
<style>
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
</style>
</head>

<body>
<div class="container-fluid">
  <div class="row bg-dark">
    <div class="col">
      <h1 class="text-center text-white">Encargos DCC</h1>
    </div>
  </div>

  <div class="row">
    <div class="col bg-secondary">
      <button onclick="AgregarViaje()">Agregar Viaje</button>
    </div>
    <div class="col bg-secondary">
      <?php
      if (array_key_exists('x', $_POST)) {
        if ($result= $mysqli->query("SELECT * from viaje")) {
          $var_email=$_POST["email"];
          $var_numero=$_POST["celular"];
          $var_fechaViaje=$_POST["fecha-viaje"];
          $var_fechaRegreso=$_POST["fecha-regreso"];

          $var_comuna=$_POST["comuna-origen"];

          $origen=$mysqli->query("SELECT id FROM comuna WHERE nombre='$var_comuna';");
          $idOrigen=$origen->fetch_assoc()['id'];

          $var_comunaDestino=$_POST["comuna-destino"];

          $destino=$mysqli->query("SELECT id FROM comuna WHERE nombre='$var_comunaDestino';");
          $idDestino=$destino->fetch_assoc()['id'];

          $var_kilosEncargo=$_POST["kilos-disponibles"];
          $var_kilos=$mysqli->query("SELECT id FROM kilos_encargo WHERE valor='$var_kilosEncargo';");
          $idKilos=$var_kilos->fetch_assoc()['id'];

          $var_espacioEncargo=$_POST["espacio-disponible"];
          $var_espacio=$mysqli->query("SELECT id FROM espacio_encargo WHERE valor='$var_espacioEncargo';");
          $idEspacio=$var_espacio->fetch_assoc()['id'];


          $stmt = $mysqli->prepare("INSERT INTO `viaje` (`id`, `fecha_ida`, `fecha_regreso`, `origen`, `destino`, `kilos_disponible`, `espacio_disponible`, `email_viajero`, `celular_viajero`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("issiiiiss", $psid, $psfi, $psfr, $psor,$psdes,$psK,$psesp,$psem,$pscel);

          $psid=$result->num_rows;
          $psfi=$var_fechaViaje;
          $psfr=$var_fechaRegreso;
          $psor=$idOrigen;
          $psdes=$idDestino;
          $psK=$idKilos;
          $psesp=$idEspacio;
          $psem=$var_email;
          $pscel=$var_numero;

          $stmt->execute();

          echo "VIAJE SUBIDO CON EXITO!!!";
        }
      }else if(array_key_exists('y',$_POST)){
        $temp = $_FILES['foto-encargo']['tmp_name']; 
        $name = $_FILES['foto-encargo']['name']; 
        $tamanoBytes = $_FILES['foto-encargo']['size'];
        $tipoFile = $_FILES['foto-encargo']['type'];
        $kiloBytes = $tamanoBytes;
        if($kiloBytes==0){
          echo "ERROR AL SUBIR EL ENCARGO";
          echo "<br>";
          echo "DEBE INGRESAR UNA IMAGEN";
        }else if(!($tipoFile == "image/jpeg" || $tipoFile == "image/jpg" || $tipoFile == "image/png")){
          
          echo "ERROR AL SUBIR EL ENCARGO";
          echo "<br>";
          echo "INGRESA UN ARCHIVO DE EXTENSION: .jpg, .jpeg, o .png";
        }else{
          if ($result= $mysqli->query("SELECT * from encargo")) {
          $var_email=$_POST["email"];
          $var_numero=$_POST["celular"];
          $var_descripcion=$_POST["descripcion"];

          $var_comuna=$_POST["comuna-origen"];

          $origen=$mysqli->query("SELECT id FROM comuna WHERE nombre='$var_comuna';");
          $idOrigen=$origen->fetch_assoc()['id'];

          $var_comunaDestino=$_POST["comuna-destino"];

          $destino=$mysqli->query("SELECT id FROM comuna WHERE nombre='$var_comunaDestino';");
          $idDestino=$destino->fetch_assoc()['id'];

          $var_kilosEncargo=$_POST["kilos-disponibles"];
          $var_kilos=$mysqli->query("SELECT id FROM kilos_encargo WHERE valor='$var_kilosEncargo';");
          $idKilos=$var_kilos->fetch_assoc()['id'];

          $var_espacioEncargo=$_POST["espacio-disponible"];
          $var_espacio=$mysqli->query("SELECT id FROM espacio_encargo WHERE valor='$var_espacioEncargo';");
          $idEspacio=$var_espacio->fetch_assoc()['id'];

          $dir = "imagenesTarea1/";
          move_uploaded_file ($temp,"$dir/$name");


          $stmt = $mysqli->prepare("INSERT INTO `encargo` (`id`, `descripcion`, `origen`, `destino`, `espacio`, `kilos`, `foto`, `email_encargador`, `celular_encargador`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("isiiiisss", $psid,$pscom,$psor,$psdes,$psesp,$psK,$psfoto,$psem,$pscel);

          $psid=$result->num_rows;
          $pscom=$var_descripcion;
          $psor=$idOrigen;
          $psdes=$idDestino;
          $psesp=$idEspacio;
          $psK=$idKilos;
          $psfoto=$name;
          $psem=$var_email;
          $pscel=$var_numero;

          $stmt->execute();

          
          $var_consulta= "INSERT INTO `encargo` (`id`, `descripcion`, `origen`, `destino`, `espacio`, `kilos`, `foto`, `email_encargador`, `celular_encargador`) VALUES ('$result->num_rows', '$var_descripcion','$idOrigen', '$idDestino', '$idEspacio', '$idKilos', '$name','$var_email', '$var_numero');";
          $var_resultado = $mysqli->query($var_consulta);

          echo "ENCARGO SUBIDO CON EXITO!!!!!";
        }
        }
      }
      ?>
    </div>
  </div>
    <div class="row">
    <div class="col bg-secondary">
      <button onclick="AgregarEncargo()" class="button">Agregar Encargo</button>
    </div>
  </div>
  <div class="row">
    <div class="col bg-secondary">
      <button onclick="VerViajes()" class="button">Ver Viajes</button>
    </div>
  </div>
  <div class="row">
    <div class="col bg-secondary">
      <button onclick="VerEncargos()" class="button">Ver Encargos</button>
    </div>
  </div>
</div>



<script>
function AgregarViaje() {
  window.location.href="agregarViaje.php"
}
</script>

<script>
function AgregarEncargo() {
  window.location.href="agregarEncargo.php"
}
</script>

<script>
function VerViajes() {
  window.location.href="verViajes.php"
}
</script>

<script>
function VerEncargos() {
  window.location.href="verEncargos.php"
}
</script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>