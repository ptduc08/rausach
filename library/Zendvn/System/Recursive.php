<?php
class Zendvn_System_Recursive {
	
	//------------------------------------------------------------------------------------
	//----- mang $sourceArr chua danh sach tat ca category, moi category co parent_category_id
	//----- sap xep lai mang $sourceArr theo dung quan he cha-con
	//----- dua ket qua vao mang $resultArr
	//------------------------------------------------------------------------------------
	public function recursive($sourceArr, $parent=0, $level = 1, &$resultArr) {
		if (count($sourceArr) > 0) {
			foreach ($sourceArr as $key=>$value) {
				if ($value['parent_category_id'] == $parent) {
					$value['level'] = $level;
					$resultArr[] = $value;
					$newParent = $value['id'];
					unset($sourceArr[$key]);
					$this->recursive($sourceArr, $newParent, $level+1, $resultArr);
				}
			}
		}
	}
	
	//------------------------------------------------------------------------------------
	//----- trong mot he thong category co nhieu cap, cap con chua parent_category_id
	//----- la id cua category cap cha. Toan bo chua trong mang $categoryArr
	//----- khi biet id cua mot category. Can tim ra id cua category cap tren cung (root)
	//----- cua id do
	//------------------------------------------------------------------------------------
	public function findRootID($categoryArr, $categoryID) {
		if (count($categoryArr) > 0) {
			foreach($categoryArr as $key=>$value) {
				if ($value['id'] == $categoryID) {
					if ($value['parent_category_id'] == 0) {
						return $value['id'];
					} else {
						$newCategoryID = $value['parent_category_id'];
						unset($categoryArr[$key]);
						return $this->findRootID($categoryArr, $newCategoryID);
					}
				}
			}
		} else {
			return 0;
		}
		
	}
	
	//------------------------------------------------------------------------------------
	//----- mang $itemArr chua danh sach cac item, moi item co category_id
	//----- mang $categoryArr chua he thong category, moi category co parent_category_id
	//----- $rootCategoryID la ID cua category cap tren cung ma muon loc item theo
	//----- $countItem: la so item muon tra ve
	//----- ham se tra ve la mang moi chua danh sach so item da duoc loc
	//------------------------------------------------------------------------------------
	public function filterItemtoRootCategory($itemArr, $categoryArr, $rootCategoryID, $countItem) {
		$resultArr = array();
		for ($i = 0; $i < $countItem; $i++) {
			if (count($itemArr) > 0) {
				foreach($itemArr as $itemKey=>$itemValue) {
					if ($this->findRootID($categoryArr, $itemValue['category_id']) == $rootCategoryID) {
						$resultArr[] = $itemValue;
						
						unset($itemArr[$itemKey]);
						break;
					}
				}
			}
		}
		return $resultArr;
	}
	
	//------------------------------------------------------------------------------------
	//----- kiem tra mot category ID co thuoc nhanh cua mot Category cap tren khong
	//----- mang $categoryArr chua danh sach tat ca category
	//----- $descendantCatID: Id cua category cap duoi
	//----- $ancestorCatID: Id cua category cap tren
	//------------------------------------------------------------------------------------
	public function checkAncestorCategory($categoryArr, $descendantCatID, $ancestorCatID) {
		if (count($categoryArr) > 0) {
			foreach($categoryArr as $key=>$value) {
				if ($value['id'] == $descendantCatID) {
					if ($value['parent_category_id'] == $ancestorCatID) {
						return true;
					} else if ($value['parent_category_id'] == 0) {
						return false;
					} else {
						$newDescendantCatID = $value['parent_category_id'];
						unset($categoryArr[$key]);
						return $this->checkAncestorCategory($categoryArr, $newDescendantCatID, $ancestorCatID);
					}
				}
				
				
			}
		}
	}
	
	//------------------------------------------------------------------------------------
	//----- mang $itemArr chua danh sach cac item, moi item co category_id
	//----- mang $categoryArr chua he thong category, moi category co parent_category_id
	//----- $rootCategoryID la ID cua category cap tren cung ma muon loc item theo
	//----- $countItem: la so item muon tra ve
	//----- ham se tra ve la mang moi chua danh sach so item da duoc loc
	//------------------------------------------------------------------------------------
	public function filterItemtoCategory($itemArr, $categoryArr, $ancestorCatID, $countItem) {
		$resultArr = array();
		for ($i = 0; $i < $countItem; $i++) {
			if (count($itemArr) > 0) {
				foreach($itemArr as $itemKey=>$itemValue) {
					$descendantCatID = $itemValue['category_id'];
					if ($this->checkAncestorCategory($categoryArr, $descendantCatID, $ancestorCatID)) {
						$resultArr[] = $itemValue;
						unset($itemArr[$itemKey]);
						break;
					}
				}
			}
		}
		return $resultArr;
	}
	
	//------------------------------------------------------------------------------------
	//----- mang $categoryArr chua he thong category, moi category co parent_category_id
	//----- $ancestorCatID la ID cua category cap tren ma muon tim tat ca category con cua no
	//----- ham se tra ve la mot mang chua id cua tat ca sub category cua $ancestorCatID
	//------------------------------------------------------------------------------------
	public function getAllSubCategoryId($categoryArr, $ancestorCatID, &$resultArr) {
		if (count($categoryArr) > 0) {
			foreach($categoryArr as $key=>$value) {
				if ($value['id'] == $ancestorCatID) {
					$resultArr[] = $value['id'];
					unset($categoryArr[$key]);
				}
				if ($value['parent_category_id'] == $ancestorCatID) {
					$resultArr[] = $value['id'];
					$newAncestorCatID = $value['id'];
					unset($categoryArr[$key]);
					$this->getAllSubCategoryId($categoryArr, $newAncestorCatID, $resultArr);
				}
			}
		}
	}
}