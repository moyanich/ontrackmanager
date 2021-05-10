<?php
  $currDir = dirname(__FILE__);

  include_once("$currDir/header.php"); 
?>

	<!-- Begin Page Content -->
    <div class="container-fluid">
    	<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">User List</h1>
			<a href="newUser.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add New User</a>
		</div>

		<!-- Content Row -->
	    <div class="row">
			<!-- Earnings (Monthly) Card Example -->
			<div class="col-12 mb-4">
			 	<div class="card card-profile shadow">
			 		<div class="card-header py-3">
		            	<h6 class="m-0 font-weight-bold text-primary mb-3">Users Table</h6>
		            	<p class="text-muted"><strong>Super Users</strong> are not listed in this table, if a Super User requires update please contact the <strong><a href="mailto:helpdesk@jbdc.net?subject=Issue with Attendance Log">Administrator</a>.</strong></p>
		            </div>
					<?php
					$userList = "";

					//$sql = mysqli_query($mysqli, "SELECT * FROM user WHERE access <> '0' AND access <> '1' ORDER BY firstname ASC");

					$sql = mysqli_query($mysqli, "SELECT * FROM user WHERE access <> '0' AND access <> '1' ORDER BY firstname ASC");

					$userCount = mysqli_num_rows($sql); // count the output amount

					if ($userCount > 0) {

						while($row = mysqli_fetch_array($sql)) { 

							$id = $row['userid'];

							$firstname	= $row['firstname'];

							$lastname	= $row['lastname'];

							$username	= $row['username'];

							$accessType 	= $row['access'];
	
							$userList  .= "<tr>";

							$userList .= '<td>' . $firstname . ' ' . $lastname .'</td>';

							$userList .= '<td>' . $username . '</td>';

							if ($accessType == '0') {
								$accessType = 'Super Admin';
							}	
							else if ($accessType == '1') {
								$accessType = 'Regular HR Admin';
							}	
							else if ($accessType == '2') {
								$accessType = 'Security';
							}
							else if ($accessType == '3') {
								$accessType = 'Disabled User';
							} 

							$userList  .= '<td>' . $accessType  . '</td>';

							if ($useraccess == '0') {

								$userList .= '<td class="text-center"><a href="#" data-toggle="modal" data-target="#editUser-' . $id . '" class="btn btn-outline-success btn-sm"><i class="fa fa-edit"></i></a></td>';
							
								include('modalEditUser.php');
							}
							$userList  .= "</tr>";
						}	
					}
					mysqli_close($mysqli);
				?>


			<div class="card-body">
				<div class="table-responsive">
					<table class="table align-items-center text-left" id="userTable">
						<thead class="thead-light">
				          	<tr>
								<th scope="col">Name</th>
								<th scope="col">Username</th>
								<th scope="col">Access Type</th>
								<?php if ($useraccess == '0') { ?>
									<th scope="col">Actions</th>
								<?php } ?>
				          	</tr>
				      	</thead>
				      	<tbody>
				        	<?php echo $userList; ?>        
				      	</tbody>
				    </table>
				</div>
			</div>
		</div><!-- .Content Row -->
	
		<!-- Footer -->
		<?php include("{$currDir}/footer.php"); ?>
	 </div>
  </div>


