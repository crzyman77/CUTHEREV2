<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    $title = "Home";
    require '../view/headerInclude.php';
    //require_once('../model/oauth.php');
  //  $loggedIn = !is_null( $_SESSION['access_token']);

//     $redirectUri = 'http://localhost/CuThereV2/model/authorize.php';//'https://www.cegillis.com/CuThere/model/authorize.php'; //https://cisprod.clarion.edu/~s_cgillis/model/authorize.php';

?>
    
   

    <section id="action" class="responsive">
        
       <a class='btn-lg btn' href="<?php echo oAuthService::getLoginUrl($redirectUri)?>">Log IN </a>  
    
        
   </section>
    <!--/#action-->

    
    
<?php
    require '../view/footerInclude.php';
?>