<?php
class Zendvn_System_Ini {
	
	//------------------------------------------------------------------------------------
	//----- doc cac thong so tu mot file ini co duong dan duoc truyen vao qua tham so
	//----- section trong file ini duoc truyen vao qua tham so
	//----- ket qua duoc tra ve mot mang
	//------------------------------------------------------------------------------------
	public function readIni($filepath,$section = null) {
		$config = new Zend_Config_Ini($filepath, $section);
		return $config->toArray();
	}
	
	//------------------------------------------------------------------------------------
	//----- ghi cac thong so tu mot mang truyen vao qua tham so
	//----- vao mot file INI, duong dan duoc truyen vao qua tham so
	//------------------------------------------------------------------------------------
	public function writeIni($arrParam, $filepath) {		
		$config = new Zend_Config_Writer_Ini();
		$config->setNestSeparator('.');
		
		$objConfig = new Zend_Config($arrParam,true);
	
		$config->write($filepath,$objConfig);
	}
	
}