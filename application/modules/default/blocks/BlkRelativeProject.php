<?php
class Default_Block_BlkRelativeProject extends Zend_View_Helper_Abstract {
	
	//----- lay mot so cac project khac cung thuoc category, tru project hien tai
	//----- project_id duoc truyen vao qua tham so
	public function blkRelativeProject($category_id = 0, $thisProject_id = 0) {
		$blockView = $this->view;
		$imgUrl = FILES_URL . '/projects/cover-images/small/';
		
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		if ($category_id == 0) {
			$select = $db->select()
						->from('projects AS p')
						->where('p.id <> ?', $thisProject_id)
						->where('p.publish = 1')
						->order('p.publish_time DESC')
						->limit(5,0);
		} else {
			$select = $db->select()
						->from('projects AS p')
						->where('p.project_category_id = ?',$category_id)
						->where('p.id <> ?', $thisProject_id)
						->where('p.publish = 1')
						->order('p.publish_time DESC')
						->limit(5,0);
		}
		
		$relativeProjects = $db->fetchAll($select);

		require_once (DEFAULT_BLOCK_PATH . '/BlkRelativeProject/default.php');
	}
}