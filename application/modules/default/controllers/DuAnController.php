<?php
class DuAnController extends Zendvn_Controller_Action {
	
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
		
		$template_path = TEMPLATE_PATH . "/388ic/system";
		$this->loadTemplate($template_path,'template.ini','template');
	}
	
	public function indexAction() {
		$template_path = TEMPLATE_PATH . "/388ic/system";
		$this->loadTemplate($template_path,'template.ini','project');
		
		if (!isset($this->_arrParam['project_category_id'])) {
			$this->_arrParam['project_category_id'] = 0;
		}
		
		$tblProject = new Default_Model_Project();
		$this->view->Items = $tblProject->listItem($this->_arrParam,array('task'=>'default-project-list'));
		
		//----- lay tong so phan tu de phan trang
		$totalProject = $tblProject->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalProject, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function duAnChiTietAction() {
		$template_path = TEMPLATE_PATH . "/388ic/system";
		$this->loadTemplate($template_path,'template.ini','project-detail');
		
		if (!isset($this->_arrParam['id'])) {
			$this->_arrParam['id'] = 0;
		}
		$this->view->thisProject_Id = $this->_arrParam['id'];
		
		$tblProject = new Default_Model_Project();
		$this->view->Item = $tblProject->getItem($this->_arrParam,array('task'=>'default-project-info'));
	}
	
}
