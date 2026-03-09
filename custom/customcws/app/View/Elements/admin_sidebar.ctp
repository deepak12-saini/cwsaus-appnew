	<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				

				<ul class="nav nav-list">
					<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_dashboard') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/users/dashboard">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php if ($this->params['controller']=='clients') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/clients">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> CRM </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php if ($this->params['controller']=='sales' && (($this->params['action']=='admin_saledasboard') || ($this->params['action']=='admin_index') || ($this->params['action']=='admin_salereminder'))) {echo 'active';}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file "></i>
							<span class="menu-text">Sales</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							
							<li class="<?php if ($this->params['controller']=='sales' && $this->params['action']=='admin_saledasboard') {echo 'active';}?>">
								<a href="<?php echo SITEURL.'admin/sales/saledasboard'; ?>">
									<i class="menu-icon fa fa-setting"></i>
									Sale Dashboard
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='sales' && $this->params['action']=='admin_index') {echo 'active';}?>">
								<a href="<?php echo SITEURL.'admin/sales'; ?>">
									<i class="menu-icon fa fa-setting"></i>
									Sale Team
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='sales' && $this->params['action']=='admin_salereminder') {echo 'active';}?>">
								<a href="<?php echo SITEURL.'admin/sales/salereminder'; ?>">
									<i class="menu-icon fa fa-setting"></i>
									Sale Reminder
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<!--li class="<?php if ($this->params['controller']=='categories' && $this->params['action']=='admin_index') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/categories">
							<i class="menu-icon fa fa-bars "></i>
							<span class="menu-text"> Category List</span></b>
						</a>

					</li>
					<li class="<?php if ($this->params['controller']=='products') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/products">
							<i class="menu-icon fa fa-file "></i>
							<span class="menu-text"> Product List</span></b>
						</a>

					</li-->
					
					<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_customer') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/users/customer">
							<i class="menu-icon fa fa-user "></i>
							<span class="menu-text">Customer </span></b>
						</a>

					</li>
					<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_lead') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/users/lead">
							<i class="menu-icon fa fa-user "></i>
							<span class="menu-text">Caller Leads </span></b>
						</a>

					</li>
					<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_staff') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/users/staff">
							<i class="menu-icon fa fa-user "></i>
							<span class="menu-text">Staff </span></b>
						</a>

					</li>
					<li class="<?php if (($this->params['controller']=='staffs') && ($this->params['action']=='admin_conformancelist') || $this->params['action']=='datasheet') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/staffs/conformancelist">
							<i class="menu-icon fa fa-tasks"></i>
							<span class="menu-text">Non Conformance</span></b>
						</a>
					</li>
					<li class="<?php if ($this->params['controller']=='complaints') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/complaints">
							<i class="menu-icon fa fa-image "></i>
							<span class="menu-text">Complaints  List</span></b>
						</a>
					</li>
					<li class="<?php if ($this->params['controller']=='mailers' && $this->params['action']=='admin_index') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/mailers">
							<i class="menu-icon fa fa-envelope "></i>
							<span class="menu-text">Emailer </span></b>
						</a>

					</li>
					<li class="<?php if ($this->params['controller']=='mailers' && $this->params['action']=='admin_welcomemailer') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/mailers/welcomemailer">
							<i class="menu-icon fa fa-envelope"></i>
							<span class="menu-text">Welcome Emailer </span></b>
						</a>

					</li>
					<li class="<?php if ($this->params['controller']=='estimators' && $this->params['action']=='admin_index') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/estimators">
							<i class="menu-icon fa fa-building"></i>
							<span class="menu-text">Project Estimators</span></b>
						</a>

					</li>
					<li class="<?php if ($this->params['controller']=='natas') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/natas">
							<i class="menu-icon fa fa-certificate"></i>
							<span class="menu-text"> NATA </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="<?php if ($this->params['controller']=='tasks') {echo 'active';}?>">
						<a href="<?php echo SITEURL.'admin/tasks/type'; ?>">
							<i class="menu-icon fa fa-flask"></i>
							<span class="menu-text">DuroLab</span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="<?php if ($this->params['controller']=='documents') {echo 'active';}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bars "></i>
							<span class="menu-text"> Document</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							
							<li class="<?php if ($this->params['controller']=='documents' && $this->params['action']=='admin_index') {echo 'active';}?>">
								<a href="<?php echo SITEURL?>admin/documents">
									<i class="menu-icon fa fa-setting"></i>
									Record of library
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='documents' && $this->params['action']=='admin_receiving_insepction') {echo 'active';}?>">
								<a href="<?php echo SITEURL?>admin/documents/receiving_insepction">
									<i class="menu-icon fa fa-setting"></i>
									Receive Inspection
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='documents' && $this->params['action']=='admin_preventive_maintenance') {echo 'active';}?>">
								<a href="<?php echo SITEURL?>admin/documents/preventive_maintenance">
									<i class="menu-icon fa fa-setting"></i>
									Preventive Maintenance
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='documents' && $this->params['action']=='admin_executive_duty_requisition') {echo 'active';}?>">
								<a href="<?php echo SITEURL?>admin/documents/executive_duty_requisition">
									<i class="menu-icon fa fa-setting"></i>
									Executive Duty Requisition
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='documents' && $this->params['action']=='admin_calibration_equipment') {echo 'active';}?>">
								<a href="<?php echo SITEURL?>admin/documents/calibration_equipment">
									<i class="menu-icon fa fa-setting"></i>
									Calibration Equipment
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='documents' && $this->params['action']=='admin_nc_closure') {echo 'active';}?>">
								<a href="<?php echo SITEURL?>admin/documents/nc_closure">
									<i class="menu-icon fa fa-setting"></i>
									Format For NC and NC Closure
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li class="<?php if ($this->params['controller']=='hrs') {echo 'active';}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-file "></i>
							<span class="menu-text"> HR </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							
							<li class="<?php if ($this->params['controller']=='hrs'  && $this->params['action']=='admin_index') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/hrs">
									<i class="menu-icon fa fa-setting"></i>
									Training Need Assessment
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='hrs'  && $this->params['action']=='attendence') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/hrs/attendence">
									<i class="menu-icon fa fa-setting"></i>
									Attendence
								</a>
								<b class="arrow"></b>
							</li>
								<li class="<?php if ($this->params['controller']=='hrs'  && $this->params['action']=='admin_performancefeedback') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/hrs/performancefeedback">
									<i class="menu-icon fa fa-setting"></i>
									Performance Feedback
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='hrs'  && $this->params['action']=='admin_newjoining') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/hrs/newjoining">
									<i class="menu-icon fa fa-setting"></i>
									New Joining 
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='hrs'  && $this->params['action']=='admin_reportorganization') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/hrs/reportorganization">
									<i class="menu-icon fa fa-setting"></i>
									Joining Report to the Organization
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='hrs'  && $this->params['action']=='admin_format_training_calendars') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/hrs/format_training_calendars">
									<i class="menu-icon fa fa-setting"></i>
									Format Training Calendars
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='hrs'  && $this->params['action']=='admin_format_evaluation_employe') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/hrs/format_evaluation_employe">
									<i class="menu-icon fa fa-setting"></i>
									Format Evaluation Employee
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='hrs'  && $this->params['action']=='admin_hr_appraisal_form') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/hrs/hr_appraisal_form">
								<i class="menu-icon fa fa-setting"></i>
									Performance Appraisal Form
								</a>
								<b class="arrow"></b>
							</li>
						</ul>	
					</li>
					<li class="<?php if ($this->params['controller']=='organisations' || $this->params['controller']=='purchases') {echo 'active';}?>">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-briefcase"></i>
							<span class="menu-text"> Organisation </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							
							<li class="<?php if ($this->params['controller']=='organisations' ) {echo 'active';}?>">
								 
								<a href="<?php echo SITEURL;?>admin/organisations"> 
									<i class="menu-icon fa fa-setting"></i>
									Circular Review
								</a>
								<b class="arrow"></b>
							</li>
							
							<li class="<?php if ($this->params['controller']=='purchases' && $this->params['action']=='admin_index') {echo 'active';}?>">
								 
								<a href="<?php echo SITEURL;?>admin/purchases"> 
									<i class="menu-icon fa fa-setting"></i>
									Purchases
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='purchases' && $this->params['action']=='admin_resource_requirement') {echo 'active';}?>">
								 
								<a href="<?php echo SITEURL;?>admin/purchases/resource_requirement"> 
									<i class="menu-icon fa fa-setting"></i>
									Resource Requirement
								</a>
								<b class="arrow"></b>
							</li>
							
						</ul>
					</li>	
					<li class="<?php if ($this->params['controller']=='audits') {echo 'active';}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-thumbs-up "></i>
							<span class="menu-text"> Quality Assurance </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							
							
							<!--li class="">
								<a href="<?php echo SITEURL;?>staffs/dashboard">
									<i class="menu-icon fa fa-setting"></i>
									Document Manager
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?php echo SITEURL;?>staffs/dashboard">
									<i class="menu-icon fa fa-setting"></i>
									Training
								</a>
								<b class="arrow"></b>
							</li-->
							<li class="<?php if ($this->params['controller']=='audits'  && $this->params['action']=='admin_index') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/audits">
									<i class="menu-icon fa fa-setting"></i>
									Audit
								</a>
								<b class="arrow"></b>
							</li>
							<li class="<?php if ($this->params['controller']=='audits'  && $this->params['action']=='admin_circularinternalauditlist') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/audits/circularinternalauditlist">
									<i class="menu-icon fa fa-setting"></i>
									Circular Internal Audit
								</a>
								<b class="arrow"></b>
							</li>
							<!--li class="">
								<a href="<?php echo SITEURL;?>staffs/dashboard">
									<i class="menu-icon fa fa-setting"></i>
									Purchase & Store
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?php echo SITEURL;?>staffs/dashboard">
									<i class="menu-icon fa fa-setting"></i>
									Knowledge
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="<?php echo SITEURL;?>staffs/dashboard">
									<i class="menu-icon fa fa-setting"></i>
									My Records & MIS
								</a>
								<b class="arrow"></b>
							</li-->
						</ul>
					</li>
					<!--li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_couponlist') {echo 'active';}?>">
						<a href="<?php echo SITEURL?>admin/users/couponlist">
							<i class="menu-icon fa fa-gift "></i>
							<span class="menu-text">Redeem Coupon </span></b>
						</a>

					</li-->
					<!--li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_subscriber_list') {echo 'active';}?>">
						<a href="<?php echo SITEURL.'admin/users/subscriber_list'; ?>">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text">Subscriber List</span>
						</a>

						<b class="arrow"></b>
					</li>
					
					<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_contactus') {echo 'active';}?>">
						<a href="<?php echo SITEURL.'admin/users/contactus'; ?>">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text">Contact List</span>
						</a>

						<b class="arrow"></b>
					</li-->
					
					
					<li class="<?php if (($this->params['controller']=='users') && ($this->params['action']=='admin_payment_setting' || 
						$this->params['action']=='admin_profile'  ||  $this->params['action']=='admin_change_password') ) {echo 'active';}?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cog "></i>
							<span class="menu-text"> Settings </span>

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
							<li class="<?php if ($this->params['controller']=='users' && $this->params['action']=='admin_web_setting') {echo 'active';}?>">
								<a href="<?php echo SITEURL;?>admin/users/web_setting">
									<i class="menu-icon fa fa-setting"></i>
									Website Settings
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