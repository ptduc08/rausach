<div class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav" id="side-menu">
			<!-- ------------------------ o tim kiem ---------------------------- -->
			<!--
			<li class="sidebar-search">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="<?php echo $this->translate('admin-cp-search'); ?>">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button">
						<i class="fa fa-search"></i>
					</button>
					</span>
				</div>
			</li> -->
                        
			<li>
				<a href="<?php echo $this->baseUrl('/admin/index/index'); ?>">
					<i class="fa fa-dashboard fa-fw"></i> <?php echo $this->translate('menu-dashboard'); ?>
				</a>
			</li>
			<li>
				<a href="<?php echo $this->baseUrl('/admin/admin-pages/index'); ?>">
					<i class="fa fa-edit fa-fw"></i> <?php echo $this->translate('menu-pages'); ?>
				</a>
			</li>
			<li>
				<a href="#"><i class="fa fa-cog fa-fw"></i> <?php echo $this->translate('menu-services'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level"> 
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-service-category/index'); ?>">
								<i class="fa fa-cog fa-fw"></i>
								<?php echo $this->translate('menu-services-category'); ?>
							</a>
						</li>
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-service/index'); ?>">
								<i class="fa fa-cog fa-fw"></i>
								<?php echo $this->translate('menu-services-manager'); ?>
							</a>
						</li>
					</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-suitcase fa-fw"></i> <?php echo $this->translate('menu-projects'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level"> 
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-project-category/index'); ?>">
								<i class="fa fa-suitcase fa-fw"></i>
								<?php echo $this->translate('menu-project-category'); ?>
							</a>
						</li>
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-project/index'); ?>">
								<i class="fa fa-suitcase fa-fw"></i>
								<?php echo $this->translate('menu-project-manager'); ?>
							</a>
						</li>
					</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-file-text-o fa-fw"></i> <?php echo $this->translate('menu-news'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level"> 
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-news-category/index'); ?>">
								<i class="fa fa-file-text-o fa-fw"></i>
								<?php echo $this->translate('menu-news-category'); ?>
							</a>
						</li>
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-news-article/index'); ?>">
								<i class="fa fa-file-text-o fa-fw"></i>
								<?php echo $this->translate('menu-news-article'); ?>
							</a>
						</li>
					</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-inbox fa-fw"></i> <?php echo $this->translate('menu-products'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level"> 
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-product-category/index'); ?>">
								<i class="fa fa-inbox fa-fw"></i>
								<?php echo $this->translate('menu-product-category'); ?>
							</a>
						</li>
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-product/index/'); ?>">
								<i class="fa fa-inbox fa-fw"></i>
								<?php echo $this->translate('menu-product-manager'); ?>
							</a>
						</li>
					</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $this->translate('menu-member-usermanager'); ?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level"> 
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-user/index'); ?>">
								<i class="fa fa-user fa-fw"></i>
								<?php echo $this->translate('menu-member-usermanager'); ?>
							</a>
						</li>
						<li>
							<a href="<?php echo $this->baseUrl('/admin/admin-group/index'); ?>">
								<i class="fa fa-user fa-fw"></i>
								<?php echo $this->translate('menu-member-groupmanager'); ?>
							</a>
						</li>
					</ul>
			</li>
			
		</ul>
		<!-- /#side-menu -->
	</div>
	<!-- /.sidebar-collapse -->
</div>