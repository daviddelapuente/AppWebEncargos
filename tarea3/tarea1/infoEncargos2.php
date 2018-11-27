<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>info encargos</title>
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
        echo "<th>".$_POST["comunaOrigen"]."</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>region origen</th>";
        echo "<th>".$_POST["regionOrigen"]."</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Comuna destino</th>";
        echo "<th>".$_POST["comunaDestino"]."</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>region destino</th>"; 
        echo "<th>".$_POST["regionDestino"]."</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>espacio</th>"; 
        echo "<th>".$_POST["espacio"]."</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>kilos</th>";
        echo "<th>".$_POST["kilos"]."</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>email encargador</th>";
        echo "<th>".$_POST["email_encargador"]."</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>celular encargador</th>";
        echo "<th>".$_POST["celular_encargador"]."</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>descripcion</th>";
        echo "<th>".$_POST["comentario"]."</th>";
        echo "</tr>";

        echo "</table>";

        echo "foto:";
        echo "<br>";


        $foto=$_POST["foto"];

        echo "<th><img src=\"imagenesTarea1/$foto\" width=\"320\" height=\"240\" alt=\"32882\" id=\"imgid\" onclick=\"changeSize()\"><th>";
	   ?>


      </table>
    </div>
  </div>
</div>

<script>
	function changeSize() {
    var a=document.getElementById("imgid").width;
    if(a>=500){
     document.getElementById("imgid").width=320;
     document.getElementById("imgid").height=240;

    }else{
     document.getElementById("imgid").width=800;
     document.getElementById("imgid").height=600;
    }
	}
</script>

<script>
  function Volver() {
     window.location.href="home.php"
  }
</script>







<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>