
<?php
    $title = "Remove Data";
    require '../view/headerInclude.php';
    require_once '../model/model.php';
    
?>
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Delete Data From Tables</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#action-->

    <section id="shortcodes">
        <div class="container">
  
           Use this page at the end of each year or semester to clean out previous data within the tables of the database. 
           <br/>
           <button role="button" class="btn btn-common uppercase" onclick='deleteEvent();'> Delete Events </button>
           
           <button role="button" class="btn btn-common uppercase" onclick='deleteClass();'> Delete Classes and Instructors </button>
           
           <button role="button" class="btn btn-common uppercase" onclick='deleteExtraCredit();'> Delete Extra-Credit-List </button>
           <br/>
           <button role="button" class="btn btn-common uppercase" onclick='deleteAll();'> Clear All Tables </button>

            <div class="padding"></div>
      
        </div>
    </section> 
    <script>
        var counter = 0;
        function deleteEvent(){
            counter = 1;
            $.post('../model/cleanTablesAjax.php',{'countValue': counter},function(response){ 
             console.log(response);
             alert('You' + response + 'removed the data from the database');
         });
        }
        function deleteClass(){
            counter = 2;
            $.post('../model/cleanTablesAjax.php',{'countValue': counter},function(response){ 
             console.log(response);
             alert('You' + response + 'removed the data from the database');
            
         });
        }
        function deleteExtraCredit(){
            counter = 3;
            $.post('../model/cleanTablesAjax.php',{'countValue': counter},function(response){ 
             console.log(response);
             alert('You' + response + 'removed the data from the database');
             
         });
        }
        function deleteAll(){
            counter = 4;
            $.post('../model/cleanTablesAjax.php',{'countValue': counter},function(response){ 
                console.log(response);
                alert('You' + response + 'removed the data from the database');
           });
        }
        
        
    </script>    
<?php
    require '../view/footerInclude.php';
?>

