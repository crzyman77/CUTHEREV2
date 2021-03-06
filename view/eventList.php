<?php
 
    $title = "List of Events";
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
    
    <section id="portfolio-information" class="padding-top padding-bottom">
        <div class="container padding-bottom">
            <div class="row">
                <h2> Welcome </h2>
                <table id="eventsTable" class="table table-hover table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Building</th>
                            <th>Room</th>
                            <th>Date</th>
                            <th>Begin Time</th>
                            <th>End Time</th>
                            <?php if(userIsAuthorized("AddEvent")) { //If a user can add events, they should be allowed to delete them?>
                            <th>Delete Events</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach ($events as $row){ $i++; ?>
                        <tr class ="clickable-row eventRow" data-event= "<?php echo $row['id']?>" data-href="../controller/controller.php?action=EventDetails&amp;EventID=<?php echo $row['id'] ?>&amp;VenueID=<?php echo $row['location']?>">
                            <td><a> <?php echo $row['name'] ?></a></td>
                            <td><?php echo $row['building_name'] ?></td>
                            <td><?php echo $row['room_number'] ?></td>
                            <td><?php echo toReadableDate($row['event_date']) ?></td>
                            <td><?php echo to12HourTime($row['start_time']) ?></td>
                            <td><?php echo to12HourTime($row['end_time']) ?></td>
                            <?php if(userIsAuthorized("AddEvent")) { //If a user can add events, they should be allowed to delete them?>
                            <td><button role="button" class="btn btn-common uppercase deleteEventButton" onclick="bindEvents">Delete Event</button></td>
                            <?php } ?>
                        </tr>
                        <?php } ?></tbody>
                </table>
            </div>
           
        </div>
    </section>
    
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
            });
            bindEvents();
            
        });

        
        function bindEvents() {
            jQuery(".deleteEventButton").click(function(e){
               // alert(e);
                var eventId = $('.eventRow').data("event");
               // alert(eventId);
                $.post('../model/deleteSingleEventAjax.php',{'event':eventId},function(response){ 
                    console.log(response);
                });
                jQuery(e.target).closest(".eventRow").remove();
            });
        }
        
        
    </script>
<?php
    require '../view/footerInclude.php';
?>