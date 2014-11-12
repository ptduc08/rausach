<?php
class IndexController extends Zendvn_Controller_Action {
	
	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;
	
	//----- duong dan cua controller
	protected $_currentController;
	
	//----- duong dan cua Action mac dinh
	protected $_actionMain;
	
	//----- mang chua thong so phan trang
	protected $_paginator = array(
			'itemCountPerPage'=>9,
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
		
		//----- kiem tra tham so ngon ngu lang_front roi luu lai vao session
		//if(!isset($this->_arrParam['lang_front'])) {
		//	$this->_arrParam['lang_front'] = 'vi';
		//}
		//$ns = new Zend_Session_Namespace('language');
		//$ns->lang_front = $this->_arrParam['lang_front'];
		
		//----- duong dan cua controller
		$this->_currentController = '/' . $this->_arrParam['module'] .
									'/' . $this->_arrParam['controller'];
		
		//----- duong dan cua Action mac dinh
		$this->_actionMain = $this->_currentController . '/index';
		
		//----- thiet lap trang hien tai cho doi tuong phan trang
		$this->_paginator['currentPage'] = $this->_request->getParam('page',1);
		$this->_arrParam['paginator'] = $this->_paginator;
		
		//----- lay bien translate tu Registry
		$this->_translate = Zend_Registry::get('Zend_Translate_Front');
		
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
		$this->loadTemplate($template_path,'template.ini','template');
	}
	
	public function indexAction() {
		
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','template');
		
		//----- lay du lieu trang gioi thieu cong ty -----
		$tblPage = new Default_Model_Pages();
		$introducePage = $tblPage->getItem(array('id'=>1),array('task'=>'default-page-info'));
		$this->view->introducePage = $introducePage;
		//var_dump($this->view->introducePage);
		//echo "<pre>";
		//print_r($this->_arrParam);
		//echo "</pre>";

		$tblProduct = new Default_Model_Product();
		$productView = $tblProduct->listItem($this->_arrParam,array('task'=>'news-product-list'));
		$this->view->Items = $productView;
		//	var_dump($productView);
/*
		$tblProduct = new Default_Model_Product();
		$productMost_View = $tblProduct->listItem($this->_arrParam,array('task'=>'most_view-product-list'));
		$this->view->most_view = $productMost_View;
		//var_dump($productView_Counter);
*/
		//$tblProjects = new Default_Model_Project();
		//$newestProjects = $tblProjects->listItem($this->_arrParam,array('task'=>'default-get-three-newest-projects'));
		//$this->view->newestProjects = $newestProjects;
		
		//----- moi lan nap trang chu thi ghi them 1 dong vao bang Log Client Access
		//$tblLogClientAccess = new Admin_Model_LogClientAccess();
		//$tblLogClientAccess->saveItem(null,array('task'=>'admin-log-client-access-add'));
		
	}
	
	public function changeLanguageAction() {
		
		if(!isset($this->_arrParam['lang_front']) && empty($this->_arrParam['lang_front'])) {
			$this->_arrParam['lang_front'] = 'vi';
		}
		if($this->_arrParam['lang_front'] != 'vi' && $this->_arrParam['lang_front'] != 'en' ) {
			$this->_arrParam['lang_front'] = 'vi';
		}
		$lang_front = $this->_arrParam['lang_front'];
		$ns = new Zend_Session_Namespace('language');
		$ns->lang_front = $lang_front;
		$this->_redirect('/');
		$this->_helper->viewRenderer->setNoRender(true);
	}
	
	public function dichVuAction() {
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','service');
		
		if (!isset($this->_arrParam['id'])) {
			$this->_arrParam['id'] = 38;
		}
		$tblServices = new Default_Model_Services();
		$this->view->Item = $tblServices->getItem($this->_arrParam,array('task'=>'default-service-info'));
	}
	
	public function gioiThieuAction() {
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','gioi-thieu');
		
		if (!isset($this->_arrParam['id'])) {
			$this->_arrParam['id'] = 1;
		}
		$tblPages = new Default_Model_Pages();
		$this->view->Item = $tblPages->getItem($this->_arrParam,array('task'=>'default-page-info'));
	}
	
	public function taiLieuAction() {
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','tai-lieu');
		
		$filepath = APPLICATION_PATH . '/configs/file-list.ini';
		$section = "documents";
		$objZendvnIni = new Zendvn_System_Ini();
		
		$config = $objZendvnIni->readIni($filepath, $section);
		
		$this->view->documentList = $config['documents'];
	}
	
	public function lienHeAction() {
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','contact');
		
		if ($this->_request->isPost()) {
			$validator = new Default_Form_ValidateContact();
			$this->_arrParam['contact_title'] = 'Không cần nhập';
			$this->_arrParam['contact_address'] = 'Không cần nhập';
			
			$validator->validate($this->_arrParam);
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				$this->view->validateResult = "error";
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
				
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh luu du lieu vao database
				$tblContact = new Default_Model_Contacts();
				$arrParam = $validator->getData();
				
				$tblContact->saveItem($arrParam,array('task'=>'admin-contact-add'));
				$successMessage = array('Thông tin của bạn đã được gửi đi. Chúng tôi sẽ phản hồi bạn trong
										 thời gian gần nhất!');
				$this->view->messageError = $successMessage;
				$this->view->validateResult = "success";
				
				//----- gui mail thong bao vao mail contact
				$objMail = new Default_Model_Mail();
				$objMail->sendMail($arrParam,array('task'=>'website_contact_form'));
				
				//$this->_redirect($this->_actionMain);
			}
		}
	}
	
	public function errorAction() {
		$template_path = TEMPLATE_PATH . "/dreamviettravel/system";
		$this->loadTemplate($template_path,'template.ini','error');
	}
	
}
