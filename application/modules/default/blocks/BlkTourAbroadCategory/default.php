<div class="box_cat">
	<h1 class="title_tour"><img src="/public/templates/dreamviettravel/system/images/icontitle.gif" />du lịch nước ngoài</h1>
	<ul>
		<?php
        	foreach($categoryList as $key=>$val) {
        		$val = $blockView->cmsReplaceString($val);
        		$category_name 	= $val['category_name'];
        		$category_id	= $val['id'];
        		
        		$filter = new Zend_Filter();
        		$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
        							  ->addFilter(new Zend_Filter_StringTrim())
        							  ->addFilter(new Zend_Filter_Alnum(true))
        							  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
        							  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
        			
        		$tourUrlOptions = array('module'=>'default','controller'=>'tour','action'=>'index',
        				'title'=>$multiFilter->filter($category_name),'id'=>$category_id);
        			
        		$category_link = $blockView->url($tourUrlOptions,'tour-category-router');
        	
        ?>
        <li><a href="<?php echo $category_link; ?>" title="<?php echo $category_name; ?>"><?php echo $category_name; ?></a></li>
        <?php } ?>
	</ul>
</div>