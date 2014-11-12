<?php
class Zendvn_Controller_Action extends Zend_Controller_Action {
	
	protected function loadTemplate($template_path, $fileConfig = 'template.ini', $sectionConfig = 'template') {
		
		// xoa toan bo the meta, link, script da co. xoa title da co
		$this->view->headTitle()->set('');
		$this->view->headMeta()->getContainer()->exchangeArray(array());
		$this->view->headLink()->getContainer()->exchangeArray(array());
		$this->view->headScript()->getContainer()->exchangeArray(array());
		
		// doc thong tin trong file ini cau hinh, theo section da truyen vao ==> dua vao mang $config
		$filename = $template_path . "/" .$fileConfig;
		$section = $sectionConfig;
		$config = new Zend_Config_Ini($filename, $section);
		$config = $config->toArray();
		
		// lay dia chi URL cua thu muc CSS, JS, Image
		$baseUrl = $this->_request->getBaseUrl();
		$templateUrl = $baseUrl . $config['url'];		
		$cssUrl = $templateUrl . $config['dirCss'];
		$jsUrl = $templateUrl . $config['dirJs'];
		$imgUrl = $templateUrl . $config['dirImg'];
		
		// lay title tu ini nap vao view
		if (isset($config['metaHttp'])) {
			$this->view->headTitle($config['title']);
		}
		
		// nap cac the meta http-equiv
		if (isset($config['metaHttp'])) {
			if (count($config['metaHttp'])>0) {
				foreach ($config['metaHttp'] as $key=>$value) {
					$tmp = explode("|",$value);
					$this->view->headMeta()->appendHttpEquiv($tmp[0],$tmp[1]);
				}
			}
		}
		
		// nap cac the meta name
		if (isset($config['metaName'])) {
			if (count($config['metaName'])>0) {
				foreach ($config['metaName'] as $key=>$value) {
					$tmp = explode("|",$value);
					$this->view->headMeta()->appendName($tmp[0],$tmp[1]);
				}				
			}
		}
		
		// nap cac tap tin CSS vao layout
		if (isset($config['fileCss'])) {
			if (count($config['fileCss'])>0) {
				foreach ($config['fileCss'] as $key=>$value) {
					$this->view->headLink()->appendStylesheet($cssUrl . $value,"screen");
				}
			}
		}
		
		// nap cac tap tin JS vao layout
		if (isset($config['fileJs'])) {
			if (count($config['fileJs'])>0) {
				foreach ($config['fileJs'] as $key=>$value) {
					$this->view->headScript()->appendFile($jsUrl . $value,"text/javascript");
				}
			}
		}
		
		
		$this->view->templateUrl = $templateUrl;
		$this->view->cssUrl = $cssUrl;
		$this->view->jsUrl = $jsUrl;
		$this->view->imgUrl = $imgUrl;
		
		$option = array('layoutPath'=>$template_path,'layout'=>$config['layout']);
		Zend_Layout::startMvc($option);
	}
}