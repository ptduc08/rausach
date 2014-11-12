<h4><span class="label label-primary">Các dự án khác</span></h4>
<ul class="other-news">
<?php
	if (!empty($relativeProjects)) {
		foreach($relativeProjects as $key=>$val) {
			$val = $blockView->cmsReplaceString($val);
			$project_id = $val['id'];
			$project_title = $val['project_title'];
		
			$filter = new Zend_Filter();
			$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
									->addFilter(new Zend_Filter_StringTrim())
									->addFilter(new Zend_Filter_Alnum(true))
									->addFilter(new Zendvn_Filter_RemoveCircumflex())
									->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
			 
			$projectUrlOptions = array('module'=>'default','controller'=>'du-an','action'=>'du-an-chi-tiet',
					'title'=>$multiFilter->filter($project_title),'id'=>$project_id);
			 
			$project_link = $blockView->url($projectUrlOptions,'projectdetail');
?>
				<li><span class="glyphicon glyphicon-chevron-right"></span>
				<a href="<?php echo $project_link; ?>"><?php echo $project_title; ?></a></li>
<?php 
		}
	}
?>

</ul>