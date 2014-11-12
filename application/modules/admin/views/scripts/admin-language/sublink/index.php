<?php 
	$linkMemberManager = $this->baseUrl('/admin/admin-user/index/');
	$linkPermission = $this->baseUrl('/admin/admin-permission/index/');
?>

<div id="submenu-box">
	<div style="border:1px solid #CCCCCC; padding:5px">
		<ul id="submenu">
			<li>
				<a href="#" class="active"><?php echo $this->translate('sublink-groupmanager'); ?></a>
			</li>
			<li>
				<a href="<?php echo $linkMemberManager; ?>">User manager</a>
			</li>
			<li>
				<a href="<?php echo $linkPermission; ?>">Permission</a>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
</div>	