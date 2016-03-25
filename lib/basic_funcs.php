<?php
    function unQuoteMe() {
        if (get_magic_quotes_gpc()) {
	function stripslashes_gpc(&$value) {
            $value = stripslashes($value);
	}
	array_walk_recursive($_GET, 'stripslashes_gpc');
	array_walk_recursive($_POST, 'stripslashes_gpc');
	array_walk_recursive($_COOKIE, 'stripslashes_gpc');
	array_walk_recursive($_REQUEST, 'stripslashes_gpc');
	}		
    }
    
    function to12HourTime($pTime){
        return date("g:i A" , strtotime($pTime));
    }
    
    function toReadableDate($pDate){
        return date('F j \, Y', strtotime($pDate));
    }
    
    function toDateStore($pDate){
        return date('Y-m-d', strtotime($pDate));
    }
    
    function toTimeStore($pTime){
        return date("H:i:s" , strtotime($pTime));
    }
    
?>
