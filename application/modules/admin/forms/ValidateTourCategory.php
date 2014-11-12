<?php
class Admin_Form_ValidateTourCategory {
	
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
		//===== khong duoc rong. do dai 3 den 32 ky tu. Chi duoc chua a-z, A-Z, -, _, .
		//===== khong duoc ton tai trong database (tru chinh no trong truong hop
		//===== action la edit)
		//===============================================================
		switch ($arrParam['action']) {
			case 'add':
				$options = array('table'=>'tour_category','field'=>'category_name');
				break;
			case 'edit':
				$clause = ' id != ' . $arrParam['id'];
				$options = array('table'=>'tour_category','field'=>'category_name','exclude'=>$clause);
				break;
			case 'sort':
				$clause = ' id != ' . $arrParam['id'];
				$options = array('table'=>'tour_category','field'=>'category_name','exclude'=>$clause);
				break;
			default:
				$options = array('table'=>'tour_category','field'=>'category_name');
		}
		
		$validator = new Zend_Validate();
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(3,255),true)
				  //->addValidator(new Zend_Validate_Regex('#^[a-zA-Z0-9\-_\.\s]+$#'),true)
				  ->addValidator(new Zend_Validate_Db_NoRecordExists($options));
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
		//========== kiem tra so luong phan tu thuoc category nay  ======
		//===== neu category co thanh vien thi tra ve bao loi, khong xoa duoc
		//===============================================================
		$tblTourCat = new Admin_Model_TourCategory();
		
		//----- validate cho truong hop xoa mot category
		if ($options['task'] == 'validate-delete-tourcategory') {
			$tourmembercount = $tblTourCat->getItem($arrParam,array('task'=>'count-tourcategory-members'));
			if ($tourmembercount > 0) {
				$thisTourCat = $tblTourCat->getItem($arrParam,array('task'=>'admin-tourcategory-info'));
				$category_name = $thisTourCat['category_name'];
				$this->_messagesError = "You can't delete this category \"" . $category_name . "\". There're still "
											. $tourmembercount . " member of this category!";
			}
			$childCategoryCount = $tblTourCat->getItem($arrParam,array('task'=>'count-tourcategory-childcategory'));
			if ($childCategoryCount > 0) {
				$thisTourCat = $tblTourCat->getItem($arrParam,array('task'=>'admin-tourcategory-info'));
				$category_name = $thisTourCat['category_name'];
				$this->_messagesError .= "<br/>You can't delete this category \"" . $category_name . "\". There're still "
				. $childCategoryCount . " child category of this category!";
			}
		}
		
		//----- validate cho truong hop xoa nhieu category
		if ($options['task'] == 'validate-delete-multi-tourcategory') {
			if (count($arrParam['cid'] > 0)) {
				
				$cid = $arrParam['cid'];
				foreach ($cid as $key=>$val) {
					//----- validate tung category mot, voi category_id lay tu mang cid truyen vao
					//----- neu category xoa duoc thi dinh dang messageError[category_id] = ok
					//----- neu category khong xoa duoc thi dinh dang messageError[category_id] = You cant...
					$tourmembercount = $tblTourCat->getItem(array('id'=>$val),array('task'=>'count-tourcategory-members'));
					$childCategoryCount = $tblTourCat->getItem(array('id'=>$val),array('task'=>'count-tourcategory-childcategory'));
					
					$deleteFlag = true;
					if ($tourmembercount > 0) {
						$thisTourCat = $tblTourCat->getItem(array('id'=>$val),array('task'=>'admin-tourcategory-info'));
						$category_name = $thisTourCat['category_name'];
						$this->_messagesError[$val] = "You can't delete this category \"" . $category_name . "\". There're still "
													.$tourmembercount ." member of this category!<br/>";
						$deleteFlag = false;
					}
					if ($childCategoryCount > 0) {
						$thisTourCat = $tblTourCat->getItem(array('id'=>$val),array('task'=>'admin-tourcategory-info'));
						$category_name = $thisTourCat['category_name'];
						$this->_messagesError[$val] .= "You can't delete this category \"" . $category_name . "\". There're still "
													.$childCategoryCount ." child category of this category!";
						$deleteFlag = false;
					}
					
					if ($deleteFlag == true) {
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