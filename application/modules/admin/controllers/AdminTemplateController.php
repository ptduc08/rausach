<?php
class Admin_AdminTemplateController extends Zendvn_Controller_Action {
	
	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;

	//----- duong dan cua controller
	protected $_currentController;
	
	//----- duong dan cua Action mac dinh
	protected $_actionMain;
	
	//----- mang chua thong so phan trang
	protected $_paginator = array(
									'itemCountPerPage'=>10,
									'pageRange'=>3				
								);
	
	//----- bien chua ten session namespace
	protected $_namespace;
	
	//----- bien chua doi tuong translate
	protected $_translate;
	
	public function init() {
		//----- mang chua toan bo tham so nhan duoc o moi Action
		$this->_arrParam = $this->_request->getParams();
		
		//----- bien session luu toan bo ten cac session khac duoc tao trong qua trinh chay ung dung
		//----- moi khi co mot session duoc tao ra thi ten cua no se duoc luu vao day
		$ssAppSessionList = new Zend_Session_Namespace('app-session-list');
		
		//----- duong dan cua controller
		$this->_currentController = '/' . $this->_arrParam['module'] .
									'/' . $this->_arrParam['controller'];
		
		//----- duong dan cua Action mac dinh
		$this->_actionMain = $this->_currentController . '/index';
		
		//----- thiet lap trang hien tai cho doi tuong phan trang
		$this->_paginator['currentPage'] = $this->_request->getParam('page',1);
		$this->_arrParam['paginator'] = $this->_paginator;
		
		//----- lay bien translate tu Registry
		$this->_translate = Zend_Registry::get('Zend_Translate');
		
		//----- tao bien session luu cac du lieu nhu filter, sort...
		$this->_namespace = $this->_arrParam['module'] .'-' .$this->_arrParam['controller'];
		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		$ssAppSessionList->sessionList .= ':' .$this->_namespace;
		
		if (empty($ssFilter->col)) {
			//----- tu khoa tim kiem
			$ssFilter->keywords = '';
			//----- cot sap xep
			$ssFilter->col = 'g.id';
			//----- huong sap xep
			$ssFilter->order = 'DESC';
		}
		//----- dua cac gia tri trong session ssFilter vao mang tham so _arrParam
		$this->_arrParam['ssFilter']['keywords'] = $ssFilter->keywords;
		$this->_arrParam['ssFilter']['col'] = $ssFilter->col;
		$this->_arrParam['ssFilter']['order'] = $ssFilter->order;
		
		//----- truyen ra view
		$this->view->arrParam = $this->_arrParam;
		$this->view->currentController = $this->_currentController;
		$this->view->actionMain = $this->_actionMain;
		
		$template_path = TEMPLATE_PATH . "/admin/system";
		$this->loadTemplate($template_path,'template.ini','template');
	}

	public function indexAction() {
		$this->view->Title = $this->_translate->_('admin-gallery-index-title');
		$this->view->headTitle($this->view->Title,true);
		
		//----- lay danh sach tat ca gallery trong bang gallery
		$tblGallery = new Admin_Model_Gallery();		
		$allGallery = $tblGallery->listItem($this->_arrParam,array('task'=>'admin-gallery-list'));
		$this->view->Items = $allGallery;
		
		//----- lay tong so phan tu de phan trang
		$totalGallery = $tblGallery->countItem($this->_arrParam,null);
		$paginator = new Zendvn_Paginator();
		$paginator = $paginator->createPaginator($totalGallery, $this->_paginator);
		$this->view->paginator = $paginator;
	}
	
	public function advertiseAction() {
		$this->view->Title = $this->_translate->_('admin-template-advertise-title');
		$this->view->headTitle($this->view->Title,true);
	
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateTemplateImage();
			$validator->validate($this->_arrParam,array('task'=>'validate-advertise-image'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
	
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh upload anh len server
				$image_name = $validator->uploadFile(array('task'=>'upload-advertise-image'));
				//$this->_redirect($this->_actionMain);
				$successMessage = array('Upload Advertise image thành công');
				$this->view->messageError = $successMessage;
				
				$objIni = new Zendvn_System_Ini();
				//----- doc toan bo file /configs/image-list.ini vao mang $imageList
				$filepath = APPLICATION_PATH . '/configs/image-list.ini';
				$imageList = $objIni->readIni($filepath);
				//----- lay ra khu vuc homepageAdvertiseImage trong mang $imageList
				if (isset($imageList['production']['homepageAdvertiseImage'])) {
					$homepageAdvertiseImage = $imageList['production']['homepageAdvertiseImage'];
				} else {
					$homepageAdvertiseImage = array();
				}
				
				//----- lay key lon nhat trong mang
				if (count($homepageAdvertiseImage) > 0) {
					$maxAdvertiseImage = max(array_keys($homepageAdvertiseImage));
				} else {
					$maxAdvertiseImage = 0;
				}
				
				//----- chi gioi han toi da 2 key (2 anh quang cao)
				/* if ($maxAdvertiseImage < 2) {
					$newAdvertiseImage = $maxAdvertiseImage + 1;
				} else {
					$newAdvertiseImage = 2;
				} */
				$newAdvertiseImage = $maxAdvertiseImage + 1;
				
				$imageList['production']['homepageAdvertiseImage'][$newAdvertiseImage] =
									array('name'=>$image_name,'link'=>$this->_arrParam['image_link']);

				$objIni->writeIni($imageList, $filepath);
			}
	
		}
	}
	
	public function advertiseDeleteAction() {
		$this->view->Title = $this->_translate->_('admin-gallery-delete-title');
		$this->view->headTitle($this->view->Title,true);
	
		if (isset($this->_arrParam['image'])) {
			$image_name = $this->_arrParam['image'];
			$upload = new Zendvn_File_Upload();
			$filename = FILES_PATH . '/templates/advertise-images/' . $image_name;
			$upload->removeFile($filename);
			
			$objIni = new Zendvn_System_Ini();
			//----- doc toan bo file /configs/image-list.ini vao mang $imageList
		 	$filepath = APPLICATION_PATH . '/configs/image-list.ini';
		 	$imageList = $objIni->readIni($filepath);
		 	//----- lay ra khu vu homepageAdvertiseImage trong mang $imageList
		 	$homepageAdvertiseImageList = $imageList['production']['homepageAdvertiseImage'];
		 	//----- kiem tra trong mang $homepageAdvertiseImageList co gia tri name nao trung voi
		 	//----- ten anh bi xoa thi xoa dong do ra khoi mang $homepageAdvertiseImageList
		 	foreach($homepageAdvertiseImageList as $key=>$value) {
		 		if ($image_name == $value['name']) {
		 			unset($homepageAdvertiseImageList[$key]);
		 		}
		 	}
		 	$imageList['production']['homepageAdvertiseImage'] = $homepageAdvertiseImageList;
		 	
		 	$objIni->writeIni($imageList, $filepath);
			
			$this->_redirect($this->_currentController . '/advertise');
		}
	
	}
	
	public function advertiseEditAction() {
		$this->view->Title = $this->_translate->_('admin-template-advertise-title');
		$this->view->headTitle($this->view->Title,true);
		
		if (isset($this->_arrParam['image'])) {
			$image_name = $this->_arrParam['image'];
			$objIni = new Zendvn_System_Ini();
			//----- doc toan bo file /configs/image-list.ini vao mang $imageList
			$filepath = APPLICATION_PATH . '/configs/image-list.ini';
			$imageList = $objIni->readIni($filepath);
			//----- lay ra khu vu homepageAdvertiseImage trong mang $imageList
			$homepageAdvertiseImageList = $imageList['production']['homepageAdvertiseImage'];
			//----- kiem tra trong mang $homepageAdvertiseImageList co gia tri name nao trung voi
			//----- ten anh can edit thi lay gia tri link cua image
			$image_link = '';
			foreach($homepageAdvertiseImageList as $key=>$value) {
				if ($image_name == $value['name']) {
					$image_link = $value['link'];
				}
			}
			$formdata = array('image_name'=>$image_name,'image_link'=>$image_link);
			$this->view->FormData = $formdata;
			//$imageList['production']['homepageAdvertiseImage'] = $homepageAdvertiseImageList;
			//$objIni->writeIni($imageList, $filepath);
				
			//$this->_redirect($this->_currentController . '/advertise');
		}
			
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateTemplateImage();
			$validator->validate($this->_arrParam,array('task'=>'validate-advertise-image-edit-link'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
		
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh upload anh len server
				$arrParam = $validator->getData();

				$objIni = new Zendvn_System_Ini();
				$filepath = APPLICATION_PATH . '/configs/image-list.ini';
				//----- doc toan bo du lieu trong file configs/image-list.ini ra mang $imageList
				$imageList = $objIni->readIni($filepath);
				$homepageImageList = $imageList['production']['homepageAdvertiseImage'];
				
				//----- tim trong danh sach cac anh, anh nao co ten trung voi ten anh can thay doi link
				//----- thi cap nhat gia tri link cua anh do
				$iniData = array();
				$i = 1;
				if (count($homepageImageList) > 0) {
					foreach ($homepageImageList as $key=>$value) {
						$iniData[$i] = $value;
						if ($value['name'] == $arrParam['image_name']) {
							$iniData[$i]['link'] = $arrParam['image_link'];
						}
						$i = $i + 1;
					}
				}
				
				$iniData = array('production'=>array('homepageAdvertiseImage'=>$iniData));
				$objIni->writeIni($iniData, $filepath);
				
				$this->_redirect($this->_currentController . '/advertise');
				
			}
		
		}
		
	}
	
	public function bannerAction() {
		$this->view->Title = $this->_translate->_('admin-template-banner-title');
		$this->view->headTitle($this->view->Title,true);
	
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateTemplateImage();
			$validator->validate($this->_arrParam,array('task'=>'validate-banner-image'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
		
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh upload anh len server
				$arrParam = $validator->uploadFile(array('task'=>'upload-banner-image'));
				//$this->_redirect($this->_actionMain);
				$successMessage = array('Upload banner thành công');
				$this->view->messageError = $successMessage;
			}
		
		}
	}
	
	public function bannerDeleteAction() {
		$this->view->Title = $this->_translate->_('admin-gallery-delete-title');
		$this->view->headTitle($this->view->Title,true);
	
		if (isset($this->_arrParam['image'])) {
			$image_name = $this->_arrParam['image'];
			$upload = new Zendvn_File_Upload();
			$filename = FILES_PATH . '/templates/banner-slide/' . $image_name;
			$upload->removeFile($filename);
			$this->_redirect($this->_currentController . '/banner');
		}
	
	}
	
	public function companyMapAction() {
		$this->view->Title = $this->_translate->_('admin-template-companymap-title');
		$this->view->headTitle($this->view->Title,true);
	
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateTemplateImage();
			$validator->validate($this->_arrParam,array('task'=>'validate-companymap-image'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
	
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh upload anh len server
				$arrParam = $validator->uploadFile(array('task'=>'upload-companymap-image'));
				//$this->_redirect($this->_actionMain);
				$successMessage = array('Upload map thành công');
				$this->view->messageError = $successMessage;
			}
	
		}
	}
	
	public function documentsAction() {
		$this->view->Title = $this->_translate->_('admin-template-documents-title');
		$this->view->headTitle($this->view->Title,true);
		
		$filepath = APPLICATION_PATH . '/configs/file-list.ini';
		$section = 'documents';
		$objIni = new Zendvn_System_Ini();
		$fileList = $objIni->readIni($filepath,$section);
		$documentList = $fileList['documents'];
		$this->view->documentList = $documentList;
		
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateDocumentFile();
			$validator->validate($this->_arrParam,array('task'=>'validate-document-add-new'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
			
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh upload anh len server
				$document_filename = $validator->uploadFile(array('task'=>'upload-document-file'));
				$successMessage = array('Upload tài liệu thành công');
				$this->view->messageError = $successMessage;
			
				$objIni = new Zendvn_System_Ini();
				//----- doc toan bo file /configs/file-list.ini vao mang $fileList
				$filepath = APPLICATION_PATH . '/configs/file-list.ini';
				$fileList = $objIni->readIni($filepath);
				
				//----- lay ra khu vuc documents trong mang $fileList
				if (isset($fileList['documents']['documents'])) {
					$documentList = $fileList['documents']['documents'];
				} else {
					$documentList = array();
				}
				
				//----- lay key lon nhat trong mang
				if (count($documentList) > 0) {
					$maxDocument = max(array_keys($documentList));
				} else {
					$maxDocument = 0;
				}
				
				$newDocument = $maxDocument + 1;
				
				$fileList['documents']['documents'][$newDocument] =
				array('filename'=>$document_filename,'name'=>$this->_arrParam['document_name']);
				
				$objIni->writeIni($fileList, $filepath);
				
				$this->_redirect($this->_currentController . '/documents');
			}
		
		}
	}
	
	public function documentsDeleteAction() {
		
		if (isset($this->_arrParam['document-file'])) {
			//----- tien hanh xoa file co ten truyen tu URL xuong -----
			$document_filename = $this->_arrParam['document-file'];
			$upload = new Zendvn_File_Upload();
			$filename = FILES_PATH . '/documents/' . $document_filename;
			$upload->removeFile($document_filename);
				
			$objIni = new Zendvn_System_Ini();
			//----- doc toan bo file /configs/file-list.ini vao mang $fileList
			$filepath = APPLICATION_PATH . '/configs/file-list.ini';
			$fileList = $objIni->readIni($filepath);

			//----- lay ra khu vu documents->documents trong mang $fileList
			$documentList = $fileList['documents']['documents'];
			//----- kiem tra trong mang $documentList co gia tri name nao trung voi
			//----- ten anh bi xoa thi xoa dong do ra khoi mang $documentList
			foreach($documentList as $key=>$value) {
				if ($document_filename == $value['filename']) {
					unset($documentList[$key]);
				}
			}
			$fileList['documents']['documents'] = $documentList;
	
			$objIni->writeIni($fileList, $filepath);
				
			$this->_redirect($this->_currentController . '/documents');
		}
	
	}
	
	public function documentsEditAction() {
		$this->view->Title = $this->_translate->_('admin-template-documents-title');
		$this->view->headTitle($this->view->Title,true);
	
		if (isset($this->_arrParam['document-file'])) {
			$document_filename = $this->_arrParam['document-file'];
			$objIni = new Zendvn_System_Ini();
			//----- doc toan bo file /configs/file-list.ini vao mang $fileList
			$filepath = APPLICATION_PATH . '/configs/file-list.ini';
			$fileList = $objIni->readIni($filepath);
			
			//----- lay ra khu vuc documents->documents trong mang $fileList
			$documentList = $fileList['documents']['documents'];
			//----- kiem tra trong mang $documentList co gia tri name nao trung voi
			//----- ten document can edit thi lay gia tri link cua document
			
			$document_name = '';
			foreach($documentList as $key=>$value) {
				if ($document_filename == $value['filename']) {
					$document_name = $value['name'];
				}
			}
			$formdata = array('document_filename'=>$document_filename,'document_name'=>$document_name);
			$this->view->FormData = $formdata;

		}
			
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateDocumentFile();
			$validator->validate($this->_arrParam,array('task'=>'validate-document-edit-name'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
		
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh upload anh len server
				$arrParam = $validator->getData();
		
				$objIni = new Zendvn_System_Ini();
				$filepath = APPLICATION_PATH . '/configs/file-list.ini';
				//----- doc toan bo du lieu trong file configs/file-list.ini ra mang $fileList
				$fileList = $objIni->readIni($filepath);
				$documentList = $fileList['documents']['documents'];
		
				//----- tim trong danh sach cac file, file nao co ten trung voi ten file can thay doi document name
				//----- thi cap nhat gia tri link cua file do
				$iniData = array();
				$i = 1;
				if (count($documentList) > 0) {
					foreach ($documentList as $key=>$value) {
						$iniData[$i] = $value;
						if ($value['filename'] == $arrParam['document_filename']) {
							$iniData[$i]['name'] = $arrParam['document_name'];
						}
						$i = $i + 1;
					}
				}
		
				$iniData = array('documents'=>array('documents'=>$iniData));
				$objIni->writeIni($iniData, $filepath);
		
				$this->_redirect($this->_currentController . '/documents');
		
			}
		
		}
	
	}
	
	public function logoAction() {
		$this->view->Title = $this->_translate->_('admin-template-logo-title');
		$this->view->headTitle($this->view->Title,true);
	
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateTemplateImage();
			$validator->validate($this->_arrParam,array('task'=>'validate-logo-image'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
	
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh upload anh len server
				$arrParam = $validator->uploadFile(array('task'=>'upload-logo-image'));
				//$this->_redirect($this->_actionMain);
				$successMessage = array('Upload logo thành công');
				$this->view->messageError = $successMessage;
			}
	
		}
	}
	
	public function videoAction() {
		$this->view->Title = $this->_translate->_('admin-template-video-title');
		$this->view->headTitle($this->view->Title,true);
	
		if ($this->_request->isPost()) {
			$validator = new Admin_Form_ValidateTemplateVideo();
			$validator->validate($this->_arrParam,array('task'=>'validate-homepage-video'));
			if ($validator->isError()) {
				//----- neu validate du lieu co loi thi lay mang loi truyen ra view
				$message = $validator->getMessageError();
				$this->view->messageError = $message;
				//----- lay du lieu va dinh dang sau khi validate, truyen ra form
				$this->view->FormData = $validator->getData();
				$this->view->FormStyle = $validator->getStyle();
		
			} else {
				//----- validate du lieu thanh cong. Khong co loi xay ra
				//----- tien hanh upload anh len server
				$arrParam = $validator->getData();
				
				$iniData = array('production'=>array('youtube_embed_video1'=>array('title'=>' ','link'=>$arrParam['video_link'])));
				
				$objIni = new Zendvn_System_Ini();
				$filepath = APPLICATION_PATH . '/configs/videolist.ini';
				$objIni->writeIni($iniData, $filepath);
				
				//$this->_redirect($this->_actionMain);
				$successMessage = array('Cập nhật video link thành công');
				$this->view->messageError = $successMessage;
			}
		
		}
	}
}