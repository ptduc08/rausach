<?php
class Default_Bootstrap extends Zend_Application_Module_Bootstrap {
	
	public function _initLanguage() {
		$ns = new Zend_Session_Namespace('language');
		if (!isset($ns->lang_front) && empty($ns->lang_front)) {
			//---- moi vao action, chua chon gi het. Thiet lap ngon ngu mac dinh
			$ns->lang_front = 'vi';
		}
		$module = 'default';
		$locale = $ns->lang_front;
	
		$file = APPLICATION_PATH . '/languages/' .$module . '/' . $locale . '.tmx';
		$options = array('adapter'=>'Tmx',
						 'content'=>$file,
						 'locale'=>$locale);
	
		$translate = new Zend_Translate($options);
		Zend_Registry::set('Zend_Translate_Front', $translate);
	}
	
	protected function _initLoadRouter() {
	
	$config = new Zend_Config_Ini(CONFIG_PATH . '/default-router.ini','front-end-router');
	$objRouter = new Zend_Controller_Router_Rewrite();
	$router = $objRouter->addConfig($config,'routers');
	
	
	$front = Zend_Controller_Front::getInstance();
	$front->setRouter($router);
	}
	
	public function _initFrontController() {
		$front = Zend_Controller_Front::getInstance();
		//----- thiet lap thu muc chua cac module
		$front->addModuleDirectory(APPLICATION_PATH . '/modules');
		
		//----- thiet lap module, controller, action mac dinh
		$front->setDefaultModule('default');
		$front->setDefaultControllerName('index');
		$front->setDefaultAction('index');
		
		//----- dang ky plugin
		$error = new Zend_Controller_Plugin_ErrorHandler(array('module'=>'default',
				'controller'=>'index','action'=>'error'));
		$front->registerPlugin($error);
		
		return $front;
	}
	
}