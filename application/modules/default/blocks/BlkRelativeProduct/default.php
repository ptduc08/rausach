         
		  
            <h4 class="text-uppercase">
              Sản phẩm tương tự
            </h4>
<?php
	if(!empty($relativeProducts)) {
		$dem=0;
		foreach($relativeProducts as $key=>$val) {
			$dem++;
			$val = $blockView->cmsReplaceString($val);
			//var_dump($val);
			$product_id = $val['id'];
			$product_name = $val['product_name'];
			$category_id = $val['category_id'];
			$price = $val['price'];
			$cover_image = FILES_URL . '/products/cover-images/medium/' . $val['cover_image'];
		
			$filter = new Zend_Filter();
			$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
									->addFilter(new Zend_Filter_StringTrim())
									->addFilter(new Zend_Filter_Alnum(true))
									->addFilter(new Zendvn_Filter_RemoveCircumflex())
									->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
			 
			$productUrlOptions = array('module'=>'default','controller'=>'san-pham','action'=>'san-pham-chi-tiet',
					'title'=>$multiFilter->filter($product_name),'id'=>$product_id,'category_id'=>$category_id);
			 
			$product_link = $blockView->url($productUrlOptions,'product-detail');	
?>

            <?php if($dem!=1){ ?>
            <hr/>
            <?php } ?>
            <div class="item">
              <a href="<?php echo $product_link ?>">
                <div class="item-img"><img src="<?php echo $cover_image; ?>" class="img-responsive" alt=""></div>
              </a>
              <div class="item-details">
                <span class="item-title"><?php echo $product_name; ?></span>
                <span class="item-price"><?php echo $price; ?></span>
              </div>
            </div>
<?php 
		}
	}	
?>

