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

if(isset($_POST['updateMyProfile'])) {
	$fName		= check_input($_POST['adminfirstName']);
	$lName 		= check_input($_POST['adminlastName']);
	$pwd 		= check_input($_POST['adminnewpassword']);
	$hashed_password  = md5($pwd);

	try {

		$id = $_GET['id']; 

		//If connect fails display message
		if($mysqli->connect_error) {
			die("Database Connection Failed: " . $mysqli->connect_error);
		}

		if(!($stmt = $mysqli->prepare("
			UPDATE user 
			SET 
			    firstname = '$fName',
			    lastname = '$lName',
			    password = '$hashed_password'
			WHERE
			    userid = '$id'

		")) ) {

			echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
		}
		
		//3. execute
		if(!($stmt->execute() ) ) {
			echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
		}

		echo '<script>';
			echo 'window.alert("PROFILE UPDATED!!");';
			echo 'window.history.back();';
		echo '</script>';

		$stmt->close();

	} catch(Exception $e) {
		if($mysqli->errno === 1062) echo 'No profile found';
		
		echo '<script>';
			echo 'window.alert("Record not updated");';
			echo 'window.history.back();';
		echo '</script>'; 
	}
}

?>


