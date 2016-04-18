<?php
  
    $title = "Event Details";
    require '../view/headerInclude.php';
   error_reporting(0); // Needed put in for LocalHost    
?>
<script src="../js/locationCompare.js"></script>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    
    <section id="portfolio-information">
        <div class="container" id='body'>
            <div class="row">
                <div class="col-sm-6">
                    <div class="project-name overflow">
                        
                        <h1 id="eventName" class="bold"><?php echo $row['name'] ?></h1>
                        <ul class="nav navbar-nav navbar-default">
                            <li><a><i class="fa fa-clock-o"></i><span id='eventDate'><?php echo toReadableDate($row['event_date']); ?></span></a></li>
                            <li><a><i class="fa fa-bullseye"></i><span  id="eventBuilding"><?php echo $row['building_name'] ?></span>, <span id="eventRoom">Room <?php echo $row['room_number'] ?></span></a></li>
                        </ul>
                    </div>
                    <div class="project-info overflow">
                        <h3>Event Info</h3>
                        <p> <?php echo $row['description'] ?> </p>
                        <h3>Time</h3>
                        <ul class="elements">
                            <li><i class="fa fa-angle-right"></i>From <span id='eventStartTime'><?php echo to12HourTime($row['start_time']) ?></span> to <span id='eventEndTime'><?php echo to12HourTime($row['end_time']) ?></span></li>
                        </ul>
                    </div>
                    <div class="studentLogin overflow">
                        
                        <h3> E-mail </h3> 
                        <input type="text" class="form-control" id="studentEmail" name ='E-mail' value=""/>
                        <label>@eagle.clarion.edu </label>
                        <br/>
                        <h3> Password </h3>
                        <input type="password" class="form-control" id="studentPass" value=""/>
                       
                    </div> <!-- END EMAIL CONTROLS -->
                    
                    <div class="skills overflow">
                        <h3>Eligible Classes:</h3>
                        <ul id="classesList" class="nav navbar-nav navbar-default">
                        <?php foreach ($class as $row){ ?><li><label class="btn btn-common"><input type ="checkbox" value="<?php echo $row[class_number] . "/" . $row[class_section] . "/" .  $row[id]; ?>"></input><?php echo '  ',$row['class_number'], ' ',$row['class_name'],' ',$row['class_section'], ' ', $row['name']; ?></label></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <div class="live-preview">
                        <input type='submit' class ='btn btn-common uppercase' onclick="authorizeEmail();"  name='Check-In' value='checkin' />
                     <!--   <a role="button" class="btn btn-common uppercase" onclick="makeMyArray()"> Check-In</a> -->
                        <a href="../controller/controller.php?action=EditEvent&amp;EventID=<?php echo $EventID ?>" role="button" class="btn btn-common uppercase">Edit Event</a>
                    </div>
                   
                    <!-- HIDDEN DIVS TO GET DATA FROM DB TO JS FAST -->
                        <div id="eventId" style="visibility:hidden;"><?php echo $EventID;?></div>
                        <div id="venueId" style="visibility:hidden;"><?php echo $VenueID; ?></div>
                        <div id="startTime" style="visibility:hidden;"><?php echo $row['start_time']; ?></div>
                        <div id='eventDateNoFormat' style="visibility:hidden;"><?php echo $row['event_date']; ?></div>
                        <!-- End HIDDEN DIV -->
                </div>
            </div>
        </div>
    </section>
     <!--/#event-information-->
        <br />
        
        <script>
            // Call Begin Check In -> Checks Times of the Event
                // IF True will authorize email  -- False error and Redirect
                    // IF Good will check location -- False error and Redirect
                        // If Good will allow post users selected classes to DB --False Error and Redirect
        
            
      function beginCheckIn(){
            var start = $('#startTime').html();
            var eventDate = $('#eventDateNoFormat').html();
            var preEventStart = 30; //Subtract Off Value For Proper Check-IN Allow
            var time = start.split(':');
            var date = eventDate.split('-');
            var startTime = new Date();
                startTime.setFullYear(date[0]);
                startTime.setMonth(date[1]-1); //Minus 1 since setMonth(jan = 0)
                startTime.setDate(date[2]);
                startTime.setHours(+time[0]); 
                startTime.setMinutes(parseInt(time[1]) - preEventStart); 
                startTime.setSeconds(time[2]);
            //Set Lock time for event Check IN
           var endTime = new Date();
                endTime.setFullYear(date[0]);
                endTime.setMonth(date[1]-1); //Minus 1 since setMonth(jan = 0)
                endTime.setDate(date[2]);
                endTime.setHours(+time[0]); 
                endTime.setMinutes(parseInt(time[1]) + 20); 
                endTime.setSeconds(time[2]);
            
            var currentTime = new Date(); //Current Time of User
            console.log("Start " + startTime);
            console.log("End " + endTime);
            console.log("Current " + currentTime);
            if(currentTime < endTime && currentTime > startTime){
                authorizeEmail();
            }
            else
               alert("The Event is not available for check in at the current time, please try again closer to the start of the event");
            // Check to see if user is within Acceptable Time Range
            
            
      }
      
      function authorizeEmail(){
          var userEmail = $('#studentEmail')[0].value;
          var splitEmail = userEmail.split('@');
          var email = splitEmail[0] + '@eagle.clarion.edu';
          //console.log(email);
          //console.log('Split: ' + splitEmail[0]);
          var pass = $('#studentPass')[0].value;
          var ajaxurl = '../model/authorize.php',
          data =  {'username': email,'pass':pass};
        $.post(ajaxurl,data, function (response) {
            if(response === 'true'){
             eventListLocationCheck(); //LocationCompareJavaScript Function Call if the user was loggin in
            }else{
                //alert(response);
                alert("We are unable to process your request at this time. Please Enter a Valid Clarion University Email and Password.");
            }

             });
       }     
        var selectedClasses = [];
    </script>
<?php
    require '../view/footerInclude.php';
?>