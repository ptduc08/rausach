<?php

class Zendvn_View_Helper_TranslateFront extends Zend_View_Helper_Translate
{
	
    public function translateFront($messageid = null)
    {
        if ($messageid === null) {
            return $this;
        }

        $translate = $this->getTranslator();
        $options   = func_get_args();

        array_shift($options);
        $count  = count($options);
        $locale = null;
        if ($count > 0) {
            if (Zend_Locale::isLocale($options[($count - 1)], null, false) !== false) {
                $locale = array_pop($options);
            }
        }

        if ((count($options) === 1) and (is_array($options[0]) === true)) {
            $options = $options[0];
        }

        if ($translate !== null) {
            $messageid = $translate->translate($messageid, $locale);
        }

        if (count($options) === 0) {
            return $messageid;
        }

        return vsprintf($messageid, $options);
    }
    
    public function getTranslator()
    {
        if ($this->_translator === null) {
            require_once 'Zend/Registry.php';
            if (Zend_Registry::isRegistered('Zend_Translate_Front')) {
                $this->setTranslator(Zend_Registry::get('Zend_Translate_Front'));
            }
        }

        return $this->_translator;
    }

}