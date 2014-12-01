<?php
class Default_Model_ProductImages extends Zend_Db_Table {
	protected $_name = 'product_images';
	protected $_primary = 'id';
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot product khi biet id cua product
		if ($options['task'] == 'default-product-image') {
			$select = $db->select()
			->from('product_images AS p')
			->where('p.product_id = ?',$arrParam['id'],INTEGER)
			->limit(5,0);
			$result = $db->fetchAll($select);
		}

		return $result;
	}
}