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
//            'alias' => array(
//                'skeleton' => 'HiTraining\Controller\SkeletonController',
//            ),
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'hitraining' => __DIR__ . '/../view',
                    ),
                ),
            ),
//            'Zend\View\Resolver\TemplateMapResolver' => array(
//                'parameters' => array(
//                    'map'  => array(
//                        'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
//                    ),
//                ),
//            ),

//            // View for the layout
//            'Zend\Mvc\View\DefaultRenderingStrategy' => array(
//                'parameters' => array(
//                    'layoutTemplate' => 'layout',
//                ),
//            ),

            'HiTraining\Controller\CheckupController' => array(
                'parameters' => array(
                    'checkup' => 'HiTraining\Model\DbTable\Checkup',
                ),
            ),

            'HiTraining\Model\DbTable\Checkup' => array(
                'parameters' => array(
                    'tableName' => 'checkup',
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),

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
                                    'controller' => 'HiTraining\Controller\HiTrainingController',
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
                                            'controller' => 'HiTraining\Controller\CheckupController',
                                            'action'     => 'index',
                                        ),
                                    ),
                                ),
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
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
