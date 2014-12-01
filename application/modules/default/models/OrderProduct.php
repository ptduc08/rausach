<?php
class Default_Model_OrderProduct extends Zend_Db_Table {
	protected $_name = 'order_product';
	protected $_primary = 'id';
	public function saveItem($arrParam = null) {
		$row = $this->fetchNew();
		$row->product_id 	= $arrParam['product_id'];
		$row->order_id 	=$arrParam['order_id'];
		$row->amount 	= $arrParam['amount'];
		$row->save();
			
	}


}