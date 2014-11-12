<div class="dulich _left">
	<h1 class="title_tour">
		<img src="/public/templates/dreamviettravel/system/images/icontitle.gif" /><?php echo $category_name; ?>
	</h1>
        <?php 
        	foreach($serviceList as $key=>$val) {
        		$val = $blockView->cmsReplaceString($val);
        		$service_id = $val['id'];
        		$service_title = $val['service_title'];
        		$category_name = $val['category_name'];
        		$service_price = $val['price'];
        		$cover_image = $val['cover_image'];
        		$cover_image_link = $imgUrl . $cover_image;
        		
        		$filter = new Zend_Filter();
        		$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
        							  ->addFilter(new Zend_Filter_StringTrim())
        							  ->addFilter(new Zend_Filter_Alnum(true))
        							  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
        							  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
        			
        		$serviceUrlOptions = array('module'=>'default','controller'=>'dich-vu','action'=>'dich-vu-chi-tiet',
        				'title'=>$multiFilter->filter($service_title),'id'=>$service_id);
        			
        		$service_link = $blockView->url($serviceUrlOptions,'service');
        	
        ?>
        
        <div class="box_tour boxthuexe _left">
        	<a href="<?php echo $service_link; ?>" title=""><img src="<?php echo $cover_image_link; ?>" alt="Dịch vụ du lịch" /></a>
            <h2><a href="<?php echo $service_link; ?>" title=""><?php echo $service_title; ?></a></h2>
            <p>Giá từ: <span class="price"><?php echo $service_price; ?></span></p>
        </div>
        
        <?php 
        	}
        ?>
</div>