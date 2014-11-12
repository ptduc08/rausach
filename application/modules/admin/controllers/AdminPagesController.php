<?php
class Admin_AdminPagesController extends Zendvn_Controller_Action {
	
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
			$ssFilter->col = 'p.id';
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
		$this->view->Title = $this->_translate->_('admin-pages-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay danh sach tat ca page trong bang pages
		$tblPages = new Admin_Model_Pages();		
		$allPages = $tblPages->listItem($this->_arrParam,array('task'=>'admin-page-list'));
		$this->view->Items = $allPages;
		
		//----- lay tong so phan tu de phan trang
		$totalPages = $tblPages->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalPages, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function addAction() {
		$this->view->Title = $this->_translate->_('admin-page-add-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay order lon nhat trong bang page truyen ra view
		$tblPages = new Admin_Model_Pages();
		$lastPageOrder = $tblPages->getItem($this->_arrParam,array('task'=>'admin-get-biggest-page-order'));
		$this->view->lastPageOrder = $lastPageOrder;
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidatePage();
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
				$tblPages = new Admin_Model_Pages();
				$arrParam = $validator->getData(array('upload'=>true));
				$tblPages->saveItem($arrParam,array('task'=>'admin-page-add'));
				$this->_redirect($this->_actionMain);
			}

		}
		
	}
	
	public function changeLockStatusAction() {
		$tblPages = new Admin_Model_Pages();
		$tblPages->changeLockStatus($this->_arrParam,array('task'=>'admin-page-change-lock-status'));
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function deleteAction() {
		$this->view->Title = $this->_translate->_('admin-page-delete-title');
		$this->view->headTitle($this->view->Title,true);
	
		if (isset($this->_arrParam['id'])) {
			$id = $this->_arrParam['id'];
			$tblPages = new Admin_Model_Pages();
			$item = $tblPages->getItem($this->_arrParam,array('task'=>'admin-page-info'));
			$this->view->Item = $item;
			//----- lay lock_status cua doi tuong can chinh sua
			$lockStatus = $tblPages->getItem($this->_arrParam,array('task'=>'admin-page-get-lock-status'));
			$this->view->lockStatus = $lockStatus;
		}
	
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidatePage();
			$validator->validateDelete($this->_arrParam,array('task'=>'validate-delete-page'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
					
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh xoa news category
				$tblPages = new Admin_Model_Pages();
				$tblPages->deleteItem($this->_arrParam,array('task'=>'admin-page-delete'));
				$this->_redirect($this->_actionMain);
			}
			
		}
	}
	
	public function editAction() {
		$this->view->Title = $this->_translate->_('admin-page-edit-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay thong tin hien tai cua page can chinh sua roi truyen ra view
		$tblPages = new Admin_Model_Pages();
		$pageInfo = $tblPages->getItem($this->_arrParam,array('task'=>'admin-page-info'));
		$this->view->FormData = $pageInfo;
		
		//----- lay lock_status cua doi tuong can chinh sua
		$lockStatus = $tblPages->getItem($this->_arrParam,array('task'=>'admin-page-get-lock-status'));
		$this->view->lockStatus = $lockStatus;
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidatePage();
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
				$arrParam = $validator->getData(array('upload'=>true));
				$tblPages->saveItem($arrParam,array('task'=>'admin-page-edit'));
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
	
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function infoAction() {
		$this->view->Title = $this->_translate->_('admin-page-info-title');
		$this->view->headTitle($this->view->Title,true);
		//----- lay thong tin cua bang hien tai dua ra view
		$tblPages = new Admin_Model_Pages();
		$thisPage = $tblPages->getItem($this->_arrParam,array('task'=>'admin-page-info'));

		$this->view->Item = $thisPage;
	}
	
	public function multiDeleteAction() {
	
		$this->view->Title = $this->_translate->_('admin-page-deletemulti-title');
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
					$tblPages = new Admin_Model_Pages();
					$items = $tblPages->listItem($this->_arrParam,array('task'=>'admin-page-list-from-array'));
					$this->view->Items = $items;
					//----- lay lock_status cua doi tuong can chinh sua
					$lockStatus = $tblPages->getItem($this->_arrParam,array('task'=>'admin-page-get-lock-status'));
					$this->view->lockStatus = $lockStatus;
					
				} else {
					//-------------- du lieu post sang do nhan nut Accept -----------------------
					$tblPages = new Admin_Model_Pages();
					
					$cid = $this->_arrParam['cid'];
					$validator = new Admin_Form_ValidatePage();
					$validator->validateDelete($this->_arrParam,array('task'=>'validate-delete-multi-page'));
					if ($validator->isError()) {
						//----- neu validate du lieu co loi thi lay mang loi truyen ra view
						$message = $validator->getMessageError();
						$newCid = array();
						$newMessageError = array();
						foreach ($message as $key=>$val) {
							if ($val == 'ok') {
								//----- validate thanh cong, tien hanh xoa page
								$tblPages->deleteItem(array('id'=>$key),array('task'=>'admin-page-delete'));
					
							} else {
								//----- validate xay ra loi. Gui key va messageError
								//----- cua no sang mang newCid va newMessageError
								$newCid[] = $key;
								$newMessage[$key] = $val;
							}
						}
						if (count($newMessage) > 0) {
							//----- trong cac page duoc chon xoa van co page khong xoa duoc
							//----- hien thi danh sach cac page khong xoa duoc, cung voi thong bao loi
							$items = $tblPages->listItem(array('cid'=>$newCid),array('task'=>'admin-page-list-from-array'));
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
		$tblPages = new Admin_Model_Pages();
		
		//----- lay lock_status cua doi tuong can publish
		$lockStatus = $tblPages->getItem($this->_arrParam,array('task'=>'admin-page-get-lock-status'));
		if (!is_array($lockStatus)) {
			//----- truong hop publish cho mot doi tuong thi $lockStatus la mot gia tri, khong phai mot mang
			//----- kiem tra lock status. Neu trang thai bi khoa (lock_status == 1) thi canh bao
			//----- va redirect trang quay lai trang index
			if ($lockStatus == 1) {
				$alertLockStatus = $this->_translate->_('admin-pages-publish-warning');
				echo "<script>alert('" . $alertLockStatus ."'); window.location = '" . $this->_actionMain . "'</script>";
			} else {
				$tblPages->publish($this->_arrParam);
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
					$alertLockStatus = $this->_translate->_('admin-pages-publishmulti-warning');
					echo "<script>alert('" . $alertLockStatus ."'); window.location = '" . $this->_actionMain . "'</script>";
				}
			}
			if ($flag == true) {
				//----- tat ca doi tuong deu khong bi khoa. Tien hanh publish cac doi tuong
				$tblPages->publish($this->_arrParam);
				$this->_redirect($this->_actionMain);
			}
		}
		
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function sortAction() {
		$this->view->Title = $this->_translate->_('admin-pages-sort-title');
		$this->view->headTitle($this->view->Title,true);
		
		$tblPages = new Admin_Model_Pages();
		$this->view->Items = $tblPages->listItem($this->_arrParam,array('task'=>'admin-page-list'));
		
		//----- lay tong so phan tu de phan trang
		$totalPages = $tblPages->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalPages, $this->_paginator);
		$this->view->paginator = $paginator;
		
		if ($this->_request->isPost()) {
			
			$validator = new Admin_Form_ValidatePage();
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
				$tblPages = new Admin_Model_Pages();
				$arrParam = $validator->getData();
				$tblPages->sortItem($arrParam,null);
				$this->_redirect($this->_actionMain);

			}
			
		}
	}
	
}