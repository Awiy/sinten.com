

				<!-- Page Heading -->
					<div class="mb-4">
						<span class="h6 text-info bg-gradient-light">
						<i class="<?= $icon['icon']; ?>"></i>
						<?= $title ?>
						</span>
						<?= $this->session->flashdata('message');?>
					</div>
					<!-- ini halaman isi - conten -->
					<div class="row col-lg">

					<?php if ($this->session->userdata('email')) {
						$this->load->view('home/update');
						$this->load->view('home/read');
					} else {
						$this->load->view('home/read');
					};
					
					?>






