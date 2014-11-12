<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	
	protected function _initSession(){
		Zend_Session::start();
	}
	
	/* protected function _initLocale(){
		$locale = new Zend_Locale('vi_VN');
		Zend_Registry::set('Zend_Locale',$locale);	
	} */
	
	protected function _initDb(){
		
		$optionResources = $this->getOption('resources');
		$dbOption = $optionResources['db'];
		$dbOption['params']['username'] = 'root';
		$dbOption['params']['password'] = '';
		$dbOption['params']['dbname'] = 'rausach';
		
		$adapter = $dbOption['adapter'];
		$config = $dbOption['params'];
		
		$db = Zend_Db::factory($adapter,$config);
		$db->setFetchMode(Zend_Db::FETCH_ASSOC);
		$db->query("SET NAMES 'utf8'");
		$db->query("SET CHARACTER SET 'utf8'");
		
		Zend_Registry::set('connectDb',$db);
		Zend_Db_Table::setDefaultAdapter($db);
		
		return $db;
	}
	
	/* protected function _initLoadRouter(){
		
		$config = new Zend_Config_Ini(CONFIG_PATH . '/app-router.ini','setup-router');
		$objRouter = new Zend_Controller_Router_Rewrite();
		new Zend_Controller_Router_Route_Regex()
		$router = $objRouter->addConfig($config,'routers');
		
		$front = Zend_Controller_Front::getInstance();
		$front->setRouter($router);
	} */
	
	/* protected function _initLoadRouter() {
		//-----1. Thiet lap router
		/* $route = 'admin-news-(\d+)\.html';
		$defaults = array('module'=>'admin','controller'=>'admin-news-article','action'=>'info');
		$map = array(1=>'id');
		$newsRouter = new Zend_Controller_Router_Route_Regex($route,$defaults,$map);
		
		$front = Zend_Controller_Front::getInstance();
		$router = $front->getRouter();
		
		$router->addRoute('news-router',$newsRouter);
		
		$config = new Zend_Config_Ini(CONFIG_PATH . '/router-regex.ini','thiet-lap-router');
		$objRouter = new Zend_Controller_Router_Rewrite();
		$objRouter->addConfig($config,'routers');
		echo '<pre>';
		print_r($objRouter);
		echo '</pre>';
		$front = Zend_Controller_Front::getInstance();
		$front->setRouter($objRouter);
		
	} */
	
	public function _initFrontController() {
		$front = Zend_Controller_Front::getInstance();
		//----- thiet lap thu muc chua cac module
		$front->addModuleDirectory(APPLICATION_PATH . '/modules');
		
		//----- thiet lap module, controller, action mac dinh
		$front->setDefaultModule('default');
		$front->setDefaultControllerName('index');
		$front->setDefaultAction('index');
		
		//----- dang ky plugin
		$error = new Zend_Controller_Plugin_ErrorHandler(array('module'=>'admin',
								'controller'=>'public','action'=>'error'));
		//$front->registerPlugin($error);
		
		return $front;
	}
	
}











