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
            new google.maps.LatLng(41.212109011037, -79.37887874577808),
            new google.maps.LatLng(41.21235616448059, -79.37800276997825),
            new google.maps.LatLng(41.212411414026164, -79.3778875960395),
            new google.maps.LatLng(41.2123061, -79.37801330000002),
            new google.maps.LatLng(41.21236357692429, -79.37802621553101),
            new google.maps.LatLng(41.2122366, -79.37810130000003),
            new google.maps.LatLng(41.212309588486, -79.37796541288554),
            new google.maps.LatLng(41.212401485516686, -79.37804147005272),
            new google.maps.LatLng(41.2121937, -79.37805730000002),
            new google.maps.LatLng(41.21244193677974, -79.37771207888215),
            new google.maps.LatLng(41.2122284, -79.37801330000002),
            new google.maps.LatLng(41.212382433812714, -79.37768954450172),
            new google.maps.LatLng(41.21224509118998, -79.37815908349313),
            new google.maps.LatLng(41.21234243335899, -79.37820765801001),
            new google.maps.LatLng(41.21236083, -79.37796192999997),
            new google.maps.LatLng(41.212450801452384, -79.37803715947535),
            new google.maps.LatLng(41.21250984661623, -79.37779205956326),
            new google.maps.LatLng(41.21238679339211, -79.37775449636024),
            new google.maps.LatLng(41.21231806, -79.37801905999999),
            new google.maps.LatLng(41.212344091228736, -79.37809066173952),
            new google.maps.LatLng(41.21230925819163, -79.37811576902914),
            new google.maps.LatLng(41.21228513502022, -79.37812489236876),
            new google.maps.LatLng(41.212282793740926, -79.37803528425786),
            new google.maps.LatLng(41.21120882409038, -79.38100932248079),
            new google.maps.LatLng(41.21142807789808, -79.3802811146623),
            new google.maps.LatLng(41.211276, -79.38030070000002),
            new google.maps.LatLng(41.21141994672472, -79.38028592436541),
            new google.maps.LatLng(41.2065686, -79.38439149999999),
            new google.maps.LatLng(41.2113455, -79.38021279999998),
            new google.maps.LatLng(41.21151901323327, -79.38050170058341),
            new google.maps.LatLng(41.21143378786855, -79.38028240583776),
            new google.maps.LatLng(41.2114232, -79.38021279999998),
            new google.maps.LatLng(41.21147615838908, -79.38025030314861),
            new google.maps.LatLng(41.2114624539774, -79.38025717630921),
            new google.maps.LatLng(41.2113884, -79.38025670000002),
            new google.maps.LatLng(41.21146776667597, -79.38019856153619),
            new google.maps.LatLng(41.2113908, -79.38026309999998),
            new google.maps.LatLng(41.211372250019515, -79.3803031827307),
            new google.maps.LatLng(41.21146590287389, -79.38020823109264),
            new google.maps.LatLng(41.21144322, -79.37991622999999),
            new google.maps.LatLng (41.21146897269333, -79.38018740047289),
            new google.maps.LatLng(41.2113537, -79.38030070000002),
            new google.maps.LatLng(41.211322446510735, -79.38017624799619),
            new google.maps.LatLng(41.2115011, -79.38024310000003),
            new google.maps.LatLng(41.2115778, -79.38029718000001),
            new google.maps.LatLng(41.211311, -79.38025649999997),
            new google.maps.LatLng(41.211407608950545, -79.38007649863505),
            new google.maps.LatLng(41.2114714005996, -79.38020118992301),
            new google.maps.LatLng(41.21147438079782, -79.3801957604847),
            new google.maps.LatLng(41.211480475069216, -79.3802230619633),
            new google.maps.LatLng(41.21062455, -79.37987708000003),
            new google.maps.LatLng(41.211478756779066, -79.38022390015362),
            new google.maps.LatLng(41.2078381, -79.37757340000002),
            new google.maps.LatLng(41.2077849, -79.37783739999998),
            new google.maps.LatLng(41.20778908521069, -79.37778979254097),
            new google.maps.LatLng(41.2077767, -79.37774939999997),
            new google.maps.LatLng(41.20839430023097, -79.3780424260342),
            new google.maps.LatLng(41.2077766, -79.37774939999997),
            new google.maps.LatLng(41.208318569735816, -79.37805600471734),
            new google.maps.LatLng(41.20699153884937, -79.3776308038918),
            new google.maps.LatLng(41.207838, -79.37757340000002),
            new google.maps.LatLng(41.207134277820295, -79.37751351719726),
            new google.maps.LatLng(41.2075563036748, -79.37788455766196),
            new google.maps.LatLng(41.20771633726821, -79.37763829268181),
            new google.maps.LatLng(41.20756237153907, -79.37746825724031),
            new google.maps.LatLng(41.20819816371893, -79.37751077163239),
            new google.maps.LatLng(41.2077861, -79.37784959999999),
            new google.maps.LatLng(41.207500447085785, -79.37773603368043),
            new google.maps.LatLng(41.20752119928711, -79.37816371217309),
            new google.maps.LatLng(41.20811732024067, -79.37801107771634),
            new google.maps.LatLng(41.198081, -79.3833358),
            new google.maps.LatLng(41.2077931, -79.37792530000002),
            new google.maps.LatLng(41.20795794309332, -79.37771925756891),
            new google.maps.LatLng(41.20781165679619, -79.37774393377038),
            new google.maps.LatLng(41.20740685915641, -79.37807510628454),
            new google.maps.LatLng(41.207559169308475, -79.37787109993337),
            new google.maps.LatLng(41.20793124199026, -79.37792868360816),
            new google.maps.LatLng(41.207950921964006, -79.3780029067724),
            new google.maps.LatLng(41.20793290476859, -79.37751701067424),
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
             new google.maps.LatLng(41.212109011037, -79.37887874577808),
             new google.maps.LatLng(41.21235616448059, -79.37800276997825),
             new google.maps.LatLng(41.212411414026164, -79.3778875960395),
             new google.maps.LatLng(41.2123061, -79.37801330000002),
             new google.maps.LatLng(41.21236357692429, -79.37802621553101),
             new google.maps.LatLng(41.2122366, -79.37810130000003),
             new google.maps.LatLng(41.212309588486, -79.37796541288554),
             new google.maps.LatLng(41.212401485516686, -79.37804147005272),
             new google.maps.LatLng(41.2121937, -79.37805730000002),
             new google.maps.LatLng(41.21244193677974, -79.37771207888215),
             new google.maps.LatLng(41.2122284, -79.37801330000002),
             new google.maps.LatLng(41.212382433812714, -79.37768954450172),
             new google.maps.LatLng(41.21224509118998, -79.37815908349313),
             new google.maps.LatLng(41.21234243335899, -79.37820765801001),
             new google.maps.LatLng(41.21236083, -79.37796192999997),
             new google.maps.LatLng(41.212450801452384, -79.37803715947535),
             new google.maps.LatLng(41.21250984661623, -79.37779205956326),
             new google.maps.LatLng(41.21238679339211, -79.37775449636024),
             new google.maps.LatLng(41.21231806, -79.37801905999999),
             new google.maps.LatLng(41.212344091228736, -79.37809066173952),
             new google.maps.LatLng(41.21230925819163, -79.37811576902914),
             new google.maps.LatLng(41.21228513502022, -79.37812489236876),
             new google.maps.LatLng(41.212282793740926, -79.37803528425786),
             new google.maps.LatLng(41.211276, -79.38030070000002),
             new google.maps.LatLng(41.2065686, -79.38439149999999),
             new google.maps.LatLng(41.207697764077416, -79.37803831890164),
             new google.maps.LatLng(41.211869982109604, -79.37857266522883),
             new google.maps.LatLng(41.21223758097581, -79.37826481509086),
             new google.maps.LatLng(41.21205161140307, -79.37805657737033),
             new google.maps.LatLng(41.211120841497575, -79.37379636655317),
             new google.maps.LatLng(41.212292501383445, -79.37799852645708),
             new google.maps.LatLng(41.21231467715869, -79.37789974201775),
             new google.maps.LatLng(41.212142435872195, -79.3780648895347),
             new google.maps.LatLng(41.21235139671826, -79.3785826396936),
             new google.maps.LatLng(41.21244500697724, -79.37798575136475),
             new google.maps.LatLng(41.21223250603847, -79.37820576899526),
             new google.maps.LatLng(41.21242973925101, -79.37800712067173),
             new google.maps.LatLng(41.212355902154286, -79.37808972603602),
             new google.maps.LatLng(41.212355902154286, -79.37808972603602),
             new google.maps.LatLng(41.212394252508055, -79.37809362389487),
             new google.maps.LatLng(41.212394252508055, -79.37809362389487),
             new google.maps.LatLng(41.21236119095626, -79.37808611699768),
             new google.maps.LatLng(41.21236119095626, -79.37808611699768),
             new google.maps.LatLng(41.21239457103296, -79.37804667075477),
             new google.maps.LatLng(41.21239457103296, -79.37804667075477),
             new google.maps.LatLng(41.21237923308655, -79.37807335304922),
             new google.maps.LatLng(41.21237923308655, -79.37807335304922),
             new google.maps.LatLng(41.21237376926727, -79.37802358038243),
             new google.maps.LatLng(41.21237376926727, -79.37802358038243),
             new google.maps.LatLng(41.21241135573961, -79.37806171468662),
             new google.maps.LatLng(41.21241135573961, -79.37806171468662),
             new google.maps.LatLng(41.21238815999646, -79.37805644851932),
             new google.maps.LatLng (41.21238461356891, -79.37798893360434),
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
    src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap">
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