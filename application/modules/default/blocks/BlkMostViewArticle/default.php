<h3>Tin xem nhiều nhất</h3>
<hr/>
<?php
	if (!empty($newestArticles)) {
		foreach($newestArticles as $key=>$val) {
			$val = $blockView->cmsReplaceString($val);
			$article_id = $val['id'];
			$category_id = $val['category_id'];
			$article_title = $val['article_title'];
			//$publish_time = $val['publish_time'];
			//----- chuyen publish_time tu dang Y-m-d sang d-m-Y de hien thi ra view
			//$publish_time = date('d-m-Y',strtotime($val['publish_time']));
			$cover_image = FILES_URL . '/news/cover-images/medium/' .$val['cover_image'];
			
			$filter = new Zend_Filter();
			$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
								  ->addFilter(new Zend_Filter_StringTrim())
								  ->addFilter(new Zend_Filter_Alnum(true))
								  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
								  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
				
			$articleUrlOptions = array('module'=>'default','controller'=>'index','action'=>'tin-tuc-chi-tiet',
					'title'=>$multiFilter->filter($article_title),'id'=>$article_id,'category_id'=>$category_id);
				
			$article_link = $blockView->url($articleUrlOptions,'news-detail');
?>
<div class="row">
	<div class="col-md-12">
		<img src="<?php echo $cover_image; ?>" alt="cnt tin tuc" class="img-thumbnail news-thumb"/>
		<a href="<?php echo $article_link; ?>"><?php echo $article_title; ?></a>
	</div>
</div>
<?php 
		}
	}
?>