<?php

include('session.php');

$id = $_GET['id']; 

function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$logUserID			= $_SESSION['sid'];

$EmpID 				= $_POST['newEmpID']; 

$newDateIN			= $_POST['newDateIn']; 

$date 				= str_replace('/', '-', $newDateIN);
$newFormatDateIn 	= date("y-m-d", strtotime($date));


$newTimeIN			= $_POST['newTimeIn'];

$newFormatTimeIN	= date("H:i:s", strtotime($newTimeIN));

$newdateOut			= $_POST['newDateOut'];

$dateOut				= str_replace('/', '-', $newdateOut);
$newFormatDateOut 	= date("y-m-d", strtotime($dateOut));

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
		        WHEN '$newFormatDateIn' IS NOT NULL THEN '$newFormatDateIn'
		        ELSE dateIN 
		    END,	

		timeIN =
			CASE
		        WHEN timeIN IS NULL THEN NULL
		        WHEN '$newFormatTimeIN' IS NOT NULL THEN '$newFormatTimeIN'
		        ELSE timeIN 
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
		     END,

	    dateOUT = 
			CASE
		        WHEN dateOUT IS NULL THEN dateOUT
		        WHEN '$newFormatDateOut' IS NOT NULL THEN '$newFormatDateOut'
		        ELSE dateOUT
	        END,	

		timeOut = 
			CASE
		        WHEN timeOut IS NULL THEN '$newFormatTimeOut'
		        WHEN '$newFormatTimeOut' IS NOT NULL THEN '$newFormatTimeOut'
		        ELSE timeOut
	        END
    
    WHERE logTBL.logID = '$id'";


	/*else {
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

	} */
			
	$stmt = $mysqli->prepare($sql);
	/* $stmt->bind_param("issssss", $logUserID, $newDateIN, $newFormatTimeIN, $newdateOut, $newFormatTimeOut, $NewlicNo, $newMessage); */
	//3. execute
	if(!($stmt->execute() ) ) {
		echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	echo '<script>';
		echo 'window.alert("LOG RECORD UPDATED!!");';
		echo 'window.history.back();';
	echo '</script>'; 

	//echo $newFormatTimeOut;

	$stmt->close();
		

} catch(Exception $e) {
	if($mysqli->errno === 1062) echo 'No Log Record Found';
	echo '<script>';
		echo 'window.alert("Log Record not updated");';
		echo 'window.history.back();';
	echo '</script>';

}



/*
	try {	

/*$sql = "
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
		 */

		
		/*$sql = "
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
		 */
/*
		
			
		$stmt = $mysqli->prepare($sql);
		/* $stmt->bind_param("issssss", $logUserID, $newDateIN, $newFormatTimeIN, $newdateOut, $newFormatTimeOut, $NewlicNo, $newMessage); */
		//3. execute
		/*
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
*/