<?php
class Admin_AdminGroupController extends Zendvn_Controller_Action {
	
	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;

	//----- duong dan cua controller
	protected $_currentController;
	
	//----- duong dan cua Action mac dinh
	protected $_actionMain;
	
	//----- mang chua thong so phan trang
	protected $_paginator = array(
									'itemCountPerPage'=>5,
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
			//----- cot sap xep mac dinh
			$ssFilter->col = 'g.id';
			//----- huong sap xep
			$ssFilter->order = 'DESC';
		}
		//----- dua cac gia tri trong session ssFilter vao mang tham so _arrParam
		$this->_arrParam['ssFilter']['keywords'] = $ssFilter->keywords;
		$this->_arrParam['ssFilter']['col'] = $ssFilter->col;
		$this->_arrParam['ssFilter']['order'] = $ssFilter->order;
		
		//----- truyen ra view
		$this->view->arrParam = $this->_arrParam;
		$this->view->currentController = $this->_currentController;
		$this->view->actionMain = $this->_actionMain;
		
		$template_path = TEMPLATE_PATH . "/admin/admin-v2";
		$this->loadTemplate($template_path,'template.ini','template');
	}
	
	public function indexAction() {
		$this->view->Title = $this->_translate->_('admin-admingroup-index-title');
		$this->view->headTitle($this->view->Title,true);

		//$tblGroup = new Admin_Model_UserGroup();
		//$this->view->Items = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list'));
		
		$tblGroup = new Admin_Model_UserGroup();
		$this->view->Items = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list'));
		
		//----- lay tong so phan tu de phan trang
		$totalGroup = $tblGroup->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalGroup, $this->_paginator);
		$this->view->paginator = $paginator;
		
		
	}
	
	public function addAction() {
		$this->view->Title = $this->_translate->_('admin-group-add-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- tao select box danh sach cac group
		$tblGroup = new Admin_Model_UserGroup();
		$this->view->slbGroup = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list-selectbox-parent-group'));
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateGroup();
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
				$tblGroup = new Admin_Model_UserGroup();
				$arrParam = $validator->getData(array('upload'=>true));
				$tblGroup->saveItem($arrParam,array('task'=>'admin-group-add'));
				$this->_redirect($this->_actionMain);
			}

		}
	}
	
	public function changeStatusAction() {
		$tblGroup = new Admin_Model_UserGroup();
		$tblGroup->changeStatus($this->_arrParam,array('task'=>'admin-change-status'));
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function changeAcpAction() {
		$tblGroup = new Admin_Model_UserGroup();
		$tblGroup->changeStatus($this->_arrParam,array('task'=>'admin-change-acp'));
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function deleteAction() {
		$this->view->Title = $this->_translate->_('admin-group-delete-title');
		$this->view->headTitle($this->view->Title,true);
	
		if (isset($this->_arrParam['id'])) {
			$id = $this->_arrParam['id'];
			$tblGroup = new Admin_Model_UserGroup();
			$item = $tblGroup->getItem($this->_arrParam,array('task'=>'admin-group-info'));
			$this->view->Item = $item;
		}
	
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateGroup();
			$validator->validateDelete($this->_arrParam,array('task'=>'validate-delete-group'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
			
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh xoa group
				$tblGroup = new Admin_Model_UserGroup();
				$tblGroup->deleteItem($this->_arrParam,array('task'=>'admin-group-delete'));
				$this->_redirect($this->_actionMain);
			}
			
			
		}
	}
	
	public function editAction() {
		$this->view->Title = $this->_translate->_('admin-group-edit-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- tao select box danh sach cac group tru nhom hien tai
		//----- de cho nguoi dung chon nhom cha cua nhom hien tai		
		$tblGroup = new Admin_Model_UserGroup();
		$this->view->slbGroup = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list-selectbox-parent-group'));
		
		//----- lay thong tin hien tai cua group can chinh sua roi truyen ra view
		$tblGroup = new Admin_Model_UserGroup();
		$this->view->FormData = $tblGroup->getItem($this->_arrParam,array('task'=>'admin-group-info'));
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateGroup();
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
				$tblGroup = new Admin_Model_UserGroup();
				$arrParam = $validator->getData();
				$tblGroup->saveItem($arrParam,array('task'=>'admin-group-edit'));
				$this->_redirect($this->_actionMain);
			}

		}
	}

	public function filterAction() {
		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		if ($this->_arrParam['type'] == 'search') {
			if ($this->_arrParam['key'] == 1) {
				$ssFilter->keywords = trim($this->_arrParam['keywords']);
			} else {
				$ssFilter->keywords = '';
			}
		}
		
		if ($this->_arrParam['type'] == 'order') {
			$ssFilter->col = $this->_arrParam['col'];
			$ssFilter->order = $this->_arrParam['by'];
		}

		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function infoAction() {
		$this->view->Title = $this->_translate->_('admin-group-info-title');
		$this->view->headTitle($this->view->Title,true);
		
		$tblGroup = new Admin_Model_UserGroup();
		$this->view->Item = $tblGroup->getItem($this->_arrParam,array('task'=>'admin-group-info'));
		$this->view->memberCount = $tblGroup->getItem($this->_arrParam,array('task'=>'count-group-members'));
		$this->view->memberList = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list-members'));
		
		//----- lay thong tin parent group cua nhom hien tai va truyen ra view
		$parent_group_id = $this->view->Item['parent_group_id'];
		$parent_group = $tblGroup->getItem(array('id'=>$parent_group_id),array('task'=>'admin-group-info'));
		$this->view->parent_group = $parent_group;
	}
	
	public function multiDeleteAction() {

		$this->view->Title = $this->_translate->_('admin-group-multidelete-index-title');
		$this->view->headTitle($this->view->Title,true);
	
		if ($this->_request->isPost()) {
			if (!isset($this->_arrParam['cid'])) {
				//-------------- nhan Delete Items ma khong chon phan tu nao --------------------
				$this->_redirect($this->_actionMain);
			} else {
				if (!isset($this->_arrParam['delConfirm'])) {
					//-------------- du lieu tu trang index chuyen sang, chua nhan Accept -----------
					//----- lay danh sach cac nhom duoc chon xoa, va hien thi ra view
					$cid = $this->_arrParam['cid'];
					$this->view->cid = $cid;
					$tblGroup = new Admin_Model_UserGroup();
					$items = $tblGroup->listItem($this->_arrParam,array('task'=>'admin-group-list-from-array'));
					$this->view->Items = $items;
				} else {
					//-------------- du lieu post sang do nhan nut Accept -----------------------
					$cid = $this->_arrParam['cid'];
					$validator = new Admin_Form_ValidateGroup();
					$validator->validateDelete($this->_arrParam,array('task'=>'validate-delete-multi-group'));
					if ($validator->isError()) {
						//----- neu validate du lieu co loi thi lay mang loi truyen ra view
						$message = $validator->getMessageError();

						$newCid = array();
						$newMessageError = array();
						foreach ($message as $key=>$val) {
							if ($val == 'ok') {
								//----- group nay khong co thanh vien, tien hanh xoa group
								$tblGroup = new Admin_Model_UserGroup();
								$tblGroup->deleteItem(array('id'=>$key),array('task'=>'admin-group-delete'));
								
							} else {
								//----- group nay van con thanh vien. Gui key va messageError 
								//----- cua no sang mang newCid va newMessageError
								$newCid[] = $key;
								$newMessage[$key] = $val;
							}
						}
						if (count($newMessage) > 0) {
							//----- trong cac nhom duoc chon xoa van co nhom khong xoa duoc
							//----- hien thi danh sach cac nhom khong xoa duoc, cung voi thong bao loi
							$tblGroup = new Admin_Model_UserGroup();
							$items = $tblGroup->listItem(array('cid'=>$newCid),array('task'=>'admin-group-list-from-array'));
							$this->view->Items = $items;
							$this->view->messageError = $newMessage;
							
						} else {
							//----- xoa duoc het cac nhom duoc chon. Chuyen huong ve trang index
							$this->_redirect($this->_actionMain);
						}
					}
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