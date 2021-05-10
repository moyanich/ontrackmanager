<?php
/*
* Template to insert a record into the program
*/

include('session.php');

function check_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$id 		= $_POST['empID']; 
$fName		= check_input($_POST['empFName']);
$LName 		= check_input($_POST['empLName']);
$department	= check_input($_POST['empDept']);
$empType 	= check_input($_POST['empContract']);	
$empAddress = check_input($_POST['empAddress']);
$empGender 	= check_input($_POST['empGender']);
$empPosition	= check_input($_POST['empPosition']);

//$empStartDate = check_input($_POST['empStartDate']);

try {

	/*try {
		$newname = $fName . '-' . $LName . '.jpg';
		$newname = preg_replace('/\s+/', '-', $newname);

		if (!isset($_FILES['fileField']['error']) || is_array($_FILES['fileField']['error'])) {
			throw new RuntimeException('Invalid parameters.');
		}

	    // Check $_FILES['upfile']['error'] value.
	    switch ($_FILES['fileField']['error']) {
	        case UPLOAD_ERR_OK:
	            break;
	        //case UPLOAD_ERR_NO_FILE:
	            //throw new RuntimeException('No file sent.');
	        case UPLOAD_ERR_INI_SIZE:
	        case UPLOAD_ERR_FORM_SIZE:
	            throw new RuntimeException('Exceeded filesize limit.');
	        default:
	            throw new RuntimeException('Unknown errors.');
	    }

		// You should also check filesize here. 
	    if ($_FILES['fileField']['size'] > 10000000) {
	        throw new RuntimeException('Exceeded filesize limit.');
	    }

	    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
	    // Check MIME Type by yourself.
	    $finfo = new finfo(FILEINFO_MIME_TYPE);
	    if (false === $ext = array_search(
	    	$finfo->file($_FILES['fileField']['tmp_name']),
		        array(
		            'jpg' => 'image/jpeg',
		            'png' => 'image/png',
		        ),
		        true
		    )) {
		    throw new RuntimeException('Invalid file format.');
		}

	    // You should name it uniquely.
	    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
	    // On this example, obtain safe unique name from its binary data.

	    if (!move_uploaded_file($_FILES['fileField']['tmp_name'], "../images/staff/$newname")) {
	        throw new RuntimeException('Failed to move uploaded file.');
	    }
	    
	    $file="../images/staff/".$newname;
		echo 'File is uploaded successfully.';

	} catch (RuntimeException $e) {
	   	echo $e->getMessage();
	} 
	*/
	

	//If connect fails display message
	if($mysqli->connect_error) {
		die("Database Connection Failed: " . $mysqli->connect_error);
	}

	//1. Prepare statement
	/*if(!($stmt = $mysqli->prepare("INSERT INTO employee (empID, empFirstName, empLastName, deptID, typeID, empPosition, empAddress, empGender, created_date, created_by, empPhoto, empStartDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), '".$_SESSION['superid']."', '$file', '$empStartDate')"))) {
		echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
	} 

	if(!($stmt = $mysqli->prepare("INSERT INTO employee (empID, empFirstName, empLastName, deptID, typeID, empPosition, empAddress, empGender, created_date, created_by, empStartDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), '".$_SESSION['superid']."', '$empStartDate')"))) {
		echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}

	*/

	//1. Prepare statement
	if(!($stmt = $mysqli->prepare("INSERT INTO employee (empID, empFirstName, empLastName, deptID, typeID, empPosition, empAddress, empGender, created_date, created_by, empStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), '".$_SESSION['superid']."', 'No')"))) {
		echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}
	
	//2. bind
	if(!($stmt->bind_param('issiisss', $id, $fName, $LName, $department, $empType, $empPosition, $empAddress, $empGender) )) {
		echo 'Binding parameters failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}

	//3. execute
	if(!($stmt->execute() ) ) {
		echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	echo '<script>';
		echo 'window.alert("New employee record created");';
		echo 'window.history.back();';
	echo '</script>';

	$stmt->close();

} catch(RuntimeException $e) {
	echo $e->getMessage();
	
	if($mysqli->errno === 1062) echo 'Duplicate entry .' . $e->getMessage();

	echo '<script>';
		echo 'window.alert("Employee already exists");';
		echo 'window.history.back();';
	echo '</script>';
}


/*

echo 'id -';
var_dump($id);
echo '<br/>';
echo 'fname -';
var_dump($fName);
echo '<br/>';
echo 'lname -';
var_dump($LName);
echo '<br/>';
echo 'dept -';
var_dump($dept );
echo '<br/>';
echo 'type -';
var_dump($empType);


*/



?>


