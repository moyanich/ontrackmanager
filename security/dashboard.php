<?php
  $currDir = dirname(__FILE__);
  include_once("$currDir/header.php"); 
?>

<body class="security-dasboard">
	<?php // include("{$currDir}/sidebar.php"); ?>

  	<!-- Main content -->
  	<div id="securityDash" class="main-content">
		<!-- Top navbar -->
		<?php include("{$currDir}/topNavbar.php"); ?>

		<!-- Header -->
		<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 300px; background-size: cover; background-position: center top;">
			<!-- Mask -->
			<span class="mask bg-gradient-secondary opacity-8"></span>
		</div>

		<!-- Page content -->
		<div class="container-fluid mt-4 mt-md--2 mt-lg--7">
			<div class="row">

				<!--Col 1-->
			  	<div class="col-12 col-md-12 col-lg-10 offset-lg-1 mb-5">

				<ul class="nav nav-tabs log-tabs" id="myTab" role="tablist">
				  	<li class="nav-item">
				    	<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Record Employee</a>
				  	</li>
					  <li class="nav-item">
					    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">View Logs</a>
					  </li>
					</ul>
					<div class="tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					  		<div class="card card-profile shadow px-4 py-4">
						 		<div class="card-header bg-transparent">
					              	<div class="row align-items-center">
						                <div class="col">
						                  <h2 class="text-uppercase ls-1 mb-0">Log Employee</h2>
						                  <p class="mb-0">Instructions</p>
						                  <ol style="font-size: 13px; margin-top: 5px;">
						                  	<li>Select employee name from dropdown</li>
						                  	<li>Confirm that the employee selected is correct. (Note: The employees photo should appear once selected).</li>
						                  	<li>Enter applicable fields below.</li>
						                  	<li>Click Submit once complete.</li>
						                  	<li>Confirm log in the <strong>Log Records"</strong>. All logs are given a unique log ID.</li>
						                  </ol>
						                </div>
					              	</div>
					            </div>
				            
								<div class="card-body">
									<div class="card-content">
										<form class="form-log" id="empInsertion" enctype="multipart/form-data" method="POST" action="empLogInsertion.php">

											<div class="form-row">
												<div class="col-12 col-md-6">
													<div class="form-group">
														<label class="text-uppercase">Employee Name</label>
														<div class="input-group">
															<input list="answers" id="answer" class="form-control" placeholder="" class="form-control" />
															<div class="input-group-append">
													      		<span class="input-group-text"><i role="button" id="openAnswers" class="ni ni-circle-08" aria-hidden="true"></i></span>
												      		</div>
														</div>
																									
														<datalist id="answers">
															<select name="employee">
																<?php
																/*
																* Queries employees who are still employed
																*/
							                    				$emp = "SELECT empID, empFirstName, empLastName FROM employee WHERE empStatus IS NULL OR empStatus = 'No' ORDER BY empFirstName ASC";
																if ($stmt = $mysqli->prepare($emp)) {
																    $stmt->execute();
																    //$stmt->bind_result($name);
																    $result = $stmt->get_result();
																    while ($row = $result->fetch_assoc()) {	 ?>
																        <option data-value="<?php echo $row['empID']; ?>" value="<?php echo $row['empFirstName'] .' ' . $row['empLastName']; ?>"><?php echo $row['empFirstName']; ?> <?php echo $row['empLastName']; ?></option>
																	<?php
																    }
																    $stmt->close();
																}
																?>
															</select>
														</datalist>
														<input type="hidden" name="answer" id="answer-hidden">
														<small class="form-text text-muted">Enter and/or Select name from dropdown</small>
														
													</div>
												</div>
											</div>

											<div id="records"></div> 

											<div class="form-row">
											    <div class="col-12 col-md-12 col-lg-6">
											        <label class="text-uppercase">Licence Plate No. (If applicable)</label>
											        <input type="text" name="licNo" value="" class="form-control">
											    </div>
											</div>

											<div class="form-row">
												<div class="col-12 col-md-6">
													<label class="text-uppercase">Date In (date format: <span class="red">*YYYY-MM-DD</span>)</label>
													<div class="input-group">
												      	<input type="text" id="datetimepicker" name="dateIn" value="" class="form-control" data-toggle="datepicker">
												      	<div class="input-group-append">
												      		<span class="input-group-text"><i class="ni ni-calendar-grid-58" aria-hidden="true"></i></span>
											      		</div>    				
		  											</div>
		  											<div class="datepicker-container"></div>

		  											<small id="passwordHelpBlock" class="form-text text-muted">Select Date from Dropdown (*Only todays date is valid)</small>
		  											<script type="text/javascript">
		  												$('.ni-calendar-grid-58').on('click', function(e) {
														  e.stopPropagation();
														  $('#datetimepicker').datepicker('show');
														})
		  											</script>
											    </div>

												<div class="col-12 col-md-6">
													<label class="text-uppercase">Time In<span class="red text-lowercase">* (8:00 am)</span></label>
													<div class="input-group">
														<input type="text" id="basicTime" value="" placeholder="None" name="timeIn" class="ui-timepicker-input form-control" autocomplete="off">	
														<div class="input-group-append">
												      		<span class="input-group-text"><i role="button" id="openSpanExample" class="ni ni-watch-time" aria-hidden="true"></i></span>
											      		</div>
													</div>
													<script type="text/javascript">
														$(document).ready(function(){
															$('#basicTime').timepicker();
														  	$('#openSpanExample').on('click', function(){
																$('#basicTime').timepicker('setTime', new Date());
															});
														});
													</script>

													<small id="passwordHelpBlock" class="form-text text-muted">Select Time from Dropdown (Note: The time can be adjusted)</small>	
											    </div>
											</div>

											<div class="form-row">
											    <div class="col-12">
											        <label class="text-uppercase">Comments</label>
											        <textarea name="comments" class="form-control" rows="6" placeholder="Enter Comments"></textarea>
											    </div>
											</div>

											<div class="col-12 text-center mt-4 pt-3">
												<input type="submit" class="btn btn-primary" value="Submit">
											</div>

								 		</form>
									</div>
								</div>
							</div>
					  	</div>

					  	<!--tab 2-->
					  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					  		<div class="card card-log shadow">
					            <div class="card-header bg-transparent">
					              	<div class="row align-items-center">
						                <div class="col">
						                  <h6 class="text-uppercase text-muted ls-1 mb-1">First 100 Records</h6>
						                  <h2 class="mb-0">Log Records</h2>
						                </div>
					              	</div>
					            </div>
				            	<div class="card-body">
				              		<?php include("empLogRecordQuery.php"); ?>		              
				              	</div>
				            </div>
					  	</div>
					</div>
		          	
		        </div>
			</div><!--.row-->
		</div><!--.container-fluid -->
		<!-- Footer -->
		<?php include_once("$currDir/footer.php");  ?>

		
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
				if(id) {
		            $.ajax({
		                type: 'GET',
		                url: 'empRecordQuery.php?id=' + id,
		               // url: 'code_query.php',
		                //data: {'product_code': id },
		                success: function (response) {
		                // We get the element having id of display_info and put the response inside it
		                $( '#records' ).html(response);
		                //console.log('here' + id);

		                }
		            });
		        }
			    e.preventDefault();
			});
		</script>


