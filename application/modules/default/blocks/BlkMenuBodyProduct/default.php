<div class="col-lg-12 col-md-12 col-sm-6">
	<div class="no-padding">
		<span class="title"><br>
		</span>
	</div>
	<?php
	//var_dump($MenuProduct);
	// $slbProCat = $this->recursive($MenuProduct,0,1,$new_arr);
	//var_dump($new_arr);//die;
	$dem=0;
	foreach ($MenuBodyProduct as $key => $value) {
		$dem++;
		$category_id = $value['id'];//echo $category_id.'<br>' ;
		$category_name = $value['category_name'];
		$filter = new Zend_Filter();
		$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
		->addFilter(new Zend_Filter_StringTrim())
		->addFilter(new Zend_Filter_Alnum(true))
		->addFilter(new Zendvn_Filter_RemoveCircumflex())
		->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
		$proCatUrlOptions = array('module'=>'default','controller'=>'san-pham','action'=>'index',
				'title'=>$multiFilter->filter($category_name),'category_id'=>$category_id);
		//$category_link = $blockView->url($proCatUrlOptions,'product-category');
		$category_link = $blockView->baseUrl('san-pham/index/category_id/'.$category_id);
    if(($dem%3)==1){?>
	<div class="list-group list-categ">
		<a href="<?php echo $category_link?>" class="list-group-item"> <?php echo $category_name?>
		</a>
		<?php
    }
    if(($dem%3)==2){?>
		<a href="<?php echo $category_link?>" class="list-group-item"> <?php echo $category_name?>
		</a>
		<?php
    }
    if(($dem%3)==0){?>
		<a href="<?php echo $category_link?>" class="list-group-item"> <?php echo $category_name?>
		</a>
	</div>
	<?php
    }
	} //end foreach
    if(($dem%3)!=0){?>
</div>
<?php
    }
    ?>
<!-- Categories -->


</div>
<!-- End Categories -->
