<?php
class Default_Form_ValidateCheckTour {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array();
	
	public function __construct() {
		$this->_arrStyle['tour_name'] = '';
		$this->_arrStyle['tour_startdate'] = '';
		$this->_arrStyle['tour_enddate'] = '';
		$this->_arrStyle['tour_customer_name'] = '';
		$this->_arrStyle['tour_customer_email'] = '';
		$this->_arrStyle['tour_customer_mobile'] = '';
		$this->_arrStyle['tour_customer_address'] = '';
	}
	
	public function validate($arrParam = array(), $options = null) {
		
		//===============================================================
		//============== kiem tra tour name ==========================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
				  ->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['tour_name'])) {
			$message = $validator->getMessages();
			$this->_messagesError['tour_name'] = 'Tên Tour: ' . current($message);
			$arrParam['tour_name'] = '';
			$this->_arrStyle['tour_name'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra start date ============================
		//===== Khong duoc rong.
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_Date(array('format'=>'dd-mm-yy')),true);
		if (!$validator->isValid($arrParam['tour_startdate'])) {
			$message = $validator->getMessages();
			$this->_messagesError['tour_startdate'] = 'Ngày khởi hành: ' . current($message);
			$arrParam['tour_startdate'] = '';
			$this->_arrStyle['tour_startdate'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra end date ============================
		//===== Khong duoc rong.
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_Date(array('format'=>'dd-mm-yy')),true);
		if (!$validator->isValid($arrParam['tour_enddate'])) {
			$message = $validator->getMessages();
			$this->_messagesError['tour_enddate'] = 'Ngày kết thúc: ' . current($message);
			$arrParam['tour_enddate'] = '';
			$this->_arrStyle['tour_enddate'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra customer name =========================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
		->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['tour_customer_name'])) {
			$message = $validator->getMessages();
			$this->_messagesError['tour_customer_name'] = 'Họ tên khách hàng: ' . current($message);
			$arrParam['tour_customer_name'] = '';
			$this->_arrStyle['tour_customer_name'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra email ===========================
		//===== duoc rong. Phai la dia chi email.
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_EmailAddress(),true);
		if (!$validator->isValid($arrParam['tour_customer_email'])) {
			$message = $validator->getMessages();
			$this->_messagesError['tour_customer_email'] = 'Email: ' . current($message);
			$arrParam['tour_customer_email'] = '';
			$this->_arrStyle['tour_customer_email'] = 'border: 1px solid red;';
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
		if (!$validator->isValid($arrParam['tour_customer_mobile'])) {
			$message = $validator->getMessages();
			$this->_messagesError['tour_customer_mobile'] = 'Mobile: ' . current($message);
			$arrParam['tour_customer_mobile'] = '';
			$this->_arrStyle['tour_customer_mobile'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra contact address ==========================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
				  ->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['tour_customer_address'])) {
			$message = $validator->getMessages();
			$this->_messagesError['tour_customer_address'] = 'Địa chỉ: ' . current($message);
			$arrParam['tour_customer_address'] = '';
			$this->_arrStyle['tour_customer_address'] = 'border: 1px solid red;';
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