<?php
class CartController extends Zendvn_Controller_Action {

	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;

	//----- duong dan cua controller
	protected $_currentController;

	//----- duong dan cua Action mac dinh
	protected $_actionMain;

	//----- mang chua thong so phan trang
	protected $_paginator = array(
			'itemCountPerPage'=>3,
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
			$ssFilter->col = 'na.id';
			//----- huong sap xep
			$ssFilter->order = 'DESC';
		}
		//----- dua cac gia tri trong session ssFilter vao mang tham so _arrParam
		$this->_arrParam['ssFilter']['keywords'] = $ssFilter->keywords;
		$this->_arrParam['ssFilter']['col'] = $ssFilter->col;
		$this->_arrParam['ssFilter']['order'] = $ssFilter->order;

		//----- truyen ra view
		$this->view->arrParam = $this->_arrParam;
		$this->view->currentController = $this->_currentController;
		$this->view->actionMain = $this->_actionMain;

		//$template_path = TEMPLATE_PATH . "/cnt/system";
		//$this->loadTemplate($template_path,'template.ini','news');
	}

	public function indexAction() {
		//$this->_helper->viewRenderer->setNoRender();

		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','product');
		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		//echo $this->_namespace;
		if(isset($ssFilter->cart)){
			$this->_arrParam['ssFilter']['cart'] = $ssFilter->cart;
			$tblProduct = new Default_Model_Product();

			$productList = $tblProduct->listItem($this->_arrParam,array('task'=>'cart'));

			//$cart=$cart_session->cart;
			$this->view->productList=$productList;
			$this->view->cart=$ssFilter->cart;
		}else{
			$this->_helper->viewRenderer->setNoRender();
			echo "Gio Hang Trong"	;
		}

	}

	public function addtocartAction(){
		$this->_helper->layout->disableLayout();

		$this->_helper->viewRenderer->setNoRender();
		$cart_session = new Zend_Session_Namespace($this->_namespace);
		$cart=$cart_session->cart;
		//$cart	= Session::get('cart');
		//var_dump($cart);
		$bookID	= $this->_arrParam['productid'];
		$price	= $this->_arrParam['price'];
		if(isset($this->_arrParam['quantity'])){
			$quantity=$this->_arrParam['quantity'];
		}else{
			$quantity=1;
		}
		if(empty($cart)){
			$cart['quantity'][$bookID]	= $quantity;
			$cart['price'][$bookID]		= $price;
		}else{
			if(key_exists($bookID, $cart['quantity'])){
				$cart['quantity'][$bookID]	+=$quantity;
				$cart['price'][$bookID]		= $price * $cart['quantity'][$bookID];
			}else{
				$cart['quantity'][$bookID]	= $quantity;
				$cart['price'][$bookID]		= $price;
			}
		}
		$cart_session->cart=$cart;
		//var_dump($cart);
		//	Session::set('cart', $cart);
		echo count($cart['quantity']);
		//URL::redirect('default', 'book', 'detail', array('book_id' => $bookID));
	}

	public function recaculatecartAction(){
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		$cart_session = new Zend_Session_Namespace($this->_namespace);
		$cart=$cart_session->cart;
		if(isset($_POST)){
			foreach ($_POST['qty'] as $id => $qty) {
				$cart['quantity'][$id]	=$qty;
			}
			$cart_session->cart=$cart;
		}
		//$this->_redirect('/cart');
		//URL::redirect('default', 'cart', 'index');
		$this->_helper->redirector('index', 'cart');


	}
	public function checkoutAction(){
		//	$this->_helper->viewRenderer->setNoRender();

		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		$cart=$ssFilter->cart;

		if(isset($cart)&&!empty($cart)){


			$this->_arrParam['ssFilter']['cart'] = $cart;
			$tblProduct = new Default_Model_Product();
			$productList = $tblProduct->listItem($this->_arrParam,array('task'=>'cart'));
			$this->view->productList=$productList;
			//	var_dump($productList);
		}
		//$cart=$cart_session->cart;
		$this->view->cart=$cart;
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','contact');

		if ($this->_request->isPost()) {
			$validator = new Default_Form_ValidateOrder();
			//$this->_arrParam['contact_title'] = 'Không cần nhập';
			//$this->_arrParam['contact_address'] = 'Không cần nhập';
				
			$validator->validate($this->_arrParam);
			if ($validator->isError()) {
				//echo "come here1";

				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				$this->view->validateResult = "error";
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();

			} else {echo "come here";
			//----- validate du lieu thanh cong. Khong co loi xay ra
			//----- tien hanh luu du lieu vao database

			$tblOrders = new Default_Model_Order();
			$tblOrderProduct = new Default_Model_OrderProduct();
			//$tblProduct = new Default_Model_Product();
			$arrParam = $validator->getData();
			//$arrParam['total']=$_POST['total'];
			$order_id=$tblOrders->saveItem($arrParam,array('task'=>'admin-contact-add'));
			echo "order_id=".$order_id;
			var_dump($_POST['qty']);
			//$tblOrderProduct->saveItem();
			foreach ($_POST['qty'] as $product_id => $amount) {
				//	$cart['quantity'][$product_id]	=$amount;
				$tblOrderProduct->saveItem(array('product_id'=>$product_id,
						'order_id'=>$order_id,
						'amount'=>$amount
				));
				//$tblProduct->SubAmountInStore($product_id,$amount);  // ko can
			}
			//success  ->delete session
			Zend_Session::namespaceUnset($this->_namespace);
			//$cart_session->cart=$cart;

			}
		}
	}
	public function checkoutproductAction(){
		//	$this->_helper->viewRenderer->setNoRender();

		//$ssFilter = new Zend_Session_Namespace($this->_namespace);
		//$cart=$ssFilter->cart;

		//if(isset($cart)&&!empty($cart)){


		//$this->_arrParam['ssFilter']['cart'] = $cart;
		if(isset($_GET['quantity'])){
			$quantity=$_GET['quantity'];
		}else{$quantity=1;
		}
		$this->view->quantity=$quantity;
		$tblProduct = new Default_Model_Product();
		$productList = $tblProduct->getItem($this->_arrParam,array('task'=>'checkoutproduct'));
		$this->view->Item=$productList;
		//	var_dump($productList);
		//}
		//$cart=$cart_session->cart;
		//$this->view->cart=$cart;
		$template_path = TEMPLATE_PATH . "/cnt/system";
		$this->loadTemplate($template_path,'template.ini','product');

		if ($this->_request->isPost()) {
			$validator = new Default_Form_ValidateOrder();
			//$this->_arrParam['contact_title'] = 'Không cần nhập';
			//$this->_arrParam['contact_address'] = 'Không cần nhập';
				
			$validator->validate($this->_arrParam);
			if ($validator->isError()) {
				//echo "come here1";
				//echo "<pre>";
				//print_r($validator);
				//echo "</pre>";

				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				$this->view->validateResult = "error";
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();

			} else {//echo "come here";
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh luu du lieu vao database

				$tblOrders = new Default_Model_Order();
				$tblOrderProduct = new Default_Model_OrderProduct();
				//$tblProduct = new Default_Model_Product();
				$arrParam = $validator->getData();
				//$arrParam['total']=$_POST['total'];
				echo $arrParam['total'];
				$order_id=$tblOrders->saveItem($arrParam,array('task'=>'admin-contact-add'));
				//echo "order_id=".$order_id;
				//var_dump($_POST['qty']);
				$product_id=$this->_arrParam['id'];
				$amount=$_POST['quantity'];
				//$tblOrderProduct->saveItem();
				//	foreach ($_POST['qty'] as $product_id => $amount) {
				//	$cart['quantity'][$product_id]	=$amount;
				$tblOrderProduct->saveItem(array('product_id'=>$product_id,
						'order_id'=>$order_id,
						'amount'=>$amount
				));
				//$tblProduct->SubAmountInStore($product_id,$amount);  // ko can
				//	}
				//$cart_session->cart=$cart;

			}
		}
	}
	public function orderAction(){
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();

	}
	public function deletecartAction(){
		$id=$this->_arrParam['id'];
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
		$cart_session = new Zend_Session_Namespace($this->_namespace);

		$cart=$cart_session->cart;
		//var_dump($cart);
		//echo $id;
		unset($cart['quantity'][$id]);
		unset($cart['price'][$id]);
		//var_dump($cart);
		$cart_session->cart=$cart;
		//die;
		$this->_helper->redirector('index', 'cart');
	}
}
