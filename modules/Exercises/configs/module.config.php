<?php
return array(
    'bootstrap_class' => 'Exercises\Bootstrap',
    'layout'          => 'layouts/layout.phtml',
    'di' => array(
        'instance' => array(
            'alias' => array(
                'index' => 'Exercises\Controller\IndexController',
                'error' => 'Exercises\Controller\ErrorController',
                'view'  => 'Zend\View\PhpRenderer',
            ),
            'Zend\View\PhpRenderer' => array(
                'parameters' => array(
                    'resolver' => 'Zend\View\TemplatePathStack',
                    'options'  => array(
                        'script_paths' => array(
                            'Exercises' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'routes' => array(
        'default' => array(
            'type'    => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route'    => '/exercise/[:controller[/:action]]',
                'constraints' => array(
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                ),
                'defaults' => array(
                    'controller' => 'index',
                    'action'     => 'index',
                ),
            ),
        ),
//        'home' => array(
//            'type' => 'Zend\Mvc\Router\Http\Literal',
//            'options' => array(
//                'route'    => '/exercise/',
//                'defaults' => array(
//                    'controller' => 'index',
//                    'action'     => 'index',
//                ),
//            ),
//        ),
    ),
);
