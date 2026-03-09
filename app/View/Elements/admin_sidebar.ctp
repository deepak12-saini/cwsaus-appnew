	<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				
				<?php $role = $this->Session->read('User.role');	?>
				<ul class="nav nav-list">
					<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_dashboard') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/users/dashboard">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php if ($this->params['controller']=='packages' && $this->params['action']=='admin_index') {echo 'active';}?>" style="display:none;">
						<a href="<?php echo SITEURL?>admin/packages">
							<i class="menu-icon fa fa-bars "></i>
							<span class="menu-text"> Packages </span></b>
						</a>

					</li>
					<li class="<?php if ($this->params['controller']=='customers' && $this->params['action']=='admin_index') {echo 'active';}?>" style="display:none;">
						<a href="<?php echo SITEURL?>admin/customers/index/all">
							<i class="menu-icon fa fa-suitcase  " ></i>
							<span class="menu-text">Review Clients</span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php if ($this->params['controller']=='clients' && $this->params['action']=='admin_index') {echo 'active';}?>" style="display:none;">
						<a href="<?php echo SITEURL?>admin/clients/index/all">
							<i class="menu-icon fa fa-suitcase  " ></i>
							<span class="menu-text">Client List</span>
						</a>

						<b class="arrow"></b>
					</li>
					
					
					<!-- <li class="<?php if ($this->params['controller']=='validators' && ($this->params['action']=='admin_list' || $this->params['action']=='admin_details')) {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/validators/list">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text">Payroll List</span>
						</a>
						<b class="arrow"></b>
					</li> -->
					<!-- <li class="<?php if ($this->params['controller']=='customers' && $this->params['action']=='admin_allclient') {echo 'active';}?>" >
						<a href="<?php echo SITEURL?>admin/customers/allclient/all">
							<i class="menu-icon fa fa-suitcase  " ></i>
							<span class="menu-text">Client List (SBO) </span>
						</a>

						<b class="arrow"></b>
					</li> -->
					
					<li class="<?php if (($this->params['controller']=='customers') && ($this->params['action']=='admin_new' || $this->params['action']=='admin_uploadeddoc'  ||  $this->params['action']=='admin_complete'  ||  $this->params['action']=='admin_expired')) {echo 'active';}?>" style="display:none;">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cog "></i>
							<span class="menu-text"> Order Management </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>
						<ul class="submenu">
							<li class="<?php if ($this->params['controller']=='customers' && $this->params['action']=='admin_new') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/customers/new/all">
									<i class="menu-icon fa fa-file"></i>
									New Order List
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='customers' && $this->params['action']=='admin_uploadeddoc') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/customers/uploadeddoc/all">
									<i class="menu-icon fa fa-file"></i>
									Upload Order List
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='customers' && $this->params['action']=='admin_complete') {echo 'active';}?>" >
								<a href="<?php echo SITEURL;?>admin/customers/complete/all">
									<i class="menu-icon fa fa-file"></i>
									Complete
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='customers' && $this->params['action']=='admin_expired') {echo 'active';}?>" >
								<a href="<?php echo SITEURL;?>admin/customers/expired/all">
									<i class="menu-icon fa fa-file"></i>
									Expired Order List
								</a>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>
					
					<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_subscribers') {echo 'active';}?>" >
						<a href="<?php echo SITEURL?>admin/users/subscribers" style="display:none;">
							<i class="menu-icon fa fa-send "></i>
							<span class="menu-text"> Subscribers </span></b>
						</a>

					</li>
					<?php if($role == 'S'){?>
				<!-- 	<li class="<?php if ($this->params['controller']=='SupportTickets' && $this->params['action']=='admin_index') {echo 'active';}?>" >
						<a href="<?php echo SITEURL?>admin/SupportTickets">
							<i class="menu-icon fa fa-tasks "></i>
							<span class="menu-text"> Questions & Support  </span></b>
						</a>

					</li> -->
					<?php }?>
				
					<!--li class="<?php if ($this->params['controller']=='support_tickets' && $this->params['action']=='admin_index') {echo 'active';}?>" style="display:none;">
						<a href="<?php echo SITEURL?>admin/support_tickets">
							<i class="menu-icon fa fa-bars "></i>
							<span class="menu-text"> Questions and Support </span></b>
						</a>

					</li-->
					<li class="<?php if ($this->params['controller']=='sims' && $this->params['action']=='admin_report') {echo 'active';}?>" style="display:none;">
						<a href="<?php echo SITEURL?>admin/sims/report">
							<i class="menu-icon fa fa-bar-chart  "></i>
							<span class="menu-text"> Report</span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php 
							
					if($role == 'S'){?>
					<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_index') {echo 'active';}?>" style="display:none;">
						<a href="<?php echo SITEURL?>admin/users/index">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text">Admin User List</span>
						</a>
						<b class="arrow"></b>
					</li>
					<?php } ?>
					<li class="<?php if ($this->params['controller']=='quicks' && $this->params['action']=='admin_request_list') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/quicks/request_list">
							<i class="menu-icon fa fa-comment "></i>
							<span class="menu-text">Contact Us Request </span></b>
						</a>

					</li>
					<!--li class="<?php if ($this->params['controller']=='quicks' && $this->params['action']=='admin_quote_comericals') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/quicks/quote_comericals">
							<i class="menu-icon fa fa-building "></i>
							<span class="menu-text"> Quotes Commercial </span></b>
						</a>

					</li-->
					<li class="<?php if ($this->params['controller']=='menus' && $this->params['action']=='admin_index') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/menus">
							<i class="menu-icon fa fa-bars "></i>
							<span class="menu-text"> Pages </span></b>
						</a>

					</li>

					<li class="<?php if ($this->params['controller']=='galleries' && $this->params['action']=='admin_index') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/galleries">
							<i class="menu-icon fa fa-image "></i>
							<span class="menu-text"> Gallery </span></b>
						</a>

					</li>
					<!--li class="<?php if ($this->params['controller']=='quicks' && $this->params['action']=='admin_index') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/quicks">
							<i class="menu-icon fa fa-list "></i>
							<span class="menu-text"> Quick Quote </span></b>
						</a>

					</li-->
					<li class="<?php if (($this->params['controller']=='blogs')) {echo 'active';}?>" >
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file "></i>
							<span class="menu-text"> Blogs </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
						<li class="<?php if ($this->params['controller']=='categories' && $this->params['action']=='admin_index') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/categories/index">
									<i class="menu-icon fa fa-file"></i>
									Categories
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='blogs' && $this->params['action']=='admin_index') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/blogs/index">
									<i class="menu-icon fa fa-file"></i>
									Blog List
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='blogs' && $this->params['action']=='admin_add') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/blogs/add">
									<i class="menu-icon fa fa-setting"></i>
									Add Blog
								</a>

								<b class="arrow"></b>
							</li>
							<?php if($role == 'S'){?>
							
							
							<?php }?>
						</ul>
					</li>
					<!--li class="<?php if (($this->params['controller']=='states')) {echo 'active';}?>" >
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-flag "></i>
							<span class="menu-text">Calculator Settings</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if ($this->params['controller']=='states' && $this->params['action']=='admin_index') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/states/index">
									<i class="menu-icon fa fa-file"></i>
									State List
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='states' && $this->params['action']=='admin_stateprice') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/states/stateprice">
									<i class="menu-icon fa fa-file"></i>
									Solar Price List
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='states' && $this->params['action']=='admin_subsubsidy') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/states/subsubsidy">
									<i class="menu-icon fa fa-setting"></i>
									Settings
								</a>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li-->
					
					<li class="<?php if (($this->params['controller']=='users') && ($this->params['action']=='admin_payment_setting' || $this->params['action']=='admin_profile'  ||  $this->params['action']=='admin_change_password') ||  $this->params['action']=='admin_website_setting'||  $this->params['action']=='admin_referral_setting' ) {echo 'active';}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cog "></i>
							<span class="menu-text"> Settings</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_profile') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/users/profile">
									<i class="menu-icon fa fa-setting"></i>
									Profile
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_change_password') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/users/change_password">
									<i class="menu-icon fa fa-setting"></i>
									Change Password
								</a>

								<b class="arrow"></b>
							</li>
							<?php if($role == 'S'){?>
							<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_price') {echo 'active';}?>" style="display:none;" >
								<a href="<?php echo SITEURL;?>admin/users/price">
									<i class="menu-icon fa fa-setting"></i>
									Price Setting
								</a>

								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_website_setting') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/users/website_setting">
									<i class="menu-icon fa fa-setting"></i>
									Website Setting
								</a>

								<b class="arrow"></b>
							</li>
							<?php }?>
						</ul>
					</li>
					
							
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>