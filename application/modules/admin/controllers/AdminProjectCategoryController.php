<?php
class Admin_AdminProjectCategoryController extends Zendvn_Controller_Action {
	
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
			//----- loc news article theo news category id
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
		
		$template_path = TEMPLATE_PATH . "/admin/admin-v2";
		$this->loadTemplate($template_path,'template.ini','template');
	}

	public function indexAction() {
		$this->view->Title = $this->_translate->_('admin-projectcategory-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		$tblProjectCat = new Admin_Model_ProjectCategory();
		$this->view->Items = $tblProjectCat->listItem($this->_arrParam,array('task'=>'admin-projectcategory-list'));
		
		//----- lay tong so phan tu de phan trang
		$totalProjectCat = $tblProjectCat->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalProjectCat, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function addAction() {
		$this->view->Title = $this->_translate->_('admin-projectcategory-add-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- tao select box danh sach cac nhom
		$tblProjectCat = new Admin_Model_ProjectCategory();
		$this->view->slbProjectCat = $tblProjectCat->listItem($this->_arrParam,array('task'=>'admin-projectcategory-list-recursive-selectbox'));
		
		//----- lay order lon nhat cua doi tuong truyen ra view
		$lastProjectCatOrder = $tblProjectCat->getItem($this->_arrParam,array('task'=>'admin-get-biggest-projectcategory-order'));
		$this->view->lastProjectCatOrder = $lastProjectCatOrder;
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateProjectCategory();
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
				$tblProjectCat = new Admin_Model_ProjectCategory();
				$arrParam = $validator->getData();
				$tblProjectCat->saveItem($arrParam,array('task'=>'admin-projectcategory-add'));
				$this->_redirect($this->_actionMain);

			}
			
		}
		
	}
	
	public function changeLockStatusAction() {
		$tblProjectCat = new Admin_Model_ProjectCategory();
		$tblProjectCat->changeLockStatus($this->_arrParam,array('task'=>'admin-projectcategory-change-lock-status'));
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function changeStatusAction() {
		$tblProjectCat = new Admin_Model_ProjectCategory();
		$tblProjectCat->changeStatus($this->_arrParam,array('task'=>'admin-projectcategory-change-status'));
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function deleteAction() {
		$this->view->Title = $this->_translate->_('admin-projectcategory-delete-title');
		$this->view->headTitle($this->view->Title,true);
		
		$tblProjectCat = new Admin_Model_ProjectCategory();
		//----- lay lock_status cua project category can chinh sua
		$lockStatus = $tblProjectCat->getItem($this->_arrParam,array('task'=>'admin-projectcategory-get-lock-status'));
		$this->view->lockStatus = $lockStatus;
	
		if (isset($this->_arrParam['id'])) {
			$id = $this->_arrParam['id'];
			$item = $tblProjectCat->getItem($this->_arrParam,array('task'=>'admin-projectcategory-info'));
			$this->view->Item = $item;
		}
	
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateProjectCategory();
			$validator->validateDelete($this->_arrParam,array('task'=>'validate-delete-projectcategory'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
			
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh xoa news category
				$tblProjectCat->deleteItem($this->_arrParam,array('task'=>'admin-projectcategory-delete'));
				$this->_redirect($this->_actionMain);
			}
		}
	}
	
	public function editAction() {
		$this->view->Title = $this->_translate->_('admin-projectcategory-edit-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay thong tin hien tai cua doi tuong can chinh sua roi truyen ra view
		$tblProjectCat = new Admin_Model_ProjectCategory();
		$projectCatInfo = $tblProjectCat->getItem($this->_arrParam,array('task'=>'admin-projectcategory-info'));
		$this->view->FormData = $projectCatInfo;
		
		//----- lay lock_status cua doi tuong can chinh sua
		$lockStatus = $tblProjectCat->getItem($this->_arrParam,array('task'=>'admin-projectcategory-get-lock-status'));
		$this->view->lockStatus = $lockStatus;
		
		//----- tao select box danh sach cac category
		$this->view->slbProjectCat = $tblProjectCat->listItem($this->_arrParam,array('task'=>'admin-projectcategory-list-recursive-selectbox'));
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateProjectCategory();
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
				$tblProjectCat = new Admin_Model_ProjectCategory();
				$arrParam = $validator->getData();
				$tblProjectCat->saveItem($arrParam,array('task'=>'admin-projectcategory-edit'));
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
			$ssFilter->group_id = $this->_arrParam['group_id'];
		}
	
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function infoAction() {
		$this->view->Title = $this->_translate->_('admin-projectcategory-info-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay thong tin ve category duoc chon
		$tblProjectCat = new Admin_Model_ProjectCategory();
		$this->view->Item = $tblProjectCat->getItem($this->_arrParam,array('task'=>'admin-projectcategory-info'));
		
		//----- dem so phan tu co trong category nay
		$this->view->projectCount = $tblProjectCat->getItem($this->_arrParam,array('task'=>'count-projectcategory-members'));
		
	}
	
	public function multiDeleteAction() {
	
		$this->view->Title = $this->_translate->_('admin-projectcategory-deletemulti-title');
		$this->view->headTitle($this->view->Title,true);
		
		$tblProjectCat = new Admin_Model_ProjectCategory();
		//----- lay lock_status cua project category can chinh sua
		$lockStatus = $tblProjectCat->getItem($this->_arrParam,array('task'=>'admin-projectcategory-get-lock-status'));
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
					$items = $tblProjectCat->listItem($this->_arrParam,array('task'=>'admin-projectcategory-list-from-array'));
					$this->view->Items = $items;
				} else {
				//-------------- du lieu post sang do nhan nut Accept -----------------------
					$cid = $this->_arrParam['cid'];
					$validator = new Admin_Form_ValidateProjectCategory();
					$validator->validateDelete($this->_arrParam,array('task'=>'validate-delete-multi-projectcategory'));
					if ($validator->isError()) {
						//----- neu validate du lieu co loi thi lay mang loi truyen ra view
						$message = $validator->getMessageError();

						$newCid = array();
						$newMessageError = array();
						foreach ($message as $key=>$val) {
							if ($val == 'ok') {
								//----- category nay khong co phan tu nao, tien hanh xoa category
								$tblProjectCat->deleteItem(array('id'=>$key),array('task'=>'admin-projectcategory-delete'));
								
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
							$items = $tblProjectCat->listItem(array('cid'=>$newCid),array('task'=>'admin-projectcategory-list-from-array'));
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
		$tblProjectCat = new Admin_Model_ProjectCategory();
	
		//----- lay lock_status cua doi tuong can publish
		$lockStatus = $tblProjectCat->getItem($this->_arrParam,array('task'=>'admin-projectcategory-get-lock-status'));
		if (!is_array($lockStatus)) {
			//----- truong hop publish cho mot doi tuong thi $lockStatus la mot gia tri, khong phai mot mang
			//----- kiem tra lock status. Neu trang thai bi khoa (lock_status == 1) thi canh bao
			//----- va redirect trang quay lai trang index
			if ($lockStatus == 1) {
				$alertLockStatus = $this->_translate->_('admin-projectcategory-publish-warning');
				echo "<script>alert('" . $alertLockStatus ."'); window.location = '" . $this->_actionMain . "'</script>";
			} else {
				$tblProjectCat->publish($this->_arrParam);
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
					$alertLockStatus = $this->_translate->_('admin-projectcategory-publishmulti-lockalert');
					echo "<script>alert('" . $alertLockStatus ."'); window.location = '" . $this->_actionMain . "'</script>";
				}
			}
			if ($flag == true) {
				//----- tat ca doi tuong deu khong bi khoa. Tien hanh publish cac doi tuong
				$tblProjectCat->publish($this->_arrParam);
				$this->_redirect($this->_actionMain);
			}
		}
	
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function sortAction() {
		$this->view->Title = $this->_translate->_('admin-projectcategory-sort-title');
		$this->view->headTitle($this->view->Title,true);
		
		$tblProjectCat = new Admin_Model_ProjectCategory();
		$this->view->Items = $tblProjectCat->listItem($this->_arrParam,array('task'=>'admin-projectcategory-list'));
		
		//----- lay tong so phan tu de phan trang
		$totalProjectCat = $tblProjectCat->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalProjectCat, $this->_paginator);
		$this->view->paginator = $paginator;
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateProjectCategory();
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
				$tblProjectCat = new Admin_Model_ProjectCategory();
				$arrParam = $validator->getData();
				$tblProjectCat->sortItem($arrParam,null);
				$this->_redirect($this->_actionMain);

			}
			
		}
		
	}
	
}