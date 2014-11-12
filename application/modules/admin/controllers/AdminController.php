<?php
class Admin_AdminController extends Zendvn_Controller_Action {
	
	public function init() {
		$template_path = TEMPLATE_PATH . "/admin/system";
		$this->loadTemplate($template_path,'template.ini','template');
	}
	
	public function indexAction() {
		
	}
}