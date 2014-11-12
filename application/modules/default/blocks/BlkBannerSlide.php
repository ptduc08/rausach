<?php
class Default_Block_BlkBannerSlide extends Zend_View_Helper_Abstract {
	
	public function blkBannerSlide() {
		$blockView = $this->view;
		
		$thisPage = $blockView->Item;
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkBannerSlide/default.php');
	}
}