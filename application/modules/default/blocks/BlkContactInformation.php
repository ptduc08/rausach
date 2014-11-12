<?php
class Default_Block_BlkContactInformation extends Zend_View_Helper_Abstract {
	public function blkContactInformation() {
		$blockView = $this->view;
		$db = Zend_Registry::get('connectDb');
		$select = $db->select()
					->from('pages AS p',array('p.id','p.page_title','p.page_content'))
					->where('p.publish = 1')
					->where('p.id = 42');
		$pageList = $db->fetchRow($select);
		$pageList = $blockView->cmsReplaceString($pageList);
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkContactInformation/default.php');
	}
}