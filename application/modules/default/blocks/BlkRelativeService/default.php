<?php 
        	foreach($relativeServices as $key=>$val) {
        		$val = $blockView->cmsReplaceString($val);
        		$service_id = $val['id'];
        		$service_title = $val['service_title'];
        		
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
        <li><a href="<?php echo $service_link; ?>" title="<?php echo $service_title; ?>">
        	<?php echo $service_title; ?></a>
        </li>
<?php 
	}
?>