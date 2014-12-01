<?php
class Admin_Model_MenuLink extends Zend_Db_Table {
	protected $_name = 'menu_links';
	protected $_primary = 'id';



	public function listItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');

		//----- lay id, category_name, parent_category_id cua tat ca cac doi tuong (phuc vu cho menu header)
		//----- chi lay cac category duoc publish
		if ($options['task'] == 'admin-prmenulink-list') {
			$select = $db->select()
			->from('menu_links',array('id','link_name','url','parent_id','publish','order'))
			->order('order DESC')
			;
			$result = $db->fetchAll($select);
			//$result[0] = '-- Select a Category --';
			//----- sap xep lai mang $result theo khoa
			ksort($result);
		}

		return $result;
	}

	public function publish($arrParam = null, $options = null) {
		if (isset($arrParam['cid'])) {
			$cid = $arrParam['cid'];
		} else {
			$cid = array();
		}

		if (count($cid) > 0) {				//----- publish cho nhieu product category
			switch ($arrParam['type']) {
				case 'active':
					$publish = 1;
					break;
				case 'inactive':
					$publish = 0;
					break;
			}

			$strId = implode(',', $cid);
			$data = array('publish'=>$publish);
			$where = 'id IN (' .$strId .')';
			$this->update($data, $where);
		}
		if (isset($arrParam['id'])) {		//----- publish cho mot product category
			$id = $arrParam['id'];
			switch ($arrParam['type']) {
				case 'active':
					$publish = 1;
					break;
				case 'inactive':
					$publish = 0;
					break;
			}
				
			$data = array('publish'=>$publish);
			$where = 'id = ' .$id;
			$this->update($data, $where);
				
		}

	}
	public function getItem($arrParam = null, $options = null) {
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		//----- lay thong tin cua mot nhom khi biet id cua nhom
		if ($options['task'] == 'admin-menu-edit-linkname') {
			$select = $db->select()
			->from('menu_links AS p')
			->where('p.id = ?',$arrParam['id'],INTEGER)
			;
				
				
			$result = $db->fetchRow($select);
		}
		return $result;
	}
	public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-menu-edit-linkname') {
			$where 				= ' id = ' . $arrParam['id'];
			$row 				= $this->fetchRow($where);
			$row->link_name	= $arrParam['link_name'];
			$row->url	= $arrParam['url'];
				

			$row->save();
				

		}
	}
}