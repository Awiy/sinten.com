        <!-- Begin Page Content -->
        <div class="container-fluid overflow-auto">

          <!-- Page Heading -->
          <div class="mb-5">
            <span class="h6 text-info bg-gradient-light p-2">
            <i class="<?= $icon['icon']; ?>"></i>
            <?= $title ?></span>
          </div>
          <!-- Page Heading -->
            <div class="col-lg-6">
              <?= $this->session->flashdata('message');?>

              <p class="text-gray-400"> <span class="bg-gradient-info p-1"><?= $role['role'] ?> Controler</span></p>
              
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Menu</th>
                  <th scope="col">Access</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($menu as $m): ?>
                <tr>
                  <th scope="row"><?= $i; ?></th>
                  <td><?= $m ['menu']; ?></td>
                  <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?=$m ['id'];  ?>">
                    </div>
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
          <input type="text" class="form-control" id="menu" name="menu" placeholder="Role name">
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


