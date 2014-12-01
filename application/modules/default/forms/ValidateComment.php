<?php
class Default_Form_ValidateComment {

	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;

	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;

	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array();

	public function __construct() {
		$this->_arrStyle['name'] = '';
		$this->_arrStyle['email'] = '';
		$this->_arrStyle['comment'] = '';

	}

	public function validate($arrParam = array(), $options = null) {

		//===============================================================
		//============== kiem tra contact title ==========================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
		->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['contact_title'])) {
			$message = $validator->getMessages();
			$this->_messagesError['name'] = 'Họ và tên: ' . current($message);
			$arrParam['name'] = '';
			$this->_arrStyle['name'] = 'border: 1px solid red;';
		}

		//===============================================================
		//============== kiem tra contact name ==========================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
		->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['comment'])) {
			$message = $validator->getMessages();
			$this->_messagesError['comment'] = 'Bình luận: ' . current($message);
			$arrParam['comment'] = '';
			$this->_arrStyle['comment'] = 'border: 1px solid red;';
		}



		//===============================================================
		//============== kiem tra email ===========================
		//===== duoc rong. Phai la dia chi email.
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
		->addValidator(new Zend_Validate_EmailAddress(),true);
		if (!$validator->isValid($arrParam['email'])) {
			$message = $validator->getMessages();
			$this->_messagesError['email'] = 'Email: ' . current($message);
			$arrParam['email'] = '';
			$this->_arrStyle['email'] = 'border: 1px solid red;';
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