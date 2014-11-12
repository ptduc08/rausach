<?php
class Zendvn_System_Auth {
	
	protected $_messageError = null;
	
	public function login($arrParam, $options = null) {
		//----- lay doi tuong ket noi database
		$db = Zend_Registry::get('connectDb');
		
		//----- khoi tao doi tuong Zend Auth
		$auth = Zend_Auth::getInstance();
		
		if ($auth->hasIdentity()) {
			echo 'Ban da login roi';
		}
		
		//----- thiet lap adapter doi tuong Zend Auth su dung de ket noi database
		$authAdapter = new Zend_Auth_Adapter_DbTable($db);
		
		//----- thiet lap bang chua du lieu user
		$authAdapter->setTableName('users');
		
		//----- thiet lap cot chua du lieu username
		$authAdapter->setIdentityColumn('user_name');
		
		//----- thiet lap cot chua du lieu password
		$authAdapter->setCredentialColumn('password');
		
		$select = $authAdapter->getDbSelect();
		$select->where('status = 1');
		
		$username = $arrParam['username'];
		if ($username == null) {
			$username = ' ';
		}
		$password = $arrParam['password'];
		if ($password == null) {
			$password = ' ';
		}
		
		//----- chuyen doi $password sang ma hoa md5
		$encode = new Zendvn_Encode();
		$password = $encode->password($password);
			
		//----- dua gia tri username nhan duoc vao so sanh voi database
		$authAdapter->setIdentity($username);
		//----- dua gia tri password nhan duoc vao so sanh voi database
		$authAdapter->setCredential($password);
			
		//----- lay ket qua truy van cua Zend Auth
		$result = $auth->authenticate($authAdapter);
		
		$flag = false;
		if (!$result->isValid()) {
			$errormsg = $result->getMessages();
			$this->_messageError = current($errormsg);
		} else {
			$flag = true;
			//----- luu thong tin tai khoan tu database dua vao session
			//----- lay het cac cot tru cot password
			$data = $authAdapter->getResultRowObject(null,array('password'));
			$auth->getStorage()->write($data);
		}
		
		return $flag;
	}
	
	public function logout($arrParam = null, $options = null) {
		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
	}
	
	public function getError() {
		return $this->_messageError;
	}
}