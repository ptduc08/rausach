<?php
class Default_Block_BlkRelativeService extends Zend_View_Helper_Abstract {
	
	//----- lay mot so cac service khac cung thuoc category, tru service hien tai
	//----- category_id duoc truyen vao qua tham so
	public function blkRelativeService($category_id = 0, $thisService_id = 0) {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/services/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('services AS s')					 
					 //->where('s.category_id = ?',$category_id)
					 ->where('s.id <> ?', $thisService_id)
					 ->where('s.publish = 1')
					 ->order('s.publish_time DESC')
					 ->limit(5,0);
		$relativeServices = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkRelativeService/default.php');
	}
}