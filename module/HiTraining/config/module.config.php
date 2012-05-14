<?php
return array(
    'hi-training' => array(
        'ver'          => '0.0.4.0',
/**
 * @todo ver @ 0.0.5.0
 * -> 0.
 * -> 1. dodac cwiczenia lafaya
 * -> 2. dokonczyc statystyki exercise-type (wzgledem formularza)
 * -> 3. nowe typy formularzy lafay
 * -> 4. dodac do exercise type row aby moc robic serialize/unserialize
 *       A RACZEJ CALE BEHAVIOUR IMAGE I IMAGEARRAY ( i to do type'a)
 * -> 5. dodac przegladanie fotek i wyglad et tree


6/7. workout stats profiles
 */
//        'user_model_class'          => 'ZfcUser\Model\User',
//        'usermeta_model_class'      => 'ZfcUser\Model\UserMeta',
//        'enable_registration'       => true,
    ),
    'di' => array(
        'instance' => array(

            /**
             *
             */
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'hitraining' => __DIR__ . '/../view',
                    ),
                ),
            ),

            /**
             * Controllers
             */
            'HiTraining\Controller\WorkoutController' => array(
                'parameters' => array(
                    'workout'              => 'HiTraining\Model\Workout',
                    'exercise'             => 'HiTraining\Model\WorkoutExercise',
                    'view'                 => 'Zend\View\Renderer\PhpRenderer',
                ),
            ),

            'HiTraining\Controller\WorkoutExerciseController' => array(
                'parameters' => array(
                    'workout'              => 'HiTraining\Model\Workout',
                    'exercise'             => 'HiTraining\Model\WorkoutExercise',
                    'type'                 => 'HiTraining\Model\ExerciseType',
                    'view'                 => 'Zend\View\Renderer\PhpRenderer',
                ),
            ),


            'HiTraining\Controller\ExerciseTypeController' => array(
                'parameters' => array(
                    'type'                 => 'HiTraining\Model\ExerciseType',
                    'exercise'             => 'HiTraining\Model\WorkoutExercise',
                    'view'                 => 'Zend\View\Renderer\PhpRenderer',
                ),
            ),

            /**
             * Models
             */
            'HiTraining\Model\Workout' => array(
                'parameters' => array(
                    'tableName' => 'workout',
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),

            'HiTraining\Model\WorkoutExercise' => array(
                'parameters' => array(
                    'tableName' => 'workout_exercise',
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),

            'HiTraining\Model\ExerciseType' => array(
                'parameters' => array(
                    'tableName' => 'exercise_type',
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),

            /**
             * Routes
             */

            'Zend\Mvc\Router\RouteStackInterface' => array(
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
                                'workout-exercise' => array(
                                    'type' => 'Literal',
                                    'options' => array(
                                        'route' => '/workout-exercise',
                                        'defaults' => array(
                                            'controller' => 'HiTraining\Controller\WorkoutExerciseController',
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
                                                    'controller' => 'HiTraining\Controller\WorkoutExerciseController',
                                                    'action'     => 'list',
                                                ),
                                            ),
                                            'may_terminate' => true,
                                            'child_routes'  => array(
                                                'wildcard' => array(
                                                    'type'    => 'wildcard',
                                                ),
                                            ),
                                        ),
                                        'add' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/add',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\WorkoutExerciseController',
                                                    'action'     => 'add',
                                                ),
                                            ),
                                            'may_terminate' => true,
                                            'child_routes'  => array(
                                                'wildcard' => array(
                                                    'type'    => 'wildcard',
                                                ),
                                            ),
                                        ),
                                        'edit' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/edit',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\WorkoutExerciseController',
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
                                                    'controller' => 'HiTraining\Controller\WorkoutExerciseController',
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
                                        'ajax-last-of-type' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/ajax-last-of-type',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\WorkoutExerciseController',
                                                    'action'     => 'ajaxLastOfType',
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
                                        'edit-tree' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/edit-tree',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\ExerciseTypeController',
                                                    'action'     => 'editTree',
                                                ),
                                            ),
                                            'may_terminate' => true,
                                            'child_routes'  => array(
                                                'wildcard' => array(
                                                    'type'    => 'wildcard',
                                                ),
                                            ),
                                        ),
                                        'ajax-form-type' => array(
                                            'type' => 'Literal',
                                            'options' => array(
                                                'route' => '/ajax-form-type',
                                                'defaults' => array(
                                                    'controller' => 'HiTraining\Controller\ExerciseTypeController',
                                                    'action'     => 'ajaxFormType',
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
                                            'may_terminate' => true,
                                            'child_routes'  => array(
                                                'wildcard' => array(
                                                    'type'    => 'wildcard',
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
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
