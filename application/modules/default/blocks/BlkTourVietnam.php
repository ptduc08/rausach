<?php
class Default_Block_BlkTourVietnam extends Zend_View_Helper_Abstract {
	
	public function blkTourVietnam() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/tour/cover-images/large/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('tour AS t',array('t.id','t.title','t.duration','t.price','t.start_time',
					 		't.tour_path', 't.cover_image'))
					 ->joinLeft('tour_category AS tc','t.category_id = tc.id',array('tc.id as category_id','tc.category_name'))
					 ->where('t.publish = 1')
					 ->where('t.homepage = 1')
					 ->order('t.order DESC');
					 //->limit(4,0);
		$tourList = $db->fetchAll($select);
		
		$select = $db->select()
					 ->from('tour_category AS tc')
				 	 ->order('tc.id DESC');
		
		$allTourCategory = $db->fetchAll($select);
		
		$objRecursive = new Zendvn_System_Recursive();
		
		$tourList = $objRecursive->filterItemtoRootCategory($tourList, $allTourCategory, 1, 4);
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkTourVietnam/default.php');
	}
}