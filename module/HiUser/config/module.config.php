<?php
return array(
//    'hiuser' => array(
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
////            'alias' => array(
////                'skeleton' => 'HiTraining\Controller\SkeletonController',
////            ),
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'hiuser' => __DIR__ . '/../view',
                    ),
                ),
            ),


            /**
             * Controllers
             */

            'HiUser\Controller\HiUserController' => array(
                'parameters' => array(
//                    'checkup'  => 'HiTraining\Model\Checkup',
//                    'profile'              => 'HiTraining\Model\CheckupProfile',
//                    'checkupToProfile'     => 'HiTraining\Model\CheckupToProfile',
//                    'view'     => 'Zend\View\Renderer\PhpRenderer',
                ),
            ),
            'HiUser\Controller\LogController' => array(
                'parameters' => array(
//                    'checkup'  => 'HiTraining\Model\Checkup',
//                	'profile'              => 'HiTraining\Model\CheckupProfile',
//                    'checkupToProfile'     => 'HiTraining\Model\CheckupToProfile',
                    'view'     => 'Zend\View\Renderer\PhpRenderer',
                ),
            ),

            'HiUser\Controller\AccountController' => array(
                'parameters' => array(
//                    'profile'              => 'HiTraining\Model\CheckupProfile',
//                    'checkupToProfile'     => 'HiTraining\Model\CheckupToProfile',
//                    'checkup'              => 'HiTraining\Model\Checkup',
                    'view'                 => 'Zend\View\Renderer\PhpRenderer',
                ),
            ),

            /**
             * Models
             */

            'HiUser\Model\User' => array(
                'parameters' => array(
                    'tableName' => 'user',
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),


            /**
             * Routes
             */

            'Zend\Mvc\Router\RouteStack' => array(
                'parameters' => array(
                    'routes' => array(
                        'hi-user' => array(
                            'type' => 'Literal',
                            'priority' => 1000,
                            'options' => array(
                                'route' => '/hi-user',
                                'defaults' => array(
                                    'controller' => 'HiUser\Controller\HiUserController',
                                    'action'     => 'index',
                                ),
                            ),
                            'may_terminate' => true,
                            'child_routes' => array(
                                'login' => array(
                                    'type' => 'Literal',
                                    'options' => array(
                                        'route' => '/login',
                                        'defaults' => array(
                                            'controller' => 'HiUser\Controller\LogController',
                                            'action'     => 'in',
                                        ),
                                    ),
                                ),
                                'logout' => array(
                                    'type' => 'Literal',
                                    'options' => array(
                                        'route' => '/logout',
                                        'defaults' => array(
                                            'controller' => 'HiUser\Controller\LogController',
                                            'action'     => 'out',
                                        ),
                                    ),
                                ),
//                                'checkup-profile' => array(
//                                    'type' => 'Literal',
//                                    'options' => array(
//                                        'route' => '/checkup-profile',
//                                        'defaults' => array(
//                                            'controller' => 'HiTraining\Controller\CheckupProfileController',
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
//                                                    'controller' => 'HiTraining\Controller\CheckupProfileController',
//                                                    'action'     => 'list',
//                                                ),
//                                            ),
//                                        ),
//                                        'add' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/add',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\CheckupProfileController',
//                                                    'action'     => 'add',
//                                                ),
//                                            ),
//                                        ),
//                                        'edit' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/edit',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\CheckupProfileController',
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
//                                                    'controller' => 'HiTraining\Controller\CheckupProfileController',
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
//                                'workout' => array(
//                                    'type' => 'Literal',
//                                    'options' => array(
//                                        'route' => '/workout',
//                                        'defaults' => array(
//                                            'controller' => 'HiTraining\Controller\WorkoutController',
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
//                                                    'controller' => 'HiTraining\Controller\WorkoutController',
//                                                    'action'     => 'stats',
//                                                ),
//                                            ),
////                                            'may_terminate' => true,
////                                            'child_routes'  => array(
////                                                'wildcard' => array(
////                                                    'type'    => 'wildcard',
////                                                ),
////                                            ),
//                                        ),
//                                        'list' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/list',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\WorkoutController',
//                                                    'action'     => 'list',
//                                                ),
//                                            ),
//                                        ),
//                                        'add' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/add',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\WorkoutController',
//                                                    'action'     => 'add',
//                                                ),
//                                            ),
//                                        ),
//                                        'edit' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/edit',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\WorkoutController',
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
//                                                    'controller' => 'HiTraining\Controller\WorkoutController',
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
//                                'workout-exercise' => array(
//                                    'type' => 'Literal',
//                                    'options' => array(
//                                        'route' => '/workout-exercise',
//                                        'defaults' => array(
//                                            'controller' => 'HiTraining\Controller\WorkoutExerciseController',
//                                            'action'     => 'index',
//                                        ),
//                                    ),
//                                    'may_terminate' => true,
//                                    'child_routes' => array(
//
//                                        'list' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/list',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\WorkoutExerciseController',
//                                                    'action'     => 'list',
//                                                ),
//                                            ),
//                                            'may_terminate' => true,
//                                            'child_routes'  => array(
//                                                'wildcard' => array(
//                                                    'type'    => 'wildcard',
//                                                ),
//                                            ),
//                                        ),
//                                        'add' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/add',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\WorkoutExerciseController',
//                                                    'action'     => 'add',
//                                                ),
//                                            ),
//                                            'may_terminate' => true,
//                                            'child_routes'  => array(
//                                                'wildcard' => array(
//                                                    'type'    => 'wildcard',
//                                                ),
//                                            ),
//                                        ),
//                                        'edit' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/edit',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\WorkoutExerciseController',
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
//                                                    'controller' => 'HiTraining\Controller\WorkoutExerciseController',
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
//                                'exercise-type' => array(
//                                    'type' => 'Literal',
//                                    'options' => array(
//                                        'route' => '/exercise-type',
//                                        'defaults' => array(
//                                            'controller' => 'HiTraining\Controller\ExerciseTypeController',
//                                            'action'     => 'index',
//                                        ),
//                                    ),
//                                    'may_terminate' => true,
//                                    'child_routes' => array(
//                                        'tree' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/tree',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\ExerciseTypeController',
//                                                    'action'     => 'tree',
//                                                ),
//                                            ),
//                                            'may_terminate' => true,
//                                            'child_routes'  => array(
//                                                'wildcard' => array(
//                                                    'type'    => 'wildcard',
//                                                ),
//                                            ),
//                                        ),
//                                        'ajax' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/ajax',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\ExerciseTypeController',
//                                                    'action'     => 'ajax',
//                                                ),
//                                            ),
//                                            'may_terminate' => true,
//                                            'child_routes'  => array(
//                                                'wildcard' => array(
//                                                    'type'    => 'wildcard',
//                                                ),
//                                            ),
//                                        ),
//                                        'stats' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/stats',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\ExerciseTypeController',
//                                                    'action'     => 'stats',
//                                                ),
//                                            ),
//                                        ),
//                                        'rip' => array(
//                                            'type' => 'Literal',
//                                            'options' => array(
//                                                'route' => '/rip',
//                                                'defaults' => array(
//                                                    'controller' => 'HiTraining\Controller\ExerciseTypeController',
//                                                    'action'     => 'rip',
//                                                ),
//                                            ),
//                                        ),
//                                    ),
//                                ),
////                                'authenticate' => array(
////                                    'type' => 'Literal',
////                                    'options' => array(
////                                        'route' => '/authenticate',
////                                        'defaults' => array(
////                                            'controller' => 'zfcuser',
////                                            'action'     => 'authenticate',
////                                        ),
////                                    ),
////                                ),
////                                'logout' => array(
////                                    'type' => 'Literal',
////                                    'options' => array(
////                                        'route' => '/logout',
////                                        'defaults' => array(
////                                            'controller' => 'zfcuser',
////                                            'action'     => 'logout',
////                                        ),
////                                    ),
////                                ),
////                                'register' => array(
////                                    'type' => 'Literal',
////                                    'options' => array(
////                                        'route' => '/register',
////                                        'defaults' => array(
////                                            'controller' => 'zfcuser',
////                                            'action'     => 'register',
////                                        ),
////                                    ),
////                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
