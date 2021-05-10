<?php
  $currDir = dirname(__FILE__);

  include_once("$currDir/header.php"); 

?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Add New Employee</h1>
	</div>

	<!-- Content Row -->
    <div class="row">
		<!-- Employee List-->
		<div class="col-12 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<form id="empInsertion" enctype="multipart/form-data" method="POST" action="emp_insert_record.php">
						<!--<div class="form-row">
							<div class="col-12">
								<div class="form-group">
									<label class="control-label " for="textarea">Employee Photo<span class="red">*</span></label>
									<input type="file" name="fileField" id="fileField" />
								</div>
							</div>
						</div>-->

						<div class="form-row">
							<div class="col-4">
								<div class="form-group">
									<label>Employee ID Number<span class="red">*</span></label>
									<input type="number" name="empID" class="form-control">
								</div>
							</div>

							<div class="col-4">
								<div class="form-group">
									<label>First Name<span class="red">*</span></label>
									<input type="text" name="empFName" class="form-control">
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label>Last Name<span class="red">*</span></label>
									<input type="text" name="empLName" class="form-control">
								</div>
							</div>

						</div>
							
						<div class="form-row">
							<div class="col">
								<div class="form-group">
									<label>Gender<span class="red">*</span></label>
									<select name="empGender" class="form-control" >
										<option>Male</option>
										<option>Female</option>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label>Position/Post</label>
									<input type="text" name="empPosition" class="form-control" placeholder="Position">
								</div>
							</div>
							<!--<div class="col">
								<div class="form-group">
									<label>Employment Start Date<span class="red">* (YYYY-MM-DD)</span></label>
									<div class="input-group">
								      	<input type="text" id="admindatetimepicker" name="empStartDate" value="" class="form-control" data-toggle="admindatetimepicker">
								      	<div class="input-group-append">
								      		<span class="input-group-text"><i class="ni ni-calendar-grid-58" aria-hidden="true"></i></span>
							      		</div>    				
									</div>
								</div>
							</div>-->
						</div>


						<div class="form-row">
							<div class="col">
								<div class="form-group">
									<label>Department<span class="red">*</span></label>
										<select id="department" name="empDept" class="form-control">
											<option value="">Select Department</option>
											<?php
                        				$dept = "SELECT * FROM departments ORDER BY deptName ASC";
                        				
										if ($stmt = $mysqli->prepare($dept)) {
										    $stmt->execute();
										    $result = $stmt->get_result();
										    while ($row = $result->fetch_assoc()) { ?>
										        <option value="<?php echo $row['DeptID']; ?>"><?php echo $row['deptName']; ?></option>
										<?php
										    }
										    $stmt->close();
										}
										?>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label>Employment Type<span class="red">*</span></label>
										<select id="empType" name="empContract" class="form-control">
										<option value="">Select Employment Type</option>
											<?php
                        				$type = "SELECT * FROM employeeType ORDER BY employeeType ASC";
                        				
										if ($stmtType = $mysqli->prepare($type)) {
										    $stmtType->execute();
										    $result = $stmtType->get_result();
										    while ($row = $result->fetch_assoc()) { ?>
										        <option value="<?php echo $row['typeID']; ?>"><?php echo $row['employeeType']; ?></option>
										<?php
										    }
										    $stmtType->close();
										}
										?>
									</select>
								</div>
							</div>	
						</div>

						<div class="form-row">									
							<div class="col-12">
								<div class="form-group">
									<label>Address</label>
									<textarea name="empAddress" class="form-control" placeholder="Address"></textarea> 
								</div>
							</div>
						</div>

						<div class="form-row">

							<div class="col-12 text-center">
								<input type="submit" class="btn btn-primary" value="Submit">
							</div>
						</div>
		 			</form>
				</div>
			</div>
		</div>

	</div><!-- .Content Row -->

	<script type="text/javascript">
		//Clears form input fields 
		var form = document.getElementById("empInsertion");
		form.reset();
	</script>
	<!-- Footer -->
	<?php include_once("$currDir/footer.php");  ?>
	
	






