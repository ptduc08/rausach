<?php
class Zendvn_View_Helper_CmsSortLink extends Zend_View_Helper_Abstract {
	
	/**
	 * $col: column trong table se sap xep theo
	 * $arrParam: mang arrParam truyen vao tu controller
	 * $title: tieu de cua link se xuat hien o view
	 * $iconPath: duong dan toi file icon the hien link sap xep
	 * $action_link: duong dan toi action xu ly
	 * $default_order: huong sap xep mac dinh la DESC
	 */
	
	public function cmsSortLink($col = '', $arrParam, $title = '', $iconPath = '', $action_link, $default_order = 'DESC') {
		
		$xhtml = '';
		$view = new Zend_View_Helper_BaseUrl();
		$currentController = '/' . $arrParam['module'] .
		'/' . $arrParam['controller'];
		$ssFilter = $arrParam['ssFilter'];
		if ($ssFilter['col'] != $col) {
			$linkOrder = $action_link . '/col/' .$col .'/by/' . $default_order;
			$iconSort = '';
		} else {
			if ($ssFilter['order'] == 'DESC') {
				$by = 'ASC';
				$iconSort = $iconPath . '/icon/arrow_up.png';
			} else {
				$by = 'DESC';
				$iconSort = $iconPath . '/icon/arrow_down.png';
			}
			$linkOrder = $action_link .'/col/' .$col .'/by/' .$by;
		}
		
		if (!empty($iconSort)) {
			$xhtml = '<a href="' .$linkOrder .'">' . $title .
			'<img src = "' . $iconSort . '"/></a>';
		} else {
			$xhtml = '<a href="' .$linkOrder .'">' . $title . '</a>';
		}
		
		return $xhtml;
	}
}