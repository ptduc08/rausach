<?php
class Admin_Model_Privileges extends Zend_Db_Table {
	protected $_name = 'user_group_privileges';
	protected $_primary = 'id';
	
	public function changeStatus($arrParam = null, $options = null) {
		//----- truong hop thay doi thuoc tinh status cua user
		if ($options['task'] == 'admin-user-change-status') {
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
	
	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$ssFilter = $arrParam['ssFilter'];
		$select = $db->select()
					->from('user_group_privileges AS gp',array('COUNT(gp.id) AS total'));
		
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('p.name LIKE ?',$keywords,STRING);
		}
		
		//----- neu co thong so loc theo group_id thi bo sung where cho select
		if ($ssFilter['group_id'] > 0) {
			$select->where('gp.group_id = ?',$ssFilter['group_id'],INTEGER);
		}
		
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function deleteItem($arrParam = null, $options = null) {
		//----- truong hop xoa mot doi tuong
		if ($options['task'] == 'admin-privilege-delete') {
			$where = ' id = ' .$arrParam['id'];
			$this->delete($where);
		}
		
		//----- truong hop xoa nhieu doi tuong
		if ($options['task'] == 'admin-privilege-multi-delete') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {
				//----- chuyen doi tu mang $cid sang thanh chuoi $strId, moi id cach nhau mot dau phay
				$strId = implode(',', $cid);
				$where = 'id IN (' .$strId .')';
				$this->delete($where);	
			}
		}
	}
	
	public function getItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-privilege-info') {
			$db = Zend_Registry::get('connectDb');
			$select = $db->select()
						 ->from('user_group_privileges AS gp')
						 ->joinLeft('privileges AS p', 'p.id = gp.privilege_id','p.name')
						 ->where('gp.id = ?',$arrParam['id'],INTEGER);
			$result = $db->fetchRow($select);
		}
		
		//----- lay ten user_avatar cua user dang bi xoa de xoa user avatar
		if ($options['task'] == 'admin-delete-user-avatar') {
			$db = Zend_Registry::get('connectDb');
			$select = $db->select()
						 ->from('users AS u',array('u.user_avatar'))
						 ->where('u.id = ?',$arrParam['id'],INTEGER);
			$result = $db->fetchOne($select);
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$paginator = $arrParam['paginator'];
		$ssFilter = $arrParam['ssFilter'];
		
		//===============================================================================================
		//----- lay danh sach privilege duoc gan truc tiep cho mot nhom
		//===============================================================================================
		if ($options['task'] == 'admin-privilege-list') {
			$select = $db->select()
						->from('user_group_privileges AS gp',array('gp.id','gp.status'))
						->joinLeft('privileges AS p','gp.privilege_id=p.id',array('p.id AS privilege_id','p.name'));
			
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
				$select->where('p.name LIKE ?',$keywords);
			}
				
			//----- neu co thong so loc theo group_id thi bo sung where cho select
			if ($ssFilter['group_id'] > 0) {
				$select->where('gp.group_id = ?',$ssFilter['group_id'],INTEGER);
			}
				
			$result = $db->fetchAll($select);
		}
		
		//===============================================================================================
		//----- lay id va privilege name cua cac privilege chua duoc cap cho group (phuc vu cho selectbox)
		//===============================================================================================
		if ($options['task'] == 'admin-list-assigned-privilege-selectbox') {
			//----- lap cau select truy van danh sach id cua cac privilege da duoc cap
			//----- cho nhom dang login vao he thong
			$logged_group_id = $arrParam['logged_group_id'];
			
			//----- lay danh sach cac privilege da cap (truc tiep va ke thua) cua group duoc chon
			$arrPrivilege = $arrParam['arrPrivilege'];
			$myGroupAcl = array();
			
			$acl = new Zendvn_System_Acl();
			$acl->getGroupAcl($arrPrivilege, $logged_group_id, $myGroupAcl);

			//----- lay rieng id cua toan bo privilege dua vao mang $myAssignedAclId
			$myAssignedAclId = array();
			foreach ($myGroupAcl as $key=>$val) {
				$myAssignedAclId[] = $val['pid'];
			}
			
			//----- truy van danh sach cac privilege chua duoc cap cho group dang login vao he thong
			//----- nghia la co id khong nam trong mang $myAssignedAclId
			$select = $db->select()
						 ->from('privileges',array('id','name'))
						 ->where('id NOT IN (?)', $myAssignedAclId);
			$result = $db->fetchPairs($select);
			ksort($result);
		}
		
		//===============================================================================================
		//----- lay danh sach cac privilege co id nam trong mot mang (mang $arrParam['cid'])
		//===============================================================================================
		if ($options['task'] == 'admin-privilege-list-from-array') {
			$cid = $arrParam['cid'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('user_group_privileges AS gp')
						 ->joinLeft('privileges as p', 'gp.privilege_id = p.id','p.name')
						 ->where('gp.id IN (?)',$cid);
			$result = $db->fetchAll($select);
		}
		
		//===============================================================================================
		//----- lay toan bo danh sach privilege trong bang user_group_privilege.
		//----- Group_id cua nhom muon xem danh sach privilege truyen vao qua mang $arrParam
		//----- phan loai privilege la 'direct_privilege' hay 'inherit_privilege'
		//===============================================================================================
		if ($options['task'] == 'admin-privilege-list-all') {
			$group_id = $arrParam['ssFilter']['group_id'];
			//----- lay mang thong so cua nhom co group_id duoc truyen vao
			$tblGroup = new Admin_Model_UserGroup();
			$thisGroup = $tblGroup->getItem(array('id'=>$group_id),array('task'=>'admin-group-info'));
			$parent_group_id = $thisGroup['parent_group_id'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('privileges AS p',array('p.id AS pid','p.name','p.module','p.controller','p.action'))
						 ->join('user_group_privileges AS gp','gp.privilege_id = p.id')
						 ->join('user_group AS g','g.id = gp.group_id',array('g.parent_group_id','g.group_name'))
						 ->where('gp.status = 1')
						 ->order('p.name ASC');
			$tmp = $db->fetchAll($select);
			$result = array();
			if (!empty($tmp)) {
				foreach ($tmp as $key=>$val) {
					
					if ($val['group_id'] == $group_id) {
						$val['privilege_type'] = 'direct_privilege';
					} else {
						$val['privilege_type'] = 'inherit_privilege';
					}
					$result[] = $val;
				}
			}
			
			
			//----- loai bo cac privilege trung nhau, sap xep lai mang $arrPrivilege
			//$result = array_unique($result);
			//ksort($result);
			
		}
		
		
		//===============================================================================================
		return $result;
	}
	
	public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-group-privilege-add') {
			//----- them mot mang privilege cho mot nhom co group_id xac dinh
			$arrGroupPrivilege = $arrParam['group_privilege_id'];
			if (count($arrGroupPrivilege) > 0) {
				foreach ($arrGroupPrivilege as $key=>$val) {
					$row 				= $this->fetchNew();
					$row->privilege_id 	= $val;
					$row->group_id		= $arrParam['group_id'];
					$row->status		= 1;
					$row->save();
				}
			}
			
		}
		
		if ($options['task'] == 'admin-user-edit') {
			$where = ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			
			if (!empty($arrParam['password'])) {
				//----- ma hoa password
				$encode 		= new Zendvn_Encode();
				$password		= $encode->password($arrParam['password']);
				$row->password 	= $password;
			}

			$row->email			= $arrParam['email'];
			$row->user_avatar	= $arrParam['user_avatar'];
			$row->group_id	 	= $arrParam['group_id'];
			$row->first_name	= $arrParam['first_name'];
			$row->last_name		= $arrParam['last_name'];
			//----- chuyen birthday tu dang d-m-Y sang Y-m-d de luu vao database
			$birthday 			= date('Y-m-d',strtotime($arrParam['birthday']));
			$row->birthday 		= $birthday;
			$row->status 		= $arrParam['status'];
			$row->sign	 		= $arrParam['sign'];
			
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