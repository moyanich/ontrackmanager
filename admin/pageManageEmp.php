<?php
  $currDir = dirname(__FILE__);

  include_once("$currDir/header.php"); 
?>

	<!-- Begin Page Content -->
    <div class="container-fluid">
    	<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Employee List</h1>
			<a href="pageAddEmployee.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add New Employee</a>
		</div>

		<!-- Content Row -->
	    <div class="row">
			<!-- Earnings (Monthly) Card Example -->
			<div class="col-12 mb-4">
			 	<div class="card card-profile shadow">
			 		<div class="card-header py-3">
		            	<h6 class="m-0 font-weight-bold text-primary">Employee Table</h6>
		            </div>

					<div class="card-body">
						<div class="text-center">
							<?php include("employee_records.php"); ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .Content Row -->
	
		<!-- Footer -->
		<?php include("{$currDir}/footer.php"); ?>
	 </div>
  </div>












