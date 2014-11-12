<?php
class Default_Model_GalleryImages extends Zend_Db_Table {
	protected $_name = 'gallery_images';
	protected $_primary = 'id';
	
	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$ssFilter = $arrParam['ssFilter'];
		$select = $db->select()
					 ->from('news_article AS na',array('COUNT(na.id) AS total'));
	
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('na.article_title LIKE ?',$keywords);
				
		}
	
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot tin tuc khi biet id cua tin tuc
		if ($options['task'] == 'default-newsarticle-info') {
			$select = $db->select()
						 ->from('news_article AS na')
						 ->joinLeft('news_category_article AS nca', 'nca.article_id = na.id','nca.category_id')
						 ->where('na.id = ?',$arrParam['id'],INTEGER)
						 ->group('na.id');
			
			$result = $db->fetchRow($select);
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'default-galleryimage-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('gallery_images AS gi')
						 ->joinLeft('gallery AS g','g.id = gi.gallery_id','g.gallery_name')
						 ->where('gi.publish = 1')
						 ->where('gi.gallery_id = ?',$arrParam['gallery_id'],INTEGER)
						 ->order('gi.publish_time DESC')
						 ->group('gi.id');

			//----- neu co thong so sap xep thi bo sung order de sap xep
			//if (!empty($ssFilter['col']) && !empty($ssFilter['col'])) {
			//	$select->order($ssFilter['col'] .' ' . $ssFilter['order']);
			//}
			
			
			//----- neu co thong so phan trang thi bo sung limitPage cho select
			if ($paginator['itemCountPerPage'] > 0) {
				$currentPage = $paginator['currentPage'];
				$itemCountPerPage = $paginator['itemCountPerPage'];
				$select->limitPage($currentPage, $itemCountPerPage);
			}
			
			//----- neu co tu khoa tim kiem thi bo sung where cho select
			if (!empty($ssFilter['keywords'])) {
				$keywords = '%' .$ssFilter['keywords'] . '%';
				$select->where('gi.image_title LIKE ?',$keywords);
			}
			
			$result = $db->fetchAll($select);
			
		}
		
		return $result;
	}

	public function saveItem($arrParam = null, $options = null) {
		
		if ($options['task'] == 'default-news-article-increase-view-counter') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
				
			$row->view_counter	= $row->view_counter + 1;
			
			$row->save();
		}
	}
}