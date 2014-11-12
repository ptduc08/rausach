<?php
class Default_Block_BlkHomepageCarLease extends Zend_View_Helper_Abstract {
	
	public function blkHomepageCarLease() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/services/cover-images/large/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('services AS s',array('s.id','s.service_title','s.service_brief','s.price','s.cover_image'))
					 ->joinLeft('service_category AS sc','sc.id = s.category_id', 'sc.category_name')
					 ->where('s.category_id = 19')
					 ->where('s.publish = 1')
					 ->order('s.order DESC')
					 ->limit(4,0);
		$serviceList = $db->fetchAll($select);
		
		if (count($serviceList) > 0) {
			$category_name = $serviceList[1]['category_name'];
		} else {
			$category_name = 'Thuê xe du lịch';
		}

		require_once (DEFAULT_BLOCK_PATH . '/BlkHomepageCarLease/default.php');
	}
}