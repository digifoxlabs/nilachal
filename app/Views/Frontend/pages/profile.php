
<?php $validation =  \Config\Services::validation(); ?>


      <section class="section section-sm section-first bg-default text-md-left">
              <div class="container">
                  <div class="row row-50 justify-content-center align-items-xl-center">
    <article class="title-classic">
            <div class="title-classic-title">
              <h3>Update Profile</h3>
            </div>         
          <form class="rd-form rd-form-variant-2" action="<?= base_url('profile') ?>" method="post">
              <input name="row_id" placeholder="" type="hidden" value="<?php echo $cl_id; ?>" required/>
          <div class="row row-14 gutters-14">
              <div class="col-md-8">
                  <div style="display:flex; flex-direction: row; justify-content: space-around; align-items: center">
                      <label style="width:30%" for="contact-your-name-2"><strong>Cusomer Name: </strong></label>
                      <input style="width:70%" class="form-input" id="contact-your-name-2" type="text" name="name" data-constraints="@Required" value="<?php echo $name; ?>" autocomplete="off">
                   
                  </div>
                     <p style="color:red; background-color:#f1f442;"><?php echo ($validation->getError('name')) ? $validation->getError('name') : '' ?></p>

              </div>
              <div class="col-md-8">
                  <div style="display:flex; flex-direction: row; justify-content: space-around; align-items: center">
                      <label style="width:30%" for="contact-email-2"><strong>EMAIL ID: </strong> </label>
                      <input style="width:70%" class="form-input" id="contact-email-2" type="email" name="email" data-constraints="@Email @Required" value="<?php echo $email; ?>" autocomplete="off">                    

                  </div>
                  <p style="color:red; background-color:#f1f442;"><?php echo ($validation->getError('email')) ? $validation->getError('email') : '' ?></p>
              </div>

              <div class="col-md-8">
                  <div style="display:flex; flex-direction: row; justify-content: space-around; align-items: center;">
                      <label style="width:30%" for="contact-phone-2"><strong>Mobile No: </strong> </label>
                      <input style="width:70%" class="form-input" id="contact-phone-2" type="text" name="mobile" data-constraints="@Numeric" value="<?php echo $mobile; ?>" autocomplete="off"> 
                     
                  </div>
                   <p style="color:red; background-color:#f1f442;"><?php echo ($validation->getError('mobile')) ? $validation->getError('mobile') : '' ?></p>
              </div>
          </div>
        <button class="button button-primary button-pipaluk" type="submit" name="update">Update</button>
      </form>           
                      
        </article>   
                      
                </div>                  
              </div> 
          </section>