<div id="tabbed_hapdan"  class="tabbed">
            	
	<?php 
		foreach($mostViewTourList as $key=>$val) {
			$val = $blockView->cmsReplaceString($val);
			$tour_id = $val['id'];
			$tour_title = $val['title'];
			$tour_brief = $val['brief'];
			$cover_image = $val['cover_image'];
			$cover_image_link = $imgUrl . $cover_image;
			
			$filter = new Zend_Filter();
			$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
								  ->addFilter(new Zend_Filter_StringTrim())
								  ->addFilter(new Zend_Filter_Alnum(true))
								  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
								  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
			
			$tourUrlOptions = array('module'=>'default','controller'=>'tour','action'=>'tour-chi-tiet',
					'title'=>$multiFilter->filter($tour_title),'id'=>$tour_id);
				
			$tour_link = $blockView->url($tourUrlOptions,'tour-router');
	?>
    
	<div class="box_new">
                <a href="<?php echo $tour_link; ?>" title=""><img class="_left" src="<?php echo $cover_image_link; ?>" alt="Tour du lịch" /></a>
                <h2><a href="<?php echo $tour_link; ?>" title=""><?php echo $tour_title; ?></a></h2>
                <p><?php echo $tour_brief; ?></p>
                <div class="clear"></div>
            </div>
	
	<?php 
		}
	?>
</div>