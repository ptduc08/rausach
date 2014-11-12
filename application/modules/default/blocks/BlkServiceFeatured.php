<?php
class Default_Block_BlkServiceFeatured extends Zend_View_Helper_Abstract {
	
	public function blkServiceFeatured() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/services/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('services AS s',array('s.id','s.service_title','s.service_brief','s.cover_image',))
					 ->where('s.publish = 1')
					 ->where('s.featured_service = 1')
					 ->order('s.order ASC');
		$serviceList = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkServiceFeatured/default.php');
	}
}