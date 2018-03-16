<div class="categories">
				<div class="container">
					<?php
						$get_cat = $this->m_id->get_cat()->result();
						$storetype = "";
						foreach ($get_cat as $cat) {
							$storetype = $cat->parent;
							echo '
								<div class="col-md-3 focus-grid">
									<a href="'.base_url('front/post/fill/'.$storetype.'').'">
										<div class="focus-border">
										<div class="focus-layout">
										<div class="focus-image"><i class="'.$cat->class.'"></i></div>
									<h4 class="clrchg">'.$cat->storetype.'</h4>
								</div>
								</div>
									</a>
								</div>
							';
						}
					?>

					<!-- <div class="col-md-12 focus-grid">
						<a href="<?php echo base_url('front/post/fill/non')?>">
							<div class="focus-border">
								<div class="focus-layout"> -->
									<!-- <div class="focus-image"><i class="fa fa-home"></i></div> -->
					<!-- 				<h4 class="clrchg">All Categories</h4>
								</div>
							</div>
						</a>
					</div> -->
					<div class="clearfix"></div>
				</div>
			</div>