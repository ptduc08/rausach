<?php
class Default_Block_BlkMostViewArticle extends Zend_View_Helper_Abstract {
	
	public function blkMostViewArticle() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/news/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('news_category_article AS nca', array('nca.article_id','nca.category_id'))
					 ->joinLeft('news_article AS na','na.id = nca.article_id')
					// ->from('news_article AS na',array('na.id','na.article_title','na.publish_time','na.cover_image'))
					 ->where('na.publish = 1')
					 ->order('na.view_counter DESC')
					 ->limit(5,0);
		$newestArticles = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkMostViewArticle/default.php');
	}
}