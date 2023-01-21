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
            <h6 class="m-0 font-weight-bold text-primary">Check IN: <?php echo $booking_code;?></h6>
            <a id="go_back_button" href="javascript:GoBack()" class="btn btn-primary btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-chevron-left"></i>
                </span>
                <span class="text">GO Back</span>
            </a>
        </div>
        <div class="card-body">

            <div class="row">
                <!-- Left Column-->

                <div class="col-lg-6">


                    <table cellpadding="5" cellspacing="1">
                        <tr>
                            <th scope="row">
                                <div align="left">Customer Name</div>
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

                    </table>
                </div>

                <!--   Right Column-->
                <div class="col-lg-6">


                    <table class="table-bordered" cellpadding="5" cellspacing="1">
                        <tbody>

                            <tr>
                                <th style="text-align:left;">Room Type</th>
                                <th style="text-align:left;" width="10%">No. Rooms</th>
                                <th style="text-align:center;" width="20%">From</th>
                                <th style="text-align:center;" width="20%">To</th>
                                <th style="text-align:center;" width="10%">No. Nights</th>


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
                                $total_amt = $rate*$no_rooms*$no_nights;
                                
                                $total_price += $total_amt;
                                
                                ?>

                            <tr>

                                <td style="text-align:left;"><?php echo $room_cat; ?></td>
                                <td style="text-align:left;"><?php echo $no_rooms; ?></td>
                                <td style="text-align:left;"><?php echo $in; ?></td>
                                <td style="text-align:left;"><?php echo $out; ?></td>
                                <td style="text-align:left;"><?php echo $no_nights; ?></td>


                            </tr>



                            <?php   }
                            
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Row End -->

            <hr>

            <?php if($checked_in == 1){  ?>
            
              <form action="<?= base_url('admin/bookings/checkIN') ?>" method="post">
              <input type="hidden" name="activeID" value="<?= $booking_code; ?>">
                <button class="btn btn-success" type="submit" name="check_in"> <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Check IN</span></button>
            </form>     
          

            <?php    } else { ?>  
            

            <a href="<?= base_url('admin/bookings/roomAssign?assign='.$booking_code) ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-right"></i>
                </span>
                <span class="text">Assign Room</span>
            </a>
          

            <?php    }  ?>

        </div>

    </div>



</div>

<script>
     function GoBack() {
         history.back();
     }

 </script>