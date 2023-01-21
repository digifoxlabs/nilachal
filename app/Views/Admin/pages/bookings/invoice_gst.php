<?= $this->extend("Admin/template/invoice") ?>

<?= $this->section("pageTitle") ?>
    <?= $pageTitle; ?>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<?php

foreach($bookData as $booking){

        $id = $booking['bk_id'];
        $booking_code = $booking['booking_code'];
        $mode = $booking['mode'];
        $booking_status = $booking['booking_status'];
        $check_in = $booking['check_in'];
        $checked_in = $booking['checked_in'];
        $check_out = $booking['check_out'];
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

        $booking_amt = $booking['booking_amt'];
        $cgst = $booking['cgst'];
        $sgst = $booking['sgst'];
        $discount = $booking['discount'];
        $total_amount = $booking['total_amt'];
        $amt_paid = $booking['amt_paid'];
        $balance_amt = $booking['balance_amt'];

}



?>

<table width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:14px;">
	<tr>
		<td class="style" colspan="2" align="center" ><b>Booking No: <?= $booking_code; ?> Dated: <?= $check_out; ?></b></td>
	</tr>
	<tr>
		<td colspan="2" >
			<table width="100%" cellpadding="5" style="font-size:12px;">
			<tr>
				<td width="33%" >
                    To,<br />
					<b>RECEIVER (BILL TO)</b><br />
					Name : <?= $guest_name; ?><br /> 
					Billing Address : <?= $guest_address; ?><br />
            
				</td>
                
                <td width="33%" align="center">
                    <!-- <img src="<?= base_url("assets/frontend/img/logo.png") ?>" width="150px;"><br> -->
                    <h3><strong>NILACHAL STAY & TOUR</strong><br /></h3>
                    Kamakhya Dham, Near Krishna Mandir<br />
                    Guwahati, Pin: 781010 <br />
                    <h5><strong>GSTIN: 18AAQFN8274P1Z3</strong><br /></h5>
				</td>
				
				<td width="33%" align="right">                    
                    Phone. : 0361-2735143<br />
                    Mob. : 60265-00977<br />
                    Mob. : 76369-55501<br />
                    Mob. : 92879-57466<br />
                    Email : nilachalstayadntour@gmail.com<br />            
                  
				</td>
			</tr>	               

           
			</table>
            <hr>
		<br/>

			<table width="90%" border="1" align="center" cellpadding="5" cellspacing="0" style="font-size:12px;">
				<tr>
                    <th align="left">Sr No.</th>
                    <th align="left">Description</th>
                    <th align="left">No Rooms</th>
                    <th align="left">Check In</th>
                    <th align="left">Check Out</th>
                    <th align="left">Nights</th>
                    <th align="left">Rate</th>
                    <th align="left">Total Amt.</th> 
				</tr>


                <?php   
    
    $total_price = 0;

    $count= 0;

    $this->db = \Config\Database::connect();  

    $builder2 = $this->db->table('room_reservation');
    $builder2->where('booking_code', $booking_code);
    $reservData = $builder2->get()->getResultArray();

    foreach($reservData as $row){

        $count++;

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

        <td style="text-align:left;"><?php echo $count; ?></td>
        <td style="text-align:left;"><?php echo $room_cat; ?></td>
        <td style="text-align:left;"><?php echo $no_rooms; ?></td>
        <td style="text-align:left;"><?php echo $in; ?></td>
        <td style="text-align:left;"><?php echo $out; ?></td>
        <td style="text-align:left;"><?php echo $no_nights; ?></td>
        <td style="text-align:left;"><?php echo $rate; ?></td>
        <td style="text-align:right;"><?php echo $total_amt; ?></td>
    </tr>



    <?php   }
    
    ?>


                <tr>
				<td align="right" colspan="6"><b>Sub Total</b></td>
				<td align="right" colspan="2"><b><?= $booking_amt ?></b></td>
				</tr>

                <tr>            
				<td align="right" colspan="6"><b>CGST :</b></td>
				<td align="right" colspan="2"><?= $cgst ?></td>
				</tr>
                
                <tr>
				<td align="right" colspan="6"><b>SGST :</b></td>
				<td align="right" colspan="2"><?= $sgst ?></td>
				</tr>

                <tr>
				<td align="right" colspan="6"><b>Discount :</b></td>
				<td align="right" colspan="2"><?= $discount ?></td>
				</tr>				
				
				<tr>
				<td align="right" colspan="6"><b>Total Billed Amount Due:</b></td>
				<td align="right" colspan="2"><?= $total_amount?></td>
				</tr>
			</table>
            
            <br/>            
            
   
            <table width="85%" align="center" cellpadding="5" cellspacing="0">                
            <tr>
				<td width="50%" align="left">
                    <br>
					<br>
					<br>
					Guests Signature<br /> 
                </td>            
				<td width="50%" align="right">   
                     <br />
					<br />
					<br />
                    <strong>Manager,<br/>NILACHAL STAY TOUR</strong><br />                   
				</td>
			</tr>     
            
            <tr>
            </td>    
                 <td class="style" colspan="2" align="center" ><b>Visit us at: www.nilachalstaytour.com</b></td>
            </tr>
            </table>      
                      
            <hr>
            
         </td>
         
          <table width="85%" align="center" cellpadding="5" cellspacing="0" style="font-size:10px;">     
              
                    <tr>                
                        <td  width="100%" align="center">
                        <p>* Bill are payable on presentation<br>
                        * Every effort is being made to provide all the facilities, but due to any reason beyond the control of the management like strike, power failure etc. any inconvenience temporarily caused to the guest, the management will not be liable for any compensation<br>
                        * Check Out Time 12 Noon<br>
                        * Please handover your room key when you check out from the hotel<br>
                        * Subject to Guwahati Jurisdiction</p>                
                    </tr>     
                    
                  
            </table>  

    
    
	</table>



<?= $this->endSection() ?>