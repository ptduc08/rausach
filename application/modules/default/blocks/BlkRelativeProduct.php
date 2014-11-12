<?php
class Default_Block_BlkRelativeProduct extends Zend_View_Helper_Abstract {
	
	//----- lay mot so cac product khac cung thuoc category, tru product hien tai
	//----- product_id duoc truyen vao qua tham so
	public function blkRelativeProduct($category_id = 0, $thisProduct_id = 0) {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/products/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		if ($category_id == 0) {
			$select = $db->select()
						->from('products AS p')
						->joinLeft('product_category AS pc','pc.id = p.product_category_id','pc.id AS category_id')
						->where('p.id <> ?', $thisProduct_id)
						->where('p.publish = 1')
						->order('p.publish_time DESC')
						->limit(3,0);
		} else {
			$select = $db->select()
						->from('products AS p')
						->joinLeft('product_category AS pc','pc.id = p.product_category_id','pc.id AS category_id')
						->where('p.product_category_id = ?',$category_id)
						->where('p.id <> ?', $thisProduct_id)
						->where('p.publish = 1')
						->order('p.publish_time DESC')
						->limit(3,0);
		}
		
		$relativeProducts = $db->fetchAll($select);
		//var_dump($relativeProducts);
		require_once (DEFAULT_BLOCK_PATH . '/BlkRelativeProduct/default.php');
	}
}