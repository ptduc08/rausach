<?php
class Admin_AdminNewsArticleController extends Zendvn_Controller_Action {
	
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
			$ssFilter->col = 'na.id';
			//----- huong sap xep
			$ssFilter->order = 'DESC';
			//----- loc user theo group id
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
		$this->view->Title = $this->_translate->_('admin-newsarticle-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay danh sach tat ca tin tuc trong bang news_article
		//----- voi moi tin tuc, truy van danh sach cac category ma no thuoc (neu co) va hien thi ra
		$tblNews = new Admin_Model_NewsArticle();		
		$allArticle = $tblNews->listItem($this->_arrParam,array('task'=>'admin-newsarticle-list'));
		if (count($allArticle) > 0) {
			foreach ($allArticle as $key=>$value) {
				$this->_arrParam['article_id'] = $value['id'];
				$articleCategory = $tblNews->listItem($this->_arrParam,array('task'=>'admin-newsarticle-list-category'));
				$value['articleCategory'] = $articleCategory;
				$allArticle[$key] = $value;
			}
		}
		$this->view->Items = $allArticle;
		
		//----- tao select box cac nhom tin tuc
		$tblNewsCat = new Admin_Model_NewsCategory();
		$this->view->slbNewsCat = $tblNewsCat->listItem($this->_arrParam,array('task'=>'admin-newscategory-list-recursive-selectbox'));

		//----- lay tong so phan tu de phan trang
		$totalNewsCat = $tblNewsCat->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalNewsCat, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function addAction() {
		$this->view->Title = $this->_translate->_('admin-newsarticle-add-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- tao select box cac nhom tin tuc
		$tblNewsCat = new Admin_Model_NewsCategory();
		$this->view->slbNewsCat = $tblNewsCat->listItem($this->_arrParam,array('task'=>'admin-newscategory-list-recursive-selectbox'));
		
		//----- lay order lon nhat trong bang tin tuc truyen ra view
		$tblNews = new Admin_Model_NewsArticle();
		$lastArticleOrder = $tblNews->getItem($this->_arrParam,array('task'=>'admin-get-biggest-article-order'));
		$this->view->lastArticleOrder = $lastArticleOrder;
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateNewsArticle();
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
				$tblNews = new Admin_Model_NewsArticle();
				$arrParam = $validator->getData(array('upload'=>true));
				$tblNews->saveItem($arrParam,array('task'=>'admin-newsarticle-add'));
				$this->_redirect($this->_actionMain);
			}

		}
		
	}
	
	public function changeLockStatusAction() {
		$tblNews = new Admin_Model_NewsArticle();
		$tblNews->changeLockStatus($this->_arrParam,array('task'=>'admin-newsarticle-change-lock-status'));
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function deleteAction() {
		$this->view->Title = $this->_translate->_('admin-newsarticle-delete-title');
		$this->view->headTitle($this->view->Title,true);
	
		if (isset($this->_arrParam['id'])) {
			$id = $this->_arrParam['id'];
			$tblNews = new Admin_Model_NewsArticle();
			$item = $tblNews->getItem($this->_arrParam,array('task'=>'admin-newsarticle-info'));
			$this->view->Item = $item;
			
			//----- lay lock_status cua doi tuong can chinh sua
			$lockStatus = $tblNews->getItem($this->_arrParam,array('task'=>'admin-newsarticle-get-lock-status'));
			$this->view->lockStatus = $lockStatus;
		}
	
		if ($this->_request->isPost()) {
			$tblNews = new Admin_Model_NewsArticle();
			$tblNews->deleteItem($this->_arrParam,array('task'=>'admin-newsarticle-delete'));
			$this->_redirect($this->_actionMain);
		}
	}
	
	public function editAction() {
		$this->view->Title = $this->_translate->_('admin-newsarticle-edit-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay thong tin hien tai cua article can chinh sua roi truyen ra view
		$tblNews = new Admin_Model_NewsArticle();
		$articleInfo = $tblNews->getItem($this->_arrParam,array('task'=>'admin-newsarticle-info'));
		$this->_arrParam['article_id'] = $articleInfo['id'];
		//----- lay danh sach cac category ID ma tin tuc tren thuoc ve roi truyen ra view
		$arrCategoryList = $tblNews->listItem($this->_arrParam,array('task'=>'admin-newsarticle-list-category-only-id'));
		$articleInfo['category_id'] = $arrCategoryList;
		$this->view->FormData = $articleInfo;
	
		//----- tao select box cac nhom tin tuc
		$tblNewsCat = new Admin_Model_NewsCategory();
		$this->view->slbNewsCat = $tblNewsCat->listItem($this->_arrParam,array('task'=>'admin-newscategory-list-recursive-selectbox'));
		
		//----- lay lock_status cua doi tuong can chinh sua
		$lockStatus = $tblNews->getItem($this->_arrParam,array('task'=>'admin-newsarticle-get-lock-status'));
		$this->view->lockStatus = $lockStatus;
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateNewsArticle();
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
				$tblNews = new Admin_Model_NewsArticle();
				$arrParam = $validator->getData(array('upload'=>true));
				$tblNews->saveItem($arrParam,array('task'=>'admin-newsarticle-edit'));
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
		if ($this->_arrParam['type'] == 'newscategory') {
			$ssFilter->category_id = $this->_arrParam['category_id'];
		}
	
		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}
	
	public function infoAction() {
		$this->view->Title = $this->_translate->_('admin-newsarticle-info-title');
		$this->view->headTitle($this->view->Title,true);
		//----- lay thong tin cua bang hien tai dua ra view
		$tblNews = new Admin_Model_NewsArticle();
		$thisArticle = $tblNews->getItem($this->_arrParam,array('task'=>'admin-newsarticle-info'));		
		//----- lay danh sach cac nhom tin ma tin tuc tren thuoc ve
		$this->_arrParam['article_id'] = $thisArticle['id'];
		$articleCategory = $tblNews->listItem($this->_arrParam,array('task'=>'admin-newsarticle-list-category'));
		$thisArticle['articleCategory'] = $articleCategory;

		$this->view->Item = $thisArticle;
	}
	
	public function multiDeleteAction() {
	
		$this->view->Title = $this->_translate->_('admin-newsarticle-multidelete-title');
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
					$tblNews = new Admin_Model_NewsArticle();
					$items = $tblNews->listItem($this->_arrParam,array('task'=>'admin-newsarticle-list-from-array'));
					$this->view->Items = $items;
					
					//----- lay lock_status cua doi tuong can chinh sua
					$lockStatus = $tblNews->getItem($this->_arrParam,array('task'=>'admin-newsarticle-get-lock-status'));
					$this->view->lockStatus = $lockStatus;
				} else {
					//-------------- du lieu post sang do nhan nut Accept -----------------------
					$cid = $this->_arrParam['cid'];
					$tblNews = new Admin_Model_NewsArticle();
					$tblNews->deleteItem($this->_arrParam,array('task'=>'admin-newsarticle-multi-delete'));
					$this->_redirect($this->_actionMain);
				}
			}
		}
	
	}
	
	public function publishAction() {
		$tblNews = new Admin_Model_NewsArticle();
		
		//----- lay lock_status cua doi tuong can publish
		$lockStatus = $tblNews->getItem($this->_arrParam,array('task'=>'admin-newsarticle-get-lock-status'));
		if (!is_array($lockStatus)) {
			//----- truong hop publish cho mot doi tuong thi $lockStatus la mot gia tri, khong phai mot mang
			//----- kiem tra lock status. Neu trang thai bi khoa (lock_status == 1) thi canh bao
			//----- va redirect trang quay lai trang index
			if ($lockStatus == 1) {
				$alertLockStatus = $this->_translate->_('admin-newsarticle-publish-warning');
				echo "<script>alert('" . $alertLockStatus ."'); window.location = '" . $this->_actionMain . "'</script>";
			} else {
				$tblNews->publish($this->_arrParam);
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
					$alertLockStatus = $this->_translate->_('admin-newsarticle-publishmulti-warning');
					echo "<script>alert('" . $alertLockStatus ."'); window.location = '" . $this->_actionMain . "'</script>";
				}
			}
			if ($flag == true) {
				//----- tat ca doi tuong deu khong bi khoa. Tien hanh publish cac doi tuong
				$tblNews->publish($this->_arrParam);
				$this->_redirect($this->_actionMain);
			}
		}
		
		$this->_helper->viewRenderer->setNoRender();
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