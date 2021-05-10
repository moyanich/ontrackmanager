<!-- Modal Delete Employee -->
<div class="modal fade" id="delEmployee-<?php echo $eid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Employee Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php 
                $sql =  "SELECT * FROM employee WHERE empID = ?";

                $stmt = $mysqli->prepare($sql);

                $stmt->bind_param("i", $eid);

                $stmt->execute();

                $result = $stmt->get_result();

                if($result->num_rows === 0) exit('No rows');

                while($row = $result->fetch_assoc()) { 

                    $id = $row['empID'];

                    $name = $row['empFirstName'];

                    $last_name = $row['empLastName']; ?>

                   <form role="form" method="POST" action="emp_delete_record.php<?php echo '?id='.$id; ?>">
                        <div class="modal-body text-left">
                            <h5 class="pb-2">Do you wish to delete the employee record for?</h5>
                            <p>ID Number: <?php echo $id; ?></p>
                            <p>First Name: <strong class="text-capitalize"><?php echo $name; ?></strong></p>
                            <p>Last Name: <strong class="text-capitalize"><?php echo $last_name; ?></strong></p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                   </form>

                <?php
                }
                
                $stmt->close();
            ?>
        </div>
    </div>
</div>