<?php

include('session.php');

function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$EmpID 		= $_POST['answer']; 
$dateIn 	= check_input($_POST['dateIn']); 
$date 		= str_replace('/', '-', $dateIn);
$newDateIn 	= date("y-m-d", strtotime($date));

$today 		= date("Y-m-d");
$formattedDate = date("y-m-d", strtotime($today));
$timeIN 	= check_input($_POST['timeIn']); 
$timeIN 	= date("H:i:s", strtotime($timeIN));
$licPlate 	= check_input($_POST['licNo']); 
$message 	= check_input($_POST['comments']); 

try {
	$mysqli->autocommit(FALSE); //turn on transactions
	$sql = "INSERT INTO logTBL (empID, userID, dateIN, timeIN, licNumber, comments) VALUES (?, '".$_SESSION['sid']."', ?, ?, ?, ?)";

	$sql2 = "
		SELECT DISTINCT empID 
		FROM empAttendance
		WHERE dateIN = ? AND empID = '$EmpID'";
	
	$stmt = $mysqli->prepare($sql);
	$stmt2 = $mysqli->prepare($sql2);

	$stmt->bind_param("issss", $EmpID, $newDateIn, $timeIN, $licPlate, $message );
	$stmt2->bind_param("s", $newDateIn);

	$stmt->execute();	
	$stmt2->execute();

	$result = $stmt2->get_result();

	if($result->num_rows === 0)  {
		$sql3 = "INSERT INTO empAttendance (empID, attendance, dateIN, timeIN,loggedOn) VALUES (?, '1', ?, ?, ?)";
		$stmt3 = $mysqli->prepare($sql3);
		$stmt3->bind_param("isss", $EmpID, $newDateIn, $timeIN, $formattedDate );
		$stmt3->execute();
		$stmt3->close();
	}

	$stmt->close();
	$stmt2->close();

	$mysqli->autocommit(TRUE); //turn off transactions + commit queued queries
	echo '<script>';
		echo 'window.alert("New record created");';
		echo 'window.history.back();';
	echo '</script>';
  
} catch(Exception $e) {
  $mysqli->rollback(); //remove all queries from queue if error (undo)
  throw $e;
}

?>



