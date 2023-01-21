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


<div class="card-header py-3" style="display:flex;align-items: center;justify-content:space-between;">
        <h2 class="h3 mb-2 text-gray-800">Booking ID: <?php echo $booking_code;?></h2>


        <?php if($booking_status == 'confirmed'){  ?>
    
    
                <a target="" href="<?= base_url('admin/bookings/activate/'.$booking_code) ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Activate Booking</span>
                    </a>    
        

      <?php  } ?>
      
      <?php if($booking_status == 'active'){    
    
    
         if($checked_in == 2 && $checked_out != 2){  ?>

        <a href="<?= base_url('admin/bookings/roomAssign?assign='.$booking_code) ?>" class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text">Room Assign</span>
        </a>


        <?php }  ?>
    
    
    
        <?php  if($checked_out == 1){ ?>


        <a target="" href="<?= base_url('admin/bookings/checkIN?activate='.$booking_code) ?>" class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-check"></i>
            </span>
            <span class="text">Check In</span>
        </a>


                <?php if($checked_in == 2) {  ?>


                <a href="<?= base_url('admin/bookings/checkOut?booking='.$booking_code) ?>" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">Check Out</span>
                </a>


                <?php } 

         } 

        }


        if($booking_status == 'complete') {  ?>

        <a target="_blank" href="<?= base_url('admin/bookings/printInvoice?booking='.$booking_code) ?>" class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-print"></i>
            </span>
            <span class="text">Print Bill</span>
        </a>

        <?php }  
     
        ?>


    </div>
    <?php
    $session = session(); ?>
    
    <script type="text/javascript">
        <?php if($session->getFlashdata('success')): ?>
        toastr.success('<?php echo $session->getFlashdata('success'); ?>')
        <?php elseif($session->getFlashdata('error')): ?>
        toastr.warning('<?php echo $session->getFlashdata('error'); ?>');
        <?php endif; ?>
      </script>  

    <!-- Content Row -->
    <div class="row">
        <!-- First Column -->
        <div class="col-lg-5">
            <!-- Custom Text Color Utilities -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">

                            <a class="dropdown-item" href="<?= base_url('admin/bookings/update/customerdetails?booking='.$booking_code) ?>">Update</a>
                        </div>
                    </div>

                </div>

                <div class="card-body">

                    <table cellpadding="5" cellspacing="1">
                        <tr>
                            <th scope="row">
                                <div align="left">Name</div>
                            </th>
                            <td>
                                <div align="center"><strong>:</strong></div>
                            </td>
                            <td><?php echo $guest_name;?></td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <div align="left">Mobile Number</div>
                            </th>
                            <td>
                                <div align="center"><strong>:</strong></div>
                            </td>
                            <td><?php echo $guest_mobile;?></td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <div align="left">Email Id</div>
                            </th>
                            <td>
                                <div align="center"><strong>:</strong></div>
                            </td>
                            <td><?php echo $guest_email;?></td>
                        </tr>


                        <tr>
                            <th scope="row">
                                <div align="left">Identity</div>
                            </th>
                            <td>
                                <div align="center"><strong>:</strong></div>
                            </td>
                            <td><?php echo $identity.' ('.$identity_no.')';?></td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <div align="left">No. of Guests</div>
                            </th>
                            <td>
                                <div align="center"><strong>:</strong></div>
                            </td>
                            <td><?php echo $no_guests;?></td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <div align="left">Address</div>
                            </th>
                            <td>
                                <div align="center"><strong>:</strong></div>
                            </td>
                            <td><?php echo $guest_address;?></td>
                        </tr>




                    </table>

                </div>
            </div>


            <!-- Avail Actions-->

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Booking Status</h6>
                </div>
                <div class="card-body">

                    <?php if($checked_in == 2){  ?>


                    <a href="#" class="btn btn-success btn-icon-split btn-sm" style="margin:0 5px 5px 0;">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Checked IN</span>
                    </a>

                    <?php  } ?>


                    <?php if($room_assigned ==2){  ?>

                    <a href="#" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Room Assigned</span>
                    </a>


                    <?php  } ?>


                    <?php if($checked_out == 2){  ?>

                    <a href="#" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Checked Out</span>
                    </a>

                    <?php  } ?>

                </div>
            </div>
        </div>

        <!-- Second Column -->
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Reservation Mode: <?php echo $mode; ?> </h6>

                    <a href="<?= base_url('admin/bookings/update?booking='.$booking_code) ?>" class="btn btn-primary btn-icon-split btn-sm"><span class="text">Update Booking</span></a>

 

                </div>
                <div class="card-body">

                    <table class="table-bordered" cellpadding="5" cellspacing="1">
                        <tbody>

                            <tr>
                                <th style="text-align:left;">Room Type</th>
                                <th style="text-align:left;" width="10%">No. Rooms</th>
                                <th style="text-align:right;" width="10%">Rate</th>
                                <th style="text-align:center;" width="20%">From</th>
                                <th style="text-align:center;" width="20%">To</th>
                                <th style="text-align:center;" width="10%">No. Nights</th>
                                <th style="text-align:right;" width="15%">Total Amt</th>

                            </tr>

                            <?php   
    
                            $total_price = 0;

                            $this->db = \Config\Database::connect();  
    
                            $builder2 = $this->db->table('room_reservation');
                            $builder2->where('booking_code', $booking_code);
                            $reservData = $builder2->get()->getResultArray();

                            foreach($reservData as $row){

                                $r_catID = $row['room_cat'];

                                //Room Category
                                $builder3 = $this->db->table('room_category');
                                $builder3->select('category');
                                $builder3->where('cat_id', $r_catID);
                                $room_cat = $builder3->get()->getRow()->category;

                               // $room_cat = getRoomcategory($r_catID);
                                $no_rooms = $row['no_rooms'];
                               $no_nights = $row['no_nights'];
                               // $no_nights = 'xx';
                                $in = $row['check_in'];
                                $in = date('d-m-Y', strtotime($in));
                                $out = $row['check_out'];
                                $out = date('d-m-Y', strtotime($out));

                                $rate = $row['rate'];
                                $item_amt = $rate*$no_rooms*$no_nights;
                                
                                $total_price += $item_amt;
                                
                                ?>

                            <tr>

                                <td style="text-align:left;"><?php echo $room_cat; ?></td>
                                <td style="text-align:left;"><?php echo $no_rooms; ?></td>
                                <td style="text-align:left;"><?php echo $rate; ?></td>
                                <td style="text-align:left;"><?php echo $in; ?></td>
                                <td style="text-align:left;"><?php echo $out; ?></td>
                                <td style="text-align:left;"><?php echo $no_nights; ?></td>
                                <td style="text-align:right;"><?php echo $item_amt; ?></td>
                            </tr>



                            <?php   }
                            
                            ?>


                            <tr>
                                <td colspan="6" align="right">Total:</td>
                                <td align="right"><?php echo $total_price; ?></td>


                            </tr>
                            <tr>
                                <td colspan="6" align="right">CGST:</td>
                                <td align="right"><?php echo $cgst; ?></td>


                            </tr>
                            <tr>
                                <td colspan="6" align="right">SGST:</td>
                                <td align="right"><?php echo $sgst; ?></td>


                            </tr>

                           

                            <tr>
                                <td colspan="6" align="right">Discount:</td>
                                <td align="right"><?php echo "-".$discount; ?></td>

                            </tr>

                          
                            <tr>
                                <td colspan="6" align="right"><strong>Total Booking Amount:</strong></td>
                                <td align="right"><strong><?php echo $total_amt; ?></strong></td>

                            </tr>

                            <tr>
                                <td colspan="6" align="right"><strong>Amount Paid:</strong></td>
                                <td align="right"><strong><?php echo $amt_paid; ?></strong></td>

                            </tr>
                            <tr>
                                <td colspan="6" align="right"><strong>Outstanding Balance:</strong></td>
                                <td align="right"><strong><?php echo $balance_amt; ?></strong></td>

                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>


        </div>

        <!-- Third Coplumn-->
    </div>  


</div>


