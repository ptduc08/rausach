<?php
class Zendvn_View_Helper_CmsRecursiveSelectBox extends Zend_View_Helper_Abstract {
	
	//---------------------------------------------------------------------------------------------
	//mang $options chua cac phan tu:
	//		parent: gia tri cua phan tu cha bat dau lay du lieu
	//		level: cap bat dau
	//		
	//mang $attribs chua cac phan tu: 
	//		size: so phan tu hien thi cua select
	//		name: ten cua select box
	//		style: style cua select box
	//---------------------------------------------------------------------------------------------
	public function cmsRecursiveSelectBox($sourceArr, $options, $attribs = null) {
		//---- mang $newArray se chua du lieu moi sau khi chay ham de qui -------------------------
		$newArray = array();
		if (isset($options['parent'])) {
			$parent = $options['parent'];
		} else {
			$parent = 0;
		}
		if (isset($options['level'])) {
			$level = $options['level'];
		} else {
			$level = 1;
		}
		$this->recursive($sourceArr, $parent, $level, $newArray);
		
		//----- bat dau tao select box -----------------------------------------------------------
		if (isset($attribs['size']) && $attribs['size'] > 1) {
			$strSize = 'size="' . $attribs['size'] .'"';
		} else {
			$strSize = '';
		}
		if (isset($attribs['multiple']) && $attribs['multiple'] == true) {
			$strMultiple ='multiple = true';
		} else {
			$strMultiple ='';
		}
		if (isset($attribs['style'])) {
			$strStyle = $attribs['style'];
		} else {
			$strStyle = '';
		}
		if (isset($attribs['name'])) {
			$strName = $attribs['name'];
		} else {
			$strName = 'slbRecursive';
		}
		if (isset($attribs['onChange'])) {
			$strOnChange = $attribs['onChange'];
		} else {
			$strOnChange = '';
		}
		$xhtml = '<select name="' .$strName .'" id="' .$strName .'" style="' .$strStyle .'" ' .$strSize . $strMultiple .
								'onChange="' .$strOnChange .'">';
		$xhtml .= '<option value="0">- - - - Select a Category - - - -</option>';
		foreach ($newArray as $key=>$info) {
			$strSelect = '';
			if (isset($attribs['value']) && is_array($attribs['value']) && in_array($info['id'], $attribs['value'])) {
				$strSelect = 'selected = "selected"';
			} 
			if (isset($attribs['value']) && !is_array($attribs['value']) && $info['id'] == $attribs['value']) {
				$strSelect = 'selected = "selected"';
			}
			
			if ($info['level'] == 1) {
				$xhtml .= '<option value="' .$info['id'] .'" ' . $strSelect .'>' .$info['category_name'] .'</option>';
			} else {
				$string = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$string = '- - - - - ';
				$newString = '';
				for ($i=1; $i< $info['level']; $i++) {
					$newString .= $string;
				}
				$category_name = $newString .$info['category_name'];
				$xhtml .= '<option value="' .$info['id'] .'" ' .$strSelect .'>' .$category_name .'</option>';
			}
		}
		
		$xhtml .= '</select>';
		return $xhtml;
	}
	
	public function recursive($sourceArr, $parent=0, $level = 1, &$resultArr) {
		if (count($sourceArr) > 0) {
			foreach ($sourceArr as $key=>$value) {
				if ($value['parent_category_id'] == $parent) {
					$value['level'] = $level;
					$resultArr[] = $value;
					$newParent = $value['id'];
					unset($sourceArr[$key]);
					$this->recursive($sourceArr, $newParent, $level+1, $resultArr);
				}
			}
		}
	}
}