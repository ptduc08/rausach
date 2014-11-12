<?php 
	$linkGalleryManager = $this->baseUrl('/admin/admin-gallery/index/');
	$linkGalleryImageManager = $this->baseUrl('/admin/admin-gallery-image/index/');
?>

<div id="submenu-box">
	<div style="border:1px solid #CCCCCC; padding:5px">
		<ul id="submenu">
			<li>
				<a href="#" class="active"><?php echo $this->translate('sublink-gallery'); ?></a>
			</li>
			<li>
				<a href="<?php echo $linkGalleryImageManager; ?>"><?php echo $this->translate('sublink-gallery-image'); ?></a>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
</div>