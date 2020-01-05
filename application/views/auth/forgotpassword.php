
    <div class="row justify-content-center">
    <div class="o-hidden border-0 shadow-lg">
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-xl">
            <div class="text-center">
                    <?= $this->session->flashdata('message'); ?>
                    <h1 class="h3 text-gray-900 mb-1">Forgot Password</h1>
                    <h2 class="h6 text-capitalize mb-4 text-info">some code send to your mail for reset your password</h2>
                  </div>
                  <form class="form" method="post" action="<?= base_url('auth/forgotpassword') ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                      <?= form_error('email', '<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-toolbar btn-outline-success m-auto">
                      Send Resetcode
                    </button>
                  </form>
              <hr>
              <div class="text-monospace text-lg-center">
                <a href="<?= base_url('auth'); ?>">Back to Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>








