
    <div class="preloader">
        <div class="preloader-body">
            <div class="cssload-container">
                <div class="cssload-speeding-wheel"></div>
            </div>
            <p>Loading...</p>
        </div>
    </div>


    <div class="page">

    <section class="section section-sm section-first bg-default text-left">
            <div class="container">
                <article class="title-classic">
                    <div class="title-classic-title">
                        <h3>Booking Preview</h3>
                    </div>
                    <div class="title-classic-text">
                        <p>Book Your Stay at NILACHAL..</p>
                    </div>
                </article>

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
        
                    $grand_total = round($grand_total,2);
        
                    $payable_amount= $grand_total - $discount;
                    $payable_amount= round($payable_amount,2);
                                
                                
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
                            <td align="right" colspan="2"><strong><?php echo "Rs. ". $grand_total; ?></strong></td>

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

                <form class="rd-form rd-form-variant-2" method="post" action="<?= base_url('preview-booking') ?>">

                    <input type="hidden" name="action" value="save" />

                    <input type="hidden" name="sgst" value="<?php echo $sgst_a;  ?>" />
                    <input type="hidden" name="cgst" value="<?php echo $cgst_a;  ?>" />
                    <input type="hidden" name="total_price" value="<?php echo $grand_total;  ?>" />
                    
                    <div class="row row-14 gutters-14">
                        <div class="col-md-4">
                            <div class="form-wrap">
                                <label class="form-label-outside" for="contact-your-name-2">Guest Name</label>
                                <input class="form-input" id="contact-your-name-2" type="text" name="name" data-constraints="@Required" value="<?php echo $_POST["name"]; ?>">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-wrap">
                                <label class="form-label-outside" for="contact-your-name-2">Email</label>
                                <input class="form-input" id="contact-email-2" type="email" name="email" data-constraints="@Email @Required" value="<?php echo $_POST["email"]; ?>">
                                <label class="form-label" for="contact-email-2">E-mail</label>
                            </div>
                        </div>
  
                    </div>

                    <div class="row row-14 gutters-14">

                    <div class="col-md-4">
                            <div class="form-wrap">                  
                            <label class="form-label-outside" for="contact-your-name-2">Mobile No</label>     
                                <input class="form-input" id="contact-phone-2" type="text" name="phone" data-constraints="@Numeric" value="<?php echo $_POST["phone"]; ?>">
                                <label class="form-label" for="contact-phone-2">Mobile No</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-wrap">        
                            <label class="form-label-outside" for="contact-your-name-2">No. Guests</label>    
                                 <label class="form-label" for="contact-your-name-1">No. of Guests</label>           
                                <input class="form-input" id="contact-your-name-1" type="number" min=1  name="no_guests" autocomplete="off" value="<?php echo $_POST["no_guests"] ?>" required>    
                            </div>
                        </div>
                    </div>

                    <hr>
                    <hr>

<h6 class="m-0 font-weight-bold text-primary">Payment Details</h6>
                    <div class="row row-14 gutters-14" style="margin-top:20px;">                       
                                     
                        <div class="col-sm-4 mb-3 mb-sm-2">
                            <label>Booking Amount</label>
                            <input type="text" class="form-control" name="grand_t" id="grand_t" value="<?php echo $grand_total; ?>" readonly>
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label>Discount</label>
                            <input type="text" class="form-control" name="discount" id="discount" value="<?php echo $discount; ?>" readonly>
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label><strong>Payable Amount</strong></label>
                            <input type="text" class="form-control" name="payable_amt" id="payable_amt" value="<?php echo $payable_amount; ?>" readonly>
                        </div>

                    </div>

                    <button class="button button-primary button-pipaluk" type="submit">Confirm</button>
                </form>


            </div>
        </section>

    </div>
