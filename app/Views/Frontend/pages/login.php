          <!-- OTP Form-->
          <section class="section section-sm section-first bg-default text-left">
              <div class="container">

                  <article class="title-classic">


                      <!-- Generate OTP-->
                      <div class="title-classic-title">
                          <h3>Login Through OTP</h3>
                      </div>
                      <!-- <div class="title-classic-text">
                          <p>Please Enter Your Email ID .</p>
                      </div> -->


                  </article>

      
                  <form class="rd-form rd-form-variant-2" method="post" action="<?= base_url('login') ?>">
                      <div class="row row-14 gutters-14">

                          <div class="col-md-4">
                              <div class="form-wrap">
                                  <input class="form-input" id="contact-phone-2" type="text" name="email" data-constraints="@Email" autocomplete="off" value="<?= set_value('email') ?>">
                                  <label class="form-label" for="contact-phone-2">Enter your email id</label>
                              </div>
                          </div>

                      </div>

                    <?php if (isset($validation)) : ?>
                    <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                    </div>
                    <?php endif; ?>
                    
                      <button class="button button-primary button-pipaluk" type="submit" name="submit_mobile">Submit</button>
                  </form>
                  <!-- Generate OTP END-->



              </div>
          </section>


          <script>
              //$(document).ready(function() {


              var timeleft = 30;
              var downloadTimer = setInterval(function() {
                  timeleft--;
                  document.getElementById("countdowntimer").textContent = timeleft;
                  if (timeleft <= 0)

                      clearInterval(downloadTimer);

              }, 1000);

              


              //});
          </script>