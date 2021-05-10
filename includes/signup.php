<?php

echo 'here';
/*
include('conn.php');
session_start();
function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
			
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//For Registration Processsing
	if (isset($_POST["reg_username"]) AND isset($_POST["reg_password"])) {

		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$username = $_POST["reg_username"];
		$password = check_input($_POST["reg_password"]);
		$fpassword = md5($password);
		$userType = $_POST["usertype"];
			

		mysqli_query ($conn,"
			INSERT INTO user
			(firstname, lastname, username, password, access, register_date) 
			VALUES 
			('$fname', '$lname', '$username', '$fpassword', '$userType', now())"
		);

		?>
		<script>
			window.alert('Registration Success! Go back and Log In');
			window.location.href='index.php';
		</script>
		<?php
	}
}

*/