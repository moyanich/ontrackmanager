<?php

include('session.php');

if( isset($_GET['employeeID']) ) {

    $EID = $_GET['employeeID'];

    $attendaceList = "";

    if(!($stmt = $mysqli->prepare("SELECT * FROM empAttendance     
        WHERE empID = ?"))) {
        echo 'statement failed: (' . $mysqli->errno . ') ' . $stmt->error;
    }
        
    //2. bind
    if(!($stmt->bind_param("i", $EID))) {
        echo 'Binding parameters failed: (' . $mysqli->errno . ') ' . $stmt->error;
    }

    //3. execute
    if(!($stmt->execute() ) ) {
        echo 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) { // count the output amount

        while ($row = $result->fetch_assoc()) {

            $attLog     = $row['attendance'];

            $dateIN     = $row['DateIN'];

            $timeIN     = $row['TimeIN'];

            $timeIN     = date("g:i a", strtotime($timeIN));

            $timeOUT    = $row['TimeOUT'];

            if (is_null($timeOUT) ){
                $timeOUT = '';
            }
            else {
                $timeOUT    = date("g:i a", strtotime($timeOUT));
            }
           

            $attendaceList  .= "<tr>";

            $attendaceList  .= '<td>' . $dateIN . '</td>';

            $attendaceList  .= '<td>' . $timeIN . '</td>';

             $attendaceList  .= '<td>' . $attLog  .'</td>';

            //$attendaceList  .= '<td>' . $timeOUT . '</td>';

            $attendaceList  .= "</tr>";

        }
    }
} 

$stmt->close();
?>

<div class="table-responsive">
    <table class="table align-items-center text-left" id="AttendanceTable" data-order='[[ 2, "desc" ]]'>
        <thead class="thead-light">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Time In</th>
                <th scope="col">Attendance Count</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $attendaceList; ?>
        </tbody>
    </table>
</div>

