<?php
class Default_Model_Product extends Zend_Db_Table {
	protected $_name = 'products';
	protected $_primary = 'id';
	
	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$ssFilter = $arrParam['ssFilter'];
		if ($options['task'] == 'count-item-all') {
			$select = $db->select()
			->from('products AS p',array('COUNT(p.id) AS total'));
			
			//----- neu co tu khoa tim kiem thi bo sung them where cho select
			if (!empty($ssFilter['keywords'])) {
				$keywords = '%' .$ssFilter['keywords'] . '%';
				$select->where('p.product_name LIKE ?',$keywords);
			
			}
			
			$result = $db->fetchOne($select);
		}
		
		return $result;
	}
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot product khi biet id cua product
		if ($options['task'] == 'default-product-info') {
			$select = $db->select()
						 ->from('products AS p')
						 ->joinLeft('product_category AS pc', 'p.product_category_id = pc.id',array('pc.id AS pc_id','pc.category_name'))
						 ->where('p.publish = 1')
						 ->where('p.id = ?',$arrParam['id'],INTEGER);
			
			$result = $db->fetchRow($select);
		}

		return $result;
	}
	
	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		
		if ($options['task'] == 'default-product-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			
			//$db = Zend_Db::factory($adapter,$config);
			if ($arrParam['category_id'] == 0) {
				$select = $db->select()
							 ->from('products AS p')
							 ->joinLeft('product_category AS pc','p.product_category_id = pc.id','pc.id AS category_id')
							 ->where('p.publish = 1')
							// ->order('p.order ASC')
							 ->group('p.id');
			} else {
				$select = $db->select()
							 ->from('products AS p')
							 ->joinLeft('product_category AS pc', 'p.product_category_id = pc.id','pc.id AS category_id')
							 ->where('p.product_category_id = ?',$arrParam['category_id'],INTEGER)
							 ->where('p.publish = 1')
							// ->order('p.created_time DESC')
							// ->order('p.order ASC')
							 ->group('p.id');
			}
			
			//----- neu co thong so sap xep thi bo sung order de sap xep
			//if (!empty($ssFilter['col']) && !empty($ssFilter['col'])) {
			//	$select->order($ssFilter['col'] .' ' . $ssFilter['order']);
			//}
				
				
			//----- neu co thong so phan trang thi bo sung limitPage cho select
			if ($paginator['itemCountPerPage'] > 0) {
				$currentPage = $paginator['currentPage'];
				$itemCountPerPage = $paginator['itemCountPerPage'];
				$select->limitPage($currentPage, $itemCountPerPage);
			}
				
			//----- neu co tu khoa tim kiem thi bo sung where cho select
			if (!empty($ssFilter['keywords'])) {
				$keywords = '%' .$ssFilter['keywords'] . '%';
				$select->where('na.product_name LIKE ?',$keywords);
			}
			//Loc theo gia
			if(!empty($ssFilter['price'])){
				switch ($ssFilter['price']) {
		                case 1:
		                   	$select->where('p.price < ?',5000);
		                    break;
		                case 2:
		                    $select->where('p.price >= ?',5000);
		                    $select->where('p.price < ?',10000);
		                    break;
		                case 3:
		                    $select->where('p.price >= ?',10000);
		                    $select->where('p.price < ?',15000);
		                    break;
		                 case 4:
		                    $select->where('p.price >= ?',15000);
		                    $select->where('p.price < ?',20000);
		                    break; 
		                case 5:
		                    $select->where('p.price >= ?',20000);
						    break;       
		               }
			}
			//Loc theo danh muc
			if(!empty($ssFilter['filter_cate'])){
				switch ($ssFilter['filter_cate']) {
		                case 1:
		                   	$select->order('p.created_time DESC');
		                    break;
		                case 2:
		                    $select->order('p.view_counter DESC');
		                   	break;
		        }
			} 
			
			$result = $db->fetchAll($select);
			
		}
		
		if ($options['task'] == 'default-get-three-newest-projects') {
			$select = $db->select()
						 ->from('products AS p')
						 ->joinLeft('product_category AS pc','p.product_category_id = pc.id','pc.id AS category_id')
						 ->where('p.publish = 1')
						 ->order('p.order ASC')
						 ->group('p.id')
						 ->limit(3,0);
			$result = $db->fetchAll($select);
			//var_dump($result);
		}
		if ($options['task'] == 'news-product-list') {
			$select = $db->select()
						 ->from('products AS p')
						 ->joinLeft('product_category AS pc','p.product_category_id = pc.id','pc.id AS category_id')
						 ->where('p.publish = 1')
						 ->order('p.created_time DESC')
						// ->group('p.id')
						 ->limit(6,0);
			$result = $db->fetchAll($select);
			//var_dump($result);
		}
		if ($options['task'] == 'most_view-product-list') {
			$select = $db->select()
						 ->from('products AS p')
						 ->joinLeft('product_category AS pc','p.product_category_id = pc.id','pc.id AS category_id')
						 ->where('p.publish = 1')
						 ->order('p.view_counter DESC')
						 //->group('p.id')
						 ->limit(6,0);
			$result = $db->fetchAll($select);
			//var_dump($result);
		}
		return $result;
	}

	public function saveItem($arrParam = null, $options = null) {
		
		if ($options['task'] == 'default-news-article-increase-view-counter') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
				
			$row->view_counter	= $row->view_counter + 1;
			
			$row->save();
		}
	}
}