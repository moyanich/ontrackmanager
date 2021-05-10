<!-- Modal Edit My Admin Proile -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfile" aria-hidden="true">
 	<div class="modal-dialog" role="document">
        <div class="modal-content">
        	<div class="modal-header">
                <h3 class="modal-title">Edit My Profile</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
            	<?php 
				$sql =  "SELECT * FROM user WHERE userid = ?";

				$stmt = $mysqli->prepare($sql);

				$stmt->bind_param("i", $_SESSION['superid']);

				$stmt->execute();

				$result = $stmt->get_result();

				if($result->num_rows === 0) exit('No rows');

				while($row = $result->fetch_assoc()) { 

					$id = $row['userid'];

					$access = $row['access'];

				    $firstname  = $row['firstname'];

				    $lastname   = $row['lastname'];

				    $username   = $row['username']; 

				    if ($access == '0') {
						$accessType = 'Super Admin';
					}	
					else if ($access == '1') {
						$accessType = 'Regular HR Admin';
					}	
					else if ($access == '2') {
						$accessType = 'Security';
					}

					?>

				    <form enctype="multipart/form-data" method="POST" action="updateAdminUser.php<?php echo '?id='.$id; ?>">
						<div class="form-row">	                            
							<div class="col-12">
								<div class="form-group">
									<label>First Name</label>
									<input type="text" name="adminfirstName" class="form-control" value="<?php echo $firstname; ?>">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-12">
								<div class="form-group">
									<label>Last Name</label>
									<input type="text" name="adminlastName" class="form-control" value="<?php echo $lastname; ?>">
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-12">
								<div class="form-group">
									<label>Username</label>
									<input type="text" class="form-control" value="<?php echo $username; ?>" disabled/>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12">
								<div class="form-group">
									<label>Password</label>
									<input type="text" name="adminnewpassword" class="form-control"  placeholder="Enter new password">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12">
								<div class="form-group">
									<label>Access Type</label>
									<input type="text" class="form-control" value="<?php echo $accessType; ?>" disabled/>
								</div>
							</div>
						</div>
							
						<div class="form-row">
							<div class="col-12 d-flex">
								<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button> 
								<input type="submit" name="updateMyProfile" class="btn btn-primary text-uppercase  ml-auto" value="Update">
							</div>
						</div>
	 				</form>
				<?php }?>
        	</div>
        </div>
    </div>
</div>

