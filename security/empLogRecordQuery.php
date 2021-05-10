<?php
$logList = "";

date_default_timezone_set('Bogota/Lima');
$date = date('Y-m-d');


$sql = "
	SELECT
		*
    FROM 
    	logTBL   	
	 	LEFT JOIN employee
	    ON logTBL.empID = employee.empID
	    WHERE  
		logTBL.dateIN >= CURDATE()
		";


	$stmt = $mysqli->prepare($sql);

	$stmt->execute();

	$result = $stmt->get_result();

	if ($result->num_rows > 0) { // count the output amount

		while ($row = $result->fetch_assoc()) {
			
			$openlogID		= $row['logID'];

			$empID		= $row['empID'];

			$empFname	= $row['empFirstName'];

			$empLname	= $row['empLastName']; 
			
			$dateIN		= $row['dateIN'];

			$timeIN		= $row['timeIN'];

			$timeIN	 	= date("g:i a", strtotime($timeIN));

			$timeOUT	= $row['timeOUT'];

			$licNo		= $row['licNumber'];

            if (is_null($timeOUT) ){
                $timeOUT = '';
            }
            else {
                $timeOUT    = date("g:i a", strtotime($timeOUT));
            }
			
			$logList  .= "<tr>";

			$logList  .= '<td>' . $openlogID .'</td>';

			$logList  .= '<td>' . $empFname . ' ' . $empLname .'</td>';

			$logList  .= '<td>' . $dateIN . '</td>';

			$logList  .= '<td>' . $timeIN . '</td>';

			$logList  .= '<td>' . $timeOUT . '</td>';

			$logList  .= '<td>' . $licNo . '</td>';

			$logList  .= '<td class="text-center"><a data-toggle="modal" data-target="#logModal' . $openlogID . '" class="btn btn-info btn-sm" href="#"><i class="fa fa-edit"></i></a></td>';
			 
			$logList  .= "</tr>";
		}
	}
?>

<div class="table-responsive">
	<table class="table align-items-center text-left" id="logTable" data-order='[[ 0, "desc" ]]'>
		<thead class="thead-light">
          	<tr>
          		<th scope="col">Log ID</th>
				<th scope="col">Name</th>
				<th scope="col">Date</th>
				<th scope="col">Time In</th>
				<th scope="col">Time Out</th>
				<th scope="col">Lic No.</th>
				<th scope="col">Edit</th>
          	</tr>
      	</thead>
      	<tbody>
        	<?php echo $logList; ?>
      	</tbody>
    </table>
</div>


