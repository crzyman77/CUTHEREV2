
<?php
     if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

  require_once('../model/oauth.php');
  $auth_code = $_GET['code'];
  $redirectUri = 'http://localhost/CuThereV2/model/authorize.php';

  $tokens = oAuthService::getTokenFromAuthCode($auth_code, $redirectUri);
print_r($tokens);
    if ($tokens['access_token']) {
    $_SESSION['access_token'] = $tokens['access_token'];
    // Get the user's email from the ID token
	$user_email =oAuthService::getUserEmailFromIdToken($tokens['id_token']);
	$_SESSION['user_email'] = $user_email;
       

    // Redirect back to home page
    header("Location: http://localhost/CuThereV2/controller/controller.php?action=ListEvents");
  }
  else
  {
    echo "<p>ERROR: ".$tokens['error']."</p>";
  }
?>
