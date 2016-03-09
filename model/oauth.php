<?php
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class oAuthService {
    private static $clientId = "b735ce00-ddac-4325-9e7e-3ea99e59e999"; //b735ce00-ddac-4325-9e7e-3ea99e59e999
    private static $clientSecret = "Ekjf4poV1NJrgrbm3ZHM9mt"; //Ekjf4poV1NJrgrbm3ZHM9mt
    private static $authority = "https://login.microsoftonline.com";
    private static $authorizeUrl = '/common/oauth2/v2.0/authorize?client_id=%1$s&redirect_uri=%2$s&response_type=code&scope=%3$s';
    private static $tokenUrl = "/common/oauth2/v2.0/token";
    
    // The app only needs openid (for user's ID info), and Mail.Read
    private static $scopes = array("openid",
                                   "email",
                                   "profile", 
                                   "https://outlook.office.com/mail.read",
                                   "https://outlook.office.com/calendars.read",
                                   "https://outlook.office.com/contacts.read");
    
    public static function getLoginUrl($redirectUri) {
      // Build scope string. Multiple scopes are separated
      // by a space
      $scopestr = implode(" ", self::$scopes);
      
      $loginUrl = self::$authority.sprintf(self::$authorizeUrl, self::$clientId, urlencode($redirectUri), urlencode($scopestr));
      
      error_log("Generated login URL: ".$loginUrl);
      return $loginUrl;
    }
    // Use to hopefully logout and end the session
    public static function getLogoutUrl($redirectUri){
        // Build scope string. Multiple scopes are separated
      // by a space
      $scopestr = implode(" ", self::$scopes);
      
      $logoutUrl = self::$authority.sprintf(self::$authorizeUrl, self::$clientId, urlencode($redirectUri), urlencode($scopestr));
      session_destroy();
      error_log("Generated logout URL: ".$logoutUrl);
      return $logoutUrl;
    }
    
    public static function getTokenFromAuthCode($authCode, $redirectUri) {
      // Build the form data to post to the OAuth2 token endpoint
      $token_request_data = array(
        "grant_type" => "authorization_code",
        "code" => $authCode,
        "redirect_uri" => $redirectUri,
        "scope" => implode(" ", self::$scopes),
        "client_id" => self::$clientId,
        "client_secret" => self::$clientSecret
      );
      
      // Calling http_build_query is important to get the data
      // formatted as expected.
      $token_request_body = http_build_query($token_request_data);
      error_log("Request body: ".$token_request_body);
      
      $curl = curl_init(self::$authority.self::$tokenUrl);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //Need to delete if we are running https
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $token_request_body);
      
      $response = curl_exec($curl);
      error_log("curl_exec done.");
      
      $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      error_log("Request returned status ".$httpCode);
      if ($httpCode >= 400) {
        return array('errorNumber' => $httpCode,
                     'error' => 'Token request returned HTTP error '.$httpCode);
      }
      
      // Check error
      $curl_errno = curl_errno($curl);
      $curl_err = curl_error($curl);
      if ($curl_errno) {
        $msg = $curl_errno.": ".$curl_err;
        error_log("CURL returned an error: ".$msg);
        return array('errorNumber' => $curl_errno,
                     'error' => $msg);
      }
      
      curl_close($curl);
      
      // The response is a JSON payload, so decode it into
      // an array.
      $json_vals = json_decode($response, true);
      error_log("TOKEN RESPONSE:");
      foreach ($json_vals as $key=>$value) {
        error_log("  ".$key.": ".$value);
      }
      
      return $json_vals;
    }
    
    public static function getUserEmailFromIdToken($idToken) {
      error_log("ID TOKEN: ".$idToken);
    
      // JWT is made of three parts, separated by a '.' 
      // First part is the header 
      // Second part is the token 
      // Third part is the signature 
      $token_parts = explode(".", $idToken);
      //$_SESSION['token_parts'] = $token_parts;
      // We care about the token
      // URL decode first
      $token = strtr($token_parts[1], "-_", "+/");
      // Then base64 decode
      $jwt = base64_decode($token);
      $_SESSION['jwt'] = $jwt;
      // Finally parse it as JSON
      $json_token = json_decode($jwt, true);
      //$_SESSION['json_token'] = $json_token;
     // print_r($json_token);
      return $json_token['preferred_username'];
    }
    public static function getUserNameFromIdToken($idToken) {
      error_log("ID TOKEN: ".$idToken);
    
      // JWT is made of three parts, separated by a '.' 
      // First part is the header 
      // Second part is the token 
      // Third part is the signature 
      $token_parts = explode(".", $idToken);
      //$_SESSION['token_parts'] = $token_parts;
      // We care about the token
      // URL decode first
      $token = strtr($token_parts[1], "-_", "+/");
      // Then base64 decode
      $jwt = base64_decode($token);
      $_SESSION['jwt'] = $jwt;
      // Finally parse it as JSON
      $json_token = json_decode($jwt, true);
      //$_SESSION['json_token'] = $json_token;
     // print_r($json_token);
      return $json_token['name'];
    }
    
    
  }
?>
    
