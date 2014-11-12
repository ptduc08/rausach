<div class="box-sanpham">
	<div class="tittle-box-sanpham"><strong>SẢN PHẨM LIÊN QUAN</strong></div>
	<div class="content-sp">
	
	<?php
	if (!empty($productList) && count($productList) > 0) {
		foreach($productList as $key=>$val) {
			$val = $blockView->cmsReplaceString($val);
			$product_id = $val['id'];
			$product_name = $val['product_name'];
			$product_price = $val['price'];
				
			$cover_image = FILES_URL . '/products/cover-images/medium/' . $val['cover_image'];
			
			$filter = new Zend_Filter();
			$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
								  ->addFilter(new Zend_Filter_StringTrim())
								  ->addFilter(new Zend_Filter_Alnum(true))
								  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
								  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
			
			$productUrlOptions = array('module'=>'default','controller'=>'san-pham','action'=>'san-pham-chi-tiet',
									'title'=>$multiFilter->filter($product_name),'id'=>$product_id);
			
			$product_link = $blockView->url($productUrlOptions,'productdetail');
	?>

		<div class="cont-01">
			<div class="cont-01-img"><img src="<?php echo $cover_image; ?>" /></div>
			<div class="name-sp"><span><?php echo $product_name; ?></span></div>
			<div class="gia-sp">Giá:<span><?php echo $product_price; ?></span></div>
			<div class="more-sp"><a  href="<?php echo $product_link; ?>">Chi tiết</a></div>
		</div>
	<?php 
			} 
		}
	?>
	</div>
</div>