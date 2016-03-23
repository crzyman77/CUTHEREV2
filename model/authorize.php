<?php
      if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  require_once('../model/oauth.php');
  $auth_code = $_GET['code'];
  $redirectUri = 'http://localhost/CuThereV2/model/authorize.php';//'https://www.cegillis.com/CuThere/model/authorize.php';
  
  $tokens = oAuthService::getTokenFromAuthCode($auth_code, $redirectUri);
    if ($tokens['access_token']) {
        $_SESSION['access_token'] = $tokens['access_token'];
    // Get the user's email from the ID token
        $_SESSION['id_token'] = $tokens['id_token'];
	$user_email =oAuthService::getUserEmailFromIdToken($tokens['id_token']);
        $user_name= oAuthService::getUserNameFromIdToken($tokens['id_token']);
	$_SESSION['preferred_username'] = $user_email;
        $_SESSION['user_name'] = $user_name;
       
    // Redirect back to home page
    header("Location: http://localhost/CuThereV2/controller/controller.php?action=ListEvents");//("Location: https://www.cegillis.com/CuThere/controller/controller.php?action=ListEvents");
  }

  
?>

