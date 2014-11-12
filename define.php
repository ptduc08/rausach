<?php
//------------Duong dan den thu muc chua ung dung
defined('APPLICATION_PATH')
	|| define('APPLICATION_PATH', 
			  realpath(dirname(__FILE__) . '/application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV',
              (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV')
                                         : 'developer'));
			  
//------------Nap duong dan den cac thu vien se su dung trong ung dung
set_include_path(implode(PATH_SEPARATOR, array(
    dirname(__FILE__) . '/library',
    get_include_path(),
)));

//------------KHAI BAO DUONG DAN THUC DEN CAC THU MUC --------------
define('PUBLIC_PATH', realpath(dirname(__FILE__) . '/public'));
define('BLOCK_PATH', realpath(APPLICATION_PATH . '/blocks'));
define('CACHE_PATH', realpath(APPLICATION_PATH . '/caches'));
define('CAPTCHA_PATH', realpath(PUBLIC_PATH . '/captcha'));
define('DEFAULT_BLOCK_PATH', realpath(APPLICATION_PATH . '/modules/default/blocks'));
define('CONFIG_PATH', realpath(APPLICATION_PATH . '/configs'));
define('FILES_PATH', realpath(PUBLIC_PATH . '/files'));
define('SCRIPTS_PATH', realpath(PUBLIC_PATH . '/scripts'));
define('TEMPLATE_PATH', realpath(PUBLIC_PATH . '/templates'));
define('TEMP_PATH', realpath(PUBLIC_PATH . '/temp'));

//------------KHAI BAO DUONG DAN URL DEN CAC THU MUC --------------
define('APPLICATION_URL',''); 
define('SRCIPTS_URL', APPLICATION_URL . '/public/scripts');
define('TEMPLATE_URL', APPLICATION_URL . '/public/templates');
define('CAPTCHA_URL', APPLICATION_URL . '/public/captcha');
define('FILES_URL', APPLICATION_URL . '/rausach-zend/public/files');
define('TEMP_URL', APPLICATION_URL . '/public/temp');

//------------KHAI BAO MOT SO HANG SO QUAN TRONG ------------------
define('INTEGER',1);
define('STRING',3);