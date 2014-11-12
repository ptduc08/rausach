<?php
class Zendvn_System_Info {
	
	//----- ham khoi tao cua lop
	public function __construct() {
		$ns = new Zend_Session_Namespace('info');
		$ns->setExpirationSeconds(1800);
	}
	
	//----- tao thong tin cua user khi dang nhap
	public function createInfo() {
		$auth = Zend_Auth::getInstance();
		$infoAuth = $auth->getIdentity();
		
		$this->setMemberInfo($infoAuth);
		$this->setGroupInfo($infoAuth);
		$this->setAclInfo();
	}
	
	//----- huy thong tin cua user khi thoat khoi he thong
	public function destroyInfo() {
		$ns = new Zend_Session_Namespace('info');
		$ns->unsetAll();
		
		$auth = new Zendvn_System_Auth();
		$auth->logout();
		
		//----- bien session luu toan bo ten cac session khac duoc tao trong qua trinh chay ung dung
		$ssAppSessionList = new Zend_Session_Namespace('app-session-list');
		
		$strSessionList = $ssAppSessionList->sessionList;
		$arrSessionList = explode(':', $strSessionList);
		//----- huy toan bo cac session $ssFilter tao ra trong qua trinh chay ung dung
		foreach ($arrSessionList as $key=>$val) {
			$ssApp = new Zend_Session_Namespace($arrSessionList[$key]);
			$ssApp->unsetAll();
		}
		$ssAppSessionList->unsetAll();
	}
	
	//----- thiet lap thong tin cua user dang nhap vao he thong
	public function setMemberInfo($infoAuth) {
		$db = Zend_Registry::get('connectDb');
		$select = $db->select()
					->from('users')
					->where('id = ?',$infoAuth->id);
		$result = $db->fetchRow($select);
		//----- luu thong tin user vua lay duoc vao session
		$ns = new Zend_Session_Namespace('info');
		$ns->member = $result;
	}
	
	//----- thiet lap thong tin nhom cua user dang nhap vao he thong
	public function setGroupInfo($infoAuth) {
		$db = Zend_Registry::get('connectDb');
		$select = $db->select()
		->from('user_group')
		->where('id = ?',$infoAuth->group_id);
		$result = $db->fetchRow($select);
		//----- luu thong tin group cua user vua lay duoc vao session
		$ns = new Zend_Session_Namespace('info');
		$ns->group = $result;
	}
	
	//----- thiet lap phan quyen cho nhom
	public function setAclInfo() {
		$acl = new Zendvn_System_Acl();
		$acl->createPrivilegeArray();
		$acl->createRole();
	}
	
	//----- lay thong tin phan quyen cua nhom
	public function getAclInfo($part = null) {
		$ns = new Zend_Session_Namespace('info');
		$nsInfo = $ns->getIterator();
		if ($part == null) {
			//----- neu $part == null thi lay het thong tin cap phep trong session 'info'
			$info = $nsInfo['acl'];
		} else {
			$info = $nsInfo['acl'];
			$info = $info[$part];
		}
		return $info;
	}
	
	//----- lay thong tin cua user dang nhap vao he thong
	public function getMemberInfo($part = null) {
		$ns = new Zend_Session_Namespace('info');
		$nsInfo = $ns->getIterator();
		if ($part == null) {
			//----- neu $part == null thi lay het thong tin
			$info = $nsInfo['member'];
		} else {
			$info = $nsInfo['member'];
			$info = $info[$part];
		}	
		return $info;
	}
	
	//----- lay thong tin nhom cua user dang nhap vao he thong
	public function getGroupInfo($part = null) {
		$ns = new Zend_Session_Namespace('info');
		$nsInfo = $ns->getIterator();
		if ($part == null) {
			//----- neu $part == null thi lay het thong tin
			$info = $nsInfo['group'];
		} else {
			$info = $nsInfo['group'];
			$info = $info[$part];
		}
		return $info;
	}
	
	//----- lay tat ca thong tin cua user dang nhap vao he thong
	public function getInfo() {
		$ns = new Zend_Session_Namespace('info');
		$info = $ns->getIterator();
		return $info;
	}
}