  document.getElementById("comuna-origen").innerHTML=
  "<?php 
  $var_consulta= "select * from comuna where region_id=3";
  $var_resultado = $mysqli->query($var_consulta);
  while ($var_fila=$var_resultado->fetch_array()){
    echo "<option>".$var_fila["nombre"]."</option>";
  }
  ?>";