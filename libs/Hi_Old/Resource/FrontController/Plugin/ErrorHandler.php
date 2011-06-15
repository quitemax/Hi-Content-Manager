<?php
class Hi_Resource_FrontController_Plugin_ErrorHandler extends Zend_Application_Resource_ResourceAbstract
{
    protected $_options = array (
        'module'        =>  'default',
        'controller'    =>  'error',
        'action'        =>  'index',
    );

    public function  init()
    {
    	//
    	$bootstrap = $this->getBootstrap();
    	$bootstrap->bootstrap('frontController');

    	//
    	$frontController = $bootstrap->getResource('frontController');

    	//
    	$options = $this->getOptions();

    	//
    	$frontController->registerPlugin(
	        new Zend_Controller_Plugin_ErrorHandler(
	            $options
	        )
	    );
    }
}