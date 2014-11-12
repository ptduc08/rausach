<?php
class Admin_Form_ValidateProductCategory {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle;
	
	public function __construct($arrParam = array(), $options = null) {
		//----- khoi tao mang $_arrStyle
		$this->_arrStyle['category_name'] = '';
		$this->_arrStyle['order'] = '';	
	}
	
	public function validate($arrParam = array(), $options = null) {
		
		//===============================================================
		//========== kiem tra category_name =================================
		//===== khong duoc rong. do dai 3 den 255 ky tu. Chi duoc chua a-z, A-Z, -, _, .
		//===== khong duoc ton tai trong database (tru chinh no trong truong hop
		//===== action la edit)
		//===============================================================
		switch ($arrParam['action']) {
			case 'add':
				$options = array('table'=>'product_category','field'=>'category_name');
				break;
			case 'edit':
				$clause = ' id != ' . $arrParam['id'];
				$options = array('table'=>'product_category','field'=>'category_name','exclude'=>$clause);
				break;
			case 'sort':
				$clause = ' id != ' . $arrParam['id'];
				$options = array('table'=>'product_category','field'=>'category_name','exclude'=>$clause);
				break;
			default:
				$options = array('table'=>'product_category','field'=>'category_name');
		}
		
		$validator = new Zend_Validate();
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(3,255),true);
		if (!$validator->isValid($arrParam['category_name'])) {
			$message = $validator->getMessages();
			$this->_messagesError['category_name'] = 'Category Name: ' . current($message);
			$arrParam['category_name'] = '';
			$this->_arrStyle['category_name'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//========== kiem tra order =================================
		//===== khong duoc rong. Phai la so nguyen >= 0
		//===============================================================
		$validator = new Zend_Validate();
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_Int(),true);
		if (!$validator->isValid($arrParam['order'])) {
			$message = $validator->getMessages();
			$this->_messagesError['order'] = 'Order: ' . current($message);
			$arrParam['order'] = '';
			$this->_arrStyle['order'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//===== TRUYEN CAC GIA TRI CUA CAC INPUT SAU KHI VALIDATE
		//===== VAO MANG $_arrData DE TRUYEN NGUOC LAI RA FORM
		//===============================================================
		$this->_arrData = $arrParam;
	}
	
	public function validateOrder($arrParam = array(), $options = null) {
		//===============================================================
		//========== kiem tra order =================================
		//===== khong duoc rong. Phai la so nguyen >= 0
		//===============================================================
		$validator = new Zend_Validate();
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_Int(),true);
		$arrOrder = $arrParam['order'];
		if (count($arrOrder) > 0) {
			foreach ($arrOrder as $key=>$val) {
				if (!$validator->isValid($arrOrder[$key])) {
					$message = $validator->getMessages();
					$this->_messagesError['order[' . $key . ']'] = 'Order: ' . current($message);
					$arrParam['order'][$key] = '';
					$this->_arrStyle['order'][$key] = 'border: 1px solid red;';
				}
			}
			
		}
		
		//===============================================================
		//===== TRUYEN CAC GIA TRI CUA CAC INPUT SAU KHI VALIDATE
		//===== VAO MANG $_arrData DE TRUYEN NGUOC LAI RA FORM
		//===============================================================
		$this->_arrData = $arrParam;
	}
	
	public function validateDelete($arrParam = array(), $options = null) {
		//===============================================================
		//========== kiem tra so luong san pham thuoc nhom nay  ======
		//===== neu nhom co san pham thi tra ve bao loi, khong xoa duoc
		//===============================================================
		$tblProCat = new Admin_Model_ProductCategory();
		
		//----- validate cho truong hop xoa mot category
		if ($options['task'] == 'validate-delete-productcategory') {
			$productcount = $tblProCat->getItem($arrParam,array('task'=>'count-productcategory-members'));
			if ($productcount > 0) {
				$thisProCat = $tblProCat->getItem($arrParam,array('task'=>'admin-productcategory-info'));
				$category_name = $thisProCat['category_name'];
				$this->_messagesError = "You can't delete product category \"" . $category_name . "\". There're still "
											. $productcount . " products of this category!";
			}
		}
		
		//----- validate cho truong hop xoa nhieu group
		if ($options['task'] == 'validate-delete-multi-productcategory') {
			if (count($arrParam['cid'] > 0)) {
				
				$cid = $arrParam['cid'];
				foreach ($cid as $key=>$val) {
					//----- validate tung category mot, voi category_id lay tu mang cid truyen vao
					//----- neu category xoa duoc thi dinh dang messageError[category_id] = ok
					//----- neu category khong xoa duoc thi dinh dang messageError[category_id] = You cant...
					$productcount = $tblProCat->getItem(array('id'=>$val),array('task'=>'count-productcategory-members'));

					if ($productcount > 0) {
						$thisProCat = $tblProCat->getItem(array('id'=>$val),array('task'=>'admin-productcategory-info'));
						$category_name = $thisProCat['category_name'];
						$this->_messagesError[$val] = "You can't delete news category \"" . $category_name . "\". There're still "
													. $productcount . " news of this category!";
					} else {
						$this->_messagesError[$val] = 'ok';
					}
				}
			}
		}
	}
	
	//----- kiem tra du lieu validate co loi hay khong
	//----- tra ve true neu co loi. Tra ve false neu khong co loi
	public function isError() {
		if (count($this->_messagesError) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	//----- tra ve mang chua cac thong bao loi
	public function getMessageError() {
		return $this->_messagesError;
	}
	
	//----- tra ve mang chua toan bo du lieu sau khi validate
	public function getData($options = null) {
		return $this->_arrData;
	}
	
	//----- tra ve mang dinh dang cho cac input sau khi validate
	public function getStyle($options = null) {
		return $this->_arrStyle;
	}
	
}