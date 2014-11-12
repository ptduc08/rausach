<div class="row">
	<div class="col-md-8 col-md-offset-2 service">
		<h3>Dịch vụ của chúng tôi</h3>
		<hr/>
		<div class="row">
		<?php
			if(!empty($serviceList)) {
				foreach($serviceList as $key=>$val) {
					$val = $blockView->cmsReplaceString($val);
					$service_id = $val['id'];
					$service_title = $val['service_title'];
					$service_brief = $val['service_brief'];
					$cover_image = FILES_URL . '/services/cover-images/medium/' . $val['cover_image'];
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
				<div class="col-md-4">
					<img src="<?php echo $cover_image; ?>" alt="cnt dich vu 1" class="img-thumbnail img-responsive service-thumb"/>
					<h4 class="service-heading"><a href="<?php echo $service_link; ?>"><?php echo $service_title; ?></a></h4>
					<p><?php echo $service_brief; ?></p>
				</div>
			<?php 
				}
			}
			?>
		</div>
	</div>
</div>