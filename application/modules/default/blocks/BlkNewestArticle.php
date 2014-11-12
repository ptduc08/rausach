<?php
class Default_Block_BlkNewestArticle extends Zend_View_Helper_Abstract {
	
	public function blkNewestArticle() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/news/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('news_article AS na',array('na.id','na.article_title','na.publish_time','na.cover_image'))
					 ->where('na.publish = 1')
					 ->order('na.publish_time DESC')
					 ->limit(8,0);
		$newestArticles = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkNewestArticle/default.php');
	}
}