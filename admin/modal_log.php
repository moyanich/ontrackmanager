<!-- New Log Modal-->
<div class="modal fade" id="adminlogModal<?php echo $logID; ?>" tabindex="-1" role="dialog" aria-labelledby="logModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card shadow border-0">
                    <div class="card-header bg-transparent">
                        <div class="text-center mt-2 text-uppercase"><h2 style="font-weight: 900">Edit Log Record</h2></div>	
                        <div class="col-12 text-right">
                        	<?php if ($useraccess == '0') { ?>
                        		<a href="empLogDelete.php?logID=<?php echo $logID; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete Record</a>
                        	<?php } ?>
                    	</div>		                        
                    </div>

                    <div class="card-body px-lg-5 py-lg-5">	
			                    		                    	
                        <form role="form" enctype="multipart/form-data" method="POST" action="empLogUpdateQuery.php<?php echo '?id='.$logID; ?>">	

                        	<div class="row">
                        		<div class="col-6">
		                            <div class="form-row">
		                               <div class="col-4">
		                                    <div class="form-group">
		                                        <label class="text-uppercase">Log ID</label>
		                                        <input type="number" name="newLogID" class="form-control" value="<?php echo $logID; ?>" disabled/>
		                                    </div>
		                                </div>
		                           </div>

		                            <div class="form-row">
		                                <div class="col-12">
		                                    <div class="form-group">
		                                        <label class="text-uppercase">Employee Name</label>
		                                        <input type="text" name="newEmpName" class="form-control" value="<?php echo $empFname . ' ' . $empLname; ?>" disabled/>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="form-row">
		                                <div class="col-12">
		                                    <label class="text-uppercase">Licence Plate No.</label>
		                                    <input type="text" name="NewlicNo" value="<?php echo $LicNO; ?>" class="form-control" <?php if ($useraccess == '1') { echo "disabled"; } ?>>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="col-6 d-flex justify-content-center align-items-center">
		                        	<?php
						            $emptPhoto = $row['empPhoto'];
						            if (!is_null($emptPhoto)) {
						               echo '<img src="' . $emptPhoto  . '" class="img-thumbnail emp-photo">';
							        } ?>
		                        </div>
	                        </div>

                            <div class="form-row">
                                <div class="col-5">
                                    <label class="text-uppercase">Date In</label>
                                    <input type="date" name="newDateIn" value="<?php echo $dateIN; ?>" class="form-control" <?php if ($useraccess == '1') { echo "disabled"; } ?>>
                                </div>
                                <div class="col-5">
                                    <label class="text-uppercase">Time In</label>
                                    <input type="text" id="basicNewTimeIn-<?php echo $logID; ?>" value="<?php echo $timeIN; ?>" name="newTimeIn" class="ui-timepicker-input form-control" <?php if ($useraccess == '1') { echo "disabled"; } ?>>
                                    <script>			                                    	
                                    	$(document).ready(function() {
                                    		var newTime = '#basicNewTimeIn-' + <?php echo $logID; ?>;
											$(newTime).timepicker({
												'getTime': true,
												'timeFormat': 'g:i a',
											});
										}); 
                                    </script>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-5">
                                    <label class="text-uppercase">Date Out</label>
                                    <input type="date" name="newDateOut" value="<?php echo $dateOUT; ?>" class="form-control" <?php if ($useraccess == '1') { echo "disabled"; } ?>>
                                </div>
                                <div class="col-5">
                                    <label class="text-uppercase">Time Out</label>
                                    <input type="text" id="basicNewTimeOut-<?php echo $logID; ?>" value="<?php echo $timeOUT; ?>" name="newTimeOut" class="ui-timepicker-input form-control" <?php if ($useraccess == '1') { echo "disabled"; } ?>>

                                    <script>		                                    	
                                    	$(document).ready(function() {
                                    		var newTime = '#basicNewTimeOut-' + <?php echo $logID; ?>;
											$(newTime).timepicker({
												'getTime': true,
												'scrollDefault': 'now',
												'timeFormat': 'g:i a',
											});
										}); 
                                    </script>
                                    
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-12">
                                    <label class="text-uppercase">Comments</label>
                                    <textarea name="newComments" class="form-control" rows="6" placeholder="Enter Comments" <?php if ($useraccess == '1') { echo "disabled"; } ?>><?php echo $message; ?></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Update" <?php if ($useraccess == '1') { echo "disabled"; } ?>/>
                                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.New Log Modal -->
