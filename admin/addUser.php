<?php
/*
* Template to add a user to the program
*/

include('session.php');

ini_set('display_errors',1);
 error_reporting(E_ALL);


function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$fName				= check_input($_POST['firstName']);
$lName 				= check_input($_POST['lastName']);
$newusername 		= check_input($_POST['username']);	
$pwd 				= check_input($_POST['password']);
$hashed_password  	= md5($pwd);
$accessType			= check_input($_POST['accessType']);

try {

	//If connect fails display message
	if($mysqli->connect_error) {
		die("Database Connection Failed: " . $mysqli->connect_error);
	}

//INSERT INTO `user`(`firstname`, `lastname`, `username`, `password`, `user_registered`,`access`) VALUES ('Brendon','Smith','bsmith','snfwfw','2019-01-21 00:00:00','2')

	//1. Prepare statement
	if(!($stmt = $mysqli->prepare("INSERT INTO user (firstname, lastname, username, password, user_registered, access) VALUES (?, ?, ?, '$hashed_password', now(), '$accessType')"))) {
		echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}
	
	//2. bind
	if(!($stmt->bind_param('sss', $fName, $lName, $newusername) )) {
		echo 'Binding parameters failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}

	//3. execute
	if(!($stmt->execute() ) ) {
		echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	echo '<script>';
		echo 'window.alert("New user record created");';
		echo 'window.history.back();';
	echo '</script>'; 

	$stmt->close();

} catch(RuntimeException $e) {
	echo $e->getMessage();
	if($mysqli->errno === 1062) echo 'Duplicate entry .' . $e->getMessage();
	echo '<script>';
		echo 'window.alert("User already exists");';
		echo 'window.history.back();';
	echo '</script>';
}

?>


