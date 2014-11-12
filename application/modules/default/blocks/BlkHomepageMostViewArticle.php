<?php
class Default_Block_BlkHomepageMostViewArticle extends Zend_View_Helper_Abstract {
	
	public function blkHomepageMostViewArticle() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/news/cover-images/medium/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('news_article AS na',array('na.id','na.article_title','na.article_brief','na.cover_image'))
					 ->joinLeft('news_category_article AS nca','nca.article_id = na.id','nca.category_id')
					 ->where('nca.category_id = 17')
					 ->where('na.publish = 1')
					 ->order('na.view_counter DESC')
					 ->order('na.order DESC')
					 ->limit(4,0);
		$mostViewArticleList = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkHomepageMostViewArticle/default.php');
	}
}