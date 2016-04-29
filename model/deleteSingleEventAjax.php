<?php
require_once '../model/model.php';

//error_reporting();
$eventIdToDelete = $_POST['event'];
 //print_r($eventIdToDelete);
 $return = deleteEvent($eventIdToDelete);
print_r($return);