<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <style  type="text/css">

  #ws { background-color: #f8f8f8; }

  .send { color:#77bb77; }
  .server { color:#7799bb; }
  .error { color:#AA0000; }
  
   #map-canvas { height: 600px; width:100%; margin: 0; padding: 0;}
  </style>
  <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbjBeSAdlffem9H38UQtwL5sMx3btOjvk">
  </script>
    <script type="text/javascript">
      var geocoder;
var map;
var ultimoMarker;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-33.47269,-70.668182);
  var mapOptions = {
    zoom: 6,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var response=this.responseText.split("#");
      
      codeAddress(response[3],response[5],response[2],response[4],response[0],response[1],response[6],response[7]);
      codeAddress(response[12],response[14],response[11],response[13],response[9],response[10],response[15],response[16]);
      codeAddress(response[21],response[23],response[20],response[22],response[18],response[19],response[24],response[25]);

      

    }
  };
  xmlhttp.open("GET", "getMapViajes.php?q=" + "aux", true);
  xmlhttp.send();
}

function codeAddress(str,str2,str3,str4,str5,str6,str7,str8) {
  var address = str
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location, 
    title: address+"/"+str3+"/"+str5
      });
      var infowindow = new google.maps.InfoWindow({
          content: "<p>region: "+str+"</p> <p>comuna: "+str3+"</p> <p>fecha: "+str5+"</p> <p>kilos: "+str7+"</p> <p>espacio: "+str8+"</p><p><a href=\"verViajes.php/\">mas Info</a></p>"
    });
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
      });

      ultimoMarker = marker;
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });

  var address2=str2;
    geocoder.geocode( { 'address': address2}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location, 
    title: address2+"/"+str4+"/"+str6
      });
      var infowindow = new google.maps.InfoWindow({
          content: "<p>region: "+str2+"</p> <p>comuna: "+str4+"</p> <p>fecha: "+str6+"</p> <p>kilos: "+str7+"</p> <p>espacio: "+str8+"</p> <p><a href=\"verViajes.php/\">mas Info</a></p>"
    });
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
      });

      
      // agregar linea entre este y último marcador
      if (ultimoMarker) {
  var flightPlanCoordinates = [
          ultimoMarker.position, marker.position];
        var flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
          });

          flightPath.setMap(map);
      }
      
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  <title>Google Maps</title>
</head>
<body>
<h1 id="h1">Viajes</h1>
<p id="1" name="1"></p>
<div id="map-canvas"></div>
<button onclick="Volver()">Volver</button>
</body>
<script>
function Volver() {
  window.location.href="home.php"
}
</script>
</html>

