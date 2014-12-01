<?php
class Admin_Model_OrderProduct extends Zend_Db_Table {
	protected $_name = 'order_product';
	protected $_primary = 'id';
	public function saveItem($arrParam = null,$options=null) {
		if ($options['task'] == 'admin-order-edit') {
			$where 				= ' id = ' . $arrParam['product_order_id'];
			$row 				= $this->fetchRow($where);
			$row->amount 	= $arrParam['amount'];
			$row->save();
		}
			
	}


}