          
            <h4>
              Danh mục
            </h4>
            <ul class="list-cat">
	<?php
		$order = 0;
		if (!empty($pageList)) {
			foreach($pageList as $key=>$val) {
				//var_dump($val);
				$val = $blockView->cmsReplaceString($val);
				$order		= $order + 1;
				$page_id 	= $val['id'];
				$page_title = $val['page_title'];
				$page_brief = $val['page_brief'];
				$cover_image = $val['cover_image'];
				$cover_image = FILES_URL . '/pages/cover-images/medium/' . $cover_image;
				
				$filter = new Zend_Filter();
				$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
									  ->addFilter(new Zend_Filter_StringTrim())
									  ->addFilter(new Zend_Filter_Alnum(true))
									  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
									  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
				
				$pageUrlOptions = array('module'=>'default','controller'=>'index','action'=>'gioi-thieu',
									    'title'=>$multiFilter->filter($page_title),'id'=>$page_id);
				
				$page_link = $blockView->url($pageUrlOptions,'page');
				if ($page_id == $thisPage_Id) {
	?>				
              <li class="first active"><a href="<?php echo $page_link; ?>"> <?php echo $page_title; ?></a></li>
     	<?php 
			}
			else{
				?>
				<li><a href="<?php echo $page_link; ?>"> <?php echo $page_title; ?></a></li>
				<?php
			}
		}
	}
	?>         
            </ul>


            

           