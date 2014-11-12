<?php
class Zendvn_Plugin_Permission extends Zend_Controller_Plugin_Abstract {
	
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		$moduleName = $this->_request->getModuleName();
		$auth = Zend_Auth::getInstance();
		$flagAdmin = false;
		if ($moduleName == 'admin') {
			//---- nguoi dung truy cap vao module 'admin'
			$flagAdmin = true;
		}
		
		$flagPage = '';
		if ($flagAdmin == true ) {
			if (!$auth->hasIdentity()) {
				//----- neu nguoi dung truy cap vao module 'admin' ma chua dang nhap thi 
				//----- chuyen nguoi dung toi trang dang nhap
				$flagPage = 'login';
			} else {
				//----- nguoi dung da thuc hien thao tac dang nhap
				$info = new Zendvn_System_Info();
				$group_acp = $info->getGroupInfo('group_acp');
				$action_name = $this->_request->getActionName();
				if ($group_acp !=1) {
					//----- neu nhom nguoi dung dang nhap khong co quyen truy cap Admin Control Panel
					//----- thi chuyen huong ve action no-access. Ngoai tru action logout cho nguoi dung thoat
					if ($action_name != 'logout') {
						$flagPage = 'no-access';
					}
					
				} else {
					//----- nguoi dung dang nhap thanh cong, co quyen truy cap acp
					//----- lay gia tri cot permission. Neu permisson = 'Full Access' thi bo qua khong kiem tra ACL
					$permission = $info->getGroupInfo('permission');
					if ($permission != 'Full Access') {
						//----- neu permission khac 'Full Access' thi bat dau kiem tra ACL cua nhom do
						//----- lay mang cap phep cua group login vao he thong, duoc luu o session 'info'
						$aclInfo = $info->getAclInfo();
						//----- thiet lap ACL cho nhom login vao he thong tu mang acl nhan duoc
						$acl = new Zendvn_System_Acl();
						$acl->buildAcl($aclInfo);
						$arrParam = $this->_request->getParams();
						if ($acl->isAllow($arrParam) == false) {
							$flagPage = 'no-access';
						}
					}
					
					
				}
			}

		}
		
		if ($flagPage != '') {
			if ($flagPage == 'login') {
				$this->_request->setModuleName('admin');
				$this->_request->setControllerName('public');
				$this->_request->setActionName('login');
			}
			if ($flagPage == 'no-access') {
				$this->_request->setModuleName('admin');
				$this->_request->setControllerName('public');
				$this->_request->setActionName('no-access');
			}
		}
		
	}
	
}