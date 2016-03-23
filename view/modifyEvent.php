<?php
    $title = "$mode Event";
    require '../view/headerInclude.php';
?>
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
              <!--  <div id ='gmap' class="col-sm-6" style="background-color: #DDD">Insert map here? Maybe allow a picture to be uploaded? If not, it's cool.</div>
                --><div class="col-sm-6">
                    <div class="project-info">
                        <div class="form-group">
                            <h2>Event Name</h2>
                            <input type="text" class="form-control" id="eventName" value="<?php if($mode === 'Edit'){echo $EventName;} ?>"/>
                            <h2>Event Location</h2>
                            <h3>Building</h3>
                            <input type="text" class="form-control" id="eventBuilding" value="<?php if($mode === 'Edit'){echo $EventBuilding;} ?>"/>
                            <h3>Room</h3>
                            <input type="text" class="form-control" id="eventRoom" value="<?php if($mode === 'Edit'){echo $EventRoom;} ?>"/>
                            <h2>Event Description</h2>
                            <textarea class="form-control" rows="5" id="eventDescription"><?php if($mode === 'Edit'){echo $EventDescription;} ?></textarea>
                        </div>
                        <h2>Time and Date</h2>
                        <h3>Date</h3>
                        <div class="form-group">
                            <div class='input-group date' id='datePicker'>
                                <input type='text' class="form-control" id="eventDate" value="<?php if($mode === 'Edit'){echo toReadableDate($EventDate);} ?>"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <h3>Start Time</h3>
                        <div class="form-group">
                            <div class='input-group date' id='startTimePicker'>
                                <input type='text' class="form-control" id="eventStartTime" value="<?php if($mode === 'Edit'){echo to12HourTime($EventStart);} ?>"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <h3>End Time</h3>
                        <div class="form-group">
                            <div class='input-group date' id='endTimePicker'>
                                <input type='text' class="form-control" id="eventEndTime" value="<?php if($mode === 'Edit'){echo to12HourTime($EventEnd);} ?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <h2>Eligible Classes:</h2>
                        <select id="classesList" class="form-control">
                        <?php foreach ($class as $row1){ ?><option><?php echo $row1['class_number'], ' ',$row1['class_section']; ?></option>
                        <?php }?></select>
                    </div>
                    <div class="form-group">
                        <ul id="classesList" class="nav navbar-nav navbar-default">
                        <?php if($mode === 'Edit'){foreach ($class as $row1){ ?>
                            <li><a><i class="fa fa-check-square"></i><?php echo $row1['class_number'], ' ',$row1['class_name'],' ',$row1['class_section'], ' ', $row1['last_name']; ?></a></li>
                        <?php }} ?>
                        </ul>
                    </div>
                    <div class="form-group">
                        <a href="#" role="button" class="btn btn-common uppercase">Save Event</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!--/#event-information-->
    <br />
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
            $(function () {
                $('#startTimePicker').datetimepicker({
                    format: 'LT'
                });
                $('#endTimePicker').datetimepicker({
                    format: 'LT'
                });
                $('#datePicker').datetimepicker({
                    format: 'LL'
                });
            });
    </script>
<?php
    require '../view/footerInclude.php';
?>