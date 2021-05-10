<?php
	$currDir = dirname(__FILE__);
	
	include_once("$currDir/header.php"); 
?>

	<!-- Begin Page Content -->
    <div class="container-fluid">
		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
			<a href="reports.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
		</div>

	    <!-- Content Row -->
		<div class="row">
			<!-- Log -->
			<div class="col-12">
          		<div class="card shadow mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Attendance Log - <span><?php $todaysDate =  date("M d, Y"); echo $todaysDate; ?></span></h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						<?php include("empLogQueryNow.php"); ?>
					</div>
				</div>
			</div>

			<!-- Log -->
			<?php /*
			<div class="col-12">
          		<div class="card shadow mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Attendance Log - Last 15 Days</span></h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						<?php include("empLogRecordQuery.php"); ?>
					</div>
				</div>
			</div> */ ?>
		</div><!-- .Content Row -->
          
		<!-- Footer -->
		<?php include("{$currDir}/footer.php"); ?>
	 </div>
  </div>





