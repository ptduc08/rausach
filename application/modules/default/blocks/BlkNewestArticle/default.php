<div class="box-right">
	<div class="tittle-box-right"><strong>TIN MỚI NHẤT</strong></div>
	<div class="content-right-news">
	
		<?php
		foreach($newestArticles as $key=>$val) {
			$val = $blockView->cmsReplaceString($val);
			$article_id = $val['id'];
			$article_title = $val['article_title'];
			//$publish_time = $val['publish_time'];
			//----- chuyen publish_time tu dang Y-m-d sang d-m-Y de hien thi ra view
			$publish_time = date('d-m-Y',strtotime($val['publish_time']));
			$cover_image = $val['cover_image'];
			$cover_image_link = $imgUrl . $cover_image;
		
			$filter = new Zend_Filter();
			$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
								  ->addFilter(new Zend_Filter_StringTrim())
								  ->addFilter(new Zend_Filter_Alnum(true))
								  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
								  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
			 
			$articleUrlOptions = array('module'=>'default','controller'=>'index','action'=>'tin-tuc-chi-tiet',
					'title'=>$multiFilter->filter($article_title),'id'=>$article_id);
			 
			//$article_link = $blockView->url($articleUrlOptions,'news-router');
			$article_link = "/";
		?>
	
		<ul>
			<li>
				<a href="<?php echo $article_link; ?>">
					<img src="<?php echo $cover_image_link; ?>" />
					<?php echo $article_title; ?>
				</a>
			</li>
		</ul>
		<?php } ?>
	</div>              
</div>