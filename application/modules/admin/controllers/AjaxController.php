<?php
class Admin_AjaxController extends Zendvn_Controller_Action {
	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;
	public function init() {
		//----- mang chua toan bo tham so nhan duoc o moi Action
		$this->_arrParam = $this->_request->getParams();
		//$template_path = TEMPLATE_PATH . "/admin/system";
		//$this->loadTemplate($template_path,'template.ini','template');
	}

	public function indexAction() {
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		echo 3;
	}
	public function changestatusAction() {
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		$next_status	= $this->_arrParam['next_status'];
		$pre_status	= $this->_arrParam['pre_status'];
		$order_id=	$this->_arrParam['order_id'];$order_id=3;
		//----- lay danh sach tat ca product id lien quan order
		$tblorder = new Admin_Model_Order();
		$tblproduct = new Admin_Model_Product();

		$allOrders = $tblorder->listProductInOrder($order_id);
		var_dump($allOrders);
		if($pre_status=='O'&& $next_status=='D'){
			foreach ($allOrders as $key => $value) {
				$tblproduct->SubAmountInStock($value['product_id'],$value['amount']);
			}
		}
		if($pre_status=='D'&& $next_status=='O'){
			foreach ($allOrders as $key => $value) {
				$tblproduct->RestoreAmountInStock($value['product_id'],$value['amount']);
			}
		}
		echo $pre_status;
	}
}