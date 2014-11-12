<?php
class Default_Model_Tour extends Zend_Db_Table {
	protected $_name = 'tour';
	protected $_primary = 'id';
	
	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$ssFilter = $arrParam['ssFilter'];
		$select = $db->select()
					->from('tour AS t',array('COUNT(t.id) AS total'));
		
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('t.title LIKE ?',$keywords);
			
		}
		$result = $db->fetchOne($select);
		
		//----- dem tat ca phan tu nam trong mot nhanh cua mot category nao do
		if ($options['task'] == 'count-item-in-ancestor-category') {
			//----- lay danh sach tat ca tour category
			$tblTourCat = new Default_Model_TourCategory();
			$allTourCategory = $tblTourCat->listItem(array(), array('task'=>'default-tourcategory-list-all'));
				
			$subCategoryList = array();
			$objRecursive = new Zendvn_System_Recursive();
			if (!isset($arrParam['ancestorCategoryID'])) {
				$ancestorCategoryID = 0;
			} else {
				$ancestorCategoryID = $arrParam['ancestorCategoryID'];
			}
			$objRecursive->getAllSubCategoryId($allTourCategory, $ancestorCategoryID, $subCategoryList);
			
			$select = $db->select()
						 ->from('tour AS t',array('COUNT(t.id) AS total'))
						 ->where('t.category_id IN (?)',$subCategoryList);

			$result = $db->fetchOne($select);
		}
		
		return $result;
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot nhom khi biet id cua nhom
		if ($options['task'] == 'default-tour-info') {
			$select = $db->select()
						 ->from('tour AS t')
						 ->joinLeft('tour_category AS tc', 't.category_id = tc.id','tc.category_name')
						 ->where('t.id = ?',$arrParam['id'],INTEGER);
			
			$result = $db->fetchRow($select);
		}
		
		//----- lay ten cover_image cua doi tuong dang bi xoa de xoa cover_image
		if ($options['task'] == 'admin-get-deleting-tour-coverimage') {
			$db = Zend_Registry::get('connectDb');
			$select = $db->select()
						 ->from('tour AS t',array('t.cover_image'))
						 ->where('t.id = ?',$arrParam['id'],INTEGER);
			$result = $db->fetchOne($select);
		}
		
		//----- lay order lon nhat
		if ($options['task'] == 'admin-get-biggest-tour-order') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('tour AS t','t.order')
						 ->order('t.order DESC');
			$result = $db->fetchOne($select);
		}
		
		//----- lay lock_status cua doi tuong duoc chon ------------------------------------------------------------
		if ($options['task'] == 'admin-tour-get-lock-status') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			if (isset($arrParam['cid']) && count($arrParam['cid'] > 0)) {
				//----- truong hop lay lock_status cua nhieu doi tuong
				$arrLockStatus = array();
				$arrCid = $arrParam['cid'];
				$select = $db->select()
							 ->from('tour AS t','t.lock_status')
							 ->where('t.id IN (?)',$arrCid);
				$result = $db->fetchAll($select);
		
			} else if (isset($arrParam['id'])) {
				//----- truong hop lay lock_status cua mot doi tuong
				$select = $db->select()
							 ->from('tour AS t','t.lock_status')
							 ->where('t.id = ?',$arrParam['id'],INTEGER);
				$result = $db->fetchOne($select);
			} else {
				//-----lay lock_status cua tat ca doi tuong
				$select = $db->select()
							 ->from('tour AS t','t.lock_status');
				$result = $db->fetchAll($select);
			}
		
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'default-tour-list-all') {
			$select = $db->select()
						 ->from('tour AS t')
						 ->joinLeft('tour_category AS tc','t.category_id = tc.id','tc.category_name');
				
			$result = $db->fetchAll($select);
		}
		
		if ($options['task'] == 'default-tour-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('tour AS t')
						 ->joinLeft('tour_category AS tc','t.category_id = tc.id','tc.category_name');

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
				$select->where('t.title LIKE ?',$keywords);
			}
			
			//----- neu co thong so loc theo category_id thi bo sung where cho select
			/* if ($ssFilter['category_id'] > 0) {
				$select->where('t.category_id = ?',$ssFilter['category_id'],INTEGER);
			} */
			
			$result = $db->fetchAll($select);
			
		}
		
		if ($options['task'] == 'default-tour-list-filter-to-category') {
			//----- lay danh sach tat ca tour category
			$tblTourCat = new Default_Model_TourCategory();
			$allTourCategory = $tblTourCat->listItem(array(), array('task'=>'default-tourcategory-list-all'));
			
			$subCategoryList = array();
			$objRecursive = new Zendvn_System_Recursive();
			if (!isset($arrParam['ancestorCategoryID'])) {
				$ancestorCategoryID = 0;
			} else {
				$ancestorCategoryID = $arrParam['ancestorCategoryID'];
			}
			$objRecursive->getAllSubCategoryId($allTourCategory, $ancestorCategoryID, $subCategoryList);
			
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('tour AS t')
						 ->joinLeft('tour_category AS tc','t.category_id = tc.id','tc.category_name')
						 ->where('t.category_id IN (?)',$subCategoryList);
		
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
				$select->where('t.title LIKE ?',$keywords);
			}
				
			//----- neu co thong so loc theo category_id thi bo sung where cho select
			/* if ($ssFilter['category_id'] > 0) {
			 $select->where('t.category_id = ?',$ssFilter['category_id'],INTEGER);
			} */
			
			$result = $db->fetchAll($select);
		}
		
		//----- lay danh sach cac nhom co id nam trong mot mang (mang $arrParam['cid'])
		if ($options['task'] == 'admin-tour-list-from-array') {
			$cid = $arrParam['cid'];
			$select = $db->select()
						 ->from('tour AS t',array('t.id','t.title','t.cover_image'))
						 ->where('t.id IN (?)',$cid);
			$result = $db->fetchAll($select);
		}
		
		//----- lay id va category_name cua tat ca cac nhom tin tuc (phuc vu cho selectbox)
		if ($options['task'] == 'admin-project-list-selectbox') {
			$select = $db->select()
						 ->from('news_category',array('id','category_name'));
			$result = $db->fetchPairs($select);
			$result[0] = '-- Select a Category --';
			//----- sap xep lai mang $result theo khoa
			ksort($result);
		}
		
		//----- lay id va category_name cua cac nhom tin tuc, tru nhom tin tuc hien tai (phuc vu cho selectbox)
		if ($options['task'] == 'admin-project-list-selectbox-parent-category') {
			//----- lay id cua nhom tin tuc dang duoc chon
			if (isset($arrParam['id'])) {
				$current_category_id = $arrParam['id'];
			} else {
				$current_category_id = 0;
			}
			
			$select = $db->select()
						 ->from('news_category',array('id','category_name'))
						 ->where('id != ?',$current_category_id,INTEGER);
			$result = $db->fetchPairs($select);
			$result[0] = '-- Select a Category --';
			//----- sap xep lai mang $result theo khoa
			ksort($result);
		}
		
		//----- lay danh sach cac category cua mot tin tuc, khi biet id cua tin tuc do
		if ($options['task'] == 'admin-project-list-category') {
			$article_id = $arrParam['article_id'];
			$select = $db->select()
						 ->from('news_category_article AS nca','nca.category_id')
						 ->joinLeft('news_category AS nc', 'nc.id = nca.category_id','nc.category_name')
						 ->where('nca.article_id = ?', $article_id, INTEGER);
			$result = $db->fetchAll($select);
		}
		
		//----- lay danh sach cac category ID cua mot tin tuc, khi biet id cua tin tuc do
		if ($options['task'] == 'admin-project-list-category-only-id') {
			$article_id = $arrParam['article_id'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('news_category_article AS nca','nca.category_id')
						 ->where('nca.article_id = ?', $article_id, INTEGER);
			$tmp = $db->fetchAll($select);
			$result = array();
			if (count($tmp) > 0) {
				foreach ($tmp as $key=>$val) {
					$result[] = $val['category_id'];
				}
			}
		}
		
		return $result;
	}
	
	public function publish($arrParam = null, $options = null) {
		if (isset($arrParam['cid'])) {
			$cid = $arrParam['cid'];
		} else {
			$cid = array();
		}
		
		if (count($cid) > 0) {				//----- publish cho nhieu doi tuong cung mot lan
			switch ($arrParam['type']) {
				case 'active':
					$status = 1;
					break;
				case 'inactive':
					$status = 0;
					break;
			}
			$strId = implode(',', $cid);
			$data = array('publish'=>$status);
			$where = 'id IN (' .$strId .')';
			$this->update($data, $where);
			
		}
		if (isset($arrParam['id'])) {		//----- publish cho mot doi tuong
			$id = $arrParam['id'];
			switch ($arrParam['type']) {
				case 'active':
					$status = 1;
					break;
				case 'inactive':
					$status = 0;
					break;
			}
			$data = array('publish'=>$status);
			$where = 'id = ' .$id;
			$this->update($data, $where);
			
		}
	
	}
	
	public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'default-tour-increase-view-counter') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
		
			$row->view_counter	= $row->view_counter + 1;
				
			$row->save();
		}
	}
	
	public function sortItem($arrParam = null, $options = null) {
		/* if (isset($arrParam['cid'])) {
			$cid = $arrParam['cid'];
		} else {
			$cid = array();
		} */
		
		$order = $arrParam['order'];
		if (count($order) > 0) {
			foreach ($order as $key=>$value) {
				$where = 'id = ' .$key;
				$data = array('order'=>$value);
				$this->update($data,$where);
			}
		}
		
	}
}