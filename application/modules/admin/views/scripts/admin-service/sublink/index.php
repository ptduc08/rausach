<?php 
	$linkServiceCategoryManager = $this->baseUrl('/admin/admin-service-category/index/');
	$linkServiceManager = $this->baseUrl('/admin/admin-service/index/');
?>

<div id="submenu-box">
	<div style="border:1px solid #CCCCCC; padding:5px">
		<ul id="submenu">
			<li>
				<a href="<?php echo $linkServiceCategoryManager; ?>" ><?php echo $this->translate('sublink-servicecategory'); ?></a>
			</li>
			<li>
				<a href="#" class="active"><?php echo $this->translate('sublink-service'); ?></a>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
</div>	