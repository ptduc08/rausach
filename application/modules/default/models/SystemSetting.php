<?php
class Default_Model_SystemSetting extends Zend_Db_Table {
	protected $_name = 'system_setting';
	protected $_primary = 'id';
	function getValueByName($name=null){
		$db = Zend_Registry::get('connectDb');
		$select = $db->select()
					->from('system_setting AS u','u.value')
					->where('u.name = ?',$name,STRING)
					;
		$result = $db->fetchRow($select);
		return $result['value'];
	}
}	