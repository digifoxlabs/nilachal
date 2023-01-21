<!-- Begin Page Content -->
<div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/bookings/offline/preview') ?>" method="post" class="user">
        <input type="hidden" name="action" value="preview" />
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Customer Name</label>
                    <input type="text" class="form-control " name="name" placeholder="Full Name of Customer" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label>Contact Number</label>
                    <input type="text" class="form-control" name="mobile" placeholder="10 digit mobile number" autocomplete="off" required>
                </div>

                <div class="col-sm-6">
                    <label>Email ID</label>
                    <input type="text" class="form-control" name="email" placeholder="Email ID" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label>ID Card Type</label>
                    <input type="text" class="form-control" name="identity" placeholder="PAN/AADHAR/DL" autocomplete="off" required>
                </div>
                <div class="col-sm-4">
                    <label>ID Card Number</label>
                    <input type="text" class="form-control" name="identity_no" placeholder="ID Number" autocomplete="off" required>
                </div>  
                
                <div class="col-sm-4">
                    <label>No. of Guests</label>
                    <input type="number" min=1 class="form-control" name="no_guests" placeholder="Guests" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea id="address" class="form-control" name="address" rows="4" cols="12" autocomplete="off" required> </textarea>
            </div>

            <div class="form-group">

                <div class="col-sm-3">
                    <hr>
                    <button class="btn btn-primary btn-user btn-block" type="submit" name="create_room">PREVIEW</button>
                    <hr>
                </div>
            </div>

        </form>


    </div>


</div>



</div>