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
<style>
    .toggleDiv { display: none; }
</style>
    <!--/#action-->
    <section id="portfolio-information" class="padding-top" >
        <div class="container" id='body'>
            <div class="row">
              <!--  <div id ='gmap' class="col-sm-6" style="background-color: #DDD">Insert map here? Maybe allow a picture to be uploaded? If not, it's cool.</div>
                --><div class="col-sm-12">
                    <div class="project-info">
                        <div class="form-group col-sm-4">
                            <h2>Event Name</h2>
                            <input type="text" class="form-control" id="eventName" value="<?php if($mode === 'Edit'){echo $EventName;} ?>"/>
                            <div class='form-group'>
                            <h2>Event Location</h2>
                            <select id='venue' class="form-control">
                                <option selected disabled>Select The Venue</option>
                                <?php foreach ($venue as $row){ ?><option <?php if($VenueID == $row['id']){ ?> selected <?php } ?>value='<?php echo $row['id'];?>'><?php echo $row['building_name'], ' ',$row['room_number']; ?></option>
                        <?php }?>
                            </select>
                            </div>
                            <div id='eventIdCheck' style='visibility: hidden;'> <?php echo $EventID; ?> </div>
                        </div>
                        <div class="col-sm-4">
                            <h2>Event Description</h2>
                            <textarea class="form-control" rows="6" id="eventDescription"><?php if($mode === 'Edit'){echo $EventDescription;} ?></textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <h2>Time and Date</h2>
                            <div class="col-sm-4">
                                <h3>Date</h3>
                                <div class='input-group date' id='datePicker'>
                                    <input type='text' class="form-control" id="eventDate" value="<?php if($mode === 'Edit'){echo toReadableDate($EventDate);} ?>"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
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
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <h2>Eligible Classes:</h2>
                        <br/>  
                           <div class="row">
                               <!-- Print OUT ALl Possible Classes in System -->
                            <div class="col-md-5">
                              <label for="multiselect">Usable Classes</label>
                              <select name="from" id="multiselect" class="form-control" style='height: 300px;' multiple="multiple">
                                   <?php foreach ($allClasses as $row1){ ?><option value='<?php echo $row1['class_number']. "/" .$row1['class_section']. "/" .$row1['class_name']. "/" .$row1['id']; ?>'><?php echo $row1['class_number'], ' ',$row1['class_section'], ' ', $row1['name']; ?></option>
                                                          <?php }?>
                              </select>
                            </div>
                            <div class="col-md-2">
                              <label></label>
                              <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                              <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                              <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                              <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                            </div>
                               <!-- If in Edit mode show what we have deemed as eligible -->
                            <div class="col-md-5">
                              <label for="multiselect-to">Classes For the Event</label>
                              <select name="to" id="multiselect_to" class="form-control" style='height: 300px;'size="9" multiple="multiple">
                                  <?php if($mode === 'Edit'){ 
                                   foreach ($class as $row1){ ?><option value='<?php echo $row1['class_number']. "/" .$row1['class_section']. "/" .$row1['class_name']. "/" .$row1['id']; ?>'><?php echo $row1['class_number'], ' ',$row1['class_section'], ' ', $row1['name']; ?></option>
                                  <?php }   }            
                                  ?>
                              </select>
                            </div>
                        </div>     
                    </div>
                </div>
                <div class="col-sm-12">
                        <div class="form-inline">
                            <h2>Add Classes:</h2>
                            <label for="newClassName">Class Name:</label>
                            <input type="text" class="form-control" id="newClassName" value="" placeholder="Intro to Business" required></input>
                            <label for="newClassNumber">Class Number:</label>
                            <input type="text" class="form-control" id="newClassNumber" value="" pattern="[A-Za-z]{1,6}+[0-9]{2,3}" placeholder="BUS100" required></input>
                            <label for="newClassSection">Class Section:</label>
                            <input type="text" class="form-control" id="newClassSection" value="" pattern="[A-Za-z]{1,5}+[0-9]{2,3}" placeholder="C01" required></input><br />
                            <label for="newClassInstructor">Class Instructor:</label>
                            <input type="text" class="form-control" id="newClassInstructor" value="" placeholder="Paul Woodburne" required></input>
                            <label for="newInstructorEmail">Instructor Email:</label>
                            <input type="email" class="form-control" id="newInstructorEmail" value="" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" placeholder="pwoodburne@clarion.edu" required></input>
                        </div>
                </div>
                    <br/>
                    <a href="#newClassName" role="button" class="btn btn-common uppercase" onclick="addAnotherClass()">Add Class</a>                    
                    <br /><br />
                     <div class="form-group col-sm-12">
                        <h3>Manually Added Classes:</h3>
                        <div id="newClasses" class="col-sm-6">
                            
                        </div>
                    </div>
                    
                    <div class="form-group col-sm-12">
                        <!-- Thinking of doing an AJAX array like we do for eligible classes to push to the DB -->
<!--                        <a href="#" role="button" class="btn btn-common uppercase">Save Event</a>-->
<!--                        <button role="button" class="btn btn-common uppercase" onclick='createNewEvent();'>Save Event</button>-->
                        <button role="button" class="btn btn-common uppercase" onclick='createNewEvent();'>Save Event</button>
                        <?php if(userIsAuthorized('AddEvent') && $mode ==='Edit') { ?>
                        <button role="button" class="btn btn-common uppercase" onclick="deleteEvent();">Delete Event</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!--/#event-information-->
    <br />
    <!-- Write in some JS to add more class dropdowns for an event -->
    <script>
    
    var selectedClasses = [];   
    var eventInfo =[];
    
    $( document ).ready(function() {
    $('#multiselect').multiselect();
});
  
    //Function to create the array we need to post to the database
        // Table Will Need:
            // class_number, class_section, class_name, instructor_id(use name for now), event_id(wont be created yet)
     function addClassList(){
            selectedClasses = [];
            $("#multiselect_to option").prop('selected', true);
            var valueString;  
           
            $("#multiselect_to").each(function(){
                valueString = ($(this).val());
                console.log(valueString);
                if(valueString  !== null){
                for(i=0; i<valueString.length; i++){
                   tempRes=valueString[i].split("/");
                    res={class_number: tempRes[0], class_section: tempRes[1],class_name: tempRes[2], instructor_id: tempRes[3] };
                    selectedClasses.push(res);
                }
            }
            });
            return selectedClasses;
         }
         
     function createEventData(){
         var eventName = $('#eventName').val();
         var venue = $('#venue').val();
         var eventDesc = $('#eventDescription').val();
         var date = $('#eventDate').val();
         var startTime = $('#eventStartTime').val();
         var endTime = $('#eventEndTime').val();
         eventInfo = {name: eventName, venue: venue, description: eventDesc, eventDate: date, start: startTime, end: endTime}; 
         return eventInfo;
     } 
     
     function createNewEvent(){
        var eventIdCheck = $('#eventIdCheck').html();
        console.log(eventIdCheck);
        var classList = JSON.stringify(addClassList());
            console.log(classList);
        var eventDetails = JSON.stringify(createEventData());
            console.log(eventDetails);
        var classesToAdd = JSON.stringify(createNewClassesArray());
            console.log(classesToAdd);
         $.post('../model/addEventAjax.php',{'eventId': eventIdCheck, 'classList': classList, 'eventDetails': eventDetails, 'classesToAdd':classesToAdd},function(response){ 
             var event = response;
             var venue = $('#venue').val();
             window.location.assign("../controller/controller.php?action=EventDetails&EventID="+event+"&VenueID="+venue+"");
            });      
    }
    function deleteEvent(){
          var eventId = $('#eventId').html();
          //console.log(event);
          $.post('../model/deleteSingleEventAjax.php',{'event':eventId},function(response){ 
                    console.log(response);
                    window.location.assign("../controller/controller.php?action=Home");
                });
          
      } 
    </script>
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
            
        var addClassCounter = 0;
        var newClassesForDB = [];
        function addAnotherClass(){
            var addClassName = $("#newClassName").val();
            var addClassNumber = $("#newClassNumber").val();
            var addClassSection = $("#newClassSection").val();
            var addClassInstructor = $("#newClassInstructor").val();
            var addInstructorEmail = $("#newInstructorEmail").val();    
            if(addClassName != "" && addClassNumber !="" && addClassInstructor != "" && addInstructorEmail != ""){
			//increment the class counter
			addClassCounter++;
			
			//create a new div element node and populate it with the necessary values
			var divNode = document.createElement("div");
			
			//set up data attributes so we can pull those later to store in DB
			divNode.id = "addClass" + addClassCounter;
			divNode.setAttribute("data-class_number", addClassNumber);
 			divNode.setAttribute("data-class_section", addClassSection);
			divNode.setAttribute("data-class_name", addClassName);
			divNode.setAttribute("data-addClassInstructor", addClassInstructor);
			divNode.setAttribute("data-addInstructorEmail", addInstructorEmail);
			divNode.appendChild(document.createTextNode(addClassNumber + " " + addClassSection + " " + addClassInstructor));
//		s	
			//set up an edit button to change any discrepancies with classes
			var editBtn = document.createElement("a");
			editBtn.setAttribute("href", "#"+divNode.id);
			editBtn.setAttribute("onclick", "editClass(" + divNode.id + "); return false");
			editBtn.appendChild(document.createTextNode(" Edit Class"));
			divNode.appendChild(editBtn);
                        
                        divNode.appendChild(document.createTextNode(" | "));
			
			//set up a remove button to quickly remove eligible classes
			var rmvBtn = document.createElement("a");
			rmvBtn.setAttribute("href", "#newClassName");
			rmvBtn.setAttribute("onclick", "removeClass(" + divNode.id + ")");
			rmvBtn.appendChild(document.createTextNode("Remove Class"));
			divNode.appendChild(rmvBtn);
			
			//make the div real
			document.getElementById("newClasses").appendChild(divNode);
                    }
                    else{
                        var alertString = "Please amend the following:\n";
                        if(addClassName == "")
                            alertString += "Add a Class Name\n";
                        if(addClassNumber =="")
                            alertString += "Add a Class Number\n";
                        if(addClassInstructor == "")
                            alertString += "Add an Instructor\n";
                        if(addInstructorEmail == "")
                            alertString += "Add an Instructor Email";
                        alert(alertString);
                        window.location.hash = '#newClassName';
                    }
        }
		
		//removes a given DOM element using jquery
		function removeClass(id){
			$(id).remove();
		}
		
		//Called to set up the ability to edit the values of an eligible class
		function editClass(id){
			var tempIdNum = parseInt(($(id).attr("id")).match(/(\d+)$/)[0], 10); //Currently limits add to only 9 classes (>9 BREAKS)
			var tempClassName = $(id).data("class_name");
			var tempClassNumber = $(id).data("class_number");
			var tempClassSection = $(id).data("class_section");
			var tempClassInstructor = $(id).data("addclassinstructor");
			var tempInstructorEmail = $(id).data("addinstructoremail");
			$(id).html('<input id="' +"editClassName"+tempIdNum+ '" type="text" class="form-control" value="'+tempClassName+'"></input>'
			+ '<input id="' +"editClassNumber"+tempIdNum+ '" type="text" class="form-control" value="'+tempClassNumber+'"></input>' 
			+ '<input id="' +"editClassSection"+tempIdNum+ '" type="text" class="form-control" value="'+tempClassSection+'"></input>' 
			+ '<input id="' +"editClassInstructor"+tempIdNum+ '" type="text" class="form-control" value="'+tempClassInstructor+'"></input>' 
			+ '<input id="' +"editInstructorEmail"+tempIdNum+ '" type="text" class="form-control" value="'+tempInstructorEmail+'"></input>' 
			+ '<a href="#'+$(id).attr("id")+'" class="btn btn-common uppercase" role="button" onclick="saveChanges('+$(id).attr('id')+'); return false">Save Changes</a>'
			+ '<a href="#'+$(id).attr("id")+'" class="btn btn-common uppercase" role="button" onclick="removeClass('+$(id).attr('id')+'); return false">Remove Class</a><br />');
		}
		
		//saves changes made when editing a class
		function saveChanges(id){
			var tempIdNum = parseInt(($(id).attr("id")).match(/(\d+)$/)[0], 10);
			//var tempIdNum = $(id).attr("id").slice(-1);
			var tempClassName = $("#editClassName"+tempIdNum).val();
			var tempClassNumber = $("#editClassNumber"+tempIdNum).val();
			var tempClassSection = $("#editClassSection"+tempIdNum).val();
			var tempClassInstructor = $("#editClassInstructor"+tempIdNum).val();
			var tempInstructorEmail = $("#editInstructorEmail"+tempIdNum).val();
			
			$(id).attr("data-class_name", tempClassName);
			$(id).attr("data-class_number", tempClassNumber);
			$(id).attr("data-class_section", tempClassSection);
			$(id).attr("data-addclassinstructor", tempClassInstructor);
			$(id).attr("data-addinstructoremail", tempInstructorEmail);
                        $(id).attr("value", tempClassName + "/" + tempClassNumber + "/" + tempClassSection + "/" + tempClassInstructor + "/" + tempInstructorEmail);
			
			$(id).html(tempClassNumber + " " + tempClassSection + " " + tempClassInstructor 
			+ '<a onclick="editClass(' + $(id).attr("id") + '); return false" href="#'+$(id).attr("id")+'"> Edit Class</a> | '
			+ '<a onclick="removeClass(' + $(id).attr("id") + '); return false" href="#'+$(id).attr("id")+'">Remove Class</a> <br />');			
		}
                
                
                function createNewClassesArray(){
                    var idCounter;
                    for(var i = 1; i <= addClassCounter; i++){
                        idCounter = "#addClass" + i;
                        tempRes = $(idCounter).data();
                        //console.log(tempRes);
                        newClassesForDB.push(tempRes);
                }
               // console.log(JSON.stringify(newClassesForDB));
                return newClassesForDB;
            } 
   </script>
<?php
    require '../view/footerInclude.php';
?>