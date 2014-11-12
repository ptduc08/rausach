                                
	
            <h4>
              Tin liên quan
            </h4>

	<?php
		if(!empty($relativeArticles)) {
			
			foreach($relativeArticles as $key=>$val) {
				//var_dump($val);
				 $dem=0;
				  $dem++;
				$val = $blockView->cmsReplaceString($val);
				$article_id = $val['id'];
				$category_id = $val['category_id'];
				$article_title = $val['article_title'];
				$created_time = date('d/m/Y',strtotime($val['created_time']));
				$cover_image = FILES_URL . '/news/cover-images/small/' . $val['cover_image'];
				$filter = new Zend_Filter();
				$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
				->addFilter(new Zend_Filter_StringTrim())
				->addFilter(new Zend_Filter_Alnum(true))
				->addFilter(new Zendvn_Filter_RemoveCircumflex())
				->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
				 
				$articleUrlOptions = array('module'=>'default','controller'=>'tin-tuc','action'=>'tin-tuc-chi-tiet',
						'title'=>$multiFilter->filter($article_title),'id'=>$article_id,'category_id'=>$category_id);
				 
				$article_link = $blockView->url($articleUrlOptions,'news-detail');	

	?>
	 <?php if($dem!=1){ ?>
            <hr/>
            <?php } ?>
            <div class="item">
              <div class="item-details">
	                <a href="<?php echo $article_link ; ?>">
                  <div class="item-img"><img src="<?php echo $cover_image ; ?>" class="img-responsive" alt=""></div>
                </a>
                <div>
                  <a href="<?php echo $article_link; ?>"><span class="item-title"><?php echo $article_title; ?></span></a><br />
                  <span class="item-date"><?php echo $created_time; ?> &nbsp; </span>
                </div>

	         </div>
            </div>
	<?php 
			}
		} else {
	?>
	<div class="alert alert-danger">Không có tin tức nào thuộc mục này!</div>
	<?php 
		}
	?>
              

                            