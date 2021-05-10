<?php
	// Database connection
	require '../includes/config.php';

	if(!isset($_SESSION))  { 
        session_start(); 
    } 
	
	if (!isset($_SESSION['sid']) ||(trim ($_SESSION['sid']) == '')) {
		header('Location: ../index.php');	
    	exit();
	}
	else {

		$sql = "SELECT * FROM user where userid=? LIMIT 1";
		$stmt = $mysqli->prepare($sql);

		$stmt->bind_param("i", $_SESSION['sid']);

		// Execute query
		$stmt->execute();

		$result = $stmt->get_result();

		while ($row = $result->fetch_assoc()) {
			$securityUser = $row['firstname'];
			$securityUserID = $row['userid'];
		}
		$stmt->close();
	}
?>


