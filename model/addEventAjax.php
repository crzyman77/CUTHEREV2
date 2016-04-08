<?php

require_once '../model/model.php';
require_once '../lib/basic_funcs.php';
// DONT FORGET WE NEED TO STRIPSLASHES ON CISPROD
$selectedClassArray = json_decode($_POST['classList'],true);
$eventDetailsArray = json_decode($_POST['eventDetails'],true);

//Set up vars for Event Table
$name = $eventDetailsArray[name];
$venue =$eventDetailsArray[venue];
$desc = $eventDetailsArray[description];
$date = toDateStore($eventDetailsArray[eventDate]); 
$start = toTimeStore($eventDetailsArray[start]);
$end = toTimeStore($eventDetailsArray[end]); 

//Make call out to insert into Database
$eventId = addNewEvent($name, $start, $end, $date, $desc, $venue);


//FOR EACH LOOP TO ADD EACH CLASS TO THE CLASS LIST TABLE
foreach ($selectedClassArray as $class){
    $classNum =$class[class_number];
    $classSec =$class[class_section];
    $className = $class[class_name];
    $instId =$class[instructor_id];
    $newEventId = $eventId;
    addNewEligibleClassesForEvent($classNum, $classSec,$className, $instId, $newEventId); 
}

?>