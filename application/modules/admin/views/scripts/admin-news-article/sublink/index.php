<?php 
	$linkNewsCategoryManager = $this->baseUrl('/admin/admin-news-category/index/');
	$linkNewsArticleManager = $this->baseUrl('/admin/admin-news-article/index/');
?>

<div id="submenu-box">
	<div style="border:1px solid #CCCCCC; padding:5px">
		<ul id="submenu">
			<li>
				<a href="<?php echo $linkNewsCategoryManager; ?>"><?php echo $this->translate('sublink-newscategory'); ?></a>
			</li>
			<li>
				<a href="#" class="active"><?php echo $this->translate('sublink-newsarticle'); ?></a>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
</div>	