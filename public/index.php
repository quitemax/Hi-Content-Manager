<?php
/**
 * boot preconditions
 */
require_once 'boot.php';

/**
 * path definitions
 *
 */
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

define('BASE_PATH', dirname(dirname(__FILE__)));

define('MODULES_PATH', BASE_PATH . DS . 'modules');

define('LIBRARY_PATH', BASE_PATH . DS . 'libs');

define('LIBRARY_ZEND_PATH', BASE_PATH . DS . '..' . DS . 'zend' . DS . 'library');

define('PUBLIC_PATH', BASE_PATH . DS . 'public');

define('SKIN_PATH', PUBLIC_PATH . DS . 'skin');

define('MEDIA_PATH', PUBLIC_PATH . DS . 'media');



define('BASE_URL', '/sohi/Hi-Content-Manager/public');


/*
 * Ensure libraries are on include_path
 */
set_include_path(implode(PS, array(
    realpath(LIBRARY_ZEND_PATH),
    realpath(LIBRARY_PATH),
    get_include_path(),
)));


/**
 * application enviroment
 *
 */
// Define application environment
define('APPLICATION_ENV', 'development');
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));


/**
 * autoloader
 *
 */
//require_once LZP . '/Loader/AutoloaderFactory.php';
//ZendX\Loader\AutoloaderFactory::factory(array(
////    'Zend_Loader_ClassMapAutoloader' => array(
////        __DIR__ . '/../library/.classmap.php',
////        __DIR__ . '/../application/.classmap.php',
////    ),
//    'Zend_Loader_StandardAutoloader' => array(
//        'prefixes' => array(
//            'Hi' => LP . '/Hi',
//        ),
//        'fallback_autoloader' => true,
//    ),
//));
require_once 'Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(
    array(
        'Zend\Loader\StandardAutoloader' => array(
            'prefixes' => array(
                'Hi' => LIBRARY_PATH . '/Hi',
             ),
             'fallback_autoloader' => true,
        )
    )
);


/*
 * Application config
 */
$appConfig = include __DIR__ . '/../configs/application.config.php';



try {
    /*
     * Application module autoloader
     */
    $moduleLoader = new Zend\Loader\ModuleAutoloader($appConfig['module_paths']);
    $moduleLoader->register();

    /*
     * Application module manager
     */
    $moduleManager = new Zend\Module\Manager($appConfig['modules']);
    $listenerOptions = new Zend\Module\Listener\ListenerOptions($appConfig['module_listener_options']);
    $moduleManager->setDefaultListenerOptions($listenerOptions);
    $moduleManager->loadModules();


    /*
     * Create application
     */
    ///** Hi\Application */
    //require_once 'Hi/Application.php';
    //use Hi\Application as Application;
    //
    //$application = new Application(
    //    APPLICATION_ENV,
    //    array (
    //        'bootstrap'             => array(
    //            'path'      => APPLICATION_PATH . '/bootstrap/Bootstrap.php',
    //            'class'     => 'Bootstrap',
    //        ),
    //        'autoloadernamespaces'  => array(
    //            'Hi' => LIBRARY_PATH . DS . 'Hi',
    //        ),
    //        'config'                => APPLICATION_PATH . '/etc/config/default.dev.php',
    //    )
    //);

    /**
     * bootstrap and run
     */
    //try {
    //    $application
    //        ->bootstrap()
    //        ->run();
    //}
    //catch (Exception $e) {
    //    echo "<pre>";
    //    var_dump($e);
    //    echo "<pre>";
    //}


    /*
     * Create application, bootstrap, and run
     */
    $bootstrap      = new Zend\Mvc\Bootstrap($moduleManager->getMergedConfig());
    $application    = new Zend\Mvc\Application;
    $bootstrap->bootstrap($application);
    $application->run()->send();
}
catch (Exception $e) {
    echo "<pre>";
    print_r($e);
    echo "<pre>";
}