
    <div class="row justify-content-center">
    <div class="o-hidden border-0 shadow-lg">
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
              <h1 class="h3 text-gray-900 mb-1">The Coffee Member </h1>
              <?= $this->session->flashdata('message'); ?>
                    <h2 class="h6 text-capitalize mb-4 text-info">Register in here</h2>
              </div>
              <form class="form" method="POST" action="<?= base_url('auth/register'); ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Full name" value="<?= set_value('name'); ?>">
                  <?= form_error('name', '<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="User_name" value="<?= set_value('username'); ?>">
                  <?= form_error('username', '<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                  <?= form_error('email', '<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="date" class="form-control form-control-lg" id="birthday" name="birthday" value="<?= set_value('birthday'); ?>">
                  <?= form_error('birthday', '<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="gender" name="gender" placeholder="Male or Female" value="<?= set_value('gender'); ?>">
                  <?= form_error('gender', '<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="phonenumber" name="phonenumber" placeholder="Phone number" value="<?= set_value('phonenumber'); ?>">
                  <?= form_error('phonenumber', '<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-lg" id="password1" name="password1" placeholder="Password">
                    <?= form_error('password1', '<small class="text-danger pl-3">','</small>');?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-lg" id="password2" name="password2" placeholder="Repeat Password">
                  </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-outline-success">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-monospace">
                <a href="<?= base_url('auth/forgotpassword') ?>">Forgot Password?</a>
              </div>
              <div class="text-monospace">
                <a href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>



  

