 <?php
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    $title = "Database Tests";
    require '../view/headerInclude.php';  
 ?>
<div id="body">
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Test Case 1 </h1>
                            <div>
                         <?php 
                          $result = checkIfStudentExsists('c.gillis@eagle.clarionedu');
                          $notRight = 'Something Else';
                          if($result == ''){
                          print_r($result);
                          print_r('FOUND IT');
                          }
                          else{
                              print_r($notRight);
                          }
                              ?>
                            </div>
                     </div>
                </div>
         
                 
            </div>
        </div>
   </section>
    <section id="services">
            <div>

                <p id="test"></p>
             <!-- <button onclick="myFunction()">Try it</button> -->
              <button onclick="locationCheck()">Get Location</button>
              

            </div>
        </section>
    
</div>
    <!--/#services-->

    

<?php
    require '../view/footerInclude.php';
?>