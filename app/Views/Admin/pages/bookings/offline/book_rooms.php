    <!-- Begin Page Content -->
    <div class="container-fluid">
   

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">New Booking:  <?php echo $_SESSION["bookingID"]; ?></h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <!--Cart-->
                        <form name="cart" method="post">
                            <div id="shopping-cart">
                                <div class="txt-heading">Selected Rooms</div>
                                <form action="<?= base_url('admin/bookings/offline/select-rooms') ?>" method="post">
                                    <input type="hidden" name="source" value="results" />
                                    <input required id="start_time" type="hidden" class="form-control" name="check_in" value="<?php echo $checkIN; ?>" />
                                    <input required id="end_time" type="hidden" class="form-control" name="check_out" value="<?php echo $checkOut ?>" />
                                    <input type="hidden" name="action" value="empty" />
                                    <input type="submit" id="btnEmpty" value="Empty" />
                                </form>

                                <?php
                                if (isset($_SESSION["cart_item"])) {
                                    $total_quantity = 0;
                                    $total_price = 0;
                                ?>

                                    <table class="table table-bordered" cellpadding="10" cellspacing="1">
                                        <tfoot>
                                            <tr>
                                                <td>
                                                    <form method="post" action="<?= base_url('admin/bookings/offline/billing') ?>">
                                                        <div class="cart-checkout-btn pull-right">
                                                            <button type="submit" class="btn btn-primary">PROCCED TO CHECKOUT</button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <th style="text-align:left;">Room Type</th>
                                                <th style="text-align:left;">No. of Nights</th>
                                                <th style="text-align:right;" width="5%">Rooms</th>
                                                <th style="text-align:right;" width="10%">Unit Price</th>
                                                <th style="text-align:right;" width="15%">Price</th>
                                            </tr>

                                            <?php
                                            foreach ($_SESSION["cart_item"] as $item) {
                                                $item_price = $item["quantity"] * $item["price"] * $item["nights"];
                                            ?>
                                                <tr>
                                                    <td><?php echo $item["name"].'||'.$item['occupancy']; ?></td>
                                                    <td><?php echo $item["nights"]; ?></td>
                                                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                                    <td style="text-align:right;"><?php echo "Rs. " . $item["price"]; ?></td>
                                                    <td style="text-align:right;"><?php echo "Rs. " . number_format($item_price, 2); ?></td>

                                                </tr>
                                            <?php
                                                $total_quantity += $item["quantity"];
                                                $total_price += ($item["price"] * $item["quantity"] * $item["nights"]);
                                            }
                                            ?>

                                            <?php

                                            $sgst = $gst_applied / 2;
                                            $cgst = $gst_applied / 2;

                                            $sgst1 = $sgst * .01;
                                            $cgst1 = $cgst * .01;

                                            $sgst_a = $total_price * $sgst1;
                                            $cgst_a = $total_price * $cgst1;

                                            $grand_total = $total_price + $sgst_a + $cgst_a;


                                            ?>


                                            <tr>
                                                <td colspan="3" align="right">CGST</td>
                                                <td style="text-align:right;">@ <?php echo $cgst; ?> %</td>
                                                <td style="text-align:right;"><?php echo number_format($cgst_a, 2); ?></td>

                                            </tr>

                                            <tr>
                                                <td colspan="3" align="right">SGST</td>
                                                <td style="text-align:right;">@ <?php echo $sgst; ?> %</td>
                                                <td style="text-align:right;"><?php echo number_format($sgst_a, 2); ?></td>

                                            </tr>



                                            <tr>
                                                <td colspan="2" align="right">Total:</td>
                                                <td align="right"><?php echo $total_quantity; ?></td>
                                                <td align="right" colspan="2"><strong><?php echo "Rs. " . number_format($grand_total, 2); ?></strong></td>

                                            </tr>
                                        </tbody>
                                    </table>

                                <?php } else { ?>


                                    <div class="no-records">Your Cart is Empty</div>

                                <?php  } ?>
                            </div>
                        </form>
                        <!-- Rooms-->




                        <!-- Room Category -->
                        <div id="product-grid">
                            <div class="txt-heading">

                                <h6>SHOWING ROOMS FOR</h6>
                                <h5>
                                    <?php echo "Check-in Date"; ?>: <strong><?php echo $checkIN; ?> </strong>
                                    <?php echo "Check-out Date"; ?>: <strong><?php echo $checkOut; ?></strong>

                                </h5>
                                <h6>
                                    <?php echo "No. of Nights"; ?>: <strong><?php echo $noNights; ?></strong>
                                </h6>
                            </div>

                            <?php foreach ($roomData as $room) : ?>


                                <?php

                          
                                // Loading Query builder instance
                                $this->db = \Config\Database::connect();
                                $builder = $this->db->table('rooms');
                                $norooms = $builder->select('room_no')
                                                    ->where('cat_id', $room['cat_id'])
                                                    ->where('status !=', 'na')
                                                    ->countAllResults();                                  
                                 
                                //Get Booked rooms
                                $builder2 = $this->db->table('room_reservation');
                                $bookedRooms = $builder2->select('*')
                                                        ->where('room_cat', $room['cat_id'])
                                                        ->get()->getResultArray();

                                $b_rooms = 0;
                                foreach($bookedRooms as $row){

                                    $bk_in = $row['check_in'];
                                    $bk_out = $row['check_out'];

                                    $start_time = date('Y-m-d', strtotime($checkIN));
                                    $end_time = date('Y-m-d', strtotime($checkOut));

                           


                                    if(
                                        ($bk_in <= $start_time && $start_time <= $end_time && $end_time <= $bk_out)||
                                         ($start_time <= $bk_in && $bk_in <= $end_time && $end_time <= $bk_out)||
                                         ($start_time <= $bk_in && $bk_in <= $bk_out && $bk_out <= $end_time)|| 
                                         ($bk_in <= $start_time && $start_time <= $bk_out && $bk_out <= $end_time)
                    
                                        )
                                        {
                                           $b_rooms+=$row['no_rooms'];
                    
                                        }
                                        else {
                                            $b_rooms =0;
                                        }

                                }

                                $availRooms = $norooms - $b_rooms;

                                //Deduct Saved In Session
                                $savedRooms = 0;

                                $builder3 = $this->db->table('sessions');
                                $builder3->select('room_selected');
                                $builder3->where('booking_code',  $_SESSION["bookingID"]);
                                $builder3->where('room_cat', $room['cat_id']);                                    
                                $savedRooms = $builder3->get()->getRow('room_selected');                             
                                
                               $availRooms =  $availRooms - $savedRooms;


                                ?>

                                <div class="product-item">
                                    <form action="<?= base_url('admin/bookings/offline/select-rooms') ?>" method="post">

                                        <div class="product-image"><img src="<?= base_url('assets/admin/img') . '/' . $room['image'] ?>" width="200"></div>
                                        <div class="product-tile-footer">

                                            <div class="product-title-name"><?php echo $room['category'] . '||' . $room['occupancy']; ?></div>


                                            <div class="product-title"><?php echo "Rooms Available: ".$availRooms; ?></div>
                                            <div class="product-price"><?php echo "Rate:  Rs." . $room['rate']; ?></div>

                                            <?php if($availRooms > 0):  ?>
                                            <div class="cart-action">

                                                <input type="hidden" name="action" value="add" />
                                                <input type="hidden" name="code" value="<?php echo $room['cat_id']; ?>" />


                                                <input required type="hidden" class="form-control" name="check_in" value="<?php echo $checkIN; ?>" />

                                                <input required type="hidden" class="form-control" name="check_out" value="<?php echo $checkOut; ?>" />

                                                <!--                                    <input type="hidden" class="product-quantity" name="quantity" value="1" />
-->
                                                <input type="number" min="0" max="<?php echo $availRooms ?>" class="product-quantity" name="quantity" value="0" />

                                                <input type="submit" value="Add Room" class="btnAddAction" />

                                            </div>

                                            <?php endif;?>



                                        </div>
                                    </form>
                                </div>

                            <?php endforeach; ?>


                        </div>
                        <!--Room Category End -->
                    </div>
                </div>
            </div>
        </div>