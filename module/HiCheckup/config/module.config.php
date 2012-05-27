<?php
return array(
    'router' => array(
        'routes' => array(
            'hi-checkup' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/hi-checkup',
                    'defaults' => array(
                        'controller' => 'HiCheckup\Controller\HiCheckupController',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'checkup' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/checkup',
                            'defaults' => array(
                                'controller' => 'HiCheckup\Controller\CheckupController',
                                'action'     => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'stats' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/stats',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupController',
                                        'action'     => 'stats',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                            'list' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/list',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupController',
                                        'action'     => 'list',
                                    ),
                                ),
                            ),
                            'add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupController',
                                        'action'     => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/edit',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupController',
                                        'action'     => 'edit',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/delete',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupController',
                                        'action'     => 'delete',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'checkup-profile' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/checkup-profile',
                            'defaults' => array(
                                'controller' => 'HiCheckup\Controller\CheckupProfileController',
                                'action'     => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'list' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/list',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupProfileController',
                                        'action'     => 'list',
                                    ),
                                ),
                            ),
                            'add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupProfileController',
                                        'action'     => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/edit',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupProfileController',
                                        'action'     => 'edit',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/delete',
                                    'defaults' => array(
                                        'controller' => 'HiCheckup\Controller\CheckupProfileController',
                                        'action'     => 'delete',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes'  => array(
                                    'wildcard' => array(
                                        'type'    => 'wildcard',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
//            'home' => array(
//                'type' => 'Zend\Mvc\Router\Http\Literal',
//                'options' => array(
//                    'route'    => '/',
//                    'defaults' => array(
//                        'controller' => 'index',
//                        'action'     => 'index',
//                    ),
//                ),
//            ),
        ),
    ),
//    'controller' => array(
//        'classes' => array(
//            'index' => 'Application\Controller\IndexController'
//        ),
//    ),
    'view_manager' => array(
//        'display_not_found_reason' => true,
//        'display_exceptions'       => true,
//        'doctype'                  => 'HTML5',
//        'not_found_template'       => 'error/404',
//        'exception_template'       => 'error/index',
//        'template_map' => array(
//            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
//            'index/index'   => __DIR__ . '/../view/index/index.phtml',
//            'error/404'     => __DIR__ . '/../view/error/404.phtml',
//            'error/index'   => __DIR__ . '/../view/error/index.phtml',
//        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),


//    'hi-checkup' => array(
//        'ver'          => '0.0.1.0',
///**
// * @todo ver @ 0.0.2.0
// * -> 1. weekly, daily, monthly, yearly stats counting
// * -> 2. how far back do we count stats
// * -> 3. add event listeners to stats chart points to forward to checkup edit/stats url?
// */
////        'user_model_class'          => 'ZfcUser\Model\User',
////        'usermeta_model_class'      => 'ZfcUser\Model\UserMeta',
////        'enable_registration'       => true,
////        'enable_username'           => false,
////        'enable_display_name'       => false,
////        'require_activation'        => false,
////        'login_after_registration'  => true,
////        'registration_form_captcha' => true,
////        'password_hash_algorithm'   => 'blowfish', // blowfish, sha512, sha256
////        'blowfish_cost'             => 10,         // integer between 4 and 31
////        'sha256_rounds'             => 5000,       // integer between 1000 and 999,999,999
////        'sha512_rounds'             => 5000,       // integer between 1000 and 999,999,999
//    ),
//    'di' => array(
//        'instance' => array(
//
//            /**
//             *
//             */
//            'Zend\View\Resolver\TemplatePathStack' => array(
//                'parameters' => array(
//                    'paths'  => array(
//                        'hicheckup' => __DIR__ . '/../view',
//                    ),
//                ),
//            ),
//
//
//            /**
//             * Controllers
//             */
//            'HiCheckup\Controller\HiCheckupController' => array(
//                'parameters' => array(
//
//                ),
//            ),
//            'HiCheckup\Controller\CheckupController' => array(
//                'parameters' => array(
//                    'checkup'              => 'HiCheckup\Model\Checkup',
//                    'profile'              => 'HiCheckup\Model\CheckupProfile',
//                    'checkupToProfile'     => 'HiCheckup\Model\CheckupToProfile',
//                    'view'                 => 'Zend\View\Renderer\PhpRenderer',
//                ),
//            ),
//
//            'HiCheckup\Controller\CheckupProfileController' => array(
//                'parameters' => array(
//                    'profile'              => 'HiCheckup\Model\CheckupProfile',
//                    'checkupToProfile'     => 'HiCheckup\Model\CheckupToProfile',
//                    'checkup'              => 'HiCheckup\Model\Checkup',
//                    'view'                 => 'Zend\View\Renderer\PhpRenderer',
//                ),
//            ),
//
//            /**
//             * Models
//             */
//
//            'HiCheckup\Model\Checkup' => array(
//                'parameters' => array(
//                    'tableName' => 'checkup',
//                    'adapter' => 'Zend\Db\Adapter\Adapter',
//                )
//            ),
//
//            'HiCheckup\Model\CheckupProfile' => array(
//                'parameters' => array(
//                    'tableName' => 'checkup_profile',
//                    'adapter' => 'Zend\Db\Adapter\Adapter',
//                )
//            ),
//
//            'HiCheckup\Model\CheckupToProfile' => array(
//                'parameters' => array(
//                    'tableName' => 'checkup_to_profile',
//                    'adapter' => 'Zend\Db\Adapter\Adapter',
//                )
//            ),
//
//
//            /**
//             * Routes
//             */
//
//            'Zend\Mvc\Router\RouteStackInterface' => array(
//                'parameters' => array(
//                    'routes' => array(
//                        'hi-checkup' => array(
//                            'type' => 'Literal',
//                            'priority' => 1000,
//                            'options' => array(
//                                'route' => '/hi-checkup',
//                                'defaults' => array(
//                                    'controller' => 'HiCheckup\Controller\HiCheckupController',
//                                    'action'     => 'index',
//                                ),
//                            ),
//                            'may_terminate' => true,
//                            'child_routes' => array(
//                                'checkup' => array(
//                                    'type' => 'Literal',
//                                    'options' => array(
//                                        'route' => '/checkup',
//                                        'defaults' => array(
//                                            'controller' => 'HiCheckup\Controller\CheckupController',
//                                            'action'     => 'index',
//                                        ),
//                                    ),
//                                    'may_terminate' => true,
//                                    'child_routes' => array(
//                                        'stats' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/stats',
//                                                'defaults' => array(
//                                                    'controller' => 'HiCheckup\Controller\CheckupController',
//                                                    'action'     => 'stats',
//                                                ),
//                                            ),
//                                            'may_terminate' => true,
//                                            'child_routes'  => array(
//                                                'wildcard' => array(
//                                                    'type'    => 'wildcard',
//                                                ),
//                                            ),
//                                        ),
//                                        'list' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/list',
//                                                'defaults' => array(
//                                                    'controller' => 'HiCheckup\Controller\CheckupController',
//                                                    'action'     => 'list',
//                                                ),
//                                            ),
//                                        ),
//                                        'add' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/add',
//                                                'defaults' => array(
//                                                    'controller' => 'HiCheckup\Controller\CheckupController',
//                                                    'action'     => 'add',
//                                                ),
//                                            ),
//                                        ),
//                                        'edit' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/edit',
//                                                'defaults' => array(
//                                                    'controller' => 'HiCheckup\Controller\CheckupController',
//                                                    'action'     => 'edit',
//                                                ),
//                                            ),
//                                            'may_terminate' => true,
//                                            'child_routes'  => array(
//                                                'wildcard' => array(
//                                                    'type'    => 'wildcard',
//                                                ),
//                                            ),
//                                        ),
//                                        'delete' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/delete',
//                                                'defaults' => array(
//                                                    'controller' => 'HiCheckup\Controller\CheckupController',
//                                                    'action'     => 'delete',
//                                                ),
//                                            ),
//                                            'may_terminate' => true,
//                                            'child_routes'  => array(
//                                                'wildcard' => array(
//                                                    'type'    => 'wildcard',
//                                                ),
//                                            ),
//                                        ),
//                                    ),
//                                ),
//                                'checkup-profile' => array(
//                                    'type' => 'Literal',
//                                    'options' => array(
//                                        'route' => '/checkup-profile',
//                                        'defaults' => array(
//                                            'controller' => 'HiCheckup\Controller\CheckupProfileController',
//                                            'action'     => 'index',
//                                        ),
//                                    ),
//                                    'may_terminate' => true,
//                                    'child_routes' => array(
//                                        'list' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/list',
//                                                'defaults' => array(
//                                                    'controller' => 'HiCheckup\Controller\CheckupProfileController',
//                                                    'action'     => 'list',
//                                                ),
//                                            ),
//                                        ),
//                                        'add' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/add',
//                                                'defaults' => array(
//                                                    'controller' => 'HiCheckup\Controller\CheckupProfileController',
//                                                    'action'     => 'add',
//                                                ),
//                                            ),
//                                        ),
//                                        'edit' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/edit',
//                                                'defaults' => array(
//                                                    'controller' => 'HiCheckup\Controller\CheckupProfileController',
//                                                    'action'     => 'edit',
//                                                ),
//                                            ),
//                                            'may_terminate' => true,
//                                            'child_routes'  => array(
//                                                'wildcard' => array(
//                                                    'type'    => 'wildcard',
//                                                ),
//                                            ),
//                                        ),
//                                        'delete' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/delete',
//                                                'defaults' => array(
//                                                    'controller' => 'HiCheckup\Controller\CheckupProfileController',
//                                                    'action'     => 'delete',
//                                                ),
//                                            ),
//                                            'may_terminate' => true,
//                                            'child_routes'  => array(
//                                                'wildcard' => array(
//                                                    'type'    => 'wildcard',
//                                                ),
//                                            ),
//                                        ),
//                                    ),
//                                ),
//                            ),
//                        ),
//                    ),
//                ),
//            ),
//        ),
//    ),
);
