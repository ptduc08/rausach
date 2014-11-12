<?php
class Admin_Form_ValidateTemplateImage {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array();
	
	public function __construct() {
		$this->_arrStyle['imageupload'] = 'min-width: 200px;';
		$this->_arrStyle['image_link'] = '';
	}
	
	public function validate($arrParam = array(), $options = null) {

		if ($options['task'] == 'validate-banner-image') {
			//===============================================================
			//============== kiem tra banner image ===========================
			//===== chi duoc co duoi gif, jpg, png. Kich thuoc tu 2KB den 2048KB
			//===============================================================
			$upload = new Zend_File_Transfer_Adapter_Http();
			$fileInfo = $upload->getFileInfo('imageupload');
			$fileName = $fileInfo['imageupload']['name'];
			if (!empty($fileName)) {
				//----- co file duoc upload. Tien hanh kiem tra
				$upload->addValidator('Extension',true,array('gif','jpg','png','jpeg'),'imageupload');
				$upload->addValidator('Size',true,array('min'=>'2KB','max'=>'2048KB'),'imageupload');
				if (!$upload->isValid('imageupload')) {
					$message = $upload->getMessages();
					$this->_messagesError['imageupload'] = 'Image: ' . current($message);
					$this->_arrStyle['imageupload'] = 'border: 1px solid red;';
				}
			} else {
				//----- neu action la add thi bao loi, bat buoc phai upload cover image cho mot tin tuc
				//----- con neu la edit thi khong bao loi, giu nguyen cover image cu
				$this->_messagesError['imageupload'] = 'Image: Please choose and upload a image';
				$this->_arrStyle['imageupload'] = 'border: 1px solid red;';
			}
		}
		
		if ($options['task'] == 'validate-logo-image') {
			//===============================================================
			//============== kiem tra logo image ===========================
			//===== chi duoc co duoi gif, jpg, png. Kich thuoc tu 2KB den 200KB
			//===============================================================
			$upload = new Zend_File_Transfer_Adapter_Http();
			$fileInfo = $upload->getFileInfo('imageupload');
			$fileName = $fileInfo['imageupload']['name'];
			if (!empty($fileName)) {
				//----- co file duoc upload. Tien hanh kiem tra
				$upload->addValidator('Extension',true,array('gif','jpg','png','jpeg'),'imageupload');
				$upload->addValidator('Size',true,array('min'=>'2KB','max'=>'200KB'),'imageupload');
				if (!$upload->isValid('imageupload')) {
					$message = $upload->getMessages();
					$this->_messagesError['imageupload'] = 'Image: ' . current($message);
					$this->_arrStyle['imageupload'] = 'border: 1px solid red;';
				}
			} else {
				//----- neu action la add thi bao loi, bat buoc phai upload cover image cho mot tin tuc
				//----- con neu la edit thi khong bao loi, giu nguyen cover image cu
				$this->_messagesError['imageupload'] = 'Image: Please choose and upload a image';
				$this->_arrStyle['imageupload'] = 'border: 1px solid red;';
			}
		}
		
		if ($options['task'] == 'validate-companymap-image') {
			//===============================================================
			//============== kiem tra map image ===========================
			//===== chi duoc co duoi gif, jpg, png. Kich thuoc tu 2KB den 200KB
			//===============================================================
			$upload = new Zend_File_Transfer_Adapter_Http();
			$fileInfo = $upload->getFileInfo('imageupload');
			$fileName = $fileInfo['imageupload']['name'];
			if (!empty($fileName)) {
				//----- co file duoc upload. Tien hanh kiem tra
				$upload->addValidator('Extension',true,array('gif','jpg','png','jpeg'),'imageupload');
				$upload->addValidator('Size',true,array('min'=>'2KB','max'=>'2048KB'),'imageupload');
				if (!$upload->isValid('imageupload')) {
					$message = $upload->getMessages();
					$this->_messagesError['imageupload'] = 'Image: ' . current($message);
					$this->_arrStyle['imageupload'] = 'border: 1px solid red;';
				}
			} else {
				//----- neu action la add thi bao loi, bat buoc phai upload cover image cho mot tin tuc
				//----- con neu la edit thi khong bao loi, giu nguyen cover image cu
				$this->_messagesError['imageupload'] = 'Image: Please choose and upload a image';
				$this->_arrStyle['imageupload'] = 'border: 1px solid red;';
			}
		}
		
		if ($options['task'] == 'validate-advertise-image') {
			//===============================================================
			//============== kiem tra advertise image ===========================
			//===== chi duoc co duoi gif, jpg, png. Kich thuoc tu 2KB den 2048KB
			//===============================================================
			$upload = new Zend_File_Transfer_Adapter_Http();
			$fileInfo = $upload->getFileInfo('imageupload');
			$fileName = $fileInfo['imageupload']['name'];
			if (!empty($fileName)) {
				//----- co file duoc upload. Tien hanh kiem tra
				$upload->addValidator('Extension',true,array('gif','jpg','png','jpeg'),'imageupload');
				$upload->addValidator('Size',true,array('min'=>'2KB','max'=>'2048KB'),'imageupload');
				if (!$upload->isValid('imageupload')) {
					$message = $upload->getMessages();
					$this->_messagesError['imageupload'] = 'Image: ' . current($message);
					$this->_arrStyle['imageupload'] = 'border: 1px solid red;';
				}
			} else {
				//----- neu action la add thi bao loi, bat buoc phai upload cover image cho mot tin tuc
				//----- con neu la edit thi khong bao loi, giu nguyen cover image cu
				$this->_messagesError['imageupload'] = 'Image: Please choose and upload a image';
				$this->_arrStyle['imageupload'] = 'border: 1px solid red;';
			}
			
			//===============================================================
			//============== kiem tra image link ============================
			//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
			//===============================================================
			$validator = new Zend_Validate();
			$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
					  ->addValidator(new Zend_Validate_NotEmpty(),true);
			if (!$validator->isValid($arrParam['image_link'])) {
				$message = $validator->getMessages();
				$this->_messagesError['image_link'] = 'Image Link: ' . current($message);
				$arrParam['image_link'] = '';
				$this->_arrStyle['image_link'] = 'border: 1px solid red;';
			}
			
		}
		
		if ($options['task'] == 'validate-advertise-image-edit-link') {
			
			//===============================================================
			//============== kiem tra image link ============================
			//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
			//===============================================================
			$validator = new Zend_Validate();
			$validator->addValidator(new Zend_Validate_StringLength(0,255),true)
					  ->addValidator(new Zend_Validate_NotEmpty(),true);
			if (!$validator->isValid($arrParam['image_link'])) {
				$message = $validator->getMessages();
				$this->_messagesError['image_link'] = 'Image Link: ' . current($message);
				$arrParam['image_link'] = '';
				$this->_arrStyle['image_link'] = 'border: 1px solid red;';
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
		
		if ($options['task'] == 'upload-banner-image') {
			//----- khai bao duong dan den thu muc chua image duoc upload len
			$upload_dir = FILES_PATH . '/templates/banner-slide/';
			
			$upload = new Zendvn_File_Upload();
			$fileInfo = $upload->getFileInfo('imageupload');
			$fileName = $fileInfo['imageupload']['name'];
			if (!empty($fileName)) {
				//----- neu nguoi dung chon anh thi tien hanh upload len server, vao thu muc tmp
				$image_name = $upload->upload('imageupload', TEMP_PATH,
								array('task'=>'rename'), 'banner_image_' .$fileName .'_');
					
				//----- tien hanh resize user avatar
				$thumb = Zendvn_File_Images::create(TEMP_PATH . '/' . $image_name);
				$objImageSize = new Zendvn_View_Helper_ImageSize();
				$imageSize = $objImageSize->imageSize('production', 'bannerSlideImage');
				$thumb->resize($imageSize['width'],$imageSize['height'])->save($upload_dir . $image_name);
				//----- xoa anh ban dau o thu muc temp
				$upload->removeFile(TEMP_PATH . '/' . $image_name);
			}
		}
		
		if ($options['task'] == 'upload-logo-image') {
			//----- khai bao duong dan den thu muc chua image duoc upload len
			$upload_dir = FILES_PATH . '/templates/logo/';
				
			$upload = new Zendvn_File_Upload();
			$fileInfo = $upload->getFileInfo('imageupload');
			$fileName = $fileInfo['imageupload']['name'];
			if (!empty($fileName)) {
				//----- neu nguoi dung chon anh thi tien hanh upload len server, vao thu muc tmp
				$image_name = $upload->upload('imageupload', TEMP_PATH,
						array('task'=>'rename'), 'logo_');
				
				//----- xoa toan bo image trong thu muc templates/logo (do chi duoc phep co 01 anh logo)
				$upload->removeAllFile($upload_dir);
				
				//----- tien hanh resize user avatar
				$thumb = Zendvn_File_Images::create(TEMP_PATH . '/' . $image_name);
				$objImageSize = new Zendvn_View_Helper_ImageSize();
				$imageSize = $objImageSize->imageSize('production', 'headerLogoImage');
				$thumb->resize($imageSize['width'],$imageSize['height'])->save($upload_dir . $image_name);
				//----- xoa anh ban dau o thu muc temp
				$upload->removeFile(TEMP_PATH . '/' . $image_name);
			}
		}
		
		if ($options['task'] == 'upload-companymap-image') {
			//----- khai bao duong dan den thu muc chua image duoc upload len
			$upload_dir = FILES_PATH . '/templates/company-map/';
		
			$upload = new Zendvn_File_Upload();
			$fileInfo = $upload->getFileInfo('imageupload');
			$fileName = $fileInfo['imageupload']['name'];
			if (!empty($fileName)) {
				//----- neu nguoi dung chon anh thi tien hanh upload len server, vao thu muc tmp
				$image_name = $upload->upload('imageupload', TEMP_PATH,
						array('task'=>'rename'), 'company_map_');
		
				//----- xoa toan bo image trong thu muc templates/logo (do chi duoc phep co 01 anh logo)
				$upload->removeAllFile($upload_dir);
		
				//----- tien hanh resize user avatar
				$thumb = Zendvn_File_Images::create(TEMP_PATH . '/' . $image_name);
				$thumb->resize(911,307)->save($upload_dir . $image_name);
				//----- xoa anh ban dau o thu muc temp
				$upload->removeFile(TEMP_PATH . '/' . $image_name);
			}
		}
		
		if ($options['task'] == 'upload-advertise-image') {
			//----- khai bao duong dan den thu muc chua image duoc upload len
			$upload_dir = FILES_PATH . '/templates/advertise-images/';
				
			$upload = new Zendvn_File_Upload();
			$fileInfo = $upload->getFileInfo('imageupload');
			$fileName = $fileInfo['imageupload']['name'];
			if (!empty($fileName)) {
				//----- neu nguoi dung chon anh thi tien hanh upload len server, vao thu muc tmp
				$image_name = $upload->upload('imageupload', TEMP_PATH,
						array('task'=>'rename'), 'advertise_image_' .$fileName .'_');
					
				//----- tien hanh resize user avatar
				$thumb = Zendvn_File_Images::create(TEMP_PATH . '/' . $image_name);
				$objImageSize = new Zendvn_View_Helper_ImageSize();
				$imageSize = $objImageSize->imageSize('production', 'homepageAdvertiseImage');
				$thumb->resize($imageSize['width'],$imageSize['height'])->save($upload_dir . $image_name);
				//----- xoa anh ban dau o thu muc temp
				$upload->removeFile(TEMP_PATH . '/' . $image_name);
			}
		}

		return $image_name;
	}
}