<?php

include('session.php');

$id = $_GET['id']; 

function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$today 				= date("Y-m-d");

$logUserID			= $_SESSION['sid'];

$newDateIN			= $_POST['newDateIn']; 

$newTimeIN			= $_POST['newTimeIn'];

$newFormatTimeIN	= date("H:i:s", strtotime($newTimeIN));

$newdateOut			= $_POST['newDateOut'];

$newTimeOut			= $_POST['newTimeOut'];

$newFormatTimeOut	= date("H:i:s", strtotime($newTimeOut));

$NewlicNo			= check_input($_POST['NewlicNo']);

$newMessage			= check_input($row['newComments']);

try {
	$mysqli->autocommit(FALSE); //turn on transactions	
	$sql = "
		UPDATE logTBL
	 	SET 
	 	userID 	= ?, 
	 	dateIN 	= ?,
	 	timeIN 	= ?,
	 	dateOUT	= ?,
	 	timeOut	= ?,
	 	licNumber = ?,
	 	comments	= ?
	 	WHERE logID = '$id'";

	//$stmt1 = $mysqli->prepare("SELECT empID FROM logTBL WHERE logID = '$id'");

	$stmt = $mysqli->prepare($sql);

	$stmt->bind_param("issssss", $logUserID, $newDateIN, $newFormatTimeIN, $newdateOut, $newFormatTimeOut, $NewlicNo, $newMessage);
	
	$stmt->execute();

	
	/*$stmt1->execute();
	$result = $stmt1->get_result();
	if($result->num_rows === 0) exit('No rows');
	while($row = $result->fetch_assoc()) {
	  	$eids = $row['empID'];
	}
	$stmt1->close();

	$sql2 = "
		SELECT DISTINCT empID 
		FROM empAttendance
		WHERE empID = '$eids' AND dateIN = '$today' LIMIT 1";
	$stmt2 = $mysqli->prepare($sql2);
	$stmt2->execute(); 

	$result = $stmt2->get_result();

	if($result->num_rows > 0)  {
		$sql3 = "UPDATE empAttendance SET dateIN = ?, timeIN = ?, timeOUT = ? WHERE dateIN = '$newDateIN' ";
		$stmt3 = $mysqli->prepare($sql3);
		$stmt3->bind_param("sss", $newDateIN, $newTimeIN, $newTimeOut);
		$stmt3->execute();
		$stmt3->close();
	} */

	echo '<script>';
		echo 'window.alert("LOG RECORD UPDATED!!");';
		echo 'window.history.back();';
	echo '</script>';

	$stmt->close();
	//$stmt2->close();
	
		

} catch(Exception $e) {
	if($mysqli->errno === 1062) echo 'No Log Record Found';
	echo '<script>';
		echo 'window.alert("Log Record not updated");';
		echo 'window.history.back();';
	echo '</script>'; 
}

/*
} catch(Exception $e) {
	$mysqli->rollback(); //remove all queries from queue if error (undo)
	throw $e;
	echo '<script>';
		echo 'window.alert("Log Record not updated");';
		echo 'window.history.back();';
	echo '</script>'; 
}
*/



