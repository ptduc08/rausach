<?php
class TourController extends Zendvn_Controller_Action {
	
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
			//----- cot sap xep
			$ssFilter->col = 't.id';
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
		
		$template_path = TEMPLATE_PATH . "/dreamviettravel/system";
		$this->loadTemplate($template_path,'template.ini','template');
	}
	
	public function indexAction() {
		
		$template_path = TEMPLATE_PATH . "/dreamviettravel/system";
		$this->loadTemplate($template_path,'template.ini','du-lich-trong-nuoc');
		
		//----- loc lay tat ca cac tour thuoc mot category (thuoc truc tiep hoac thuoc mot sub category nao do)
		if (!isset($this->_arrParam['id'])) {
			$this->_arrParam['ancestorCategoryID'] = 0;
			$category_id = 1;
		} else {
			$this->_arrParam['ancestorCategoryID'] = $this->_arrParam['id'];
			$category_id = $this->_arrParam['id'];
		}
		
		//----- lay thong tin cua category nay
		$tblTourCat = new Default_Model_TourCategory();
		$thisCategory = $tblTourCat->getItem(array('id'=>$category_id),array('task'=>'default-tourcategory-info'));
		$this->view->thisCategory = $thisCategory;
		
		//----- lay danh sach cac item thuoc category nay
		$tblTour = new Default_Model_Tour();
		$tourList = $tblTour->listItem($this->_arrParam,array('task'=>'default-tour-list-filter-to-category'));
		$this->view->tourList = $tourList;
		
		//----- lay tong so phan tu de phan trang
		$totalTour = $tblTour->countItem($this->_arrParam,array('task'=>'count-item-in-ancestor-category'));
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalTour, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function duLichTrongNuocAction() {
		$template_path = TEMPLATE_PATH . "/dreamviettravel/system";
		$this->loadTemplate($template_path,'template.ini','du-lich-trong-nuoc');
		
		//----- lay danh sach tat ca tour
		$tblTour = new Default_Model_Tour();
		$allTourList = $tblTour->listItem($this->_arrParam,array('task'=>'default-tour-list-all'));
		
		//----- loc lay tat ca cac tour thuoc mot category (thuoc truc tiep hoac thuoc mot sub category nao do)
		$this->_arrParam['ancestorCategoryID'] = 1;
		$tourList = $tblTour->listItem($this->_arrParam,array('task'=>'default-tour-list-filter-to-category'));
		$this->view->tourList = $tourList;

		//----- lay tong so phan tu de phan trang
		$totalTour = $tblTour->countItem($this->_arrParam,array('task'=>'count-item-in-ancestor-category'));
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalTour, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function duLichNuocNgoaiAction() {
		$template_path = TEMPLATE_PATH . "/dreamviettravel/system";
		$this->loadTemplate($template_path,'template.ini','du-lich-nuoc-ngoai');
		
		//----- lay danh sach tat ca tour
		$tblTour = new Default_Model_Tour();
		$allTourList = $tblTour->listItem($this->_arrParam,array('task'=>'default-tour-list-all'));
		
		//----- loc lay tat ca cac tour thuoc mot category (thuoc truc tiep hoac thuoc mot sub category nao do)
		$this->_arrParam['ancestorCategoryID'] = 2; //----- lay toan bo cac tour du lich nuoc ngoai
		$tourList = $tblTour->listItem($this->_arrParam,array('task'=>'default-tour-list-filter-to-category'));
		$this->view->tourList = $tourList;
		
		//----- lay tong so phan tu de phan trang
		$totalTour = $tblTour->countItem($this->_arrParam,array('task'=>'count-item-in-ancestor-category'));
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalTour, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function tourChiTietAction() {
		$template_path = TEMPLATE_PATH . "/dreamviettravel/system";
		$this->loadTemplate($template_path,'template.ini','tour-chi-tiet');
		
		//----- lay thong tin ve item
		if (!isset($this->_arrParam['id'])) {
			$itemID = 1;
		} else {
			$itemID = $this->_arrParam['id'];
		}
		$tblTour = new Default_Model_Tour();
		$thisItem = $tblTour->getItem(array('id'=>$itemID),array('task'=>'default-tour-info'));
		$this->view->thisItem = $thisItem;
		
		//----- moi lan nguoi dung xem mot tin tuc thi tang so view cua tin do len 1 gia tri
		$tblTour->saveItem($this->_arrParam,array('task'=>'default-tour-increase-view-counter'));
	}
	
	public function datTourAction() {
		$template_path = TEMPLATE_PATH . "/dreamviettravel/system";
		$this->loadTemplate($template_path,'template.ini','dat-tour');
		
		//----- lay thong tin ve item
		if (!isset($this->_arrParam['id'])) {
			$itemID = 1;
		} else {
			$itemID = $this->_arrParam['id'];
		}
		$tblTour = new Default_Model_Tour();
		$thisItem = $tblTour->getItem(array('id'=>$itemID),array('task'=>'default-tour-info'));
		$this->view->thisItem = $thisItem;
		
		if ($this->_request->isPost()) {
			$validator = new Default_Form_ValidateCheckTour();
			$validator->validate($this->_arrParam);
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
		
			} else {
				
				$successMessage = array('Thông tin của bạn đã được gửi đi. Chúng tôi sẽ phản hồi bạn trong
						thời gian gần nhất!');
				$this->view->messageError = $successMessage;
		
				//----- gui mail thong bao vao mail contact
				$objMail = new Default_Model_Mail();
				$objMail->sendMail($this->_arrParam,array('task'=>'website_checktour_form'));
		
				//$this->_redirect($this->_actionMain);
			}
		}
		
	}
	
	public function tinTucChiTietAction() {
		$template_path = TEMPLATE_PATH . "/ocdc/system";
		$this->loadTemplate($template_path,'template.ini','news-detail');
		
		$tblNewsArticle = new Default_Model_NewsArticle();
		$this->view->Item = $tblNewsArticle->getItem($this->_arrParam,array('task'=>'default-newsarticle-info'));
		
		//----- moi lan nguoi dung xem mot tin tuc thi tang so view cua tin do len 1 gia tri
		$tblNewsArticle->saveItem($this->_arrParam,array('task'=>'default-news-article-increase-view-counter'));
	}
	
}
