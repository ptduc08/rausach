<?php
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap {
	public function _initLanguage() {
		$ns = new Zend_Session_Namespace('language');
		if (empty($ns->lang)) {
			//---- moi vao action, chua chon gi het. Thiet lap ngon ngu mac dinh
			$ns->lang = 'en';
		}
		$module = 'admin';
		$locale = $ns->lang;
		
		$file = APPLICATION_PATH . '/languages/' .$module . '/' . $locale . '.tmx';
		$options = array('adapter'=>'Tmx',
				'content'=>$file,
				'locale'=>$locale);
		
		$translate = new Zend_Translate($options);
		Zend_Registry::set('Zend_Translate', $translate);
	}
	
	public function _initFrontController() {
		$front = Zend_Controller_Front::getInstance();
		//----- dang ky plugin
		$error = new Zend_Controller_Plugin_ErrorHandler(array('module'=>'admin',
				'controller'=>'public','action'=>'error'));
		//$front->registerPlugin($error);
		$front->registerPlugin(new Zendvn_Plugin_Permission());
	
		return $front;
	}
	
}