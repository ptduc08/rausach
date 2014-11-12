<?php
class Admin_Model_LogClientAccess extends Zend_Db_Table {
	protected $_name = 'log_client_access';
	protected $_primary = 'id';
	
	public function changeStatus($arrParam = null, $options = null) {
		//----- truong hop thay doi thuoc tinh status
		if ($options['task'] == 'admin-project-change-status') {
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
					->from('log_client_access AS lca',array('COUNT(lca.id) AS total'));
		
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function deleteItem($arrParam = null, $options = null) {
		//----- truong hop xoa mot doi tuong
		if ($options['task'] == 'admin-project-delete') {
			//----- goi getItem de lay ten cover_image cua project dang bi xoa
			//----- va tien hanh xoa cover_image khoi he thong
			$cover_image = $this->getItem($arrParam,array('task'=>'admin-get-deleting-project-coverimage'));
			$upload_dir = FILES_PATH . '/projects/cover-images';
			$upload = new Zendvn_File_Upload();
			$upload->removeFile($upload_dir . '/small/' . $cover_image);
			$upload->removeFile($upload_dir . '/medium/' . $cover_image);
			$upload->removeFile($upload_dir . '/original/' . $cover_image);
			
			//----- sau khi xoa het user avatar tien hanh xoa article khoi database
			$where = ' id = ' .$arrParam['id'];
			$this->delete($where);
			
			//----- tiep theo o bang news_category_article phai xoa cac row co article_id = id
			//----- cua article dang bi xoa
			$db = Zend_Registry::get('connectDb');
			$where = ' id = ' . $arrParam['id'];
			$db->delete('projects',$where);
			
		}
		
		//----- truong hop xoa nhieu doi tuong
		if ($options['task'] == 'admin-project-multi-delete') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {
				//----- dau tien phai xoa cover image cua cac project se bi delete
				foreach ($cid as $key=>$val) {
					//----- truyen id cua project bi xoa vao mang $arrParam
					$arrParam['id'] = $val;
					//----- goi getItem de lay ten cover image cua project dang bi xoa
					//----- va tien hanh xoa cover image khoi he thong
					$cover_image = $this->getItem($arrParam,array('task'=>'admin-get-deleting-project-coverimage'));
					$upload_dir = FILES_PATH . '/projects/cover-images';
					$upload = new Zendvn_File_Upload();
					$upload->removeFile($upload_dir . '/small/' . $cover_image);
					$upload->removeFile($upload_dir . '/medium/' . $cover_image);
					$upload->removeFile($upload_dir . '/original/' . $cover_image);
					
					//----- sau khi xoa het user avatar tien hanh xoa article khoi database
					$where = ' id = ' .$arrParam['id'];
					$this->delete($where);
					
					//----- tiep theo o bang news_category_article phai xoa cac row co article_id = id
					//----- cua article dang bi xoa
					$db = Zend_Registry::get('connectDb');
					$where = ' id = ' . $arrParam['id'];
					$db->delete('projects',$where);
				}

			}
		}
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot nhom khi biet id cua nhom
		if ($options['task'] == 'admin-project-info') {
			$select = $db->select()
						 ->from('projects AS p')
						 ->joinLeft('project_category AS pc', 'p.project_category_id = pc.id','pc.category_name')
						 ->where('p.id = ?',$arrParam['id'],INTEGER)
						 ->group('p.id');
			
			
			$result = $db->fetchRow($select);
		}
		
		//----- lay ten cover_image cua project dang bi xoa de xoa cover_image
		if ($options['task'] == 'admin-get-deleting-project-coverimage') {
			$db = Zend_Registry::get('connectDb');
			$select = $db->select()
						 ->from('projects AS p',array('p.cover_image'))
						 ->where('p.id = ?',$arrParam['id'],INTEGER);
			$result = $db->fetchOne($select);
		}
		
		//----- lay order lon nhat
		if ($options['task'] == 'admin-get-biggest-project-order') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('projects AS p','p.order')
						 ->order('p.order DESC');
			$result = $db->fetchOne($select);
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'admin-project-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('projects AS p')
						 ->joinLeft('project_category AS pc','p.project_category_id = pc.id','pc.category_name')
						 ->group('p.id');

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
				$select->where('p.project_title LIKE ?',$keywords);
			}
			
			//----- neu co thong so loc theo project_category_id thi bo sung where cho select
			if ($ssFilter['project_category_id'] > 0) {
				$select->where('p.project_category_id = ?',$ssFilter['project_category_id'],INTEGER);
			}
			
			$result = $db->fetchAll($select);
			
		}
		
		//----- lay danh sach cac nhom co id nam trong mot mang (mang $arrParam['cid'])
		if ($options['task'] == 'admin-project-list-from-array') {
			$cid = $arrParam['cid'];
			$select = $db->select()
						 ->from('projects AS p',array('p.id','p.project_title','p.cover_image'))
						 ->where('p.id IN (?)',$cid);
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
	
	public function publishProject($arrParam = null, $options = null) {
		if (isset($arrParam['cid'])) {
			$cid = $arrParam['cid'];
		} else {
			$cid = array();
		}
		
		if (count($cid) > 0) {				//----- publish cho nhieu project
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
			
			$this->saveItem($arrParam,array('task'=>'admin-project-publish-multi-project'));
		}
		if (isset($arrParam['id'])) {		//----- publish cho mot project
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
			
			$this->saveItem($arrParam,array('task'=>'admin-project-publish-one-project'));
		}
	
	}
	
	public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-log-client-access-add') {
			$row 				= $this->fetchNew();
			
			$row->client_ip		= $_SERVER['REMOTE_ADDR'];
			$row->client_access_time	= date("Y-m-d H:i:s");
			
			$row->save();
			
		}
		
		if ($options['task'] == 'admin-project-edit') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			
			$row->project_title	= $arrParam['project_title'];
			$row->project_brief	= $arrParam['project_brief'];
			$row->project_content	= $arrParam['project_content'];
			$row->cover_image	= $arrParam['cover_image'];
			$row->status	 	= $arrParam['status'];
			$row->order		 	= $arrParam['order'];
			//----- lay user_id cua user dang login vao he thong
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->last_modified_id 	= $user_id;
			$row->last_modified_time = date("Y-m-d H:m:s");
			$row->project_category_id	= $arrParam['project_category_id'];

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