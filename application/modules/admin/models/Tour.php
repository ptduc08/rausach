<?php
class Admin_Model_Tour extends Zend_Db_Table {
	protected $_name = 'tour';
	protected $_primary = 'id';
	
	public function changeLockStatus($arrParam = null, $options = null) {
		//----- truong hop thay doi thuoc tinh locl status
		if ($options['task'] == 'admin-tour-change-lock-status') {
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
					->from('projects AS p',array('COUNT(p.id) AS total'));
		
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('p.category_name LIKE ?',$keywords);
			
		}
		
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function deleteItem($arrParam = null, $options = null) {
		//----- truong hop xoa mot doi tuong
		if ($options['task'] == 'admin-tour-delete') {
			//----- goi getItem de lay ten cover_image cua doi tuong dang bi xoa
			//----- va tien hanh xoa cover_image khoi he thong
			$cover_image = $this->getItem($arrParam,array('task'=>'admin-get-deleting-tour-coverimage'));
			$upload_dir = FILES_PATH . '/tour/cover-images';
			$upload = new Zendvn_File_Upload();
			$upload->removeFile($upload_dir . '/small/' . $cover_image);
			$upload->removeFile($upload_dir . '/medium/' . $cover_image);
			$upload->removeFile($upload_dir . '/large/' . $cover_image);
			$upload->removeFile($upload_dir . '/original/' . $cover_image);
			
			//----- sau khi xoa het cover_image tien hanh xoa doi tuong khoi database
			$where = ' id = ' .$arrParam['id'];
			$this->delete($where);
		}
		
		//----- truong hop xoa nhieu doi tuong
		if ($options['task'] == 'admin-tour-multi-delete') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {
				//----- dau tien phai xoa cover image cua cac doi tuong se bi delete
				foreach ($cid as $key=>$val) {
					//----- truyen id cua doi tuong bi xoa vao mang $arrParam
					$arrParam['id'] = $val;
					//----- goi getItem de lay ten cover image cua doi tuong dang bi xoa
					//----- va tien hanh xoa cover image khoi he thong
					$cover_image = $this->getItem($arrParam,array('task'=>'admin-get-deleting-tour-coverimage'));
					$upload_dir = FILES_PATH . '/tour/cover-images';
					$upload = new Zendvn_File_Upload();
					$upload->removeFile($upload_dir . '/small/' . $cover_image);
					$upload->removeFile($upload_dir . '/medium/' . $cover_image);
					$upload->removeFile($upload_dir . '/large/' . $cover_image);
					$upload->removeFile($upload_dir . '/original/' . $cover_image);
					
					//----- sau khi xoa het cover_image tien hanh xoa doi tuong khoi database
					$where = ' id = ' .$arrParam['id'];
					$this->delete($where);
				}

			}
		}
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot nhom khi biet id cua nhom
		if ($options['task'] == 'admin-tour-info') {
			$select = $db->select()
						 ->from('tour AS t')
						 ->joinLeft('tour_category AS tc', 't.category_id = tc.id','tc.category_name')
						 ->where('t.id = ?',$arrParam['id'],INTEGER)
						 ->group('t.id');
			
			
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
		
		if ($options['task'] == 'admin-tour-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('tour AS t')
						 ->joinLeft('tour_category AS tc','t.category_id = tc.id','tc.category_name')
						 ->group('t.id');

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
			if ($ssFilter['category_id'] > 0) {
				$select->where('t.category_id = ?',$ssFilter['category_id'],INTEGER);
			}
			
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
		if ($options['task'] == 'admin-tour-add') {
			$row 				= $this->fetchNew();
			$row->title	= $arrParam['title'];
			$row->brief	= $arrParam['brief'];
			$row->content	= $arrParam['content'];
			$row->duration	= $arrParam['duration'];
			$row->price	= $arrParam['price'];
			$row->start_time	= $arrParam['start_time'];
			$row->start_location	= $arrParam['start_location'];
			$row->tour_path	= $arrParam['tour_path'];
			$row->homepage	= $arrParam['homepage'];
			$row->cover_image	= $arrParam['cover_image'];
			$row->publish	 	= $arrParam['publish'];
			$row->lock_status 	= $arrParam['lock_status'];
			$row->order		 	= $arrParam['order'];
			//----- lay user_id cua user tao ra doi tuong
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->created_id 	= $user_id;
			$row->created_time	= date("Y-m-d H:m:s");
			
			$row->last_modified_id = 0;
			$row->last_modified_time = '0000-00-00 00:00:00';
			
			if ($arrParam['publish'] == 0) {
				//----- nguoi soan bai khong publish bai viet, hoac khong co quyen publish bai viet
				$row->publisher_id	= 0;
				$row->publish_time	= '0000-00-00 00:00:00';
			} else {
				//----- nguoi soan bai publish luon bai viet thi cap nhat luon thong tin nguoi va thoi gian publish
				$row->publisher_id	= $user_id;;
				$row->publish_time	= date("Y-m-d H:m:s");
			}
			
			
			$row->view_counter	= 0;
			$row->category_id	= $arrParam['category_id'];
			
			$row->save();
			
		}
		
		if ($options['task'] == 'admin-tour-edit') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			
			$row->title	= $arrParam['title'];
			$row->brief	= $arrParam['brief'];
			$row->content	= $arrParam['content'];
			$row->duration	= $arrParam['duration'];
			$row->price	= $arrParam['price'];
			$row->start_time	= $arrParam['start_time'];
			$row->start_location	= $arrParam['start_location'];
			$row->tour_path	= $arrParam['tour_path'];
			$row->homepage	= $arrParam['homepage'];
			$row->cover_image	= $arrParam['cover_image'];
			$row->publish	 	= $arrParam['publish'];
			$row->lock_status 	= $arrParam['lock_status'];
			$row->order		 	= $arrParam['order'];
			//----- lay user_id cua user dang login vao he thong
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->last_modified_id 	= $user_id;
			$row->last_modified_time = date("Y-m-d H:m:s");
			$row->category_id	= $arrParam['category_id'];

			$row->save();
		}
		
		if ($options['task'] == 'admin-project-publish-one-project') {
			$project_id = $arrParam['id'];
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			//----- lay user_id cua user dang login vao he thong
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->publisher_id 	= $user_id;
			$row->publish_time = date("Y-m-d H:m:s");
			$row->save();
		}
		
		if ($options['task'] == 'admin-project-publish-multi-project') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {
				foreach($cid as $key=>$val) {
					$project_id = $val;
					$where 				= ' id = ' . $project_id;
					$row 				= $this->fetchRow($where);
					//----- lay user_id cua user dang login vao he thong
					$info = new Zendvn_System_Info();
					$user_id = $info->getMemberInfo('id');
					$row->publisher_id 	= $user_id;
					$row->publish_time = date("Y-m-d H:m:s");
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