<?php
class Hi_Resource_FrontController_Plugin_ZFDebug extends Zend_Application_Resource_ResourceAbstract
{
//    protected $_options = array (
//
//    );
    protected $_options = array(
        'plugins' => array(
            'Variables', 
            'Html',
            'File' => array(
                'base_path' => '/path/to/project'
            ),
            'Memory', 
            'Time', 
            'Registry', 
            'Exception',
            

//                       'Database' => array('adapter' => array('standard' => $db)), 

        )
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
    	
        # Instantiate the database adapter and setup the plugin.
        # Alternatively just add the plugin like above and rely on the autodiscovery feature.
        if ($bootstrap->hasPluginResource('db')) {
            $bootstrap->bootstrap('db');
            $db = $bootstrap->getPluginResource('db')->getDbAdapter();
            $options['plugins']['Database']['adapter']['standard'] = $db;
        }
    
        # Setup the cache plugin
        if ($bootstrap->hasPluginResource('cache')) {
            $bootstrap->bootstrap('cache');
            $cache = $bootstrap->getPluginResource('cache')->getDbAdapter();
            $options['plugins']['Cache']['backend'] = $cache->getBackend();
        }
        
//        HiZend_Debug::precho($options);
    	
        //
    	$debug = new ZFDebug_Controller_Plugin_Debug($options);
    	
//    	HiZend_Debug::precho($debug);

    	//
    	$frontController->registerPlugin(
    	   $debug
	    );        
    }
}