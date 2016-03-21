<?php
  
    $title = "Check-In Results";
    require '../view/headerInclude.php';
    require_once '../model/model.php';
    
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
                        <h1> You Were: <?php echo $isWithinPolygon; ?></h1>
                        <h2> <?php echo $studentLocation ?> </h2>
                        
                        <?php checkInTesting($username,$email,$studentLocation , $isWithinPolygon); ?>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
    </section>
     <!--/#event-information-->
        <br />
<?php
    require '../view/footerInclude.php';
?>
