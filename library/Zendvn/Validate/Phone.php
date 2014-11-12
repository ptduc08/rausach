<?php
class Zendvn_Validate_Phone extends Zend_Validate_Abstract {
	const INVALID = 'invalid';

	protected $_messageTemplates = array(
			self::INVALID   => "'%value%' khong phai la so phone",
	);
	
	public function __construct() {
	}
	
	public function isValid($value) {
		$pattern = '#^084-[0-9]{2}-[0-9]{2}\.[0-9]{6}$#';
		if (!preg_match($pattern, $value) != 1) {
			$this->_error('invalid');
			return false;
		}
		return true;
	}
}