<?php
$currDir = dirname(__FILE__);

include_once("$currDir/header.php"); 

/* ---------------------Generate Report----------------------*/

include('../admin/session.php');

$type 		= 	$_POST['report_type'];
$dateStart	=	$_POST['r_start_date'];
$dateEnd 	=	$_POST['r_end_date'];
$EmpID 		= 	$_POST['answer']; 
$deptID 	= 	$_POST['reportDept']; 


$dateList = "";
//If connect fails display message
if($mysqli->connect_error) {
	die("Database Connection Failed: " . $mysqli->connect_error);
}

if(isset($_POST['submit']) && ($type=='reportDate')) {
	//1. Prepare statement
	if(!($stmt = $mysqli->prepare("SELECT 
		*
		FROM logTBL      
	        LEFT JOIN employee
	        ON logTBL.empID = employee.empID
		WHERE dateIN
			BETWEEN ? AND  ?
		ORDER BY dateIN") )) {
		echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}

	//2. bind
	if(!($stmt->bind_param('ss', $dateStart, $dateEnd ) )) {
		echo 'Binding parameters failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}

	//3. execute
	if(!($stmt->execute() ) ) {
		echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	$result = $stmt->get_result();

	//if($result->num_rows === 0) { exit('No rows'); } // count the output amount


		while($row = $result->fetch_assoc()) {
			$logID		= $row['logID'];
			$empID		= $row['empID'];
			$empFname	= $row['empFirstName'];
			$empLname	= $row['empLastName']; 
			$dateIN		= $row['dateIN'];
			$dateIN		= strftime("%b %d, %Y", strtotime($dateIN));
			$timeIN		= $row['timeIN'];
			$timeIN 	= date("g:i a", strtotime($timeIN));
			$dateOUT	= $row['dateOUT'];
			$timeOUT	= $row['timeOUT'];

			if (is_null($dateOUT) ){
	            $dateOUT = '';
	        }
	        else {
	            $dateOUT = strftime("%b %d, %Y", strtotime($dateOUT));
	        }
	        
			
			if (is_null($timeOUT) ){
                $timeOUT = '';
            }
            else {
                $timeOUT = date("g:i a", strtotime($timeOUT));
            }

			$Lic 		= $row['licNumber'];
			$comments 	= $row['comments']; 

			$dateList  .= "<tr>";
				$dateList  .= '<td>' . $logID . '</td>';
				$dateList  .= '<td>' . $empFname . '</td>';
				$dateList  .= '<td>' . $empLname . '</td>';
				$dateList  .= '<td></td>';
				$dateList  .= '<td>' . $dateIN . '</td>';
	            $dateList  .= '<td>' . $timeIN . '</td>';
	            $dateList  .= '<td>' . $dateOUT . '</td>';
	            $dateList  .= '<td>' . $timeOUT  .'</td>';
	            $dateList  .= '<td class="text-uppercase">' . $Lic  .'</td>';
	            $dateList  .= '<td>' . $comments  .'</td>';
	        $dateList  .= "</tr>";

		} //endWhile
	 //endElse
	$stmt->close();
}//endIf


else if(isset($_POST['submit']) && ($type=='reportPresent')) {
	//1. Prepare statement
	if(!($stmt = $mysqli->prepare("SELECT 
		DISTINCT employee.empFirstName, employee.empLastName, logTBL.logID, logTBL.dateIN
		FROM employee      
	        LEFT JOIN logTBL
	        ON employee.empID = logTBL.empID
		WHERE dateIN
			BETWEEN ? AND  ?
		ORDER BY dateIN") )) {
		echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}

	//2. bind
	if(!($stmt->bind_param('ss', $dateStart, $dateEnd ) )) {
		echo 'Binding parameters failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}

	//3. execute
	if(!($stmt->execute() ) ) {
		echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	$result = $stmt->get_result();

	//if($result->num_rows === 0) { exit('No rows'); } // count the output amount


		while($row = $result->fetch_assoc()) {
			$logID		= $row['logID'];
			//$empID		= $row['empID'];
			$empFname	= $row['empFirstName'];
			$empLname	= $row['empLastName']; 
			$dateIN		= $row['dateIN'];
			$dateIN		= strftime("%b %d, %Y", strtotime($dateIN));
			//$timeIN		= $row['timeIN'];
			//$timeIN 	= date("g:i a", strtotime($timeIN));
			//$dateOUT	= $row['dateOUT'];
			//$timeOUT	= $row['timeOUT'];

			/* if (is_null($dateOUT) ){
	            $dateOUT = '';
	        }
	        else {
	            $dateOUT = strftime("%b %d, %Y", strtotime($dateOUT));
	        }
	        
			
			if (is_null($timeOUT) ){
                $timeOUT = '';
            }
            else {
                $timeOUT = date("g:i a", strtotime($timeOUT));
            }

			$Lic 		= $row['licNumber'];
			$comments 	= $row['comments'];   */

			$dateList  .= "<tr>";
				$dateList  .= '<td>' . $logID . '</td>';
				$dateList  .= '<td>' . $empFname . '</td>';
				$dateList  .= '<td>' . $empLname . '</td>';
				$dateList  .= '<td></td>';
				$dateList  .= '<td>' . $dateIN . '</td>';
	           // $dateList  .= '<td>' . $timeIN . '</td>';
	           // $dateList  .= '<td>' . $dateOUT . '</td>';
	           // $dateList  .= '<td>' . $timeOUT  .'</td>';
	           // $dateList  .= '<td class="text-uppercase">' . $Lic  .'</td>';
	           // $dateList  .= '<td>' . $comments  .'</td>';
	        $dateList  .= "</tr>";

		} //endWhile
	 //endElse
	$stmt->close();
}//endIf



else if(isset($_POST['submit']) && ($type=='reportName')) {
	//1. Prepare statement
	if(!($stmt = $mysqli->prepare("SELECT 
		*
		FROM logTBL      
	        LEFT JOIN employee
	        ON logTBL.empID = employee.empID
		WHERE 
			employee.empID = '$EmpID'
        	AND dateIN BETWEEN '$dateStart' AND '$dateEnd'

		ORDER BY dateIN

		") )) {
		echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}


	//3. execute
	if(!($stmt->execute() ) ) {
		echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	$result = $stmt->get_result();

	//if($result->num_rows === 0) { exit('No rows'); } // count the output amount


		while($row = $result->fetch_assoc()) {
			$logID		= $row['logID'];
			$empID		= $row['empID'];
			$empFname	= $row['empFirstName'];
			$empLname	= $row['empLastName']; 
			$dateIN		= $row['dateIN'];
			$dateIN		= strftime("%b %d, %Y", strtotime($dateIN));
			$timeIN		= $row['timeIN'];
			$timeIN 	= date("g:i a", strtotime($timeIN));
			$dateOUT	= $row['dateOUT'];

			if (is_null($dateOUT) ){
	            $dateOUT = '';
	        }
	        else {
	            $dateOUT	= strftime("%b %d, %Y", strtotime($dateOUT));
	        }

			
			$timeOUT	= $row['timeOUT'];
			$timeOUT 	= date("g:i a", strtotime($timeOUT));
			$Lic 		= $row['licNumber'];
			$comments 	= $row['comments']; 

			$dateList  .= "<tr>";
				$dateList  .= '<td>' . $logID . '</td>';
				$dateList  .= '<td>' . $empFname . '</td>';
				$dateList  .= '<td>' . $empLname . '</td>';
				$dateList  .= '<td></td>';
				$dateList  .= '<td>' . $dateIN . '</td>';
	            $dateList  .= '<td>' . $timeIN . '</td>';
	            $dateList  .= '<td>' . $dateOUT . '</td>';
	            $dateList  .= '<td>' . $timeOUT  .'</td>';
	            $dateList  .= '<td class="text-uppercase">' . $Lic  .'</td>';
	            $dateList  .= '<td>' . $comments  .'</td>';
	        $dateList  .= "</tr>";

		} //endWhile
	 //endElse
	$stmt->close();
	
}//endIf

else if(isset($_POST['submit']) && ($type=='reportDept')) {
	//1. Prepare statement
	if(!($stmt = $mysqli->prepare("SELECT 
		*
		FROM logTBL      
	        LEFT JOIN employee
	        ON logTBL.empID = employee.empID
	        LEFT JOIN departments
	        ON departments.DeptID = employee.deptID
		WHERE 
			employee.deptID = '$deptID'
        	AND dateIN BETWEEN '$dateStart' AND '$dateEnd'

		ORDER BY dateIN

		") )) {
		echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
	}


	//3. execute
	if(!($stmt->execute() ) ) {
		echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
	}

	$result = $stmt->get_result();

	//if($result->num_rows === 0) { exit('No rows'); } // count the output amount


		while($row = $result->fetch_assoc()) {
			$logID		= $row['logID'];
			$empID		= $row['empID'];
			$empFname	= $row['empFirstName'];
			$empLname	= $row['empLastName']; 
			$dept 		= $row['deptName']; 		
			$dateIN		= $row['dateIN'];
			$dateIN		= strftime("%b %d, %Y", strtotime($dateIN));
			$timeIN		= $row['timeIN'];
			$timeIN 	= date("g:i a", strtotime($timeIN));
			$dateOUT	= $row['dateOUT'];

			if (is_null($dateOUT) ){
	            $dateOUT = '';
	        }
	        else {
	            $dateOUT	= strftime("%b %d, %Y", strtotime($dateOUT));
	        }

			
			$timeOUT	= $row['timeOUT'];
			$timeOUT 	= date("g:i a", strtotime($timeOUT));
			$Lic 		= $row['licNumber'];
			$comments 	= $row['comments']; 

			$dateList  .= "<tr>";
				$dateList  .= '<td>' . $logID . '</td>';
				$dateList  .= '<td>' . $empFname . '</td>';
				$dateList  .= '<td>' . $empLname . '</td>';
				$dateList  .= '<td>' . $dept . '</td>';
				$dateList  .= '<td>' . $dateIN . '</td>';
	            $dateList  .= '<td>' . $timeIN . '</td>';
	            $dateList  .= '<td>' . $dateOUT . '</td>';
	            $dateList  .= '<td>' . $timeOUT  .'</td>';
	            $dateList  .= '<td class="text-uppercase">' . $Lic  .'</td>';
	            $dateList  .= '<td>' . $comments  .'</td>';
	        $dateList  .= "</tr>";

		} //endWhile
	 //endElse
	$stmt->close();
	
}//endIf


?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Report for period <strong><?php echo $dateStart . ' - ' .  $dateEnd; ?></strong></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-12 mb-4">
            <div class="card card-profile shadow">
                <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
                    <h6 class="m-0 font-weight-bold text-primary">Report</h6>
                   <!--	<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="exportTableToExcel('dateReport', 'dateRangeReport')"><i class="fas fa-download fa-sm text-white-50"></i>Download Report</button> -->
                </div>

                <div class="card-body">
					<div class="table-responsive">
					    <table class="table table-striped align-items-center text-left" id="attendanceReport" data-order='[[ 2, "asc" ]]'>
					        <thead class="thead-light">
					            <tr>
					            	<th scope="col">Log#</th>
					            	<th scope="col">First Name</th>
					            	<th scope="col">Last Name</th>
					            	<th scope="col">Department</th>
					                <th scope="col">Date In</th>
					                <th scope="col">Time In</th>
					                <th scope="col">Date Out</th>
					                <th scope="col">Time Out</th>
					                <th scope="col">Licence #</th>
					                <th scope="col">Comments</th>
					            </tr>
					        </thead>
					        <tbody>
					            <?php echo $dateList; ?>
					        </tbody>
					    </table>
					</div>

				</div>
			</div>
		</div>
	</div><!-- .Content Row -->


	<script type="text/javascript">
		$(document).ready(function(){
			$("table").tableExport({
				headers: true,                      // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
				footers: true,                      // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
				formats: ["xlsx", "csv", "txt"],    // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
				filename: "id",                     // (id, String), filename for the downloaded file, (default: 'id')
				bootstrap: true,                   // (Boolean), style buttons using bootstrap, (default: true)
				exportButtons: true,                // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
				position: "top",                 // (top, bottom), position of the caption element relative to table, (default: 'bottom')
				ignoreRows: null,                   // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
				ignoreCols: null,                   // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
				trimWhitespace: true,               // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
				RTL: false,                         // (Boolean), set direction of the worksheet to right-to-left (default: false)
				sheetname: "id"                     // (id, String), sheet name for the exported spreadsheet, (default: 'id')
			});
		});	
	</script>


	<!-- Footer -->
	<?php include("{$currDir}/footer.php"); ?>
	
 /div>



