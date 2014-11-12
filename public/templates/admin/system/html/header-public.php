<?php echo $this->doctype(); ?>
<head>
	<?php echo $this->headTitle(); ?>
	<?php echo $this->headMeta(); ?>
	<?php echo $this->headLink(); ?>
	<?php echo $this->headScript(); ?>
</head>
<body id="minwidth-body">
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
						<li><a href="<?php echo $this->baseUrl('/admin/admin/index/'); ?>">
								<?php echo $this->translate('menu-main-backend'); ?>
							</a>
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