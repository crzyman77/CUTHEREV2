<?php



 
/** 
 *  Stores constant and configuration values used through the app 
 *
 *  @class    Constants
 *  @category Code_Sample
 *  @package  O365-PHP-Microsoft-Graph-Connect
 *  @author   Ricardo Loo <ricardol@microsoft.com>
 *  @license  MIT License
 *  @link     http://GitHub.com/OfficeDev/O365-PHP-Microsoft-Graph-Connect
 */
class Constants
{
    const CLIENT_ID = 'd3e580d2-bf47-4d62-89d1-f0b30f60264f'; //d3e580d2-bf47-4d62-89d1-f0b30f60264f
    const CLIENT_SECRET ='o4qhzGir0CAuUkikB2Wri76fRm28BwWDXJavDnJj8As='; //o4qhzGir0CAuUkikB2Wri76fRm28BwWDXJavDnJj8As=
    const REDIRECT_URI = 'http://localhost/CuThereV2/model/callback.php';
    const AUTHORITY_URL = 'https://login.microsoftonline.com/common';
    const AUTHORIZE_ENDPOINT = '/oauth2/authorize';
    const TOKEN_ENDPOINT = '/oauth2/token';
    const LOGOUT_ENDPOINT = '/oauth2/logout';
    const RESOURCE_ID = 'https://graph.microsoft.com';
    //const SENDMAIL_ENDPOINT = '/v1.0/me/microsoft.graph.sendmail';
}
?>