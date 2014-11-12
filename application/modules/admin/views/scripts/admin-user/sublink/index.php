<?php 
	$linkGroupManager = $this->baseUrl('/admin/admin-group/index/');
	$linkPermission = $this->baseUrl('/admin/admin-permission/index/');
?>

<div id="submenu-box">
	<div style="border:1px solid #CCCCCC; padding:5px">
		<ul id="submenu">
			<li>
				<a href="<?php echo $linkGroupManager; ?>"><?php echo $this->translate('sublink-groupmanager'); ?></a>
			</li>
			<li>
				<a href="#" class="active"><?php echo $this->translate('sublink-usermanager'); ?></a>
			</li>
			<li>
				<a href="<?php echo $linkPermission; ?>"><?php echo $this->translate('sublink-permission'); ?></a>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
</div>	