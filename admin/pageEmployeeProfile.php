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

		<?php 
		if ($useraccess == '0') {
    		echo '<button class="btn btn-danger" data-toggle="modal" data-target="#delEmployee-' . $eid . '"><i class="fa fa-trash"></i> Delete Record</button>'; 
			include('modal_delEmployee.php');
    	} 
    	?>
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

			<!-- Employee List-->
			<div class="card border-left-primary shadow h-100 py-2 emp-card">
				<div class="card-body">
			  		<?php 
					if (isset($eid)) {

						//If connect fails display message
						if($mysqli->connect_error) {
							die("Database Connection Failed: " . $mysqli->connect_error);
						}

						//1. Prepare statement
						if(!($stmt = $mysqli->prepare("SELECT * FROM employee
							LEFT JOIN departments ON departments.DeptID = employee.deptID
							LEFT JOIN employeeType ON employeeType.typeID = employee.typeID
							WHERE employee.empID = ? LIMIT 1"))) {
							echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
						}

						//2. bind
						if(!($stmt->bind_param('i',  $eid) )) {
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

								$employeeID = $row['empID'];

								$empFName	= $row['empFirstName'];

								$empLName	= $row['empLastName'];

								$emptDeptID	= $row['deptID'];

								$deptName	= $row['deptName'];

								$empType 	= $row['typeID'];

								$empTypeName = $row['employeeType'];

								$empPosition = $row['empPosition'];

								$empAddress	= $row['empAddress']; 

								$gender 	= $row['empGender']; 

								$startDate	= $row['empStartDate']; 

								$endDate	= $row['empEndDate']; 

								$empPhoto	= $row['empPhoto'];

								$empStatus	= $row['empStatus'];

								?>

								<div class="card-header">
									<h6 class="m-0 font-weight-bold text-primary">Employee Profile - <strong class="text-gray-dark text-uppercase"><?php echo $empFName . ' ' . $empLName; ?></strong><span style="float: right;">Status: <strong><?php if ($empStatus == 'No') { echo '<span class="green">Active</span>'; } else { echo '<span class="red">Not Active</span>';}?></strong></span></h6>
								</div> 
								
								<div class="card-body">

									<form id="employee_details" class="text-left" enctype="multipart/form-data" method="POST" action="emp_update_record.php<?php echo '?id='.$employeeID; ?>">

										<div class="form-row">
											<div class="col-3">
					                            <div class="form-group">
					                                <label>Employee ID</label>
					                                <input type="number" name="newEmpID" class="form-control" value="<?php echo $employeeID; ?>">
					                            </div>
					                        </div>

				                            <div class="col">
					                            <div class="form-group">
					                                <label>First Name</label>
					                                <input type="text" name="newFirstName" class="form-control" value="<?php echo $empFName; ?>">
					                            </div>
					                        </div>
					                        <div class="col">
					                            <div class="form-group">
					                                <label>Last Name</label>
					                                <input type="text" name="newLastName" class="form-control" value="<?php echo $empLName; ?>">
					                            </div>
					                        </div>
					                    </div><!--form-row-->
							                   
				                        <div class="form-row">
					                    	<div class="col">
					                            <div class="form-group">
					                                <label>Gender<span class="red">*</span></label>
					                                <select class="form-control" name="newGender" required />
					                                    <?php 
					                                    echo '<option value="' . $gender . '">' . $gender . '</option>';
					                                    if ($gender == null) { 
					                                        echo '<option value="Male">Male</option>';
					                                        echo '<option value="Female">Female</option>';
					                                    }
					                                    else if ($gender == 'Male') {
					                                    	echo '<option value="Female">Female</option>';
					                                    }
					                                    else {
					                                    	 echo '<option value="Male">Male</option>';
					                                    }
					                                    ?>                                
					                                </select>  
					                            </div>
					                        </div>

					                        <div class="col">
					                            <div class="form-group">
					                                <label for="newEmpType">Employment Type<span class="red">*</span></label>
					                                <select class="form-control" name="newEmpType" required >
					                                    <option value="<?php echo $empType; ?>"><?php echo $empTypeName; ?></option>
					                                    <?php
					                                      $stmtType = $mysqli->prepare("SELECT * FROM employeeType WHERE typeID != '$empType'");
					                                      //$stmtType->bind_param('i', $empType);
					                                      $stmtType->execute();
					                                      $resultType = $stmtType->get_result();

					                                        if ($resultType->num_rows > 0) { // count the output amount
					                                            while ($rowType = $resultType->fetch_assoc()) {
					                                                $empTypeID = $rowType['typeID'];  ?>
					                                                <option value="<?php echo $empTypeID; ?>"><?php echo $rowType['employeeType']; ?></option>
					                                            <?php
					                                            }
					                                        } 
					                                        $stmtType->close();
					                                    ?>                                
					                                </select>
					                            </div>
					                        </div>
					                    </div><!--form-row-->

					                    <div class="form-row">
					                        
					                        <div class="col">
					                            <div class="form-group">
					                                <label>Position</label>
					                                <input type="text" name="newEmpPosition" class="form-control" value="<?php echo $empPosition; ?>">
					                            </div>
					                        </div>
					                        <div class="col">
					                            <div class="form-group">
					                                <label for="newDepartment">Department<span class="red">*</span></label>
					                                <select class="form-control" name="newDept">
					                                    <option value="<?php echo $emptDeptID ?>"><?php echo $row['deptName']; ?></option>
					                                    <?php
					                                        $stmtDept = $mysqli->prepare("SELECT * FROM departments WHERE DeptID != '".$emptDeptID."'");
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
					                    </div><!--form-row-->
					                   

					                    <div class="form-row">
					                        <div class="col-12">
					                            <div class="form-group">
					                                <label>Address</label>
					                                <textarea name="newAddress" class="form-control"><?php echo $empAddress; ?></textarea>  
					                            </div>
					                        </div>
					                    </div>

					                    <div class="form-row">
										  	<div class="col-4 offset-8">
					                            <div class="form-group profile-status">
					                            	<label style="font-size: 20px;">Deactivate Employee Profile?</label>
					                            	<label class="switch">
        												<input class="switch-input" type="checkbox" <?php if (isset($empStatus) && $empStatus=="Yes") { echo "checked"; } else { } ?> />
														<span class="switch-label" data-on="Yes" data-off="No"></span> 
														<span class="switch-handle"></span> 
					                            	</label>

					                            	<?php 
														echo '<input type="hidden" id="hidden_status" name="newEmpStatus" value="' . $empStatus . '">'; 
													?>

					                            	<script>

					                            		(function() {
														  $(document).ready(function() {
														    $('.switch-input').on('change', function() {
														      var isChecked = $(this).is(':checked');
														      var selectedData;
														      var $switchLabel = $('.switch-label');
														      console.log('isChecked: ' + isChecked); 

														      if(isChecked) {
														        selectedData = $switchLabel.attr('data-on');
														        $('#hidden_status').val('Yes');
														      } else {
														        selectedData = $switchLabel.attr('data-off');
														        $('#hidden_status').val('No');
														      }

														      console.log('Selected data: ' + selectedData);

														    });
														  });

														})();
													</script>
					                            </div>
					                        </div>
					                    </div>

										<div class="text-center">
					                        <input type="submit" name="update" class="btn btn-primary" value="Update Record" />
					                    </div>
					                </form> 

						       </div>
							<?php
							} //endWhile
						} //endElse
					} //endIf
					$stmt->close();
				 ?>
				</div>
			</div>

		</div>
	</div><!-- .Content Row -->

	<?php /* Clears form input fields */ ?>
	<script type="text/javascript">
		var form = document.getElementById("employee_details");
		form.reset();
	</script>



	<script type="text/javascript">
		$('#cal1').on('click', function(e) {
	  		e.stopPropagation();
	  		$('#admindatestarttimepicker').datepicker('show');

	  	});

	  	$('#cal2').on('click', function(e) {
	  		e.stopPropagation();
	  		$('#admindateendtimepicker').datepicker('show');
		});
	</script>

		

	<!-- Footer -->
	<?php include_once("$currDir/footer.php");  ?>

	




<?php /*

<label for="newEmpStatus">Employment Status</label>
        <select class="form-control" name="newEmpStatus">
            <option value="<?php ?>">Deactivate Employee Profile</option>
                                  
        </select>

<div class="col">
    <div class="form-group">
        <label>Employment Start Date <em><span class="red">(YYYY-MM-DD)*</span></em></label>
        <div class="input-group">
             <?php
                /*
                    * Check if Time IN value is set 
                    * If the row is emoty output an empty value
                */
                /*
                if (is_null($row['empStartDate'])) {
                    $startDate = '';
                } else {
                    $startDate = $row['empStartDate'];
                }
             ?>
            <input type="text" id="admindatestarttimepicker" name="newEmpStartDate" value="<?php echo $startDate; ?>"  class="form-control" data-toggle="admindatestarttimepicker">
            <div class="input-group-append">
                <span class="input-group-text"><i id="cal1" class="fas fa-calendar" aria-hidden="true"></i></span>
            </div>                  
        </div>
    </div>
</div>

<div class="col">
    <div class="form-group">
        <label>Employment End Date <em><span class="red">(YYYY-MM-DD)</span></em></label>
        <div class="input-group">
            <?php
                /*
                    * Check if Time IN value is set 
                    * If the row is emoty output an empty value
                */

                /*
                if (is_null($row['empEndDate'])) {
                    $endDate = '';
                } else {
                    $endDate = $row['empEndDate'];
                } 
             ?>
            <input type="text" id="admindateendtimepicker" name="newEmpEndDate" value="<?php echo $endDate; ?>" class="form-control" data-toggle="admindateendtimepicker" />
            <div class="input-group-append">
                <span class="input-group-text"><i id="cal2" class="fas fa-calendar" aria-hidden="true"></i></span>
            </div>                  
        </div>
    </div>
</div> */ ?>


<?php /* 

	<!--<div class="radio">
		<label class="radio" style="margin-right: 20px;">
	      	<input type="radio" name="newEmpStatus" <?php if (isset($empStatus) && $empStatus=="Yes") { echo "checked"; } ?> value="Yes"> Yes
	    </label>
	    <label class="radio">
	    	<input type="radio" name="newEmpStatus" <?php if ((isset($empStatus) && $empStatus=="No") || (is_null($empStatus))) { echo "checked"; } ?> value="No"> No
	    </label>
	</div>-->


	<label class="switch">
	<?php 
	if (isset($empStatus) && $empStatus=="Yes") { $empStatus = "Yes"; } 
	else if ((isset($empStatus) && $empStatus=="No") || (is_null($empStatus))) { $empStatus = "No"; } ?>

	<input type="checkbox" class="switch-input" checked />
	<span class="switch-label" <?php if ($empStatus == 'Yes') { echo 'data-on="Yes" data-off="No"'; } else if ($empStatus == 'No') { echo 'data-on="Yes" data-off="No"'; } ?>></span>
	<span class="switch-handle"></span> 
	</label>

	<?php 
	echo '<input type="hidden" id="hidden_status" name="newEmpStatus" value="' . $empStatus . '">'; 
	?> */ ?>

	<script>

	/*

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
			}); */

	/*
	$(document).ready(function() {
		$('#status').bootstrapToggle({
			on: 'Yes',
			off: 'No',
			onstyle: 'success',
			offstyle: 'danger'
		});

		$('#status').change(function(){
			if($(this).prop('checked')) {
				$('#hidden_status').val('Yes');
			}
			else {
				$('#hidden_status').val('No');
			}
		}); 
	});*/
	</script>


	<?php /*

	<select class="form-control" name="newEmpStatus">

	echo '<option value="' . $empStatus . '">' . $empStatus . '</option>';

	if ($empStatus == null) { 
	    echo '<option value="Yes">Yes</option>';
	    echo '<option value="No">No</option>';
	}
	else if ($empStatus == 'Yes') {
		echo '<option value="No">No</option>';
	}
	else {
		 echo '<option value="Yes">Yes</option>';
	}
	?>                                
	</select> */ ?>






 <?php /*
<input type="hidden" id="hidden_status" name="newEmpStatus" value="<?php 
if (isset($empStatus) && $empStatus=="Yes") { echo 'value="Yes">'; } elseif ((isset($empStatus) && $empStatus=="No") || (is_null($empStatus))) { echo 'value="No"'; } ?> ">


<label style="font-size: 20px;">Deactivate Employee Profile?</label>
<div class="radio">
	<label class="radio" style="margin-right: 20px;">
      	<input type="radio" name="newEmpStatus" <?php if (isset($empStatus) && $empStatus=="Yes") { echo "checked"; } ?> value="Yes"> Yes
    </label>
    <label class="radio">
    	<input type="radio" name="<?php if ((isset($empStatus) && $empStatus=="No") || (is_null($empStatus))) { echo "checked"; } ?> value="No"> No
    </label>
</div>


<label class="switch">
	<input name="newEmpStatus" class="switch-input" id="status" type="checkbox" />
	<span class="switch-label" data-on="<?php if (isset($empStatus) && $empStatus=="Yes") { echo "Yes"; } else { echo "Yes";} ?>" data-off="<?php if ((isset($empStatus) && $empStatus=="No") || (is_null($empStatus))) { echo "No"; } else { echo "No";} ?>" data-value="<?php $empStatus; ?>"></span> 
	<span class="switch-handle"></span> 

	
</label>




 <input type="radio" name="ewEmpStatus" value="<?php echo $empStatus ?>">Yes
 <?php

        $stmtStat = $mysqli->prepare("SELECT * FROM fields WHERE fieldName != '".$empStatus."'");

        $stmtStat->execute();
      	$resultStat = $stmtStat->get_result();

      	if ($resultStat->num_rows > 0) { // count the output amount
            while ($rowStat = $resultStat->fetch_assoc()) {
                $statID = $rowStat['fieldID'];  ?>

               

                  <?php /* <input type="radio" name="newEmpStatus" <?php if (isset($empStatus) && $empStatus=="Yes") echo "checked";?> value="yes">Yes
				<input type="radio" name="newEmpStatus" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="no">No-->
				
				<div>
					Yes<input type="radio" name="newEmpStatus" value=yes<?php if ($rowStat['fieldName'] == "yes") echo " checked"; ?> />&nbsp;

					No<input type="radio" name="newEmpStatus" value=no<?php if ($rowStat['fieldName'] == "no") echo " checked"; ?>>
					<br/>
					<p>Currently Set to: <strong><?php echo $rowStat['fieldName'];?></strong></p>
				</div>

               <!-- <input id="stat" type="radio" name="newEmpStatus" value="<?php echo $statID; ?>"<?php if ($rowStat['fieldName'] == 1): ?> checked = "checked"<?php endif; ?> />

                 <input id="stat" type="radio" name="newEmpStatus" value="<?php echo $statID; ?>"<?php if ($rowStat['fieldName'] != 1): ?> checked = "checked"<?php endif; ?> /> */ ?>

               
        <?php /* }
        } $stmtStat->close();
    ?>                                
    




<select class="form-control" name="newEmpStatus">
   <?php /*
    	echo '<option value="' . $empStatus . '">' . $empStatus . '</option>';


        $stmtStat = $mysqli->prepare("SELECT * FROM fields WHERE fieldName != '".$empStatus."'");

        $stmtStat->execute();
      	$resultStat = $stmtStat->get_result();

      	if ($resultStat->num_rows > 0) { // count the output amount
            while ($rowStat = $resultStat->fetch_assoc()) {
                $statID = $rowStat['fieldID'];  ?>
                <option value="<?php echo $statID; ?>"><?php echo $rowStat['fieldName']; ?></option>
        <?php }
        } $stmtStat->close(); */
    ?>                                
    



    <?php /*
    echo '<option value="' . $empStatus . '">' . $empStatus . '</option>';
   
   /* if ($empStatus == null) { 
        echo '<option value="Yes">Yes</option>';
        echo '<option value="No">No</option>';
    }
    else if ($empStatus == 'Yes') {
    	echo '<option value="No">No</option>';
    }
    else {
    	 echo '<option value="Yes">Yes</option>';
    } */
    ?>   



























