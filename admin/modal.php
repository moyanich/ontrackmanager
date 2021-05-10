<!-- Logout-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
    <div class="modal-dialog modal-info modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-info">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">You are logging out!</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Do you wish to Logout <?php echo $superuser; ?>?</h4>
                </div>
            </div>
            
            <div class="modal-footer">                
                <button type="button" class="btn btn-link text-white" data-dismiss="modal">Cancel</button> 
                <a href="logout.php" class="btn btn-white text-white  ml-auto">Logout</a>
            </div>
        </div>            
    </div>
</div>
<!-- /.Logout modal -->


<!-- New Employee Modal-->
<div class="modal fade" id="empModal" tabindex="-1" role="dialog" aria-labelledby="empModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3"><small>Add Employee</small></div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Email" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Password" type="password">
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                <label class="custom-control-label" for=" customCheckLogin">
                                    <span class="text-muted">Remember me</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.New Employee Modal -->

<!-- Modal Delete User -->
<div class="modal fade" id="userModal_<?php // echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php
                $sql =  "SELECT * FROM user WHERE userid = ?";

                $stmt = $mysqli->prepare($sql);

                $stmt->bind_param("i", $id);

                $stmt->execute();

                $result = $stmt->get_result();

                if($result->num_rows === 0) exit('No rows');

                while($row = $result->fetch_assoc()) { 

                    $firstname  = $row['firstname'];

                    $lastname   = $row['lastname'];

                    $username   = $row['username']; ?>

                   <form role="form" method="POST" action="userDelete.php<?php echo '?id='.$id; ?>">
                        <div class="modal-body text-left">

                            <h5 class="pb-2">Do you wish to delete the user record for?</h5>

                            <p>Username: <strong class="text-capitalize"><?php echo $username; ?></strong></p>

                            <p>First Name: <strong class="text-capitalize"><?php echo $firstname ; ?></strong></p>
                            
                            <p>Last Name: <strong class="text-capitalize"><?php echo $lastname; ?></strong></p>

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



