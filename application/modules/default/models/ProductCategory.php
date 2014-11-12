<?php
class Default_Model_ProductCategory extends Zend_Db_Table {
	protected $_name = 'product_category';
	protected $_primary = 'id';
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');

		//----- lay thong tin cua mot nhom khi biet id cua nhom
		if ($options['task'] == 'default-newscategory-info') {
			$select = $db->select()
						 ->from('news_category AS nc')
						 ->joinLeft('users AS u', 'nc.created_by = u.id',array('u.id AS user_id','u.user_name'))
						 ->where('nc.id = ?',$arrParam['id'],INTEGER);
			
			$result = $db->fetchRow($select);
		}
		
		//----- kiem tra va tra ve so tin tuc thuoc mot nhom tin khi biet id cua nhom tin do
		if ($options['task'] == 'count-newscategory-members') {
			$select = $db->select()
						 ->from('news_category AS nc')
						 ->joinLeft('news_category_article AS na', 'na.category_id = nc.id','COUNT(na.id) AS countnews')
						 ->group('nc.id')
						 ->where('nc.id = ?',$arrParam['id'],INTEGER);
			$row = $db->fetchRow($select);
			$result = $row['countnews'];
		}
		
		//----- lay lock_status cua doi tuong duoc chon ------------------------------------------------------------
		if ($options['task'] == 'admin-newscategory-get-lock-status') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			if (isset($arrParam['cid']) && count($arrParam['cid'] > 0)) {
				//----- truong hop lay lock_status cua nhieu doi tuong
				$arrLockStatus = array();
				$arrCid = $arrParam['cid'];
				$select = $db->select()
				->from('news_category AS nc','nc.lock_status')
				->where('nc.id IN (?)',$arrCid);
				$result = $db->fetchAll($select);
		
			} else if (isset($arrParam['id'])) {
				//----- truong hop lay lock_status cua mot doi tuong
				$select = $db->select()
				->from('news_category AS nc','nc.lock_status')
				->where('nc.id = ?',$arrParam['id'],INTEGER);
				$result = $db->fetchOne($select);
			} else {
				//-----lay lock_status cua tat ca doi tuong
				$select = $db->select()
				->from('news_category AS nc','nc.lock_status');
				$result = $db->fetchAll($select);
			}
		
		}
		
		//----- lay order lon nhat cua doi tuong ------------------------------------------------------------
		if ($options['task'] == 'admin-get-biggest-newscategory-order') {
			$db = Zend_Registry::get('connectDb');
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
						 ->from('news_category AS nc','nc.order')
						 ->order('nc.order DESC');
			$result = $db->fetchOne($select);
		}
		
		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'default-productcategory-list-all') {
			if ($arrParam['category_id'] == 0) {
				$select = $db->select()
							 ->from('product_category AS pc')
							 ->order('pc.order ASC');
			} else {
				$select = $db->select()
							 ->from('product_category AS pc')
							 ->where('id = ?',$arrParam['category_id'],INTEGER)
							 ->order('pc.order ASC');
			}
			
				
			$result = $db->fetchAll($select);
		}
		
		if ($options['task'] == 'default-newscategory-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			$select = $db->select()
						 ->from('news_category AS nc')
						 ->order('nc.order ASC');
			
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
				$select->where('nc.category_name LIKE ?',$keywords);
			}
			
			$result = $db->fetchAll($select);
		}
		
		//----- lay danh sach cac nhom co id nam trong mot mang (mang $arrParam['cid'])
		if ($options['task'] == 'admin-newscategory-list-from-array') {
			$cid = $arrParam['cid'];
			$select = $db->select()
			->from('news_category AS nc',array('nc.id','nc.category_name'))
			->where('nc.id IN (?)',$cid);
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
		
		//----- lay id, category_name, parent_category_id cua tat ca cac nhom (phuc vu cho selectbox)
		if ($options['task'] == 'admin-newscategory-list-recursive-selectbox') {
			$select = $db->select()
						 ->from('news_category',array('id','category_name','parent_category_id'));
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
		if ($options['task'] == 'admin-newscategory-add') {
			$row 				= $this->fetchNew();
			$row->category_name	= $arrParam['category_name'];
			$row->description	= $arrParam['description'];
			$row->parent_category_id = $arrParam['parent_category_id'];
			$row->created 		= date("Y-m-d H:m:s");
			
			//----- lay user_id cua user tao ra nhom nay
			$info = new Zendvn_System_Info();
			$user_id = $info->getMemberInfo('id');
			$row->created_by 	= $user_id;
			
			$row->order 		= $arrParam['order'];
			$row->publish 		= $arrParam['publish'];
			$row->lock_status	= $arrParam['lock_status'];
			
			$row->save();
		}
		
		if ($options['task'] == 'admin-newscategory-edit') {
			$where = ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			$row->category_name	= $arrParam['category_name'];
			$row->description	= $arrParam['description'];
			$row->parent_category_id = $arrParam['parent_category_id'];
			
			$row->order 		= $arrParam['order'];
			$row->publish 		= $arrParam['publish'];
			$row->lock_status	= $arrParam['lock_status'];
			
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