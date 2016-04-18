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
                <table id='classes' class="table table-hover table-bordered table-responsive">
                    <thead>
                        <th>Class Name </th>
                        <th>Class Number</th>
                        <th>Instructor</th>
                        <th>Generate Report</th>
                    </thead> 
                    
                </table>
                
            </div>
            
            
            
            
            
            <script>
                function submitEvent(){
                    var eventId = ($('#event').val());
                    var trHtml;
                $.post('../model/getEligibleClassesAjax.php',{'eventId': eventId},function(response){ 
                    var event =$.parseJSON(response);    
                    console.log(event);
                    //console.log(JSON.stringify(event));
               $.each(event, function(item) {
                    trHtml+='<tr><td>' + item.class_name + '</td><td>' + item.class_number + ' ' + item.class_section + '</td><td>' + item.name + '</td></tr>';
                });
                $('#classes').append(trHtml);
                });
            }
                
                
            </script>

            

            <div class="padding"></div>
      
        </div>
    </section> 

<?php
    require '../view/footerInclude.php';
?>