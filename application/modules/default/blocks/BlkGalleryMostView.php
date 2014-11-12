<?php
class Default_Block_BlkGalleryMostView extends Zend_View_Helper_Abstract {
	
	public function blkGalleryMostView() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/gallery/cover-images/small/';
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('gallery AS g',array('g.id','g.gallery_name','g.description'))
					 ->where('g.publish = 1')
					 ->order('g.view_counter DESC');
		$galleryList = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkGalleryMostView/default.php');
	}
}