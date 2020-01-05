
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="#"><img class="img-circle" width="80" height="80" src="<?= base_url('assets/img/profile/'). $user['image'] ?>"></a></p>
          <h5 class="centered"><span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?= $user['name']; ?> </span></h5>

          <li class="sub-menu" href="javascript:;">
            <a href="<?= base_url('home') ?>"><i class="fas fa-fw fa-home"></i>Home</a>
          </li>

          <li class="sub-menu">
              <?php 
                $role_id = $this->session->userdata('role_id'); 
             
              $queryMenu = "SELECT `user_menu`. `id`, `menu`
                      FROM `user_menu` JOIN `user_access_menu` 
                        ON `user_menu`. `id` = `user_access_menu`. `menu_id`
                      WHERE `user_access_menu`. `role_id` = $role_id
                      AND `user_menu`.`is_active` = 1
                      ";
              $menu = $this->db->query($queryMenu)->result_array();
              ?>

              
              <?php foreach ($menu as $m ):?>
              
              
              <?php 
                $menuId = $m['id'];
                $querySubMenu= "SELECT * 
                        FROM `user_sub_menu` JOIN `user_menu`
                          ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                        WHERE `user_sub_menu`.`menu_id` = $menuId
                        AND `user_sub_menu`.`is_active` = 1
                      ";
              $subMenu = $this->db->query($querySubMenu)->result_array();
              
              ?>

              <?php foreach ($subMenu  as $sm): ?>
                
                  <?php if($title == $sm['title']): ?>
                  <li class="sub-menu active bg-gradient-info">
                    <?php else: ?>
                    <li class="sub-menu">
                  <?php endif; ?>
                  <a href="<?= base_url($sm['url']); ?>">
                  <i class="<?= $sm['icon']; ?>"></i>
                  <span><?= $sm['title']; ?></span></a>
                  </li>
                  </li>
                

              <?php endforeach; ?>

              <?php endforeach; ?>
          </li>

          <li class="sub-menu" href="javascript:;" >
            <a href="#">
              <i class="far fa-fw fa-comments"></i>
              <span>Chat Room</span>
            </a>
          </li>

          <li class="sub-menu" href="javascript:;">
            <a href="<?= base_url('home/lock') ?>"><i class="fas fa-fw fa-lock"></i>Lock Screen</a>
          </li>

          

        </ul>