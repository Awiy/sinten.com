
    <div class="container">
    <!-- Outer Row -->
      <div class="row justify-content-center">

        <div class="col-lg-6">
        <!-- <div class="col-xl-10 col-lg-12 col-md-9"> asalnya ini -->
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- Hapus bagian ini 'ini image di login' <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg"> <!-- ada angka enam, u/ mencapai 12 pada col-lg-12 parentnya -->
                <div class="p-5">
                  <div class="text-center">
                    <?= $this->session->flashdata('message'); ?>
                    <h1 class="h3 text-gray-900 mb-1">Change Your Password for:</h1>
                    <h2 class="h6 text-capitalize mb-4 text-info  "><?= $this->session->userdata('reset_email') ?></h2>
                  </div>
                  <form class="user" method="post" action="<?= base_url('auth/changepassword') ?>">
                    <div class="form-group">
                    <label for="password1">New Password</label>
                    <input type="password" class="form-control" id="password1" name="password1">
                    <?= form_error('password1', '<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group">
                    <label for="password2">Repeat Password</label>
                    <input type="password" class="form-control" id="password2" name="password2">
                    <?= form_error('password2', '<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <hr>
                    <div class="form-gropup">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>





