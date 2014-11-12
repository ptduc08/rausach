<?php 
	$linkProductCategoryManager = $this->baseUrl('/admin/admin-product-category/index/');
	$linkProductCategoryAttributeManager = $this->baseUrl('/admin/admin-product-category-attribute/index/');
	$linkProductManager = $this->baseUrl('/admin/admin-product/index/');
?>

<div id="submenu-box">
	<div style="border:1px solid #CCCCCC; padding:5px">
		<ul id="submenu">
			<li>
				<a href="<?php echo $linkProductCategoryManager; ?>" ><?php echo $this->translate('sublink-productcategory'); ?></a>
			</li>
			<li>
				<a href="<?php echo $linkProductCategoryAttributeManager; ?>"><?php echo $this->translate('sublink-productcategoryattribute'); ?></a>
			</li>
			<li>
				<a href="#" class="active"><?php echo $this->translate('sublink-product'); ?></a>
			</li>
		</ul>
		<div class="clr"></div>
	</div>
</div>	