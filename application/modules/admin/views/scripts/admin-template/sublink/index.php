<?php 
	$linkBannerManager = $this->baseUrl('/admin/admin-template/banner/');
	$linkLogoManager = $this->baseUrl('/admin/admin-template/logo/');
	$linkMapManager = $this->baseUrl('/admin/admin-template/map/');
	$linkVideoManager = $this->baseUrl('/admin/admin-template/video/');
	$linkAdvertiseManager = $this->baseUrl('/admin/admin-template/advertise/');
	$linkDocumentManager = $this->baseUrl('/admin/admin-template/documents/');
?>

<div id="submenu-box">
	<div style="border:1px solid #CCCCCC; padding:5px">
		<ul id="submenu">
			<li>
				<a href="<?php echo $linkBannerManager; ?>"><?php echo $this->translate('sublink-template-banner'); ?></a>
			</li>
			<li>
				<a href="<?php echo $linkLogoManager; ?>"><?php echo $this->translate('sublink-template-logo'); ?></a>
			</li>
			
			<li>
				<a href="<?php echo $linkVideoManager; ?>"><?php echo $this->translate('sublink-template-video'); ?></a>
			</li>
			<li>
				<a href="<?php echo $linkAdvertiseManager; ?>"><?php echo $this->translate('sublink-template-advertise'); ?></a>
			</li>
			<li>
				<a href="<?php echo $linkAdvertiseManager; ?>"><?php echo $this->translate('sublink-template-documents'); ?></a>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
</div>