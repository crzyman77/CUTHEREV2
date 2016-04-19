<?php
require_once '../model/model.php';
   error_reporting(0); // Needed put in for LocalHost

$selectedClass = stipslashes($_POST['classList']);
//class_number: tempRes[0], class_section: tempRes[1], event_id: eventId
$headers = array('Student Email');

//USE FOR EACH TO GET THE DATA AND CREATE A FILE FOR THE CLASS
foreach($selectedClass as $class){
    $classNum =$class[class_number];
    $classSec =$class[class_section];
    $classInfo = $classNum.$classSec;
    $event = $class[event_id];
    //Select all results from the DB
    // Generate the CSV
        //Email or Download?
    // Email to professor? or to hartley?
    
    //Fetch my Data
    $result = getStudentClassList($classNum,$classSec,$event);
    print_r(json_encode($result));

}
    

