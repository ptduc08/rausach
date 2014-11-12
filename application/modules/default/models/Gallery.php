<?php
class Default_Model_Gallery extends Zend_Db_Table {
	protected $_name = 'gallery';
	protected $_primary = 'id';
	
	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$ssFilter = $arrParam['ssFilter'];
		$select = $db->select()
					 ->from('gallery AS g',array('COUNT(g.id) AS total'));
	
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('g.gallery_name LIKE ?',$keywords);
				
		}
	
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot gallery khi biet id cua gallery
		if ($options['task'] == 'default-gallery-info') {
			$select = $db->select()
						 ->from('gallery AS g')
						 ->where('g.publish = 1')
						 ->where('g.id = ?',$arrParam['id'],INTEGER);
			
			$result = $db->fetchRow($select);
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'default-gallery-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						->from('gallery AS g')
						->where('g.publish = 1')
						->order('g.publish_time DESC')
						->group('g.id');
			
			
			//----- neu co thong so sap xep thi bo sung order de sap xep
			//if (!empty($ssFilter['col']) && !empty($ssFilter['col'])) {
			//	$select->order($ssFilter['col'] .' ' . $ssFilter['order']);
			//}
			
			//----- neu co thong so phan trang thi bo sung limitPage cho select
			if ($paginator['itemCountPerPage'] > 0) {
				$currentPage = $paginator['currentPage'];
				//$itemCountPerPage = $paginator['itemCountPerPage'];
				$itemCountPerPage = 9;
				$select->limitPage($currentPage, $itemCountPerPage);
			}
			
			//----- neu co tu khoa tim kiem thi bo sung where cho select
			if (!empty($ssFilter['keywords'])) {
				$keywords = '%' .$ssFilter['keywords'] . '%';
				$select->where('g.gallery_name LIKE ?',$keywords);
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