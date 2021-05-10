<?php
  $currDir = dirname(__FILE__);

  include_once("$currDir/header.php"); 

?>
	<!-- Begin Page Content -->
    <div class="container-fluid pageReport">
    	<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Reports</h1>
		</div>

		<!-- Content Row -->
	    <div class="row">
			<!-- Earnings (Monthly) Card Example -->
			<div class="col-12 mb-4">
			 	<div class="card card-profile shadow">
			 		<div class="card-header py-3">
		            	<h6 class="m-0 font-weight-bold text-primary">Report Types</h6>
		            </div>

		            <div class="card-body">

						<form role="form" method="POST" id="get_report" action="reportQuery.php" enctype="multipart/form-data">

							<div class="form-group">
	                            <label>Choose Report Type<span class="red">*</span></label>
	                            <select id="reportselector" class="form-control" name="report_type">
	                            	<option value="">Select Report Type</option> 
	                            	<option value="reportPresent">Present by Date</option>
	                                <option value="reportDate">Full report by Date</option>	
	                                <option value="reportName">Report by Employee Name</option>	
	                                <option value="reportDept">Department Attendance</option>
	                            </select>
	                        </div>

	                        <div id="reportName" class="form-row empReport">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label class="text-uppercase">Employee Name<span class="red">*</span></label>
										<input list="answers" id="answer" class="form-control" placeholder="Type or Select employee name" class="form-control" />												
										<datalist id="answers">
											<?php
												/*
												* Queries employees who are still employed
												*/
			                    				$emp = "SELECT * FROM employee WHERE empEndDate IS NULL ORDER BY empFirstName ASC";
												if ($stmt = $mysqli->prepare($emp)) {
												    $stmt->execute();
												    //$stmt->bind_result($name);
												    $result = $stmt->get_result();
												    while ($row = $result->fetch_assoc()) {	 ?>
												        <option data-value="<?php echo $row['empID']; ?>"><?php echo $row['empFirstName']; ?> <?php echo $row['empLastName']; ?></option>
													<?php
												    }
												    $stmt->close();
												}
											?>
										</datalist>
										<input type="hidden" name="answer" id="answer-hidden">
										<small class="form-text text-muted">Enter and/or Select name from dropdown</small>
									</div>
								</div>
							</div>


							<div id="reportDept" class="form-row deptReport">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label class="text-uppercase">Department Name<span class="red">*</span></label>
										<select class="form-control" name="reportDept">
											<option value="">Select Deparment</option>  
											<?php
		                                        $stmtDept = $mysqli->prepare("SELECT * FROM departments");
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
							</div>


                    		<div class="form-row">
								<div class="col">
									<label>Start Date<span class="red">* (YYYY-MM-DD)</span></label>
									<div class="input-group">
										<input id="reportPicker1" type="text" name="r_start_date" value="YYYY-MM-DD" class="form-control" data-toggle="reportPicker1" required/>
								      	<div class="input-group-append">
								      		<span class="input-group-text"><i id="cal-1" class="fas fa-calendar" aria-hidden="true"></i></span>
							      		</div>    		
		                           	</div>
								</div>
							    <div class="col">
							    	<label>End Date<span class="red">* (YYYY-MM-DD)</span></label>
							    	<div class="input-group">
										<input id="reportPicker2" type="text" name="r_end_date" value="YYYY-MM-DD" class="form-control" data-toggle="reportPicker2" required/>
								      	<div class="input-group-append">
								      		<span class="input-group-text"><i id="cal-2" class="fas fa-calendar" aria-hidden="true"></i></span>
							      		</div>    		
		                           	</div>
		                           
							    </div>
							</div>
	                       
	                   		<button type="submit" name="submit" class="btn btn-primary">Generate Report</button>	
			                   		
			           </form> 

			
				</div>
			</div>
		</div><!-- .Content Row -->

		<script type="text/javascript">
			$(document).ready(function(){
				$(function() {
					$('#reportselector').change(function(){
					$('.empReport').hide();
					$('.deptReport').hide();
					$('#' + $(this).val()).show();
					});
				});

				});		
		</script>


		<script type="text/javascript">			

			$('input[list]').on('input', function(e) {
			    var $input = $(e.target),
			        $options = $('#' + $input.attr('list') + ' option'),
			        $hiddenInput = $('#' + $input.attr('id') + '-hidden'),
			        label = $input.val();

			    $hiddenInput.val(label);

			    for(var i = 0; i < $options.length; i++) {
			        var $option = $options.eq(i);

			        if($option.text() === label) {
			            $hiddenInput.val( $option.attr('data-value') );
			            break;
			        }
			    }
			});

			// For debugging purposes
			$(document).on('change', 'input', function(e) {
			    var id = $('#answer-hidden').val();
				
			    e.preventDefault();
			});
		</script>


		<script type="text/javascript">
			$('#cal-1').on('click', function(e) {
		  		e.stopPropagation();
		  		$('#reportPicker1').datepicker('show');

		  	});

		  	$('#cal-2').on('click', function(e) {
		  		e.stopPropagation();
		  		$('#reportPicker2').datepicker('show');
			});
		</script>

	
		<!-- Footer -->
		<?php include("{$currDir}/footer.php"); ?>
		
	 </div>
  </div>


