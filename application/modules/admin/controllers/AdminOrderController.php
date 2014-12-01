<?php
class Admin_AdminOrderController extends Zendvn_Controller_Action {

	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;

	//----- duong dan cua controller
	protected $_currentController;

	//----- duong dan cua Action mac dinh
	protected $_actionMain;

	//----- mang chua thong so phan trang
	protected $_paginator = array(
			'itemCountPerPage'=>50,
			'pageRange'=>3
	);

	//----- bien chua ten session namespace
	protected $_namespace;

	//----- bien chua doi tuong translate
	protected $_translate;

	public function init() {
		//----- mang chua toan bo tham so nhan duoc o moi Action
		$this->_arrParam = $this->_request->getParams();

		//----- bien session luu toan bo ten cac session khac duoc tao trong qua trinh chay ung dung
		//----- moi khi co mot session duoc tao ra thi ten cua no se duoc luu vao day
		$ssAppSessionList = new Zend_Session_Namespace('app-session-list');

		//----- duong dan cua controller
		$this->_currentController = '/' . $this->_arrParam['module'] .
		'/' . $this->_arrParam['controller'];

		//----- duong dan cua Action mac dinh
		$this->_actionMain = $this->_currentController . '/index';

		//----- thiet lap trang hien tai cho doi tuong phan trang
		$this->_paginator['currentPage'] = $this->_request->getParam('page',1);
		$this->_arrParam['paginator'] = $this->_paginator;

		//----- lay bien translate tu Registry
		$this->_translate = Zend_Registry::get('Zend_Translate');

		//----- tao bien session luu cac du lieu nhu filter, sort...
		$this->_namespace = $this->_arrParam['module'] .'-' .$this->_arrParam['controller'];
		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		$ssAppSessionList->sessionList .= ':' .$this->_namespace;

		if (empty($ssFilter->col)) {
			//----- tu khoa tim kiem
			$ssFilter->keywords = '';
			//----- cot sap xep
			$ssFilter->col = 'p.id';
			//----- huong sap xep
			$ssFilter->order = 'DESC';
			//----- loc product theo product_category_id
			$ssFilter->product_category_id = 0;
		}
		//----- dua cac gia tri trong session ssFilter vao mang tham so _arrParam
		$this->_arrParam['ssFilter']['keywords'] = $ssFilter->keywords;
		$this->_arrParam['ssFilter']['col'] = $ssFilter->col;
		$this->_arrParam['ssFilter']['order'] = $ssFilter->order;
		$this->_arrParam['ssFilter']['product_category_id'] = $ssFilter->product_category_id;

		//----- truyen ra view
		$this->view->arrParam = $this->_arrParam;
		$this->view->currentController = $this->_currentController;
		$this->view->actionMain = $this->_actionMain;

		$template_path = TEMPLATE_PATH . "/admin/admin-v2";
		$this->loadTemplate($template_path,'template.ini','template');

	}

	public function indexAction() {
		$this->view->Title = $this->_translate->_('admin-product-index-title');
		$this->view->headTitle($this->view->Title,true);

		//----- lay danh sach tat ca product trong bang product
		$tblorder = new Admin_Model_Order();
		$allOrders = $tblorder->listItem($this->_arrParam,array('task'=>'admin-order-list'));
		$this->view->Items = $allOrders;
		//----- lay tong so phan tu de phan trang
		$totalOrders = $tblorder->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalOrders, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	public function editAction() {
		$this->view->Title = $this->_translate->_('admin-order-edit-title');
		$this->view->headTitle($this->view->Title,true);

		$this->view->Title = $this->_translate->_('admin-order-info');
		$this->view->headTitle($this->view->Title,true);

		//----- lay thong tin cua product hien tai dua ra view
		$tblProduct = new Admin_Model_Product();
		$thisProduct = $tblProduct->getItem($this->_arrParam,array('task'=>'admin-product-info'));

		//----- lay danh sach tat ca product trong bang product
		$tblorder = new Admin_Model_Order();
		$order_id=$this->_arrParam['id'];
		$Order = $tblorder->getItem($order_id,array('task'=>'admin-order-byId'));
		$allProductOrders = $tblorder->listProductInOrder($order_id);
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateOrder();
			//$this->_arrParam['contact_title'] = 'Không cần nhập';
			//$this->_arrParam['contact_address'] = 'Không cần nhập';
				
			$validator->validate($this->_arrParam);
			if ($validator->isError()) {

				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				$this->view->validateResult = "error";
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();

			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh luu du lieu vao database

				$tblOrders = new Admin_Model_Order();
				$tblOrderProduct = new Admin_Model_OrderProduct();
				//$tblProduct = new Default_Model_Product();
				$arrParam = $validator->getData();
				//$arrParam['total']=$_POST['total'];
				$tblOrders->saveItem($arrParam,array('task'=>'admin-order-edit'));

				//$tblOrderProduct->saveItem();
				foreach ($_POST['qty'] as $product_order_id => $amount) {
					$tblOrderProduct->saveItem(array('product_order_id'=>$product_order_id,
							'amount'=>$amount
								
					),array('task'=>'admin-order-edit'));
				}
				$this->_redirect($this->_actionMain);
			}
		}
		$this->view->Item = $Order;
		$this->view->AllProductOrders = $allProductOrders;

	}

	public function filterAction() {
		$ssFilter = new Zend_Session_Namespace($this->_namespace);

		//----- neu filter type la tim kiem
		if ($this->_arrParam['type'] == 'search') {
			if ($this->_arrParam['key'] == 1) {
				$ssFilter->keywords = trim($this->_arrParam['keywords']);
			} else {
				$ssFilter->keywords = '';
			}
		}

		//----- neu filter type la tim sap xep
		if ($this->_arrParam['type'] == 'order') {
			$ssFilter->col = $this->_arrParam['col'];
			$ssFilter->order = $this->_arrParam['by'];
		}

		//----- neu filter type la loc theo product_category_id
		if ($this->_arrParam['type'] == 'productcategory') {
			$ssFilter->product_category_id = $this->_arrParam['product_category_id'];
		}

		$this->_redirect($this->_actionMain);
		$this->_helper->viewRenderer->setNoRender();
	}

	public function infoAction() {
		$this->view->Title = $this->_translate->_('admin-order-info');
		$this->view->headTitle($this->view->Title,true);

		//----- lay thong tin cua product hien tai dua ra view
		$tblProduct = new Admin_Model_Product();
		$thisProduct = $tblProduct->getItem($this->_arrParam,array('task'=>'admin-product-info'));

		//----- lay danh sach tat ca product trong bang product
		$tblorder = new Admin_Model_Order();
		$order_id=$this->_arrParam['id'];
		$Order = $tblorder->getItem($order_id,array('task'=>'admin-order-byId'));
		$allProductOrders = $tblorder->listProductInOrder($order_id);

		$this->view->Item = $Order;
		$this->view->AllProductOrders = $allProductOrders;

	}



}