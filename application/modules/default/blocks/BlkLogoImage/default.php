<?php 
	$dir = new DirectoryIterator(FILES_PATH . '/templates/logo');
	$arrLogoImage = array();
	foreach ($dir as $fileInfo) {
		if(!$fileInfo->isDot()) {
			$arrLogoImage[] = $fileInfo->getFilename();
		}
	}
	if (!empty($arrLogoImage) && count($arrLogoImage) > 0) {
		$logo_image_name = $arrLogoImage[0];
		$logo_image_url = FILES_URL . '/templates/logo/' . $logo_image_name;
?>
		<img src="<?php echo $logo_image_url; ?>" alt="cnt logo" class="logo"/>
<?php
		}
?>