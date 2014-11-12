<?php
class Admin_Form_ValidateDocumentFile {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array();
	
	public function __construct() {
		$this->_arrStyle['document_file'] = 'min-width: 200px;';
		$this->_arrStyle['document_name'] = '';
	}
	
	public function validate($arrParam = array(), $options = null) {

			if ($options['task'] == 'validate-document-add-new') {
				//===============================================================
				//============== kiem tra document ===========================
				//===== chi duoc co duoi gif, jpg, png. Kich thuoc tu 2KB den 2048KB
				//===============================================================
				$upload = new Zend_File_Transfer_Adapter_Http();
				$fileInfo = $upload->getFileInfo('document_file');
				$fileName = $fileInfo['document_file']['name'];
				if (!empty($fileName)) {
					//----- co file duoc upload. Tien hanh kiem tra
					//$upload->addValidator('Extension',true,array('doc','docx'),'document_file');
					$upload->addValidator('Size',true,array('min'=>'2KB','max'=>'20000KB'),'document_file');
					if (!$upload->isValid('document_file')) {
						$message = $upload->getMessages();
						$this->_messagesError['document_file'] = 'Document: ' . current($message);
						$this->_arrStyle['document_file'] = 'border: 1px solid red;';
					}
				} else {
					//----- khong co file duoc upload
					//----- neu action la add thi bao loi, bat buoc phai upload document file
					//----- con neu la edit thi khong bao loi, giu nguyen document file cu
				
					if ($arrParam['action'] == 'documents') {
						$this->_messagesError['document_file'] = 'Document: Please choose and upload a document file';
						$this->_arrStyle['document_file'] = 'width: 300px;border: 1px solid red;';
					}
				}
				
				//===============================================================
				//============== kiem tra document name =========================
				//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
				//===============================================================
				$validator = new Zend_Validate();
				$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
				->addValidator(new Zend_Validate_NotEmpty(),true);
				if (!$validator->isValid($arrParam['document_name'])) {
					$message = $validator->getMessages();
					$this->_messagesError['document_name'] = 'Document Name: ' . current($message);
					$arrParam['document_name'] = '';
					$this->_arrStyle['document_name'] = 'border: 1px solid red;';
				}
			}
			
			if ($options['task'] == 'validate-document-edit-name') {
					
				//===============================================================
				//============== kiem tra document name =========================
				//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
				//===============================================================
				$validator = new Zend_Validate();
				$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
							->addValidator(new Zend_Validate_NotEmpty(),true);
				if (!$validator->isValid($arrParam['document_name'])) {
					$message = $validator->getMessages();
					$this->_messagesError['document_name'] = 'Document Name: ' . current($message);
					$arrParam['document_name'] = '';
					$this->_arrStyle['document_name'] = 'border: 1px solid red;';
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
	//===== 1. Upload document file
	//===== 3. Tra ve ten tep tin duoc upload
	//===============================================================
	public function uploadFile($options = null) {
		
		if ($options['task'] == 'upload-document-file') {
			//----- khai bao duong dan den thu muc chua tai lieu duoc upload len
			$upload_dir = FILES_PATH . '/documents/';
			
			$upload = new Zendvn_File_Upload();
			$fileInfo = $upload->getFileInfo('document_file');
			$fileName = $fileInfo['document_file']['name'];
			if (!empty($fileName)) {
				//----- neu nguoi dung chon file thi tien hanh upload len server, vao thu muc tmp
				$document_filename = $upload->upload('document_file', FILES_PATH . '/documents/',
								array('task'=>'rename'), 'documents_' .$fileName .'_');
			}
		}

		return $document_filename;
	}
}