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
		<?php echo '<button class="btn btn-danger" data-toggle="modal" data-target="#delEmployee-' . $eid . '"><i class="fa fa-trash"></i> Delete Record</button>'; 
		include('modal_delEmployee.php'); ?>
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
			
			<!-- Employee Log-->
			<div class="card border-left-primary shadow h-100 py-2 emp-card">
				<div class="card-header">
					<h6 class="m-0 font-weight-bold text-primary">Employee Attendance</h6>
				</div> 
				<div class="card-body">
					<div class="table-responsive">
						<table class="table align-items-center text-left" id="historyTable" data-order='[[ 2, "desc" ]]'>
							<thead class="thead-light">
					          	<tr>
					          		<th scope="col">Log ID</th>
									<th scope="col">Name</th>
									<th scope="col">Date IN</th>
									<th scope="col">Time IN</th>
									<th scope="col">Date Out</th>
									<th scope="col">Time Out</th>
									<th scope="col">Licence</th>
									<th scope="col">Comments</th>
									<th scope="col">Logged By</th>
					          	</tr>
						    </thead>
						    <tbody>
						    	<?php
								if (isset($eid)) {
									//If connect fails display message
									if($mysqli->connect_error) {
										die("Database Connection Failed: " . $mysqli->connect_error);
									}

									//1. Prepare statement
									if(!($stmt = $mysqli->prepare("SELECT
											*
									    FROM 
									    	logTBL   	
										 	LEFT JOIN employee
										    	ON logTBL.empID = employee.empID
										    LEFT JOIN user
        										ON logTBL.userID = user.userID 
										WHERE  
											employee.empID = ?

										/*LIMIT 1000 */
										") )) {
										echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
									}

									//2. bind
									if(!($stmt->bind_param('i', $eid) )) {
										echo 'Binding parameters failed: (' . $mysqli->errno . ') ' . $stmt->error;
									}

									//3. execute
									if(!($stmt->execute() ) ) {
										echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
									}

									$empResult = $stmt->get_result();

									if($empResult->num_rows === 0) { exit('No records'); } // count the output amount

								    else { 

						        		while ($row = $empResult->fetch_assoc()) {

											$logID		= $row['logID'];

											$empID		= $row['empID'];

											$empFname	= $row['empFirstName'];

											$empLname	= $row['empLastName']; 
											
											$dateIN		= $row['dateIN'];

											$timeIN		= $row['timeIN'];

											$timeIN 	= date("g:i a", strtotime($timeIN));

											$dateOUT	= $row['dateOUT'];

											$timeOUT	= $row['timeOUT'];

											$Logged     = $row['firstname'] . ' ' . $row['lastname'];

								
											if (is_null($timeOUT) ){
								                $timeOUT = '';
								            }
								            else {
								                $timeOUT 	= date("g:i a", strtotime($timeOUT));
								            }

											$Lic 		= $row['licNumber'];

											$comments 	= $row['comments'];
											?>
								        	<tr> 
								        		<td><?php echo $logID; ?></td>
								        		<td><?php echo $empFname . ' ' . $empLname; ?></td>
								        		<td><?php echo $dateIN; ?></td>
								        		<td><?php echo $timeIN; ?></td>
								        		<td><?php echo $dateOUT; ?></td>
								        		<td><?php echo $timeOUT; ?></td>
								        		<td class="text-uppercase"><?php echo $Lic; ?></td>
								        		<td><?php echo $comments; ?></td>
								        		<td><?php echo $Logged; ?></td>
								        	</tr>
											<?php
										} //endWhile
									} //endElse
								} //endIf
								$stmt->close(); ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .Content Row -->


	<!-- Footer -->
	<?php include_once("$currDir/footer.php");  ?>

	



		