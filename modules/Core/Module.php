<?php

namespace Core;

use Zend\Module\Consumer\AutoloaderProvider,
    Zend\Module\Manager,
    InvalidArgumentException,
    Zend\Config\Config,
    Zend\Di\Locator,
    Zend\Dojo\View\HelperLoader as DojoLoader,
    Zend\EventManager\EventCollection,
    Zend\EventManager\StaticEventCollection,
    Zend\EventManager\StaticEventManager;

class Module implements AutoloaderProvider
{

    protected $view;
    protected $viewListener;

    public function init(Manager $moduleManager)
    {
        $events = StaticEventManager::getInstance();
//        $events->attach('bootstrap', 'bootstrap', array($this, 'initializeView'));
        $events->attach('bootstrap', 'bootstrap', array($this, 'initView'));
//        $events->attach('bootstrap', 'bootstrap', array($this, 'registerApplicationListeners'), -10);
//        $events->attach('bootstrap', 'bootstrap', array($this, 'registerStaticListeners'), -10);
    }

    public function initView($e)
    {

        $app     = $e->getParam('application');
        $config  = $e->getParam('config');

        //
        $locator = $app->getLocator();
        $router  = $app->getRouter();

        //
        $view    = $locator->get('view');
        $viewListener = $this->getViewListener($view, $config);


        $app->events()->attachAggregate($viewListener);

        $events       = StaticEventManager::getInstance();
        $viewListener->registerStaticListeners($events, $locator);

        $view->doctype('HTML5');
        $view->headTitle()->setSeparator(' :: ')
                          ->setAutoEscape(false)
                          ->append('sohi');
        $view->headMeta()->appendHttpEquiv(
            'Content-Type',
            'text/html; charset=UTF-8'
        );

        $view->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js', 'text/javascript');

        $this->view = $view;

        //
        $url     = $view->plugin('url');
        $url->setRouter($router);

//        echo "<pre>" . '"$app->events()" ';
//         print_r(get_class($app->events()));
////         print_r($view);
//        echo "</pre>";
//
//        echo "<pre>" . '"$$view" ';
//         print_r(get_class($view));
//         print_r($view);
//        echo "</pre>";


//        if ($config->disqus) {
//            // Ensure disqus plugin is configured
//            $disqus = $view->plugin('disqus', $config->disqus->toArray());
//        }

//        $persistent = $view->placeholder('layout');
//        foreach ($config->view as $var => $value) {
//            if ($value instanceof Config) {
//                $value = new Config($value->toArray(), true);
//            }
//            $persistent->{$var} = $value;
//        }
    }



    protected function getViewListener($view, $config)
    {
        if ($this->viewListener instanceof View\Listener) {
            return $this->viewListener;
        }

        $viewListener       = new View\Listener($view, $config);
        $viewListener->setDisplayExceptionsFlag($config->display_exceptions);

        $this->viewListener = $viewListener;
        return $viewListener;
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

    public function getConfig($env = null)
    {
        $config = include __DIR__ . '/configs/module.config.php';
        if (null === $env) {
            return $config;
        }

        if (!isset($config[$env])) {
            throw new InvalidArgumentException(sprintf(
                'Unrecognized environment "%s" provided to %s',
                $env,
                __METHOD__
            ));
        }

        return $config[$env];
    }
}
