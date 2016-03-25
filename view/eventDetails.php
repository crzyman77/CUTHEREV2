<?php
  
    $title = "Event Details";
    require '../view/headerInclude.php';
    
?>
<script src="../js/locationCompare.js"></script>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title"><?php echo $title ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!--/#action-->

    <section id="portfolio-information" class="padding-top">
        <div class="container" id='body'>
            <div class="row">
                <!-- CG: Just Was Printing out for test purposes, feel free to delete whenver -->
                <?php 
                        
                      // print_r($_SESSION);
                      // print_r($_SESSION['preferred_username']);
                      // print_r($_SESSION['user_name']);
                      // print_r($_SESSION['venue']);
                        ?>
              <!--  <div id ='gmap' class="col-sm-6" style="background-color: #DDD">Insert map here? Maybe allow a picture to be uploaded? If not, it's cool.</div>
                --><div class="col-sm-6">
                    <div class="project-name overflow">
                        <h2> Welcome <?php echo $_SESSION['user_name']?> </h2>
                        <h2 id="eventName" class="bold"><?php echo $row['name'] ?></h2>
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
                    <div class="skills overflow">
                        <h3>Eligible Classes:</h3>
                        <ul id="classesList" class="nav navbar-nav navbar-default">
                        <?php foreach ($class as $row){ ?><li><label class="btn btn-common <?php if($i%2) echo "checkboxinline"; ?>"><input type ="checkbox" value="<?php echo $row[class_number] . " " . $row[class_section] . " " . $row[first_name] . " " . $row[last_name]; ?>"></input><?php echo $row['class_number'], ' ',$row['class_name'],' ',$row['class_section'], ' ', $row['last_name']; ?></label></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <div class="live-preview">
                        <a role="button" class="btn btn-common uppercase" onclick="eventListLocationCheck()"> Check-In</a>
                    </div>
                    <div id ="test"></div>
                </div>
            </div>
        </div>
    </section>
     <!--/#event-information-->
        <br />
        
        <script>
        var selectedClasses = [];
        
        //Creates an array from selected extboxes on the page.
        //The array: 
        //      arrayName = [ {class_number: w0, class_section: x0, instructor_fname: y0, instructor_lname: z0}, 
        //                    {class_number: w1, class_section: x1, instructor_fname: y1, instructor_lname: z1},
        //                    ... etc ];
        function makeMyArray(){
            selectedClasses = [];
            
        //For test cases set up a div or something with an ID of test    
        //$("#test").html(" ");
            var valueString;
            $("input:checkbox:checked").each(function(){
                valueString = ($(this).val());
                tempRes = valueString.split(" ");
                res = {class_number: tempRes[0], class_section: tempRes[1], instructor_fname: tempRes[2], instructor_lname: tempRes[3]};
                selectedClasses.push(res);
            });
           
        //Print's out selected checkboxes
        //This is a test thing, not needed for actal use
        /*
           for(i = 0; i < selectedClasses.length; i++)
           {
               
               $("#test").append(selectedClasses[i].class_number.toString() + " " + selectedClasses[i].class_section.toString() + " " + selectedClasses[i].instructor_fname.toString() + " " + selectedClasses[i].instructor_lname.toString() + "\n");
           }
        */
         }  
    </script>
<?php
    require '../view/footerInclude.php';
?>