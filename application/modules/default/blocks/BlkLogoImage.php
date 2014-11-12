<?php
class Default_Block_BlkLogoImage extends Zend_View_Helper_Abstract {
	
	public function blkLogoImage() {
		$blockView = $this->view;
		
		$thisPage = $blockView->Item;
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkLogoImage/default.php');
	}
}