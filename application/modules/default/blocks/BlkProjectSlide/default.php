<div id="project-slide-wrapper">
	<div id="project-slide">
		<img class="button-left" src="/public/templates/ocdc/system/images/template/project-slide-button-left.png"/>
		<img class="button-right" src="/public/templates/ocdc/system/images/template/project-slide-button-right.png"/>
	
		<ul id="project_show" class="multiple border_box">
	    	<?php 
			foreach($projectList as $key=>$val) {
				$val = $blockView->cmsReplaceString($val);
				$project_id = $val['id'];
				$project_title = $val['project_title'];
				$cover_image = $val['cover_image'];
				$cover_image_link = $imgUrl . $cover_image;
				
				$filter = new Zend_Filter();
				$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
									  ->addFilter(new Zend_Filter_StringTrim())
									  ->addFilter(new Zend_Filter_Alnum(true))
									  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
									  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
				 
				$projectUrlOptions = array('module'=>'default','controller'=>'index','action'=>'du-an-chi-tiet',
						'title'=>$multiFilter->filter($project_title),'id'=>$project_id);
				 
				$project_link = $blockView->url($projectUrlOptions,'projectdetail');
			?>
			<li>
				<div class="project_box">
					<img src="<?php echo $cover_image_link; ?>" />
					<a href="<?php echo $project_link; ?>" title="<?php echo $project_title; ?>"><?php echo $project_title; ?></a>
				</div>
			</li>
			<?php } ?>
		</ul>
	
	</div>    
</div>