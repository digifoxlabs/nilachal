<script>
    function parseBookingDate(value) {
        var parts = value.split(/[/-]/).map(Number);
        if (parts.length !== 3 || parts.some(Number.isNaN)) {
            return null;
        }

        var date = new Date(parts[2], parts[1] - 1, parts[0]);
        date.setHours(0, 0, 0, 0);

        return date.getFullYear() === parts[2]
            && date.getMonth() === parts[1] - 1
            && date.getDate() === parts[0] ? date : null;
    }

    function ValidateForm(form) {
        if (form.check_in.value == "") {
            alert("<?php echo "Please select the check-in date";?>");
            return false;
        }

        if (form.check_out.value == "") {
            alert("<?php echo "Please select the check-out date";?>");
            return false;
        }

        var start_time = parseBookingDate(form.check_in.value);
        var end_time = parseBookingDate(form.check_out.value);
        var today = new Date();
        today.setHours(0, 0, 0, 0);

        if (!start_time || !end_time) {
            alert("Please enter valid check-in and check-out dates.");
            return false;
        }

        if (start_time < today) {
            alert("Check-in date cannot be before today.");
            return false;
        }

        if (end_time < today) {
            alert("Check-out date cannot be before today.");
            return false;
        }

        if (end_time < start_time) {
            alert("Check-out date cannot be before the check-in date.");
            return false;
        }

        return true;
    }

</script>


<section class="section section-sm section-first bg-default text-left">
            <div class="container">
                <article class="title-classic">
                    <div class="title-classic-title">
                        <h3>NILACHAL</h3>
                    </div>
                    <div class="title-classic-text">
                        <p>Book Your Stay at NILACHAL..</p>
                    </div>
                </article>
                <div class="booking-form1">
                    <form class="rd-form rd-form-variant-2" method="post" action="<?= base_url('search-rooms') ?>" onsubmit="return ValidateForm(this)">
                        <div class="row justify-content-md-center">
                            <div class="col-md-3">
                                <div class="form-wrap">
                                    <label class="form-label-outside" for="contact-your-name-2">CHECK IN</label>
                                    <input required id="check_in" type="text" class="form-control" name="check_in" autocomplete="off" value="<?= esc($check_in ?? old('check_in') ?? '') ?>">
                                    <span class="input-group-addon"><img src="<?= base_url("assets/frontend/img/calendar.png") ?>" /></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-wrap">
                                    <label class="form-label-outside" for="contact-your-name-2">CHECK OUT</label>
                                    <input required id="check_out" type="text" class="form-control" name="check_out" autocomplete="off" value="<?= esc($check_out ?? old('check_out') ?? '') ?>">
                                    <span class="input-group-addon"><img src="<?= base_url("assets/frontend/img/calendar.png") ?>" /></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-wrap">

                                    <label class="form-label-outside" for="contact-your-name-2">GUESTS</label>

                                    <select name="guests" id="guests" class="form-control" required>
                                        <option value=""><?php echo "Please Select";?></option>
                                        <?php
                                        for($i=1;$i<=5;$i++)
                                        {
                                            echo '<option '.($i==1?"selected":"").' value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <button class="button button-primary button-pipaluk" type="submit" style="margin-top:15px;">SEARCH</button>
                            </div>
                        </div>
                        <?php if (! empty($dateError)): ?>
                            <p role="alert" style="color: red;"><?= esc($dateError) ?></p>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </section>

