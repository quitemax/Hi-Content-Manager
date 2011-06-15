<?php
/**
 * Hi CMS
 *
 *
 * @category   HiZend
 * @package    HiZend_Controller
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */

/** Zend_Controller_Plugin_Abstract */
//require_once 'Zend/Controller/Plugin/Abstract.php';

/**
 * @category   HiZend
 * @package    HiZend_Controller
 * @copyright  Copyright (c) 2009 Piotr Maxymilian Socha
 * @license
 */
class HiZend_Controller_Plugin_Langs extends Zend_Controller_Plugin_Abstract
{
    /**
     * Method checks if the current specified module/controller/action
     * is a valid one in the system. If not - changes the request object
     * so that it points to an error controller.
     *
     * @return void
     */
    public function preDispatch( Zend_Controller_Request_Abstract $request )
    {
        $langsFileName    = APPLICATION_PATH
                                . '/cache/langs.php';

        //
        if (file_exists($langsFileName)) {
            $langs = include $langsFileName;





//            //
//            $translateArray = array();
//            if (isset($translations) && is_array($translations)) {
//                foreach ($translations as $translation) {
//                    $translateArray[$translation['translationKey']] = $translation['translationValue'];
//                }
//            }



//            $adapter = new Zend_Translate('array', $translations, $langSess->lang);
//            Zend_Registry::set('Zend_Translate', $adapter);
        }
    }
}