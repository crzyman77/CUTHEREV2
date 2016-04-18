<?php
  error_reporting(0); // Needed put in for LocalHost    

require_once '../model/model.php';
require_once '../lib/basic_funcs.php';
// DONT FORGET WE NEED TO STRIPSLASHES ON CISPROD

$eventIdCheck = json_decode($_POST['eventId'],true);
$selectedClassArray = json_decode($_POST['classList'],true);
$eventDetailsArray = json_decode($_POST['eventDetails'],true);
$newClassesArray = json_decode($_POST['classesToAdd'],true);

//WHAT YOU NEED FOR CISPROD
//$eventIdCheck = $_POST['eventId'];
//$selectedClassArray = json_decode(stripslashes($_POST['classList']),true);
//$eventDetailsArray = json_decode(stripslashes($_POST['eventDetails']),true);
//$newClassesArray = json_decode(stripslashes($_POST['classesToAdd']),true);

//Set up vars for Event Table
    $name = $eventDetailsArray[name];
    $venue =$eventDetailsArray[venue];
    $desc = $eventDetailsArray[description];
    $date = toDateStore($eventDetailsArray[eventDate]); 
    $start = toTimeStore($eventDetailsArray[start]);
    $end = toTimeStore($eventDetailsArray[end]); 

if(eventIdCheck == '0' || eventIdCheck == 0){ //depending on system, may see it as a numeric
//Make call out to insert into Database
    $eventId = addNewEvent($name, $start, $end, $date, $desc, $venue);
}
else{ //Old Event, so lets edit it
    $eventId = $eventIdCheck;
    updateEvent($name, $start, $end, $date, $desc, $venue, $eventId);
    deleteClasses($eventId); //Just going to delete all of them tied to event, then we can re-add like its a new event
}

/*
 * New Class Array Logic
 *    First Pull Instructor Info
 *          -> IF EXIST get ID
 *          -> ELSE Add and return ID
 *   Add ID to class Info
 * 
 * Then Run loop like below to add the eligible classes
 */
    foreach ($newClassesArray as $newClass){
        $class_num = $newClass[class_number];
        $class_sec = $newClass[class_section];
        $class_name = $newClass[class_name];
        $instName = $newClass[addclassinstructor]; 
        $instEmail = $newClass[addinstructoremail];

        //Get new instructor id
        $instructor_id = insertInstructor($instName, $instEmail);

        $instructor = $instructor_id[0];
        $newEventId = $eventId;
        addNewEligibleClassesForEvent($class_num, $class_sec, $class_name, $instructor, $newEventId);
    }
//FOR EACH LOOP TO ADD EACH CLASS TO THE CLASS LIST TABLE
    foreach ($selectedClassArray as $class){
        $classNum =$class[class_number];
        $classSec =$class[class_section];
        $className = $class[class_name];
        $instId =$class[instructor_id];
        $newEventId = $eventId;
        addNewEligibleClassesForEvent($classNum, $classSec,$className, $instId, $newEventId); 
    }
 echo $eventId;
?>