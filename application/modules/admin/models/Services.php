<?php
class Admin_Model_Services extends Zend_Db_Table {
	protected $_name = 'services';
	protected $_primary = 'id';
	
	public function changeFeaturedService($arrParam = null, $options = null) {
		//----- truong hop thay doi thuoc tinh featured service
		if ($options['task'] == 'admin-service-change-featured-service') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {				//----- change lock status cho nhieu doi tuong
				switch ($arrParam['type']) {
					case 'active':
						$featured_service = 1;
						break;
					case 'inactive':
						$featured_service = 0;
						break;
				}
				$strId = implode(',', $cid);
				$data = array('featured_service'=>$featured_service);
				$where = 'id IN (' .$strId .')';
				$this->update($data, $where);
			}
			if (isset($arrParam['id'])) {		//----- change status cho mot doi tuong
				$id = $arrParam['id'];
				switch ($arrParam['type']) {
					case 'active':
						$featured_service = 1;
						break;
					case 'inactive':
						$featured_service = 0;
						break;
				}
				$data = array('featured_service'=>$featured_service);
				$where = 'id = ' .$id;
				$this->update($data, $where);
			}
		}
	
	}
	
	public function changeLockStatus($arrParam = null, $options = null) {
		//----- truong hop thay doi thuoc tinh status
		if ($options['task'] == 'admin-service-change-lock-status') {
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
					->from('services AS s',array('COUNT(s.id) AS total'));
		
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('s.service_title LIKE ?',$keywords);
			
		}
		
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function deleteItem($arrParam = null, $options = null) {
		//----- truong hop xoa mot doi tuong
		if ($options['task'] == 'admin-service-delete') {
			//----- goi getItem de lay ten cover_image cua service dang bi xoa
			//----- va tien hanh xoa cover_image khoi he thong
			$cover_image = $this->getItem($arrParam,array('task'=>'admin-get-deleting-service-coverimage'));
			$upload_dir = FILES_PATH . '/services/cover-images';
			$upload = new Zendvn_File_Upload();
			$upload->removeFile($upload_dir . '/small/' . $cover_image);
			$upload->removeFile($upload_dir . '/medium/' . $cover_image);
			$upload->removeFile($upload_dir . '/original/' . $cover_image);
			
			//----- sau khi xoa het user avatar tien hanh xoa article khoi database
			$where = ' id = ' .$arrParam['id'];
			$this->delete($where);
			
		}
		
		//----- truong hop xoa nhieu doi tuong
		if ($options['task'] == 'admin-service-multi-delete') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {
				//----- dau tien phai xoa cover image cua cac service se bi delete
				foreach ($cid as $key=>$val) {
					//----- truyen id cua service bi xoa vao mang $arrParam
					$arrParam['id'] = $val;
					//----- goi getItem de lay ten cover image cua service dang bi xoa
					//----- va tien hanh xoa cover image khoi he thong
					$cover_image = $this->getItem($arrParam,array('task'=>'admin-get-deleting-service-coverimage'));
					$upload_dir = FILES_PATH . '/services/cover-images';
					$upload = new Zendvn_File_Upload();
					$upload->removeFile($upload_dir . '/small/' . $cover_image);
					$upload->removeFile($upload_dir . '/medium/' . $cover_image);
					$upload->removeFile($upload_dir . '/original/' . $cover_image);
					
					//----- sau khi xoa het cover image tien hanh xoa service khoi database
					$where = ' id = ' .$arrParam['id'];
					$this->delete($where);
				}
			}
		}
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot service khi biet id cua service
		if ($options['task'] == 'admin-service-info') {
			$select = $db->select()
						 ->from('services AS s')
						 ->joinLeft('service_category AS sc','s.category_id = sc.id',array('sc.id AS category_id','sc.category_name'))
						 ->joinLeft('users AS u', 's.created_id = u.id',array('u.user_name AS created_name'))
						 ->joinLeft('users AS u2', 's.last_modified_id = u2.id',array('u2.user_name AS last_modified_name'))
						 ->joinLeft('users AS u3', 's.publisher_id = u3.id',array('u3.user_name AS publisher_name'))
						 ->where('s.id = ?',$arrParam['id'],INTEGER);			
			
			$result = $db->fetchRow($select);
		}
		
		//----- lay ten cover_image cua service dang bi xoa de xoa cover_image
		if ($options['task'] == 'admin-get-deleting-service-coverimage') {
			$db = Zend_Registry::get('connectDb');
			$select = $db->select()
						 ->from('services AS s',array('s.cover_image'))
						 ->where('s.id = ?',$arrParam['id'],INTEGER);
			$result = $db->fetchOne($select);
		}
		
		//----- lay order lon nhat trong bang service
		if ($options['task'] == 'admin-get-biggest-service-order') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('services AS s','s.order')
						 ->order('s.order DESC');
			$result = $db->fetchOne($select);
		}
		
		//----- lay lock_status cua service duoc chon
		if ($options['task'] == 'admin-service-get-lock-status') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			if (isset($arrParam['cid']) && count($arrParam['cid'] > 0)) {
				//----- truong hop lay lock_status cua nhieu doi tuong. Tra ve mot mang
				$arrLockStatus = array();
				$arrCid = $arrParam['cid'];
				$select = $db->select()
							 ->from('services AS s','s.lock_status')
							 ->where('s.id IN (?)',$arrCid);
				$result = $db->fetchAll($select);
				
			} else if (isset($arrParam['id'])) {
			//----- truong hop lay lock_status cua mot doi tuong. Tra ve mot gia tri
				$select = $db->select()
				 			 ->from('services AS s','s.lock_status')
							 ->where('s.id = ?',$arrParam['id'],INTEGER);
				$result = $db->fetchOne($select);
			}
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'admin-service-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('services AS s')
						 ->joinLeft('service_category AS sc','s.category_id = sc.id','sc.category_name')
						 ->group('s.id');

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
			if ($ssFilter['category_id'] > 0) {
				$select->where('s.category_id = ?',$ssFilter['category_id'],INTEGER);
			}
			
			$result = $db->fetchAll($select);
			
		}
		
		//----- lay danh sach cac service co id nam trong mot mang (mang $arrParam['cid'])
		if ($options['task'] == 'admin-service-list-from-array') {
			$cid = $arrParam['cid'];
			$select = $db->select()
						 ->from('services AS s',array('s.id','s.service_title','s.cover_image','s.lock_status'))
						 ->where('s.id IN (?)',$cid);
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
		
		if (count($cid) > 0) {				//----- publish cho nhieu service
			switch ($arrParam['type']) {
				case 'active':
					$publish = 1;
					break;
				case 'inactive':
					$publish = 0;
					break;
			}
			
			//----- lay user_id cua user publish/unpublish
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$publisher_id 	= $user_id;
			$publish_time	= date("Y-m-d H:i:s");
			
			$strId = implode(',', $cid);
			$data = array('publish'=>$publish,'publisher_id'=>$user_id,'publish_time'=>$publish_time);
			$where = 'id IN (' .$strId .')';
			$this->update($data, $where);
			
			//$this->saveItem($arrParam,array('task'=>'admin-service-publish-multi-service'));
		}
		if (isset($arrParam['id'])) {		//----- publish cho mot service
			$id = $arrParam['id'];
			switch ($arrParam['type']) {
				case 'active':
					$publish = 1;
					break;
				case 'inactive':
					$publish = 0;
					break;
			}
			
			//----- lay user_id cua user publish/unpublish
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$publisher_id 	= $user_id;
			$publish_time	= date("Y-m-d H:i:s");
			
			$data = array('publish'=>$publish,'publisher_id'=>$user_id,'publish_time'=>$publish_time);
			$where = 'id = ' .$id;
			$this->update($data, $where);
			
			//$this->saveItem($arrParam,array('task'=>'admin-service-publish-one-service'));
		}
	
	}
	
	public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-service-add') {
			$row 				= $this->fetchNew();
			$row->category_id	= $arrParam['category_id'];
			$row->service_title	= $arrParam['service_title'];
			$row->service_brief	= $arrParam['service_brief'];
			$row->service_content	= $arrParam['service_content'];
			$row->price				= $arrParam['price'];
			$row->cover_image	= $arrParam['cover_image'];
			$row->publish	 	= $arrParam['publish'];
			$row->lock_status	= $arrParam['lock_status'];
			$row->featured_service = $arrParam['featured_service'];
			$row->order		 	= $arrParam['order'];
			//----- lay user_id cua user tao ra service nay
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			
			$row->created_id 	= $user_id;
			$row->created_time	= date("Y-m-d H:i:s");
			
			$row->last_modified_id = $user_id;
			$row->last_modified_time = date("Y-m-d H:i:s");
			
			$row->publisher_id 	= $user_id;
			$row->publish_time	= date("Y-m-d H:i:s");
			
			$row->save();
			
		}
		
		if ($options['task'] == 'admin-service-edit') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			$row->category_id	= $arrParam['category_id'];
			$row->service_title	= $arrParam['service_title'];
			$row->service_brief	= $arrParam['service_brief'];
			$row->service_content	= $arrParam['service_content'];
			$row->price				= $arrParam['price'];
			$row->cover_image	= $arrParam['cover_image'];
			$row->publish	 	= $arrParam['publish'];
			$row->lock_status	= $arrParam['lock_status'];
			$row->featured_service = $arrParam['featured_service'];
			$row->order		 	= $arrParam['order'];
			//----- lay user_id cua user dang login vao he thong
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			
			$row->last_modified_id 	= $user_id;
			$row->last_modified_time = date("Y-m-d H:i:s");
			
			$row->publisher_id 	= $user_id;
			$row->publish_time	= date("Y-m-d H:i:s");

			$row->save();

		}
		
		if ($options['task'] == 'admin-service-publish-one-service') {
			$service_id 		= $arrParam['id'];
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			//----- lay user_id cua user dang login vao he thong
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->publisher_id 	= $user_id;
			$row->publish_time = date("Y-m-d H:i:s");
			$row->save();
		}
		
		if ($options['task'] == 'admin-service-publish-multi-service') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {
				foreach($cid as $key=>$val) {
					$service_id 		= $val;
					$where 				= ' id = ' . $service_id;
					$row 				= $this->fetchRow($where);
					//----- lay user_id cua user dang login vao he thong
					$info = new Zendvn_System_Info();
					$user_id = $info->getMemberInfo('id');
					$row->publisher_id 	= $user_id;
					$row->publish_time = date("Y-m-d H:i:s");
					$row->save();
				}
			} 
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