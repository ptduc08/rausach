<?php
class Admin_Form_ValidateTemplateVideo {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array();
	
	public function __construct() {
		$this->_arrStyle['video_link'] = 'min-width: 200px;';
	}
	
	public function validate($arrParam = array(), $options = null) {

		if ($options['task'] == 'validate-homepage-video') {
			//===============================================================
			//============== kiem tra video link ============================
			//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
			//===============================================================
			$validator = new Zend_Validate();
			$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
					  ->addValidator(new Zend_Validate_NotEmpty(),true);
			if (!$validator->isValid($arrParam['video_link'])) {
				$message = $validator->getMessages();
				$this->_messagesError['video_link'] = 'Video Link: ' . current($message);
				$arrParam['video_link'] = '';
				$this->_arrStyle['video_link'] = 'border: 1px solid red;';
			}
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
		if ($options['upload'] == true) {
			//----- neu nguoi dung goi ham getData co option upload=true
			//----- thi tien hanh upload file len server va lay ve ten file
			if ($options['task'] == 'upload-banner-image') {
				$banner_image_name = $this->uploadFile();
				$this->_arrData['imageupload'] = $banner_image_name;
			}
			if ($options['task'] == 'upload-logo-image') {
				$logo_image_name = $this->uploadFile();
				$this->_arrData['imageupload'] = $logo_image_name;
			}
		}
		return $this->_arrData;
	}
	
	//----- tra ve mang dinh dang cho cac input sau khi validate
	public function getStyle($options = null) {
		return $this->_arrStyle;
	}
	
	//===============================================================
	//===== 1. Upload image
	//===== 2. Resize image
	//===== 3. Tra ve ten tep tin duoc upload
	//===============================================================
	public function uploadFile($options = null) {
		
	}
	
}