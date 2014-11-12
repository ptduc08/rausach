<div class="intro_left_box">
<h4 class="title_intro dotkep">những hình ảnh xem nhiều nhất</h4>

<?php
	if (!empty($galleryList) && count($galleryList) > 0) {
		$order = 0;
		foreach($galleryList as $key=>$val) {
			$val = $blockView->cmsReplaceString($val);
			$order = $order + 1;
			$gallery_id = $val['id'];
			$gallery_name = $val['gallery_name'];
			$description = $val['description'];
			
			$filter = new Zend_Filter();
			$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
								  ->addFilter(new Zend_Filter_StringTrim())
								  ->addFilter(new Zend_Filter_Alnum(true))
								  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
								  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
			
			$galleryUrlOptions = array('module'=>'default','controller'=>'hinh-anh','action'=>'hinh-anh-hoat-dong-chi-tiet',
									'title'=>$multiFilter->filter($gallery_name),'gallery_id'=>$gallery_id);
			
			$gallery_link = $blockView->url($galleryUrlOptions,'gallery-detail');
?>

	<div class="dotngang intro_ti">
		<span class="intro_num"><?php echo $order; ?></span>
		<a href="<?php echo $gallery_link; ?>" title=""><?php echo $gallery_name ?></a>
		<p><?php echo $description; ?></p>
		<div class="clear"></div>
	</div>
<?php 
		}
	} 
?>
                
</div>