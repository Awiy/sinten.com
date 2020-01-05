        <!-- Begin Page Content -->
        <div class="container-fluid overflow-auto">

          <!-- Page Heading -->
          <div class="mb-4">
            <span class="h6 text-info bg-gradient-light p-2">
            <i class="<?= $icon['icon']; ?>"></i>
            <?= $title ?></span>
          </div>
          <!-- Page Heading -->
          
          <!-- File Content -->
            <div class="col-lg-6">
              <?= form_error('role', '<div class="alert alert-danger" role="alert" >','</div>'); ?>
              <?= $this->session->flashdata('message');?>
              <a href="" class="badge badge-primary mb-2 mt-3 ml-2" data-toggle="modal"></a>
              
              <?= $this->session->flashdata('message');?>
              <a href="" class="badge badge-primary mb-2 mt-3 ml-2" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Role</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($role as $r): ?>
                <tr>
                  <th scope="row"><?= $i; ?></th>
                  <td><?= $r ['role']; ?></td>
                  <td>
                    <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="badge badge-pill badge-warning">access</a>
                    <a href="<?= base_url('admin/roleedit/') . $r['id']; ?>" class="badge badge-pill badge-success">edit</a>
                    <a href="<?= base_url('admin/roledelete/') . $r['id']; ?>" class="badge badge-pill badge-danger">delete</a>
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
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?= base_url('admin/role'); ?>" method="post">
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
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


