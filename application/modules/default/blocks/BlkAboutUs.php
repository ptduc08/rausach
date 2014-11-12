<?php
class Default_Block_BlkAboutUs extends Zend_View_Helper_Abstract {
	
	public function blkAboutUs() {
		$blockView = $this->view;
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('pages AS p',array('p.id','p.page_title','p.page_brief','p.cover_image'))
					 ->where('p.id NOT IN (43,51)')
					 ->where('p.publish = 1')
					 ->order('p.order ASC');
		$pageList = $db->fetchAll($select);
		
		$thisPage = $blockView->Item;
		$thisPage_Id = $thisPage['id'];
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkAboutUs/default.php');
	}
}