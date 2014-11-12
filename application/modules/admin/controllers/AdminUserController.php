<?php
class Admin_AdminUserController extends Zendvn_Controller_Action {
	
	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;

	//----- duong dan cua controller
	protected $_currentController;
	
	//----- duong dan cua Action mac dinh
	protected $_actionMain;
	
	//----- mang chua thong so phan trang
	protected $_paginator = array(
									'itemCountPerPage'=>10,
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
			$ssFilter->col = 'u.id';
			//----- huong sap xep
			$ssFilter->order = 'DESC';
			//----- loc user theo group id
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
		
		$template_path = TEMPLATE_PATH . "/admin/admin-v2";
		$this->loadTemplate($template_path,'template.ini','template');
	}

	public function indexAction() {
		$this->view->Title = $this->_translate->_('admin-adminuser-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		$tblUser = new Admin_Model_Users();
		$this->view->Items = $tblUser->listItem($this->_arrParam,array('task'=>'admin-user-list'));
		
		$tblGroup = new Admin_Model_UserGroup();
		$this->view->slbGroup = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list-selectbox'));

		//----- lay tong so phan tu de phan trang
		$totalUser = $tblUser->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalUser, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function addAction() {
		$this->view->Title = $this->_translate->_('admin-adduser-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- tao select box danh sach cac nhom
		$tblGroup = new Admin_Model_UserGroup();
		$this->view->slbGroup = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list-selectbox'));
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateUser();
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
				$tblUser = new Admin_Model_Users();
				$arrParam = $validator->getData(array('upload'=>true));
				$tblUser->saveItem($arrParam,array('task'=>'admin-user-add'));
				$this->_redirect($this->_actionMain);
			}

		}
		
	}
	
	public function changeStatusAction() {
		$tblUser = new Admin_Model_Users();
		$tblUser->changeStatus($this->_arrParam,array('task'=>'admin-user-change-status'));
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
		
	public function deleteAction() {
		$this->view->Title = $this->_translate->_('admin-deleteuser-index-title');
		$this->view->headTitle($this->view->Title,true);
	
		if (isset($this->_arrParam['id'])) {
			$id = $this->_arrParam['id'];
			$tblUser = new Admin_Model_Users();
			$item = $tblUser->getItem($this->_arrParam,array('task'=>'admin-user-info'));
			$this->view->Item = $item;
		}
	
		if ($this->_request->isPost()) {
			$tblUser = new Admin_Model_Users();
			$tblUser->deleteItem($this->_arrParam,array('task'=>'admin-user-delete'));
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
			$validator = new Admin_Form_ValidateUser();
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
				$tblUser = new Admin_Model_Users();
				$arrParam = $validator->getData(array('upload'=>true));
				$tblUser->saveItem($arrParam,array('task'=>'admin-user-edit'));
				$this->_redirect($this->_actionMain);
			}

		}
	}
	
	public function editYourselfAction() {
		$this->view->Title = $this->_translate->_('admin-edituser-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		$info = new Zendvn_System_Info();
		$user_id = $info->getMemberInfo('id');
		$this->_arrParam['id'] = $user_id;
		
		//----- lay thong tin hien tai cua user can chinh sua roi truyen ra view
		$tblUser = new Admin_Model_Users();
		$this->view->FormData = $tblUser->getItem($this->_arrParam,array('task'=>'admin-user-info'));
	
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateUser();
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
				$tblUser = new Admin_Model_Users();
				$arrParam = $validator->getData(array('upload'=>true));
				$tblUser->saveItem($arrParam,array('task'=>'admin-user-edit'));
				$this->_redirect($this->_currentController . '/info-yourself');
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
			$ssFilter->group_id = $this->_arrParam['group_id'];
		}
	
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function infoAction() {
		$this->view->Title = $this->_translate->_('admin-userinfo-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		$tblUser = new Admin_Model_Users();
		$this->view->Item = $tblUser->getItem($this->_arrParam,array('task'=>'admin-user-info'));
	}
	
	public function infoYourselfAction() {
		$this->view->Title = $this->_translate->_('admin-currentuserinfo-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		$info = new Zendvn_System_Info();
		$user_id = $info->getMemberInfo('id');
		$this->_arrParam['id'] = $user_id;
		
		$tblUser = new Admin_Model_Users();
		$this->view->Item = $tblUser->getItem($this->_arrParam,array('task'=>'admin-user-info'));
	}
	
	public function multiDeleteAction() {
	
		$this->view->Title = $this->_translate->_('admin-multideleteuser-index-title');
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
					$tblUser = new Admin_Model_Users();
					$items = $tblUser->listItem($this->_arrParam,array('task'=>'admin-user-list-from-array'));
					$this->view->Items = $items;
				} else {
					//-------------- du lieu post sang do nhan nut Accept -----------------------
					$cid = $this->_arrParam['cid'];
					$tblUser = new Admin_Model_Users();
					$tblUser->deleteItem($this->_arrParam,array('task'=>'admin-user-multi-delete'));
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