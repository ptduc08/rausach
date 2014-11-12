<?php
class Zendvn_System_Acl {
	protected $_acl;
	protected $_role;
	
	public function buildAcl($aclInfo = null, $options = null) {
		if (!empty($aclInfo)) {
			$acl = new Zend_Acl();
			//----- khai bao role
			$role = $aclInfo['role'];
			$acl->addRole(new Zend_Acl_Role($role));
				
			//----- khai bao mang phan quyen. Day la mang chua danh sach cac action muon phan quyen
			$groupPrivileges = $aclInfo['privileges'];
				
			$acl->allow($role,null,$groupPrivileges);
			$this->_acl = $acl;
			$this->_role = $role;
		}
	}
	
	public function isAllow($arrParam = null) {
		$privileges = $arrParam['module'] .'_' .$arrParam['controller'] .'_' .$arrParam['action'];
		$flagAccess = false;
		if ($this->_acl->isAllowed($this->_role,null,$privileges)) {
			$flagAccess = true;
		} else {
			$flagAccess = false;
		}
		return $flagAccess;
	}
	
	//----- tao mang privilege
	//----- dua vao session namespace 'info', bien acl['privileges']
	public function createPrivilegeArray($options = null) {
		//----- lay group_id cua nhom vua dang nhap vao he thong
		$info = new Zendvn_System_Info();
		$group_id = $info->getGroupInfo('id');
		
		//----- lay toan bo privilege trong bang user_group_privilege
		$tblPrivilege = new Admin_Model_Privileges();
		$arrPrivilege = $tblPrivilege->listItem(array('ssFilter'=>array('group_id'=>$group_id)),array('task'=>'admin-privilege-list-all'));
		
		//----- dung ham de quy getGroupAcl lay toan bo privilege (truc tiep va thua ke) cua nhom group_id
		//----- dua vao mang $myGroupAcl
		$myGroupAcl = array();
		$this->getGroupAcl($arrPrivilege,$group_id,$myGroupAcl);
		
		//----- chuyen doi privilege ve thanh dang module_controller_action roi dua len session
		foreach ($myGroupAcl as $key=>$val) {
			$arrPrivileges[] = $val['module'] .'_' .$val['controller'] .'_' .$val['action'];
		}
		
		//----- loai bo cac privilege trung nhau, sap xep lai mang $arrPrivilege
		$arrPrivileges = array_unique($arrPrivileges);
		ksort($arrPrivileges);
		
		//----- dua thong so phan quyen vua lay trong database vao session
		$ns = new Zend_Session_Namespace('info');
		$ns->acl['privileges'] = $arrPrivileges;
	}
	
	//----- tao bien role
	//----- dua vao session namespace 'info', bien acl['role']
	public function createRole($options = null) {
		$info = new Zendvn_System_Info();
		$group_name = $info->getGroupInfo('group_name');
		$ns = new Zend_Session_Namespace('info');
		$ns->acl['role'] = $group_name;
	}
	
	//===============================================================================================
	//----- ham de quy, lay ve danh sach privilege ma mot nhom nhan duoc, 
	//----- tu privilege gan truc tiep cong voi cac privilege thue ke tu nhom cha (neu co)
	//----- mang $arrPrivilege: mang chua toan bo privilege cua tat ca cac nhom lay tu bang user_group_privileges
	//----- $group_id: id cua nhom muon tinh toan ra privilege
	//----- $arrResult: mang chua ket qua danh sach privilege cua nhom group_id
	//===============================================================================================
	public function getGroupAcl($arrPrivilege,$group_id,&$arrResult) {

		if (count($arrPrivilege) > 0) {
			$flag = false;
			foreach($arrPrivilege as $key=>$val) {
				if ($val['group_id'] == $group_id) {
					//----- nghia la nhom nay co it nhat mot privilege duoc gan truc tiep
					//----- lay toan bo cac privilege gan truc tiep truoc
					$flag = true;
					$arrResult[] = $val;
					$parent_group_id = $val['parent_group_id'];
					unset($arrPrivilege[$key]);
				}
			}
			
			//----- truong hop nhom khong co mot privilege nao duoc gan truc tiep
			//----- thi lay parent_group_id, neu > 0 thi goi ham de quy toi chinh parent_group_id do
			if ($flag == false) {
				$tblGroup = new Admin_Model_UserGroup();
				$thisGroup = $tblGroup->getItem(array('id'=>$group_id),array('task'=>'admin-group-info'));
				$parent_group_id = $thisGroup['parent_group_id'];
				
			}
			
			if ($parent_group_id > 0) {
				$this->getGroupAcl($arrPrivilege, $parent_group_id, $arrResult);
			}
			
			
		}
		
	}
	
}