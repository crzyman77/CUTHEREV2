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
    <section id="portfolio-information" class="padding-top">
        <div class="container" id='body'>
            <div class="row">
              <!--  <div id ='gmap' class="col-sm-6" style="background-color: #DDD">Insert map here? Maybe allow a picture to be uploaded? If not, it's cool.</div>
                --><div class="col-sm-6">
                    <div class="project-info">
                        <div class="form-group">
                            <h2>Event Name</h2>
                            <input type="text" class="form-control" id="eventName" value="<?php if($mode === 'Edit'){echo $EventName;} ?>"/>
                            <div class='form-group'>
                            <h2>Event Location</h2>
                            <select id='venue' class="form-control">
                                <?php foreach ($venue as $row){ ?><option value='<?php echo $row['id'];?>'><?php echo $row['building_name'], ' ',$row['room_number']; ?></option>
                        <?php }?>
                            </select>
                            </div>
<!--                            <h3>Building</h3>
                            <input type="text" class="form-control" id="eventBuilding" value="<?php if($mode === 'Edit'){echo $EventBuilding;} ?>"/>
                            <h3>Room</h3>
                            <input type="text" class="form-control" id="eventRoom" value="<?php if($mode === 'Edit'){echo $EventRoom;} ?>"/>-->
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
                        <br/>  
                      
                       <select multiple id="classesList" class="form-control" style='height:300px;'>        
                             <?php foreach ($class as $row1){ ?><option value='<?php echo $row1['class_number']. "/" .$row1['class_section']. "/" .$row1['class_name']. "/" .$row1['id']; ?>'><?php echo $row1['class_number'], ' ',$row1['class_section'], ' ', $row1['name']; ?></option>
                                <?php }?></select>
                    </div>
                    <div class="form-inline">
                        <h2>Add Classes:</h2>
                        <label for="newClassName">Class Name:</label>
                        <input type="text" class="form-control" id="newClassName" placeholder="Intro to Porgamming"></input>
                        <label for="newClassNumber">Class Number:</label>
                        <input type="text" class="form-control" id="newClassNumber" placeholder="CIS110"></input>
                        <label for="newClassSection">Class Section:</label>
                        <input type="text" class="form-control" id="newClassSection" placeholder="C01"></input><br />
                        <label for="newClassInstructor">Class Instructor:</label>
                        <input type="text" class="form-control" id="newClassInstructor" placeholder="Jody Strausser"></input><br />
                        <label for="newInstructorEmail">Instructor Email:</label>
                        <input type="email" class="form-control" id="newInstructorEmail" placeholder="jstrausser@clarion.edu"></input>
                    </div>
                    <br/>
                    <a href="#newClassName" role="button" class="btn btn-common uppercase" onclick="addAnotherClass()">Add Class</a>                    
                    <br />
                    <div class="form-group">
                        <div id="newClasses">
                            <?php $addClassNumber=0; if($mode === 'Edit'){foreach ($class as $row1){ ?>
                            <div data-addinstructoremail="<?php echo $row1[id] /* This is the id until we decide if we need email or not */?>" data-addclassinstructor="<?php echo $row1[name] ?>" data-addclasssection="<?php echo $row1[class_section] ?>" data-addclassnumber="<?php echo $row1[class_number] ?>" data-addclassname="<?php echo $row1[class_name] ?>" id="addClass<?php echo $addClassNumber ?>">
                                <?php echo $row1[class_name] . " " . $row1[class_number] . " " . $row1[class_secton] . " " . $row1[name] ?>
                                <a onclick="editClass(<?php echo "addClass" . $addClassNumber ?>); return false" role="button" class="btn btn-common uppercase" href="#">Edit Class</a>
                                <a onclick="removeClass(<?php echo "addClass" . $addClassNumber ?>)" role="button" class="btn btn-common uppercase" href="#newClassName">Remove Class</a>
                            </div>
                        <?php $addClassNumber++;}} ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- Thinking of doing an AJAX array like we do for eligible classes to push to the DB -->
<!--                        <a href="#" role="button" class="btn btn-common uppercase">Save Event</a>-->
                        <button role="button" class="btn btn-common uppercase" onclick='createNewEvent();'>Save Event</button>
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
    
  
    //Function to create the array we need to post to the database
        // Table Will Need:
            // class_number, class_section, class_name, instructor_id(use name for now), event_id(wont be created yet)
     function addClassList(){
            selectedClasses = [];
            
            var valueString;  
            $("#classesList").each(function(){
                valueString = ($(this).val());
                console.log(valueString);
                //console.log(valueString.length); //Test ValueString
                for(i=0; i<valueString.length; i++){
                   tempRes=valueString[i].split("/");
                    console.log(tempRes); 
                    res={class_number: tempRes[0], class_section: tempRes[1],class_name: tempRes[2], instructor_id: tempRes[3] };
                    selectedClasses.push(res);
                }
                //console.log(JSON.stringify(selectedClasses));
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
        // eventInfo.push(result);
         console.log(JSON.stringify(eventInfo));  
         return eventInfo;
     } 
     
       function createNewEvent(){
        var classList = JSON.stringify(addClassList());
        var eventDetails = JSON.stringify(createEventData());
         $.post('../model/addEventAjax.php',{'classList': classList, 'eventDetails': eventDetails},function(response){ 
             console.log(response);
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
            
        var addClassCounter = <?php echo $addClassNumber ?>;
        function addAnotherClass(){
			//increment the class counter
			addClassCounter++;
			
			//create a new div element node and populate it with the necessary values
			var divNode = document.createElement("div");
			var addClassName = $("#newClassName").val();
			var addClassNumber = $("#newClassNumber").val();
			var addClassSection = $("#newClassSection").val();
			var addClassInstructor = $("#newClassInstructor").val();
			var addInstructorEmail = $("#newInstructorEmail").val();
			
			//set up data attributes so we can pull those later to store in DB
			divNode.id = "addClass" + addClassCounter;
			divNode.setAttribute("data-addClassName", addClassName);
			divNode.setAttribute("data-addClassNumber", addClassNumber);
			divNode.setAttribute("data-addClassSection", addClassSection);
			divNode.setAttribute("data-addClassInstructor", addClassInstructor);
			divNode.setAttribute("data-addInstructorEmail", addInstructorEmail);
			divNode.appendChild(document.createTextNode(addClassNumber + " " + addClassSection + " " + addClassInstructor));
			
			//set up an edit button to change any discrepancies with classes
			var editBtn = document.createElement("a");
			editBtn.setAttribute("href", "#"+divNode.id);
			editBtn.setAttribute("class", "btn btn-common uppercase");
			editBtn.setAttribute("role", "button");
			editBtn.setAttribute("onclick", "editClass(" + divNode.id + "); return false");
			editBtn.appendChild(document.createTextNode("Edit Class"));
			divNode.appendChild(editBtn);
			
			//set up a remove button to quickly remove eligible classes
			var rmvBtn = document.createElement("a");
			rmvBtn.setAttribute("href", "#newClassName");
			rmvBtn.setAttribute("class", "btn btn-common uppercase");
			rmvBtn.setAttribute("role", "button");
			rmvBtn.setAttribute("onclick", "removeClass(" + divNode.id + ")");
			rmvBtn.appendChild(document.createTextNode("Remove Class"));
			divNode.appendChild(rmvBtn);
			
			//make the div real
			document.getElementById("newClasses").appendChild(divNode);
        }
		
		//removes a given DOM element using jquery
		function removeClass(id){
			$(id).remove();
		}
		
		//Called to set up the ability to edit the values of an eligible class
		function editClass(id){
			var tempIdNum = parseInt(($(id).attr("id")).match(/(\d+)$/)[0], 10); //Currently limits add to only 9 classes (>9 BREAKS)
			var tempClassName = $(id).data("addclassname");
			var tempClassNumber = $(id).data("addclassnumber");
			var tempClassSection = $(id).data("addclasssection");
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
			
			$(id).attr("data-addclassname", tempClassName);
			$(id).attr("data-addclassnumber", tempClassNumber);
			$(id).attr("data-addclasssection", tempClassSection);
			$(id).attr("data-addclassinstructor", tempClassInstructor);
			$(id).attr("data-addinstructoremail", tempInstructorEmail);
                        $(id).attr("value", tempClassName + "/" + tempClassNumber + "/" + tempClassSection + "/" + tempClassInstructor + "/" + tempInstructorEmail);
			
			$(id).html(tempClassNumber + " " + tempClassSection + " " + tempClassInstructor 
			+ '<a onclick="editClass(' + $(id).attr("id") + '); return false" role="button" class="btn btn-common uppercase" href="#'+$(id).attr("id")+'">Edit Class</a>'
			+ '<a onclick="removeClass(' + $(id).attr("id") + '); return false" role="button" class="btn btn-common uppercase" href="#'+$(id).attr("id")+'">Remove Class</a> <br />');			
		}
    </script>
<?php
    require '../view/footerInclude.php';
?>