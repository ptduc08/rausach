<?php
class Admin_Form_ValidateGalleryImage {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array();
	
	public function __construct() {
		$this->_arrStyle['gallery_id'] = 'min-width: 200px;';
		$this->_arrStyle['gallery_image'] = '';
		$this->_arrStyle['image_title'] = '';
		$this->_arrStyle['order'] = '';
	}
	
	public function validate($arrParam = array(), $options = null) {

		//===============================================================
		//============== kiem tra gallery_id ===========================
		//===== bat buoc phai chon 1 gallery khi upload anh ===========
		//===============================================================
		if ($arrParam['gallery_id'] == 0) {
			$this->_messagesError['gallery_id'] = 'Image Gallery: Please choose a Gallery';
			$this->_arrStyle['gallery_id'] = 'min-width: 200px; border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra detail image ===========================
		//===== chi duoc co duoi gif, jpg, png. Kich thuoc tu 2KB den 2048KB
		//===============================================================
		$upload = new Zend_File_Transfer_Adapter_Http();
		$fileInfo = $upload->getFileInfo('gallery_image');
		$fileName = $fileInfo['gallery_image']['name'];
		if (!empty($fileName)) {
			//----- co file duoc upload. Tien hanh kiem tra
			$upload->addValidator('Extension',true,array('gif','jpg','png'),'gallery_image');
			$upload->addValidator('Size',true,array('min'=>'2KB','max'=>'2048KB'),'gallery_image');
			if (!$upload->isValid('gallery_image')) {
				$message = $upload->getMessages();
				$this->_messagesError['gallery_image'] = 'Image: ' . current($message);
				$this->_arrStyle['gallery_image'] = 'border: 1px solid red;';
			}
		} else {
			//----- khong co file duoc upload
			//----- neu action la add thi bao loi, bat buoc phai upload detail image cho mot gallery
			//----- con neu la edit thi khong bao loi, giu nguyen detail image cu
			if ($arrParam['action'] == 'add') {
				$this->_messagesError['gallery_image'] = 'Image: Please choose and upload a image';
				$this->_arrStyle['gallery_image'] = 'width: 300px;border: 1px solid red;';
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
			$gallery_image_name = $this->uploadFile();
			$this->_arrData['gallery_image'] = $gallery_image_name;
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
	public function uploadFile() {
		//----- khai bao duong dan den thu muc chua image duoc upload len
		$upload_dir = FILES_PATH . '/gallery/gallery-images/';
		
		$upload = new Zendvn_File_Upload();
		$fileInfo = $upload->getFileInfo('gallery_image');
		$fileName = $fileInfo['gallery_image']['name'];
		if (!empty($fileName)) {
			//----- neu nguoi dung chon anh gallery_image thi tien hanh upload len server
			$gallery_image_name = $upload->upload('gallery_image', $upload_dir . '/original',
												 array('task'=>'rename'), 'galleryimage_');
			
			//----- tien hanh resize user avatar
			$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $gallery_image_name);
			$thumb->resize(59,33)->save($upload_dir . '/small/' . $gallery_image_name);
			$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $gallery_image_name);
			$thumb->resize(105,58)->save($upload_dir . '/medium/' . $gallery_image_name);
			$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $gallery_image_name);
			$thumb->resize(613,340)->save($upload_dir . '/large/' . $gallery_image_name);
			
			//----- neu action la edit thi sau khi upload image moi, tien hanh xoa cover image cu
			if ($this->_arrData['action'] == 'edit') {
				$upload->removeFile($upload_dir . '/small/' . $this->_arrData['current_cover_image']);
				$upload->removeFile($upload_dir . '/medium/' . $this->_arrData['current_cover_image']);
				$upload->removeFile($upload_dir . '/original/' . $this->_arrData['current_cover_image']);
			}
			
		} else {
			//----- truong hop action la edit. Nguoi dung khong upload anh moi
			//----- tra ve ten file avatar hien tai va luu lai vao database
			if ($this->_arrData['action'] == 'edit') {
				$cover_image_name = $this->_arrData['current_cover_image'];
			}
		}

		return $gallery_image_name;
	}
}