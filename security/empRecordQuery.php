<?php

include('session.php');

if( isset( $_GET['id']) ) {

    $empID = $_GET['id'];

    //$stmt = $mysqli->prepare("SELECT * FROM employee WHERE employee.empID  = ?");

    /*   $sql = mysqli_query($conn, "SELECT * FROM product 
    LEFT JOIN category ON product.fk_categoryid = category.categoryid
    WHERE product_code='$pid'"); */


    //SELECT * FROM employee LEFT JOIN departments ON employee.deptID = departments.DeptID WHERE employee.empID = 2137;

    $sql = "SELECT * FROM employee LEFT JOIN departments ON employee.deptID = departments.DeptID  WHERE employee.empID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $empID);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0) exit('No Department Results');

    while($row = $result->fetch_assoc()) { ?>
        <div class="form-row">
            <div class="col-12 col-md-6 mb-3">
                <label class="text-uppercase">Department</label>
                <input type="text" id="deptName" name="deptName" value="<?php echo $row['deptName']; ?>" class="form-control" readonly>
            </div>

            <?php /*
            $emptPhoto = $row['empPhoto'];
            if (!is_null($emptPhoto)) {
                echo '<div class="col-12 col-md-6">';
                    echo '<img src="' . $emptPhoto  . '" class="img-thumbnail">';
                echo '</div>';
            } */ ?>
         
        </div>
        
        <script type="text/javascript">
            /* 
            * Clears the Department Name on change of Input field 
            */
            $(document).on('change', 'input', function(e) {
                document.getElementById('deptName').value= " " ;
            });
            
        </script>
    <?php
    }

    $stmt->close();

} 
?>





<?php
/*
if( isset( $_GET['id']) ) {

	$deptID = $_GET['id'];

    $stmt = $mysqli->prepare("SELECT * FROM departments WHERE DeptID = ?");
    $stmt->bind_param("s", $deptID);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0) exit('No Department Results');
    while($row = $result->fetch_assoc()) { ?>
        <div class="form-row">
            <div class="col-6">
                <label class="text-uppercase">Department</label>
                <input type="text" id="deptName" name="deptName" value="<?php echo $row['deptName']; ?>" class="form-control" readonly>
            </div>
        </div>

        <script type="text/javascript">
            /* 
            * Clears the Department Name on chnage of Input field 
            */
            /*
            $(document).on('change', 'input', function(e) {
                document.getElementById('deptName').value= " " ;
            });
            
        </script>
    <?php
    }

    $stmt->close();

} 

*/

