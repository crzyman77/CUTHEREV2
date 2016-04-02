<?php
  
    $title = "Event Details";
    require '../view/headerInclude.php';
   error_reporting(0); // Needed put in for LocalHost
    
?>
<script src="../js/locationCompare.js"></script>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    
    <section id="portfolio-information" class="padding-top">
        <div class="container" id='body'>
            <div class="row">
                <div class="col-sm-6">
                    <div class="project-name overflow">
                        <!-- HIDDEN DIVS TO GET DATA FROM DB TO JS FAST -->
                        <div id="eventId" style="visibility:hidden;"><?php echo $EventID;?></div>
                        <div id="venueId" style="visibility:hidden;"><?php echo $VenueID; ?></div>
                        <!-- End HIDDEN DIV -->
                        <h1 id="eventName" class="bold"><?php echo $row['name'] ?></h1>
                        <ul class="nav navbar-nav navbar-default">
                            <li><a><i class="fa fa-clock-o"></i><span id='eventDate'><?php echo date('l  F jS \, Y', strtotime($row['event_date'])); ?></span></a></li>
                            <li><a><i class="fa fa-bullseye"></i><span  id="eventBuilding"><?php echo $row['building_name'] ?></span>, <span id="eventRoom">Room <?php echo $row['room_number'] ?></span></a></li>
                        </ul>
                    </div>
                    <div class="project-info overflow">
                        <h3>Event Info</h3>
                        <p> <?php echo $row['description'] ?> </p>
                        <h3>Time</h3>
                        <ul class="elements">
                            <li><i class="fa fa-angle-right"></i>From <span id='eventStartTime'><?php echo $row['start_time'] ?></span> to <span id='eventEndTime'><?php echo $row['end_time'] ?></span></li>
                        </ul>
                    </div>
                    <div class="studentLogin overflow">
                        
                        <h3> E-mail </h3> 
                        <input type="text" class="form-control" id="studentEmail" name ='E-mail' value=""/>
                        @eagle.clarion.edu 
                        <br/>
                        <h3> Password </h3>
                        <input type="password" class="form-control" id="studentPass" value=""/>
                       
                    </div> <!-- END EMAIL CONTROLS -->
                    
                    <div class="skills overflow">
                        <h3>Eligible Classes:</h3>
                        <ul id="classesList" class="nav navbar-nav navbar-default">
                        <?php foreach ($class as $row){ ?><li><label class="btn btn-common <?php if($i%2) echo "checkboxinline"; ?>"><input type ="checkbox" value="<?php echo $row[class_number] . "/" . $row[class_section] . "/" .  $row[id]; ?>"></input><?php echo '  ',$row['class_number'], ' ',$row['class_name'],' ',$row['class_section'], ' ', $row['name']; ?></label></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <div class="live-preview">
                        <input type='submit' class ='btn btn-common uppercase' onclick="authorizeEmail();"  name='Check-In' value='checkin' />
                     <!--   <a role="button" class="btn btn-common uppercase" onclick="makeMyArray()"> Check-In</a> -->
                    </div>
                    <div id ="test"></div>
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </section>
     <!--/#event-information-->
        <br />
        
        <script>
            
      
      function authorizeEmail(){
          var email = $('#studentEmail')[0].value + '@eagle.clarion.edu';
          var pass = $('#studentPass')[0].value;
          var ajaxurl = '../model/authorize.php',
        data =  {'username': email,'pass':pass};
        $.post(ajaxurl,data, function (response) {
            if(response === 'true'){
             eventListLocationCheck(); //LocationCompareJavaScript Function Call if the user was loggin in
            }else{
                alert(response);
            }

             });
       }     
        var selectedClasses = [];
    </script>
<?php
    require '../view/footerInclude.php';
?>