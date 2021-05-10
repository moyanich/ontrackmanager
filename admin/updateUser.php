<?php

include('session.php');

ini_set('display_errors',1);
 error_reporting(E_ALL);


function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(isset($_POST['updateUser'])) {
	$userID 			= check_input($_POST['accessID']); 
	$fName				= check_input($_POST['newfirstName']);
	$lName 				= check_input($_POST['newlastName']);
	$newusername 		= check_input($_POST['newusername']);
	$pwd 				= check_input($_POST['newpassword']);
	$hashed_password  	= md5($pwd);
	$accessType			= check_input($_POST['newaccessType']);

	try {

		//If connect fails display message
		if($mysqli->connect_error) {
			die("Database Connection Failed: " . $mysqli->connect_error);
		}

		if(!($stmt = $mysqli->prepare("
			UPDATE user 
			SET 
			    firstname = '$fName',
			    lastname = '$lName',
			    username = '$newusername',
			    password = '$hashed_password',
			    access = '$accessType'
			WHERE
			    userid = '$userID'

		")) ) {

			echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
		}
		
		//3. execute
		if(!($stmt->execute() ) ) {
			echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
		}

		echo '<script>';
			echo 'window.alert("RECORD UPDATED!!");';
			echo 'window.history.back();';
		echo '</script>';

		$stmt->close();

	} catch(Exception $e) {
		if($mysqli->errno === 1062) echo 'No Record';
		
		echo '<script>';
			echo 'window.alert("Record not updated");';
			echo 'window.history.back();';
			echo 'var form = document.getElementById("employee_details");';
			echo 'form.reset();';
		echo '</script>'; 
	}
}

?>


