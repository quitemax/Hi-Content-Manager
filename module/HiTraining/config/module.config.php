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
                    'checkup'  => 'HiTraining\Model\Checkup',
                	'profile'              => 'HiTraining\Model\CheckupProfile',
                    'checkupToProfile'     => 'HiTraining\Model\CheckupToProfile',
                    'view'     => 'Zend\View\Renderer\PhpRenderer',
                ),
            ),

            'HiTraining\Controller\CheckupProfileController' => array(
                'parameters' => array(
                    'profile'              => 'HiTraining\Model\CheckupProfile',
                    'checkupToProfile'     => 'HiTraining\Model\CheckupToProfile',
                    'checkup'              => 'HiTraining\Model\Checkup',
                    'view'                 => 'Zend\View\Renderer\PhpRenderer',
                ),
            ),

            'HiTraining\Controller\WorkoutController' => array(
                'parameters' => array(
                    'workout'                 => 'HiTraining\Model\Workout',
                    'view'                 => 'Zend\View\Renderer\PhpRenderer',
                ),
            ),


            'HiTraining\Controller\ExerciseTypeController' => array(
                'parameters' => array(
                    'type'                 => 'HiTraining\Model\ExerciseType',
                    'view'                 => 'Zend\View\Renderer\PhpRenderer',
                ),
            ),

            'HiTraining\Model\Checkup' => array(
                'parameters' => array(
                    'tableName' => 'checkup',
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),

            'HiTraining\Model\CheckupProfile' => array(
                'parameters' => array(
                    'tableName' => 'checkup_profile',
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),

            'HiTraining\Model\CheckupToProfile' => array(
                'parameters' => array(
                    'tableName' => 'checkup_to_profile',
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),

            'HiTraining\Model\Workout' => array(
                'parameters' => array(
                    'tableName' => 'workout',
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),

            'HiTraining\Model\ExerciseType' => array(
                'parameters' => array(
                    'tableName' => 'exercise_type',
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),

//            'HiTraining\Model\Checkup\ResultSet' => array(
//                'parameters' => array(
//                    'rowObjectPrototype' => 'HiTraining\Model\Checkup\Row',
//                )
//            ),

//            'HiTraining\Model\Checkup\Row' => array(
//                'parameters' => array(
//                    'tableGateway' => 'HiTraining\Model\Checkup',
//                    'primaryKey'   => 'checkup_id',
//                )
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
                                    'may_terminate' => true,
                                    'child_routes' => array(
                                        'stats' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/stats',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\CheckupController',
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
                                                    'controller' => 'HiTraining\Controller\CheckupController',
                                                    'action'     => 'list',
                                                ),
                                            ),
                                        ),
                                        'add' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/add',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\CheckupController',
                                                    'action'     => 'add',
                                                ),
                                            ),
                                        ),
                                        'edit' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/edit',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\CheckupController',
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
                                                    'controller' => 'HiTraining\Controller\CheckupController',
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
                                            'controller' => 'HiTraining\Controller\CheckupProfileController',
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
                                                    'controller' => 'HiTraining\Controller\CheckupProfileController',
                                                    'action'     => 'list',
                                                ),
                                            ),
                                        ),
                                        'add' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/add',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\CheckupProfileController',
                                                    'action'     => 'add',
                                                ),
                                            ),
                                        ),
                                        'edit' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/edit',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\CheckupProfileController',
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
                                                    'controller' => 'HiTraining\Controller\CheckupProfileController',
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
                                'workout' => array(
                                    'type' => 'Literal',
                                    'options' => array(
                                        'route' => '/workout',
                                        'defaults' => array(
                                            'controller' => 'HiTraining\Controller\WorkoutController',
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
                                                    'controller' => 'HiTraining\Controller\WorkoutController',
                                                    'action'     => 'stats',
                                                ),
                                            ),
//                                            'may_terminate' => true,
//                                            'child_routes'  => array(
//                                                'wildcard' => array(
//                                                    'type'    => 'wildcard',
//                                                ),
//                                            ),
                                        ),
                                        'list' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/list',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\WorkoutController',
                                                    'action'     => 'list',
                                                ),
                                            ),
                                        ),
                                        'add' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/add',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\WorkoutController',
                                                    'action'     => 'add',
                                                ),
                                            ),
                                        ),
                                        'edit' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/edit',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\WorkoutController',
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
                                                    'controller' => 'HiTraining\Controller\WorkoutController',
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
                                'exercise-type' => array(
                                    'type' => 'Literal',
                                    'options' => array(
                                        'route' => '/exercise-type',
                                        'defaults' => array(
                                            'controller' => 'HiTraining\Controller\ExerciseTypeController',
                                            'action'     => 'index',
                                        ),
                                    ),
                                    'may_terminate' => true,
                                    'child_routes' => array(
                                        'tree' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/tree',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\ExerciseTypeController',
                                                    'action'     => 'tree',
                                                ),
                                            ),
                                            'may_terminate' => true,
                                            'child_routes'  => array(
                                                'wildcard' => array(
                                                    'type'    => 'wildcard',
                                                ),
                                            ),
                                        ),
                                        'stats' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/stats',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\ExerciseTypeController',
                                                    'action'     => 'stats',
                                                ),
                                            ),
                                        ),
                                        'rip' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/rip',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\ExerciseTypeController',
                                                    'action'     => 'rip',
                                                ),
                                            ),
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
