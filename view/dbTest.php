 <?php
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    $title = "Database Tests";
    require '../view/headerInclude.php';
    
    require '../model/oauth.php';
    $loggedIn = false;
    
    $redirectUri = 'http://localhost/CuThereV2/model/authorize.php';
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
                                if (!$loggedIn) {
                              ?>
                                <!-- User not logged in, prompt for login -->
                                <p>Please <a href="<?php echo oAuthService::getLoginUrl($redirectUri)?>">sign in</a> with your Office 365 or Outlook.com account.</p>
                              <?php
                                 
                                }
                                else {
                              ?>
                              
                                <!-- User is logged in, do something here -->
                                <p> SCREW THIS PROJECT </p>
                               
                                <?php   
                                     $loggedIn = !is_null( $_SESSION['access_token']);
                                        //session_destroy(); ?>
                                
                                <a href="<?php echo oAuthService::getLoginUrl($redirectUri)?>">Log Out?</a>
                                
                              <?php    
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