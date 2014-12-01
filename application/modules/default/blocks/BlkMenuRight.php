<?php
class Default_Block_BlkMenuRight extends Zend_View_Helper_Abstract {

	public function blkMenuRight() {
		echo 'dddđ';

		$blockView = $this->view;

		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		$select = $db->select()
		->from('menu_links',array('id','link_name','url','parent_id'))
		->where('publish = ?',1,INTEGER)
		;
		$result = $db->fetchAll($select);
		ksort($result);
		$MenuRightList = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkMenuRight/default.php');

	}
	public function recursive($sourceArr, $parent=0, $level = 1, &$resultArr) {

		if (count($sourceArr) > 0) {
			foreach ($sourceArr as $key=>$value) {
				if ($value['parent_id'] == $parent) {
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