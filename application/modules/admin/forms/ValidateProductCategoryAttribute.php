<?php
class Admin_Form_ValidateProductCategoryAttribute {
	
	//----- mang chua tat ca thong bao loi cua form
	protected $_messagesError = null;
	
	//----- mang chua toan bo du lieu cua form sau khi validate
	protected $_arrData = null;
	
	//----- mang chua dinh dang cua cac input sau khi validate
	//----- khoi tao mang dinh dang
	protected $_arrStyle;
	
	public function __construct($arrParam = array(), $options = null) {
		//----- khoi tao mang $_arrStyle
		$this->_arrStyle['product_category_id'] = '';
		$this->_arrStyle['attribute_name'] = '';
		$this->_arrStyle['order'] = '';	
	}
	
	public function validate($arrParam = array(), $options = null) {
		
		//===============================================================
		//========== kiem tra product_category_id =======================
		//===== phai chon mot product category khi tao thuoc tinh san pham
		//===============================================================
		
		if ($arrParam['product_category_id'] == 0) {
			$this->_messagesError['product_category_id'] = 'Product Catagory: You must choose a product category';
			$arrParam['product_category_id'] = '';
			$this->_arrStyle['product_category_id'] = 'border: 1px solid red;';
		}
		
		//===============================================================
		//========== kiem tra attribute_name =================================
		//===== khong duoc rong. do dai 3 den 255 ky tu. Chi duoc chua a-z, A-Z, -, _, .
		//===============================================================
		$validator = new Zend_Validate();
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(3,255),true);
		if (!$validator->isValid($arrParam['attribute_name'])) {
			$message = $validator->getMessages();
			$this->_messagesError['attribute_name'] = 'Attribute Name: ' . current($message);
			$arrParam['attribute_name'] = '';
			$this->_arrStyle['attribute_name'] = 'border: 1px solid red;';
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
		$tblProCatAttr = new Admin_Model_ProductCategoryAttribute();
		
		//----- validate cho truong hop xoa mot doi tuong
		if ($options['task'] == 'validate-delete-productcategoryattribute') {
			$productcount = $tblProCatAttr->getItem($arrParam,array('task'=>'count-product-have-this-attribute'));
			if ($productcount > 0) {
				$thisProCatAttr = $tblProCatAttr->getItem($arrParam,array('task'=>'admin-productcategoryattribute-info'));
				$attribute_name = $thisProCatAttr['attribute_name'];
				$this->_messagesError = "You can't delete product attribute \"" . $attribute_name . "\". There're still "
											. $productcount . " products have this attribute!";
			}
		}
		
		//----- validate cho truong hop xoa nhieu doi tuong
		if ($options['task'] == 'validate-delete-multi-productcategoryattribute') {
			if (count($arrParam['cid'] > 0)) {
				
				$cid = $arrParam['cid'];
				foreach ($cid as $key=>$val) {
					//----- validate tung doi tuong mot, voi id lay tu mang cid truyen vao
					//----- neu doi tuong xoa duoc thi dinh dang messageError[doituong_id] = ok
					//----- neu doi tuong khong xoa duoc thi dinh dang messageError[doituong_id] = You cant...
					$productcount = $tblProCatAttr->getItem(array('id'=>$val),array('task'=>'count-product-have-this-attribute'));

					if ($productcount > 0) {
						$thisProCatAttr = $tblProCatAttr->getItem(array('id'=>$val),array('task'=>'admin-productcategoryattribute-info'));
						$attribute_name = $thisProCatAttr['attribute_name'];
						$this->_messagesError[$val] = "You can't delete attribute \"" . $attribute_name . "\". There're still "
													. $productcount . " products have this attribute!";
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