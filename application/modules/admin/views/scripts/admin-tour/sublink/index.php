<?php 
	$linkTourCategoryManager = $this->baseUrl('/admin/admin-tour-category/index/');
	$linkTourManager = $this->baseUrl('/admin/admin-tour/index/');
?>

<div id="submenu-box">
	<div style="border:1px solid #CCCCCC; padding:5px">
		<ul id="submenu">
			<li>
				<a href="<?php echo $linkTourCategoryManager; ?>"><?php echo $this->translate('sublink-tourcategory'); ?></a>
			</li>
			<li>
				<a href="#" class="active"><?php echo $this->translate('sublink-tour'); ?></a>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
</div>	