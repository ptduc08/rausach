<?php
class Zendvn_View_Helper_CmsReplaceString extends Zend_View_Helper_Abstract {
	
	//===================================================================================
	//----- dau vao la mang $arrParams. Dau ra la 1 mang giong nhu mang $arrParams
	//----- nhung da xu ly cac du lieu chuoi, nhu bo dau \
	//===================================================================================
	public function cmsReplaceString($input, $options = null) {
		//----- truong hop 1: neu $input la mot mang
		if (is_array($input)) {
			$result = array();
			if ($options == null) {
				if (count($input) > 0) {
					foreach($input as $key=>$val) {
						$str = $val;
						if (!empty($str) && is_string($str)) {
							$str = str_replace('\"', '"', $str);
							$str = str_replace("\'", "'", $str);
							$str = stripslashes($str);
						}
							
						$result[$key] = $str;
							
					}
				}
					
			}
			
			return $result;
		}
		
		//----- truong hop 2: neu $input la 1 chuoi, khong phai mot mang
		if (!is_array($input)) {
			if ($options == null) {
				$str = str_replace('\"', '"', $input);
				$str = str_replace("\'", "'", $str);
				$str = stripslashes($str);
					
				return $str;
			}
			
			
		}
		
	}
}
