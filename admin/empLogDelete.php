<?php
include('session.php');

try {

	$id = $_GET['logID']; 

	$stmt = $mysqli->prepare("DELETE FROM logTBL WHERE logID = ?");
	$stmt->bind_param("i", $id );
	$stmt->execute();
	$stmt->close();
	
	echo '<script>';
		echo 'window.alert("RECORD DELETED!!");';
		echo 'window.location.href = "dashboard.php";';
	echo '</script>';

} catch(Exception $e) {
	if($mysqli->errno === 1062) echo 'Error';
	echo '<script>';
		echo 'window.alert("Record not deleted");';
		echo 'window.history.back();';
	echo '</script>'; 
}

?>