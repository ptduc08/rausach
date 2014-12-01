<?php
class Default_Model_MenuLink extends Zend_Db_Table {
	protected $_name = 'menu_links';
	protected $_primary = 'id';



	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');

		//----- lay id, category_name, parent_category_id cua tat ca cac doi tuong (phuc vu cho menu header)
		//----- chi lay cac category duoc publish
		if ($options['task'] == 'menulink-recursive') {
			$select = $db->select()
			->from('menu_links',array('id','link_name','url','parent_id'))
			->where('publish = ?',1,INTEGER)
			;
			$result = $db->fetchAll($select);
			//$result[0] = '-- Select a Category --';
			//----- sap xep lai mang $result theo khoa
			ksort($result);
		}

		return $result;
	}


}