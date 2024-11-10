
<script type="text/javascript">
    function ValidateForm(form) {
        if (form.check_in.value == "") {
            alert("<?php echo "Please select the check-in date";?>");
            return false;
        }

        if (form.check_out.value == "") {
            alert("<?php echo "Please select the check-out date";?>");
            return false;
        }

        var start_time = Date.parse(form.check_in.value);
        var end_time = Date.parse(form.check_out.value);

        if (start_time > end_time) {
            alert("<?php echo "The check-in date can not be after the check-out date!";?>");
            return false;
        }

        return true;
    }

</script>


<!-- Begin Page Content -->
<div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">New Booking</h6>
    </div>
    <div class="card-body">

     <!--Form Start-->
     <form action="<?= base_url('admin/bookings/offline/select-rooms') ?>" method="post" onsubmit="return ValidateForm(this)">
            <input type="hidden" name="source" id="source" />
            <div class="panel panel-default search-result">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <strong><?php echo "Check-in-date";?></strong>
                            <br />
                            <div class="input-group">
                                <input required id="check_in" type="text" class="form-control" name="check_in" autocomplete="off">
                                <span class="input-group-addon"><img src="<?= base_url("assets/frontend/img/calendar.png") ?>" /></span>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <strong><?php echo "Check-out-date";?></strong>
                            <br />
                            <div class="input-group">
                                <input required id="check_out" type="text" class="form-control" name="check_out" autocomplete="off">
                                <span class="input-group-addon"><img src="<?= base_url("assets/frontend/img/calendar.png") ?>" /></span>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-sm-3">
                            <br />
                            <input type="submit" class="btn btn-primary btn-md" value="Proceed" />
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <!--Form End-->
    </div>
</div>


</div>



<!-- Pass the URL as a JavaScript variable -->
<script>
        const fetchDisabledDatesUrl = "<?= base_url('/admin/bookings/getdisableofflinedates') ?>";
</script>
