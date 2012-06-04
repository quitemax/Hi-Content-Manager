<?php

namespace HiBase;

//use Zend\ModuleManager\ModuleManager;


class Module
{
//    public function init(ModuleManager $moduleManager)
//    {
//        $events       = $moduleManager->events();
//        $sharedEvents = $events->getSharedManager();
////        $sharedEvents->attach('bootstrap', 'bootstrap', array($this, 'initializeBlockRenderer'), 100);
//    }
//    public function getServiceConfiguration()
//    {
//    }

    public function onBootstrap($e)
    {

        //initialize View
        $this->initializeView($e);

        //initialize Block Renderer
        $this->initializeBlockRenderer($e);

    }


    public function initializeView($e)
    {
        $app          = $e->getParam('application');
        $basePath     = $app->getRequest()->getBasePath();
//        \Zend\Debug::dump($basePath);
        $service      = $app->getServiceManager();
        $renderer     = $service->get('ViewBlockRenderer');
        $plugin = $renderer->plugin('basePath');
//        \Zend\Debug::dump(get_class($renderer->plugin('basePath')));
//        \Zend\Debug::dump($renderer->plugin('basePath'));
        $plugin->setBasePath($basePath);
//        \Zend\Debug::dump($plugin(), '$plugin');

//        $plugin = $renderer->plugin('basePath');
//        \Zend\Debug::dump($plugin(), '$plugin');
//        $renderer->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js', 'text/javascript');
//        $renderer->headScript()->appendFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.js', 'text/javascript');
//        $renderer->headLink()->appendStylesheet('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/base/jquery-ui.css', 'screen');
//
    }

    public function initializeBlockRenderer($e)
    {
        $app              = $e->getParam('application');
        $service          = $app->getServiceManager();

        $config    = $service->get('Configuration');
//        \Zend\Debug::dump($config);

        $blockStrategy     = $service->get('ViewBlockStrategy');
        $view              = $service->get('View');
        $view->events()->attach($blockStrategy, 100);


    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


}
