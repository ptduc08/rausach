<?php
class Default_Block_BlkProductCategory extends Zend_View_Helper_Abstract {
	
	public function blkProductCategory() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/products/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('product_category AS pc',array('pc.id','pc.category_name'))
					 ->where('pc.publish = 1')
					 ->order('pc.order ASC');
		$productCategoryList = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkProductCategory/default.php');
	}
}