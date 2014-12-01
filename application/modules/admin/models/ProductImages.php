<?php
class Admin_Model_ProductImages extends Zend_Db_Table {
	protected $_name = 'product_images';
	protected $_primary = 'id';
	public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-product-images') {
			foreach ($arrParam['cover_image'] as $v){
				$row 				= $this->fetchNew();

				$row->product_id	= $arrParam['id'];
				$row->image_name    = $v;
				$row->image_title	= '';
				$row->publish	 	= 0;
				$row->lock_status 	= 0;

				//----- lay user_id cua user tao ra nhom nay
				$info = new Zendvn_System_Info();
				$user_id = $info->getMemberInfo('id');
				$row->created_id 	= $user_id;
				$row->created_time	= date("Y-m-d H:i:s");

				$row->publisher_id	= $user_id;;
				$row->publish_time	= date("Y-m-d H:i:s");

				$row->save();
			}

		}
	}
}