<?= $this->extend("Admin/template/login") ?>

<?= $this->section("page-title") ?>
    <?= $pageTitle; ?>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block">
                <img src="<?= base_url('public/assets/admin/img/login_pg.png') ?>" width="450px;">
          </div>
          <div class="col-lg-6">

          <?php if (isset($validation)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>

            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
              </div>
              <form action="" method="post" class="user">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name ="email" id="userID" aria-describedby="emailHelp" placeholder="Enter user id...">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                </div>                 
                <button class="btn btn-primary btn-user btn-block" type="submit" name="auth_login">LOGIN</button>
                <hr>                   
              </form>
              <hr>                           
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>

<?= $this->endSection() ?>