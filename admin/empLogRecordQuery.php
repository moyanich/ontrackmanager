<?php
$logList = "";

$sql = "
    SELECT
        *
    FROM 
        logTBL      
        LEFT JOIN employee
        ON logTBL.empID = employee.empID
        LEFT JOIN user
        ON logTBL.userID = user.userID  
    WHERE 
        dateIN
    BETWEEN 
        (CURDATE() - INTERVAL 15 DAY) AND (CURDATE() - INTERVAL 1 DAY)
    ";

    $stmt = $mysqli->prepare($sql);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) { // count the output amount

        while ($row = $result->fetch_assoc()) {

            $userAccess = $row['access'];
            
            $logID      = $row['logID'];

            $empID      = $row['empID'];

            $empFname   = $row['empFirstName'];

            $empLname   = $row['empLastName']; 
            
            $dateIN     = $row['dateIN'];

            $timeIN     = $row['timeIN'];

            $timeIN     = date("g:i a", strtotime($timeIN));

            $timeOUT    = $row['timeOUT'];
            
            $timeOUT    = date("g:ia", strtotime($timeOUT));

            $dateOUT    = $row['dateOUT'];

            $LicNO      = $row['licNumber'];                            
            
            $message    = $row['comments'];

            $Logged     = $row['firstname'] . ' ' . $row['lastname'] ;
            
            $logList  .= "<tr>";

            $logList  .= '<td>' . $logID .'</td>';

            $logList  .= '<td>' . $empFname . ' ' . $empLname .'</td>';

            $logList  .= '<td>' . $dateIN . '</td>';

            $logList  .= '<td>' . $timeIN . '</td>';

            $logList  .= '<td>' . $Logged . '</td>';

            $logList  .= '<td class="text-center"><a data-toggle="modal" data-target="#adminlogModal' . $logID . '" class="btn btn-info btn-sm" href="#"><i class="fa fa-edit"></i></a></td>';

            include('modal_log.php');
             
            $logList  .= "</tr>";
        }
    }

    $stmt->close();
?>


<div class="table-responsive">
    <table class="table align-items-center text-left" id="fulllogTable" data-order='[[ 2, "desc" ]]'>
        <thead class="thead-light">
            <tr>
                <th scope="col">Log ID</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Time In</th>
                <th scope="col">Logged by</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $logList; ?>
        </tbody>
    </table>
</div>


