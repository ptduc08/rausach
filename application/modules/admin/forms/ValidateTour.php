<?php
class Admin_Form_ValidateTour {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array();
	
	public function __construct() {
		$this->_arrStyle['title'] = '';
		$this->_arrStyle['brief'] = '';
		$this->_arrStyle['content'] = '';
		$this->_arrStyle['duration'] = '';
		$this->_arrStyle['price'] = '';
		$this->_arrStyle['start_time'] = '';
		$this->_arrStyle['start_location'] = '';
		$this->_arrStyle['tour_path'] = '';
		$this->_arrStyle['cover_image'] = '';
		$this->_arrStyle['project_category_id'] = 'min-width: 200px;';
		$this->_arrStyle['publish'] = '';
		$this->_arrStyle['order'] = '';
	}
	
	public function validate($arrParam = array(), $options = null) {

		//===============================================================
		//============== kiem tra category_id ===========================
		//===== bat buoc phai chon 1 category ===========
		//===============================================================
		/* if ($arrParam['category_id'] == 0) {
			$this->_messagesError['project_category_id'] = 'Project Category: Please choose a Category';
			$this->_arrStyle['project_category_id'] = 'min-width: 200px; border: 1px solid red;';
		} */
		
		//===============================================================
		//============== kiem tra title ============================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,1000),true)
				  ->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['title'])) {
			$message = $validator->getMessages();
			$this->_messagesError['title'] = 'Tour Title: ' . current($message);
			$arrParam['title'] = '';
			$this->_arrStyle['title'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra brief ============================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,1000),true)
				  ->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['brief'])) {
			$message = $validator->getMessages();
			$this->_messagesError['brief'] = 'Tour Brief: ' . current($message);
			$arrParam['brief'] = '';
			$this->_arrStyle['brief'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra content ==========================
		//===== khong duoc rong.  ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['content'])) {
			$message = $validator->getMessages();
			$this->_messagesError['content'] = 'Tour Content: ' . current($message);
			$arrParam['content'] = '';
			$this->_arrStyle['content'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra duration ============================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,1000),true)
				  ->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['duration'])) {
			$message = $validator->getMessages();
			$this->_messagesError['duration'] = 'Tour Duration: ' . current($message);
			$arrParam['duration'] = '';
			$this->_arrStyle['duration'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra price ============================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,1000),true)
				  ->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['price'])) {
			$message = $validator->getMessages();
			$this->_messagesError['price'] = 'Tour Price: ' . current($message);
			$arrParam['price'] = '';
			$this->_arrStyle['price'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra start time ============================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,1000),true)
		->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['start_time'])) {
			$message = $validator->getMessages();
			$this->_messagesError['start_time'] = 'Tour Start Time: ' . current($message);
			$arrParam['start_time'] = '';
			$this->_arrStyle['start_time'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra start location ============================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,1000),true)
				  ->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['start_location'])) {
			$message = $validator->getMessages();
			$this->_messagesError['start_location'] = 'Tour Start Location: ' . current($message);
			$arrParam['start_location'] = '';
			$this->_arrStyle['start_location'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra start location ============================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,1000),true)
		->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['start_location'])) {
			$message = $validator->getMessages();
			$this->_messagesError['start_location'] = 'Tour Start Location: ' . current($message);
			$arrParam['start_location'] = '';
			$this->_arrStyle['start_location'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra tour path ============================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,1000),true)
		->addValidator(new Zend_Validate_NotEmpty(),true);
		if (!$validator->isValid($arrParam['tour_path'])) {
			$message = $validator->getMessages();
			$this->_messagesError['tour_path'] = 'Tour Path: ' . current($message);
			$arrParam['tour_path'] = '';
			$this->_arrStyle['tour_path'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra cover image ===========================
		//===== chi duoc co duoi gif, jpg, png. Kich thuoc tu 2KB den 2048KB
		//===============================================================
		$upload = new Zend_File_Transfer_Adapter_Http();
		$fileInfo = $upload->getFileInfo('cover_image');
		$fileName = $fileInfo['cover_image']['name'];
		if (!empty($fileName)) {
			//----- co file duoc upload. Tien hanh kiem tra
			$upload->addValidator('Extension',true,array('gif','jpg','png'),'cover_image');
			$upload->addValidator('Size',true,array('min'=>'2KB','max'=>'2048KB'),'cover_image');
			if (!$upload->isValid('cover_image')) {
				$message = $upload->getMessages();
				$this->_messagesError['cover_image'] = 'Cover Image: ' . current($message);
				$this->_arrStyle['cover_image'] = 'border: 1px solid red;';
			}
		} else {
			//----- neu action la add thi bao loi, bat buoc phai upload cover image cho mot tin tuc
			//----- con neu la edit thi khong bao loi, giu nguyen cover image cu
			if ($arrParam['action'] == 'add') {
				$this->_messagesError['cover_image'] = 'Cover Image: Please choose and upload a cover image';
				$this->_arrStyle['cover_image'] = 'width: 300px;border: 1px solid red;';
			}			
		}
		
		//===============================================================
		//========== kiem tra order =================================
		//===== khong duoc rong. Phai la so nguyen >= 0
		//===============================================================
		$validator = new Zend_Validate();
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_Int(),true);
		if (!$validator->isValid($arrParam['order'])) {
			$message = $validator->getMessages();
			$this->_messagesError['order'] = 'Order: ' . current($message);
			$arrParam['order'] = '';
			$this->_arrStyle['order'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra publish ================================
		//===============================================================
		if (empty($arrParam['publish']) || !isset($arrParam['publish'])) {
			$arrParam['publish'] = 0;
		}
		
		//===============================================================
		//============== kiem tra lock status ===========================
		//===============================================================
		if (empty($arrParam['lock_status']) || !isset($arrParam['lock_status'])) {
			$arrParam['lock_status'] = 0;
		}
		
		//===============================================================
		//===== TRUYEN CAC GIA TRI CUA CAC INPUT SAU KHI VALIDATE
		//===== VAO MANG $_arrData DE TRUYEN NGUOC LAI RA FORM
		//===============================================================
		$this->_arrData = $arrParam;
	}
	
	public function validateOrder($arrParam = array(), $options = null) {
		//===============================================================
		//========== kiem tra order =================================
		//===== khong duoc rong. Phai la so nguyen >= 0
		//===============================================================
		$validator = new Zend_Validate();
	
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_Int(),true);
		$arrOrder = $arrParam['order'];
		if (count($arrOrder) > 0) {
			foreach ($arrOrder as $key=>$val) {
				if (!$validator->isValid($arrOrder[$key])) {
					$message = $validator->getMessages();
					$this->_messagesError['order[' . $key . ']'] = 'Order: ' . current($message);
					$arrParam['order'][$key] = '';
					$this->_arrStyle['order'][$key] = 'border: 1px solid red;';
				}
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
			$cover_image_name = $this->uploadFile();
			$this->_arrData['cover_image'] = $cover_image_name;
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
	//===== 3. Tra ve ten image duoc upload
	//===============================================================
	public function uploadFile() {
		//----- khai bao duong dan den thu muc chua news cover image duoc upload len
		$upload_dir = FILES_PATH . '/tour/cover-images';
		
		$upload = new Zendvn_File_Upload();
		$fileInfo = $upload->getFileInfo('cover_image');
		$fileName = $fileInfo['cover_image']['name'];
		if (!empty($fileName)) {
			//----- neu nguoi dung chon anh cover image thi tien hanh upload len server
			$cover_image_name = $upload->upload('cover_image', $upload_dir . '/original',
												 array('task'=>'rename'), 'tourimage_');
			
			//----- lay kich thuoc anh thiet lap trong application/image-size
			$objImageSize = new Zendvn_View_Helper_ImageSize();
			$imageSize_large = $objImageSize->imageSize('production', 'tour_cover_image_large');
			$imageSize_medium = $objImageSize->imageSize('production', 'tour_cover_image_medium');
			$imageSize_small = $objImageSize->imageSize('production', 'tour_cover_image_small');	
			
			$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $cover_image_name);
			$thumb->resize($imageSize_small['width'],$imageSize_small['height'])->save($upload_dir . '/small/' . $cover_image_name);
			$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $cover_image_name);
			$thumb->resize($imageSize_medium['width'],$imageSize_medium['height'])->save($upload_dir . '/medium/' . $cover_image_name);
			$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $cover_image_name);
			$thumb->resize($imageSize_large['width'],$imageSize_large['height'])->save($upload_dir . '/large/' . $cover_image_name);
			
			//----- neu action la edit thi sau khi upload image moi, tien hanh xoa cover image cu
			if ($this->_arrData['action'] == 'edit') {
				$upload->removeFile($upload_dir . '/small/' . $this->_arrData['current_cover_image']);
				$upload->removeFile($upload_dir . '/medium/' . $this->_arrData['current_cover_image']);
				$upload->removeFile($upload_dir . '/large/' . $this->_arrData['current_cover_image']);
				$upload->removeFile($upload_dir . '/original/' . $this->_arrData['current_cover_image']);
			}
			
		} else {
			//----- truong hop action la edit. Nguoi dung khong upload anh moi
			//----- tra ve ten file avatar hien tai va luu lai vao database
			if ($this->_arrData['action'] == 'edit') {
				$cover_image_name = $this->_arrData['current_cover_image'];
			}
		}

		return $cover_image_name;
	}
}