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

<div class="card shadow mb-4">
        <div class="card-header py-3" style="display:flex;align-items: center;justify-content:space-between;">
            <h6 class="m-0 font-weight-bold text-primary">Room Assign: <?php echo $booking_code;?></h6>
            <a id="go_back_button" href="<?= base_url('admin/bookings/view/'.$booking_code) ?>" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-chevron-left"></i>
                </span>
                <span class="text">GO Back</span>
            </a>
        </div>
        <div class="card-body">




            <form action="" method="post">

                <table class="table-bordered" cellpadding="5" cellspacing="1">

                    <tr>
                        <th style="text-align:left;">Room Type</th>
                        <th style="text-align:right;" width="10%">No. of Rooms</th>
                        <th style="text-align:center;" width="10%">From</th>
                        <th style="text-align:center;" width="10%">To</th>
                        <th style="text-align:center;" width="10%">No. Nights</th>
                        <th style="text-align:center;" width="20%">Room(s) Allotted</th>
                        <th style="text-align:center;" width="20%">SELECT</th>


                    </tr>


                    <?php   
    
                            $total_price = 0;
    
                            $this->db = \Config\Database::connect();  
    
                            $builder2 = $this->db->table('room_reservation');
                            $builder2->where('booking_code', $booking_code);
                            $reservData = $builder2->get()->getResultArray();

                            foreach($reservData as $row){

                                $row_id = $row['rs_id'];
                                $r_catID = $row['room_cat'];

                                //Room Category
                                $builder3 = $this->db->table('room_category');
                                $builder3->select('category');
                                $builder3->where('cat_id', $r_catID);
                                $room_cat = $builder3->get()->getRow()->category;
                                $no_rooms = $row['no_rooms'];
                                $no_nights = $row['no_nights'];                         
                                $in = $row['check_in'];
                                $in = date('d-m-Y', strtotime($in));
                                $out = $row['check_out'];
                                $out = date('d-m-Y', strtotime($out));

                                $rate = $row['rate'];
                                $total_amt = $rate*$no_rooms*$no_nights;
                                
                                $total_price += $total_amt;

                                $room_no = $row['room_assigned']; 
                    
                    
                                if($room_no == null && $checked_out == 1)   {   ?>

                    <tr>

                        <td style="text-align:left;"><?php echo $room_cat; ?></td>
                        <td style="text-align:center;"><?php echo $no_rooms; ?></td>
                        <td style="text-align:center;"><?php echo $in; ?> </td>
                        <td style="text-align:center;"><?php echo $out; ?> </td>
                        <td style="text-align:center;"><?php echo $no_nights; ?> </td>
                        <td style="text-align:right;"><?php echo $room_no; ?> </td>
                        <td style="text-align:center;">

                            <a href="<?= base_url('admin/bookings/selectRooms?booking_id='.$booking_code.'&cat='.$r_catID.'&rooms='.$no_rooms.'&res='.$row_id) ?>" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text">Assign Room</span>
                            </a>
                        </td>
                    </tr>
                    <?php   } 
                                
                                else if($room_no != null && $checked_out == 1) {  ?>


                    <tr>

                        <td style="text-align:left;"><?php echo $room_cat; ?></td>
                        <td style="text-align:center;"><?php echo $no_rooms; ?></td>
                        <td style="text-align:center;"><?php echo $in; ?> </td>
                        <td style="text-align:center;"><?php echo $out; ?> </td>
                        <td style="text-align:center;"><?php echo $no_nights; ?> </td>
                        <td style="text-align:right;"><?php echo $room_no; ?> </td>
                        <td style="text-align:center;">


                        <a href="<?= base_url('admin/bookings/releaseRooms?booking_id='.$booking_code.'&cat='.$r_catID.'&rooms='.$no_rooms.'&res='.$row_id) ?>" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span class="text">Release Room</span>
                            </a>


                        </td>
                    </tr>



                    <?php  } else if(!$checked_out == 1){ ?>


                    <tr>

                        <td style="text-align:left;"><?php echo $room_cat; ?></td>
                        <td style="text-align:center;"><?php echo $no_rooms; ?></td>
                        <td style="text-align:center;"><?php echo $in; ?> </td>
                        <td style="text-align:center;"><?php echo $out; ?> </td>
                        <td style="text-align:center;"><?php echo $no_nights; ?> </td>
                        <td style="text-align:right;"><?php echo $room_no; ?> </td>
                        <td style="text-align:center;">

                            Checked OUT
                        </td>
                    </tr>


                    <?php   }  ?>





                    <?php    }  ?>

                </table>

            </form>

        </div>
    </div>

</div> <script>
     function GoBack() {
         history.back();
     }

 </script>