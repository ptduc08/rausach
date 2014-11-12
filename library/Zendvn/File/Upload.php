<?php
class Zendvn_File_Upload extends Zend_File_Transfer_Adapter_Http {
	
	public function upload($filename,$upload_dir,$options = null,$prefix = '') {
		
		if ($options == null) {
			//----- Upload khong doi ten tep tin -----
			$this->setDestination($upload_dir,$filename);
			$newFileName = $this->getFileName($filename,false);
			if ($this->isValid($filename)) {
				$this->receive($filename);
			} else {
				$errmsg = $this->getMessages();
				echo current($errmsg);
			}
			
		}
		if ($options['task'] == 'rename') {
			//----- Upload co doi ten tep tin -----
			$filename = $this->getFileName($filename,false);	
			preg_match('#\.([^\.]+)$#', $filename, $matches);	
			$fileExtension = $matches[1];
			$newFileName = $prefix . uniqid(time()) . '.' .$fileExtension;	
			$options = array('target'=>$upload_dir . '/' . $newFileName, 'overwrite'=>true);
			$this->addFilter('Rename',$options,$filename);
				
			if ($this->isValid($filename)) {
				$this->receive($filename);
			} else {
				$errmsg = $this->getMessages();
				echo current($errmsg);
			}
		}
		
		return $newFileName;
	}
	
	public function removeFile($filename) {
		@unlink($filename);
	}
	
	public function removeAllFile($dir) {
		$thisDir = new DirectoryIterator($dir);
		foreach ($thisDir as $fileInfo) {
			if(!$fileInfo->isDot()) {
				unlink($dir . '/' . $fileInfo->getFilename());
			}
		}
	}
}