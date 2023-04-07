<!-- Why choose us-->
<section class="section section-sm section-first bg-default text-md-left">
    <div class="container">
        <div class="row row-50 justify-content-center align-items-xl-center">
            <div class="col-md-10 col-lg-10 col-xl-10">

                <h5 class="d-flex align-items-center mb-3">Complete Payment</h5>
                <hr>
                <form action="<?php echo $action; ?>/_payment" method="post">

                    <input type="hidden" name="key" value="<?php echo $mkey; ?>" />
                    <input type="hidden" name="hash" value="<?php echo $hash; ?>" />
                    <input type="hidden" name="txnid" value="<?php echo $tid; ?>" />
                    <input type="hidden" name="productinfo" value="<?php echo $productinfo; ?>" />

                    <input type="hidden" name="address1" value="INDIA" />

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Guest Name</h6>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstname" value="<?php echo $name;  ?>"
                                readonly />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Registered No</h6>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" value="<?php echo $phoneno;  ?>"
                                readonly />
                        </div>
                    </div>

                    <input type="hidden" name="email" value="<?= $email; ?>">

                    <input name="surl" value="<?php echo $sucess; ?>" size="64" type="hidden" />
                    <input name="furl" value="<?php echo $failure; ?>" size="64" type="hidden" />
                    <!--for test environment comment  service provider   -->
                    <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                    <input name="curl" value="<?php echo $cancel; ?> " type="hidden" />


                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Amount</h6>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="amount" value="<?php echo $amount;  ?>"
                                readonly />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">

                        </div>

                        <div class="col-sm-9">
                            <input type="submit" class="btn btn-light px-4" value="PAY" />
                        </div>
                    </div>
                </form>      
            </div>
        </div>
    </div>
    </div>
</section>