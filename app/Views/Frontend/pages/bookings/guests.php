        <!--Contents-->
        <section class="section section-sm section-first bg-default text-left">
            <div class="container">
                <article class="title-classic">
                    <div class="title-classic-title">
                        <h3>Guests Details</h3>
                    </div>
                    <div class="title-classic-text">
                        <p>Book Your Stay at NILACHAL..</p>
                    </div>
                </article>

                <form class="rd-form rd-form-variant-2" method="post" action="<?= base_url('preview-booking') ?>">
                <input type="hidden" name="action" value="preview" />
                    <div class="row row-14 gutters-14">
                        <div class="col-md-4">
                            <div class="form-wrap">
                                <input class="form-input" id="contact-your-name-2" type="text" name="name" data-constraints="@Required">
                                <label class="form-label" for="contact-your-name-2">Guest Name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-wrap">
                                <input class="form-input" id="contact-email-2" type="email" name="email" data-constraints="@Email @Required">
                                <label class="form-label" for="contact-email-2">E-mail</label>
                            </div>
                        </div>              
                   
                    </div>


                    <div class="row row-14 gutters-14">

                    <div class="col-md-4">
                            <div class="form-wrap">                       
                                <input class="form-input" id="contact-phone-2" type="text" name="phone" data-constraints="@Numeric">
                                <label class="form-label" for="contact-phone-2">Mobile No</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-wrap">            
                                 <label class="form-label" for="contact-your-name-1">No. of Guests</label>           
                                <input class="form-input" id="contact-your-name-1" type="number" min=1  name="no_guests" autocomplete="off" required>    
                            </div>
                        </div>
                    </div>

                    <button class="button button-primary button-pipaluk" type="submit">Next</button>
                </form>
            </div>
        </section>