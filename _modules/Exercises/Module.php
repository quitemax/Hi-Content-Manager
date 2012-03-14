<?php

namespace Exercises;

use Zend\Module\Manager,
    Zend\EventManager\StaticEventManager,
    Zend\Module\Consumer\AutoloaderProvider;

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
        return include __DIR__ . '/configs/module.config.php';
    }

//    public function initializeView($e)
//    {
////        echo "<pre>" . '"$e.exer" ';
////        print_r($e);
////        echo "</pre>";
//        $app          = $e->getParam('application');
//        //$e->getParam('modules');
//        $locator      = $app->getLocator();
//        $config       = $e->getParam('config');
//        $view         = $this->getView($app);
////        $viewListener = $this->getViewListener($view, $config);
////        $app->events()->attachAggregate($viewListener);
////        $events       = StaticEventManager::getInstance();
////        $viewListener->registerStaticListeners($events, $locator);
//    }

//    protected function getViewListener($view, $config)
//    {
//        if ($this->viewListener instanceof View\Listener) {
//            return $this->viewListener;
//        }
//
//        $viewListener       = new View\Listener($view, $config->layout);
//        $viewListener->setDisplayExceptionsFlag($config->display_exceptions);
//
//        $this->viewListener = $viewListener;
//        return $viewListener;
//    }

//    protected function getView($app)
//    {
//        if ($this->view) {
//            return $this->view;
//        }
//
//        $di     = $app->getLocator();
//        $view   = $di->get('view');
//        $url    = $view->plugin('url');
//        $url->setRouter($app->getRouter());
//
//        $view->plugin('headTitle')->setSeparator(' - ')
//                                  ->setAutoEscape(false)
//                                  ->append('Exercises Application');
//        $this->view = $view;
//        return $view;
//    }
}
