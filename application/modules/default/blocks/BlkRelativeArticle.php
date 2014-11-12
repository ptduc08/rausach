<?php
class Default_Block_BlkRelativeArticle extends Zend_View_Helper_Abstract {
	
	//----- lay mot so cac tin tuc khac cung thuoc category, tru tin hien tai
	//----- category_id duoc truyen vao qua tham so
	public function blkRelativeArticle($category_id = 0, $thisArticle_id = 0) {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/news/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
					 ->from('news_category_article AS nca', array('nca.article_id','nca.category_id'))
					 ->joinLeft('news_article AS na','na.id = nca.article_id',array('na.id','na.article_title','na.cover_image','na.created_time'))
					 //->where('nca.category_id = ?',$category_id)
					 ->where('nca.article_id <> ?', $thisArticle_id)
					 ->where('na.publish = 1')
					  
					 ->order('na.publish_time DESC')
					->group('nca.article_id')
					 ->limit(3,0);
		$relativeArticles = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkRelativeArticle/default.php');
	}
}