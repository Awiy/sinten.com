
        <!-- Begin Page Content -->
        <div class="container-fluid overflow-auto">

          <!-- Page Heading -->
          <div class="mb-4">
            <span class="h6 text-info bg-gradient-light">
            <i class="<?= $icon['icon']; ?>"></i>
            <?= $title ?></span>
          </div>
          <!-- Page Heading -->
          
          <div class="row">
          <div class="col-lg-8">
          
          <?= form_open_multipart('user/editprofile'); ?>
          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Full name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
              <?= form_error('name', '<small class="text-danger pl-3">','</small>'); ?>
            </div>
            
          </div>

          <div class="form-group row">
            <div class="col-sm-2">Picture</div>
            <div class="col sm-10">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?= base_url('assets/img/profile/'). $user['image']; ?>" class="img-thumbnail rounded-left">
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image">
                  <label class="custom-file-label" for="image">Choose file</label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row justify-content-end">
              <button type="submit" class="btn btn-primary">Save edit</button>
          </div>

          </form>
          </div>
          </div>

        </div>
        <!-- end page content -->



