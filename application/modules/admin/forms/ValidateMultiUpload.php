<?php
class Admin_Form_ValidateMultiUpload {

	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;

	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;

	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array();

	public function __construct() {
		$this->_arrStyle['product_category_id'] = 'min-width: 200px;';
		$this->_arrStyle['product_name'] = '';
		$this->_arrStyle['product_serial'] = '';
		$this->_arrStyle['price'] = '';
		$this->_arrStyle['product_detail'] = '';
		$this->_arrStyle['cover_image'] = '';
		$this->_arrStyle['order'] = '';
	}

	public function validate($arrParam = array(), $options = null) {



		//===============================================================
		//============== kiem tra product name ==========================
		//===== khong duoc rong. Chieu dai tu 0 den 255 ky tu ===========
		//===============================================================

		//===============================================================
		//============== kiem tra cover image ===========================
		//===== chi duoc co duoi gif, jpg, png. Kich thuoc tu 2KB den 2048KB
		//===============================================================
		$upload = new Zend_File_Transfer_Adapter_Http();
		foreach ($upload->getFileInfo() as $key => $value) {

			//$fileInfo = $upload->getFileInfo('cover_image');
			//$fileName = $fileInfo['cover_image']['name'];
			$fileName=$value['name'];
			if (!empty($fileName)) {
				//----- co file duoc upload. Tien hanh kiem tra
				$upload->addValidator('Extension',true,array('gif','jpg','png'),$key);
				$upload->addValidator('Size',true,array('min'=>'2KB','max'=>'2048KB'),$key);
				if (!$upload->isValid($key)) {
					$message = $upload->getMessages();
					$this->_messagesError['cover_image'] = $key.' : ' . current($message);
					$this->_arrStyle[$key] = 'border: 1px solid red;';
				}
			} else {
				//----- khong co file duoc upload
				//----- neu action la add thi bao loi, bat buoc phai upload cover image cho mot tin tuc
				//----- con neu la edit thi khong bao loi, giu nguyen cover image cu
				if ($arrParam['action'] == 'add') {
					$this->_messagesError['cover_image'] = 'Cover Image: Please choose and upload a cover image';
					$this->_arrStyle['cover_image'] = 'width: 300px;border: 1px solid red;';
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
	//===== 1. Upload user avatar
	//===== 2. Resize user avatar (100x100 va 450x450)
	//===== 3. Tra ve ten tep tin duoc upload
	//===============================================================
	public function uploadFile() {
		//----- khai bao duong dan den thu muc chua news cover image duoc upload len
		$upload_dir = FILES_PATH . '/products/cover-images';
		$rs_arr=array();
		$upload = new Zendvn_File_Upload();
		foreach ($upload->getFileInfo() as $key => $value) {

			//$fileInfo = $upload->getFileInfo('cover_image');
			//$fileName = $fileInfo['cover_image']['name'];
			$fileName=$value['name'];
			if (!empty($fileName)) {
				//----- neu nguoi dung chon anh cover image thi tien hanh upload len server
				$cover_image_name = $upload->upload($key, $upload_dir . '/original',
						array('task'=>'rename'), 'productimage_');

				//----- tien hanh resize user avatar
				$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $cover_image_name);
				$thumb->resize(59,43)->save($upload_dir . '/small/' . $cover_image_name);
				$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $cover_image_name);
				$thumb->resize(180,130)->save($upload_dir . '/medium/' . $cover_image_name);
				$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $cover_image_name);
				$thumb->resize(288,208)->save($upload_dir . '/large/' . $cover_image_name);
					
				$rs_arr[$key]=	$cover_image_name;
			}
		}
		return $rs_arr;//$cover_image_name;
	}
}