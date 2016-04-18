<?php
require_once '../model/model.php';
   error_reporting(0); // Needed put in for LocalHost

$EventID = $_POST['eventId'];

$eligibleClasses = getEligibleClasses($EventID);

print_r(json_encode($eligibleClasses));
