<?php
require_once '../model/model.php';
   error_reporting(0); // Needed put in for LocalHost

$selectedClassArray = json_decode(stripslashes($_POST['class']),true);
//class_number: tempRes[0], class_section: tempRes[1], instructor_id: tempRes[2], event_id: event, student_email: email
foreach ($selectedClassArray as $class){
   // print_r($class);
    $classNum =$class[class_number];
    $classSec =$class[class_section];
    $className = $class[class_name];
    $instId =$class[instructor_id];
    $eventId =$class[event_id];
    $email = $class[student_email];
    addToClassList($classNum, $classSec,$className, $instId, $eventId, $email);
}
?>