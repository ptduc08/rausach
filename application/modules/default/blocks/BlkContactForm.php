<?php
class Default_Block_BlkContactForm extends Zend_View_Helper_Abstract {
	
	public function blkContactForm() {
		$blockView = $this->view;
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkContactForm/default.php');
	}
}