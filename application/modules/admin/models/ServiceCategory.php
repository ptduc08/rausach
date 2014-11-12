<?php
class Admin_Model_ServiceCategory extends Zend_Db_Table {
	protected $_name = 'service_category';
	protected $_primary = 'id';
	
	public function changeStatus($arrParam = null, $options = null) {
		//----- truong hop thay doi thuoc tinh status
		if ($options['task'] == 'admin-newscategory-change-status') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {				//----- change status cho nhieu doi tuong
				switch ($arrParam['type']) {
					case 'active':
						$status = 1;
						break;
					case 'inactive':
						$status = 0;
						break;
				}
				$strId = implode(',', $cid);
				$data = array('status'=>$status);
				$where = 'id IN (' .$strId .')';
				$this->update($data, $where);
			}
			if (isset($arrParam['id'])) {		//----- change status cho mot doi tuong
				$id = $arrParam['id'];
				switch ($arrParam['type']) {
					case 'active':
						$status = 1;
						break;
					case 'inactive':
						$status = 0;
						break;
				}
				$data = array('status'=>$status);
				$where = 'id = ' .$id;
				$this->update($data, $where);
			}
		}
		
	}
	
	public function changeLockStatus($arrParam = null, $options = null) {
		//----- truong hop thay doi thuoc tinh status
		if ($options['task'] == 'admin-servicecategory-change-lock-status') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {				//----- change lock status cho nhieu doi tuong
				switch ($arrParam['type']) {
					case 'active':
						$lock_status = 1;
						break;
					case 'inactive':
						$lock_status = 0;
						break;
				}
				$strId = implode(',', $cid);
				$data = array('lock_status'=>$lock_status);
				$where = 'id IN (' .$strId .')';
				$this->update($data, $where);
			}
			if (isset($arrParam['id'])) {		//----- change status cho mot doi tuong
				$id = $arrParam['id'];
				switch ($arrParam['type']) {
					case 'active':
						$lock_status = 1;
						break;
					case 'inactive':
						$lock_status = 0;
						break;
				}
				$data = array('lock_status'=>$lock_status);
				$where = 'id = ' .$id;
				$this->update($data, $where);
			}
		}
	
	}
	
	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$ssFilter = $arrParam['ssFilter'];
		$select = $db->select()
					->from('service_category AS sc',array('COUNT(sc.id) AS total'));
		
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('sc.category_name LIKE ?',$keywords);
			
		}
		
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function deleteItem($arrParam = null, $options = null) {
		//----- truong hop xoa mot doi tuong
		if ($options['task'] == 'admin-servicecategory-delete') {
			$where = ' id = ' .$arrParam['id'];
			$this->delete($where);
		}
		
		//----- truong hop xoa nhieu doi tuong
		if ($options['task'] == 'admin-servicecategory-multi-delete') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {
				$strId = implode(',', $cid);
				$where = 'id IN (' .$strId .')';
				$this->delete($where);
			}
		}
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');

		//----- lay thong tin cua mot category khi biet id cua category
		if ($options['task'] == 'admin-servicecategory-info') {
			$select = $db->select()
						 ->from('service_category AS sc')
						 ->joinLeft('users AS u', 'sc.created_id = u.id',array('u.user_name AS created_name'))
						 ->joinLeft('users AS u2', 'sc.last_modified_id = u2.id',array('u2.user_name AS last_modified_name'))
						 ->joinLeft('users AS u3', 'sc.publisher_id = u3.id',array('u3.user_name AS publisher_name'))
						 ->where('sc.id = ?',$arrParam['id'],INTEGER);
			
			$result = $db->fetchRow($select);
		}
		
		//----- kiem tra va tra ve so phan tu thuoc mot category khi biet id cua category do
		if ($options['task'] == 'count-servicecategory-members') {
			$select = $db->select()
						 ->from('service_category AS sc')
						 ->joinLeft('services AS s', 's.category_id = sc.id','COUNT(s.id) AS countservice')
						 ->group('sc.id')
						 ->where('sc.id = ?',$arrParam['id'],INTEGER);
			$row = $db->fetchRow($select);
			$result = $row['countservice'];
		}
		
		//----- kiem tra va tra ve so category con cua category nay khi biet id cua category cha
		if ($options['task'] == 'count-servicecategory-childcategory') {
			$select = $db->select()
						 ->from('service_category AS sc','COUNT(sc.id) AS countchildcategory')
						 ->where('sc.parent_category_id = ?',$arrParam['id'],INTEGER);
			$row = $db->fetchRow($select);
			$result = $row['countchildcategory'];
		}
		
		//----- lay lock_status cua doi tuong duoc chon ------------------------------------------------------------
		if ($options['task'] == 'admin-servicecategory-get-lock-status') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			if (isset($arrParam['cid']) && count($arrParam['cid'] > 0)) {
				//----- truong hop lay lock_status cua nhieu doi tuong
				$arrLockStatus = array();
				$arrCid = $arrParam['cid'];
				$select = $db->select()
							 ->from('service_category AS sc','sc.lock_status')
							 ->where('sc.id IN (?)',$arrCid);
				$result = $db->fetchAll($select);
		
			} else if (isset($arrParam['id'])) {
				//----- truong hop lay lock_status cua mot doi tuong
				$select = $db->select()
							 ->from('service_category AS sc','sc.lock_status')
						 	 ->where('sc.id = ?',$arrParam['id'],INTEGER);
				$result = $db->fetchOne($select);
			} else {
				//-----lay lock_status cua tat ca doi tuong
				$select = $db->select()
							 ->from('service_category AS sc','sc.lock_status');
				$result = $db->fetchAll($select);
			}
		
		}
		
		//----- lay order lon nhat cua doi tuong ------------------------------------------------------------
		if ($options['task'] == 'admin-get-biggest-servicecategory-order') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('service_category AS sc','sc.order')
						 ->order('sc.order DESC');
			$result = $db->fetchOne($select);
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'admin-servicecategory-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			$select = $db->select()
						 ->from('service_category AS sc')
						 ->order('sc.id DESC');
			
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
				$select->where('sc.category_name LIKE ?',$keywords);
			}
			
			$result = $db->fetchAll($select);
		}
		
		//----- lay danh sach cac nhom co id nam trong mot mang (mang $arrParam['cid'])
		if ($options['task'] == 'admin-servicecategory-list-from-array') {
			$cid = $arrParam['cid'];
			$select = $db->select()
						 ->from('service_category AS sc',array('sc.id','sc.category_name'))
						 ->where('sc.id IN (?)',$cid);
			$result = $db->fetchAll($select);
		}
		
		//----- lay id va category_name cua tat ca cac nhom (phuc vu cho selectbox)
		if ($options['task'] == 'admin-servicecategory-list-selectbox') {
			$select = $db->select()
						 ->from('service_category',array('id','category_name'));
			$result = $db->fetchPairs($select);
			$result[0] = '-- Select a Category --';
			//----- sap xep lai mang $result theo khoa
			ksort($result);
		}
		
		//----- lay id, category_name, parent_category_id cua tat ca cac nhom (phuc vu cho selectbox)
		if ($options['task'] == 'admin-servicecategory-list-recursive-selectbox') {
			$select = $db->select()
						 ->from('service_category',array('id','category_name','parent_category_id'));
			$result = $db->fetchAll($select);
			//$result[0] = '-- Select a Category --';
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
		
		//----- lay danh sach cac user thuoc mot nhom nao do khi co ID cua nhom
		if ($options['task'] == 'admin-group-list-members') {
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('users AS u',array('id','user_name'))
						 ->where('group_id = ?',$arrParam['id'],INTEGER);
			$result = $db->fetchAll($select);
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
			
			//----- lay user_id cua user publish/unpublish
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$publisher_id 	= $user_id;
			$publish_time	= date("Y-m-d H:i:s");
			
			$strId = implode(',', $cid);
			$data = array('publish'=>$status,'publisher_id'=>$user_id,'publish_time'=>$publish_time);
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
			
			//----- lay user_id cua user publish/unpublish
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$publisher_id 	= $user_id;
			$publish_time	= date("Y-m-d H:i:s");
			
			$data = array('publish'=>$status,'publisher_id'=>$user_id,'publish_time'=>$publish_time);
			$where = 'id = ' .$id;
			$this->update($data, $where);
				
		}
	
	}
	
	public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-servicecategory-add') {
			$row 				= $this->fetchNew();
			$row->category_name	= $arrParam['category_name'];
			$row->description	= $arrParam['description'];
			$row->parent_category_id = $arrParam['parent_category_id'];
			
			//----- lay user_id cua user tao ra nhom nay
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->created_id 	= $user_id;
			$row->created_time	= date("Y-m-d H:i:s");
			
			$row->last_modified_id = $user_id;
			$row->last_modified_time = date("Y-m-d H:i:s");
			
			$row->order 		= $arrParam['order'];
			$row->publish 		= $arrParam['publish'];
			$row->lock_status	= $arrParam['lock_status'];
			
			$row->publisher_id 	= $user_id;
			$row->publish_time	= date("Y-m-d H:i:s");
			
			$row->save();
		}
		
		if ($options['task'] == 'admin-servicecategory-edit') {
			$where = ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			$row->category_name	= $arrParam['category_name'];
			$row->description	= $arrParam['description'];
			$row->parent_category_id = $arrParam['parent_category_id'];
			
			$row->order 		= $arrParam['order'];
			$row->publish 		= $arrParam['publish'];
			$row->lock_status	= $arrParam['lock_status'];
			
			//----- lay user_id cua user thuc hien thao tac
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->publisher_id 	= $user_id;
			$row->publish_time	= date("Y-m-d H:i:s");

			$row->last_modified_id = $user_id;
			$row->last_modified_time = date("Y-m-d H:i:s");
			
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