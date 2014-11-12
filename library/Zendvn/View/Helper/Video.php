<?php
class Zendvn_View_Helper_Video extends Zend_View_Helper_Abstract {
	
	//----- doc thong so video link trong file configs/video.ini
	public function video($section,$linkLocation) {
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/videolist.ini',$section);
		$config = $config->toArray();
		$result = $config[$linkLocation];
			
		return $result;
	}

}