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

        //initialize Block Renderer
        $this->initializeDispatchListener($e);

    }

    public function initializeDispatchListener($e)
    {
        // Register a dispatch event
        $app = $e->getParam('application');
        $app->events()->attach('route', array($this, 'initializeUrlHelper'), -100);
    }

    public function initializeUrlHelper($e)
    {
        $app = $e->getParam('application');
        $service      = $app->getServiceManager();
        $renderer     = $service->get('ViewBlockRenderer');
        $plugin = $renderer->plugin('url');

//        \Zend\Debug::dump($plugin, '$plugin');

        $matches    = $e->getRouteMatch();

        $plugin->setRouteMatch($matches);
    }


    public function initializeView($e)
    {
        $app          = $e->getParam('application');
        $basePath     = $app->getRequest()->getBasePath();
        $service      = $app->getServiceManager();
        $renderer     = $service->get('ViewBlockRenderer');
        $plugin = $renderer->plugin('basePath');
        $plugin->setBasePath($basePath);

        $renderer->headTitle()->setSeparator(' - ')
                  ->setAutoEscape(false);

//        $basePath = $this->basePath();
        $renderer->headLink()->appendStylesheet($basePath . '/css/bootstrap/css/bootstrap.min.css')
                         ->appendStylesheet($basePath . '/css/bootstrap/css/bootstrap-responsive.min.css')
                         ->appendStylesheet($basePath . '/css/style.css')
//                 ->appendStylesheet($basePath . '/css/widget.css')
        ;

        $renderer->headLink(array(
            'rel'  => 'shortcut icon',
            'type' => 'image/vnd.microsoft.icon',
            'href' => $basePath . '/images/favicon.ico',
        ));

        // HTML5 shim, for IE6-8 support of HTML elements

        //$this->headScript()->appendFile($basePath . '/js/html5.js', 'text/javascript',
        //    array('conditional' => 'lt IE9',));



        $renderer->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js', 'text/javascript');
        $renderer->headScript()->appendFile('https://raw.github.com/carlo/jquery-base64/master/jquery.base64.js', 'text/javascript');

        $renderer->headScript()->appendFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.js', 'text/javascript');

        //$this->headLink()->appendStylesheet('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/base/jquery-ui.css', 'screen');

        $renderer->headScript()->appendFile($basePath . '/css/bootstrap/js/bootstrap.min.js', 'text/javascript');

        $renderer->headScript()->appendFile($basePath . '/js/js.js', 'text/javascript');

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
