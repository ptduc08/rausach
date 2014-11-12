<?php
class Default_Block_BlkOnlineSupport extends Zend_View_Helper_Abstract {
	
	public function blkOnlineSupport() {
		$blockView = $this->view;
		$imgUrl = $blockView->imgUrl;
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('pages AS p','p.page_content')
					 ->where('p.id = 53')
					 ->where('p.publish = 1')
					 ->order('p.order ASC');
		$page = $db->fetchRow($select);
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkOnlineSupport/default.php');
	}
	
}