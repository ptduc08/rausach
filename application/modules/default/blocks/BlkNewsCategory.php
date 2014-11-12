<?php
class Default_Block_BlkNewsCategory extends Zend_View_Helper_Abstract {
	
	public function blkNewsCategory() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/news/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('news_category AS nc',array('nc.id','nc.category_name'))
					 ->where('nc.publish = 1')
					 ->order('nc.order ASC');
		$newsCategoryList = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkNewsCategory/default.php');
	}
}