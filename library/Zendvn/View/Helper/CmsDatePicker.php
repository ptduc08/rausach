<?php
class Zendvn_View_Helper_CmsDatePicker extends Zend_View_Helper_Abstract {
	
	//===============================================================
	//============== Tao o textbox chon ngay thang ==================
	//===== $name: ten cua o input textbox
	//===== $value: gia tri cua o input
	//===== $options: mang chua cac tuy chon:
	//===== $options['class']: thiet lap class cua o input
	//===== $options['style']: thiet lap style cua o input
	//===============================================================
	public function cmsDatePicker($name = '', $value = '', $options = null) {
		$html = '';
		$html .= '<script>
  					$(document).ready(function() {
						$("#' . $name . '").datepicker({ dateFormat: "dd-mm-yy" });
  					});
				</script>';
		$html .= '<input type="text" id="' . $name . '" name="' . $name . 
				 '" value="' . $value . '" class="' . $options['class'] . 
				 '" style="' . $options['style'] .'">';
	
	    return $html;
	}
}