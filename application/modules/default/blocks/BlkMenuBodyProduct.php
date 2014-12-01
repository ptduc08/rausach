<?php
class Default_Block_BlkMenuBodyProduct extends Zend_View_Helper_Abstract {

	public function blkMenuBodyProduct($parent_category_id) {


		$blockView = $this->view;

		$db = Zend_Registry::get('connectDb');

		//----- lay id, category_name, parent_category_id cua tat ca cac doi tuong (phuc vu cho menu header)
		//----- chi lay cac category duoc publish
		$select = $db->select()
		->from('product_category',array('id','category_name','parent_category_id'))
		->order('order DESC')
		->where('publish = ?',1,INTEGER)
		->where('parent_category_id = ?',$parent_category_id,INTEGER)
		;
		//$result[0] = '-- Select a Category --';
		//----- sap xep lai mang $result theo khoa

		$MenuBodyProduct = $db->fetchAll($select);
		//$result[0] = '-- Select a Category --';
		//----- sap xep lai mang $result theo khoa
		//ksort($MenuProduct);


		require_once (DEFAULT_BLOCK_PATH . '/BlkMenuBodyProduct/default.php');

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