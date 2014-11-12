<?php
class Zendvn_View_Helper_CmsEditor extends Zend_View_Helper_Abstract {
	
	public function cmsEditor($name = '',$value = '', $options = null) {
		//----- nhung thu vien CKEditor vao
		require_once SCRIPTS_PATH . "/ckeditor/ckeditor.php";
		
		//----- tao class CKEditor
		$CKEditor = new CKEditor();
		
		//----- khai bao duong dan URL toi CKEditor
		$CKEditor->basePath = SRCIPTS_URL . '/ckeditor/';
		
		//----- khai bao cac cau hinh neu co
		$config = array();
		if (isset($options['width'])) {
			$config = array('width'=>$options['width']);
		}
		if (isset($options['height'])) {
			$config = array('height'=>$options['height']);
		}
		if (isset($options['toolbar'])) {
			$config = array('toolbar'=>$options['toolbar']);
		}
		
		//----- tao CKEditor
		$html = $CKEditor->editor($name, $value, $config);
		
		return $html;
	}
}