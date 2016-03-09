<?php
   //$title = "RedirectPage";
    //require '../view/headerInclude.php';
/**
 *  Copyright (c) Microsoft. All rights reserved. Licensed under the MIT license.
 *  See LICENSE in the project root for license information.
 * 
 *  PHP version 5
 *
 *  @category Code_Sample
 *  @package  O365-PHP-Microsoft-Graph-Connect
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://GitHub.com/OfficeDev/O365-PHP-Microsoft-Graph-Connect
 */
 
/*! 
    @abstract User is directed to this page after the web app gets tokens.
              The page offers UI to send a welcome email to the specified account. 
 */

namespace Microsoft\Office365\UnifiedAPI\Connect;

//We store user name, id, and tokens in session variables
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//require_once '../model/MailManager.php';

// Use the given name if it exists, otherwise, use the alias
$greetingName = isset($_SESSION['given_name'])
                    ? $_SESSION['given_name'] 
                    : explode('@', $_SESSION['unique_name'])[0]
                + isset($_SESSION['family_name'])
                    ? $_SESSION['family_name']
                    : " ";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>O365 Connect sample</title>

  <!-- Third party dependencies. -->
  <link 
      rel="stylesheet" 
      href="https://appsforoffice.microsoft.com/fabric/1.0/fabric.css">
  <link 
      rel="stylesheet" 
      href="https://appsforoffice.microsoft.com/fabric/1.0/fabric.components.css">
  
  <!-- App code. -->
  <link rel="stylesheet" href="styles.css">
  
</head>

<body class="ms-Grid">
    <div class="ms-Grid-row">
    <!-- App navigation bar markup. -->
    <div class="ms-NavBar">
    <ul class="ms-NavBar-items">
        <li class="navbar-header">Office 365 Connect sample</li>
        <li 
            class="ms-NavBar-item ms-NavBar-item--right" 
            onclick="window.location.href='../model/disconnect.php'">
            <i class="ms-Icon ms-Icon--x"></i> Disconnect
        </li>
    </ul>
    </div>

    <!-- App main content markup. -->
    <form action="" method="post">
    <div class="ms-Grid-col ms-u-mdPush1 ms-u-md9 ms-u-lgPush1 ms-u-lg6">
    <div>
        <h2 class="ms-font-xxl ms-fontWeight-semibold">
            Hi, <?php echo $greetingName; ?>!
        </h2>
        <p class="ms-font-xl">
            You're now connected to Office 365. Click the button below to send a 
            message from your account using the Microsoft Graph.
            <br/>
            <br/>
            <?php echo $_SESSION['unique_name']; ?>
        </p>
            
    </div>
    </div>
    </form>
</div>
</body>

</html>


