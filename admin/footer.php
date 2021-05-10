<?php
	$currDir = dirname(__FILE__);

	include("{$currDir}/session.php");

	if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '../');  
?>

 		</div>
        <!-- /.container-fluid -->

      </div>
      	<!-- End of Main Content -->
			
		<!-- Footer -->
		<footer class="sticky-footer bg-white">
			<div class="container my-auto">
			  <div class="copyright text-center my-auto">
			    <span>Copyright &copy; Jamaica Business Development Corporation <?php echo date('Y'); ?></span>
			  </div>
			</div>
		</footer>
		<!-- End of Footer -->

	</div>
	<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->


<?php	
$today = date("Y-m-d");
$sql = "SELECT
		*
    FROM 
    	logTBL   	
	 	LEFT JOIN employee ON logTBL.empID = employee.empID
	 	LEFT JOIN user ON logTBL.userid = user.userID
	WHERE  
		dateIN = '$today'
";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {

	while($row = $result->fetch_assoc()) { 

		$logID		= $row['logID'];

		$empID		= $row['empID'];

		$empFname	= $row['empFirstName'];

		$empLname	= $row['empLastName']; 
		
		$dateIN		= $row['dateIN'];

		$timeIN		= $row['timeIN'];

		$timeIN 	= date("g:ia", strtotime($timeIN));

		$dateOUT	= $row['dateOUT'];

		$timeOUT	= $row['timeOUT'];

		$timeOUT 	= date("g:ia", strtotime($timeOUT));

		$LicNO		= $row['licNumber'];
		
		$message	= $row['comments'];

		$loggedBy	=  $row['firstname'];

	?>
	<!-- New Log Modal-->
	<div class="modal fade" id="adminlogModal<?php echo $logID; ?>" tabindex="-1" role="dialog" aria-labelledby="logModal" aria-hidden="true">
	    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
	        <div class="modal-content">
	            <div class="modal-body p-0">
	                <div class="card shadow border-0">
	                    <div class="card-header bg-transparent">
	                        <div class="text-center mt-2 text-uppercase"><h2 style="font-weight: 900">Edit Log Record</h2></div>	
	                        <div class="col-12 text-right">
	                        	<?php if ($useraccess == '0') { ?>
	                        		<a href="empLogDelete.php?logID=<?php echo $logID; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete Record</a>
	                        	<?php } ?>
	                    	</div>		                        
	                    </div>

	                    <div class="card-body px-lg-5 py-lg-5">	
				                    		                    	
	                        <form role="form" enctype="multipart/form-data" method="POST" action="empLogUpdateQuery.php<?php echo '?id='.$logID; ?>">	

	                        	<div class="row">
	                        		<div class="col-6">
			                            <div class="form-row">
			                               <div class="col-4">
			                                    <div class="form-group">
			                                        <label class="text-uppercase">Log ID</label>
			                                        <input type="number" name="newLogID" class="form-control" value="<?php echo $logID; ?>" disabled/>
			                                    </div>
			                                </div>
			                           </div>

			                            <div class="form-row">
			                                <div class="col-12">
			                                    <div class="form-group">
			                                        <label class="text-uppercase">Employee Name</label>
			                                        <input type="text" name="newEmpName" class="form-control" value="<?php echo $empFname . ' ' . $empLname; ?>" disabled/>
			                                    </div>
			                                </div>
			                            </div>

			                            <div class="form-row">
			                                <div class="col-12">
			                                    <label class="text-uppercase">Licence Plate No.</label>
			                                    <input type="text" name="NewlicNo" value="<?php echo $LicNO; ?>" class="form-control" <?php if ($useraccess == '1') { echo "disabled"; } ?>>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="col-6 d-flex justify-content-center align-items-center">
			                        	<?php
							            $emptPhoto = $row['empPhoto'];
							            if (!is_null($emptPhoto)) {
							               echo '<img src="' . $emptPhoto  . '" class="img-thumbnail emp-photo">';
								        } ?>
			                        </div>
		                        </div>

	                            <div class="form-row">
	                                <div class="col-5">
	                                    <label class="text-uppercase">Date In</label>
	                                    <input type="date" name="newDateIn" value="<?php echo $dateIN; ?>" class="form-control" <?php if ($useraccess == '1') { echo "disabled"; } ?>>
	                                </div>
	                                <div class="col-5">
	                                    <label class="text-uppercase">Time In</label>
	                                    <input type="text" id="basicNewTimeIn-<?php echo $logID; ?>" value="<?php echo $timeIN; ?>" name="newTimeIn" class="ui-timepicker-input form-control" <?php if ($useraccess == '1') { echo "disabled"; } ?>>
	                                    <script>			                                    	
	                                    	$(document).ready(function() {
	                                    		var newTime = '#basicNewTimeIn-' + <?php echo $logID; ?>;
												$(newTime).timepicker({
													'getTime': true,
													'timeFormat': 'g:i a',
												});
											}); 
	                                    </script>
	                                </div>
	                            </div>

	                            <div class="form-row">
	                                <div class="col-5">
	                                    <label class="text-uppercase">Date Out</label>
	                                    <input type="date" name="newDateOut" value="<?php echo $dateOUT; ?>" class="form-control" <?php if ($useraccess == '1') { echo "disabled"; } ?>>
	                                </div>
	                                <div class="col-5">
	                                    <label class="text-uppercase">Time Out</label>
	                                    <input type="text" id="basicNewTimeOut-<?php echo $logID; ?>" value="<?php echo $timeOUT; ?>" name="newTimeOut" class="ui-timepicker-input form-control" <?php if ($useraccess == '1') { echo "disabled"; } ?>>

	                                    <script>		                                    	
	                                    	$(document).ready(function() {
	                                    		var newTime = '#basicNewTimeOut-' + <?php echo $logID; ?>;
												$(newTime).timepicker({
													'getTime': true,
													'scrollDefault': 'now',
													'timeFormat': 'g:i a',
												});
											}); 
	                                    </script>
	                                    
	                                </div>
	                            </div>

	                            <div class="form-row">
	                                <div class="col-12">
	                                    <label class="text-uppercase">Comments</label>
	                                    <textarea name="newComments" class="form-control" rows="6" placeholder="Enter Comments" <?php if ($useraccess == '1') { echo "disabled"; } ?>><?php echo $message; ?></textarea>
	                                </div>
	                            </div>

	                            <div class="modal-footer">
	                                <input type="submit" class="btn btn-primary" value="Update" <?php if ($useraccess == '1') { echo "disabled"; } ?>/>
	                                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
	                            
	                            </div>
	                        </form>
	                        
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div><!-- /.New Log Modal -->
<?php
	}	
} 
?>






<!-- Bootstrap core JavaScript-->

	<script src="<?php echo PREPEND_PATH; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?php echo PREPEND_PATH; ?>js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?php echo PREPEND_PATH; ?>vendor/chart.js/dist/Chart.min.js"></script>

	<script src="<?php echo PREPEND_PATH; ?>vendor/chart.js/dist/Chart.extension.js"></script>

	<!-- Argon JS -->
	<script src="<?php echo PREPEND_PATH; ?>assets/js/argon.js?v=1.0.0"></script>
	
	<!-- DataTables JavaScript -->

	<script src="<?php echo PREPEND_PATH; ?>vendor/dataTables/js/jquery.dataTables.min.js"></script>
	
	<script src="<?php echo PREPEND_PATH; ?>vendor/dataTables/js/dataTables.bootstrap4.min.js"></script>

	<!-- add the shim first -->
	<script type="text/javascript" src="<?php echo PREPEND_PATH; ?>vendor/shim.min.js"></script>

	<script src="<?php echo PREPEND_PATH; ?>vendor/xlsx.full.min.js"></script>

	<script src="<?php echo PREPEND_PATH; ?>vendor/FileSaver.js"></script>

	<script src="<?php echo PREPEND_PATH; ?>vendor/tableexport/js/tableexport.js"></script>

	<script src="scripts.js"></script>
	
	<script src="../security/main.js"></script>

	<?php include("{$currDir}/modal.php"); ?>
	<?php // include("{$currDir}/modal_log.php"); ?>


	<script>
	 	$(document).ready(function() {
	        $('#dataTables-example').DataTable({
	            responsive: true
	        });
	    }); 
    </script>

	<!-- Chart JS -->

	<?php
		if (stripos($_SERVER['REQUEST_URI'], 'dashboard.php')){
		//	echo '<script src="chartScript.js"></script>';
		}
	?>


	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i><a>


	</body>

</html>


	

