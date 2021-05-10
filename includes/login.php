<?php
/*
 *
 * Page: Login library
 * 
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Database connection
	require 'config.php';
	
	function check_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$username = check_input($_POST['username']);
	
	if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
		$_SESSION['msg'] = "Username should not contain space and special characters!"; 
		header('Location: ../index.php');
	} 

	else {
		$username = check_input($_POST['username']);			
		$pwd = check_input($_POST["loginPassword"]);
		$encrypt_pass = md5($pwd);


		//$encrypt_pass = password_hash($pwd, PASSWORD_DEFAULT);
		//$encrypt_pass = md5($pwd, PASSWORD_DEFAULT);

		//$encrypt_pass = password_hash($pwd, PASSWORD_BCRYPT, ["cost"=>8]);
		

		$sql = "SELECT * FROM user WHERE username=? AND password=?";
		$stmt = $mysqli->prepare($sql);
		
		if(!$stmt) {
			header('Location: ../index.php?error=sqlerror');
			exit();
		} 
		
		else {
			// Bind parameters
			$stmt->bind_param("ss", $username, $encrypt_pass); //pass user data into database
			// Execute query
			$stmt->execute();
			$result = $stmt->get_result();

			if($result->num_rows === 0) { 
				echo '<script>';
					echo 'window.alert("Login Failed, Invalid Input!");';
					echo 'window.location.href = "../index.php"';
				echo '</script>'; 
			}

			else {

				while ($row = $result->fetch_assoc()) {
			
					//$pwdCheck = password_verify($encrypt_pass, $pwd); //check password of user to one in database
					
					if ($encrypt_pass  == false) { 
						header('Location: ../index.php?error=pwd_nouser');
						exit(); 
					}

					else if ($encrypt_pass  == true) {
						echo 'password true';

						if ($row['access']==0 || $row['access']==1 ) { //Super Admin
							session_start();
							$_SESSION['superid']=$row['userid'];	
							
							/* Update user log */
							$loginStmt = $mysqli->prepare("UPDATE user SET last_login = now() WHERE userid=?");
							$loginStmt->bind_param("i", $_SESSION['superid']);
							$loginStmt->execute();
							$loginStmt->close();
							
							header('Location: ../admin/dashboard.php');	
							exit();		
						} 

						if ($row['access']==1) { //HR Admin
							session_start();
							$_SESSION['adminid']=$row['userid'];	
							
							/* Update user log */ 
							$loginStmt = $mysqli->prepare("UPDATE user SET last_login = now() WHERE userid=?");
							$loginStmt->bind_param("i", $_SESSION['adminid']);
							$loginStmt->execute();
							$loginStmt->close();
							
							header('Location: ../admin_user/dashboard.php');	
							exit();		
						} 

						else if ($row['access']==2) { 	//Security
							session_start();
							$_SESSION['sid']=$row['userid'];	
							
							/* Update user log */  
							$loginStmt = $mysqli->prepare("UPDATE user SET last_login = now() WHERE userid=?");
							$loginStmt->bind_param("i", $_SESSION['sid']);
							$loginStmt->execute();
							$loginStmt->close();
							
							header('Location: ../security/dashboard.php');
							exit();		
						} 


						else if ($row['access']==3) { 	//Security
							session_start();
							$_SESSION['disabledid']=$row['userid'];	

							echo '<script>';
								echo 'window.alert("User Account is Disabled. Please contact the Administrator");';
								echo 'window.location.href = "../index.php"';
							echo '</script>'; 
							exit();		
						} 
					}

					else {
						header('Location: ../index.php?error=nouser_exists');
						exit();					
					} 
				}
			}  
			$stmt->close();
		} 
	} 
}

else {
	header('Location: ../index.php');
	exit();
}

