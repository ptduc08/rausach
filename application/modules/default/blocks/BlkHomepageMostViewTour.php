<?php
class Default_Block_BlkHomepageMostViewTour extends Zend_View_Helper_Abstract {
	
	public function blkHomepageMostViewTour() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/tour/cover-images/large/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('tour AS t',array('t.id','t.title','t.brief','t.cover_image'))
					 ->where('t.publish = 1')
					 ->order('t.view_counter DESC')
					 ->order('t.order DESC')
					 ->limit(4,0);
		$mostViewTourList = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkHomepageMostViewTour/default.php');
	}
}