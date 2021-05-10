<?php
$employeeList = "";

$sql = mysqli_query($mysqli, "
	SELECT
	    empID, empFirstName, empLastName, empPhoto, empEndDate, empStatus, departments.DeptID, departments.deptName
    FROM 
    	employee, departments
	WHERE  
		employee.DeptID = departments.DeptID
	ORDER by 
		employee.empFirstName ASC
");

$empCount = mysqli_num_rows($sql); // count the output amount

if ($empCount > 0) {

	while($row = mysqli_fetch_array($sql)) { 

		$empID 		= $row['empID'];

		$empFname	= $row['empFirstName'];

		$empLname	= $row['empLastName'];

		$emptDept 	= $row['deptName'];
		
		$empPhoto 	= $row['empPhoto'];

		$endDate	= $row['empEndDate']; 

		$empStatus	= $row['empStatus']; 
	

		$employeeList  .= "<tr>";

		$employeeList  .= '<td>';
			if (!is_null($empPhoto)) {
				$employeeList  .= '<img src="' . $empPhoto  . '" class="img-thumbnail rounded">';
			}
		$employeeList  .= '</td>';

		$employeeList  .= '<td>' . $empFname . '</td>';

		$employeeList  .= '<td>' . $empLname .'</td>';

		$employeeList .= '<td>' . $empID . '</td>';	

		$employeeList  .= '<td>' . $emptDept  . '</td>';

		$employeeList  .= '<td>';

			if ($empStatus === null || $empStatus === 'No' ) { 
				$employeeList  .= '<span class="green">Active</span>'; 
			} else {
				$employeeList  .= '<span class="red">Not Active</span>';
			}

		$employeeList  .= '</td>';	
		
		$employeeList  .= '<td class="text-center"><a class="btn btn-outline-secondary btn-sm" href="pageEmployeeProfile.php?employeeID=' . $empID .'"><i class="fa fa-edit"></i></a></td>';

		 	if (isset($_GET['employeeID'])) {
		 		include('modal_delEmployee.php'); 
		 	}
		 	
		$employeeList  .= "</tr>";
	}	
}

mysqli_close($mysqli);

?>


<div class="table-responsive">
	<table class="table align-items-center text-left" id="empTable">
		<thead class="thead-light">
          	<tr>
          		<th scope="col"></th>
				<th scope="col">First Name</th>
				<th scope="col">Last Name</th>
				<th scope="col">Employee ID</th>
				<th scope="col">Department</th>
				<th scope="col">Status</th>
				<th scope="col">Actions</th>
          	</tr>
      	</thead>
      	<tbody>
        	<?php echo $employeeList; ?>        
      	</tbody>
    </table>
</div>





		        
