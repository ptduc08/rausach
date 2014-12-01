<?php
//var_dump($MenuProduct);
$slbProCat = $this->recursive($MenuProduct,0,1,$new_arr);
//var_dump($new_arr);//die;
$current_level=1;
$previous_level=1;
$dem_level2=0;
foreach ($new_arr as $key => $value) {
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
	// $category_link = $blockView->url($proCatUrlOptions,'product-category');
	$category_link = $blockView->baseUrl('san-pham/index/category_id/'.$category_id);
	// $category_name=$value['id'].'-'.$value['category_name'].'-'.$value['parent_category_id'];
	if($value['level']==1){
		$current_level=1;
		$dem_level2_tmp=$dem_level2;
		$dem_level2=0;
	}
	if($value['level']==2){
		$current_level=2;$dem_level2++;
	}

	if($current_level==1&&$previous_level==1){
		?>
<li class="nav-dropdown"><a href="<?php echo $category_link;?>"
	class="dropdown-toggle" data-hover="dropdown"> <?php echo $category_name;?><span
		class="caret"></span>
</a>
	<ul class="dropdown-menu">

		<?php
	}
	if($current_level==1&&$previous_level==2){
      ?>
		<?php if(($dem_level2_tmp%3)!=0){?>
	</ul>
	</nav> <?php }?>
	</ul>
</li>
<li class="nav-dropdown"><a href="<?php echo $category_link;?>"
	class="dropdown-toggle" data-hover="dropdown"> <?php echo $category_name;?><span
		class="caret"></span>
</a>
	<ul class="dropdown-menu">

		<?php
    }

    if($value['level']==2&&($dem_level2%3)==1){
    ?>
		<nav class="col-lg-3 col-md-3 col-sm-6">
			<ul class="list-unstyled">
				<li><a href="<?php echo $category_link;?>"><?php echo $category_name;?>
				</a></li>
				<?php
    }
    // $a=$dem_level2%3;echo $a;
    if($value['level']==2&&(($dem_level2%3)==2)){
    ?>
				<li><a href="<?php echo $category_link;?>"><?php echo $category_name;?>
				</a></li>
				<?php
    }
     
    if($value['level']==2&&(($dem_level2%3)==0)){
    ?>
				<li><a href="<?php echo $category_link;?>"><?php echo $category_name;?>
				</a></li>
			</ul>
		</nav>
		<?php
    }
    $previous_level=$current_level;
    // if($dem_level2==3){$dem_level2=0;}

}//end for
if(($dem_level2%3)!=0){
  ?>

	</ul>
	</nav> <?php
}
?>
	</ul>
</li>
