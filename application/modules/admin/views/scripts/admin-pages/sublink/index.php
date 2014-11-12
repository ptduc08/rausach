<?php 
	$linkPageManager = $this->baseUrl('/admin/admin-pages/index/');
?>
<div class="row">
	<div class="col-lg-12">
		<div id="submenu-box">
			<div style="border:1px solid #CCCCCC; padding:5px">
				<ul id="submenu">
					<li>
						<a href="<?php echo $linkPageManager; ?>"><?php echo $this->translate('sublink-pagelist'); ?></a>
					</li>
				</ul>
				<div class="clr"></div>
			</div>
		</div>
	</div>
</div>