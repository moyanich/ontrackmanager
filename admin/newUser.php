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
		<div class="col-12 col-md-7 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">

					<form id="newUser" enctype="multipart/form-data" method="POST" action="addUser.php">

						<div class="form-row">
							<div class="col-12">
								<div class="form-group">
									<label>First Name</label>
									<input type="text" name="firstName" class="form-control" required/>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Last Name</label>
									<input type="text" name="lastName" class="form-control" required/>
								</div>
							</div>
						</div>
							
						<div class="form-row">
							<div class="col-12">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" required/>
								</div>
							</div>

							<div class="col-12">
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" required/>
								</div>
							</div>

							<div class="col-12">
								<div class="form-group">
									<label>Access Type</label>
									<select id="" name="accessType" class="form-control">
										<option value="">Select Access Type</option>
										<option value="0">Super Admin</option>
										<option value="1">Regular HR Admin</option>
										<option value="2">Security</option>
									</select>
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


	<?php 
	/* 
	* Clears form input fields 
	*/ ?>
	<script type="text/javascript">
		var form = document.getElementById("newUser");
		form.reset();
	</script>

	<!-- Footer -->
	<?php include_once("$currDir/footer.php");  ?>
	






