<?php
class Admin_AdminTourController extends Zendvn_Controller_Action {
	
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
			$ssFilter->col = 't.id';
			//----- huong sap xep
			$ssFilter->order = 'DESC';
			//----- loc doi tuong theo category id
			$ssFilter->category_id = 0;
		}
		//----- dua cac gia tri trong session ssFilter vao mang tham so _arrParam
		$this->_arrParam['ssFilter']['keywords'] = $ssFilter->keywords;
		$this->_arrParam['ssFilter']['col'] = $ssFilter->col;
		$this->_arrParam['ssFilter']['order'] = $ssFilter->order;
		$this->_arrParam['ssFilter']['category_id'] = $ssFilter->category_id;
		
		//----- truyen ra view
		$this->view->arrParam = $this->_arrParam;
		$this->view->currentController = $this->_currentController;
		$this->view->actionMain = $this->_actionMain;
		
		$template_path = TEMPLATE_PATH . "/admin/system";
		$this->loadTemplate($template_path,'template.ini','template');
	}

	public function indexAction() {
		$this->view->Title = $this->_translate->_('admin-tour-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay danh sach tat ca phan tu
		$tblTour = new Admin_Model_Tour();		
		$allTours = $tblTour->listItem($this->_arrParam,array('task'=>'admin-tour-list'));
		$this->view->Items = $allTours;
		
		//----- tao select box cac category
		$tblTourCat = new Admin_Model_TourCategory();
		$this->view->slbTourCat = $tblTourCat->listItem($this->_arrParam,array('task'=>'admin-tourcategory-list-recursive-selectbox'));

		//----- lay tong so phan tu de phan trang
		$totalTour = $tblTour->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalTour, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function addAction() {
		$this->view->Title = $this->_translate->_('admin-tour-add-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- tao select box cac category
		$tblTourCat = new Admin_Model_TourCategory();
		$this->view->slbTourCat = $tblTourCat->listItem($this->_arrParam,array('task'=>'admin-tourcategory-list-recursive-selectbox'));
		
		//----- lay order lon nhat cua doi tuong truyen ra view
		$tblTour = new Admin_Model_Tour();
		$lastTourOrder = $tblTour->getItem($this->_arrParam,array('task'=>'admin-get-biggest-tour-order'));
		$this->view->lastTourOrder = $lastTourOrder;
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateTour();
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
				$tblTour = new Admin_Model_Tour();
				$arrParam = $validator->getData(array('upload'=>true));
				$tblTour->saveItem($arrParam,array('task'=>'admin-tour-add'));
				$this->_redirect($this->_actionMain);
			}

		}
		
	}
	
	public function changeLockStatusAction() {
		$tblTour = new Admin_Model_Tour();
		$tblTour->changeLockStatus($this->_arrParam,array('task'=>'admin-tour-change-lock-status'));
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function deleteAction() {
		$this->view->Title = $this->_translate->_('admin-tour-delete-title');
		$this->view->headTitle($this->view->Title,true);
	
		if (isset($this->_arrParam['id'])) {
			$id = $this->_arrParam['id'];
			$tblTour = new Admin_Model_Tour();
			$item = $tblTour->getItem($this->_arrParam,array('task'=>'admin-tour-info'));
			$this->view->Item = $item;
			//----- lay lock_status cua doi tuong can chinh sua
			$lockStatus = $tblTour->getItem($this->_arrParam,array('task'=>'admin-tour-get-lock-status'));
			$this->view->lockStatus = $lockStatus;
		}
	
		if ($this->_request->isPost()) {
			$tblTour = new Admin_Model_Tour();
			$tblTour->deleteItem($this->_arrParam,array('task'=>'admin-tour-delete'));
			$this->_redirect($this->_actionMain);
		}
	}
	
	public function editAction() {
		$this->view->Title = $this->_translate->_('admin-tour-edit-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay thong tin hien tai cua doi tuong can chinh sua roi truyen ra view
		$tblTour = new Admin_Model_Tour();
		$TourInfo = $tblTour->getItem($this->_arrParam,array('task'=>'admin-tour-info'));
		$this->view->FormData = $TourInfo;
		
		//----- lay lock_status cua doi tuong can chinh sua
		$lockStatus = $tblTour->getItem($this->_arrParam,array('task'=>'admin-tour-get-lock-status'));
		$this->view->lockStatus = $lockStatus;
		
		//----- tao select box cac category
		$tblTourCat = new Admin_Model_TourCategory();
		$this->view->slbTourCat = $tblTourCat->listItem($this->_arrParam,array('task'=>'admin-tourcategory-list-recursive-selectbox'));
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateTour();
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
				$tblTour = new Admin_Model_Tour();
				$arrParam = $validator->getData(array('upload'=>true));
				$tblTour->saveItem($arrParam,array('task'=>'admin-tour-edit'));
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
		
		//----- neu filter type la loc theo category id
		if ($this->_arrParam['type'] == 'tourcategory') {
			$ssFilter->category_id = $this->_arrParam['category_id'];
		}
	
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function infoAction() {
		$this->view->Title = $this->_translate->_('admin-tour-info-title');
		$this->view->headTitle($this->view->Title,true);
		//----- lay thong tin cua doi tuong hien tai dua ra view
		$tblTour = new Admin_Model_Tour();
		$thisTour = $tblTour->getItem($this->_arrParam,array('task'=>'admin-tour-info'));		
		
		$this->view->Item = $thisTour;

	}
	
	public function multiDeleteAction() {
	
		$this->view->Title = $this->_translate->_('admin-tour-deletemulti-title');
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
					$tblTour = new Admin_Model_Tour();
					$items = $tblTour->listItem($this->_arrParam,array('task'=>'admin-tour-list-from-array'));
					$this->view->Items = $items;
					//----- lay lock_status cua doi tuong can chinh sua
					$lockStatus = $tblTour->getItem($this->_arrParam,array('task'=>'admin-tour-get-lock-status'));
					$this->view->lockStatus = $lockStatus;
				} else {
					//-------------- du lieu post sang do nhan nut Accept -----------------------
					$cid = $this->_arrParam['cid'];
					$tblTour = new Admin_Model_Tour();
					$tblTour->deleteItem($this->_arrParam,array('task'=>'admin-tour-multi-delete'));
					$this->_redirect($this->_actionMain);
				}
			}
		}
	
	}
	
	public function publishAction() {
		$tblTour = new Admin_Model_Tour();
		
		//----- lay lock_status cua doi tuong can publish
		$lockStatus = $tblTour->getItem($this->_arrParam,array('task'=>'admin-tour-get-lock-status'));
		if (!is_array($lockStatus)) {
			//----- truong hop publish cho mot doi tuong thi $lockStatus la mot gia tri, khong phai mot mang
			//----- kiem tra lock status. Neu trang thai bi khoa (lock_status == 1) thi canh bao
			//----- va redirect trang quay lai trang index
			if ($lockStatus == 1) {
				$alertLockStatus = $this->_translate->_('admin-tour-publish-warning');
				echo "<script>alert('" . $alertLockStatus ."'); window.location = '" . $this->_actionMain . "'</script>";
			} else {
				$tblTour->publish($this->_arrParam);
				$this->_redirect($this->_actionMain);
			}
		} else if (is_array($lockStatus) && count($lockStatus) > 0) {
			//----- truong hop publish cho nhieu doi tuong thi $lockStatus tra ve la mot mang
			//----- kiem tra mang lock status. Neu ton tai 1 page trang thai bi khoa (lock_status == 1) thi canh bao
			//----- va redirect trang quay lai trang index
			$flag = true;
			foreach ($lockStatus as $key=>$val) {
				if ($val['lock_status'] == 1) {
					$flag = false;
					$alertLockStatus = $this->_translate->_('admin-tour-publishmulti-warning');
					echo "<script>alert('" . $alertLockStatus ."'); window.location = '" . $this->_actionMain . "'</script>";
				}
			}
			if ($flag == true) {
				//----- tat ca doi tuong deu khong bi khoa. Tien hanh publish cac doi tuong
				$tblTour->publish($this->_arrParam);
				$this->_redirect($this->_actionMain);
			}
		}
		
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function sortAction() {
		$this->view->Title = $this->_translate->_('admin-tour-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay danh sach tat ca phan tu
		$tblTour = new Admin_Model_Tour();		
		$allTours = $tblTour->listItem($this->_arrParam,array('task'=>'admin-tour-list'));
		$this->view->Items = $allTours;
		
		//----- tao select box cac category
		$tblTourCat = new Admin_Model_TourCategory();
		$this->view->slbTourCat = $tblTourCat->listItem($this->_arrParam,array('task'=>'admin-tourcategory-list-recursive-selectbox'));

		//----- lay tong so phan tu de phan trang
		$totalTour = $tblTour->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalTour, $this->_paginator);
		$this->view->paginator = $paginator;
		
		if ($this->_request->isPost()) {
			
			$validator = new Admin_Form_ValidateTour();
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
				$tblTour = new Admin_Model_Tour();
				$arrParam = $validator->getData();
				$tblTour->sortItem($arrParam,null);
				$this->_redirect($this->_actionMain);

			}
			
		}
	}
	
}