<?php
  $currDir = dirname(__FILE__);

  include_once("$currDir/header.php"); 
?>


<body>
	<?php include("{$currDir}/sidebar.php"); ?>
  	<!-- Main content -->
  	<div class="main-content">
		<!-- Top navbar -->
		<?php include("{$currDir}/topNavbar.php"); ?>

	 <!-- Header -->
	<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 300px; background-size: cover; background-position: center top;">
		<!-- Mask -->
		<span class="mask bg-gradient-default opacity-8"></span>
		<!-- Header container -->
		<div class="container-fluid d-flex align-items-center">
			<div class="row">
				<div class="col-lg-7 col-md-10">
					<a href="pageAddEmployee.php" class="btn btn-info">Add New Employee</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Page content -->
	<div class="container-fluid mt--7">
		<div class="row">
		  	<div class="col-12 mb-5 mb-xl-0">
			 	<div class="card card-profile shadow">
					<div class="card-body">
						<div class="row">
                			<div class="col">
                  				<div class="card-profile-stats d-flex justify-content-center">
                    				<div><span class="heading">Employee List</span></div>
                  				</div>
                			</div>
              			</div>
						<div class="card-content">
							
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<?php include_once("$currDir/footer.php");  ?>



