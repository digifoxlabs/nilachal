<!-- Begin Page Content -->
<div class="container-fluid">

<?php

foreach($bookData as $booking){

        $id = $booking['bk_id'];
        $booking_code = $booking['booking_code'];
        $mode = $booking['mode'];
        $booking_status = $booking['booking_status'];
        $checked_in = $booking['checked_in'];
        $checked_out = $booking['checked_out'];
        $no_guests = $booking['no_guests'];
        $payment_status = $booking['payment_status'];
        $room_assigned = $booking['room_assigned'];

        $identity  = $booking['identity'];
        $identity_no  = $booking['identity_no'];

        $guest_name = $booking['guest_name'];
        $guest_mobile = $booking['guest_mobile'];
        $guest_email = $booking['guest_email'];
        $guest_address = $booking['guest_address'];

        $cgst = $booking['cgst'];
        $sgst = $booking['sgst'];
        $discount = $booking['discount'];
        $total_amt = $booking['total_amt'];
        $amt_paid = $booking['amt_paid'];
        $balance_amt = $booking['balance_amt'];

}



?>



    <!-- Content Row -->
    <div class="row">
        <!-- First Column -->
        <div class="col-lg-8">
            <!-- Custom Text Color Utilities -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Check Out</h6>


                </div>

                <div class="card-body">
                    <!--  Content Here-->
                    <p class="mb-3">Customer Name: <?php echo $guest_name;?> </p>
              
                    <hr>



                    <?php if($balance_amt != 0)
                    {?>

                    <p class="mb-3">Booking Amount: <?php echo $total_amt;?> </p>
                    <p class="mb-3">Paid Amount: <?php echo $amt_paid;?> </p>
                    <h5 class="mb-3">Outstanding Balance: <?php echo $balance_amt ;?> </h5>

                    <hr>

                    <label>Confirm Payment of Outstanding Balance</label>
                    <form action="<?= base_url('admin/bookings/checkOut') ?>" method="post" class="user">
                        <input type="hidden" name="amount" id="amount" value="<?php echo $total_amt; ?>" />
                        <input type="hidden" name="advance" id="advance" value="<?php echo $amt_paid; ?>" />
                        <input type="hidden" name="balance" id="balance" value="<?php echo $balance_amt; ?>" />
                        <input type = "hidden" name="booking_code" value="<?= $booking_code; ?>">
                        <div class="form-group row">
                            
                         <?php if($cgst !=0) { ?>   
                          <div class="col-sm-4 mb-3 mb-sm-0">
                                
                                <label>Payment Mode</label>
                                
                                <select name = "payment_mode" class="form-control" required>
                                <option value="">Please Select</option>
                                <option value="cash">CASH</option>
                                <option value="card">CARD</option>
                                <option value="upi">UPI</option>
                                <option value="cheque">CHEQUE</option>                          						
                                </select>
                         
                            </div>
                            
                           <?php  } else {  ?> 
                            
                           <div class="col-sm-4 mb-3 mb-sm-0">

                            <label>Payment Mode</label>

                            <select name = "payment_mode" class="form-control" required>

                            <option value="cash" selected>CASH</option>

                            </select>

                        </div>
                            
                            <?php  } ?>                          
                            
                            
                            
                            <div class="col-sm-4 mb-2 mb-sm-0">
                                <button class="btn btn-primary btn-user btn-block" type="submit" name="confirm_payment">Confirm Payment</button>
                            </div>
                        </div>
                    </form> <?php     } else {?>


                    <label>Confirm Check Out</label>
                    <form action="<?= base_url('admin/bookings/checkOut') ?>" method="post" class="user">

                        <input type = "hidden" name="booking_code" value="<?= $booking_code; ?>">
                            <div class="form-group row">
                                <div class="col-sm-4 mb-2 mb-sm-0">
                                    <button class="btn btn-success btn-user btn-block" type="submit" name="confirm_checkout">Confirm</button>
                                </div>
                            </div>
                        </form>

                    <?php  } ?>

                </div>



            </div>




        </div>
    </div>










</div>