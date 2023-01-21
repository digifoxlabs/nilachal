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
                  <p>OTP Sent to <?= $email; ?></p>

                  <!-- Validate OTP -->
                  <form class="rd-form rd-form-variant-2" method="post" action="<?= base_url('validate-otp') ?>">
                      <div class="row row-14 gutters-14">

                          <input type="hidden" name="email" value="<?= $email; ?>">

                          <div class="col-md-4">
                              <div class="form-wrap">
                                  <input class="form-input" id="contact-phone-2" type="text" name="otp" autocomplete="off" value="<?= set_value('otp') ?>">
                                  <label class="form-label" for="contact-phone-2">Enter OTP</label>
                              </div>
                          </div>


                          <?php if (isset($validation)) : ?>
                    <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                    </div>
                    <?php endif; ?>


                      </div>
                      <button class="button button-primary button-pipaluk" type="submit" name="submit_mobile">Submit</button>
                  </form>
                  <!-- ValidateOTP END-->

                  <!-- Resend Otp -->
                  <form class="rd-form rd-form-variant-2" method="post" action="<?= base_url('login') ?>">
                      <div class="row row-14 gutters-14">

                          <input type="hidden" name="email" value="<?= $email; ?>">
                      </div>
                      <p> Resend OTP in <span id="countdowntimer">5 </span> Seconds</p>
                      <button class="button" id="resend" type="submit" name="submit_mobile">Resend</button>
                  </form>
                  <!-- Resend OTP END-->

              </div>
          </section>


          <script>
              var resendBtn = document.getElementById("resend");

              var timeleft = 5;
              var downloadTimer = setInterval(function() {
                  timeleft--;
                  document.getElementById("countdowntimer").textContent = timeleft;
                  if (timeleft <= 0)
                      clearInterval(downloadTimer);
              }, 1000);

              resendBtn.disabled = true;
              setTimeout(function() {
                  resendBtn.disabled = false;
              }, 5000);
          </script>