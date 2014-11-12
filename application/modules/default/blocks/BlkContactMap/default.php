<?php 
	$dir = new DirectoryIterator(FILES_PATH . '/templates/company-map/');
	$arrBannerImages = array();
	foreach ($dir as $fileInfo) {
		if (!$fileInfo->isDot()) {
			$arrBannerImages[] = $fileInfo->getFilename();
		}
	}
	if (!empty($arrBannerImages) && count($arrBannerImages) > 0) {
		$map_image_name = $arrBannerImages[0];
		$map_image_url = FILES_URL . '/templates/company-map/' . $map_image_name;
	}
?>

<img src="<?php echo $map_image_url; ?>" alt="cnt logistics company map" class="img-thumbnail company-map" />