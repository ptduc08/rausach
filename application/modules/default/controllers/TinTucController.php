<?php
class TinTucController extends Zendvn_Controller_Action {
	
	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;
	
	//----- duong dan cua controller
	protected $_currentController;
	
	//----- duong dan cua Action mac dinh
	protected $_actionMain;
	
	//----- mang chua thong so phan trang
	protected $_paginator = array(
			'itemCountPerPage'=>3,
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
		}
		//----- dua cac gia tri trong session ssFilter vao mang tham so _arrParam
		$this->_arrParam['ssFilter']['keywords'] = $ssFilter->keywords;
		$this->_arrParam['ssFilter']['col'] = $ssFilter->col;
		$this->_arrParam['ssFilter']['order'] = $ssFilter->order;
		
		//----- truyen ra view
		$this->view->arrParam = $this->_arrParam;
		$this->view->currentController = $this->_currentController;
		$this->view->actionMain = $this->_actionMain;
		
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','news');
	}
	
	public function indexAction() {
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','news');
		
		//----- loc lay tat ca cac tin thuoc mot category (thuoc truc tiep hoac thuoc mot sub category nao do)
		if (!isset($this->_arrParam['id'])) {
			$this->_arrParam['ancestorCategoryID'] = 0;
			$category_id = 0;
		} else {
			$this->_arrParam['ancestorCategoryID'] = $this->_arrParam['id'];
			$category_id = $this->_arrParam['id'];
		}
		
		//----- lay thong tin cua category nay
		$tblNewsCat = new Default_Model_NewsCategory();
		$thisCategory = $tblNewsCat->getItem(array('id'=>$category_id),array('task'=>'default-newscategory-info'));
		$this->view->thisCategory = $thisCategory;
		
		//----- lay danh sach cac item thuoc category nay
		$tblNewsArticle = new Default_Model_NewsArticle();
		$articleList = $tblNewsArticle->listItem($this->_arrParam,array('task'=>'default-newsarticle-list-filter-to-category'));
		$this->view->articleList = $articleList;
		
		if(isset($this->_arrParam['id'])) {
			$this->view->thisNewsCategory_Id = $this->_arrParam['id'];
		}
		
		//----- lay tong so phan tu de phan trang
		$totalArticle = $tblNewsArticle->countItem($this->_arrParam,array('task'=>'count-item-in-ancestor-category'));
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalArticle, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function tinTucChiTietAction() {
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','news-detail');

		$tblNewsArticle = new Default_Model_NewsArticle();
		$this->view->Item = $tblNewsArticle->getItem($this->_arrParam,array('task'=>'default-newsarticle-info'));
		
		$this->view->thisNewsArticle_Id = $this->_arrParam['id'];
		$this->view->thisNewsCategory_Id = $this->_arrParam['category_id'];
		//----- moi lan nguoi dung xem mot tin tuc thi tang so view cua tin do len 1 gia tri
		$tblNewsArticle->saveItem($this->_arrParam,array('task'=>'default-news-article-increase-view-counter'));
	}
	
}
