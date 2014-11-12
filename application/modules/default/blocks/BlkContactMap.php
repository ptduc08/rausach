<?php
class Default_Block_BlkContactMap extends Zend_View_Helper_Abstract {
	
	public function blkContactMap() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/news/cover-images/small/';
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkContactMap/default.php');
	}
}