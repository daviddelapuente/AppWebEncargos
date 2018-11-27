<!DOCTYPE html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>


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
      <div class="row">

        <div class="col bg-secondary">
          buscar encargo
        </div>

        <div id="searchForm" class="col bg-secondary">
          <form name="Form" id="Form">
            <input id="tag" onkeyup="auto(this.value)">
          </form>
        </div>
      </div>
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
  <div class="row">
    <div class="col bg-secondary">
      <button onclick="VerMapa()" class="button">Mapa</button>
    </div>
  </div>
  <div id="idForm">
    <form method="post" action="infoEncargos2.php" name="Form2" id="Form2">
    </form>
  </div> 
  <div id="idForm3">
    <form method="post" action="VerMapa.php" name="Form3" id="Form3">
    </form>
  </div> 
</div>











<script>
function auto(str) {
    if (str.length <= 2) {
            var items=[];
            $("#tag").autocomplete({
              source: items
            });
        return;
    } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                var items = this.responseText.split("#");

                $("#tag").autocomplete({
                  source: items,
                  select: function(event,s){
                    var auxx=s.item.value.split("~");
                    var xmlhttp2= new XMLHttpRequest();
                    xmlhttp2.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                        var auxx2=this.responseText.split("#");
                       document.getElementById("Form2").innerHTML="<input type=\"HIDDEN\" id=\"i1\" name=\"comunaOrigen\" value="+auxx2[0]+">"+
                       "<input type=\"HIDDEN\" id=\"i2\" name=\"regionOrigen\" value="+auxx2[1]+">"
                       +"<input type=\"HIDDEN\" id=\"i3\" name=\"comunaDestino\" value="+auxx2[2]+">"
                       +"<input type=\"HIDDEN\" id=\"i4\" name=\"regionDestino\" value="+auxx2[3]+">"
                       +"<input type=\"HIDDEN\" id=\"i5\" name=\"espacio\" value="+auxx2[4]+">"
                       +"<input type=\"HIDDEN\" id=\"i6\" name=\"kilos\" value="+auxx2[5]+">"
                       +"<input type=\"HIDDEN\" id=\"i7\" name=\"email_encargador\" value="+auxx2[6]+">"
                       +"<input type=\"HIDDEN\" id=\"i8\" name=\"celular_encargador\" value="+auxx2[7]+">"
                       +"<input type=\"HIDDEN\" id=\"i10\" name=\"comentario\" value="+auxx2[8]+">"
                       +"<input type=\"HIDDEN\" id=\"i11\" name=\"foto\" value="+auxx2[9]+">";

                       document.getElementById("Form2").submit();
                      }
                    };
                    xmlhttp2.open("GET", "getData.php?q=" +auxx[0], true);
                    xmlhttp2.send();
                  }
                });
                  
              }
          };
          xmlhttp.open("GET", "getSearch.php?q=" + str, true);
          xmlhttp.send();



          
          
    }
}
</script>

<script type="text/javascript">
   $(document).ready(function (){
    var items=[];
    $("#tag").autocomplete({
      source: items
    });
  });
</script>



















<script>
function VerMapa() {
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      var aux=this.responseText.split("#");
      document.getElementById("Form3").innerHTML="<input type=\"HIDDEN\" id=\"i1\" name=\"fecha_ida\" value="+aux[0]+">"+
      "<input type=\"HIDDEN\" id=\"i2\" name=\"fecha_regreso\" value="+aux[1]+">"
      +"<input type=\"HIDDEN\" id=\"i3\" name=\"comunaOrigen\" value="+aux[2]+">"
      +"<input type=\"HIDDEN\" id=\"i4\" name=\"regionOrigen\" value="+aux[3]+">"
      +"<input type=\"HIDDEN\" id=\"i5\" name=\"comunaDestino\" value="+aux[4]+">"
      +"<input type=\"HIDDEN\" id=\"i6\" name=\"regionDestino\" value="+aux[5]+">"
      +"<input type=\"HIDDEN\" id=\"i7\" name=\"kilos\" value="+aux[6]+">"
      +"<input type=\"HIDDEN\" id=\"i8\" name=\"espacio\" value="+aux[7]+">"
      +"<input type=\"HIDDEN\" id=\"i10\" name=\"email\" value="+aux[8]+">"
      +"<input type=\"HIDDEN\" id=\"i11\" name=\"numero\" value="+aux[9]+">";

      document.getElementById("Form3").submit();      }
    };
    xmlhttp.open("GET", "getMapViajes.php?q=" + "aux", true);
    xmlhttp.send();
}
</script>



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


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>