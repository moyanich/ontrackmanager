<?php
  $currDir = dirname(__FILE__);
  include_once("$currDir/header.php"); 
   $eid = intval($_GET['employeeID']);
?>

<!-- Begin Page Content -->
<div class="container-fluid pgEmpDetails">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Employee Profile</h1>
		<?php echo '<button class="btn btn-danger" data-toggle="modal" data-target="#delEmployee-' . $eid . '"><i class="fa fa-trash"></i> Delete Record</button>'; 
		include('modal_delEmployee.php'); ?>
	</div>

	<!-- Content Row -->
    <div class="row">
    	<div class="col-12 mb-4">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" href="pageEmployeeProfile.php?employeeID=<?php echo $eid; ?>">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="pageEmployeePhoto.php?employeeID=<?php echo $eid; ?>">Photo - #<?php echo $eid; ?></a>				
				</li>
				<li class="nav-item">
					<a class="nav-link" href="pageEmployeeLog.php?employeeID=<?php echo $eid; ?>">Attendance Log</a>
				</li>
			</ul>
			
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
			
					<?php			
					if (isset($eid) ) {
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
						if(!($stmt->bind_param('i', $eid) )) {
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
					        	$empFName	= $row['empFirstName'];
								$empLName	= $row['empLastName'];
								$empPhoto	= $row['empPhoto']; ?>

								<form id="employee_photo" class="text-left" enctype="multipart/form-data" method="POST" action="empUpdatePhoto.php<?php echo '?id='.$eid; ?>">

									<div class="form-row">
										<div class="col-12 col-md-6">
											<div class="emp-profile">
												<img class="img-fluid" src="<?php echo $empPhoto; ?>">
											</div>
										</div>

										<div class="col-12 col-md-6">
											<div class="form-group">
					                            <label>Add/Replace Employee Photo</label>
					                            <input type="file" name="newFileField" id="newfileField">

					                            <input type="hidden" name="empFName" class="form-control" value="<?php echo $empFName; ?>">
					                            <input type="hidden" name="empLName" class="form-control" value="<?php echo $empLName; ?>">
					                    	</div>

					                    	<div class="text-left">
							                    <input type="submit" name="updatePhoto" class="btn btn-info btn-sm" value="Update Photo" />
							                </div>
										</div>
									</div>
									
			                    </form>

							<?php
							}
						}
					} ?>

				</div>
			</div>
		</div>
	</div><!-- .Content Row -->


	<!-- Footer -->
	<?php include_once("$currDir/footer.php");  ?>

	<?php /* Clears form input fields */ ?>
	<script type="text/javascript">
		var form = document.getElementById("employee_photo");
		form.reset();
	</script>




		