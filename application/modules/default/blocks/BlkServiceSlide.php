<?php
class Default_Block_BlkServiceSlide extends Zend_View_Helper_Abstract {
	
	public function blkServiceSlide() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/services/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('services AS s',array('s.id','s.service_title','s.cover_image'))
					 ->where('s.publish = 1')
					 ->order('s.order ASC');
		$serviceList = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkServiceSlide/default.php');
	}
}