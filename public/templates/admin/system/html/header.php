<?php echo $this->doctype(); ?>
<head>
	<?php echo $this->headTitle(); ?>
	<?php echo $this->headMeta(); ?>
	<?php echo $this->headLink(); ?>
	<?php echo $this->headScript(); ?>
</head>
<body id="minwidth-body">

<?php 
	$info = new Zendvn_System_Info();
	$username = $info->getMemberInfo('user_name');
	$user_id = $info->getMemberInfo('id');
	$linkUserInfo = $this->baseUrl('/admin/admin-user/info-yourself');
?>

	<div id="border-top" class="h_green">
		<div>
			<div>
 				<span class="version"><?php echo $this->translate('header-version'); ?></span>
 				<span class="title" style="padding-left:20px">
 					<?php echo $this->translate('header-title'); ?>
 				</span>
			</div>
		</div>
	</div>
	<div id="header-box">
		<div id="module-status">
			<span class="preview">
				<a href="<?php echo $linkUserInfo; ?>"><?php echo $username; ?></a>
			</span>
			<!-- <a href="#">
				<span class="no-unread-messages">0</span>
			</a>
			<span class="loggedin-users">1</span> -->
			<span class="logout">
				<a href="<?php echo $this->baseUrl('/admin/public/logout'); ?>">
					<?php echo $this->translate('header-logout'); ?>
				</a>
			</span>
		</div>
		<div id="module-menu">

			<!----------------------------------- BEGIN: Menu --------------------------------->
			<ul class="menuTiny" id="menuTiny">
				<li><a href="#" class="menuTinyLink"><?php echo $this->translate('menu-main'); ?></a>
					<ul>
						<li><a href="<?php echo $this->baseUrl('/default/index/index/'); ?>">
								<?php echo $this->translate('menu-main-frontend'); ?>
							</a>
						</li>
						<li><a href="<?php echo $this->baseUrl('/admin/index/index/'); ?>">
								<?php echo $this->translate('menu-main-backend'); ?>
							</a>
						</li>
					</ul>
				</li>
				<!-- ------------------------ MENU PAGES -->
				<li>
					<a href="<?php echo $this->baseUrl('/admin/admin-pages/index/'); ?>" class="menuTinyLink">
						<?php echo $this->translate('menu-pages'); ?>
					</a>
				</li>
				<!-- ------------------------ MENU SERVICES -->
				<li>
					<a href="#" class="menuTinyLink"><?php echo $this->translate('menu-services'); ?></a>
					<ul>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-service-category/index/'); ?>"><?php echo $this->translate('menu-services-category'); ?></a></li>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-service/index/'); ?>"><?php echo $this->translate('menu-services-manager'); ?></a></li>
					</ul>
				</li>
				
				<!-- ------------------------ MENU PROJECT -->
				<li><a href="#" class="menuTinyLink"><?php echo $this->translate('menu-projects'); ?></a>
					<ul>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-project-category/index/'); ?>">
								<?php echo $this->translate('menu-project-category'); ?>
							</a>
						</li>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-project/index/'); ?>">
								<?php echo $this->translate('menu-projects'); ?>
							</a>
						</li>
					</ul>
				</li>
				
				<!-- ------------------------ MENU NEWS -->
				<li><a href="#" class="menuTinyLink"><?php echo $this->translate('menu-news'); ?></a>
					<ul>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-news-category/index/'); ?>">
								<?php echo $this->translate('menu-news-category'); ?>
							</a>
						</li>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-news-article/index/'); ?>">
								<?php echo $this->translate('menu-news-article'); ?>
							</a>
						</li>
					</ul>
				</li>
				
				<!-- ------------------------ MENU PRODUCT -->
				<li><a href="#" class="menuTinyLink"><?php echo $this->translate('menu-products'); ?></a>
					<ul>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-product-category/index/'); ?>">
								<?php echo $this->translate('menu-product-category'); ?>
							</a>
						</li>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-product/index/'); ?>">
								<?php echo $this->translate('menu-products'); ?>
							</a>
						</li>
					</ul>
				</li>
				
				<!-- ------------------------ MENU CONTACT -->
				<li>
					<a href="<?php echo $this->baseUrl('/admin/admin-contact/index/'); ?>" class="menuTinyLink"><?php echo $this->translate('menu-contact'); ?></a>
				</li>
				<!-- ------------------------ MENU MEMBERS -->
				<li><a href="#" class="menuTinyLink"><?php echo $this->translate('menu-member'); ?></a>
					<ul>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-group/index/'); ?>">
								<?php echo $this->translate('menu-member-groupmanager'); ?>
							</a>
						</li>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-user/index/'); ?>">
								<?php echo $this->translate('menu-member-usermanager'); ?>
							</a>
						</li>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-permission/index/'); ?>">
								<?php echo $this->translate('menu-member-permission'); ?>
							</a>
						</li>
					</ul>
				</li>
				<!-- ------------------------ MENU SYSTEM -->
				<li>
					<a href="#" class="menuTinyLink"><?php echo $this->translate('menu-system'); ?></a>
					<ul>
						<li><a href="<?php echo $this->baseUrl('/admin/admin-language/index/'); ?>">
								<?php echo $this->translate('menu-system-languagemanager'); ?>
							</a>
						</li>
						<li><a href="#"><?php echo $this->translate('menu-system-templatemanager'); ?></a>
							<ul>
								<li><a href="<?php echo $this->baseUrl('/admin/admin-template/banner/'); ?>">
										<?php echo $this->translate('menu-system-bannerslidemanager'); ?>
									</a>
								</li>
								<li><a href="<?php echo $this->baseUrl('/admin/admin-template/logo/'); ?>">
										<?php echo $this->translate('menu-system-companylogomanager'); ?>
									</a>
								</li>
								<li><a href="<?php echo $this->baseUrl('/admin/admin-template/company-map/'); ?>">
										<?php echo $this->translate('menu-system-companymapmanager'); ?>
									</a>
								</li>
								<li><a href="<?php echo $this->baseUrl('/admin/admin-template/video/'); ?>">
										<?php echo $this->translate('menu-system-homepagevideo'); ?>
									</a>
								</li>
								<li><a href="<?php echo $this->baseUrl('/admin/admin-template/advertise/'); ?>">
										<?php echo $this->translate('menu-system-advertiseimage'); ?>
									</a>
								</li>
								<li><a href="<?php echo $this->baseUrl('/admin/admin-template/documents/'); ?>">
										<?php echo $this->translate('menu-system-documents'); ?>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>

                <script type="text/javascript">
                    var menu=new menu.dd("menu");
                    menu.init("menuTiny","menuTinyHover");
                </script><!-- END: Menu -->				




		</div>
		<div class="clr"></div>
	</div>