        <!-- Begin Page Content -->
        <div class="container-fluid overflow-auto">

          <!-- Page Heading -->
          <div class="mb-4">
            <span class="h6 text-info bg-gradient-light">
            <i class="<?= $icon['icon']; ?>"></i>
            <?= $title ?></span>
          </div>
          <!-- /Page Heading -->
            <div class="col-lg-6">
              <?= form_error('menu', '<div class="alert alert-danger" role="alert" >','</div>'); ?>
              <?= $this->session->flashdata('message');?>
              <a href="" class="badge badge-primary mb-2 mt-3 ml-2" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Menu</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($menu as $m): ?>
                <tr>
                  <th scope="row"><?= $i; ?></th>
                  <td><?= $m ['menu']; ?></td>
                  <td><?php if ($m ['is_active']== 1 ) {
                    echo 'active';
                  } else {
                    echo 'unactive';
                  }
                  ?></td>
                  <td>
                    <a href="<?= base_url('menu/editmenu/') . $m ['id']; ?>" class="badge badge-pill badge-success">edit</a>
                    <a href="<?= base_url('menu/deletemenu/') . $m ['id']; ?>" class="badge badge-pill badge-danger">delete</a>
                  </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
                
              </tbody>
            </table>
            </div>
        

        

        </div>
        <!-- end page content -->



<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url('menu'); ?>" method="post">
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>

    </div>
  </div>
</div>


