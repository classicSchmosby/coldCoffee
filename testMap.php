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
    <style>
      #map {
        height:100%;
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
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(52.595284, 0.80887),
          zoom: 8
        });

        <?php
          $markerQuery = mysqli_query($conn,
            "SELECT * FROM TABLE");
          // not needed with while? - $row = mysqli_fetch_array($markerQuery, MYSQLI_ASSOC);
          // now you can: echo($row['COLUMN_NAME']);

          while($map = mysqli_fetch_assoc($markerQuery)) :
            $markerId = $map['markerId'];
            $markerDesc = $map['markerDesc'];
            $markerWebsite = $map['markerWebsite'];
            $markerTitle = $map['markerTitle'];
            $lat = $map['lat'];
            $lng = $map['lng'];
            $markerMap = $map['markerMap'];
            $markerIcon = $map['markerIcon'];
        ?>
        var marker = new google.maps.Marker({
          id: <?php echo($markerId); ?>,
          description: <?php echo($markerDesc); ?>,
          website: <?php echo($markerWebsite); ?>,
          title: <?php echo($markerTitle); ?>,
          position: new google.maps.LatLng(<?php echo($lat); ?>, <?php echo($lng); ?>),
          map: <?php echo($markerMap); ?>,
          icon: <?php echo($markerIcon); ?>
        });

        google.maps.event.addListener(marker, 'click', (function(marker) {
          return function() {
            infowindow.setContent('<div>Location ID: '+ <?php echo($markerId); ?> + '</div>');
            infowindow.open(map, marker);
          }
      })(marker));

        <?php 
          endwhile;
        ?>
      } // initMap
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAomdRkAs6Es584dRUIflhwTTdcjkLwI_Y&callback=initMap"
    async defer></script>
  </body>
</html>