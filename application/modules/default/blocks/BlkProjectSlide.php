<?php
class Default_Block_BlkProjectSlide extends Zend_View_Helper_Abstract {
	
	public function blkProjectSlide() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/projects/cover-images/medium/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('projects AS p',array('p.id','p.project_title','p.cover_image'))
					 ->where('p.publish = 1')
					 ->order('p.order ASC');
		$projectList = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkProjectSlide/default.php');
	}
}