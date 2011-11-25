<?php
$config = array();
$config['production'] = array(
    'bootstrap_class' => 'Core\Bootstrap',
    'layout'          => 'layouts/layout.phtml',
    'view' => array(
        'layout' => 'layouts/layout.phtml',
    ),
    'display_exceptions' => true,
    'di' => array(
        'instance' => array(
            'alias' => array(
                'core-page'         => 'Core\Controller\PageController',
                'view'              => 'Zend\View\PhpRenderer',
                'view-resolver'     => 'Zend\View\TemplatePathStack',
            ),
            'Zend\View\PhpRenderer' => array(
                'parameters' => array(
                    'resolver' => 'Zend\View\TemplatePathStack',
                    'options'  => array(
                        'script_paths' => array(
                            'Core' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
//            'view-resolver' => array(
//                'parameters' => array(
//                    'paths' => array(
//                        'Core' => __DIR__ . '/../views',
//                    ),
//                )
//            ),
        ),
    ),
    'routes' => array(
        'default' => array(
            'type' => 'Regex',
            'options' => array(
                'regex' => '/.*',
                'defaults' => array(
                    'controller' => 'core-page',
                    'action'     => '404',
                ),
                'spec' => '404',
            ),
        ),
        'home' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'core-page',
                    'action'     => 'home',
                ),
            ),
        ),
//        'default' => array(
//            'type'    => 'Zend\Mvc\Router\Http\Segment',
//            'options' => array(
//                'route'    => '/[:controller[/:action]]',
//                'constraints' => array(
//                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                ),
//                'defaults' => array(
//                    'controller' => 'index',
//                    'action'     => 'index',
//                ),
//            ),
//        ),
//        'home' => array(
//            'type' => 'Zend\Mvc\Router\Http\Literal',
//            'options' => array(
//                'route'    => '/',
//                'defaults' => array(
//                    'controller' => 'index',
//                    'action'     => 'index',
//                ),
//            ),
//        ),
    ),
);

$config['staging']     = $config['production'];

$config['testing']     = $config['production'];
$config['testing']['display_exceptions']    = true;

$config['development'] = $config['production'];
//$config['development']['disqus']['key']         = "phlyboyphly";
//$config['development']['disqus']['development'] = 1;
$config['development']['display_exceptions']    = true;
return $config;
