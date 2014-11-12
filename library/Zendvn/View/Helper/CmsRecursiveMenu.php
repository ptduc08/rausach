<?php
class Zendvn_View_Helper_CmsRecursiveMenu extends Zend_View_Helper_Abstract {
	
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
	
	public function cmsRecursiveMenu($sourceArr, $parent = 0, $options = null) {
		$strMenu = '';
		$this->recursive($sourceArr, $parent, $strMenu, $options);
		return str_replace('<ul></ul>', '', $strMenu);
		
	}
	
	public function recursive($sourceArr, $parent = 0, &$newMenu, $options = null) {
		if (count($sourceArr) > 0) {
			$newMenu .= '<ul>';
			foreach ($sourceArr as $key=>$value) {
				if ($value['parent_category_id'] == $parent) {
					$category_id = $value['id'];
					$category_name = $value['category_name'];
					
					$filter = new Zend_Filter();
					$multiFilter = $filter->addFilter(new Zend_Filter_StringToLower(array('encoding'=>'UTF-8')))
										  ->addFilter(new Zend_Filter_StringTrim())
										  ->addFilter(new Zend_Filter_Alnum(true))
										  ->addFilter(new Zendvn_Filter_RemoveCircumflex())
										  ->addFilter(new Zend_Filter_Word_SeparatorToDash(' '));
					 
					$tourUrlOptions = array('module'=>'default','controller'=>'tour','action'=>'index',
							'title'=>$multiFilter->filter($category_name),'id'=>$category_id);
					 
					
					$category_link = 'index';
					$view = Zend_Layout::startMvc()->getView();
					$router = $options['router'];
					$category_link = $view->url($tourUrlOptions,$router);
					
					$newMenu .= '<li><a href="' .$category_link .'" title="">' .$category_name .'</a>';
					$newParent = $value['id'];
					unset($sourceArr[$key]);
					$this->recursive($sourceArr, $newParent, $newMenu);
					$newMenu .= '</li>';
				}
			}
				
			$newMenu .= '</ul>';
		}
	}
}