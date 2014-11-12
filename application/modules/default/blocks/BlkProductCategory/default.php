     
        <ul class="nav nav-justified">
		<?php
			$thisProductCategory_Id = $blockView->thisProductCategory_Id;//echo $thisProductCategory_Id;
			if (!empty($productCategoryList)) {$dem=0;
				foreach($productCategoryList as $key=>$val) {$dem++;
					$val = $blockView->cmsReplaceString($val);
					$category_id = $val['id'];//echo $category_id.'<br>' ;
					$category_name = $val['category_name'];
				
					$filter = new Zend_Filter();
					$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
											->addFilter(new Zend_Filter_StringTrim())
											->addFilter(new Zend_Filter_Alnum(true))
											->addFilter(new Zendvn_Filter_RemoveCircumflex())
											->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
				
					$proCatUrlOptions = array('module'=>'default','controller'=>'san-pham','action'=>'index',
							'title'=>$multiFilter->filter($category_name),'category_id'=>$category_id);
				
					$category_link = $blockView->url($proCatUrlOptions,'product-category');
					if ($thisProductCategory_Id == $category_id) {
		?>		
          <li class="first active">
            <a href="<?php echo $category_link ?>" class="menu-icon-<?php echo $dem;?>"><span>&nbsp;</span><?php echo $category_name; ?></a>
          </li>
<?php } else{
	?>
	  <li>
            <a href="<?php echo $category_link ?>" class="menu-icon-<?php echo $dem;?>"><span>&nbsp;</span><?php echo $category_name; ?></a>
          </li>
	<?php
}
}
}?>
        </ul>
