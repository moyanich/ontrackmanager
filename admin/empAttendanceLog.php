<!-- Employee Log-->
<?php /*
<div class="card border-left-primary shadow h-100 py-2 emp-card">
	<div class="card-header">
		<h6 class="m-0 font-weight-bold text-primary">Employee Attendance</h6>
	</div> 
	<div class="card-body">

		<div class="table-responsive">
			<table class="table align-items-center text-left" id="historyTable">
				<thead class="thead-light">
		          	<tr>
		          		<th scope="col">Log ID</th>
						<th scope="col">Name</th>
						<th scope="col">Date IN</th>
						<th scope="col">Time IN</th>
						<th scope="col">Date Out</th>
						<th scope="col">Time Out</th>
						<th scope="col">Licence</th>
						<th scope="col">Comments</th>
		          	</tr>
			    </thead>
			    <tbody>
			    	<?php
					$targetID = "";
					if (isset($_GET['employeeID'])) {

						$targetID = $_GET['employeeID']; //get id from url
						if( ! is_numeric($targetID) )
					  	die('invalid id');
							
						//If connect fails display message
						if($mysqli->connect_error) {
							die("Database Connection Failed: " . $mysqli->connect_error);
						}

						//1. Prepare statement
						if(!($stmt = $mysqli->prepare("SELECT
								*
						    FROM 
						    	logTBL   	
							 	LEFT JOIN employee
							    	ON logTBL.empID = employee.empID
							WHERE  
								employee.empID = ?

							LIMIT 100") )) {
							echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
						}

						//2. bind
						if(!($stmt->bind_param('i', $targetID) )) {
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
								$logID		= $row['logID'];

								$empID		= $row['empID'];

								$empFname	= $row['empFirstName'];

								$empLname	= $row['empLastName']; 
								
								$dateIN		= $row['dateIN'];

								$timeIN		= $row['timeIN'];

								$timeIN 	= date("g:i a", strtotime($timeIN));

								$dateOUT	= $row['dateOUT'];

								$timeOUT	= $row['timeOUT'];

								$timeOUT 	= date("g:i a", strtotime($timeOUT));

								$Lic 		= $row['licNumber'];

								$comments 	= $row['comments'];
								?>

					        	<tr> 
					        		<td><?php echo $logID; ?></td>
					        		<td><?php echo $empFname . ' ' . $empLname; ?></td>
					        		<td><?php echo $dateIN; ?></td>
					        		<td><?php echo $timeIN; ?></td>
					        		<td><?php echo $dateOUT; ?></td>
					        		<td><?php echo $timeOUT; ?></td>
					        		<td class="text-uppercase"><?php echo $Lic;  ?></td>
					        		<td><?php echo $comments; ?></td>
					        	</tr>
								<?php
							} //endWhile
						} //endElse
					} //endIf
					$stmt->close(); ?>
				</tbody>
			</table>
		</div>
	</div>
</div>














-----------

















<?php
  $currDir = dirname(__FILE__);
  include_once("$currDir/header.php"); 
?>

<!-- Begin Page Content -->
<div class="container-fluid pgEmpDetails">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Employee Profile</h1>
		<?php
		$delID = "";
		if (isset($_GET['employeeID'])) {
			$delID= $_GET['employeeID']; //get id from url

			if( ! is_numeric($delID) ) ('invalid id');
		
			echo '<button class="btn btn-danger" data-toggle="modal" data-target="#delEmployee_' . $delID . '"><i class="fa fa-trash"></i> Delete Record</button>'; 
			include_once('modal_delEmployee.php'); 
	 	} ?>

	</div>

	<!-- Content Row -->
    <div class="row">
    	<div class="col-12 mb-4">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="log-tab" data-toggle="tab" href="#log" role="tab" aria-controls="log" aria-selected="false">Attendance Log</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<!-- Employee List-->
					<div class="card border-left-primary shadow h-100 py-2 emp-card">
						<div class="card-body">
					  		<?php
							$targetID = "";
							if (isset($_GET['employeeID'])) {

								$targetID = $_GET['employeeID']; //get id from url
								if( ! is_numeric($targetID) )
							  	die('invalid id');
									
								//If connect fails display message
								if($mysqli->connect_error) {
									die("Database Connection Failed: " . $mysqli->connect_error);
								}

								//1. Prepare statement
								if(!($stmt = $mysqli->prepare("SELECT * 
									FROM employee
									LEFT JOIN departments ON departments.DeptID = employee.deptID
									LEFT JOIN employeeType ON employeeType.typeID = employee.typeID
									WHERE employee.empID = ? LIMIT 1"))) {
									echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
								}

								//2. bind
								if(!($stmt->bind_param('i', $targetID) )) {
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

										$employeeID = $row['empID'];

										$empFName	= $row['empFirstName'];

										$empLName	= $row['empLastName'];

										$emptDeptID	= $row['deptID'];

										$deptName	= $row['deptName'];

										$empType 	= $row['typeID'];

										$empTypeName = $row['employeeType'];

										$empPosition = $row['empPosition'];

										$empAddress	= $row['empAddress']; 

										$gender 	= $row['empGender']; 

										$startDate	= $row['empStartDate']; 

										$endDate	= $row['empEndDate']; 

										$empPhoto	= $row['empPhoto'];

										?>

										<div class="card-header">
											<h6 class="m-0 font-weight-bold text-primary">Employee Profile<span style="float: right;">Status: <strong><?php if ($endDate === null) { echo '<span class="green">Active</span>'; } else { echo '<span class="red">Not Active</span>';}?></strong></span></h6>
										</div> 
										
										<div class="card-body">
											<div class="row">
												<div class="col-8">
													<form id="employee_details" class="text-left" enctype="multipart/form-data" method="POST" action="emp_update_record.php<?php echo '?id='.$employeeID; ?>">
															
														<div class="form-row">
															<div class="col-3">
									                            <div class="form-group">
									                                <label>Employee ID</label>
									                                <input type="number" name="newEmpID" class="form-control" value="<?php echo $employeeID; ?>">
									                            </div>
									                        </div>

								                            <div class="col">
									                            <div class="form-group">
									                                <label>First Name</label>
									                                <input type="text" name="newFirstName" class="form-control" value="<?php echo $empFName; ?>">
									                            </div>
									                        </div>
									                        <div class="col">
									                            <div class="form-group">
									                                <label>Last Name</label>
									                                <input type="text" name="newLastName" class="form-control" value="<?php echo $empLName; ?>">
									                            </div>
									                        </div>
									                    </div><!--form-row-->
									                   
								                        <div class="form-row">
									                    	<div class="col">
									                            <div class="form-group">
									                                <label>Gender</label>
									                                <select class="form-control" name="newGender">
									                                    <?php 
									                                    echo '<option value="' . $gender . '">' . $gender . '</option>';
									                                    if ($gender == null) { 
									                                        echo '<option value="Male">Male</option>';
									                                        echo '<option value="Female">Female</option>';
									                                    }
									                                    else if ($gender == 'Male') {
									                                    	echo '<option value="Female">Female</option>';
									                                    }
									                                    else {
									                                    	 echo '<option value="Male">Male</option>';
									                                    }
									                                    ?>                                
									                                </select>  
									                            </div>
									                        </div>

									                        <div class="col">
									                            <div class="form-group">
									                                <label>Position</label>
									                                <input type="text" name="newEmpPosition" class="form-control" value="<?php echo $empPosition; ?>">
									                            </div>
									                        </div>
									                        <div class="col">
									                            <div class="form-group">
									                                <label for="newDepartment">Department</label>
									                                <select class="form-control" name="newDept">
									                                    <option value="<?php echo $emptDeptID ?>"><?php echo $row['deptName']; ?></option>
									                                    <?php
									                                        $stmtDept = $mysqli->prepare("SELECT * FROM departments WHERE DeptID != '".$emptDeptID."'");
									                                        $stmtDept->execute();
									                                      	$resultDept = $stmtDept->get_result();

									                                      	if ($resultDept->num_rows > 0) { // count the output amount
									                                            while ($rowDept = $resultDept->fetch_assoc()) {
										                                            $deptIDlog = $rowDept['DeptID'];  ?>

										                                            <option value="<?php echo $deptIDlog; ?>"><?php echo $rowDept['deptName']; ?></option>     
									                                        <?php }
									                                        } $stmtDept->close();
									                                    ?>                                
									                                </select>
									                            </div>
									                        </div>
									                    </div><!--form-row-->

									                    <div class="form-row">
									                        <div class="col">
									                            <div class="form-group">
									                                <label for="newEmpType">Employment Type</label>
									                                <select class="form-control" name="newEmpType">
									                                    <option value="<?php echo $empType; ?>"><?php echo $empTypeName; ?></option>
									                                    <?php
									                                      $stmtType = $mysqli->prepare("SELECT * FROM employeeType WHERE typeID != '$empType'");
									                                      //$stmtType->bind_param('i', $empType);
									                                      $stmtType->execute();
									                                      $resultType = $stmtType->get_result();

									                                        if ($resultType->num_rows > 0) { // count the output amount
									                                            while ($rowType = $resultType->fetch_assoc()) {
									                                                $empTypeID = $rowType['typeID'];  ?>
									                                                <option value="<?php echo $empTypeID; ?>"><?php echo $rowType['employeeType']; ?></option>
									                                            <?php
									                                            }
									                                        } 
									                                        $stmtType->close();
									                                    ?>                                
									                                </select>
									                            </div>
									                        </div>

									                        <div class="col">
									                            <div class="form-group">
									                                <label>Employment Start Date</label>
									                                <div class="input-group">
									                                     <?php
									                                        /*
									                                            * Check if Time IN value is set 
									                                            * If the row is emoty output an empty value
									                                        */ 
									                                        /*
									                                        if (is_null($row['empStartDate'])) {
									                                            $startDate = '';
									                                        } else {
									                                            $startDate = $row['empStartDate'];
									                                        }
									                                     ?>
									                                    <input type="text" id="admindatestarttimepicker" name="newEmpStartDate" value="<?php echo $startDate; ?>"  class="form-control" data-toggle="admindatestarttimepicker">
									                                    <div class="input-group-append">
									                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58" aria-hidden="true"></i></span>
									                                    </div>                  
									                                </div>
									                            </div>
									                        </div>

									                        <div class="col">
									                            <div class="form-group">
									                                <label>Employment End Date</label>
									                                <div class="input-group">
									                                    <?php
									                                        /*
									                                            * Check if Time IN value is set 
									                                            * If the row is emoty output an empty value
									                                        */
									                                        /*if (is_null($row['empEndDate'])) {
									                                            $endDate = 'NULL';
									                                        } else {
									                                            $endDate = $row['empEndDate'];
									                                        } */
									                                        /*
									                                     ?>
									                                    <input type="text" id="admindateendtimepicker" name="newEmpEndDate" value="<?php echo $endDate; ?>" class="form-control" data-toggle="admindateendtimepicker">
									                                    <div class="input-group-append">
									                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58" aria-hidden="true"></i></span>
									                                    </div>                  
									                                </div>
									                            </div>
									                        </div>
									                    </div><!--form-row-->

									                    <div class="form-row">
									                        <div class="col-12">
									                            <div class="form-group">
									                                <label>Address</label>
									                                <textarea name="newAddress" class="form-control"><?php echo $empAddress; ?></textarea>  
									                            </div>
									                        </div>
									                    </div>

														<div class="text-center">
									                        <input type="submit" name="update" class="btn btn-primary" value="Update Record" />
									                    </div>
														
							                		</form>  
						            			</div>

							            			<div class="col-4">
														<form id="employee_photo" class="text-left" enctype="multipart/form-data" method="POST" action="empUpdatePhoto.php<?php echo '?id='.$employeeID; ?>">

															<div class="form-row">
																<div class="emp-profile">
																	<img class="img-fluid" src="<?php echo $empPhoto; ?>">
																</div>
															</div>

															<div class="form-group">
								                                <label>Replace Employee Photo</label>
								                                <input type="file" name="newFileField" id="newfileField">

								                                <input type="hidden" name="empFName" class="form-control" value="<?php echo $empFName; ?>">
								                                <input type="hidden" name="empLName" class="form-control" value="<?php echo $empLName; ?>">
								                        	</div>

								                        	<div class="text-center">
											                    <input type="submit" name="updatePhoto" class="btn btn-info btn-sm" value="Update Photo" />
											                </div>

								                        </form>
							                        </div>
								            	</div>

											<?php
											} //endWhile
										} //endElse
									} //endIf
									$stmt->close();
									?>
								</div>
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="log" role="tabpanel" aria-labelledby="log-tab">
					<!-- Employee Log-->
					<div class="card border-left-primary shadow h-100 py-2 emp-card">
						<div class="card-header">
							<h6 class="m-0 font-weight-bold text-primary">Employee Attendance</h6>
						</div> 
						<div class="card-body">

							<div class="table-responsive">
								<table class="table align-items-center text-left" id="historyTable">
									<thead class="thead-light">
							          	<tr>
							          		<th scope="col">Log ID</th>
											<th scope="col">Name</th>
											<th scope="col">Date IN</th>
											<th scope="col">Time IN</th>
											<th scope="col">Date Out</th>
											<th scope="col">Time Out</th>
											<th scope="col">Licence</th>
											<th scope="col">Comments</th>
							          	</tr>
								    </thead>
								    <tbody>
								    	<?php
										$targetID = "";
										if (isset($_GET['employeeID'])) {

											$targetID = $_GET['employeeID']; //get id from url
											if( ! is_numeric($targetID) )
										  	die('invalid id');
												
											//If connect fails display message
											if($mysqli->connect_error) {
												die("Database Connection Failed: " . $mysqli->connect_error);
											}

											//1. Prepare statement
											if(!($stmt = $mysqli->prepare("SELECT
													*
											    FROM 
											    	logTBL   	
												 	LEFT JOIN employee
												    	ON logTBL.empID = employee.empID
												WHERE  
													employee.empID = ?

												LIMIT 100") )) {
												echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
											}

											//2. bind
											if(!($stmt->bind_param('i', $targetID) )) {
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
													$logID		= $row['logID'];

													$empID		= $row['empID'];

													$empFname	= $row['empFirstName'];

													$empLname	= $row['empLastName']; 
													
													$dateIN		= $row['dateIN'];

													$timeIN		= $row['timeIN'];

													$timeIN 	= date("g:i a", strtotime($timeIN));

													$dateOUT	= $row['dateOUT'];

													$timeOUT	= $row['timeOUT'];

													$timeOUT 	= date("g:i a", strtotime($timeOUT));

													$Lic 		= $row['licNumber'];

													$comments 	= $row['comments'];
													?>

										        	<tr> 
										        		<td><?php echo $logID; ?></td>
										        		<td><?php echo $empFname . ' ' . $empLname; ?></td>
										        		<td><?php echo $dateIN; ?></td>
										        		<td><?php echo $timeIN; ?></td>
										        		<td><?php echo $dateOUT; ?></td>
										        		<td><?php echo $timeOUT; ?></td>
										        		<td class="text-uppercase"><?php echo $Lic;  ?></td>
										        		<td><?php echo $comments; ?></td>
										        	</tr>
													<?php
												} //endWhile
											} //endElse
										} //endIf
										$stmt->close(); ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div><!--tab-log-->
			</div><!--tab-content-->
		</div>
	
	</div><!-- .Content Row -->


	<!-- Footer -->
	<?php include_once("$currDir/footer.php");  ?>

	<?php /* Clears form input fields */ /* ?>
	<script type="text/javascript">
		var form = document.getElementById("employee_details");
		form.reset();
	</script>

*/ ?>


