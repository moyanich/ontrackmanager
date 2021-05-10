<?php
include('session.php');

$mthlyRecord = "
	SELECT 
	   COUNT(CASE
	        WHEN MONTH(dateIN) = 1 THEN 1
	        ELSE NULL
	    END) AS Jan,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 2 THEN 1
	        ELSE NULL
	    END) AS Feb,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 3 THEN 1
	        ELSE NULL
	    END) AS Mar,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 4 THEN 1
	        ELSE NULL
	    END) AS Apr,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 5 THEN 1
	        ELSE NULL
	    END) AS May,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 6 THEN 1
	        ELSE NULL
	    END) AS Jun,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 7 THEN 1
	        ELSE NULL
	    END) AS Jul,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 8 THEN 1
	        ELSE NULL
	    END) AS Aug,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 9 THEN 1
	        ELSE NULL
	    END) AS Sep,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 10 THEN 1
	        ELSE NULL
	    END) AS Oct,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 11 THEN 1
	        ELSE NULL
	    END) AS Nov,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 12 THEN 1
	        ELSE NULL
	    END) AS DecTotal
	FROM
	   empAttendance
";

$stmt = $mysqli->prepare($mthlyRecord);

$stmt->execute();

$result = $stmt->get_result();

$data = array();

while($row = $result->fetch_assoc()) {

	$data[] = $row;
}



//close connection
$mysqli->close();

//now print the data
print json_encode($data);



/* works
$mthlyRecord = "
SELECT 
COUNT(empID) empID
FROM
    empAttendance
WHERE
    MONTH(dateIN) = 1
*/

/*





/*
$mthlyRecord = "
	SELECT 
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 1 THEN 1
	        ELSE NULL
	    END) AS Jan,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 2 THEN 1
	        ELSE NULL
	    END) AS Feb,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 3 THEN 1
	        ELSE NULL
	    END) AS Mar
	FROM
	    attendanceTBL
	";



SELECT 
COUNT(empID) AS totalPresent
FROM
    empAttendance
WHERE
    MONTH(dateIN) = 1



SELECT COUNT(dateIN)
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 1 THEN 1
	        ELSE NULL
	    END) AS Jan,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 2 THEN 1
	        ELSE NULL
	    END) AS Feb,
	    COUNT(CASE
	        WHEN MONTH(dateIN) = 3 THEN 1
	        ELSE NULL
	    END) AS Mar 
	
	";


	$stmt = $mysqli->prepare($mthlyRecord);
	$stmt->execute();
	$result = $stmt->get_result();

	//loop through the returned data
	

	/*foreach ($result as $row) {
		$data[] = $row["empID"];
	} */

	


/*






//query to get data from the table
$query = sprintf("SELECT parish_name, JLP, PNP, IND, OTHER FROM LiveResults ORDER BY parish_id");

//execute query
$result = $db->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row => $value) {
   $data[] = array( 'parish_name' => $value["parish_name"], 'JLP' => $value["JLP"], 'PNP' => $value["PNP"], 'IND' => $value["IND"], 'OTHER' => $value["OTHER"]    );
}



$(document).ready(function() {
	$.ajax({
		dataType: "json",
		url: "live-chart.php",
		method: "GET",
		success: function(data) {
			//console.log(data);
			var parish = [];
			var JLP = [];
			var PNP = [];
			var IND = [];
			var OTHER = [];

			for(var i in data) {
				parish.push(data[i].parish_name);
				JLP.push(data[i].JLP);
				PNP.push(data[i].PNP);
				IND.push(data[i].IND);
				OTHER.push(data[i].OTHER);
			}

			var chartdata = {
				labels: parish,
				datasets : [
					{
						label: 'JLP',
			            data: JLP,
			            backgroundColor:'rgba(153, 204, 0, 1)',
			            borderColor: ['rgba(153, 204, 0, 1)'],
			            borderWidth: 1
					},

					{
						label: 'PNP',
			            data: PNP,
			            backgroundColor: 'rgba(255, 153, 0, 1)',
			            borderColor: [ 'rgba(255, 153, 0, 1)' ],
			            borderWidth: 1
					},

					{
						label: 'IND',
			            data: IND,
			            backgroundColor: 'rgba(0, 129, 204, 1)',
			            borderColor: [ 'rgba(0, 129, 204, 1)' ],
			            borderWidth: 1
					},

					{
						label: 'OTHER',
			            data: IND,
			            backgroundColor: 'rgba(208, 216, 221, 1)',
			            borderColor: [ 'rgba(208, 216, 221, 1)' ],
			            borderWidth: 1
					}
				]
			};

			var ctx = document.getElementById("myChart").getContext('2d');

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				options: {
                    responsive: true,
                   	defaultFontSize: 8,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Parish Council Election 2016 - Preliminary Results'
                    },
                    scales: {
					    xAxes: [{
					        stacked: false,
					        beginAtZero: true,
					        scaleLabel: {
					            labelString: 'Parishes'
					        },
					        ticks: {
					            stepSize: 1,
					            min: 0,
					            autoSkip: false
					        }
					    }]
					}
                }
			});
		},

		//error: function(data) {
			//console.log(data);
		//}
	});
});
*/

?>

