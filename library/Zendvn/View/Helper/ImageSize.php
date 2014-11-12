<?php
class Zendvn_View_Helper_ImageSize extends Zend_View_Helper_Abstract {
	
	//----- doc thong so kich thuoc anh trong file configs/image-size.ini
	public function imageSize($section,$imageLocation) {
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/image-size.ini',$section);
		$config = $config->toArray();
		$result = $config[$imageLocation];
			
		return $result;
	}
	
}