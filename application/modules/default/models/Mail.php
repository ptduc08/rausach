<?php
class Default_Model_Mail extends Zend_Db_Table {
	
	public function sendMail($arrParam = null, $options = null) {
		if ($options['task'] == 'website_contact_form') {
			$host = 'mail.dafuco.com.vn';
			$config = array('auth'=>'login',
							//'ssl'=>'tls',
							'port'=>25,
							'username'=>'tungpd@dafuco.com.vn',
							'password'=>'Muaxuan2010');
			$transport = new Zend_Mail_Transport_Smtp($host,$config);
			Zend_Mail::setDefaultTransport($transport);
			
			$mail = new Zend_Mail();
			$mail->setFrom('tungpd@dafuco.com.vn','388IC Website Form');
			$mail->addTo('ductungvn@gmail.com','388IC Manager');
			$mail->setSubject('Website - Lien he');
			$mailContent = 'Đây là email tự động gửi từ website khi có khách hàng điền vào form LIÊN HỆ và nhấn nút Gửi<hr/>' .
							'Tiêu đề: ' .$arrParam['contact_title'] .
							'<br/>Họ tên: ' .$arrParam['contact_name'] .
							'<br/>Địa chỉ: ' .$arrParam['contact_address'] .
							'<br/>Contact Mobile: ' .$arrParam['contact_mobile'] .
							'<br/>Contact Email: ' .$arrParam['contact_email'] .
							'<br/>Nội dung: ' .$arrParam['contact_content'];
			$mail->setBodyHtml($mailContent,'utf-8');
			try{
				$mail->send($transport);
			} catch(Zend_Mail_Exception $e) {echo ($e->getMessage());}
		}
		
		if ($options['task'] == 'website_checktour_form') {
			$host = '112.213.89.80';
			$config = array('auth'=>'login',
					//'ssl'=>'tls',
					'port'=>25,
					'username'=>'website@dreamviettravel.com.vn',
					'password'=>'abc123@');
			$transport = new Zend_Mail_Transport_Smtp($host,$config);
			Zend_Mail::setDefaultTransport($transport);
				
			$mail = new Zend_Mail();
			$mail->setFrom('website@dreamviettravel.com.vn','DreamViettravel Website Form');
			$mail->addTo('ductungvn@gmail.com','DreamViettravel Manager');
			$mail->setSubject('Website - Dat tour');
			$mailContent = 'Đây là email tự động gửi từ website khi có khách hàng điền vào form Đặt tour và nhấn nút Gửi<hr/>' .
							'Tên tour: <strong>' .$arrParam['tour_name'] . '</strong>' .
							'<br/>Yêu cầu khách sạn: ' .$arrParam['tour_hotel_type'] .
							'<br/>Số phòng đơn: ' .$arrParam['tour_room1_count'] .
							'<br/>Số phòng đôi: ' .$arrParam['tour_room2_count'] .
							'<br/>Số phòng ba: ' .$arrParam['tour_room3_count'] .
							'<br/>Ngày khởi hành: ' .$arrParam['tour_startdate'] .
							'<br/>Ngày kết thúc: ' .$arrParam['tour_enddate'] .
							'<br/>Yêu cầu chi tiết: ' .$arrParam['tour_requirement'] .
							'<hr/><br/><strong>Thông tin về khách hàng:</strong>' .
							'<br/>Họ tên: ' .$arrParam['tour_customer_initial'] . $arrParam['tour_customer_name'] .
							'<br/>Email: ' .$arrParam['tour_customer_email'] .
							'<br/>Mobile: ' .$arrParam['tour_customer_mobile'] .
							'<br/>Số lượng người lớn: ' .$arrParam['tour_customer_adult_count'] .
							'<br/>Số lượng trẻ em: ' .$arrParam['tour_customer_child_count'] .
							'<br/>Địa chỉ: ' .$arrParam['tour_customer_address'];
			$mail->setBodyHtml($mailContent,'utf-8');
			try{
				$mail->send($transport);
			} catch(Zend_Mail_Exception $e) {
				echo ($e->getMessage());
			}
		}
		
	}
	
}