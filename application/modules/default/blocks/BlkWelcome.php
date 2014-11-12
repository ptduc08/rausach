<?php
class Default_Block_BlkWelcome extends Zend_View_Helper_Abstract {
	
	public function blkWelcome() {
		$blockView = $this->view;
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('pages AS p',array('p.id','p.page_title','p.page_brief','p.cover_image'))
					 ->where('p.id = 37');
		$pageWelcome = $db->fetchRow($select);
		$pageWelcome = $blockView->cmsReplaceString($pageWelcome);
		$page_id 	= $pageWelcome['id'];
		$page_title = $pageWelcome['page_title'];
		$page_brief = $pageWelcome['page_brief'];
		$cover_image = $pageWelcome['cover_image'];
		$cover_image = FILES_URL . '/pages/cover-images/medium/' . $cover_image;
		
		$filter = new Zend_Filter();
		$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
							  ->addFilter(new Zend_Filter_StringTrim())
							  ->addFilter(new Zend_Filter_Alnum(true))
							  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
							  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
		
		$pageUrlOptions = array('module'=>'default','controller'=>'index','action'=>'gioi-thieu',
								   'title'=>$multiFilter->filter($page_title),'id'=>$page_id);
		
		//$page_link = $blockView->url($pageUrlOptions,'page');
		$page_link = $blockView->baseUrl('/default/index/gioi-thieu');
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkWelcome/default.php');
	}
}