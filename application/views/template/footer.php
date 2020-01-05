          </div>
          <?php if($this->session->userdata('email')) {
            $this->load->view('template/privateeven');
          } else {
            $this->load->view('template/publiceven');
          };
          ?>

          <!-- /col-lg-3 -->
          
        </div>
        
        <!-- /row -->
      </section>
         <!--footer start-->
          <footer class="footer">
            <div class="container bg-secondary position-bottom">
              <p class="copyright text-center text-gray-300 my-2">
                Copyright &copy; The Coffee, 2018 - <?= date('Y') ?>
              </p>
              <span class="go-top">
              <a href="#">
                <i class="fas fa-angle-up m-2"></i>
              </a>
              </span>
            </div>
          </footer>
      <!--footer end-->
    <!--main content end-->
    </section>
    
   
  </section>


    <!-- add script page in here -->

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/'); ?>lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="<?= base_url('assets/'); ?>lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="<?= base_url('assets/'); ?>lib/jquery.scrollTo.min.js"></script>
  <script src="<?= base_url('assets/'); ?>lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="<?= base_url('assets/'); ?>lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="<?= base_url('assets/'); ?>lib/common-scripts.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/'); ?>lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/'); ?>lib/gritter-conf.js"></script>


  <script>
  $('.custom-file-input').on('change', function(){
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });
  

  $('.form-check-input').on('click', function(){
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');

    $.ajax({
      url: "<?= base_url('admin/changeaccess'); ?>",
      type: 'post',
      data: {
        menuId: menuId,
        roleId: roleId
      },
      success: function() {
        document.location.href = "<?= base_url('admin/roleaccess/') ?>" + roleId;
      }
    });
  });
  </script>
</body>

</html>