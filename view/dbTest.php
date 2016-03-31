 <?php
  
    $title = "Database Tests";
   // require '../view/headerInclude.php';  
 ?>
<div id="body">
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Test Case 1 </h1>
                            <div>
                                <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 24.886, lng: -70.269},
          zoom: 5,
        });

        var buildingCoords = [
            {lat: 41.206851, lng:-79.381930},
            {lat: 41.206786, lng:-79.375321},
            {lat: 41.204695, lng:-79.375397},
            {lat: 41.204711, lng:-79.381437}
        ];

        var bermudaTriangle = new google.maps.Polygon({paths: buildingCoords});

        google.maps.event.addListener(map, 'click', function(e) {
          var resultColor =
              google.maps.geometry.poly.containsLocation(e.latLng, bermudaTriangle) ?
              'red' :
              'green';

          new google.maps.Marker({
            position: e.latLng,
            map: map,
            icon: {
              path: google.maps.SymbolPath.CIRCLE,
              fillColor: resultColor,
              fillOpacity: .2,
              strokeColor: 'white',
              strokeWeight: .5,
              scale: 10
            }
          });
        });
      }
      </script>
   <script async defer
    src="https://maps.googleapis.com/maps/api/js?sensor=fail&libraries=geometry&callback=initMap">
    </script>   
                      </div>
                     </div>
                </div>
         
                 
            </div>
        </div>
   </section>
    <section id="services">
            <div>

                <p id="test"></p>
       
              

            </div>
        </section>
    
</div>
    <!--/#services-->

    

<?php
    require '../view/footerInclude.php';
?>