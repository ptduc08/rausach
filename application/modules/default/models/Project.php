<?php
class Default_Model_Project extends Zend_Db_Table {
	protected $_name = 'projects';
	protected $_primary = 'id';
	
	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$ssFilter = $arrParam['ssFilter'];
		$select = $db->select()
					 ->from('projects AS p',array('COUNT(p.id) AS total'));
	
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('p.project_title LIKE ?',$keywords);
				
		}
	
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot project khi biet id cua project
		if ($options['task'] == 'default-project-info') {
			$select = $db->select()
						 ->from('projects AS p')
						 ->where('p.publish = 1')
						 ->where('p.id = ?',$arrParam['id'],INTEGER);
			
			$result = $db->fetchRow($select);
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'default-project-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			if ($arrParam['project_category_id'] == 0) {
				$select = $db->select()
							 ->from('projects AS p')
							 ->where('p.publish = 1')
							 ->order('p.publish_time DESC')
							 ->group('p.id');
			} else {
				$select = $db->select()
							 ->from('projects AS p')
							 ->where('p.publish = 1')
							 ->where('p.project_category_id = ?',$arrParam['project_category_id'],INTEGER)
							 ->order('p.publish_time DESC')
							 ->group('p.id');
			}
			
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
				$select->where('p.project_title LIKE ?',$keywords);
			}
			
			$result = $db->fetchAll($select);
			
		}
		
		if ($options['task'] == 'default-get-three-newest-projects') {
			$select = $db->select()
						->from('projects AS p')
						->where('p.publish = 1')
						->order('p.publish_time DESC')
						->group('p.id')
						->limit(3,0);
			$result = $db->fetchAll($select);
		}
		
		return $result;
	}

	public function saveItem($arrParam = null, $options = null) {
		
		if ($options['task'] == 'default-project-increase-view-counter') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
				
			$row->view_counter	= $row->view_counter + 1;
			
			$row->save();
		}
	}
}