<?php
class Default_Model_Order extends Zend_Db_Table {
	protected $_name = 'orders';
	protected $_primary = 'id';

	public function saveItem($arrParam = null, $options = null) {
			$row = $this->fetchNew();
			$row->status 		= 'O';
			$row->name 			= $arrParam['name'];
			$row->address 		= $arrParam['address'];
			$row->email 		= $arrParam['email'];
			$row->mobile 		= $arrParam['mobile'];
			$row->information 	= $arrParam['information'];
			$row->total 		= $arrParam['total'];
			$row->limit_time 	= $arrParam['limit_time'];//$arrParam['limit_time'];
			$row->created_time	= date("Y-m-d H:i:s");
			$row->save();
			return $row->id;
	}
}