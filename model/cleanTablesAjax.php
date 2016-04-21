<?php
require_once '../model/model.php';
  // error_reporting(0); // Needed put in for LocalHost

//Using Switch Statement Based on the CountValue we pass from the client side, will call specific delete functionality to assist
// in keeping the database clean at the end of the semester or academic year.
/*
 *  1 -> Delete Events
 *  2 -> Delete Classes/Instructors
 *  3 -> Delete Extra_Credit_List
 *  4 -> Delete All of The Tables Listed Above
 */

$functionCallValue = json_decode(stripslashes($_POST['countValue']),true);

//print_r($functionCallValue);

switch ($functionCallValue){
    case 1:
        clearEventsTable();
        print_r('Successfully');
        break;
    case 2:
        clearClassTable();
        clearInstructorTable();
        print_r('Successfully');
        break;
    case 3:
        clearExtraCreditTable();
        print_r('Successfully');
        break;
    case 4:
        clearEventsTable();
        clearClassTable();
        clearInstructorTable();
        clearExtraCreditTable();
        print_r('Successfully');
        break;
    default:
        print_r('encountered an error within the system '
                . 'and we were unable to succsfully remove the data from the system. '
                . 'Please contact a system admin immediatley');
        
}


