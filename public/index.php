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

define('APPLICATION_PATH', BASE_PATH . DS . 'app');

define('LIBRARY_PATH', BASE_PATH . DS . 'libs');

define('LIBRARY_ZEND_PATH', BASE_PATH . DS . '..' . DS . 'zend' . DS . 'library');

define('PUBLIC_PATH', BASE_PATH . DS . 'public');

define('SKIN_PATH', PUBLIC_PATH . DS . 'skin');

define('MEDIA_PATH', PUBLIC_PATH . DS . 'media');



define('BASE_URL', '/sohi/Hi-Content-Manager/public');


/*
 * Ensure libraries is on include_path
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
define('APPLICATION_ENV', 'development');

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




/*
 * Create application
 */
/** Hi\Application */
require_once 'Hi/Application.php';
use Hi\Application as Application;

$application = new Application(
    APPLICATION_ENV,
    array (
        'bootstrap'             => array(
            'path'      => APPLICATION_PATH . '/bootstrap/Bootstrap.php',
            'class'     => 'Bootstrap',
        ),
        'autoloadernamespaces'  => array(
            'Hi' => LIBRARY_PATH . DS . 'Hi',
        ),
        'config'                => APPLICATION_PATH . '/etc/config/default.dev.php',
    )
);

/**
 * bootstrap and run
 */
try {
    $application
        ->bootstrap()
        ->run();
}
catch (Exception $e) {
    echo "<pre>";
    var_dump($e);
    echo "<pre>";
}