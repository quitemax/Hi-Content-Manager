<?php
return array(
//    'zfcuser' => array(
//        'user_model_class'          => 'ZfcUser\Model\User',
//        'usermeta_model_class'      => 'ZfcUser\Model\UserMeta',
//        'enable_registration'       => true,
//        'enable_username'           => false,
//        'enable_display_name'       => false,
//        'require_activation'        => false,
//        'login_after_registration'  => true,
//        'registration_form_captcha' => true,
//        'password_hash_algorithm'   => 'blowfish', // blowfish, sha512, sha256
//        'blowfish_cost'             => 10,         // integer between 4 and 31
//        'sha256_rounds'             => 5000,       // integer between 1000 and 999,999,999
//        'sha512_rounds'             => 5000,       // integer between 1000 and 999,999,999
//    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'skeleton' => 'HiTraining\Controller\SkeletonController',
            ),
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'hitraining' => __DIR__ . '/../view',
                    ),
                ),
            ),

//            // View for the layout
//            'Zend\Mvc\View\DefaultRenderingStrategy' => array(
//                'parameters' => array(
//                    'layoutTemplate' => 'layout',
//                ),
//            ),

            /**
             * Routes
             */

            'Zend\Mvc\Router\RouteStack' => array(
                'parameters' => array(
                    'routes' => array(
                        'hi-training' => array(
                            'type' => 'Literal',
                            'priority' => 1000,
                            'options' => array(
                                'route' => '/hi-training',
                                'defaults' => array(
                                    'controller' => 'skeleton',
                                    'action'     => 'index',
                                ),
                            ),
                            'may_terminate' => true,
//                            'child_routes' => array(
//                                'login' => array(
//                                    'type' => 'Literal',
//                                    'options' => array(
//                                        'route' => '/login',
//                                        'defaults' => array(
//                                            'controller' => 'zfcuser',
//                                            'action'     => 'login',
//                                        ),
//                                    ),
//                                ),
//                                'authenticate' => array(
//                                    'type' => 'Literal',
//                                    'options' => array(
//                                        'route' => '/authenticate',
//                                        'defaults' => array(
//                                            'controller' => 'zfcuser',
//                                            'action'     => 'authenticate',
//                                        ),
//                                    ),
//                                ),
//                                'logout' => array(
//                                    'type' => 'Literal',
//                                    'options' => array(
//                                        'route' => '/logout',
//                                        'defaults' => array(
//                                            'controller' => 'zfcuser',
//                                            'action'     => 'logout',
//                                        ),
//                                    ),
//                                ),
//                                'register' => array(
//                                    'type' => 'Literal',
//                                    'options' => array(
//                                        'route' => '/register',
//                                        'defaults' => array(
//                                            'controller' => 'zfcuser',
//                                            'action'     => 'register',
//                                        ),
//                                    ),
//                                ),
//                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
