<div id="main_box" class="dotdoc">
	<h3>Hình ảnh hoạt động</h3>
	<div id="hinhanh">
		<ul>
		<?php 
			if (count($arrGallerytList) > 0) {
				foreach ($arrGallerytList as $key=>$val) {
					$val = $blockView->cmsReplaceString($val);
					$gallery_id = $val['id'];
					$gallery_name = $val['gallery_name'];
					$cover_image = FILES_URL . '/gallery/cover-images/medium/' . $val['cover_image'];
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
				<li>
                	<img src="<?php echo $cover_image; ?>" />                
                    <p><?php echo $gallery_name; ?></p>
                    <a class="xemthem" href="<?php echo $gallery_link; ?>" title="xem thêm">
                    	<img src="<?php echo $blockView->imgUrl; ?>/templates/xemthem.png">
                    </a>
				</li>
		<?php 
				}
			}
		?>
		</ul>
	</div>
</div>