<div class="col-md-3">
	<h3 class="top-margin">DỰ ÁN</h3>
	<div class="list-group">
	<?php
		$thisProject_Id = $blockView->thisProject_Id;
		if (!empty($projectList) && count($projectList) > 0) {
			foreach($projectList as $key=>$val) {
				$val = $blockView->cmsReplaceString($val);
				$projectId = $val['id'];
				$projectTitle = $val['project_title'];
				$filter = new Zend_Filter();
				$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
										->addFilter(new Zend_Filter_StringTrim())
										->addFilter(new Zend_Filter_Alnum(true))
										->addFilter(new Zendvn_Filter_RemoveCircumflex())
										->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
				$projectListOptions = array('module'=>'default','controller'=>'du-an','action'=>'index',
										'title'=>$multiFilter->filter($projectTitle),'id'=>$projectId);
				$project_link = $blockView->url($projectListOptions,'projectdetail');
				if ($thisProject_Id == $projectId) {
	?>
					<a href="<?php echo $project_link; ?>" class="list-group-item active">
	<?php 		} else {	?>
					<a href="<?php echo $project_link; ?>" class="list-group-item">
	<?php		} ?>
						<span class="glyphicon glyphicon-chevron-right"></span> <?php echo $projectTitle; ?>
					</a>
	<?php 
			}
		}
	?>
	</div>
</div>