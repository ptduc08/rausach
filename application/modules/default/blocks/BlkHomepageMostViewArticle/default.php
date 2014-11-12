<div id="tabbed_camnang" class="tabbed">
            	
	<?php 
		foreach($mostViewArticleList as $key=>$val) {
			$val = $blockView->cmsReplaceString($val);
			$article_id = $val['id'];
			$article_title = $val['article_title'];
			$article_brief = $val['article_brief'];
			$cover_image = $val['cover_image'];
			$cover_image_link = $imgUrl . $cover_image;
			
			$filter = new Zend_Filter();
			$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
								  ->addFilter(new Zend_Filter_StringTrim())
								  ->addFilter(new Zend_Filter_Alnum(true))
								  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
								  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
			
			$articleUrlOptions = array('module'=>'default','controller'=>'tin-tuc','action'=>'tin-tuc-chi-tiet',
					'title'=>$multiFilter->filter($article_title),'id'=>$article_id);
				
			$article_link = $blockView->url($articleUrlOptions,'news-router');
	?>
    
			<div class="box_new">
                <a href="<?php echo $article_link; ?>" title=""><img class="_left" src="<?php echo $cover_image_link; ?>" alt="Cẩm nang du lịch" /></a>
                <h2><a href="<?php echo $article_link; ?>" title=""><?php echo $article_title; ?></a></h2>
                <p><?php echo $article_brief; ?></p>
                <div class="clear"></div>
            </div>
	
	<?php 
		}
	?>
</div>