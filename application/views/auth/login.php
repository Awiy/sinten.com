


    <!-- Outer Row -->
    <div class="container row justify-content-center">

        <div class="o-hidden border-0 shadow-lg">
          <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg"> 
                <div class="p-5">
                  <div class="text-center">
                    <?= $this->session->flashdata('message'); ?>
                    <h1 class="h3 text-gray-900 mb-1">The Coffee </h1>
                    <h2 class="h6 text-capitalize mb-4 text-info">everything about this black one</h2>
                  </div>
                  <form class="form" method="post" action="<?= base_url('auth') ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                      <?= form_error('email', '<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                      <?= form_error('password', '<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group">
                      <!-- <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div> --> <!-- rememberme di non aktifkan -->
                    </div>

                    <button type="submit" class="btn btn-primary btn-outline-success">
                      Login
                    </button>

                    <!-- tidak mengaktifkan tombol login fb dan google -->
                    <!-- <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  
                  </form>
                  <hr>
                  <div class="text-monospace">
                    <a href="<?= base_url('auth/forgotpassword') ?>">Forgot Password?</a>
                  </div>
                  <div class="text-monospace">
                    <a href="<?= base_url('auth/register'); ?>">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>




