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

if(isset($_POST['update'])) {
	$EmpID 				= check_input($_POST['newEmpID']); 
	$FirstName			= check_input($_POST['newFirstName']);
	$LastName 			= check_input($_POST['newLastName']);
	$Newdept 			= check_input($_POST['newDept']);
	$NewEmpType 		= check_input($_POST['newEmpType']);
	$newGender 			= check_input($_POST['newGender']);		
	$newEmpPosition 	= check_input($_POST['newEmpPosition']);	
	$newAddress 		= check_input($_POST['newAddress']);	
	$newStatus			= check_input($_POST['newEmpStatus']);
	/*$newEmpStartDate 	= check_input($_POST['newEmpStartDate']);	
	$newEmpEndDate 		= check_input($_POST['newEmpEndDate']);	*/

	try {

		$sql = "UPDATE employee SET 
			empID = 
				CASE 
					WHEN '$EmpID' IS NULL THEN empID
					WHEN '$EmpID' IS NOT NULL THEN '$EmpID'
			        ELSE empID 
			    END,

			empFirstName =
				CASE
			        WHEN '$FirstName' IS NULL THEN NULL
			        WHEN '$FirstName' IS NOT NULL THEN '$FirstName'
			        ELSE empFirstName 
			    END,	

			empLastName =
				CASE
			        WHEN '$LastName' IS NULL THEN NULL
			        WHEN '$LastName' IS NOT NULL THEN '$LastName'
			        ELSE empLastName 
		        END,

		    deptID = 
				CASE
			        WHEN '$Newdept' IS NULL THEN NULL
			        WHEN '$Newdept' IS NOT NULL THEN '$Newdept'
			        ELSE deptID 
		        END,	

			typeID = 
				CASE
			        WHEN '$NewEmpType' IS NULL THEN NULL
			        WHEN '$NewEmpType' IS NOT NULL THEN '$NewEmpType'
			        ELSE typeID 
		        END,	

			empPosition = 
				CASE
			        WHEN '$newEmpPosition' IS NULL THEN NULL
			        WHEN '$newEmpPosition' IS NOT NULL THEN '$newEmpPosition'
			        ELSE empPosition 
			    END,	

			empAddress = 
				CASE
			        WHEN '$newAddress' IS NULL THEN NULL
			        WHEN '$newAddress' IS NOT NULL THEN '$newAddress'
			        ELSE empAddress 
		        END,	
		    	
		    empGender =
				CASE
			        WHEN '$newGender' IS NULL THEN NULL
			        WHEN '$newGender' IS NOT NULL THEN '$newGender'
			        ELSE empGender 
				END,

			  empStatus =
				CASE
			        WHEN '$newStatus' IS NULL THEN NULL
			        WHEN '$newStatus' IS NOT NULL THEN '$newStatus'
			        ELSE empStatus
				END
			
			
			WHERE employee.empID = '$id' ";

		$stmt = $mysqli->prepare($sql);

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
			echo 'var form = document.getElementById("employee_details");';
			echo 'form.reset();';
		echo '</script>';
	}
}


/*

$sql = "UPDATE employee SET 
			empID  = (
			CASE
		        WHEN '$EmpID' IS NULL THEN empID
		        WHEN '$EmpID' IS NOT NULL THEN '$EmpID'
		        ELSE empID END
		    ),		
			empFirstName = (
			CASE
		        WHEN '$FirstName' IS NULL THEN NULL
		        WHEN '$FirstName' IS NOT NULL THEN '$FirstName'
		        ELSE empFirstName END
		    ),	
			empLastName = (
			CASE
		        WHEN '$LastName' IS NULL THEN NULL
		        WHEN '$LastName' IS NOT NULL THEN '$LastName'
		        ELSE empLastName END
		    ),	

			deptID = (
			CASE
		        WHEN '$Newdept' IS NULL THEN NULL
		        WHEN '$Newdept' IS NOT NULL THEN '$Newdept'
		        ELSE deptID END
		    ),	

			typeID = (
			CASE
		        WHEN '$NewEmpType' IS NULL THEN NULL
		        WHEN '$NewEmpType' IS NOT NULL THEN '$NewEmpType'
		        ELSE typeID END
		    ),	

			empPosition =  (
			CASE
		        WHEN '$newEmpPosition' IS NULL THEN NULL
		        WHEN '$newEmpPosition' IS NOT NULL THEN '$newEmpPosition'
		        ELSE empPosition END
		    ),	

			empAddress =  (
			CASE
		        WHEN '$newAddress' IS NULL THEN NULL
		        WHEN '$newAddress' IS NOT NULL THEN '$newAddress'
		        ELSE empAddress END
		    ),	

			empGender = (
			CASE
		        WHEN '$newGender' IS NULL THEN NULL
		        WHEN '$newGender' IS NOT NULL THEN '$newGender'
		        ELSE empGender END
		    ),	

			empStartDate = (
			CASE
		        WHEN '$newEmpStartDate' IS NULL THEN NULL
		        WHEN '$newEmpStartDate' IS NOT NULL THEN '$newEmpStartDate'
		        ELSE empStartDate END

		        ),			
			empEndDate = (
			CASE
		        WHEN '$newEmpEndDate' IS NULL THEN NULL
		        WHEN '$newEmpEndDate' IS NOT NULL THEN '$newEmpEndDate'
		        ELSE empEndDate END
		        )
			WHERE employee.empID = '$id' ";

*/



