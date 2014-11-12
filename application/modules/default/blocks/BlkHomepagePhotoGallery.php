<?php
class Default_Block_BlkHomepagePhotoGallery extends Zend_View_Helper_Abstract {
	
	public function blkHomepagePhotoGallery() {
		$blockView = $this->view;
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('gallery AS g',array('g.id','g.gallery_name','g.cover_image'))
					 ->where('g.publish = 1')
					 ->order('g.publish_time DESC');
		$arrGallerytList = $db->fetchAll($select);

		$imgUrl = FILES_URL . '/news/cover-images/small/';

		require_once (DEFAULT_BLOCK_PATH . '/BlkHomepagePhotoGallery/default.php');
	}
}