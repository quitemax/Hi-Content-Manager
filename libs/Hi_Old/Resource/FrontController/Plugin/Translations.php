<?php
class Hi_Resource_FrontController_Plugin_Translations extends Zend_Application_Resource_ResourceAbstract
{
//    protected $_options = array (
//
//    );

    public function  init()
    {
    	//
    	$bootstrap = $this->getBootstrap();
    	$bootstrap->bootstrap('frontController');

    	//
    	$frontController = $bootstrap->getResource('frontController');
    	
    	
    	$bootstrap = $this->getBootstrap();
        $bootstrap->bootstrap('langs');
        
        $langs = $bootstrap->getResource('langs');

    	//
    	$options = $this->getOptions();

    	//
    	$frontController->registerPlugin(
	        new HiZend_Controller_Plugin_Translations(
	           $langs->lang
	        )
	    );
    }
}