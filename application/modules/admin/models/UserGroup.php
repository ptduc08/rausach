<?php
class Admin_Model_UserGroup extends Zend_Db_Table {
	protected $_name = 'user_group';
	protected $_primary = 'id';
	
	public function changeStatus($arrParam = null, $options = null) {
		//----- truong hop thay doi thuoc tinh status
		if ($options['task'] == 'admin-change-status') {
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
		
		//----- truong hop thay doi thuoc tinh group_acp (quyen truy cap admin control panel)
		if ($options['task'] == 'admin-change-acp') {
			if (isset($arrParam['id'])) {		//----- change acp right cho mot doi tuong
				$id = $arrParam['id'];
				switch ($arrParam['type']) {
					case 'active':
						$status = 1;
						break;
					case 'inactive':
						$status = 0;
						break;
				}
				$data = array('group_acp'=>$status);
				$where = 'id = ' .$id;
				$this->update($data, $where);
			}
		}
		
	}
	
	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
	
		$ssFilter = $arrParam['ssFilter'];
		$select = $db->select()
					->from('user_group AS g',array('COUNT(g.id) AS total'));
		
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('g.group_name LIKE ?',$keywords);
			
		}
		
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function deleteItem($arrParam = null, $options = null) {
		//----- truong hop xoa mot doi tuong
		if ($options['task'] == 'admin-group-delete') {
			$where = ' id = ' .$arrParam['id'];
			$this->delete($where);
		}
		
		//----- truong hop xoa nhieu doi tuong
		if ($options['task'] == 'admin-group-multi-delete') {
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

		//----- lay thong tin cua mot nhom khi biet id cua nhom
		if ($options['task'] == 'admin-group-info') {
			$select = $db->select()
						 ->from('user_group AS g')
						 ->joinLeft('users AS u', 'g.created_by = u.id',array('u.id AS user_id','u.user_name'))
						 ->where('g.id = ?',$arrParam['id'],INTEGER);
			
			$result = $db->fetchRow($select);
		}
		
		//----- kiem tra va tra ve so user thuoc mot nhom khi biet id cua nhom do
		if ($options['task'] == 'count-group-members') {
			$select = $db->select()
						 ->from('user_group AS g')
						 ->joinLeft('users AS u', 'u.group_id = g.id','COUNT(u.id) AS members')
						 ->group('g.id')
						 ->where('g.id = ?',$arrParam['id'],INTEGER);
			$row = $db->fetchRow($select);
			$result = $row['members'];
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		//$db = Zend_Db::factory($adapter,$config);
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'admin-group-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			$select = $db->select()
						->from('user_group AS g',array('g.id','g.group_name','g.status','g.group_acp','g.order'))
						->joinLeft('users AS u', 'u.group_id = g.id','COUNT(u.id) AS members')
						->group('g.id');
			
			//----- neu co thong so sap xep thi bo sung order de sap xep
			if (!empty($ssFilter['col']) && !empty($ssFilter['order'])) {
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
				$select->where('g.group_name LIKE ?',$keywords);
			}
			
			$result = $db->fetchAll($select);
		}
		
		//----- lay danh sach cac nhom co id nam trong mot mang (mang $arrParam['cid'])
		if ($options['task'] == 'admin-group-list-from-array') {
			$cid = $arrParam['cid'];
			$select = $db->select()
						->from('user_group AS g',array('g.id','g.group_name'))
						->where('g.id IN (?)',$cid);
			$result = $db->fetchAll($select);
		}
		
		//----- lay id va group_name cua tat ca cac nhom (phuc vu cho selectbox)
		if ($options['task'] == 'admin-group-list-selectbox') {
			$select = $db->select()
						 ->from('user_group',array('id','group_name'));
			$result = $db->fetchPairs($select);
			$result[0] = '-- Select a Group --';
			//----- sap xep lai mang $result theo khoa
			ksort($result);
		}
		
		//----- lay id va group_name cua cac nhom mac dinh, tru nhom hien tai (phuc vu cho selectbox parent group)
		if ($options['task'] == 'admin-group-list-selectbox-parent-group') {
			//----- lay id cua nhom dang duoc chon
			if (isset($arrParam['id'])) {
				$current_group_id = $arrParam['id'];
			} else {
				$current_group_id = 0;
			}
			//----- truy van cac nhom mac dinh (group_default = 1), tru nhom hien dang duoc chon
			//----- tru nhom Administrators
			$select = $db->select()
						 ->from('user_group',array('id','group_name'))
						 ->where('group_default = 1')
						 ->where('id != 1')
						 ->where('id != ?',$current_group_id,INTEGER);
			$result = $db->fetchPairs($select);
			$result[0] = '-- Select a Group --';
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
	
	public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-group-add') {
			$row 				= $this->fetchNew();
			$row->group_name 	= $arrParam['group_name'];
			$row->parent_group_id = $arrParam['parent_group_id'];
			$row->group_acp 	= $arrParam['group_acp'];
			//----- chi co nhung nhom duoc tao tu truoc moi la nhom mac dinh.
			//----- tat ca nhung nhom tao sau nay deu la nhom khong mac dinh
			$row->group_default = 0;
			$row->created 		= date("Y-m-d H:m:s");
			
			//----- lay user_id cua user tao ra nhom nay
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->created_by 	= $user_id;
			
			//----- thay permission tu so thanh chuoi ky tu tuong ung 
			$permission = 'Limit Access';
			switch ($arrParam['permission']) {
				case 0:
					$permission = 'Full Access';
					break;
				case 1:
					$permission = 'Limit Access';
					break;
				default:
					$permission = 'Limit Access';
					break;
			}
			$row->permission	= $permission;
			$row->status 		= $arrParam['status'];
			$row->order 		= $arrParam['order'];
			
			$row->save();
		}
		
		if ($options['task'] == 'admin-group-edit') {
			$where = ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			$row->group_name 	= $arrParam['group_name'];
			$row->parent_group_id = $arrParam['parent_group_id'];
			//$row->avatar 		= $arrParam['avatar'];
			//$row->ranking		= $arrParam['ranking'];
			$row->group_acp 	= $arrParam['group_acp'];
			$row->modified 		= date("Y-m-d H:m:s");
			
			//----- lay user_id cua user vua sua thong tin cua nhom
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->modified_by 	= $user_id;

			//----- thay permission tu so thanh chuoi ky tu tuong ung
			$permission = 'Limit Access';
			switch ($arrParam['permission']) {
				case 0:
					$permission = 'Full Access';
					break;
				case 1:
					$permission = 'Limit Access';
					break;
				default:
					$permission = 'Limit Access';
					break;
			}
			$row->permission	= $permission;
			
			$row->status 		= $arrParam['status'];
			$row->order 		= $arrParam['order'];
			
			$row->save();
		}
	}
	
	public function sortItem($arrParam = null, $options = null) {
		$cid = $arrParam['cid'];
		$order = $arrParam['order'];
		if (count($cid) > 0) {
			foreach ($cid as $key=>$value) {
				$where = 'id = ' .$value;
				$data = array('order'=>$order[$value]);
				$this->update($data,$where);
			}
		}
		
	}
}