
			 	<div class="card card-profile shadow">
					<div class="card-body">
						<div class="row">
                			<div class="col">
                  				<div class="card-profile-stats d-flex justify-content-center">
                    				<div><span class="heading">Employee Details</span></div>
                  				</div>
                			</div>
              			</div>

						<div class="card-content">

													
								
													<div class="row mb-3">
														<div class="col-12">
															<h5>Employee Photo</h5>
															<img class="emp-img" src="<?php echo $empPhoto; ?>">
														</div>
													</div>

													<form id=employee_details class="text-left" enctype="multipart/form-data" method="POST" action="emp_update_record.php<?php echo '?id='.$empID; ?>">
														<div class="row">
															<div class="col-12">
																<div class="form-group">
																	<label>Replace Employee Photo</label>
																	<input type="file" name="newFileField" id="fileField" class="form-control"/>
																</div>
															</div>
															

															<div class="col-12">
																<div class="form-group">
																	<label>Employee ID</label>
																	<input type="number" name="newEmpID" class="form-control" value="<?php echo $empID; ?>">
																</div>
															</div>

															<div class="col-12">
																<div class="form-group">
																	<label>First Name</label>
																	<input type="text" name="newEmpFName" class="form-control" value="<?php echo $empFname; ?>">
																</div>
															</div>
															<div class="col-12">
																<div class="form-group">
																	<label>Last Name</label>
																	<input type="text" name="Last Name" class="form-control" value="<?php echo $empLname; ?>">
																</div>
															</div>
															<div class="col-12">
																<div class="form-group">
																	<label for="newDepartment">Department</label>
					      											<select class="form-control" name="newDept">
										                                <option value="<?php echo $emptDeptID ?>"><?php echo $emptDept; ?></option>
										                                <?php
										                                    $sql = mysqli_query($mysqli, "SELECT * FROM departments WHERE DeptID != '".$row['deptID']."'");
										                                    while ($row = mysqli_fetch_array($sql)) {
										                                        $deptIDlog = $row['DeptID'];  ?>

										                                        <option value="<?php echo $deptIDlog; ?>"><?php echo $row['deptName']; ?></option>                                           
										                                    <?php
										                                    }
										                                ?>                                
										                            </select>
																</div>
															</div>
															<div class="col-12">
																<div class="form-group">
																	<label for="newEmpType">Employment Type</label>
					      											<select class="form-control" name="newEmpContract">
										                                <option value="<?php echo $empType; ?>"><?php echo $empTypeName; ?></option>
										                                <?php
										                                    $sql = mysqli_query($mysqli, "SELECT * FROM employeeType WHERE typeID != $empType");
										                                    while ($row = mysqli_fetch_array($sql)) {
										                                        $empTypelog = $row['typeID'];  ?>
										                                        <option value="<?php echo $empTypelog; ?>"><?php echo $row['employeeType']; ?></option>        
										                                    <?php
										                                    } 
										                                ?>                                
										                            </select>
																</div>
															</div>

															<div class="col-12 text-center">
																<input type="submit" class="btn btn-primary" value="Update Record" />
															</div>
														</div>
										 			</form>
												<?php
												} 
											} ?>
										</div><!--.employee-->


										<div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
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
														  $sql = mysqli_query($mysqli, "
																SELECT
																	*
															    FROM 
															    	logTBL   	
																 	LEFT JOIN employee
																    	ON logTBL.empID = employee.empID
																WHERE  
																	employee.empID = '$targetID'

																LIMIT 100
															");

															$logCount = mysqli_num_rows($sql); // count the output amount

															if ($logCount > 0) {
																while($row = mysqli_fetch_array($sql)) { 

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
													        		<td><?php echo $Lic;  ?></td>
													        		<td><?php echo $comments; ?></td>
													        	</tr>
																<?php	
																}	
															}
														?>
													</tbody>
												</table>
											</div>
										</div><!--.history-->
