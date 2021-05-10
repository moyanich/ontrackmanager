<?php
include('session.php');

    //$id = $_GET['employeeID'];

	$singleRecord = "
		SELECT 
		   COUNT(CASE
		        WHEN MONTH(DateIN) = 1 THEN 1
		        ELSE NULL
		    END) AS Jan,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 2 THEN 1
		        ELSE NULL
		    END) AS Feb,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 3 THEN 1
		        ELSE NULL
		    END) AS Mar,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 4 THEN 1
		        ELSE NULL
		    END) AS Apr,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 5 THEN 1
		        ELSE NULL
		    END) AS May,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 6 THEN 1
		        ELSE NULL
		    END) AS Jun,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 7 THEN 1
		        ELSE NULL
		    END) AS Jul,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 8 THEN 1
		        ELSE NULL
		    END) AS Aug,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 9 THEN 1
		        ELSE NULL
		    END) AS Sep,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 10 THEN 1
		        ELSE NULL
		    END) AS Oct,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 11 THEN 1
		        ELSE NULL
		    END) AS Nov,
		    COUNT(CASE
		        WHEN MONTH(DateIN) = 12 THEN 1
		        ELSE NULL
		    END) AS DecTotal
		FROM
		   empAttendance
		WHERE empID = ?
	";

$stmt = $mysqli->prepare($singleRecord);

$stmt->bind_param("i", $id );

$stmt->execute();

$result = $stmt->get_result();

$data = array();

while($row2 = $result->fetch_assoc()) {

	$data[] = $row2;
}

//now print the data
print json_encode($data);

//close connection
$mysqli->close();


?>

