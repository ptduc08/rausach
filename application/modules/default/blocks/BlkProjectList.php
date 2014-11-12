<?php
class Default_Block_BlkProjectList extends Zend_View_Helper_Abstract {
	
	public function blkProjectList() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/projects/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('projects AS p',array('p.id','p.project_title'))
					 ->where('p.publish = 1')
					 ->order('p.order ASC');
		$projectList = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkProjectList/default.php');
	}
}