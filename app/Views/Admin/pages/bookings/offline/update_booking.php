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

        <a id="go_back_button" href="<?= base_url('admin/bookings/view/'.$booking_code) ?>" class="btn btn-primary btn-icon-split btn-sm">
            <span class="icon text-white-50">
                <i class="fas fa-chevron-left"></i>
            </span>
            <span class="text">GO Back</span>
        </a>


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
    <div class="row" height="200px">
        <!-- First Column -->
        <div class="col-lg-12">
            <!-- Custom Text Color Utilities -->
            <div class="card shadow mb-4" style="min-height:50vh;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Booking Details</h6>
                </div>
                <div class="card-body">

                <form action="<?= base_url('admin/bookings/update') ?>" method="post">


              <input type="hidden" name="bookingcode" value="<?= $booking_code; ?>">

                    <table class="table-responsive table-bordered" cellpadding="5" cellspacing="1" >
                        <tbody>
                            <tr>
                                <th style="text-align:center;" width="15%">Room Type</th>
                                <th style="text-align:center;" width="5%">No. Rooms</th>
                                <th style="text-align:center;" width="10%">Rate</th>
                                <th style="text-align:center;" width="15%">Check In</th>
                                <th style="text-align:center;" width="15%">Check Out</th>
                                <th style="text-align:center;" width="5%">No. Nights</th>
                                <th style="text-align:center;" width="10%">Total Amt</th>
                
                            </tr>


                            <?php   

$count = 0;

$total_price = 0;

$this->db = \Config\Database::connect();  

$builder2 = $this->db->table('room_reservation');
$builder2->where('booking_code', $booking_code);
$reservData = $builder2->get()->getResultArray();

foreach($reservData as $row){

    ++$count;

    $row_id = $row['rs_id'];
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
   // $in = date('d-m-Y', strtotime($in));
    $out = $row['check_out'];
   // $out = date('d-m-Y', strtotime($out));

    $rate = $row['rate'];
    $item_amt = $rate*$no_rooms*$no_nights;
    
    $total_price += $item_amt;
    
    ?>

                    <tr id="row_id_<?= $count; ?>">

                        <input type="hidden" name="row_id[]" value="<?= $row_id ?>">
                        <td style="text-align:center;"><input type="text"  class="form-control btn-sm room_cat" name="room_cat[]" id="room_cat_<?= $count ?>" value="<?= $room_cat ?>" size="8"></td>
                        <td style="text-align:center;"><input type="number" min="0" style="text-align:center;"  class="form-control btn-sm no_rooms" name="no_rooms[]" id="no_rooms_<?= $count; ?>" value="<?= $no_rooms; ?>" size="4"></td>
                        <td style="text-align:center;"><input type="number" style="text-align:right;" class="form-control btn-sm rate" name="rate[]" id="rate_<?= $count; ?>" value="<?= $rate; ?>" size="4"></td>
                        <td style="text-align:center;"><input type="date" class="form-control btn-sm check_in" name="check_in[]" id="check_in_<?= $count; ?>" value="<?= $in; ?>" size="10"></td>
                        <td style="text-align:center;"><input type="date" class="form-control btn-sm check_out" name="check_out[]" id="check_out_<?= $count; ?>" value="<?= $out; ?>" size="10"></td>
                        <td style="text-align:center;"><input type="number" style="text-align:center;" class="form-control btn-sm nights" name="nights[]" id="nights_<?= $count; ?>" value="<?= $no_nights; ?>" size="4" readonly></td>
                        <td style="text-align:center;"><input type="text" style="text-align:right;" class="form-control btn-sm item_amount" name="item_amount[]" id="item_amount_<?= $count; ?>" value="<?= $item_amt; ?>" readonly></td>
                       
                    </tr>


            <?php   }    ?>



            <tr>
                        <td colspan="6" align="right">Total:</td>
                        <td align="right"><input type="text" style="text-align:right;" class="form-control btn-sm total_price" name="total_price" id="total_price" value="<?= $total_price; ?>" readonly></td>


                        </tr>
                        <tr>
                            <td colspan="4" align="right">Dou You Need GST Bill @ <?= $gst_applied; ?> %?
                                <input type="radio" value="yes" name="is_gst" onclick="calculate_total(<?= $count; ?>)" checked>Yes</input>
                                <input type="radio" value="no" onclick="calculate_total(<?= $count; ?>)" name="is_gst">No</input>
                            </td>
                            <td colspan="2" align="right">CGST:</td>
                            <td align="right"><input type="text" style="text-align:right;" class="form-control btn-sm" name="cgst" id="cgst" value="<?= $cgst; ?>" readonly></td>


                        </tr>
                        <tr>
                            <td colspan="6" align="right">SGST:</td>
                            <td align="right"><input type="text" style="text-align:right;" class="form-control btn-sm" name="sgst" id="sgst" value="<?= $sgst; ?>" readonly></td>

                        </tr>                       

                        <tr>
                            <td colspan="6" align="right">Discount(-):</td>
                            <td align="right"><input type="number" min="0" style="text-align:right;" class="form-control btn-sm discount" name="discount" id="discount" value="<?= $discount; ?>"></td>

                        </tr>

                      
                        <tr>
                            <td colspan="6" align="right"><strong>Total Booking Amount:</strong></td>
                            <td align="right"><strong><input type="text" style="text-align:right;" class="form-control btn-sm total_amt" name="total_amt" id="total_amt" value="<?= $total_amt; ?>" readonly></strong></td>

                        </tr>

                        <tr>
                            <td colspan="6" align="right"><strong>Amount Paid:</strong></td>
                            <td align="right"><strong><input type="text" style="text-align:right;" class="form-control btn-sm amt_paid" name="amt_paid" id="amt_paid" value="<?= $amt_paid; ?>" readonly></strong></td>

                        </tr>
                        <tr>
                            <td colspan="6" align="right"><strong>Outstanding Balance:</strong></td>
                            <td align="right"><strong><input type="text" style="text-align:right;" class="form-control btn-sm balance_amt" name="balance_amt" id="balance_amt" value="<?= $balance_amt; ?>" readonly></strong></td>

                        </tr>


                        </tbody>


                    </table>

                    <button class="btn btn-success float-right" type="submit" name="update">Update Booking</button>

                    </form>


                </div>


            </div>
        </div>
    </div>



</div>

<script>
    $(document).ready(function() {

        //Check GST
        var gst_amt_value = $('#cgst').val();
        if(gst_amt_value != 0)
        $("input[name=is_gst][value='yes']").prop("checked",true);
        else
        $("input[name=is_gst][value='no']").prop("checked",true);

        var count = <?php echo $count ?>;


        $(document).on('change', '.no_rooms', function(){

            calculate_total(count);
             
        });  
        
        $(document).on('change', '.check_in', function(){

            calculate_total(count);
             
        });  

        $(document).on('change', '.check_out', function(){

            calculate_total(count);
             
        });  
        $(document).on('change', '.rate', function(){

            calculate_total(count);
             
        });        
        $(document).on('change', '.discount', function(){

            calculate_total(count);
             
        });        
        

    }); //Jquery End

    function calculate_total(count){

        var no_rooms = 0;
        var rate = 0;
        var in_date = 0;
        var out_date = 0;
        var nights = 0;
        var item_amount = 0;
        var total_price = 0;

        for(j=1; j<=count; j++){

       

            var new_item_amount = 0;

            no_rooms = $('#no_rooms_'+j).val();
            rate = $('#rate_'+j).val();

            in_date = $('#check_in_'+j).val();
            out_date = $('#check_out_'+j).val();
            nights = $('#nights_'+j).val();
            item_amount = $('#item_amount_'+j).val();


            if(in_date == out_date) {

                nights=1;
            }
            else {

                // end - start returns difference in milliseconds 
                var diff = new Date(Date.parse(out_date) - Date.parse(in_date));
                // get days
                var nights = diff/1000/60/60/24; 
            }

            //Update Nights
            $('#nights_'+j).val(nights);

            new_item_amount = parseFloat(no_rooms) * parseFloat(rate) * parseFloat(nights);

            //Update NEw Item Amt
            $('#item_amount_'+j).val(new_item_amount);

            //Update Total
            total_price = parseFloat(total_price)+ parseFloat(new_item_amount);
            total_price = total_price.toFixed(2);
            $('#total_price').val(total_price);

        }

            //Update GST
            updateGST();


            //Update balance amt
            var new_cgst =  $('#cgst').val();
            var new_sgst =  $('#sgst').val();
            var new_discount =  $('#discount').val();

            var new_total_amt = parseFloat(total_price)+parseFloat(new_cgst)+parseFloat(new_sgst)-parseFloat(new_discount);            
            new_total_amt = new_total_amt.toFixed(2);
            $('#total_amt').val(new_total_amt);

            var new_amt_paid =  $('#amt_paid').val();

            var new_balance_amt = new_total_amt-new_amt_paid;
            new_balance_amt = new_balance_amt.toFixed(2);
            $('#balance_amt').val(new_balance_amt);
    }



        function updateGST(){

        var gst_value = $("input[name='is_gst']:checked").val();

                if(gst_value == 'yes'){

                    var temp_gst_applied = <?= $gst_applied; ?>;
                    var temp_cgst_rate = (temp_gst_applied/2);
                    var temp_sgst_rate = temp_cgst_rate;

                    temp_cgst_rate = parseFloat(temp_cgst_rate) * .01;
                    temp_sgst_rate = parseFloat(temp_sgst_rate) * .01;
                
                    var temp_total =  $('#total_price').val();

                    var temp_cgst_amt = temp_total * temp_cgst_rate;
                    var temp_sgst_amt = temp_total * temp_sgst_rate;
                    temp_cgst_amt = temp_cgst_amt.toFixed(2);
                    temp_sgst_amt = temp_sgst_amt.toFixed(2);

                    $('#sgst').val(temp_cgst_amt);
                    $('#cgst').val(temp_cgst_amt);
                }
                else {

                    $('#sgst').val(0);
                    $('#cgst').val(0);

                }

            // calculate_total(newCount);



        }

</script>   