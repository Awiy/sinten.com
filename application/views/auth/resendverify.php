
    <div class="row justify-content-center">
          <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body">
            <div class="row">
              <div class="col-xl">
                  <div class="text-center">
                    <?= $this->session->flashdata('message'); ?>
                    <h1 class="h3 text-gray-900 mb-1">Resend Activated Code</h1>
                    <h2 class="h6 text-capitalize mb-4 text-info">some code send to your mail for activated your account</h2>
                  </div>
                  <form class="form" method="post" action="<?= base_url('auth/resendverify') ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                      <?= form_error('email', '<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary btn-toolbar btn-outline-success m-auto">
                      Send activated code
                    </button>
                  </form>
                  <hr>
                  <div class="text-monospace text-lg-center">
                    <a href="<?= base_url('auth'); ?>">Back to login!</a>
                  </div>
              </div>
              </div>
            </div>
          </div>
    </div>







