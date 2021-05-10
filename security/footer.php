<?php
  $currDir = dirname(__FILE__);

  include("{$currDir}/session.php");

  if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '../'); 
?>

	
	<!-- Logout-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
	    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
	        <div class="modal-content bg-gradient-danger">
	            <div class="modal-header">
	                <h6 class="modal-title" id="modal-title-notification">You are logging out!</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">×</span>
	                </button>
	            </div>
	            
	            <div class="modal-body">
	                <div class="py-3 text-center">
	                    <i class="ni ni-bell-55 ni-3x"></i>
	                    <h4 class="heading mt-4">Do you wish to Logout <?php echo $securityUser; ?>?</h4>
	                </div>
	            </div>
	            
	            <div class="modal-footer">	                
	                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Cancel</button> 
	                <a href="logout.php"  class="btn btn-white">Logout</a>
	            </div>

	        </div>            
	    </div>
	</div>
	<!-- /.Logout modal -->
	

	<!-- View Logs -->

	<?php

	$logSql = 
		"
			SELECT * FROM logTBL
			LEFT JOIN employee ON logTBL.empID = employee.empID
			 	LEFT JOIN user ON logTBL.userid = user.userID 
			WHERE  
				dateIN = CURDATE()
		";

	    $stmt = $mysqli->prepare($logSql);

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


 /*
	  $sql = "SELECT
				*
		    FROM 
		    	logTBL  

			 	LEFT JOIN employee ON logTBL.empID = employee.empID
			 	LEFT JOIN user ON logTBL.userid = user.userID 
			WHERE  
				dateIN <= CURDATE()
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

				$loggedBy	=  $row['firstname']; */

			?>
			
			<!-- Log Details Modal-->
			<div class="modal fade" id="logModal<?php echo $logID; ?>" tabindex="-1" role="dialog" aria-labelledby="logModal" aria-hidden="true">
			    <div class="modal-dialog modal-lg" role="document">
			        <div class="modal-content">
			            <div class="modal-body p-0">
			                <div class="card bg-secondary shadow border-0">
			                    <div class="card-header bg-transparent">
			                        <div class="text-center mt-2 text-uppercase"><h2 style="font-weight: 900">Edit Log Record</h2></div>	
			                        <div class="col-12 text-right">
			                        	<a href="empLogDelete.php?logID=<?php echo $logID; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete Record</a>
			                    	</div>		                        
			                    </div>

			                    <div class="card-body px-lg-5 py-lg-5">			                    	
			                        <form role="form" method="POST" action="empLogUpdateQuery.php<?php echo '?id='.$logID; ?>">	

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
					                                        <input type="hidden" name="newEmpID" value="<?php echo $empID; ?>">
					                                    </div>
					                                </div>
					                            </div>

					                            <div class="form-row">
					                                <div class="col-12">
					                                    <label class="text-uppercase">Licence Plate No.</label>
					                                    <input type="text" name="NewlicNo" value="<?php echo $LicNO; ?>" class="form-control">
					                                </div>
					                            </div>
					                        </div>
					                        <div class="col-6 d-flex justify-content-center align-items-center">
					                        	<?php /*
									            $emptPhoto = $row['empPhoto'];
									            if (!is_null($emptPhoto)) {
									               echo '<img src="' . $emptPhoto  . '" class="img-thumbnail emp-photo">';
										        } */  ?>


					                        </div>
				                        </div>

			                            <div class="form-row">
			                                <div class="col-5">
			                                    <label class="text-uppercase">Date In<span class="red">* (YYYY-MM-DD)</span></label>
			                                    <input type="text" name="newDateIn" value="<?php echo $dateIN; ?>" class="form-control" data-toggle="dateInpicker" placeholder="yyyy-mm-dd">
			                                </div>
			                                <div class="col-5">
			                                	<?php
			                                	/*
													* Check if Time IN value is set 
													* If the row is emoty output an empty value
												*/                 

												if (is_null($row['timeIN'])) {
												    $timeIN = '';
												} else {
												   	$timeIN	= $row['timeIN'];
													$timeIN	= date("g:ia", strtotime($timeIN));
												}
												?>

			                                    <label class="text-uppercase">Time In<span class="red text-lowercase">* (8:00 am)</span></label>
			                                    <input type="text" id="basicNewTimeIn-<?php echo $logID; ?>" value="<?php echo $timeIN; ?>" name="newTimeIn" class="ui-timepicker-input form-control">
			                                    <script>			                                    	
			                                    	$(document).ready(function() {
			                                    		var newTime = '#basicNewTimeIn-' + <?php echo $logID; ?>;
														$(newTime).timepicker({
															'getTime': true,
															'noneOption': true,
															'typeaheadHighlight': true,	
															'timeFormat': 'g:i a',
														});
													}); 
			                                    </script>
			                                </div>
			                            </div>

			                            <div class="form-row">
			                                <div class="col-5">
			                                    <label class="text-uppercase">Date Out<span class="red">* (YYYY-MM-DD)</span></label>
			                                    <input type="text" name="newDateOut" value="<?php echo $dateOUT; ?>" class="form-control" data-toggle="dateOutpicker" placeholder="yyyy-mm-dd">
			                                </div>
			                                <div class="col-5">
			                                    <label class="text-uppercase">Time Out<span class="red text-lowercase">* (8:00 am)</span></label>
			                                   
												<?php 
												/*
													* Check if a Date out value is set 
													* If the row is emoty output an empty value
												*/           


												if (is_null($row['timeOUT'])) {
												    $timeOUT = '';
												} else {
												   	$timeOUT	= $row['timeOUT'];
													$timeOUT 	= date("g:ia", strtotime($timeOUT));
												}
												?>

												<input type="text" id="basicNewTimeOut-<?php echo $logID; ?>" name="newTimeOut" value="<?php echo $timeOUT; ?>" class="ui-timepicker-input form-control" autocomplete="off"/>

												<?php /*-- <input type="text" id="basicNewTimeOut-<?php echo $logID; ?>" value="<?php if ($timeOUT > 0) { echo $timeOUT; }?>" name="newTimeOut" class="ui-timepicker-input form-control">--> */ ?>


			                                    <script>	                                    	
			                                    	$(document).ready(function() {
			                                    		var newTime = '#basicNewTimeOut-' + <?php echo $logID; ?>;
														$(newTime).timepicker({
															'getTime': true,		
														    'noneOption': true,
														    'typeaheadHighlight': true,	
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
			                                    <textarea name="newComments" class="form-control" rows="6" placeholder="Enter Comments"><?php echo $message; ?></textarea>
			                                </div>
			                            </div>

			                            <div class="modal-footer">
			                                <input type="submit" class="btn btn-primary" value="Update" />
			                                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>			                            
			                            </div>			                           
			                        </form>  */ ?>

			                    </div><!--.card-body-->
			                    <div class="card-footer text-muted"><small>Logged created by: <?php echo $loggedBy; ?></small></div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<!-- /.New Employee Modal -->
		<?php
			}	
		}  
	?>
	
	<footer class="py-5">
		<div class="container">
			<div class="row align-items-center justify-content-xl-between">
				<div class="col-xl-6">
					<div class="copyright text-center text-xl-left text-muted">&copy; <?php echo date('Y'); ?> <a href="m" class="font-weight-bold ml-1" target="_blank">Jamaica Business Development Corporation</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div><!--.main-content -->

		<!-- Argon Scripts -->
		<!-- Core -->
		
		<script src="<?php echo PREPEND_PATH; ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<!-- Optional JS -->

		<!-- DataTables JavaScript --> 
		<script src="../vendor/dataTables/js/jquery.dataTables.min.js"></script>
		<script src="../vendor/dataTables/js/dataTables.bootstrap4.min.js"></script>

		<script src="main.js"></script>
		
	
	
	  	<script>
	 	$(document).ready(function() {
	        $('#dataTables-example').DataTable({
	            responsive: true
	        });
	    }); 
	    </script>
		

	
	    <script>
	    	$(document).ready(function(){

				$('[data-toggle="dateInpicker"]').datepicker({
					format: 'yyyy-mm-dd',
					autohide: true, 
			    	startDate: new Date().toDateString(),
			    	endDate: new Date()
				});

				$('[data-toggle="dateOutpicker"]').datepicker({
					format: 'yyyy-mm-dd',
					autohide: true, 
					autoPick: true,
			    	startDate: new Date().toDateString(),
			    	endDate: new Date()
				});
			});
	    </script> 


	</body>
</html>
