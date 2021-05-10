<?php

include('session.php');

$id = $_GET['id']; 

function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$logUserID			= $_SESSION['superid'];

$newDateIN			= $_POST['newDateIn']; 

$newTimeIN			= $_POST['newTimeIn'];

$newFormatTimeIN	= date("H:i:s", strtotime($newTimeIN));

$newdateOut			= $_POST['newDateOut'];

$newTimeOut			= $_POST['newTimeOut'];

$newFormatTimeOut	= date("H:i:s", strtotime($newTimeOut));

$NewlicNo			= check_input($_POST['NewlicNo']);

$newMessage			= check_input($row['newComments']);


try {		
	
	$sql = "
	UPDATE logTBL SET 
		dateIN =
			CASE
		        WHEN dateIN IS NULL THEN NULL
		        WHEN '$newDateIN' IS NOT NULL THEN '$newDateIN'
		        ELSE dateIN 
		    END,	

		timeIN =
			CASE
		        WHEN timeIN IS NULL THEN NULL
		        WHEN '$newFormatTimeIN' IS NOT NULL THEN '$newFormatTimeIN'
		        ELSE timeIN 
	        END,

	    dateOUT = 
			CASE
		        WHEN '$newdateOut' IS NULL THEN dateOUT
		        WHEN '$newdateOut' IS NOT NULL THEN '$newdateOut'
		        ELSE dateOUT
	        END,	

		timeOut = 
			CASE
		        WHEN timeOut IS NULL THEN '$newFormatTimeOut'
		        WHEN '$newFormatTimeOut' IS NOT NULL THEN '$newFormatTimeOut'
		        ELSE timeOut
	        END,	

		licNumber = 
			CASE
		        WHEN licNumber IS NULL THEN licNumber
		        WHEN '$NewlicNo' IS NOT NULL THEN '$NewlicNo'
		        ELSE licNumber
		    END,	

		comments = 
			CASE
		        WHEN comments IS NULL THEN comments
		        WHEN '$newMessage' IS NOT NULL THEN '$newMessage'
		        ELSE comments 
	        END
    
    WHERE logTBL.logID = '$id'";

	
			
	$stmt = $mysqli->prepare($sql);
	
	//3. execute
	if(!($stmt->execute() ) ) {
		echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	echo '<script>';
		echo 'window.alert("LOG RECORD UPDATED!!");';
		echo 'window.history.back();';
	echo '</script>';
	$stmt->close();
		

} catch(Exception $e) {
	if($mysqli->errno === 1062) echo 'No Log Record Found';
	echo '<script>';
		echo 'window.alert("Log Record not updated");';
		echo 'window.history.back();';
	echo '</script>'; 
}




/*
if(isset($_POST['newDateIn']) || isset($_POST['newTimeIn']) || isset($_POST['NewlicNo'])) {
	try {		
		
		$sql = "
		UPDATE logTBL SET 
			dateIN =
				CASE
			        WHEN '$newDateIN' IS NULL THEN NULL
			        WHEN '$newDateIN' IS NOT NULL THEN '$newDateIN'
			        ELSE dateIN 
			    END,	

			timeIN =
				CASE
			        WHEN '$newFormatTimeIN' IS NULL THEN NULL
			        WHEN '$newFormatTimeIN' IS NOT NULL THEN '$newFormatTimeIN'
			        ELSE timeIN 
		        END,

			licNumber = 
				CASE
			        WHEN '$NewlicNo' IS NULL THEN 'none'
			        WHEN '$NewlicNo' IS NOT NULL THEN '$NewlicNo'
			        ELSE licNumber
			    END,	

			comments = 
				CASE
			        WHEN '$newMessage' IS NULL THEN 'none'
			        WHEN '$newMessage' IS NOT NULL THEN '$newMessage'
			        ELSE comments 
		        END
	    
	    WHERE logTBL.logID = '$id'";
			
		$stmt = $mysqli->prepare($sql);
		
		if(!($stmt->execute() ) ) {
			echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
		}

		echo '<script>';
			echo 'window.alert("LOG RECORD UPDATED!!");';
			echo 'window.history.back();';
		echo '</script>';
		$stmt->close();
			

	} catch(Exception $e) {
		if($mysqli->errno === 1062) echo 'No Log Record Found';
		echo '<script>';
			echo 'window.alert("Log Record not updated");';
			echo 'window.history.back();';
		echo '</script>'; 
	}
}

if(isset($_POST['newDateOut']) || isset($_POST['newTimeOut'])) {

	try {		
	
		$sql = "
		UPDATE logTBL SET 
			dateIN =
				CASE
			        WHEN '$newDateIN' IS NULL THEN NULL
			        WHEN '$newDateIN' IS NOT NULL THEN '$newDateIN'
			        ELSE dateIN 
			    END,	

			timeIN =
				CASE
			        WHEN '$newFormatTimeIN' IS NULL THEN NULL
			        WHEN '$newFormatTimeIN' IS NOT NULL THEN '$newFormatTimeIN'
			        ELSE timeIN 
		        END,

		    dateOUT = 
				CASE
			        WHEN '$newdateOut' IS NULL THEN 'dateOUT'
			        WHEN '$newdateOut' IS NOT NULL THEN '$newdateOut'
			        ELSE dateOUT
		        END,	

			timeOut = 
				CASE
			        WHEN '$newFormatTimeOut' IS NULL THEN NULL
			        WHEN '$newFormatTimeOut' IS NOT NULL THEN '$newFormatTimeOut'
			        ELSE timeOut
		        END,	

			licNumber = 
				CASE
			        WHEN '$NewlicNo' IS NULL THEN 'none'
			        WHEN '$NewlicNo' IS NOT NULL THEN '$NewlicNo'
			        ELSE licNumber
			    END,	

			comments = 
				CASE
			        WHEN '$newMessage' IS NULL THEN 'none'
			        WHEN '$newMessage' IS NOT NULL THEN '$newMessage'
			        ELSE comments 
		        END
	    
	    WHERE logTBL.logID = '$id'";
			
		$stmt = $mysqli->prepare($sql);

		//3. execute
		if(!($stmt->execute() ) ) {
			echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
		}

		echo '<script>';
			echo 'window.alert("LOG RECORD UPDATED!!");';
			echo 'window.history.back();';
		echo '</script>';
		$stmt->close();
			

	} catch(Exception $e) {
		if($mysqli->errno === 1062) echo 'No Log Record Found';
		echo '<script>';
			echo 'window.alert("Log Record not updated");';
			echo 'window.history.back();';
		echo '</script>'; 
	}
}


	/*try {		
		$sql = "
			UPDATE logTBL
		 	SET 
			 	
			 	dateIN 	= ?,
			 	timeIN 	= ?,
			 	dateOUT	= ?,
			 	timeOut	= ?,
			 	licNumber = ?,
			 	comments	= ?
		 	WHERE logID = '$id'";

		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ssssss", $newDateIN, $newFormatTimeIN, $newdateOut, $newFormatTimeOut, $NewlicNo, $newMessage);
		$stmt->execute();
		echo '<script>';
			echo 'window.alert("LOG RECORD UPDATED!!");';
			echo 'window.history.back();';
		echo '</script>';
		$stmt->close();
			

	} catch(Exception $e) {
		if($mysqli->errno === 1062) echo 'No Log Record Found';
		echo '<script>';
			echo 'window.alert("Log Record not updated");';
			echo 'window.history.back();';
		echo '</script>';
	} */
