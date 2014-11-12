<?php 
	$linkProjectCategoryManager = $this->baseUrl('/admin/admin-project-category/index/');
	$linkProjectManager = $this->baseUrl('/admin/admin-project/index/');
?>

<div id="submenu-box">
	<div style="border:1px solid #CCCCCC; padding:5px">
		<ul id="submenu">
			<li>
				<a href="<?php echo $linkProjectCategoryManager; ?>"><?php echo $this->translate('sublink-projectcategory'); ?></a>
			</li>
			<li>
				<a href="#" class="active"><?php echo $this->translate('sublink-project'); ?></a>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
</div>	