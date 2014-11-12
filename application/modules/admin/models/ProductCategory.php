<?php
class Admin_Model_ProductCategory extends Zend_Db_Table {
	protected $_name = 'product_category';
	protected $_primary = 'id';
	
	public function changeLockStatus($arrParam = null, $options = null) {
		//----- truong hop thay doi thuoc tinh status
		if ($options['task'] == 'admin-productcategory-change-lock-status') {
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
					->from('product_category AS pc',array('COUNT(pc.id) AS total'));
		
		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('pc.category_name LIKE ?',$keywords);
			
		}
		
		$result = $db->fetchOne($select);
		return $result;
	}
	
	public function deleteItem($arrParam = null, $options = null) {
		//----- truong hop xoa mot doi tuong
		if ($options['task'] == 'admin-productcategory-delete') {
			//----- goi getItem de lay ten cover_image cua service dang bi xoa
			//----- va tien hanh xoa cover_image khoi he thong
			/* $cover_image = $this->getItem($arrParam,array('task'=>'admin-get-deleting-service-coverimage'));
			$upload_dir = FILES_PATH . '/services/cover-images';
			$upload = new Zendvn_File_Upload();
			$upload->removeFile($upload_dir . '/small/' . $cover_image);
			$upload->removeFile($upload_dir . '/medium/' . $cover_image);
			$upload->removeFile($upload_dir . '/original/' . $cover_image); */
			
			//----- sau khi xoa het cover image tien hanh xoa product category khoi database
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
		if ($options['task'] == 'admin-productcategory-info') {
			$select = $db->select()
						 ->from('product_category AS pc')
						 ->joinLeft('users AS u', 'pc.created_id = u.id',array('u.user_name AS created_name'))
						 ->joinLeft('users AS u2', 'pc.last_modified_id = u2.id',array('u2.user_name AS last_modified_name'))
						 ->joinLeft('users AS u3', 'pc.publisher_id = u3.id',array('u3.user_name AS publisher_name'))
						 ->where('pc.id = ?',$arrParam['id'],INTEGER);			
			
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
		if ($options['task'] == 'admin-get-biggest-productcategory-order') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('product_category AS pc','pc.order')
						 ->order('pc.order DESC');
			$result = $db->fetchOne($select);
		}
		
		//----- lay lock_status cua service duoc chon
		if ($options['task'] == 'admin-productcategory-get-lock-status') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			if (isset($arrParam['cid']) && count($arrParam['cid'] > 0)) {
				//----- truong hop lay lock_status cua nhieu doi tuong
				$arrLockStatus = array();
				$arrCid = $arrParam['cid'];
				$select = $db->select()
							 ->from('product_category AS pc','pc.lock_status')
							 ->where('pc.id IN (?)',$arrCid);
				$result = $db->fetchAll($select);
				
			} else if (isset($arrParam['id'])) {
			//----- truong hop lay lock_status cua mot doi tuong
				$select = $db->select()
				 			 ->from('product_category AS pc','pc.lock_status')
							 ->where('pc.id = ?',$arrParam['id'],INTEGER);
				$result = $db->fetchOne($select);
			}
			
		}
		
		//----- kiem tra va tra ve so san pham thuoc mot nhom tin khi biet id cua nhom san pham do
		if ($options['task'] == 'count-productcategory-members') {
			$select = $db->select()
						 ->from('product_category AS pc')
						 ->joinLeft('products AS p', 'p.product_category_id = pc.id','COUNT(p.id) AS countproduct')
						 ->group('pc.id')
						 ->where('pc.id = ?',$arrParam['id'],INTEGER);
			$row = $db->fetchRow($select);
			$result = $row['countproduct'];
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'admin-productcategory-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('product_category AS pc');

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
				$select->where('pc.category_name LIKE ?',$keywords);
			}
			
			$result = $db->fetchAll($select);
			
		}
		
		//----- lay danh sach cac product category co id nam trong mot mang (mang $arrParam['cid'])
		if ($options['task'] == 'admin-productcategory-list-from-array') {
			$cid = $arrParam['cid'];
			$select = $db->select()
						 ->from('product_category AS pc',array('pc.id','pc.category_name','pc.lock_status'))
						 ->where('pc.id IN (?)',$cid);
			$result = $db->fetchAll($select);
		}
		
		//----- lay id va category_name cua tat ca cac nhom san pham (phuc vu cho selectbox)
		if ($options['task'] == 'admin-productcategory-list-selectbox') {
			$select = $db->select()
						 ->from('product_category',array('id','category_name'));
			$result = $db->fetchPairs($select);
			$result[0] = '-- Select a Category --';
			//----- sap xep lai mang $result theo khoa
			ksort($result);
		}
		
		//----- lay id, category_name, parent_category_id cua tat ca cac doi tuong (phuc vu cho selectbox)
		if ($options['task'] == 'admin-productcategory-list-recursive-selectbox') {
			$select = $db->select()
						 ->from('product_category',array('id','category_name','parent_category_id'))
						 ->order('order DESC');
			$result = $db->fetchAll($select);
			//$result[0] = '-- Select a Category --';
			//----- sap xep lai mang $result theo khoa
			ksort($result);
		}
		
		return $result;
	}
	
	public function publish($arrParam = null, $options = null) {
		if (isset($arrParam['cid'])) {
			$cid = $arrParam['cid'];
		} else {
			$cid = array();
		}
		
		if (count($cid) > 0) {				//----- publish cho nhieu product category
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
			
			$this->saveItem($arrParam,array('task'=>'admin-productcategory-publish-multi-productcategory'));
		}
		if (isset($arrParam['id'])) {		//----- publish cho mot product category
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
			
			$this->saveItem($arrParam,array('task'=>'admin-productcategory-publish-one-productcategory'));
		}
	
	}
	
	public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-productcategory-add') {
			$row 				= $this->fetchNew();
			$row->parent_category_id = $arrParam['parent_category_id'];
			$row->category_name	= $arrParam['category_name'];
			$row->description	= $arrParam['description'];
			$row->cover_image	= '';
			$row->publish	 	= $arrParam['publish'];
			$row->lock_status	= $arrParam['lock_status'];
			$row->order		 	= $arrParam['order'];
			//----- lay user_id cua user tao ra service nay
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->created_id 	= $user_id;
			$row->created_time	= date("Y-m-d H:i:s");
			
			$row->last_modified_id = $user_id;
			$row->last_modified_time = date("Y-m-d H:i:s");
			
			$row->publisher_id	= $user_id;;
			$row->publish_time	= date("Y-m-d H:i:s");
			
			$row->save();
			
		}
		
		if ($options['task'] == 'admin-productcategory-edit') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			
			$row->parent_category_id = $arrParam['parent_category_id'];
			$row->category_name	= $arrParam['category_name'];
			$row->description	= $arrParam['description'];
			$row->cover_image	= '';
			$row->publish	 	= $arrParam['publish'];
			$row->lock_status	= $arrParam['lock_status'];
			$row->order		 	= $arrParam['order'];
			//----- lay user_id cua user dang login vao he thong
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->last_modified_id 	= $user_id;
			$row->last_modified_time = date("Y-m-d H:i:s");
			
			$row->publisher_id	= $user_id;;
			$row->publish_time	= date("Y-m-d H:i:s");

			$row->save();

		}
		
		if ($options['task'] == 'admin-productcategory-publish-one-productcategory') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			//----- lay user_id cua user dang login vao he thong
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->publisher_id 	= $user_id;
			$row->publish_time = date("Y-m-d H:i:s");
			$row->save();
		}
		
		if ($options['task'] == 'admin-productcategory-publish-multi-productcategory') {
			$cid = $arrParam['cid'];
			if (count($cid) > 0) {
				foreach($cid as $key=>$val) {
					$procat_id 		= $val;
					$where 				= ' id = ' . $procat_id;
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