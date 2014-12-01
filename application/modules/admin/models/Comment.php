<?php
class Admin_Model_Comment extends Zend_Db_Table {
	protected $_name = 'customer_responses';
	protected $_primary = 'id';
	
	
	
	public function saveItem($arrParam = null, $options = null) {
			$row 				= $this->fetchNew();
			$row->name 	= $arrParam['name'];
			$row->email 	= $arrParam['email'];
			$row->comment 	= $arrParam['comment'];
			$row->post_time	= date("Y-m-d H:m:s");
			$row->product_id= $arrParam['id'];
			//----- lay dia chi IP cua may khach
			//$row->poster_ip	= $_SERVER['REMOTE_ADDR'];
			
			$row->save();
		
		
	}
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		$select = $db->select()
					->from('customer_responses AS u')
					->where('u.id = ?',$arrParam['id'],INTEGER)
					;
		$result = $db->fetchRow($select);
		return $result;
	}
	public function getAllItem() {
		$db = Zend_Registry::get('connectDb');
		$select = $db->select()
				->from('customer_responses AS u')
				->joinLeft('products AS p','p.id=u.product_id',array('p.product_name'))
					;
		$result = $db->fetchAll($select);
		return $result;
	}
	
	
}