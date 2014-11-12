<?php
class Default_Block_BlkTourVietnamCategory extends Zend_View_Helper_Abstract {
	
	public function blkTourVietnamCategory() {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/tour/cover-images/large/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		
		//----- lay danh sach tat ca category
		$select = $db->select()
					 ->from('tour_category AS tc')
				 	 ->order('tc.order DESC');
		$allTourCategory = $db->fetchAll($select);
		//----- loc ra nhung category con thuoc mot category cap tren nao do 
		$objRecursive = new Zendvn_System_Recursive();
		$allSubCategory = array();
		$ancestorCategoryId = 1;
		$objRecursive->getAllSubCategoryId($allTourCategory, $ancestorCategoryId, $allSubCategory);
		//----- loai bo category cap tren cung
		foreach ($allSubCategory as $key=>$value) {
			if ($value == $ancestorCategoryId) {
				unset($allSubCategory[$key]);
			}
		}
		
		$select = $db->select()
					 ->from('tour_category AS tc')
					 ->where('tc.id IN (?)',$allSubCategory)
					 ->order('tc.order')
					 ->limit(10);
		$categoryList = $db->fetchAll($select);
		
		require_once (DEFAULT_BLOCK_PATH . '/BlkTourVietnamCategory/default.php');
	}
}