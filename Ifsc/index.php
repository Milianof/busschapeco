<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>A onde estou</title>
<link rel=stylesheet href="css/style.css">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=pt-br"></script> 
<script type="text/javascript">
    function $(id){
        return document.getElementById(id);
    }
    var trackerId = 0;
    var geocoder;
    var theUser = {};
    var map = {};
    function initializa() {
        geocoder = new google.maps.Geocoder();
        if (navigator.geolocation){
            var gps = navigator.geolocation;
            gps.getCurrentPosition(function(pos){
                var latLng = new google.maps.LatLng(pos.coords.latitude,pos.coords.longitude);
                var opts = {zoom:17, center:latLng, mapTypeId: google.maps.MapTypeId.ROADMAP};
                map = new google.maps.Map($("map_canvas"), opts);
                theUser = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: "You!"
                });
                showLocation(pos);
            });
            trackerId = gps.watchPosition(function(pos){
                var latLng = new google.maps.LatLng(pos.coords.latitude,pos.coords.longitude);
                map.setCenter(latLng);
                theUser.setPosition(latLng);
                showLocation(pos);
            });
        }
  }
    function showLocation(pos){
        var latLng = new google.maps.LatLng(pos.coords.latitude,pos.coords.longitude);
        if (geocoder) {
            geocoder.geocode({'latLng': latLng}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    $("location").innerHTML = results[1].formatted_address;
                } 
              } 
            });
          }     
    }
    function stopTracking(){
        if (trackerId){
            navigator.geolocation.clearWatch(trackerId);
        }
    }

    function initialize() {

      var mapOptions = {
        zoom: 12,
        center: new google.maps.LatLng(-27.132341446365416,-52.60525639095274)
      };
      var map = new google.maps.Map(document.getElementById('map-canvasa'),
          mapOptions);
    }

   google.maps.event.addDomListener(window, 'load', initialize);

</script>
</head>
<body onload="initializa()">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12 cabecalho">
      <p>BUSS localização</p>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row-fluid">
        <div class="span12 box">
            <form  class="form-inline" name="myForm" onsubmit="initialize()" method="get">
                <div class="input-prepend">
                  <span class="add-on"><i class=" icon-road"></i></span>
                  <input class="span8" id="prependedInput" type="text" placeholder="Destino">
                </div>
                <div class="input-prepend">
                  <span class="add-on"><i class="icon-time"></i></span>
                  <input class="span8" id="prependedInput" type="text" placeholder="Horário">
                </div>
                <div class="input-prepend">
                  <span class="add-on"><i class="icon-home"></i></span>
                  <input class="span8" id="prependedInput" type="text" placeholder="Chegada">
                </div>
                <select>
                <option>Parada 1</option>
                <option>Parada 2</option>
                <option>Parada 3</option>
                <option>Parada 4</option>
                <option>Parada 5</option>
                </select>
                <input type="submit" value="Localizar" class="btn">
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
  <div class="row-fluid">
        <div class="span6 borda">
            <div id="superbar">
                <span class="msg">Sua Localização: <span id="location"></span></span>
                <div id="map_canvas" class="mapa"></div>
            </div>
        </div>
        <div class="span6 borda">
            <div id="demo">
            <span class="msg">Destino: <span id="location"></span></span>
            <div id="map-canvasa" class="mapa" ></div>
            </div>
        </div>
    </div>
</div>  
    <div class="rodape">
       <p>Desafio IFSC ideias inovadoras</p>
    </div>
</body>
</html>
