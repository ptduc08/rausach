<?php
class Zendvn_Captcha_Image extends Zend_Captcha_Image {
	
	public function __construct() {
		
		//----- thiet lap duong dan den thu muc chua hinh anh duoc tao ra
		$this->setImgDir(CAPTCHA_PATH . '/images');
		
		//----- thiet lap duong dan URL den thu muc chua hinh anh duoc tao ra
		$this->setImgUrl(CAPTCHA_URL . '/images');
		
		//----- thiet lap phan mo rong cua file anh captcha
		$this->setSuffix('.png');
		
		//----- thiet lap chieu dai chuoi captcha
		$this->setWordlen(6);
		
		//----- thiet lap duong dan den font cua captcha
		$this->setFont(CAPTCHA_PATH . '/font/cour.ttf');
		
		//----- thiet lap kich co font cua captch
		$this->setFontSize(40);
		
		//----- thiet lap mat do dau cham va cac dong ke trong file anh captcha
		$this->setDotNoiseLevel(0);
		$this->setLineNoiseLevel(0);
		
		//----- thiet lap kich thuoc cho hinh captcha
		$this->setWidth(240);
		$this->setHeight(80);
		
		//----- thiet lap thoi gian ton tai cua session captcha
		$this->setTimeout(120);
		
		//----- tao captcha
		$this->generate();
		
		//----- dua word captcha vao session captcha
		$thisSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $this->getId());
		$thisSession->word = $this->getWord();
		
		//----- ngay sau khi tao ra captcha thi xoa toan bo anh trong thu muc captcha image
		//----- tru anh captcha vua duoc sinh ra
		$this->removeImage($this->getId());
	}
	
	public function removeImage($captchaID) {
		//----- duong dan den thu muc chua anh captcha duoc tu dong sinh ra
		$pathname = CAPTCHA_PATH . '/images/';
		//----- quet lay toan bo cac file trong thu muc captcha image
		$fileList = scandir($pathname);
		//----- lay ten file anh cua captcha hien tai
		$imgCaptcha = $captchaID . $this->getSuffix();             
		//$captcha_id: captcha_id image vua tao, kiem tra khong xoa image nay
		foreach ($fileList as $file) {
			if($imgCaptcha!=$file){
				$file  = CAPTCHA_PATH . '/images/' . $file;
				//----- de dau @ de neu co loi no se khong hien thi loi
				@unlink($file);
			}
		}
	}
	
}