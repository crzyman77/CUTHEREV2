<?php
require_once '../model/model.php';
$eventIdToDelete = $_POST['event'];
 print_r($eventIdToDelete);
 deleteEvent($eventIdToDelete);

