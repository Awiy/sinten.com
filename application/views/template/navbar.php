    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <?php 
        if($this->session->userdata('email')) {
          $this->load->view('template/privatenavbar');
        } else {
          $this->load->view('template/publicnavbar');
        }
        
        ?>
        
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-9 main-chart">