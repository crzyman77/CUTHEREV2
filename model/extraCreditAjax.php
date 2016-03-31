<?php
require_once '../model/model.php';

$selectedClassArray = json_decode(stripslashes($_POST['class']),true);
//class_number: tempRes[0], class_section: tempRes[1], instructor_id: tempRes[2], event_id: event, student_email: email
foreach ($selectedClassArray as $class){
   // print_r($class);
    $classNum =$class[class_number];
    $classSec =$class[class_section];
    $instId =$class[instructor_id];
    $eventId =$class[event_id];
    $email = $class[student_email];
    addToClassList($classNum, $classSec, $instId, $eventId, $email);
}
?>