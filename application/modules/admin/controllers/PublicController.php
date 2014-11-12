<?php
class Admin_PublicController extends Zendvn_Controller_Action {
	
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
		
		//----- duong dan cua controller
		$this->_currentController = '/' . $this->_arrParam['module'] .
									'/' . $this->_arrParam['controller'];
		
		//----- duong dan cua Action mac dinh
		$this->_actionMain = $this->_currentController . '/index';
		
		//----- lay bien translate tu Registry
		$this->_translate = Zend_Registry::get('Zend_Translate');
		
		//----- truyen ra view
		$this->view->arrParam = $this->_arrParam;
		$this->view->currentController = $this->_currentController;
		$this->view->actionMain = $this->_actionMain;
		
		$template_path = TEMPLATE_PATH . "/admin/admin-v2";
		$this->loadTemplate($template_path,'template.ini','error');
	}
	
	public function indexAction() {
		
	}

	//----- Action thong bao loi mac dinh cua he thong
	public function errorAction() {
		$template_path = TEMPLATE_PATH . "/admin/system";
		$this->loadTemplate($template_path,'template.ini','error');
		
		$this->view->Title = $this->_translate->_('admin-public-error-title');
		$this->view->headTitle($this->view->Title,true);
		
		$error[] = 'Chuc nang nay khong ton tai';
		$this->view->messageError = $error;
	}
	
	public function loginAction() {
		$this->view->Title = $this->_translate->_('admin-public-login-title');
		$this->view->headTitle($this->view->Title,true);
		
		$template_path = TEMPLATE_PATH . "/admin/admin-v2";
		$this->loadTemplate($template_path,'template.ini','login');
		
		$error = array();
		$this->view->messageError = $error;
		$captcha = new Zendvn_Captcha_Image();
		$this->view->captcha = $captcha->render($this->view);
		$this->view->captcha_id = $captcha->getId();
		
		//----- kiem tra neu da login roi thi redirect luon toi trang admin Dashboard
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			$this->_redirect('/admin/index/index');
		}
		
		//----- xu ly khi submit login form
		if ($this->_request->isPost()) {
			$captcha_id = $this->_arrParam['captcha_id'];
			$captcha_word = $this->_arrParam['captcha'];
			$captcha_validator = new Zendvn_Validate_Captcha($captcha_id);
			if (!$captcha_validator->isValid($captcha_word)) {
				$error[] = $captcha_validator->getMessages();
				$this->view->messageError = current($error);
			} else {
				$auth = new Zendvn_System_Auth();
				if ($auth->login($this->_arrParam)) {
				
					$info = new Zendvn_System_Info();
					$info->createInfo();
					$this->_redirect('/admin/index/index');
				} else {
					$error[] = $auth->getError();
					$this->view->messageError = $error;
				}
			}
			
			
		}
	}
	
	public function logoutAction() {
		$this->view->Title = $this->_translate->_('admin-public-logout-title');
		$this->view->headTitle($this->view->Title,true);
		
		$info = new Zendvn_System_Info();
		$info->destroyInfo();
		$this->_redirect('/admin/public/login');
	}
	
	//----- Action hien thi thong bao khong duoc quyen truy cap
	public function noAccessAction() {
		$this->view->Title = $this->_translate->_('admin-public-noacess-title');
		$this->view->headTitle($this->view->Title,true);
		
		$template_path = TEMPLATE_PATH . "/admin/system";
		$this->loadTemplate($template_path,'template.ini','template');
		
		$error[] = 'Ban khong co quyen truy cap vao chuc nang nay';
		$this->view->messageError = $error;
	}
}