<!-- Modal Edit Employee -->
<div class="modal fade" id="editEmpRecord-<?php echo $employeeID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalUpdate" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Employee Informaton</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="employee_details" class="text-left" enctype="multipart/form-data" method="POST" action="emp_update_record.php<?php echo '?id='.$employeeID; ?>"> 

                    <div class="form-row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Employee ID</label>
                                <input type="number" name="newEmpID" class="form-control" value="<?php echo $employeeID; ?>">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label>Replace Employee Photo</label>
                                <input type="file" name="newFileField" id="fileField" class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="newEmpFName" class="form-control" value="<?php echo $empFName; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="newEmpLName" class="form-control" value="<?php echo $empLName; ?>">
                            </div>
                        </div>
                    </div>


                    <?php /*
                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Employment Start Date</label>
                                <div class="input-group">
                                     <?php
                                        /*
                                            * Check if Time IN value is set 
                                            * If the row is emoty output an empty value
                                        */ 
                                        /*
                                        if (is_null($row['empStartDate'])) {
                                            $startDate = '';
                                        } else {
                                            $startDate = $row['empStartDate'];
                                        }
                                     ?>
                                    <input type="text" id="admindatestarttimepicker" name="newEmpStartDate" value="<?php echo $startDate; ?>"  class="form-control" data-toggle="admindatestarttimepicker">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58" aria-hidden="true"></i></span>
                                    </div>                  
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Employment End Date</label>
                                <div class="input-group">
                                    <?php
                                        /*
                                            * Check if Time IN value is set 
                                            * If the row is emoty output an empty value
                                        */
                                        /*if (is_null($row['empEndDate'])) {
                                            $endDate = 'NULL';
                                        } else {
                                            $endDate = $row['empEndDate'];
                                        } */
                                        /*
                                     ?>
                                    <input type="text" id="admindateendtimepicker" name="newEmpEndDate" value="<?php echo $endDate; ?>" class="form-control" data-toggle="admindateendtimepicker">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58" aria-hidden="true"></i></span>
                                    </div>                  
                                </div>
                            </div>
                        </div>
                    </div>
                    */ ?>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="newGender">
                                    <?php 
                                    echo '<option value="' . $gender . '">' . $gender . '</option>';
                                    if ($gender == null) { 
                                        echo '<option value="male">Male</option>';
                                        echo '<option value="female">Female</option>';
                                    }
                                    ?>                                
                                </select>  
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" name="newEmpPosition" class="form-control" value="<?php echo $empPosition; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                       <div class="col">
                            <div class="form-group">
                                <label for="newDepartment">Department</label>
                                <select class="form-control" name="newDept">
                                    <option value="<?php echo $emptDeptID ?>"><?php echo $row['deptName']; ?></option>
                                    <?php
                                        $sql = mysqli_query($mysqli, "SELECT * FROM departments WHERE DeptID != '".$emptDeptID."'");
                                        while ($deptrow = mysqli_fetch_array($sql)) {
                                            $deptIDlog = $row['DeptID'];  ?>

                                            <option value="<?php echo $deptIDlog; ?>"><?php echo $deptrow['deptName']; ?></option>                                           
                                        <?php
                                        }
                                    ?>                                
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="newEmpType">Employment Type</label>
                                <select class="form-control" name="newEmpContract">
                                    <option value="<?php echo $empType; ?>"><?php echo $empTypeName; ?></option>
                                    <?php
                                      $stmtType = $mysqli->prepare("SELECT * FROM employeeType WHERE typeID != ?");
                                      $stmtType->bind_param('i', $empType);
                                      $stmtType->execute();
                                      $result = $stmtType->get_result();

                                        if ($result->num_rows > 0) { // count the output amount
                                            while ($rowType = $result->fetch_assoc()) {
                                                $empTypeID = $rowType['typeID'];  ?>
                                                <option value="<?php echo $empTypeID; ?>"><?php echo $rowType['employeeType']; ?></option>        
                                            <?php
                                            }
                                        } 
                                        $stmtType->close();
                                    ?>                                
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="newAddress" class="form-control"><?php echo $empAddress; ?></textarea>  
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <input type="submit" name="update" class="btn btn-primary" value="Update Record" />
                    </div>
                </form>  
            </div>
        </div>
    </div>
</div>