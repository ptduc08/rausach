<div class="dulich _left">
	<h1 class="title_tour"><img src="/public/templates/dreamviettravel/system/images/icontitle.gif" />chương trình du lịch trong nước</h1>
		<?php 
			$i = 0;
        	foreach($tourList as $key=>$val) {
        		$i = $i + 1;
        		$val = $blockView->cmsReplaceString($val);
        		$category_name = $val['category_name'];
        		$tour_id = $val['id'];
        		$tour_title = $val['title'];
        		$tour_duration = $val['duration'];
        		$tour_price = $val['price'];
        		$tour_starttime = $val['start_time'];
        		$tour_path = $val['tour_path'];
        		
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
        
	    	<div class="box_tour _left">
	        	<a href="<?php echo $tour_link; ?>" title=""><img src="<?php echo $cover_image_link; ?>" alt="du lich" /></a>
	            <h2>
	            	<a href="<?php echo $tour_link; ?>" title=""><?php echo $tour_title; ?></a>
	            </h2>
	            <p>Thời gian: <?php echo $tour_starttime; ?></p>
	            <p>Giá từ: <span class="price"><?php echo $tour_price; ?></span></p>
	            <p>Lịch trình: <?php echo $tour_path; ?></p>
        	</div>
        	<?php if ($i % 2 == 0) { ?>
        	<div class="clear"></div>
        	<?php } ?>
        <?php 
        	}
        ?>
        
        
</div>