<?php
class Admin_Model_SystemSetting extends Zend_Db_Table {
	protected $_name = 'system_setting';
	protected $_primary = 'id';
	
	
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');

		//----- lay thong tin cua mot nhom khi biet id cua nhom
			$select = $db->select()
						 ->from('system_setting AS g')
						;
			$result = $db->fetchAll($select);
		
		
		//----- kiem tra va tra ve so user thuoc mot nhom khi biet id cua nhom do
	
		return $result;
	}
	
	
	
	public function saveItem($id = null, $value=null) {
		
			$where = ' id = '.$id;
			$row 				= $this->fetchRow($where);
			$row->value 	=  $value;
			//$row->ESIC = $arrParam['ESIC'];
			//$row->avatar 		= $arrParam['avatar'];
			//$row->ranking		= $arrParam['ranking'];
			
						
			$row->save();
		
	}


}