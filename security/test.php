<?php /*<div class="form-group">
                                            <label class="text-uppercase">Employee Name</label>
                                            <input list="answers" id="answer" class="form-control" placeholder="Type Employee Name" class="form-control" />
                                            <datalist id="answers">
                                                <?php
                                                    $emp = "SELECT * FROM employee ORDER BY empFirstName ASC";
                                                    if ($stmt = $mysqli->prepare($emp)) {
                                                        $stmt->execute();
                                                        $stmt->bind_result($name);
                                                        $result = $stmt->get_result();
                                                        while ($row = $result->fetch_assoc()) {
                                                        $dept_id = $row['deptID']; ?>
                                                            <option data-value="<?php echo $row['deptID']; ?>"><?php echo $row['empFirstName']; ?> <?php echo $row['empLastName']; ?></option>
                                                        <?php
                                                        }
                                                        $stmt->close();
                                                    }
                                                ?>
                                            </datalist>
                                            <input type="hidden" name="answer" id="answer-hidden">
                                        </div>
                                        */ ?>

<?php

include('session.php');


if( isset( $_GET['id']) ) {

    $deptID = $_GET['id'];
    
  

    $sql = "SELECT  
            empID, empFirstName, empLastName, empPhoto, departments.DeptID, departments.deptName
            FROM 
                employee, departments
            WHERE empID = ?
        ";

    $stmt = $mysqli->prepare($sql);
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
            /* Clears the Department Name on chnage of Input field */
            $(document).on('change', 'input', function(e) {
                document.getElementById('deptName').value= " " ;
            });
            
        </script>
    <?php
    }

    $stmt->close();

} 

?>



<!-- Add Product -->
    <div class="modal fade" id="addstock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form role="form" method="POST" id="add_stock" action="add_stock.php" enctype="multipart/form-data">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Product Code</label>

                          <?php /*  <select class="form-control" name="po_code" id="p_code" onchange="run();">
                                <option>Select</option>

                                <?php
                                    $code = mysqli_query($conn, "SELECT * FROM product group by product_name");
                                    while ($prodrow = mysqli_fetch_array($code)) {
                                        $pd_id = $prodrow['productid'];
                                        ?>
                                            <option value="<?php echo $pd_id; ?>"><?php echo $prodrow['product_code']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select> */ ?>

                            <input list="products" name="po_code" id="p_code" onchange="run();" placeholder="e.g. HP CF201A"  style="width: 100%;"/>

                            <datalist id="products">
                                <?php
                                    $code = mysqli_query($conn, "SELECT * FROM product group by product_name");
                                    while ($prodrow = mysqli_fetch_array($code)) {
                                        $pd_id = $prodrow['productid'];
                                        ?>
                                            <option value="<?php echo $prodrow['product_code']; ?>">

                                        <?php
                                    }
                                ?>
                            </datalist>


                            <input type="hidden" name="p_hidden" id="p_hidden" class="form-control">
                        </div>

                        <div id="records"></div> 
                        
                        <div class="form-group">
                            <label>Quantity Received</label>
                            <input type="number" name="po_qty" id="po_qty" step="0.01" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label>Unit Price</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">$</div>
                                </div>
                                <input type="number" step="0.01" class="form-control" id="po_unit_price" name="po_unit_price" onChange="getTotal()" required />
                            </div>                      
                        </div>

                        <div class="form-group">
                            <label>Sub Total</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <div class="sub" style="position: relative;">
                                    <input type="number" step="0.01" style="width: 100%;" class="form-control" name="po_sub" id="po_sub" readonly>
                                </div>                          
                            </div>                      
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="po_ordered">Date Ordered</label>
                                <input type="date" name="po_ordered" class="form-control" />
                            </div>

                            <div class="form-group col-6">
                                <label for="po_date">Date Received</label>
                                <input type="date" name="po_date" class="form-control" />
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <select class="form-control" name="supplier">
                                <?php
                                    $supplier = mysqli_query($conn,"SELECT * FROM vendor");
                                    while ($suprow = mysqli_fetch_array($supplier)) {
                                        ?>
                                        <option value="<?php echo $suprow['vendorid']; ?>"><?php echo $suprow['vendor_name']; ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="created" style="text-transform: capitalize;" />
                            <input type="hidden" name="date_added" />
                        </div>

				    </div><!--. modal-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>					
                    </div> 

                </form>

			</div>
		</div>
    </div>
<!-- /.modal -->



<script type="text/javascript">
 
    function getTotal() {
        var qty = document.getElementById('po_qty').value;
        var price = document.getElementById('po_unit_price').value;
        var total = parseFloat(qty) * parseFloat(price);
        document.getElementById('po_sub').value = total.toFixed(2);
    }

</script>


<script type="text/javascript">
    function run() {
        document.getElementById("p_hidden").value = document.getElementById("p_code").value;
    }

    function up() {
        var dop = document.getElementById("p_hidden").value;    
        pop(dop);
    }


    $('#p_code').on('change', function() {

        var id = $(this).val();
       
        if(id) {
            $.ajax({
                type: 'GET',
                url: 'code_query.php?id=' + id,
               // url: 'code_query.php',
                //data: {'product_code': id },
                success: function (response) {
                // We get the element having id of display_info and put the response inside it
                $( '#records' ).html(response);
                //console.log('here' + id);

                }
            });
        }
    });

</script>



-------------------------------------------------------------------------------------------------------------------------------------------
empRecordQuery.php









