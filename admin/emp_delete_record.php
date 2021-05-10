<?php
/*
* Template to delete employee record
*/

include('session.php');

try {

	$id = $_GET['id']; 

	//If connect fails display message
	if($mysqli->connect_error) {
		die("Database Connection Failed: " . $mysqli->connect_error);
	}

	//1. Prepare statement
	if(!($stmt = $mysqli->prepare("DELETE FROM employee WHERE empID = ?"))) {
		echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}
	
	//2. bind
	if(!($stmt->bind_param("i", $id )) ) {
		echo 'Binding parameters failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}

	//3. execute
	if(!($stmt->execute() ) ) {
		echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}
	
	echo '<script>';
		echo 'window.alert("RECORD DELETED!!");';
		echo 'window.location.href = "pageManageEmp.php";';
	echo '</script>';

	$stmt->close();
	
} catch(Exception $e) {
	if($mysqli->errno === 1062) echo 'Error';
	echo '<script>';
		echo 'window.alert("Record not deleted");';
		echo 'window.history.back();';
	echo '</script>'; 
}

?>