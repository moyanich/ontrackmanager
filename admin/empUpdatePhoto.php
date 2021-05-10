<?php

include('session.php');

ini_set('display_errors',1);
error_reporting(E_ALL);

$id = $_GET['id']; 

function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$FirstName			= check_input($_POST['empFName']);
$LastName 			= check_input($_POST['empLName']);

if(isset($_FILES['newFileField'])) {

	try {

		try {
			$newPhoto = $FirstName . '-' . $LastName . '.jpg';
			$newPhoto = preg_replace('/\s+/', '-', $newPhoto);	    

			// You should also check filesize here. 
		    if ($_FILES['newFileField']['size'] > 10000000) {
		        throw new RuntimeException('Exceeded filesize limit.');
		    }
			    
		    // You should name it uniquely.
		    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
		    // On this example, obtain safe unique name from its binary data.
			if ($_FILES['newFileField']['tmp_name'] != "") {
			    	$newFile = "../images/staff/".$newPhoto;
				    move_uploaded_file($_FILES['newFileField']['tmp_name'], "../images/staff/$newPhoto"); 
					echo 'File is uploaded successfully.';
			}
		} 
		catch (RuntimeException $e) {
		   	echo $e->getMessage();
		}
			
		$sql = "UPDATE employee SET 
			empPhoto = '$newFile'
			WHERE empID = '$id' ";

		$stmt = $mysqli->prepare($sql);

		//3. execute
		if(!($stmt->execute() ) ) {
			echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
		}

		echo '<script>';
			echo 'window.alert("PHOTO UPDATED!!");';
			echo 'window.history.back();';
		echo '</script>';

		$stmt->close();	

	} 
	catch(Exception $e) {
		if($mysqli->errno === 1062) echo 'No Record';
		
		echo '<script>';
			echo 'window.alert("Record not updated");';
			echo 'window.history.back();';
			echo 'var form = document.getElementById("employee_details");';
			echo 'form.reset();';
		echo '</script>'; 
	}


}


/*

/*try {

		$stmtPhoto = $mysqli->prepare("SELECT * from employee WHERE empID = '$id'");
		$stmtPhoto->execute();
		$resultPhoto = $stmtPhoto->get_result();

		while ($row = $resultPhoto->fetch_assoc()) {

			$newFile = $row['empPhoto'];
			
			if(isset($_FILES['newFileField'])) {

				try {
					$newPhoto = $FirstName . '-' . $LastName . '.jpg';
					$newPhoto = preg_replace('/\s+/', '-', $newPhoto);		    

					// You should also check filesize here. 
				    if ($_FILES['newFileField']['size'] > 10000000) {
				        throw new RuntimeException('Exceeded filesize limit.');
				    }

				    // You should name it uniquely.
				    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
				    // On this example, obtain safe unique name from its binary data.

				    if ($_FILES['newFileField']['tmp_name'] != "") {
				    	$newFile = "../images/staff/".$newPhoto;
					    move_uploaded_file($_FILES['newFileField']['tmp_name'], "../images/staff/$newPhoto"); 
						echo 'File is uploaded successfully.';
					}

				} catch (RuntimeException $e) {
				   	echo $e->getMessage();
				}
			} 
		}


try {
	
	$stmtPhoto = $mysqli->prepare("SELECT * from employee WHERE empID = '$id'");
	$stmtPhoto->execute();
	$resultPhoto = $stmtPhoto->get_result();
 	
	while ($row = $resultPhoto->fetch_assoc()) {

		$newFile = $row['empPhoto'];
		
		if(isset($_FILES['newFileField'])) {

			try {
				$newPhoto = $NewFName . '-' . $NewLName . '.jpg';
				$newPhoto = preg_replace('/\s+/', '-', $newPhoto);		    

				// You should also check filesize here. 
			    if ($_FILES['newFileField']['size'] > 10000000) {
			        throw new RuntimeException('Exceeded filesize limit.');
			    }

			    // You should name it uniquely.
			    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
			    // On this example, obtain safe unique name from its binary data.

			    if ($_FILES['newFileField']['tmp_name'] != "") {
			    	$newFile = "../images/staff/".$newPhoto;
				    move_uploaded_file($_FILES['newFileField']['tmp_name'], "../images/staff/$newPhoto"); 
					echo 'File is uploaded successfully.';
				}

			} catch (RuntimeException $e) {
			   	echo $e->getMessage();
			}
		} 
	}

	if(!($stmt = $mysqli->prepare("UPDATE employee SET empID = ?, empFirstName = ?, empLastName = ?, deptID = ?, typeID = ?, empPosition = ?, empAddress = ?, empGender = ?, empPhoto = ?, empStartDate = ?, empEndDate = ? WHERE empID = '$id'"))) {
		echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}
	
	//2. bind
	if(!($stmt->bind_param("issiissssss", $EmpID, $NewFName, $NewLName, $Newdept, $NewEmpType, $newEmpPosition, $newAddress, $newGender, $newFile, $newEmpStartDate, $newEmpEndDate))) {
		echo 'Binding parameters failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}

	//3. execute
	if(!($stmt->execute() ) ) {
		echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	echo '<script>';
		echo 'window.alert("RECORD UPDATED!!");';
		echo 'window.history.back();';
	echo '</script>';

	$stmt->close();

} catch(Exception $e) {
	if($mysqli->errno === 1062) echo 'No Record';
	echo '<script>';
		echo 'window.alert("Record not updated");';
		echo 'window.history.back();';
	echo '</script>'; 
}

*/


