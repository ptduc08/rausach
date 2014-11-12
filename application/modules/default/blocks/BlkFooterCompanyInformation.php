<?php
class Default_Block_BlkFooterCompanyInformation extends Zend_View_Helper_Abstract {
	
	public function blkFooterCompanyInformation() {
		$blockView = $this->view;
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('pages AS p',array('p.id','p.page_title','p.page_content'))
					 ->where('p.publish = 1')
					 ->where('p.id = 43');
		$pageList = $db->fetchRow($select);
		$pageList = $blockView->cmsReplaceString($pageList);
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkFooterCompanyInformation/default.php');
	}
}