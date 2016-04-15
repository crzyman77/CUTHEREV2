<?php
if(!isset($_SESSION))
  { 
    session_start();
  }
 

//DOES THIS WORK NOW?
//require_once '../model/locationModel.php';
require_once '../model/model.php';
require_once '../lib/basic_funcs.php';

unQuoteMe();
if (isset($_POST['action'])) {  // check get and post
        $action = $_POST['action'];
    } else if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        include('../view/index.php');  // default action
        exit();
    }
    
    switch ($action){
        case 'Home':
            listAllEvents();
            break;
        case 'ListEvents':
            listAllEvents();
            break;
        case 'EventDetails':
            showEventDetails();
            break;
        case 'AddEvent':
            addEvent();
            break;
        case 'EditEvent':
            editEvent();
            break;
        case 'TestLocation':
            include '../view/eventCheckInTest.php';
            break;
        case 'About':
            include '../view/aboutus2.php';
            break;
        case 'dbTest':
            locationCheck();
            break;
        case 'Shortcodes':
            include '../view/shortcodes.php';
            break;
        case 'AddStudent':
            addStudentForExtraCredit();
          //locationTesting();
            break;
        case 'AddStory':
            addStory();
            break;
        default:
            listAllEvents();
            break;
    } //END SWITCH
    
    function locationTesting(){
        $studentLocation = $_GET['CurrentLocation'];
        $isWithinPolygon = $_GET['IsWithinPolygon'];
        $EventID = $_GET['EventId'];
        $VenueID = $_GET['VenueID'];
        checkInTesting($studentLocation, $isWithinPolygon,  $EventID);
        include '../view/eventDetails.php';   
    }
    
    function addStudentForExtraCredit(){
      $result = $_GET['IsWithinPolygon'];
      include '../view/checkInResult.php';
    }
    
    function locationCheck(){
       // $array = beckerLocationBreak();
        include '../view/dbTest.php';
    }

    function listAllEvents(){
        $events = getEventList();
        include '../view/eventList.php';
    }
    
    function showEventDetails() {
        $EventID = $_GET['EventID'];
        $VenueID = $_GET['VenueID'];
        $_SESSION['venue'] = $VenueID;
    //$result = locationForEvent($VenueID);
    //print_r($_SESSION['venue']);
        if (!isset($EventID)) {
            $errorMessage = 'You must provide an EventID to display.';
            include '../view/404.php';
        } else {
            $row = getEventDetails($EventID);
            $class = getEligibleClasses($EventID);
            if ($row == FALSE) {
                $errorMessage = 'No event was found.';
                include '../view/404.php';
            } else {
                include '../view/eventDetails.php';
            }
         }
    }

    function addEvent() {
        $mode = "Add";
        $EventID = 0;
        $EventName = "";
        $LocationID = 0;
        $BuildingName = "";
        $RoomNum = "";
        $EventStart = "";
        $EventEnd = "";
        $EventDescription = "";
        $EventDate = date('m/d/y');
        $allClasses = getClassList();
        $venue = getVenueOptions();

        include '../view/modifyEvent.php';
    }
    
    function editEvent() {
        $EventID = $_GET['EventID'];
        if (!isset($EventID)) {
            $errorMessage = 'You must provide an EventID to display an event.';
            include '../view/404.php';
        } else {
            $row = getEventDetails($EventID);
            if ($row == FALSE) {
                $errorMessage = 'Event not found.';
                include '../view/404.php';
            } else {
                $mode = "Edit";
                $EventID = $_GET['EventID'];
                $EventName = $row['name'];
                $EventBuilding = $row['building_name'];
                $EventRoom = $row['room_number'];
                $EventStart = $row['start_time'];
                $EventEnd = $row['end_time'];
                $EventDate = $row['event_date'];
                $EventDescription = $row['description'];
                $class = getEligibleClasses($EventID);
                $allClasses = getClassList();
                $venue = getVenueOptions();
                include '../view/modifyEvent.php';
            }
        }		
    }