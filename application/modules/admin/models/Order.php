<?php
class Admin_Model_Order extends Zend_Db_Table {
	protected $_name = 'orders';
	protected $_primary = 'id';

	public function countItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$ssFilter = $arrParam['ssFilter'];
		$select = $db->select()
		->from('orders AS p',array('COUNT(p.id) AS total'));

		//----- neu co tu khoa tim kiem thi bo sung them where cho select
		if (!empty($ssFilter['keywords'])) {
			$keywords = '%' .$ssFilter['keywords'] . '%';
			$select->where('p.product_name LIKE ?',$keywords);
				
		}

		$result = $db->fetchOne($select);
		return $result;
	}



	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');

		if ($options['task'] == 'admin-order-list') {
			$paginator = $arrParam['paginator'];
			$ssFilter = $arrParam['ssFilter'];
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
			->from('orders AS p')
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
				
				
				
			//----- neu co thong so loc theo product_category_id thi bo sung where cho select
			if (isset($ssFilter['status'])&&!empty($ssFilter['status'])) {
				$select->where('p.status = ?',$ssFilter['status'],INTEGER);
			}
				
			$result = $db->fetchAll($select);
				
		}



		return $result;
	}
	public function getItem($order_id = null, $options = null) {
		$db = Zend_Registry::get('connectDb');

		if ($options['task'] == 'admin-order-byId') {
				
			//$db = Zend_Db::factory($adapter,$config);
			$select = $db->select()
			->from('orders AS p')
			->where('p.id = ?',$order_id,INTEGER);

			$result = $db->fetchAll($select);
				
		}//var_dump($result);
		return $result[0];
	}
	public function listProductInOrder($orderid) {
		$db = Zend_Registry::get('connectDb');
		$select = $db->select()
		->from('order_product AS op')
		->joinLeft('products AS p', 'p.id = op.product_id',array('p.price','p.product_name','p.cover_image'))

		->where('op.order_id = ?',$orderid,INTEGER);
		$result = $db->fetchAll($select);
		return $result;
	}
	public function saveItem($arrParam = null, $options = null) {

		if ($options['task'] == 'admin-order-edit') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);

			$row->status 		= $arrParam['status'];;
			$row->name 			= $arrParam['name'];
			$row->address 		= $arrParam['address'];
			$row->email 		= $arrParam['email'];
			$row->mobile 		= $arrParam['mobile'];
			$row->information 	= $arrParam['information'];
			$row->total 		= $arrParam['total'];
			$row->limit_time 	= $arrParam['limit_time']; //$arrParam['limit_time'];
			$row->created_time	= $arrParam['created_time'];
			$row->save();
		}
	}
}