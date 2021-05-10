<!-- Modal Edit User -->
<div class="modal fade" id="editUser-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myeditUser" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit User Informaton</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
            	<?php
				//If connect fails display message
				if($mysqli->connect_error) {
					die("Database Connection Failed: " . $mysqli->connect_error);
				}

				//1. Prepare statement
				if(!($stmt = $mysqli->prepare("SELECT * FROM user WHERE userid = ?"))) {
					echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
				}

				//2. bind
				if(!($stmt->bind_param('i', $id) )) {
					echo 'Binding parameters failed: (' . $mysqli->errno . ') ' . $stmt->error;
				}

				//3. execute
				if(!($stmt->execute() ) ) {
					echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
				}

				$empResult = $stmt->get_result();

				if($empResult->num_rows === 0) { exit('No rows'); } // count the output amount

				    else { 

				        while ($row = $empResult->fetch_assoc()) {

				        	$id = $row['userid'];

							$firstname	= $row['firstname'];

							$lastname	= $row['lastname'];

							$username	= $row['username'];

							$access = $row['access'];

							
							if ($access == '0') {
								$accessType = 'Super Admin';
							}	
							else if ($access == '1') {
								$accessType = 'Regular HR Admin';
							}	
							else if ($access == '2') {
								$accessType = 'Security';
							}
							else if ($access == '3') {
								$accessType = 'Disabled User';
							} 

							/*$accessType .= 'Super Admin';
							$accessType .= 'Regular HR Admin';
							$accessType .=  'Security';
							$accessType .= 'Disabled User'; */




						?>


		            	<form enctype="multipart/form-data" method="POST" action="updateUser.php<?php echo '?id='.$id; ?>">
							<div class="form-row">
								
		                        <input type="hidden" name="accessID" class="form-control" value="<?php echo $id; ?>">
		                            
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" name="newfirstName" class="form-control" value="<?php echo $firstname; ?>">
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="newlastName" class="form-control" value="<?php echo $lastname; ?>">
									</div>
								</div>
							</div>

							<div class="form-row">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="newusername" class="form-control" value="<?php echo $username; ?>">
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Password</label>
										<input type="text" name="newpassword" class="form-control">
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label>Access Type</label>

										<select name="newaccessType" class="form-control">
		                                    <option value="<?php echo $access; ?>"><?php echo $accessType; ?></option>

		                                    <?php
		                                      $stmtType = $mysqli->prepare("SELECT accessID FROM accesstype WHERE accessID != ?");
		                                      $stmtType->bind_param('i', $access);
		                                      $stmtType->execute();
		                                      $result = $stmtType->get_result();

		                                        if ($result->num_rows > 0) { // count the output amount
		                                            while ($rowType = $result->fetch_assoc()) {
		                                                $access2 = $rowType['accessID'];  

		                                                
		                                                if ($access2 == '0') {
															$accessType2 = 'Super Admin';
														}	
														else if ($access2 == '1') {
															$accessType2 = 'Regular HR Admin';
														}	
														else if ($access2 == '2') {
															$accessType2 = 'Security';
														}
														else if ($access2 == '3') {
															$accessType2 = 'Disabled User';
														} 

														?>
														

		                                               	<option value="<?php echo $access2; ?>"><?php echo $accessType2; ?></option>     
		                                            <?php
		                                            }
		                                        } 
		                                        $stmtType->close(); 
		                                    ?>                            
		                                   
		                                    <?php

		                                    /*
		                                      $stmtType = $mysqli->prepare("SELECT DISTINCT(access) FROM user WHERE access != ?");
		                                      $stmtType->bind_param('i', $access);
		                                      $stmtType->execute();
		                                      $result = $stmtType->get_result();

		                                        if ($result->num_rows > 0) { // count the output amount
		                                            while ($rowType = $result->fetch_assoc()) {
		                                                $access2 = $rowType['access'];  

		                                                /*
		                                                if ($access2 == '0') {
															$accessType2 = 'Super Admin';
														}	
														else if ($access2 == '1') {
															$accessType2 = 'Regular HR Admin';
														}	
														else if ($access2 == '2') {
															$accessType2 = 'Security';
														}
														else if ($access2 == '3') {
															$accessType2 = 'Disabled User';
														} */ /*

														
														?>
														

		                                               	<!--<option value="<?php echo $access2; ?>"><?php echo $accessType2; ?></option>-->	        
		                                            <?php
		                                            }
		                                        } 
		                                        $stmtType->close(); */
		                                    ?>                                
		                                </select>
										
									</div>
								</div>
							</div>
								
							<div class="form-row">
								<div class="col-12 text-center">
									<input type="submit" name="updateUser" class="btn btn-primary" value="update">
								</div>
							</div>
		 				</form>

						<?php 
				        }
				    } 
				?>
            </div>
        </div>
    </div>
</div>





<?php






/*
	include('session.php');
	
	$cpass=md5($_POST['cpass']);
	$repass=md5($_POST['repass']);
	
	if($cpass!=$repass) {
		?>
		<script>
			window.alert('Required passwords did not match. Account not updated!');
			window.history.back();
		</script>
		<?php
	}
	elseif($cpass!=$srow['password']) {
		?>
		<script>
			window.alert('Current password did not match. Account not updated!');
			window.history.back();
		</script>
		<?php
	}
	else {
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		if($password==$srow['password']) {
			$fipassword=$password;
		}
		else {
			$fipassword=md5($password);
		}
		mysqli_query($conn,"update `user` set username='$username', password='$fipassword' where userid='".$_SESSION['id']."'");
		mysqli_query($conn,"insert into activitylog (userid,action,activity_date) values ('".$_SESSION['id']."','Update account',NOW())");
		?>
		<script>
			window.alert('Account updated successfully!');
			window.history.back();
		</script>
		<?php
	}
	*/


?>