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

      // This example creates a simple polygon representing the Bermuda Triangle.
      // When the user clicks on the polygon an info window opens, showing
      // information about the polygon's coordinates.

      var map;
      var infoWindow;

//MPR FUNCTION FOR TESTING
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: {lat: 41.207763077508595, lng: -79.37774049022471}, 
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        // Define the LatLng coordinates for the polygon.
     
        var triangleCoords = [
           { lat: 41.207809,lng:-79.378227},
           {lat:41.207775,lng: -79.377769},
           {lat:41.207539,lng:-79.377815},
           {lat:41.207581,lng:-79.378220}
        ];

        // Construct the polygon.
        var bermudaTriangle = new google.maps.Polygon({
          paths: triangleCoords,
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 3,
          fillColor: '#FF0000',
          fillOpacity: 0.35
        });
        bermudaTriangle.setMap(map);
        // Add a listener for the click event.
                    var cords = [
           new google.maps.LatLng(41.20771180376523, -79.37790311880349),
            new google.maps.LatLng(41.207532975861064, -79.37744756236611),
            new google.maps.LatLng(41.20758603330814, -79.37744546689032),
            new google.maps.LatLng(41.2076615123462, -79.37769616961418),
            new google.maps.LatLng(41.207190926921086, -79.37797559393164),
            new google.maps.LatLng(41.207618471132456, -79.37770707181915),
            new google.maps.LatLng(41.20765078041049, -79.37771060230801),
            new google.maps.LatLng(41.207400392837314, -79.37773864832138),
            new google.maps.LatLng(41.20754961393886, -79.37781946740984),
            new google.maps.LatLng(41.20754961393886, -79.37781946740984),
            new google.maps.LatLng(41.207515457683435, -79.3778730277711),
            new google.maps.LatLng(41.207520319187275, -79.37787001028596),
            new google.maps.LatLng(41.20753945805088, -79.37782988558797),
            new google.maps.LatLng(41.2075283929236, -79.37786745369988),
            new google.maps.LatLng(41.208910139473446, -79.37366219043383),
            new google.maps.LatLng(41.20753493008526, -79.37786554460848),
            new google.maps.LatLng(41.207538982576494, -79.37791252178442),
            ];

            for ( var i = 0; i < cords.length; i++ )
              {
                var marker = new google.maps.Marker({
                        position: cords[ i ],
                        map: map });
                //map.addOverlay( marker );
               
              }

        google.maps.event.addDomListener(window, 'load', initialize);
        

        infoWindow.open(map);
      }
      
//STILL 112 FUNCTION FOR TESTING/COMPARE
 function initStillMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: {lat: 41.207763077508595, lng: -79.37774049022471}, 
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        // Define the LatLng coordinates for the polygon.
    // Still Hall 112								
        var triangleCoords = [
           { lat: 41.212437,lng:-79.378113},
           {lat:41.212399,lng:-79.377983},
           {lat:41.212261,lng:-79.378036},
           {lat:41.212322,lng:-79.378189}
        ];

        // Construct the polygon.
        var bermudaTriangle = new google.maps.Polygon({
          paths: triangleCoords,
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 3,
          fillColor: '#FF0000',
          fillOpacity: 0.35
        });
        bermudaTriangle.setMap(map);
        // Add a listener for the click event.
                    var cords = [
            new google.maps.LatLng(41.207697764077416, -79.37803831890164),
            new google.maps.LatLng(41.211869982109604, -79.37857266522883),
            new google.maps.LatLng(41.21223758097581, -79.37826481509086),
            new google.maps.LatLng(41.21205161140307, -79.37805657737033),
            new google.maps.LatLng(41.211120841497575, -79.37379636655317),
            new google.maps.LatLng(41.212292501383445, -79.37799852645708),
            new google.maps.LatLng(41.21231467715869, -79.37789974201775),
            new google.maps.LatLng (41.212142435872195, -79.3780648895347),
            new google.maps.LatLng(41.21235139671826, -79.3785826396936),
            new google.maps.LatLng(41.21244500697724, -79.37798575136475),
            new google.maps.LatLng(41.21223250603847, -79.37820576899526),
            new google.maps.LatLng(41.21242973925101, -79.37800712067173),
            new google.maps.LatLng(41.212355902154286, -79.37808972603602),
            new google.maps.LatLng(41.212355902154286, -79.37808972603602),
            new google.maps.LatLng(41.212394252508055, -79.37809362389487),
            new google.maps.LatLng(41.212394252508055, -79.37809362389487),
           new google.maps.LatLng (41.21236119095626, -79.37808611699768),
           new google.maps.LatLng (41.21236119095626, -79.37808611699768),
           new google.maps.LatLng (41.21239457103296, -79.37804667075477),
           new google.maps.LatLng (41.21239457103296, -79.37804667075477),
           new google.maps.LatLng (41.21237923308655, -79.37807335304922),
           new google.maps.LatLng (41.21237923308655, -79.37807335304922),
            new google.maps.LatLng(41.21237376926727, -79.37802358038243),
            new google.maps.LatLng(41.21237376926727, -79.37802358038243),
            new google.maps.LatLng(41.21241135573961, -79.37806171468662),
            new google.maps.LatLng(41.21241135573961, -79.37806171468662),
            new google.maps.LatLng(41.21238815999646, -79.37805644851932),
            new google.maps.LatLng(41.21238461356891, -79.37798893360434),
            new google.maps.LatLng(41.21236845303039, -79.37791716669255)
            ];

            for ( var i = 0; i < cords.length; i++ )
              {
                var marker = new google.maps.Marker({
                        position: cords[ i ],
                        map: map });
                //map.addOverlay( marker );
               
              }

        google.maps.event.addDomListener(window, 'load', initialize);
        

        infoWindow.open(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initStillMap">
    </script>
  </body>
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