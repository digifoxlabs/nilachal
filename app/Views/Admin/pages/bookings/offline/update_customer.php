<!-- Begin Page Content -->
<div class="container-fluid">

<?php

foreach($bookData as $booking){

        $id = $booking['bk_id'];
        $booking_code = $booking['booking_code'];
        $mode = $booking['mode'];
        $no_guests = $booking['no_guests'];
        $payment_status = $booking['payment_status'];
        $room_assigned = $booking['room_assigned'];
        $identity  = $booking['identity'];
        $identity_no  = $booking['identity_no'];
        $guest_name = $booking['guest_name'];
        $guest_mobile = $booking['guest_mobile'];
        $guest_email = $booking['guest_email'];
        $guest_address = $booking['guest_address'];
}

?>

<div class="card-header py-3" style="display:flex;align-items: center;justify-content:space-between;">
        <h2 class="h3 mb-2 text-gray-800">Booking ID: <?php echo $booking_code;?></h2>

        <a id="go_back_button" href="<?= base_url('admin/bookings/view/'.$booking_code) ?>" class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-chevron-left"></i>
            </span>
            <span class="text">GO Back</span>
        </a>


    </div>

        <!-- Content Row -->
        <div class="row" height="200px">
        <!-- First Column -->
        <div class="col-lg-12">
            <!-- Custom Text Color Utilities -->
            <div class="card shadow mb-4" style="min-height:50vh;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
                </div>
                <div class="card-body">

                <form action="<?= base_url('admin/bookings/update/customerdetails') ?>" method="post" class="user">
        <input type="hidden" name="row_id" value="<?= $booking_code; ?>" />
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Customer Name</label>
                    <input type="text" class="form-control " name="name" placeholder="Full Name of Customer" value="<?= $guest_name; ?>" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Contact Number</label>
                    <input type="text" class="form-control" name="mobile" placeholder="10 digit mobile number" value="<?= $guest_mobile; ?>" autocomplete="off" required>
                </div>

                <div class="col-sm-6">
                    <label>Email ID</label>
                    <input type="text" class="form-control" name="email" placeholder="Email ID" value="<?= $guest_email; ?>" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label>ID Card Type</label>
                    <input type="text" class="form-control" name="identity" placeholder="PAN/AADHAR/DL" value="<?= $identity; ?>" autocomplete="off" required>
                </div>
                <div class="col-sm-4">
                    <label>ID Card Number</label>
                    <input type="text" class="form-control" name="identity_no" placeholder="ID Number" value="<?= $identity_no; ?>" autocomplete="off" required>
                </div>  
                
                <div class="col-sm-4">
                    <label>No. of Guests</label>
                    <input type="number" min=1 class="form-control" name="no_guests" placeholder="Guests" value="<?= $no_guests; ?>" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea id="address" class="form-control" name="address" rows="4" cols="12" autocomplete="off" required> <?= $guest_address; ?></textarea>
            </div>

            <div class="form-group">

                <div class="col-sm-3">
                    <hr>
                    <button class="btn btn-primary btn-user btn-block" type="submit" name="update">UPDATE</button>
                    <hr>
                </div>
            </div>

        </form>





                </div>
            </div>
        </div>

        </div>

        </div>
        
    