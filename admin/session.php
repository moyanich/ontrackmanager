<?php
	// Database connection
	require '../includes/config.php';

	if(!isset($_SESSION))  { 
        session_start(); 
    } 
	
	if (!isset($_SESSION['superid']) ||(trim ($_SESSION['superid']) == '')) {
		header('Location: ../index.php');	
    	exit();
	}
	else {

		$sql = "SELECT * FROM user where userid=? LIMIT 1";
		$stmt = $mysqli->prepare($sql);

		$stmt->bind_param("i", $_SESSION['superid']);

		// Execute query
		$stmt->execute();

		$result = $stmt->get_result();

		while ($row = $result->fetch_assoc()) {
			$superuser = $row['firstname'];
			$userID = $row['userid'];
			$useraccess = $row['access'];
		}
		$stmt->close();

		//setcookie($superuser, $userID, time()+ 120,'/'); // expires after 60 seconds
     	//echo 'the cookie has been set for 60 seconds';
	}
?>



	