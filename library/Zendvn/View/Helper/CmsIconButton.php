<?php
class Zendvn_View_Helper_CmsIconButton extends Zend_View_Helper_Abstract {
	
	public function cmsIconButton($title = '',$imgLink , $link = null, $type=null) {
		if ($link == null) {
			switch ($type) {
				case 'css':
					$xhtml = '<i class="' .$imgLink . '"></i>';
					break;
				case 'image':
					$xhtml ='<img src="' .$imgLink .'" title="' .$title .'"';
					break;
				default:
					$xhtml ='<img src="' .$imgLink .'" title="' .$title .'"';
			}
			
		} else {
			switch ($type) {
				case 'css':
					$xhtml ='<a href="' .$link .'">
								<i class="' .$imgLink .'" title = "' .$title .'"></i>
							</a>';
					break;
				case 'image':
					$xhtml ='<a href="' .$link .'">
								<img src="' .$imgLink .'" title = "' .$title .'">
							</a>';
					break;
				default:
					$xhtml ='<a href="' .$link .'">
								<img src="' .$imgLink .'" title = "' .$title .'">
							</a>';
			}
			
		}
		return $xhtml;
	}
}