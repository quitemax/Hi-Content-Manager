<?php

/**
 * boot preconditions
 */
require_once 'boot.php';

//
chdir(dirname(__DIR__));

/**
 * path definitions
 *
 */
//
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

//
define('BASE_PATH', dirname(dirname(__FILE__)));
//
define('MODULES_PATH', BASE_PATH . DS . 'modules');
//
define('VENDOR_PATH', BASE_PATH . DS . 'vendor');
//
define('ZF2_PATH', BASE_PATH . DS . '..' . DS . 'zend' . DS . 'library');
//
define('PUBLIC_PATH', BASE_PATH . DS . 'public');
//
define('SKIN_PATH', PUBLIC_PATH . DS . 'skin');
//
define('MEDIA_PATH', PUBLIC_PATH . DS . 'media');

//
define('BASE_URL', '/sohi/Hi-Content-Manager/public');

/*
 * Ensure libraries are on include_path
 */
set_include_path(implode(PS, array(
    realpath(ZF2_PATH),
    realpath(VENDOR_PATH),
    get_include_path(),
)));

/**
 * autoloader
 *
 */
require_once (getenv('ZF2_PATH') ?: '/../zend/library') . '/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(
    array(
        'Zend\Loader\StandardAutoloader' => array(
            'prefixes' => array(
                'Hi' => VENDOR_PATH . '/Hi',
             ),
             'fallback_autoloader' => true,
        )
    )
);

/**
 * application enviroment
 *
 */
if (!($env = getenv('APPLICATION_ENV'))) {
    $env = 'local';
}

/*
 * Application config
 */
$appConfig = include 'config/application.config.php';


try {

    /**
     *
     *
     */
    $listenerOptions  = new Zend\Module\Listener\ListenerOptions($appConfig['module_listener_options']);
    $defaultListeners = new Zend\Module\Listener\DefaultListenerAggregate($listenerOptions);
    $defaultListeners->getConfigListener()->addConfigGlobPath("config/autoload/{module.*,global,$env,local,database}.config.php");


    /*
     * Application module manager
     */
    $moduleManager = new Zend\Module\Manager($appConfig['modules']);
    $moduleManager->events()->attachAggregate($defaultListeners);
    $moduleManager->loadModules();

    // Create application, bootstrap, and run
    $bootstrap   = new Zend\Mvc\Bootstrap($defaultListeners->getConfigListener()->getMergedConfig());
    $application = new Zend\Mvc\Application;
    $bootstrap->bootstrap($application);
    $application->run()->send();

}
catch (Exception $e) {
    echo "<pre>";
    print_r($e);
    echo "<pre>";
}