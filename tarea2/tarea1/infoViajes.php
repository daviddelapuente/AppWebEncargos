<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>info viajes</title>
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
      <button onclick="Volver()" id="bottonVolver">Volver a la tabla</button>
    </div>

    <div class="col bg-secondary" id="id1">
	    <?php
	      echo "<table style=\"width:100%\">";
	        echo "<tr>";

	          echo "<th>Comuna origen</th>";
	          echo "<th>region origen</th>";
	          echo "<th>Comuna destino</th>";
	          echo "<th>region destino</th>";

	          echo "<th>Fecha ida/th>";
	          echo "<th>Fecha regreso</th>";

	          echo "<th>Espacio</th>"; 
	          echo "<th>Kilos</th>"; 
	          echo "<th>Email</th>"; 
	          echo "<th>celular</th>"; 
	        echo "</tr>";

	        echo "<tr>";
	        $comunaOrigen=$_POST["comunaOrigen"];
	        $regionOrigen=$_POST["regionOrigen"];

	        $origen=$mysqli->query("SELECT c.nombre AS nombreComuna, r.nombre AS nombreRegion FROM comuna c, region r WHERE c.id='$comunaOrigen' AND r.id='$regionOrigen';");
            $origenArray=$origen->fetch_assoc();
            echo "<th>".$origenArray["nombreComuna"]."</th>";
            echo "<th>".$origenArray["nombreRegion"]."</th>";


            $comunaDestino=$_POST["comunaDestino"];
	        $regionDestino=$_POST["regionDestino"];

	        $destino=$mysqli->query("SELECT c.nombre AS nombreComuna, r.nombre AS nombreRegion FROM comuna c, region r WHERE c.id='$comunaDestino' AND r.id='$regionDestino';");
            $destinoArray=$destino->fetch_assoc();
            echo "<th>".$destinoArray["nombreComuna"]."</th>";
            echo "<th>".$destinoArray["nombreRegion"]."</th>";

            $fechaIda=$_POST["fecha_ida"];
	        $fechaRegreso=$_POST["fecha_regreso"];
	        echo "<th>".$fechaIda."</th>";
            echo "<th>".$fechaRegreso."</th>";

            echo "<th>".$_POST["espacio"]."</th>";
	        echo "<th>".$_POST["kilos"]."</th>";
	        echo "<th>".$_POST["email_viajero"]."</th>";
	        echo "<th>".$_POST["celular_viajero"]."</th>";
	        echo "</tr>";

	        $e0=$_POST["e0"];
	        echo "<form method=\"post\" action=\"verViajes.php\" name=\"Form\" id=\"Form\">";
            echo  "<input type=\"HIDDEN\" id=\"estado\" name=\"estado\" value=$e0>";
            echo "</form>";
	     ?>


      </table>
    </div>
  </div>
</div>

<script>
	function Volver() {
 		 document.getElementById("Form").submit();
	}
</script>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>