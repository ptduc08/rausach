<div id="service" class="dotngang">
	<ul id="service_show" class="multiple border_box">
    	<?php 
		foreach($serviceList as $key=>$val) {
			$val = $blockView->cmsReplaceString($val);
			$service_id = $val['id'];
			$service_title = $val['service_title'];
			$cover_image = $val['cover_image'];
			$cover_image_link = $imgUrl . $cover_image;
			
			$filter = new Zend_Filter();
			$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
								  ->addFilter(new Zend_Filter_StringTrim())
								  ->addFilter(new Zend_Filter_Alnum(true))
								  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
								  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
			 
			$serviceUrlOptions = array('module'=>'default','controller'=>'index','action'=>'dich-vu',
					'title'=>$multiFilter->filter($service_title),'id'=>$service_id);
			 
			$service_link = $blockView->url($serviceUrlOptions,'service');
		?>
		<li>
			<div class="service_box">
				<img src="<?php echo $cover_image_link; ?>" />
				<a href="<?php echo $service_link; ?>" title="<?php echo $service_title; ?>"><?php echo $service_title; ?></a>
			</div>
		</li>
		<?php } ?>
	</ul>       
</div>