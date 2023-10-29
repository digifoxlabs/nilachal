<!-- Begin Page Content -->
<div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Preview Booking</h6>
    </div>
    <div class="card-body">


        <!--Rooms Selected-->
        <div id="shopping-cart">

            <?php
            if(isset($_SESSION["cart_item"])){
            $total_quantity = 0;
            $total_price = 0;
            ?>
            <table class="table table-bordered" cellpadding="10" cellspacing="1">
                <tbody>
                    <tr>
                        <th style="text-align:left;">Room Type</th>
                        <th style="text-align:left;">No. of Nights</th>
                        <th style="text-align:right;" width="5%">Rooms</th>
                        <th style="text-align:right;" width="10%">Unit Price</th>
                        <th style="text-align:right;" width="15%">Price</th>
                    </tr>
                    <?php		
            foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["quantity"]*$item["price"]*$item["nights"];
                ?>
                    <tr>
                    <td><?php echo $item["name"].'||'.$item['occupancy']; ?></td>
                        <td><?php echo $item["nights"]; ?></td>
                        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                        <td style="text-align:right;"><?php echo "Rs. ".$item["price"]; ?></td>
                        <td style="text-align:right;"><?php echo "Rs. ". number_format($item_price,2); ?></td>

                    </tr>
                    <?php
                        $total_quantity += $item["quantity"];
                        $total_price += ($item["price"]*$item["quantity"]*$item["nights"]);
                }
                ?>
                    
                    
               <?php 
        
                    $sgst = $gst_applied/2 ;
                    $cgst = $gst_applied/2 ;        
                    $sgst1 = $sgst*.01;
                    $cgst1 = $cgst*.01;        
                    $sgst_a = $total_price*$sgst1;
                    $cgst_a = $total_price*$cgst1;        
                    $grand_total = $total_price+$sgst_a+$cgst_a;                                
                                
                                
                ?>                 
                                
                                
                        <tr>
                        <td colspan="3" align="right">CGST</td>
                        <td style="text-align:right;">@ <?php echo $cgst; ?> %</td>
                        <td style="text-align:right;"><?php echo number_format($cgst_a,2); ?></td>

                        </tr>
                                           
                        <tr>
                        <td colspan="3" align="right">SGST</td>
                        <td style="text-align:right;">@ <?php echo $sgst; ?> %</td>
                        <td style="text-align:right;"><?php echo number_format($sgst_a,2); ?></td>

                        </tr>
                                
                                
                                
                                <tr>
                                    <td colspan="2" align="right">Total:</td>
                                    <td align="right"><?php echo $total_quantity; ?></td>
                                    <td align="right" colspan="2"><strong><?php echo "Rs. ".number_format($grand_total, 2); ?></strong></td>

                                </tr>
                    
                    
                </tbody>
            </table>
            <?php
        } else {
        ?>
            <div class="no-records">Your Cart is Empty</div>
            <?php 
        }
        ?>

            <!--Rooms Selected End -->


            <!-- Customer Details-->

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
                </div>
                <div class="card-body">
                    <!--  Content Here-->
                    <form action="<?= base_url('admin/bookings/offline/preview') ?>" method="post" class="user">
                         <input type="hidden" name="action" value="save" />
                         <input type="hidden" name="sgst" value="<?php echo $sgst_a;  ?>" />
                         <input type="hidden" name="cgst" value="<?php echo $cgst_a;  ?>" />
                         <input type="hidden" name="total_price" value="<?php echo $total_price;  ?>" />
                        
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $_POST["name"] ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="mobile" value="<?php echo $_POST["mobile"] ?>" required>
                            </div>

                            <div class="col-sm-6">
                                <label>Email ID</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $_POST["email"] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label>ID Card Type</label>
                                <input type="text" class="form-control" name="identity" value="<?php echo $_POST["identity"] ?>" required>
                            </div>
                            <div class="col-sm-4">
                                <label>ID Card Number</label>
                                <input type="text" class="form-control" name="identity_no" value="<?php echo $_POST["identity_no"] ?>" required>
                            </div>    
                            
                            <div class="col-sm-4">
                                <label>Guests</label>
                                <input type="text" class="form-control" name="no_guests" value="<?php echo $_POST["no_guests"] ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea id="address" class="form-control" name="address" rows="4" cols="12" required><?php echo $_POST["address"] ?> </textarea>
                        </div>

                        <hr>

                        <h6 class="m-0 font-weight-bold text-primary">Payment Details</h6>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-2">
                                <label>Booking Amount</label>
                                <input type="text" class="form-control" name="book_amt" id="book_amt" value="<?php echo $grand_total; ?>" readonly>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label>Discount</label>
                                <input type="text" class="form-control" name="discount" id="discount" value="<?php echo $discount; ?>" readonly>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label>Payable Amount</label>
                                <input type="text" class="form-control" name="payable_amt" id="payable_amt" value="<?php echo $grand_total-$discount; ?>" readonly>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label>Amount Paid</label>
                                <input type="text" class="form-control" name="amt_paid" id="amt_paid"  onkeyup="balanceAmt()" required>
                            </div>

                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label>Balance</label>
                                <input type="text" class="form-control" name="balance_amt" id="balance_amt" readonly>
                            </div> 
                            
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                
                                <label>Payment Mode</label>
                                
                                <select name = "payment_mode" class="form-control" required>
                                <option value="">Please Select</option>
                                <option value="cash">CASH</option>
                                <option value="card">CARD</option>
                                <option value="upi">UPI</option>
                                <option value="cheque">CHEQUE</option>                          						
                                <option value="cheque">NA</option>                          						
                                </select>
                         
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <hr>
                                <button class="btn btn-primary btn-user btn-block" type="submit" name="book_room">SAVE</button>
                                <hr>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>



</div>

<script type="text/javascript">
    $(document).ready(function() {
        balanceAmt();

    });

    function balanceAmt() {

        var total = document.getElementById("payable_amt").value;
        var paid = document.getElementById("amt_paid").value;
        var balance = total - paid;
        //        var balance = parseInt(total_amt) - parseInt(advance);
        document.getElementById("balance_amt").value = balance;
    }

</script>
