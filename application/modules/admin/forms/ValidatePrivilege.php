<?php
class Admin_Form_ValidatePrivilege {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array(
								'group_privilege_id'=>'',
								'group_id'=>'');
	
	public function __construct() {
		$this->_arrStyle['group_privilege_id'] = '';
		$this->_arrStyle['group_id'] = '';
	}
	
	public function validate($arrParam = array(), $options = null) {
		//===============================================================
		//============== kiem tra group_id ==============================
		//===== bat buoc phai chon 1 nhom khi cap phep ==================
		//===============================================================
		if ($arrParam['group_id'] == 0) {
			$this->_messagesError['group_id'] = 'Group: Please choose a group';
			$this->_arrStyle['group_id'] = 'min-width: 200px; border: 1px solid red;';
			$arrParam['group_id'] = '0';
		}
		
		//===============================================================
		//============== kiem tra privilege_id ==========================
		//===== bat buoc phai chon 1 privilege khi cap phep =============
		//===== $arrParam['group_privilege_id'] la mot mang 
		//===============================================================
		$arrGroupPrivilege = array();
		if (isset($arrParam['group_privilege_id'])) {
			$arrGroupPrivilege = $arrParam['group_privilege_id'];
		}
		if (count($arrGroupPrivilege) == 0) {
			$this->_messagesError['group_privilege_id'] = 'Privilege: Please choose a privilege';
			$this->_arrStyle['group_privilege_id'] = 'min-width: 200px; border: 1px solid red;';
			$arrParam['group_privilege_id'] = '0';
		}
		
		//===============================================================
		//===== TRUYEN CAC GIA TRI CUA CAC INPUT SAU KHI VALIDATE
		//===== VAO MANG $_arrData DE TRUYEN NGUOC LAI RA FORM
		//===============================================================
		$this->_arrData = $arrParam;
	}
	
	//----- kiem tra du lieu validate co loi hay khong
	//----- tra ve true neu co loi. Tra ve false neu khong co loi
	public function isError() {
		if (count($this->_messagesError) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	//----- tra ve mang chua cac thong bao loi
	public function getMessageError() {
		return $this->_messagesError;
	}
	
	//----- tra ve mang chua toan bo du lieu sau khi validate
	public function getData($options = null) {
		return $this->_arrData;
	}
	
	//----- tra ve mang dinh dang cho cac input sau khi validate
	public function getStyle($options = null) {
		return $this->_arrStyle;
	}
	
}