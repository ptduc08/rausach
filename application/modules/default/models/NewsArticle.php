<?php
class Default_Model_NewsArticle extends Zend_Db_Table {
	protected $_name = 'news_article';
	protected $_primary = 'id';
	
	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$ssFilter = $arrParam['ssFilter'];
		$result = 0;
		$select = $db->select()
					 ->from('news_article AS na',array('COUNT(na.id) AS total'));
	
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('na.article_title LIKE ?',$keywords);
				
		}
		$result = $db->fetchOne($select);
		
		//----- dem tat ca phan tu nam trong mot nhanh cua mot category nao do
		if ($options['task'] == 'count-item-in-ancestor-category') {
			//----- lay danh sach tat ca News Category
			$tblNewsCat = new Default_Model_NewsCategory();
			$allNewsCategory = $tblNewsCat->listItem(array(), array('task'=>'default-newscategory-list-all'));
		
			$subCategoryList = array();
			$objRecursive = new Zendvn_System_Recursive();
			if (!isset($arrParam['ancestorCategoryID'])) {
				$ancestorCategoryID = 0;
			} else {
				$ancestorCategoryID = $arrParam['ancestorCategoryID'];
			}
			$objRecursive->getAllSubCategoryId($allNewsCategory, $ancestorCategoryID, $subCategoryList);
				
			$select = $db->select()
						 ->from('news_category_article AS nca',array('COUNT(nca.id) AS total'))
						 ->where('nca.category_id IN (?)',$subCategoryList);
		
			$result = $db->fetchOne($select);
		}
		
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
						 ->joinLeft('news_category AS nc','nca.category_id = nc.id','nc.category_name')
						 ->where('na.publish = 1')
						 ->where('na.id = ?',$arrParam['id'],INTEGER)
						 ->group('na.id');
			
			$result = $db->fetchRow($select);
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'default-newsarticle-list-all') {
			$select = $db->select()
						  ->from('news_article AS na');
		
			$result = $db->fetchAll($select);
		}
		
		if ($options['task'] == 'default-newsarticle-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('news_article AS na')
						 ->joinLeft('news_category_article AS nca', 'na.id = nca.article_id','nca.category_id')
						 ->joinLeft('news_category AS nc','nca.category_id = nc.id','nc.category_name')
						 ->where('na.publish = 1')
						 ->order('na.publish_time DESC')
						 ->group('na.id');

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
				$select->where('na.article_title LIKE ?',$keywords);
			}
			
			$result = $db->fetchAll($select);
			
		}
		
		if ($options['task'] == 'default-newsarticle-list-filter-to-category') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			
			//----- lay danh sach tat ca category
			$tblNewsCat = new Default_Model_NewsCategory();
			$allNewsCategory = $tblNewsCat->listItem(array(), array('task'=>'default-newscategory-list-all'));

			//----- lay danh sach tat ca sub category cua mot category nao do, dua vao mang $subCategoryList
			$subCategoryList = array();
			$objRecursive = new Zendvn_System_Recursive();
			if (!isset($arrParam['ancestorCategoryID'])) {
				$ancestorCategoryID = 0;
			} else {
				$ancestorCategoryID = $arrParam['ancestorCategoryID'];
			}
			$objRecursive->getAllSubCategoryId($allNewsCategory, $ancestorCategoryID, $subCategoryList);
			
			//----- lay tat ca news article thuoc danh sach category nao do
			//----- dua vao mang $articleList
			$select = $db->select()
						 ->from('news_category_article AS nca','nca.article_id AS id')
						 ->where('nca.category_id IN (?)',$subCategoryList);
			$articleList = array();
			$articleList = $db->fetchAll($select);
			
			//----- neu danh sach $articleList tra ve co phan tu thi lay thong tin cua cac article 
			//----- co id nam trong mang $articleList. Neu mang khong co phan tu nao thi khong duoc select
			//----- where('na.id IN (?)',$articleList) neu khong se gay ra loi
			if (count($articleList) > 0) {
				$select = $db->select()
							 ->from('news_article AS na')
							 ->joinLeft('news_category_article AS nca', 'na.id = nca.article_id','nca.category_id AS category_id')
							 ->joinLeft('news_category AS nc','nca.category_id = nc.id','nc.category_name')
							 ->group('na.id')
							 ->where('na.publish = 1')
							 ->where('na.id IN (?)',$articleList);
			} else {
				$select = $db->select()
							 ->from('news_article AS na')
							 ->where('na.id = ?',0,INTEGER);
			}
			//----- neu co thong so sap xep thi bo sung order de sap xep
			if (!empty($ssFilter['col']) && !empty($ssFilter['col'])) {
				$select->order($ssFilter['col'] .' ' . $ssFilter['order']);
			}
		
		
			//----- neu co thong so phan trang thi bo sung limitPage cho select
			if ($paginator['itemCountPerPage'] > 0) {
				$currentPage = $paginator['currentPage'];
				$itemCountPerPage = $paginator['itemCountPerPage'];
				$select->limitPage($currentPage, $itemCountPerPage);
			}
		
			//----- neu co tu khoa tim kiem thi bo sung where cho select
			if (!empty($ssFilter['keywords'])) {
				$keywords = '%' .$ssFilter['keywords'] . '%';
				$select->where('na.article_title LIKE ?',$keywords);
			}
		
			//----- neu co thong so loc theo category_id thi bo sung where cho select
			/* if ($ssFilter['category_id'] > 0) {
			 $select->where('t.category_id = ?',$ssFilter['category_id'],INTEGER);
			} */
				
			
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