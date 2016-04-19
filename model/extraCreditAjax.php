<?php
require_once '../model/model.php';
  // error_reporting(0); // Needed put in for LocalHost

$selectedClassArray = json_decode(stripslashes($_POST['class']),true);
//class_number: tempRes[0], class_section: tempRes[1], instructor_id: tempRes[2], event_id: event, student_email: email
print_r($selectedClassArray);
foreach ($selectedClassArray as $class){
   // print_r($class);
    $classNum =$class[class_number];
    print_r($classNum);
    $classSec =$class[class_section];
    print_r($classSec);
    $instId =$class[instructor_id];
    print_r($instId);
    $eventId =$class[event_id];
    print_r($eventId);
    $email = $class[student_email];
    print_r($email);
   $result = addToClassList($classNum, $classSec, $instId, $eventId, $email);
   print_r($result);
   
}
?>