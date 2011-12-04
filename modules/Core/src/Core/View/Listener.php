<?php

namespace Core\View;

use ArrayAccess,
    Zend\Di\Locator,
    Zend\EventManager\EventCollection,
    Zend\EventManager\ListenerAggregate,
    Zend\EventManager\StaticEventCollection,
    Zend\Http\Response,
    Zend\Mvc\Application,
    Zend\Mvc\MvcEvent,
    Zend\View\Renderer;

class Listener implements ListenerAggregate
{
    protected $config;
    protected $listeners = array();
    protected $staticListeners = array();
    protected $view;
    protected $displayExceptions = false;

    public function __construct(Renderer $renderer, $config)
    {
//        echo '__construct';
        $this->view   = $renderer;
        $this->config = $config;
    }

    public function setDisplayExceptionsFlag($flag)
    {
        $this->displayExceptions = (bool) $flag;
        return $this;
    }

    public function displayExceptions()
    {
        return $this->displayExceptions;
    }

    public function attach(EventCollection $events)
    {
//        echo 'attach';
//        echo get_class($events);
        $this->listeners[] = $events->attach('dispatch', array($this, 'renderLayout'), -1000);
//        $this->listeners[] = $events->attach('dispatch', array($this, 'render404'), -80);
        $this->listeners[] = $events->attach('dispatch.error', array($this, 'renderError'));

//        $this->listeners[] = $events->attach('dispatch', array($this, 'render404'), -80);
//
    }

    public function detach(EventCollection $events)
    {
//        echo 'detach';
        foreach ($this->listeners as $key => $listener) {
            $events->detach($listener);
            unset($this->listeners[$key]);
            unset($listener);
        }
    }

    public function registerStaticListeners(StaticEventCollection $events, $locator)
    {
//        echo 'registerStaticListeners';
//        $ident   = 'Core\Controller\PageController';
//        $handler = $events->attach($ident, 'dispatch', array($this, 'renderPageController'), -50);
//        $this->staticListeners[] = array($ident, $handler);

        $ident   = 'Zend\Mvc\Controller\ActionController';
        $handler = $events->attach($ident, 'dispatch', array($this, 'renderView'), -50);
        $this->staticListeners[] = array($ident, $handler);
    }

    public function detachStaticListeners(StaticEventCollection $events)
    {
//        echo 'detachStaticListeners';
        foreach ($this->staticListeners as $i => $info) {
            list($id, $handler) = $info;
            $events->detach($id, $handler);
            unset($this->staticListeners[$i]);
        }
    }

//    public function renderPageController(MvcEvent $e)
//    {
//        $page = $e->getResult();
//        if ($page instanceof Response) {
//            return;
//        }
//
//        $response = $e->getResponse();
//        if ($response->isNotFound()) {
//            return;
//        }
//
//        $routeMatch = $e->getRouteMatch();
//
//        if (!$routeMatch) {
//            $page = '404';
//        } else {
//            $page = $routeMatch->getParam('action', '404');
//        }
//
//        if ($page == '404') {
//            $response->setStatusCode(404);
//        }
//
//        $script     = 'pages/' . $page . '.phtml';
//
//        // Action content
//        $content    = $this->view->render($script);
//        $e->setResult($content);
//
//        return $this->renderLayout($e);
//    }

    public function renderView(MvcEvent $e)
    {
//        echo 'renderView';
        $response = $e->getResponse();
        if (!$response->isSuccess()) {
            return;
        }

        $routeMatch = $e->getRouteMatch();
        $controller = $routeMatch->getParam('controller', 'index');
        $action     = $routeMatch->getParam('action', 'index');
//        echo $controller;
//        echo $action;
        $script     = $controller . '/' . $action . '.phtml';

        $vars       = $e->getResult();
        if (is_scalar($vars)) {
            $vars = array('content' => $vars);
        } elseif (is_object($vars) && !$vars instanceof ArrayAccess) {
            $vars = (array) $vars;
        }

        $content    = $this->view->render($script, $vars);

        $e->setResult($content);
        return $content;
    }

    public function renderLayout(MvcEvent $e)
    {
        $response = $e->getResponse();
        if (!$response) {
            $response = new Response();
            $e->setResponse($response);
        }
        if ($response->isRedirect()) {
            return $response;
        }

        $footer   = $e->getParam('footer', false);
        $vars     = array('footer' => $footer);

        if (false !== ($contentParam = $e->getParam('content', false))) {
            $vars['content'] = $contentParam;
        } else {
            $vars['content'] = $e->getResult();
        }

        $layoutScript = $this->getLayout($e);
        $layout       = $this->view->render($layoutScript, $vars);
        $response->setContent($layout);
        return $response;
    }

    protected function getLayout($e)
    {
        $layout  = $this->config->view->layout;
        return $layout;
    }

//    public function render404(MvcEvent $e)
//    {
//        $vars = $e->getResult();
//        if ($vars instanceof Response) {
//            return;
//        }
//
//        $response = $e->getResponse();
//        if ($response->getStatusCode() != 404) {
//            // Only handle 404's
//            return;
//        }
//
//        $vars = array('message' => 'Page not found.');
//
//        $content = $this->view->render('pages/404.phtml', $vars);
//
//        $e->setResult($content);
//
//        return $this->renderLayout($e);
//    }

    public function renderError(MvcEvent $e)
    {
        $error    = $e->getError();
        $app      = $e->getTarget();
        $response = $e->getResponse();
        if (!$response) {
            $response = new Response();
            $e->setResponse($response);
        }

        switch ($error) {
            case Application::ERROR_CONTROLLER_NOT_FOUND:
            case Application::ERROR_CONTROLLER_INVALID:
                $vars = array(
                    'message' => 'Page not found.ERROR_CONTROLLER_NOT_FOUND.ERROR_CONTROLLER_INVALID',
                );
                $response->setStatusCode(404);
                break;

            case Application::ERROR_EXCEPTION:
            default:
                $exception = $e->getParam('exception');
                $vars = array(
                    'message'            => 'An error occurred during execution; please try again later.',
                    'exception'          => $e->getParam('exception'),
                    'display_exceptions' => $this->displayExceptions(),
                );
                $response->setStatusCode(500);
                break;
        }

        $content = $this->view->render('error/dispatch-error.phtml', $vars);

        $e->setResult($content);

        return $this->renderLayout($e);
    }


}
