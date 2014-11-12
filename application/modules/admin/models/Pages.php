<?php
class Admin_Model_Pages extends Zend_Db_Table {
	protected $_name = 'pages';
	protected $_primary = 'id';
	
	public function changeLockStatus($arrParam = null, $options = null) {
		//----- truong hop thay doi thuoc tinh status
		if ($options['task'] == 'admin-page-change-lock-status') {
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
					->from('pages AS p',array('COUNT(p.id) AS total'));
		
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('p.page_title LIKE ?',$keywords);
			
		}
		
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function deleteItem($arrParam = null, $options = null) {
		//----- truong hop xoa mot doi tuong
		if ($options['task'] == 'admin-page-delete') {
			//----- goi getItem de lay ten cover_image cua page dang bi xoa
			//----- va tien hanh xoa cover_image khoi he thong
			$cover_image = $this->getItem($arrParam,array('task'=>'admin-get-deleting-page-coverimage'));
			$upload_dir = FILES_PATH . '/pages/cover-images';
			$upload = new Zendvn_File_Upload();
			$upload->removeFile($upload_dir . '/small/' . $cover_image);
			$upload->removeFile($upload_dir . '/medium/' . $cover_image);
			$upload->removeFile($upload_dir . '/original/' . $cover_image);
			
			//----- sau khi xoa het user avatar tien hanh xoa article khoi database
			$where = ' id = ' .$arrParam['id'];
			$this->delete($where);
			
		}
		
		//----- truong hop xoa nhieu doi tuong
		if ($options['task'] == 'admin-page-multi-delete') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {
				//----- dau tien phai xoa cover image cua cac page se bi delete
				foreach ($cid as $key=>$val) {
					//----- truyen id cua page bi xoa vao mang $arrParam
					$arrParam['id'] = $val;
					//----- goi getItem de lay ten cover image cua page dang bi xoa
					//----- va tien hanh xoa cover image khoi he thong
					$cover_image = $this->getItem($arrParam,array('task'=>'admin-get-deleting-page-coverimage'));
					$upload_dir = FILES_PATH . '/pages/cover-images';
					$upload = new Zendvn_File_Upload();
					$upload->removeFile($upload_dir . '/small/' . $cover_image);
					$upload->removeFile($upload_dir . '/medium/' . $cover_image);
					$upload->removeFile($upload_dir . '/original/' . $cover_image);
					
					//----- sau khi xoa het user avatar tien hanh xoa article khoi database
					$where = ' id = ' .$arrParam['id'];
					$this->delete($where);
				}

			}
		}
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot trang khi biet id cua trang
		if ($options['task'] == 'admin-page-info') {
			$select = $db->select()
						 ->from('pages AS p')
						 ->joinLeft('users AS u', 'p.created_id = u.id',array('u.id AS user_id','u.user_name'))
						 ->where('p.id = ?',$arrParam['id'],INTEGER);
			
			$result = $db->fetchRow($select);
			
			$select = $db->select()
						 ->from('pages AS p')
						 ->joinLeft('users AS u', 'p.last_modified_id = u.id',array('u.id AS last_modified_id','u.user_name AS last_modified_name'))
						 ->where('p.id = ?',$arrParam['id'],INTEGER);
			$tmp = $db->fetchRow($select);
			if ($tmp != null && !empty($tmp)) {
				$result['last_modified_id'] = $tmp['last_modified_id'];
				$result['last_modified_name'] = $tmp['last_modified_name'];
			}			
			
		}
		
		//----- lay ten cover_image cua page dang bi xoa de xoa cover_image
		if ($options['task'] == 'admin-get-deleting-page-coverimage') {
			$db = Zend_Registry::get('connectDb');
			$select = $db->select()
						 ->from('pages AS p',array('p.cover_image'))
						 ->where('p.id = ?',$arrParam['id'],INTEGER);
			$result = $db->fetchOne($select);
		}
		
		//----- lay order lon nhat cua doi tuong ------------------------------------------------------------
		if ($options['task'] == 'admin-get-biggest-page-order') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('pages AS p','p.order')
						 ->order('p.order DESC');
			$result = $db->fetchOne($select);
		}
		
		//----- lay lock_status cua doi tuong duoc chon ------------------------------------------------------------
		if ($options['task'] == 'admin-page-get-lock-status') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			if (isset($arrParam['cid']) && count($arrParam['cid'] > 0)) {
				//----- truong hop lay lock_status cua nhieu doi tuong
				$arrLockStatus = array();
				$arrCid = $arrParam['cid'];
				$select = $db->select()
							->from('pages AS p','p.lock_status')
							->where('p.id IN (?)',$arrCid);
				$result = $db->fetchAll($select);
		
			} else if (isset($arrParam['id'])) {
				//----- truong hop lay lock_status cua mot doi tuong
				$select = $db->select()
							->from('pages AS p','p.lock_status')
							->where('p.id = ?',$arrParam['id'],INTEGER);
				$result = $db->fetchOne($select);
			} else {
				//-----lay lock_status cua tat ca doi tuong
				$select = $db->select()
							 ->from('pages AS p','p.lock_status');
				$result = $db->fetchAll($select);
			}
		
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
				$select->where('p.page_title LIKE ?',$keywords);
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
		if ($options['task'] == 'admin-page-add') {
			
			$row 				= $this->fetchNew();
			$row->page_title	= $arrParam['page_title'];
			$row->page_brief	= $arrParam['page_brief'];
			$row->page_content	= $arrParam['page_content'];
			$row->cover_image	= $arrParam['cover_image'];
			$row->publish	 	= $arrParam['publish'];
			$row->lock_status 	= $arrParam['lock_status'];
			$row->order		 	= $arrParam['order'];
			//----- lay user_id cua user tao page nay
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
		
		if ($options['task'] == 'admin-page-edit') {
			
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			
			$row->page_title	= $arrParam['page_title'];
			$row->page_brief	= $arrParam['page_brief'];
			$row->page_content	= $arrParam['page_content'];
			$row->cover_image	= $arrParam['cover_image'];
			$row->publish	 	= $arrParam['publish'];
			$row->lock_status 	= $arrParam['lock_status'];
			$row->order		 	= $arrParam['order'];
			//----- lay user_id cua user dang edit nhom nay
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->last_modified_id 	= $user_id;
			$row->last_modified_time = date("Y-m-d H:i:s");
			
			$row->publisher_id 	= $user_id;
			$row->publish_time	= date("Y-m-d H:i:s");
			
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