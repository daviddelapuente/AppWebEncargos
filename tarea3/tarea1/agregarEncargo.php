<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>agregar encargo</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?php
  include("config.php");

  $mysqli = new mysqli('localhost', 'root', '', 'tarea2');
  $mysqli->set_charset("utf8");
  ?>

  <script type="text/javascript">
  function checkAll(){
    var des=document.forms["Form"]["descripcion"].value;
    var ro=document.forms["Form"]["region-origen"].value;
    var rd=document.forms["Form"]["region-destino"].value;

    var co=document.forms["Form"]["comuna-origen"].value;
    var cd=document.forms["Form"]["comuna-destino"].value;
    var email=document.forms["Form"]["email"].value;

    var des=document.forms["Form"]["descripcion"].value;

        if (email==null || email=="")
        {
            alert("porfavor ingresa un correo");
        }  else if( document.getElementById("emailLabel").value==3){
            alert("Porfavor cambia el email a uno valido");
        }else if (document.getElementById("numberLabel").value==3){
            alert("Porfavor cambia el numero a uno valido (10 digitos)");
        }else if (ro==rd && co==cd){
            alert("comuna origen y comuna destino deben ser distintas");
        }else if(des==null || des==""){
            alert("porfavor completa una descripcion");
        }else if(des.length>250){
            alert("porfavor ingresa una descripcion de no mas de 250 caracteres");
        }else{
            document.getElementById("Form").submit();
        }
    
    
 } 

 function setComunas(selectObj,n) { 

 var idx = selectObj.selectedIndex; 

 var which = selectObj.options[idx].value; 

 cList = regionesList[which]; 

 var cSelect;
 if(n==0){
  cSelect = document.getElementById("comuna-origen"); 
 }else{
  cSelect = document.getElementById("comuna-destino"); 
 }

 var len=cSelect.options.length; 
 while (cSelect.options.length > 0) { 
 cSelect.remove(0); 
 } 
 var newOption; 
 
 for (var i=0; i<cList.length; i++) { 
 newOption = document.createElement("option"); 
 newOption.value = cList[i];  
 newOption.text=cList[i]; 

 try { 
 cSelect.add(newOption);   
 } 
 catch (e) { 
 cSelect.appendChild(newOption); 
 } 
 } 
 } 

</script>
<style>
button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    width: 200px;
}
:invalid { 
  border-color: #e88;
  -webkit-box-shadow: 0 0 5px rgba(255, 0, 0, .8);
  -moz-box-shadow: 0 0 5px rbba(255, 0, 0, .8);
  -o-box-shadow: 0 0 5px rbba(255, 0, 0, .8);
  -ms-box-shadow: 0 0 5px rbba(255, 0, 0, .8);
  box-shadow:0 0 5px rgba(255, 0, 0, .8);
}

:required {
  border-color: #88a;
  -webkit-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  -moz-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  -o-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  -ms-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  box-shadow: 0 0 5px rgba(0, 0, 255, .5);
}

form {
  width:300px;
  margin: 20px auto;
}
select {
  width:300px;
}
input {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  border:1px solid #ccc;
  font-size:20px;
  width:300px;
  min-height:30px;
  display:block;
  margin-bottom:15px;
  margin-top:5px;
  outline: none;

  -webkit-border-radius:5px;
  -moz-border-radius:5px;
  -o-border-radius:5px;
  -ms-border-radius:5px;
  border-radius:5px;
}

input[type=submit] {
  background:none;
  padding:10px;
}
input[type=file]{
  width: 100px;
}

</style>

</head>

<body>

<div class="container-fluid">
  <div class="row bg-dark">
    <div class="col">
      <h1 class="text-center text-white">Agrega Tu Encargo</h1>
    </div>
  </div>

  <div class="row">
    <div class="col bg-secondary text-center">
      <form method="post" action="home.php" enctype="multipart/form-data" name="Form" id="Form">
          <label>Descripcion encargo</label>
          <textarea name="descripcion" rows="5" cols="30"></textarea>

          <label>espacio disponible</label>
          <div>
            <?php
              $var_consulta= "select * from espacio_encargo";
              $var_resultado = $mysqli->query($var_consulta);

              echo "<select name=\"espacio-disponible\" id=\"espacio-disponible\">";
              while ($var_fila=$var_resultado->fetch_array())
              {
                echo "<option>".$var_fila["valor"]."</option>";
               }
               echo "</select>";
              ?>
          </div>

          <label>kilos disponibles</label>
          <div>
            <?php
              $var_consulta= "select * from kilos_encargo";
              $var_resultado = $mysqli->query($var_consulta);

              echo "<select name=\"kilos-disponibles\" id=\"kilos-disponibles\">";
              while ($var_fila=$var_resultado->fetch_array())
              {
                echo "<option>".$var_fila["valor"]."</option>";
               }
               echo "</select>";
              ?>
          </div>


          <label>Región origen</label>
          <div>
            <?php
              $var_consulta= "select * from region";
              $var_resultado = $mysqli->query($var_consulta);

              echo "<select name=\"region-origen\" onchange=\"setComunas2(this,0)\">";
              while ($var_fila=$var_resultado->fetch_array())
              {
                echo "<option >".$var_fila["nombre"]."</option>";
               }
               echo "</select>";
              ?>
          </div>

          <label>Comuna origen</label>
          <div>
            <?php
              $var_consulta= "select * from comuna where region_id=1";
              $var_resultado = $mysqli->query($var_consulta);

              echo "<select name=\"comuna-origen\" id=\"comuna-origen\">";
              while ($var_fila=$var_resultado->fetch_array())
              {
                echo "<option>".$var_fila["nombre"]."</option>";
               }
               echo "</select>";
              ?>
          </div>

          <label>Región destino</label>
          <div>
            <?php
              $var_consulta= "select * from region";
              $var_resultado = $mysqli->query($var_consulta);

              echo "<select name=\"region-destino\" onchange=\"setComunas2(this,1)\">";
              while ($var_fila=$var_resultado->fetch_array())
              {
                echo "<option >".$var_fila["nombre"]."</option>";
               }
               echo "</select>";
              ?>
          </div>

          <label>Comuna destino</label>
          <div>
            <?php
              $var_consulta= "select * from comuna where region_id=1";
              $var_resultado = $mysqli->query($var_consulta);

              echo "<select name=\"comuna-destino\" id=\"comuna-destino\">";
              while ($var_fila=$var_resultado->fetch_array())
              {
                echo "<option>".$var_fila["nombre"]."</option>";
               }
               echo "</select>";
              ?>
          </div>

          <label id="fotoLabel">Foto Encargo</label>
          <input type="file" name="foto-encargo" onchange="f(this)" id="foto">

          <label id="emailLabel">email Encargador</label>
          <input type="email" id="email" name="email" maxlength="30" 
           onchange="checkEmail(this)">

          <label id="numberLabel">número celular Encargador</label>
          <input type="text" id="celular" name="celular" maxlength="15" onchange="checkNumber(this)">

          <input type="HIDDEN" id="y" name="y">

          
      </form>

      <lable id="errores"></lable>
      <div class="col bg-secondary text-center">
        <button onclick="checkAll()">Enviar</button>
      </div>

      <div class="row">
        <div class="col bg-secondary text-center">
          <button onclick="Volver()">Volver</button>
        </div>
      </div>

    </div>
  </div>

</div>



<script>
function Volver() {
  window.location.href="home.php"
}
</script>
<script>
function checkEmail(em) {
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(em.value)){
    document.getElementById("emailLabel").innerHTML="email viajero";
    document.getElementById("emailLabel").style.color="black";
    document.getElementById("emailLabel").value=1;
  }else{
    document.getElementById("emailLabel").innerHTML="Ingrese un email valido";
    document.getElementById("emailLabel").style.color="red";
    document.getElementById("emailLabel").value=3;
  }

}
</script>

<script>
function checkNumber(num) {
 var phoneno = /^\d{10}$/;

 if (num.value.match(phoneno)){
    document.getElementById("numberLabel").innerHTML="número celular viajero";
    document.getElementById("numberLabel").style.color="black";
    document.getElementById("emailLabel").value=1;
  }else{
    document.getElementById("numberLabel").innerHTML="Ingrese un numero valido (10 digitos)";
    document.getElementById("numberLabel").style.color="red";
    document.getElementById("emailLabel").value=3;
  }

}
</script>

<script>
function setComunas2(x,n) {
  var s="";
  if(n==0){
    s="comuna-origen";
  }else{
    s="comuna-destino";
  }
  if (x.value=="Región de Tarapacá"){
    document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=1";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región de Antofagasta"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=2";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región de Atacama"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=3";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región de Coquimbo"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=4";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región de Valparaíso"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=5";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región del Libertador Bernardo Ohiggins"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=6";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región del Maule"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=7";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región del Bío-Bío"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=8";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región de la Araucanía"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=9";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región de los Lagos"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=10";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región Aisén del General Carlos Ibáñez del Campo"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=11";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región de Magallanes y la Antártica Chilena"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=12";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región Metropolitana de Santiago"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=13";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región de los Rios"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=14";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }else if(x.value=="Región Arica y Parinacota"){
        document.getElementById(s).innerHTML=
      "<?php 
  $var_consulta= "select * from comuna where region_id=15";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";
  }
}
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
