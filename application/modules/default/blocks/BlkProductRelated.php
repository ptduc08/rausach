<?php
class Default_Block_BlkProductRelated extends Zend_View_Helper_Abstract {
	
	public function blkProductRelated($product_id = 0, $product_category_id = 0) {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/products/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('products AS p',array('p.id','p.product_name','p.cover_image','p.price'))
					 ->where('p.publish = 1')
					 ->where('p.product_category_id = ?',$product_category_id,INTEGER)
					 ->where('p.id != ?',$product_id,INTEGER)
					 ->order('p.order ASC')
					 ->limit(4);
		$productList = $db->fetchAll($select);
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkProductRelated/default.php');
	}
}