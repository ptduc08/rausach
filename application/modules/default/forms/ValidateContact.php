<?php
class Default_Form_ValidateContact {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array();
	
	public function __construct() {
		$this->_arrStyle['contact_title'] = '';
		$this->_arrStyle['contact_name'] = '';
		$this->_arrStyle['contact_address'] = '';
		$this->_arrStyle['contact_email'] = '';
		$this->_arrStyle['contact_mobile'] = '';
		$this->_arrStyle['contact_content'] = '';
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
			$this->_messagesError['contact_title'] = 'Tiêu đề: ' . current($message);
			$arrParam['contact_title'] = '';
			$this->_arrStyle['contact_title'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra contact name ==========================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
				  ->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['contact_name'])) {
			$message = $validator->getMessages();
			$this->_messagesError['contact_name'] = 'Tên của bạn: ' . current($message);
			$arrParam['contact_name'] = '';
			$this->_arrStyle['contact_name'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra contact address ==========================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
				  ->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['contact_address'])) {
			$message = $validator->getMessages();
			$this->_messagesError['contact_address'] = 'Địa chỉ: ' . current($message);
			$arrParam['contact_address'] = '';
			$this->_arrStyle['contact_address'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra email ===========================
		//===== duoc rong. Phai la dia chi email.
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_EmailAddress(),true);
		if (!$validator->isValid($arrParam['contact_email'])) {
			$message = $validator->getMessages();
			$this->_messagesError['contact_email'] = 'Email: ' . current($message);
			$arrParam['contact_email'] = '';
			$this->_arrStyle['contact_email'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra mobile ==========================
		//===== duoc rong. Chieu dai tu 0 den 20 ky tu ===========
		//===== phai la chu so
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(0,20),true)
				  ->addValidator(new Zend_Validate_Digits());
		if (!$validator->isValid($arrParam['contact_mobile'])) {
			$message = $validator->getMessages();
			$this->_messagesError['contact_mobile'] = 'Mobile: ' . current($message);
			$arrParam['contact_mobile'] = '';
			$this->_arrStyle['contact_mobile'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra contact content =======================
		//===== khong duoc rong.  =======================================
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['contact_content'])) {
			$message = $validator->getMessages();
			$this->_messagesError['contact_content'] = 'Ý kiến của bạn: ' . current($message);
			$arrParam['contact_content'] = '';
			$this->_arrStyle['contact_content'] = 'border: 1px solid red;';
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