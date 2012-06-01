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
        //initialize Block Renderer
        $this->initializeBlockRenderer($e);

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
