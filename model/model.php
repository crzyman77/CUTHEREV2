<?php
if(!isset($_SESSION))
  { 
    session_start();
  }
/*
 * ME Testing the change log system of git, and did the repo change locations. So One folder fits all
 */
        function getDBConnection() {
		$dataSetName = 'mysql:host=localhost; dbname=cis411_EventRegistration';
		$username = 's_cgillis';
		$password = 'Gk$98pbw';

		try {
			$dataBase = new PDO($dataSetName, $username, $password);
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;
		}
		return $dataBase;
	}
        
        function addNewEvent($name, $start, $end, $date, $desciption, $venue){ 
            $db = getDBConnection();
            $query = "INSERT INTO `event`(`name`, `start_time`, `end_time`, `event_date`, `description`, `venue_id`) "
                    . "VALUES( :name, :start_time, :end_time, :event_date, :description, :venue_id);";
            $statement = $db -> prepare ($query);
            $statement->bindValue(':name',$name);
            $statement->bindValue(':start_time',$start);
            $statement->bindValue(':end_time', $end);
            $statement->bindValue(':event_date', $date);
            $statement->bindValue(':description', $desciption);
            $statement->bindValue(':venue_id', $venue);
            $success  = $statement ->execute();
            $statement->closeCursor();
            if ($success) {
			return $db->lastInsertId(); // Get generated EventId
		} else {
			logSQLError($statement->errorInfo()); 
                        print_r('We FUCKED UP');// Log error to debug
		}		
        }
        function addNewEligibleClassesForEvent($class_number, $class_section,$class_name,$instructor_id,$event_id){
            $db = getDBConnection();
            $query = "INSERT INTO `class`(`class_number`, `class_section`, `class_name`, `instructor_id`, `event_id`)"
                    . "VALUES (:class_num, :class_section,:class_name, :instructor_id, :event_id)";
            $statement = $db -> prepare ($query);
            $statement->bindValue (':class_num',$class_number);
            $statement->bindValue (':class_section', $class_section);
            $statement->bindValue(':class_name', $class_name);
            $statement->bindValue (':instructor_id', $instructor_id);
            $statement->bindValue (':event_id', $event_id);
            $success  = $statement ->execute();
            $statement->closeCursor();
            if ($success) {
			return $db->lastInsertId(); // Get generated StoryID
		} else {
			logSQLError($statement->errorInfo()); 
                        print_r('We FUCKED UP');// Log error to debug
		}		
        }  

	//JUNK FUNCTION FOR OLD SET UP
	function checkInTesting($curLocation, $checkIn, $event_id){
           
            $db = getDBConnection();
                $query = 'INSERT INTO locationTestingData (curLocation,checkIn, event_id) VALUES (:location, :check, :event)';
                $statement = $db -> prepare ($query);
                $statement->bindValue(':location',$curLocation);
                $statement->bindValue(':check',$checkIn);
                $statement->bindValue(':event',$event_id);
                $success  = $statement ->execute();
                $statement->closeCursor();
                 if ($success) {
                            return $db->lastInsertId(); // Get generated StoryID
                    } else {
                            logSQLError($statement->errorInfo());  // Log error to debug
                    }		
        }
        
        function clearEventsTable(){
            $db = getDBConnection();
            $query ="DELETE FROM  `event`";
            $statement = $db -> prepare($query); 
            $success = $statement ->execute();
            $statement ->closeCursor();
            if ($success) {
		return $statement->rowCount();
            } 
            else {
                logSQLError($statement->errorInfo());  // Log error to debug
            }
        }
        
        function clearClassTable(){
            $db = getDBConnection();
            $query ="DELETE FROM  `class`";
            $statement = $db -> prepare($query);
            $success = $statement ->execute();
            $statement ->closeCursor();
            if ($success) {
		return $statement->rowCount();
            } 
            else {
                logSQLError($statement->errorInfo());  // Log error to debug
            }
        }
        
        
        function clearInstructorTable(){
            $db = getDBConnection();
            $query ="DELETE FROM  `instructor`";
            $statement = $db -> prepare($query);
            $success = $statement ->execute();
            $statement ->closeCursor();
            if ($success) {
		return $statement->rowCount();
            } 
            else {
                logSQLError($statement->errorInfo());  // Log error to debug
            }
            
        }
        
        function clearExtraCreditTable(){
            $db = getDBConnection();
            $query ="DELETE FROM  `extra_credit_list`";
            $statement = $db -> prepare($query);
            $success = $statement ->execute();
            $statement ->closeCursor();
            if ($success) {
		return $statement->rowCount();
            } 
            else {
                logSQLError($statement->errorInfo());  // Log error to debug
            }  
        }
        
        function deleteClasses($eventID){
            $db = getDBConnection();
            $query = 'DELETE FROM class WHERE event_id = :eventID';
            $statement = $db -> prepare($query);
            $statement -> bindValue(':eventID',$eventID); 
            $success = $statement ->execute();
            $statement ->closeCursor();
            if ($success) {
		return $statement->rowCount();
            } 
            else {
                logSQLError($statement->errorInfo());  // Log error to debug
            }
        }
        
        function deleteEvent($eventID){
            deleteClasses($eventID);
            $db = getDBConnection();
            $query = 'DELETE FROM event WHERE id = :eventID';
            $statement = $db -> prepare($query);
            $statement -> bindValue(':eventID',$eventID); 
            $success = $statement ->execute();
            $statement ->closeCursor();
            if ($success) {
		return $statement->rowCount();
            } 
            else {
                logSQLError($statement->errorInfo());  // Log error to debug
            }
        }
        
        function getStudentClassList($classNum,$classSec,$event){
            try {
			$dataBase = getDBConnection();
			$query = "SELECT \n"
                                . "`student_email` \n"
                                . " FROM \n"
                                    . "`extra_credit_list` \n"
                                . "WHERE "
                                . " event_id = :eventid && class_number = :classNum && class_section = :classSec";
			$statement = $dataBase->prepare($query);
                        $statement->bindValue(':eventid', $event);
                        $statement->bindValue(':classNum', $classNum);
                        $statement->bindValue(':classSec', $classSec);
			$statement->execute();
			$results = $statement->fetchAll();
			$statement->closeCursor();
			return $results;           // Assoc Array of Rows
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;
		}		
        }
	
        function getClassList() {
		try {
			$dataBase = getDBConnection();
			$query = "SELECT DISTINCT \n"
                                    . "	class.class_number, \n"
                                    . "	class.class_section, \n"
                                    . "	class.class_name, \n"
                                    . "	instructor.name, \n"
                                    . "	instructor.id \n"
                            . "FROM \n"
                            . "	class \n"
                            . "	INNER JOIN instructor ON class.instructor_id = instructor.id \n"
                            . " ORDER BY class_number ASC, class_section ASC";
			$statement = $dataBase->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll();
			$statement->closeCursor();
			return $results;           // Assoc Array of Rows
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;
		}		
	}

        function getEventDetails($eventid){
            try{
                $dataBase = getDBConnection();
                $query = "SELECT \n"
                        . "event.name, \n"
                        . "event.start_time, \n"
                        . "event.end_time, \n"
                        . "event.event_date, \n"
                        . "event.description, \n "
                        . "venue.building_name, \n"
                        . "venue.room_number \n"
                        . "FROM \n"
                        . "event INNER JOIN venue ON event.venue_id = venue.id  \n"
                        . "WHERE event.id = :id";
                $statement = $dataBase->prepare($query);
                $statement->bindValue(':id', $eventid);
                $statement->execute();
                $results = $statement->fetch();
                $statement->closeCursor();
                return $results;           // Assoc Array of Rows
                
            } catch (PDOException $e) {
			$errorMessage = $e->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;

            }
        }
        
        function getExtraCreditLists(){
            try{
                $dataBase = getDBConnection();
                $query = "SELECT \n"
                            . "	`class_number`, \n"
                            . "	`class_section`, \n"
                            . "	`instructor_id`, \n"
                            . "	`event_id`, \n"
                            . "	`student_email` \n"
                            . "FROM \n"
                            . "	`extra_credit_list` \n"
                            . "ORDER BY \n"
                            . "	`event_id` ASC, \n"
                            . "	`class_number` ASC, \n"
                            . "	`class_section` ASC";
                $statement = $dataBase->prepare($query);
                $statement->execute();
                $results = $statement->fetchAll();
                $statement->closeCursor();
                return $results;           // Assoc Array of Rows
                
            } catch (PDOException $e) {
			$errorMessage = $e->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;

            }
            
        }
        
        
        function getEligibleClasses($eventid){
                $dataBase = getDBConnection();
                $query = "SELECT \n"
                            . " class.class_name, \n"
                            . " class.class_number, \n"
                            . " class.class_section,\n"
                            . " instructor.name,\n"
                            . " instructor.email, \n"
                            . " instructor.id \n"
                            . "FROM \n"
                            . " class INNER JOIN instructor ON class.instructor_id = instructor.id \n"
                            . "WHERE \n"
                            . " class.event_id = :id \n"
                            . "ORDER BY class_number ASC, class_section ASC";
                $statement = $dataBase->prepare($query);
                $statement->bindValue(':id', $eventid);
                $statement->execute();
                $results = $statement->fetchAll();
                $statement->closeCursor();
                return $results; 
        }
        
        function getEventList(){
            try{
                $dataBase = getDBConnection();
                $query = "SELECT \n"
                            . " event.id, \n"
                            . " event.name, \n"
                            . " event.start_time, \n"
                            . " event.end_time, \n"
                            . " event.event_date, \n"
                            . " venue.building_name, \n"
                            . " venue.room_number, venue.id AS location \n"
                            . "FROM \n"
                            . " event \n"
                            . " INNER JOIN venue ON event.venue_id = venue.id \n"
                            . "WHERE \n"
                            . " event.event_date >= CURDATE() \n"
                            . " && event.event_date <= (CURRENT_DATE + 7)\n"
                            . "ORDER BY \n"
                            . " event.event_date";
                $statement = $dataBase->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();  // Should be 0 or 1 row
                $statement->closeCursor();
                return $result;			 // False if 0 rows
            } catch (PDOException $e) {
                $errorMessage = $ex->getMessage();
                echo $errorMessage;
                include '../view/404.php';
                die;
            }
        }
        
        function getPastEventList(){
            try{
                $dataBase = getDBConnection();
                $query = "SELECT \n"
                            . " event.id, \n"
                            . " event.name, \n"
                            . " event.event_date \n"
                            . "FROM \n"
                            . " event \n"
                            . "WHERE \n"
                            . "event.event_date >= (CURRENT_DATE - 14) \n"
                            . " && event.event_date <= (CURRENT_DATE)\n"
                            . "ORDER BY \n"
                            . " event.event_date";
                $statement = $dataBase->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();  // Should be 0 or 1 row
                $statement->closeCursor();
                return $result;			 // False if 0 rows
            } catch (PDOException $e) {
                $errorMessage = $ex->getMessage();
                echo $errorMessage;
                include '../view/404.php';
                die;
            }
        }
        
        function getVenueOptions(){
            try {
			$dataBase = getDBConnection();
			$query = "SELECT \n"
                                    . "	`id`, \n"
                                    . "	`building_name`, \n"
                                    . "	`room_number`\n"
                                    . "FROM \n"
                                    . "	`venue`";           
			$statement = $dataBase->prepare($query);
			$statement->execute();
			$results = $statement->fetchAll();
			$statement->closeCursor();
			return $results;           // Assoc Array of Rows
		} catch (PDOException $e) {
			$errorMessage = $e->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;
		}	
            
        }
        
        function locationCheckBecker(){
          try{ 
                $dataBase = getDBConnection();
                $sql = "SELECT \n"
                    . "	`corner1_lat`, \n"
                    . "	`corner1_lng`, \n"
                    . "	`corner2_lat`, \n"
                    . "	`corner2_lng`, \n"
                    . "	`corner3_lat`, \n"
                    . "	`corner3_lng`, \n"
                    . "	`corner4_lat`, \n"
                    . "	`corner4_lng`, \n"
                    . "	`corner5_lat`, \n"
                    . "	`corner5_lng`, \n"
                    . "	`corner6_lat`, \n"
                    . "	`corner6_lng` \n"
                    . "FROM \n"
                    . "	`venue`  WHERE id = :location ";      
                $statement = $dataBase->prepare($sql);
                $statement->bindValue(':location', $_SESSION['venue']);
                $statement->execute();
                $results = $statement->fetch();
                $statement->closeCursor();
                return $results;
            } catch (Exception $ex) {
                $errorMessage = $ex->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;
            }
        }
       
        function checkIfInstructorExsists($email){
            try{
            $db = getDBConnection();
            $query = 'SELECT instructor.id FROM instructor WHERE instructor.email = :email';
            $statement = $db -> prepare ($query);
            $statement->bindValue (':email', $email);
            $statement ->execute();
            $results = $statement->fetch();
            $statement->closeCursor();
            return $results;
            }catch (Exception $ex) {
                $errorMessage = $ex->getMessage();
                        echo $errorMessage;
			include '../view/404.php';
			die;
            }
        }
        function insertInstructor($username, $email){
            $exsist = checkIfInstructorExsists($email);
            if($exsist != ''){
                return $exsist;  //Return Exsisting Instructor ID   
            }else
            {
                $db = getDBConnection();
                $query = 'INSERT INTO instructor (name , email)'
                        . 'VALUES (:name, :email)';
                $statement = $db -> prepare ($query);
                $statement->bindValue (':name',$username);
                $statement->bindValue (':email', $email);
                $success  = $statement ->execute();
                $statement->closeCursor();
                if ($success) {
                            return $db->lastInsertId(); // Get generated Instructor Id
                    } else {
                            logSQLError($statement->errorInfo());  // Log error to debug
                    }		
            }
        
        }
        
        // Extra Credit Lists
        function addToClassList($class_number, $class_section, $instructor_id, $event_id, $student_email){
            $db = getDBConnection();
            $query = "INSERT INTO extra_credit_list (`class_number`, `class_section`, `instructor_id`, `event_id`,`student_email`) \n"
                    . "VALUES (:class_number, :class_sec, :inst_id, :ev_id, :email)";
            $statement = $db -> prepare ($query);
            $statement->bindValue (':class_number',$class_number);
            $statement->bindValue (':class_sec', $class_section);
            $statement->bindValue (':inst_id', $instructor_id);
            $statement->bindValue (':ev_id', $event_id);
            $statement->bindValue (':email', $student_email);
            $success  = $statement ->execute();
            $statement->closeCursor();
            if ($success) {
			return $db->lastInsertId(); // Get generated StoryID
		} else {
			logSQLError($statement->errorInfo()); 
                        print_r('We FUCKED UP');// Log error to debug
		}		
        }
        
        function updateEvent($name, $start, $end, $date, $desciption, $venue, $eventId){ 
            $db = getDBConnection();
            $query = "UPDATE `event` SET \n"
                    . "`name` = :name, \n"
                    . "`start_time` = :start_time, \n"
                    . "`end_time` = :end_time, \n"
                    . "`event_date` = :event_date, \n"
                    . "`description`= :description, \n"
                    . "`venue_id` = :venue_id \n"
                    . "WHERE id = :event_id";
            $statement = $db -> prepare ($query);
            $statement->bindValue(':name',$name);
            $statement->bindValue(':start_time',$start);
            $statement->bindValue(':end_time', $end);
            $statement->bindValue(':event_date', $date);
            $statement->bindValue(':description', $desciption);
            $statement->bindValue(':venue_id', $venue);
            $statement->bindValue(':event_id', $eventId);
            $success  = $statement ->execute();
            $statement->closeCursor();
            if ($success) {
			return $db->lastInsertId(); // Get generated EventId
		} else {
			logSQLError($statement->errorInfo()); 
                        print_r('We FUCKED UP');// Log error to debug
		}		
        }
        
	function logSQLError($errorInfo) {
		$errorMessage = $errorInfo[2];
                include '../view/404.php';
		die;
        }          
?>