<?php
class Hi_Resource_FrontController_Plugin_LoggedIn extends Zend_Application_Resource_ResourceAbstract
{
    protected $_options = array (
        'module'        =>  'user',
        'controller'    =>  'log',
        'action'        =>  'in',
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
	        new HiZend_Controller_Plugin_LoggedIn(
	           $options
	        )
	    );
    }
}