
<?php
    $title = "Generate Reports";
    require '../view/headerInclude.php';
    require_once '../model/model.php';
    
?>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Generate Class List Reports</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#action-->

    <section id="shortcodes">
        <div class="container">
    <div class="form-group">
         <?php $event = getPastEventList();?>   
         <select id='event' class="form-control">
                          <option selected disabled>Select The Event</option>
                         <?php foreach ($event as $row){ ?>
                            <option value='<?php echo $row['id'];?>'><?php echo $row['name'], ' ',toReadableDate($row['event_date']); ?></option>
                        <?php }?>
                            </select>    
            <button role="button" class="btn btn-common uppercase" onclick='submitEvent()'>Submit Event</button>
                  </div>
            
            <div id ="classesForReports">
                <h3 id='details' style='visibility:hidden;'> Select Which Classes You Would Like to generate Class Lists For. By clicking the 
                generate reports button, you will send the attendance list for each of the classes to the designated professor for their usage.</h3>
                <ul id="classes" class="nav navbar-nav navbar-default">
                    
                </ul>
            <button role="button" class="btn btn-common uppercase" onclick='getSelectedClasses()'>Download Class Attendance List</button>

            </div>
            
            <script>
                var eventId;
                var classCounter;
                var classItem;  
                var selectedClasses = [];
                //Get the eligilbe classes from the DB based on the eventId, uses ASYNCH Ajax Call
                function submitEvent(){
                    $('#classes').empty();
                     eventId = ($('#event').val());
                   //var trHtml;
                   var liHtml = " ";
                    $.post('../model/getEligibleClassesAjax.php',{'eventId': eventId},function(response){ 
                        var event =$.parseJSON(response);    
                   $.each(event, function(i,item) {
                       liHtml += '<li><label class="btn btn-common"><input type ="checkbox" value="'+item.class_number + '/' + item.class_section + '/' + item.name + '"></input>' + item.class_name + " " + item.class_number + " " + item.class_section + " " + item.name + '</label></li>';
                  });
                    $('#details').css("visibility","visible");
                    $('#classes').append(liHtml);
                    });
                }   
                // Loops through all selected CheckBoxes and creates a CSV based on the students who had checked in for the event
                // Uses a SYNCHED AJAX call to pull each checkBoxes data one at a time, and atuo downloads the file on creation
                // Uses the Class_Number and Class_Section as the file Name
                function getSelectedClasses(){
                    selectedClasses = [];
                    classCounter = 0;
                    var valueString;
                    
                    $("input:checkbox:checked").each(function(){
                        selectedClasses=[];
                        res='';
                        valueString = ($(this).val());
                        tempRes = valueString.split("/"); // Changed split to '/' due to spaces in instructor names
                        var classInfo = tempRes[0] + tempRes[1];
                        var instructor = tempRes[2];
                        res = {class_number: tempRes[0], class_section: tempRes[1], event_id: eventId };
                        selectedClasses.push(res);
                        $.ajax({
                                type: 'POST',
                                url: '../model/generateReportAjax.php',
                                data: {'classList' : selectedClasses},
                                success: function(response){ 
                            console.log(response);
                            var data = '';
                            data = $.parseJSON(response);
                            // download stuff
                            var fileName = classInfo; 
                            var saveData = (function () {
                                    var a = document.createElement("a");
                                    document.body.appendChild(a);
                                    a.style = "display: none";
                                    return function (data, fileName) {
                                        var csvData = new Array();
                                        csvData.push('"Instructor: ' + instructor + '"' );
                                        csvData.push('"Student Emails: "');
                                        data.forEach(function(item, index, array) {
                                          csvData.push('"' + item.student_email + '"');
                                        });
                                        var buffer = csvData.join("\n");
                                        var blob = new Blob([buffer], {
                                          "type": "text/csv;charset=utf8;"			
                                        });
                                        var url = window.URL.createObjectURL(blob);
                                        a.href = url;
                                        a.download = fileName;
                                        a.click();
                                        window.URL.revokeObjectURL(url);
                                    };
                                }());
                              saveData(data, fileName); 
                       },
                                async:false
                              });
                    });
                }   
            </script>

            

            <div class="padding"></div>
      
        </div>
    </section> 

<?php
    require '../view/footerInclude.php';
?>