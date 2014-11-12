<?php
class Admin_Model_Users extends Zend_Db_Table {
	protected $_name = 'users';
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
					->from('users AS u',array('COUNT(u.id) AS total'));
		
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('u.user_name LIKE ?',$keywords,STRING);
		}
		
		//----- neu co thong so loc theo group_id thi bo sung where cho select
		if ($ssFilter['group_id'] > 0) {
			$select->where('u.group_id = ?',$ssFilter['group_id'],INTEGER);
		}
		
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function deleteItem($arrParam = null, $options = null) {
		//----- truong hop xoa mot doi tuong
		if ($options['task'] == 'admin-user-delete') {
			//----- goi getItem de lay ten user_avatar cua user dang bi xoa
			//----- va tien hanh xoa user avatar khoi he thong
			$user_avatar = $this->getItem($arrParam,array('task'=>'admin-get-deleting-user-avatar'));
			$upload_dir = FILES_PATH . '/users/user-avatar';
			$upload = new Zendvn_File_Upload();
			$upload->removeFile($upload_dir . '/small/' . $user_avatar);
			$upload->removeFile($upload_dir . '/medium/' . $user_avatar);
			$upload->removeFile($upload_dir . '/original/' . $user_avatar);
			
			//----- sau khi xoa het user avatar tien hanh xoa user khoi database
			$where = ' id = ' .$arrParam['id'];
			$this->delete($where);
		}
		
		//----- truong hop xoa nhieu doi tuong
		if ($options['task'] == 'admin-user-multi-delete') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {
				//----- dau tien phai xoa user avatar cua cac user se bi delete
				foreach ($cid as $key=>$val) {
					//----- truyen id cua user bi xoa vao mang $arrParam
					$arrParam['id'] = $val;
					//----- goi getItem de lay ten user_avatar cua user dang bi xoa
					//----- va tien hanh xoa user avatar khoi he thong
					$user_avatar = $this->getItem($arrParam,array('task'=>'admin-delete-user-avatar'));
					$upload_dir = FILES_PATH . '/users/user-avatar';
					$upload = new Zendvn_File_Upload();
					$upload->removeFile($upload_dir . '/small/' . $user_avatar);
					$upload->removeFile($upload_dir . '/medium/' . $user_avatar);
					$upload->removeFile($upload_dir . '/original/' . $user_avatar);
				}
				//----- sau khi xoa user avatar cua cac user se bi delete
				//----- thi tien hanh xoa cac user khoi database
				$strId = implode(',', $cid);
				$where = 'id IN (' .$strId .')';
				$this->delete($where);
				
			}
		}
	}
	
	public function getItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-user-info') {
			$db = Zend_Registry::get('connectDb');
			$select = $db->select()
						 ->from('users AS u')
						 ->joinLeft('user_group AS g', 'u.group_id = g.id','g.group_name')
						 ->where('u.id = ?',$arrParam['id'],INTEGER);
			$result = $db->fetchRow($select);
		}
		
		//----- lay ten user_avatar cua user dang bi xoa de xoa user avatar
		if ($options['task'] == 'admin-get-deleting-user-avatar') {
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
		
		if ($options['task'] == 'admin-user-list') {
			$select = $db->select()
						->from('users AS u',array('u.user_name','u.status','u.email','u.register_date','u.id'))
						->joinLeft('user_group AS g','u.group_id=g.id','g.group_name');
			
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
				$select->where('u.user_name LIKE ?',$keywords);
			}
			
			//----- neu co thong so loc theo group_id thi bo sung where cho select
			if ($ssFilter['group_id'] > 0) {
				$select->where('u.group_id = ?',$ssFilter['group_id'],INTEGER);
			}
			
			$result = $db->fetchAll($select);
		}
		
		//----- lay danh sach cac user co id nam trong mot mang (mang $arrParam['cid'])
		if ($options['task'] == 'admin-user-list-from-array') {
			$cid = $arrParam['cid'];
			$select = $db->select()
			->from('users AS u',array('u.id','u.user_name'))
			->where('u.id IN (?)',$cid);
			$result = $db->fetchAll($select);
		}
		
		return $result;
	}
	
	public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-user-add') {
			$row 				= $this->fetchNew();
			$row->user_name 	= $arrParam['user_name'];
			//----- ma hoa password
			$encode = new Zendvn_Encode();
			$password			= $encode->password($arrParam['password']);
			$row->password 		= $password;
			
			$row->email			= $arrParam['email'];
			$row->user_avatar	= $arrParam['user_avatar'];
			$row->group_id	 	= $arrParam['group_id'];
			$row->first_name	= $arrParam['first_name'];
			$row->last_name		= $arrParam['last_name'];
			//----- chuyen birthday tu dang d-m-Y sang Y-m-d de luu vao database
			$birthday = date('Y-m-d',strtotime($arrParam['birthday']));
			$row->birthday 		= $birthday;
			$row->status 		= $arrParam['status'];
			$row->sign	 		= $arrParam['sign'];
			$row->register_date	= date("Y-m-d H:m:s");
			//----- lay dia chi IP cua may khach
			$row->register_ip	= $_SERVER['REMOTE_ADDR'];
			
			$row->save();
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