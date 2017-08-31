<?php
  include('config.php');
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <script src="assets/js/adsbygoogle.js" type="text/javascript"></script>
    <script src="assets/js/analytics.js" type="text/javascript"></script>
    <script src="assets/js/googleAsync.js" type="text/javascript"></script>
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>

    <style type="text/css">
      #map {
        height:800px;
        width:800px;
        border:1px solid black;
        margin-left:10px;
        margin-top:10px;
      }
      html, body {
        width:100%;
        height:100%;
        margin:0;
        padding:0;
      }
    </style>
  </head>
  <body>

    <div id="map"></div>
    
  </body>
  <script type="text/javascript">
      function initMap() {
        var infowindow = new google.maps.InfoWindow();
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(52.595284, 0.80887),
          zoom: 8,
          mapTypeControl: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        

        function placeMarker(loc) {
          var latLng = new google.maps.LatLng(<?php echo($row['lat']); ?>, <?php echo($row['lng']); ?>);
          var marker = new google.maps.Marker({
            position: latLng,
            map: map
          });
          google.maps.event.addListener(marker, 'click', function(){
            infowindow.close(); // Close previously opened infowindow
            infowindow.setContent( "<div id='infowindow'>"+ <?php echo($row['locationId']); ?> +"</div>");
            infowindow.open(map, marker);
          });
        }

        <?php
          $markerQuery = mysqli_query($conn, "SELECT * FROM location WHERE (hidden = 0)");
          while($row = mysqli_fetch_array($markerQuery, MYSQLI_ASSOC)):
        ?>
          placeMarker(<?php echo($row); ?>);
        
        // Try this?: https://stackoverflow.com/questions/3059044/google-maps-js-api-v3-simple-multiple-marker-example
        

        <?php endwhile; ?>

      } // initMap
      google.maps.event.addDomListener(window, 'load', initMap);
    </script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAomdRkAs6Es584dRUIflhwTTdcjkLwI_Y&callback=initMap" type="text/javascript"></script>
</html>