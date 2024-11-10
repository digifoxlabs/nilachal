<script>
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
                                    <input required id="check_in" type="text" class="form-control" name="check_in" autocomplete="off">
                                    <span class="input-group-addon"><img src="<?= base_url("assets/frontend/img/calendar.png") ?>" /></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-wrap">
                                    <label class="form-label-outside" for="contact-your-name-2">CHECK OUT</label>
                                    <input required id="check_out" type="text" class="form-control" name="check_out" autocomplete="off">
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
                    </form>
                </div>
            </div>
        </section>

