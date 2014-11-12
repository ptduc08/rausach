<?php
class Default_Model_Services extends Zend_Db_Table {
	protected $_name = 'services';
	protected $_primary = 'id';
	
	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$ssFilter = $arrParam['ssFilter'];
		$select = $db->select()
					 ->from('services AS s',array('COUNT(s.id) AS total'));
	
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('s.service_title LIKE ?',$keywords);
				
		}
		$result = $db->fetchOne($select);
		
		//----- dem tat ca phan tu nam trong mot nhanh cua mot category nao do
		if ($options['task'] == 'count-item-in-ancestor-category') {
			//----- lay danh sach tat ca service category
			$tblServiceCat = new Default_Model_ServiceCategory();
			$allServiceCategory = $tblServiceCat->listItem(array(), array('task'=>'default-servicecategory-list-all'));
		
			$subCategoryList = array();
			$objRecursive = new Zendvn_System_Recursive();
			if (!isset($arrParam['ancestorCategoryID'])) {
				$ancestorCategoryID = 0;
			} else {
				$ancestorCategoryID = $arrParam['ancestorCategoryID'];
			}
			$objRecursive->getAllSubCategoryId($allServiceCategory, $ancestorCategoryID, $subCategoryList);
				
			$select = $db->select()
						 ->from('services AS s',array('COUNT(s.id) AS total'))
						 ->where('s.category_id IN (?)',$subCategoryList);
		
			$result = $db->fetchOne($select);
		}
		
		return $result;
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot service khi biet id cua service
		if ($options['task'] == 'default-service-info') {
			$select = $db->select()
						 ->from('services AS s')
						 ->joinLeft('service_category AS sc', 's.category_id = sc.id','sc.category_name')
						 ->where('s.id = ?',$arrParam['id'],INTEGER);
			
			$result = $db->fetchRow($select);
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
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
			/* if ($ssFilter['_id'] > 0) {
				$select->where('nca.category_id = ?',$ssFilter['category_id'],INTEGER);
			}
			 */
			$result = $db->fetchAll($select);
			
		}
		
		if ($options['task'] == 'default-service-list-filter-to-category') {
			//----- lay danh sach tat ca service category
			$tblServiceCat = new Default_Model_ServiceCategory();
			$allServiceCategory = $tblServiceCat->listItem(array(), array('task'=>'default-servicecategory-list-all'));
			
			$subCategoryList = array();
			$objRecursive = new Zendvn_System_Recursive();
			if (!isset($arrParam['ancestorCategoryID'])) {
				$ancestorCategoryID = 0;
			} else {
				$ancestorCategoryID = $arrParam['ancestorCategoryID'];
			}
			//----- lay danh sach cac category la con chau cua $ancestorCategoryID, dua vao mang $subCategoryList
			$objRecursive->getAllSubCategoryId($allServiceCategory, $ancestorCategoryID, $subCategoryList);
			
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('services AS s')
						 ->joinLeft('service_category AS sc','s.category_id = sc.id','sc.category_name')
						 ->where('s.category_id IN (?)',$subCategoryList);
		
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
				$select->where('s.service_title LIKE ?',$keywords);
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