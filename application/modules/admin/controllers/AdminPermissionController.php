<?php
class Admin_AdminPermissionController extends Zendvn_Controller_Action {
	
	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;

	//----- duong dan cua controller
	protected $_currentController;
	
	//----- duong dan cua Action mac dinh
	protected $_actionMain;
	
	//----- mang chua thong so phan trang
	protected $_paginator = array(
									'itemCountPerPage'=>20,
									'pageRange'=>3				
								);
	
	//----- bien chua ten session namespace
	protected $_namespace;
	
	//----- bien chua doi tuong translate
	protected $_translate;
	
	public function init() {
		//----- mang chua toan bo tham so nhan duoc o moi Action
		$this->_arrParam = $this->_request->getParams();
		
		//----- bien session luu toan bo ten cac session khac duoc tao trong qua trinh chay ung dung
		//----- moi khi co mot session duoc tao ra thi ten cua no se duoc luu vao day
		$ssAppSessionList = new Zend_Session_Namespace('app-session-list');
		
		//----- duong dan cua controller
		$this->_currentController = '/' . $this->_arrParam['module'] .
									'/' . $this->_arrParam['controller'];
		
		//----- duong dan cua Action mac dinh
		$this->_actionMain = $this->_currentController . '/index';
		
		//----- thiet lap trang hien tai cho doi tuong phan trang
		$this->_paginator['currentPage'] = $this->_request->getParam('page',1);
		$this->_arrParam['paginator'] = $this->_paginator;
		
		//----- lay bien translate tu Registry
		$this->_translate = Zend_Registry::get('Zend_Translate');
		
		//----- tao bien session luu cac du lieu nhu filter, sort...
		$this->_namespace = $this->_arrParam['module'] .'-' .$this->_arrParam['controller'];
		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		$ssAppSessionList->sessionList .= ':' .$this->_namespace;
		
		if (empty($ssFilter->col)) {
			//----- tu khoa tim kiem
			$ssFilter->keywords = '';
			//----- cot sap xep
			$ssFilter->col = 'p.name';
			//----- huong sap xep
			$ssFilter->order = 'ASC';
			//----- loc privilege theo group id
			$ssFilter->group_id = 0;
		}
		//----- dua cac gia tri trong session ssFilter vao mang tham so _arrParam
		$this->_arrParam['ssFilter']['keywords'] = $ssFilter->keywords;
		$this->_arrParam['ssFilter']['col'] = $ssFilter->col;
		$this->_arrParam['ssFilter']['order'] = $ssFilter->order;
		$this->_arrParam['ssFilter']['group_id'] = $ssFilter->group_id;
		
		//----- truyen ra view
		$this->view->arrParam = $this->_arrParam;
		$this->view->currentController = $this->_currentController;
		$this->view->actionMain = $this->_actionMain;
		
		$template_path = TEMPLATE_PATH . "/admin/system";
		$this->loadTemplate($template_path,'template.ini','template');
		
	}

	public function indexAction() {
		$this->view->Title = $this->_translate->_('admin-privilege-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- vao lan dau tien, nguoi dung chua chon nhom nao trong select box
		//----- thi khoi tao lay nhom cua nguoi dung login vao he thong
		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		if (empty($ssFilter->group_id) || $ssFilter->group_id == 0) {
			//----- lay group_id cua nhom login vao he thong, cap nhat lai bien $ssFilter
			//----- cap nhat lai mang _arrParam, truyen lai mang arrParam sang view
			$info = new Zendvn_System_Info();
			$group_id = $info->getGroupInfo('id');
			$ssFilter->group_id = $group_id;
			$this->_arrParam['ssFilter'] = $ssFilter->getIterator();
			$this->view->arrParam = $this->_arrParam;
		}

		//----- lay danh sach cac privilege cua group duoc chon
		$tblPrivileges = new Admin_Model_Privileges();
		$arrPrivilege = $tblPrivileges->listItem($this->_arrParam,array('task'=>'admin-privilege-list-all'));
		$myGroupAcl = array();
		$group_id = $this->_arrParam['ssFilter']['group_id'];
		$acl = new Zendvn_System_Acl();
		$acl->getGroupAcl($arrPrivilege, $group_id, $myGroupAcl);
		$this->view->Items = $myGroupAcl;
		
		
		
		//$this->view->Items = $tblPrivileges->listItem($this->_arrParam,array('task'=>'admin-privilege-list'));
		
		//----- tao select box danh sach cac group
		$tblGroup = new Admin_Model_UserGroup();
		$this->view->slbGroup = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list-selectbox'));		

		
		//----- lay tong so phan tu de phan trang
		$totalPrivileges = $tblPrivileges->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalPrivileges, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function addAction() {
		$this->view->Title = $this->_translate->_('admin-privilege-add-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay group_id cua nhom dang login vao he thong truyen sang group select box
		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		if ($ssFilter->group_id > 0) {
			$group_id = $ssFilter->group_id;
		} else {
			$info = new Zendvn_System_Info();
			$group_id = $info->getGroupInfo('id');
		}
		
		$this->view->FormData = array('group_id'=>$group_id,'group_privilege_id'=>0);
		
		//----- tao select box danh sach cac nhom
		$tblGroup = new Admin_Model_UserGroup();
		$this->view->slbGroup = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list-selectbox'));
		
		//----- tao select box danh sach cac privilege
		$this->_arrParam['logged_group_id'] = $group_id;
		$tblPrivileges = new Admin_Model_Privileges();
		$arrPrivilege = $tblPrivileges->listItem($this->_arrParam,array('task'=>'admin-privilege-list-all'));
		$this->_arrParam['arrPrivilege'] = $arrPrivilege;
		$this->view->slbPrivilege = $tblPrivileges->listItem($this->_arrParam,array('task'=>'admin-list-assigned-privilege-selectbox'));
		
		
		//----- lay danh sach cac privilege cua group duoc chon
		$tblPrivileges = new Admin_Model_Privileges();
		$arrPrivilege = $tblPrivileges->listItem($this->_arrParam,array('task'=>'admin-privilege-list-all'));
		$myGroupAcl = array();
		$group_id = $this->_arrParam['ssFilter']['group_id'];
		$acl = new Zendvn_System_Acl();
		$acl->getGroupAcl($arrPrivilege, $group_id, $myGroupAcl);
		$this->view->Items = $myGroupAcl;
		
		
		
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidatePrivilege();
			$validator->validate($this->_arrParam);
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
				
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh luu du lieu vao database
				$tblPrivilege = new Admin_Model_Privileges();
				$arrParam = $validator->getData();
				$tblPrivilege->saveItem($arrParam,array('task'=>'admin-group-privilege-add'));
				$this->_redirect($this->_actionMain);
			}

		}
		
	}
	
	public function deleteAction() {
		$this->view->Title = $this->_translate->_('admin-privilege-delete-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay thong tin cua doi tuong bi xoa hien thi cho nguoi dung xem
		if (isset($this->_arrParam['id'])) {
			$id = $this->_arrParam['id'];
			$tblPrivilege = new Admin_Model_Privileges();
			$item = $tblPrivilege->getItem($this->_arrParam,array('task'=>'admin-privilege-info'));
			$this->view->Item = $item;
			
			//----- lay group_name cua nhom bi xoa privilege truyen ra view
			$ssFilter = new Zend_Session_Namespace($this->_namespace);
			$group_id = $ssFilter->group_id;
			$tblGroup = new Admin_Model_UserGroup();
			$group = $tblGroup->getItem(array('id'=>$group_id),array('task'=>'admin-group-info'));
			$this->view->group_name = $group['group_name'];
		}
	
		if ($this->_request->isPost()) {
			$tblPrivilege = new Admin_Model_Privileges();
			$tblPrivilege->deleteItem($this->_arrParam,array('task'=>'admin-privilege-delete'));
			$this->_redirect($this->_actionMain);
		}
	}
	
	public function editAction() {
		$this->view->Title = $this->_translate->_('admin-edituser-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay thong tin hien tai cua user can chinh sua roi truyen ra view
		$tblUser = new Admin_Model_Users();
		$this->view->FormData = $tblUser->getItem($this->_arrParam,array('task'=>'admin-user-info'));
	
		//----- tao select box danh sach cac nhom
		$tblGroup = new Admin_Model_UserGroup();
		$this->view->slbGroup = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list-selectbox'));
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateUser($this->_arrParam);
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
				
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh luu du lieu vao database
				$tblUser = new Admin_Model_Users();
				$arrParam = $validator->getData(array('upload'=>true));
				$tblUser->saveItem($arrParam,array('task'=>'admin-user-edit'));
				$this->_redirect($this->_actionMain);
			}

		}
	}
	
	public function filterAction() {
		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		
		//----- neu filter type la tim kiem
		if ($this->_arrParam['type'] == 'search') {
			if ($this->_arrParam['key'] == 1) {
				$ssFilter->keywords = trim($this->_arrParam['keywords']);
			} else {
				$ssFilter->keywords = '';
			}
		}
		
		//----- neu filter type la tim sap xep
		if ($this->_arrParam['type'] == 'order') {
			$ssFilter->col = $this->_arrParam['col'];
			$ssFilter->order = $this->_arrParam['by'];
		}
		
		//----- neu filter type la loc theo group_id
		if ($this->_arrParam['type'] == 'group') {
			if ($this->_arrParam['group_id'] > 0) {
				//----- chi thay doi neu nguoi dung chon mot nhom, khong chon dong --Select a Group --
				$ssFilter->group_id = $this->_arrParam['group_id'];
			}
			
		}
	
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function multiDeleteAction() {
	
		$this->view->Title = $this->_translate->_('admin-privilege-deletemulti-title');
		$this->view->headTitle($this->view->Title,true);
	
		if ($this->_request->isPost()) {
			if (!isset($this->_arrParam['cid'])) {
				//-------------- nhan Delete Items ma khong chon phan tu nao --------------------
				$this->_redirect($this->_actionMain);
			} else {
				if (!isset($this->_arrParam['delConfirm'])) {
					//-------------- du lieu tu trang index chuyen sang, chua nhan Accept -----------
					$cid = $this->_arrParam['cid'];
					$this->view->cid = $cid;
					$tblPrivilege = new Admin_Model_Privileges();
					$items = $tblPrivilege->listItem($this->_arrParam,array('task'=>'admin-privilege-list-from-array'));
					$this->view->Items = $items;
					
					//----- lay group_name cua nhom bi xoa privilege truyen ra view
					$ssFilter = new Zend_Session_Namespace($this->_namespace);
					$group_id = $ssFilter->group_id;
					$tblGroup = new Admin_Model_UserGroup();
					$group = $tblGroup->getItem(array('id'=>$group_id),array('task'=>'admin-group-info'));
					$this->view->group_name = $group['group_name'];
					
				} else {
					//-------------- du lieu post sang do nhan nut Accept -----------------------
					$cid = $this->_arrParam['cid'];
					$tblPrivilege = new Admin_Model_Privileges();
					$tblPrivilege->deleteItem($this->_arrParam,array('task'=>'admin-privilege-multi-delete'));
					$this->_redirect($this->_actionMain);
				}
			}
		}
	
	}
	
	public function sortAction() {
		if ($this->_request->isPost()) {
			$tblGroup = new Admin_Model_UserGroup();
			$tblGroup->sortItem($this->_arrParam,null);
		}
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}

	
}