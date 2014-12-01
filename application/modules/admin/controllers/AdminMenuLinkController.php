<?php
class Admin_AdminMenuLinkController extends Zendvn_Controller_Action {

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
			$ssFilter->col = 'pc.id';
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
		$this->view->Title = $this->_translate->_('admin-productcategory-index-title');
		$this->view->headTitle($this->view->Title,true);

		$tblMenuLink = new Admin_Model_MenuLink();
		$this->view->Items = $tblMenuLink->listItem($this->_arrParam,array('task'=>'admin-prmenulink-list'));


	}




	public function deleteAction() {
		$this->view->Title = $this->_translate->_('admin-productcategory-delete-title');
		$this->view->headTitle($this->view->Title,true);

		$tblProCat = new Admin_Model_ProductCategory();
		//----- lay lock_status cua product category can chinh sua
		$lockStatus = $tblProCat->getItem($this->_arrParam,array('task'=>'admin-productcategory-get-lock-status'));
		$this->view->lockStatus = $lockStatus;

		if (isset($this->_arrParam['id'])) {
			$id = $this->_arrParam['id'];
			$item = $tblProCat->getItem($this->_arrParam,array('task'=>'admin-productcategory-info'));
			$this->view->Item = $item;
		}

		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateProductCategory();
			$validator->validateDelete($this->_arrParam,array('task'=>'validate-delete-productcategory'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
					
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh xoa product category
				$tblProCat->deleteItem($this->_arrParam,array('task'=>'admin-productcategory-delete'));
				$this->_redirect($this->_actionMain);
			}
		}
	}

	public function editAction() {
		$this->view->Title = $this->_translate->_('admin-productcategory-edit-title');
		$this->view->headTitle($this->view->Title,true);

		//----- lay thong tin hien tai cua category can chinh sua roi truyen ra view
		$tblMenuLink = new Admin_Model_MenuLink();
		$this->view->FormData = $tblMenuLink->getItem($this->_arrParam,array('task'=>'admin-menu-edit-linkname'));
		if ($this->_request->isPost()) {
			//----- validate du lieu thanh cong. Khong co loi xay ra
			//----- tien hanh luu du lieu vao database
			$tblMenuLink->saveItem($this->_arrParam,array('task'=>'admin-menu-edit-linkname'));
			$this->_redirect($this->_actionMain);
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

		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}

	public function infoAction() {
		$this->view->Title = $this->_translate->_('admin-productcategory-info-title');
		$this->view->headTitle($this->view->Title,true);

		//----- lay thong tin ve product category duoc chon
		$tblProCat = new Admin_Model_ProductCategory();
		$this->view->Item = $tblProCat->getItem($this->_arrParam,array('task'=>'admin-productcategory-info'));

		//----- dem so san pham co trong category nay
		$this->view->productCount = $tblProCat->getItem($this->_arrParam,array('task'=>'count-productcategory-members'));

	}

	public function multiDeleteAction() {

		$this->view->Title = $this->_translate->_('admin-productcategory-deletemulti-title');
		$this->view->headTitle($this->view->Title,true);

		$tblProCat = new Admin_Model_ProductCategory();

		//----- lay lock_status cua cac product category can chinh sua
		$lockStatus = $tblProCat->getItem($this->_arrParam,array('task'=>'admin-productcategory-get-lock-status'));
		$this->view->lockStatus = $lockStatus;

		if ($this->_request->isPost()) {
			if (!isset($this->_arrParam['cid'])) {
				//-------------- nhan Delete Items ma khong chon phan tu nao --------------------
				$this->_redirect($this->_actionMain);
			} else {
				if (!isset($this->_arrParam['delConfirm'])) {
					//-------------- du lieu tu trang index chuyen sang, chua nhan Accept -----------
					$cid = $this->_arrParam['cid'];
					$this->view->cid = $cid;
					$items = $tblProCat->listItem($this->_arrParam,array('task'=>'admin-productcategory-list-from-array'));
					$this->view->Items = $items;
				} else {
					//-------------- du lieu post sang do nhan nut Accept -----------------------
					$cid = $this->_arrParam['cid'];
					$validator = new Admin_Form_ValidateProductCategory();
					$validator->validateDelete($this->_arrParam,array('task'=>'validate-delete-multi-productcategory'));
					if ($validator->isError()) {
						//----- neu validate du lieu co loi thi lay mang loi truyen ra view
						$message = $validator->getMessageError();

						$newCid = array();
						$newMessageError = array();
						foreach ($message as $key=>$val) {
							if ($val == 'ok') {
								//----- category nay khong co tin tuc, tien hanh xoa category
								$tblProCat->deleteItem(array('id'=>$key),array('task'=>'admin-productcategory-delete'));

							} else {
								//----- category nay van con tin tuc. Gui key va messageError
								//----- cua no sang mang newCid va newMessageError
								$newCid[] = $key;
								$newMessage[$key] = $val;
							}
						}
						if (count($newMessage) > 0) {
							//----- trong cac category duoc chon xoa van co category khong xoa duoc
							//----- hien thi danh sach cac category khong xoa duoc, cung voi thong bao loi
							$items = $tblProCat->listItem(array('cid'=>$newCid),array('task'=>'admin-productcategory-list-from-array'));
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

	public function publishAction() {
		$tblMenuLink = new Admin_Model_MenuLink();
		$tblMenuLink->publish($this->_arrParam);
		$this->_redirect($this->_actionMain);

	}

	public function sortAction() {
		$this->view->Title = $this->_translate->_('admin-productcategory-sort-title');
		$this->view->headTitle($this->view->Title,true);

		$tblProCat = new Admin_Model_ProductCategory();
		$this->view->Items = $tblProCat->listItem($this->_arrParam,array('task'=>'admin-productcategory-list'));

		//----- lay tong so phan tu de phan trang
		$totalProCat = $tblProCat->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalProCat, $this->_paginator);
		$this->view->paginator = $paginator;

		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateProductCategory();
			$validator->validateOrder($this->_arrParam);
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
				$tblProCat = new Admin_Model_ProductCategory();
				$arrParam = $validator->getData();
				$tblProCat->sortItem($arrParam,null);
				$this->_redirect($this->_actionMain);

			}
				
		}

	}

}