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
class HiZend_Controller_Plugin_Translations extends Zend_Controller_Plugin_Abstract
{
	protected $_lang;
	
    /**
     * Constructor
     *
     * Options may include:
     *
     * @param  Array $options
     * @return void
     */
    public function __construct( $lang = null )
    {
        $this->_lang = $lang;
    }

    /**
     *
     * @return void
     */
    public function preDispatch( Zend_Controller_Request_Abstract $request )
    {
    	if ($this->_lang !== null ) {
    		
    		//
	        $translationFileName    = APPLICATION_CACHE_PATH
	                                . '/i18n/i18n.'
	                                . $this->_lang
	                                . '.php';
	                                
	        //
	        if (is_readable($translationFileName)) {
	        	
	        	//
	            $translations = include $translationFileName;
	
	            //
	            $adapter = new Zend_Translate('array', $translations, $this->_lang);
	            Zend_Registry::set('Zend_Translate', $adapter);
	        }
    	}
    }
}