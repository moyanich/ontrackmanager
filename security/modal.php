<!-- Modal Edit My Admin Proile -->
<div class="modal fade" id="editSecurity" tabindex="-1" role="dialog" aria-labelledby="editSecurity" aria-hidden="true">
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

				$stmt->bind_param("i", $_SESSION['sid']);

				$stmt->execute();

				$result = $stmt->get_result();

				if($result->num_rows === 0) exit('No rows');

				while($row = $result->fetch_assoc()) { 

					$id = $row['userid'];

					$access = $row['access'];

				    $secfirstname  = $row['firstname'];

				    $lastname   = $row['lastname'];

				    $username   = $row['username']; ?>

				    <form enctype="multipart/form-data" method="POST" action="updateSecUser.php<?php echo '?id='.$id; ?>">
						<div class="form-row">	                            
							<div class="col-12">
								<div class="form-group">
									<label>First Name</label>
									<input type="text" name="secfirstName" class="form-control" value="<?php echo $secfirstname; ?>" disabled />
								</div>
							</div>
						</div>

						<div class="form-row">
							<div class="col-12">
								<div class="form-group">
									<label>Last Name</label>
									<input type="text" name="seclastName" class="form-control" value="<?php echo $lastname; ?>" disabled />
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
									<input type="text" name="secnewpassword" class="form-control" placeholder="Enter new password">
								</div>
							</div>
						</div>
					
						<div class="form-row">
							<div class="col-12 d-flex">
								<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button> 
								<input type="submit" name="updateSecurityUser" class="btn btn-primary text-uppercase ml-auto" value="Update">
							</div>
						</div>
	 				</form>

				<?php } ?>

        	</div>
        </div>
    </div>
</div>

