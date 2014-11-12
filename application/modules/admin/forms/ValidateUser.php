<?php
class Admin_Form_ValidateUser {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle = array(
								'user_name'=>'',
								'password'=>'',
								're_password'=>'',
								'user_avatar'=>'',
								'group_id'=>'min-width: 200px;',
								'email'=>'',
								'first_name'=>'',
								'last_name'=>'',
								'birthday'=>'',
								'sign'=>'');
	
	public function __construct() {
		$this->_arrStyle['user_name'] = '';
		$this->_arrStyle['password'] = '';
		$this->_arrStyle['re_password'] = '';
		$this->_arrStyle['user_avatar'] = '';
		$this->_arrStyle['group_id'] = '';
		$this->_arrStyle['email'] = '';
		$this->_arrStyle['first_name'] = '';
		$this->_arrStyle['last_name'] = '';
		$this->_arrStyle['birthday'] = '';
		$this->_arrStyle['sign'] = '';
		

	}
	
	public function validate($arrParam = array(), $options = null) {

		//===============================================================
		//============== kiem tra group_id ==============================
		//===== bat buoc phai chon 1 nhom khi tao user ==================
		//===============================================================
		if ($arrParam['group_id'] == 0) {
			$this->_messagesError['group_id'] = 'Group: Please choose a group';
			$this->_arrStyle['group_id'] = 'min-width: 200px; border: 1px solid red;';
		}
		
		//===============================================================
		//========== kiem tra user_name =================================
		//===== khong duoc rong. do dai 3 den 32 ky tu. Chi duoc chua a-z, A-Z, -, _, .
		//===== khong duoc ton tai trong database (tru chinh no trong truong hop
		//===== action la edit)
		//===============================================================
		switch ($arrParam['action']) {
			case 'add':
				$options = array('table'=>'users','field'=>'user_name');
				break;
			case 'edit':
				$clause = ' id != ' . $arrParam['id'];
				$options = array('table'=>'users','field'=>'user_name','exclude'=>$clause);
				break;
			case 'edit-yourself':
				$clause = ' id != ' . $arrParam['id'];
				$options = array('table'=>'users','field'=>'user_name','exclude'=>$clause);
				break;
			default:
				$options = array('table'=>'users','field'=>'user_name');
		}
		
		$validator = new Zend_Validate();
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(3,32),true)
				  ->addValidator(new Zend_Validate_Regex('#^[a-zA-Z0-9\-_\.]+$#'),true)
				  ->addValidator(new Zend_Validate_Db_NoRecordExists($options));
		if (!$validator->isValid($arrParam['user_name'])) {
			$message = $validator->getMessages();
			$this->_messagesError['user_name'] = 'Username: ' . current($message);
			$arrParam['user_name'] = '';
			$this->_arrStyle['user_name'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra user_avatar ===========================
		//===== chi duoc co duoi gif, jpg, png. Kich thuoc tu 2KB den 2048KB
		//===============================================================
		$upload = new Zend_File_Transfer_Adapter_Http();
		$fileInfo = $upload->getFileInfo('user_avatar');
		$fileName = $fileInfo['user_avatar']['name'];
		if (!empty($fileName)) {
			//----- co file duoc upload. Tien hanh kiem tra
			$upload->addValidator('Extension',true,array('gif','jpg','png'),'user_avatar');
			$upload->addValidator('Size',true,array('min'=>'2KB','max'=>'2048KB'),'user_avatar');
			if (!$upload->isValid('user_avatar')) {
				$message = $upload->getMessages();
				$this->_messagesError['user_avatar'] = 'User Avatar: ' . current($message);
				$this->_arrStyle['user_avatar'] = 'border: 1px solid red;';
			}
		} else {
			//----- neu action la add thi bao loi, bat buoc phai upload cover image cho mot tin tuc
			//----- con neu la edit thi khong bao loi, giu nguyen cover image cu
			if ($arrParam['action'] == 'add') {
				$this->_messagesError['user_avatar'] = 'User Avatar: Please choose and upload a user avatar';
				$this->_arrStyle['user_avatar'] = 'width: 300px;border: 1px solid red;';
			}			
		}
		
		//===============================================================
		//============== kiem tra password ===========================
		//===== khong duoc trong. Do dai tu 3 den 32 ky tu
		//===== chi duoc chua: a-z, A-Z, 0-9, ! @ # $ % ^ & * ( ) + -
		//===============================================================
		
		//----- kiem tra trong truong hop action la edit, mat khau de trong
		//----- thi khong can validate, coi nhu mat khau nguoi dung giu nguyen
		$flag = false;
		switch ($arrParam['action']) {
			case 'add':
				$flag = true;
				break;
			case 'edit':
				if (!empty($arrParam['password'])) {
					$flag = true;
				}
				break;
			case 'edit-yourself':
				if (!empty($arrParam['password'])) {
					$flag = true;
				}
				break;
			default:
				break;
		}
		
		if ($flag == true) {
			$validator = new Zend_Validate();
			$validator->addValidator(new Zend_Validate_NotEmpty(),true)
					  ->addValidator(new Zend_Validate_StringLength(3,32),true)
					  ->addValidator(new Zend_Validate_Regex('#^[a-zA-Z0-9!\@\#\$\%\^\&\&\*\(\)\-\+]+$#'),true);
			if (!$validator->isValid($arrParam['password'])) {
				$message = $validator->getMessages();
				$this->_messagesError['password'] = 'Password: ' . current($message);
				$this->_arrStyle['password'] = 'border: 1px solid red;';
			}
		}
		
		//===============================================================
		//============== kiem tra password confirm ======================
		//===== kiem tra hai mat khau nhap co giong nhau khong
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zendvn_Validate_ConfirmPassword($arrParam['password']),true);
		if (!$validator->isValid($arrParam['re_password'])) {
			$message = $validator->getMessages();
			$this->_messagesError['re_password'] = 'Password Confirm: ' . current($message);
			$this->_arrStyle['re_password'] = 'border: 1px solid red;';
		}
		
		
		//===============================================================
		//============== kiem tra email ===========================
		//===== khong duoc rong. Phai la dia chi email. Khong duoc ton tai trong database
		//===== tru chinh no trong truong hop action la edit
		//===============================================================
		switch ($arrParam['action']) {
			case 'add':
				$options = array('table'=>'users','field'=>'email');
				break;
			case 'edit':
				$clause = ' id != ' . $arrParam['id'];
				$options = array('table'=>'users','field'=>'email','exclude'=>$clause);
				break;
			case 'edit-yourself':
				$clause = ' id != ' . $arrParam['id'];
				$options = array('table'=>'users','field'=>'email','exclude'=>$clause);
				break;
			default:
				$options = array('table'=>'users','field'=>'email');
				break;
		}
		
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_EmailAddress(),true)
				  ->addValidator(new Zend_Validate_Db_NoRecordExists($options),true);
		if (!$validator->isValid($arrParam['email'])) {
			$message = $validator->getMessages();
			$this->_messagesError['email'] = 'Email: ' . current($message);
			$arrParam['email'] = '';
			$this->_arrStyle['email'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra first_name ============================
		//===== Khong duoc rong. Chieu dai tu 2 den 32 ky tu ============
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(2,30),true);
		if (!$validator->isValid($arrParam['first_name'])) {
			$message = $validator->getMessages();
			$this->_messagesError['first_name'] = 'First Name: ' . current($message);
			$arrParam['first_name'] = '';
			$this->_arrStyle['first_name'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra last_name =============================
		//===== Khong duoc rong. Chieu dai tu 2 den 32 ky tu ============
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(2,30),true);
		if (!$validator->isValid($arrParam['last_name'])) {
			$message = $validator->getMessages();
			$this->_messagesError['last_name'] = 'Last Name: ' . current($message);
			$arrParam['last_name'] = '';
			$this->_arrStyle['last_name'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra birthday ==============================
		//===== Khong duoc rong.
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_Date(array('format'=>'dd-mm-yy')),true);
		if (!$validator->isValid($arrParam['birthday'])) {
			$message = $validator->getMessages();
			$this->_messagesError['birthday'] = 'Birthday: ' . current($message);
			$arrParam['birthday'] = '';
			$this->_arrStyle['birthday'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra sign ==================================
		//===== Duoc rong. Chieu dai tu 0 den 1000 ky tu ================
		//===============================================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_StringLength(0,1000),true);
		if (!$validator->isValid($arrParam['sign'])) {
			$message = $validator->getMessages();
			$this->_messagesError['sign'] = 'Signiture: ' . current($message);
			$arrParam['sign'] = 'Enter your sign';
			$this->_arrStyle['sign'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//============== kiem tra status ================================
		//===============================================================
		if (empty($arrParam['status']) || !isset($arrParam['status'])) {
			$arrParam['status'] = 1;
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
			$user_avatar_name = $this->uploadFile();
			$this->_arrData['user_avatar'] = $user_avatar_name;
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
		//----- khai bao duong dan den thu muc chua user avatar duoc upload len
		$upload_dir = FILES_PATH . '/users/user-avatar';
		
		$upload = new Zendvn_File_Upload();
		$fileInfo = $upload->getFileInfo('user_avatar');
		$fileName = $fileInfo['user_avatar']['name'];
		if (!empty($fileName)) {
			//----- neu nguoi dung chon anh user avatar thi tien hanh upload len server
			$user_avatar_name = $upload->upload('user_avatar', $upload_dir . '/original',
												 array('task'=>'rename'), 'useravatar_');
			
			//----- tien hanh resize user avatar
			$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $user_avatar_name);
			$thumb->resize(100,100)->save($upload_dir . '/small/' . $user_avatar_name);
			$thumb = Zendvn_File_Images::create($upload_dir . '/original/' . $user_avatar_name);
			$thumb->resize(450,450)->save($upload_dir . '/medium/' . $user_avatar_name);
			
			//----- neu action la edit thi sau khi upload avatar moi, tien hanh xoa user avatar cu
			if ($this->_arrData['action'] == 'edit') {
				$upload->removeFile($upload_dir . '/small/' . $this->_arrData['current_user_avatar']);
				$upload->removeFile($upload_dir . '/medium/' . $this->_arrData['current_user_avatar']);
				$upload->removeFile($upload_dir . '/original/' . $this->_arrData['current_user_avatar']);
			}
			
		} else {
			//----- truong hop action la edit. Nguoi dung khong upload anh moi
			//----- tra ve ten file avatar hien tai va luu lai vao database
			if ($this->_arrData['action'] == 'edit') {
				$user_avatar_name = $this->_arrData['current_user_avatar'];
			}
			if ($this->_arrData['action'] == 'edit-yourself') {
				$user_avatar_name = $this->_arrData['current_user_avatar'];
			}
		}

		return $user_avatar_name;
	}
}