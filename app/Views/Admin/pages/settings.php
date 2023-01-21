<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Settings</h1>
    <a id="go_back_button" href="<?= base_url('admin/dashboard') ?>" class="btn btn-primary btn-icon-split btn-sm">
        <span class="icon text-white-50">
            <i class="fas fa-chevron-left"></i>
        </span>
        <span class="text">GO Back</span>
    </a>

    <div class="row">
        <div class="col-md-8">

            <br />


            <form id="main" action="<?= base_url('admin/settings') ?>" method="post">


                <fieldset>
                    <legend>DISCOUNT: </legend>
                    <ol>
                        <li>
                            <label><?php echo "Current Discount (in Rs.)";?>:</label>
                            <input type="text" class="form-control" name="discount" value="<?php echo $discount;?>" />
                        </li> 
                        
                        <li>
                            <label><?php echo "GST (in %)";?>:</label>
                            <input type="text" class="form-control" name="gst" value="<?php echo $gst;?>" />
                        </li>


                    </ol>
                </fieldset>


                <fieldset>
                    <legend>WEBSITE SETTINGS: </legend>
                    <ol>


                        <li>
                            <label>CURRENCY:</label>
                            <input type="text" class="form-control" name="currency" value="<?php echo $currency;?>" />
                        </li>



                        <li>
                            <label>ADMIN EMAIL:</label>
                            <input type="text" class="form-control" name="admin_email" value="<?php echo $admin_email;?>" />
                        </li>

                        <li>
                            <label><?php echo "Admin Mobile";?>:</label>
                            <input type="text" class="form-control" name="admin_mobile" value="<?php echo $admin_mobile;?>" />
                        </li>


                    </ol>
                </fieldset>

                <div class="clearfix"></div>
                <br />
                <button type="submit" name="update_settings" class="btn btn-primary pull-right">Save</button>
                <div class="clearfix"></div>
            </form>

        </div>

    </div>



</div>
<!-- /.container-fluid -->