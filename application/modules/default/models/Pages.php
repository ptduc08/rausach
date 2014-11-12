<?php
class Default_Model_Pages extends Zend_Db_Table {
	protected $_name = 'pages';
	protected $_primary = 'id';
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot trang khi biet id cua trang
		if ($options['task'] == 'default-page-info') {
			$select = $db->select()
						 ->from('pages AS p')
						 ->where('p.publish = 1')
						 ->where('p.id = ?',$arrParam['id'],INTEGER);
			
			$result = $db->fetchRow($select);
		}
		
		if ($options['task'] == 'default-get-introduce-page') {
			$select = $db->select()
						 ->from('pages AS p')
						 ->where('p.publish = 1')
						 ->where('p.id = ?', $arrParam['id'],INTEGER);
			$result = $db->fetchRow($select);
		}
		
		//----- lay ten cover_image cua page dang bi xoa de xoa cover_image
		if ($options['task'] == 'admin-get-deleting-page-coverimage') {
			$db = Zend_Registry::get('connectDb');
			$select = $db->select()
						 ->from('pages AS p',array('p.cover_image'))
						 ->where('p.id = ?',$arrParam['id'],INTEGER);
			$result = $db->fetchOne($select);
		}
		
		//----- lay order lon nhat trong bang pages
		if ($options['task'] == 'admin-get-biggest-page-order') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('pages AS p','p.order')
						 ->order('p.order DESC');
			$result = $db->fetchOne($select);
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'admin-page-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('pages AS p');

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
				$select->where('na.page_title LIKE ?',$keywords);
			}
			
			$result = $db->fetchAll($select);
			
		}
		
		//----- lay danh sach cac page co id nam trong mot mang (mang $arrParam['cid'])
		if ($options['task'] == 'admin-page-list-from-array') {
			$cid = $arrParam['cid'];
			$select = $db->select()
						 ->from('pages AS p',array('p.id','p.page_title','p.cover_image','p.lock_status'))
						 ->where('p.id IN (?)',$cid);
			$result = $db->fetchAll($select);
		}
		
		//----- lay id va category_name cua tat ca cac nhom tin tuc (phuc vu cho selectbox)
		if ($options['task'] == 'admin-newscategory-list-selectbox') {
			$select = $db->select()
						 ->from('news_category',array('id','category_name'));
			$result = $db->fetchPairs($select);
			$result[0] = '-- Select a Category --';
			//----- sap xep lai mang $result theo khoa
			ksort($result);
		}
		
		//----- lay id va category_name cua cac nhom tin tuc, tru nhom tin tuc hien tai (phuc vu cho selectbox)
		if ($options['task'] == 'admin-newscategory-list-selectbox-parent-category') {
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
		if ($options['task'] == 'admin-newsarticle-list-category') {
			$article_id = $arrParam['article_id'];
			$select = $db->select()
						 ->from('news_category_article AS nca','nca.category_id')
						 ->joinLeft('news_category AS nc', 'nc.id = nca.category_id','nc.category_name')
						 ->where('nca.article_id = ?', $article_id, INTEGER);
			$result = $db->fetchAll($select);
		}
		
		//----- lay danh sach cac category ID cua mot tin tuc, khi biet id cua tin tuc do
		if ($options['task'] == 'admin-newsarticle-list-category-only-id') {
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
	
}