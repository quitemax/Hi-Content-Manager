<?php
return array(
	'display_exceptions' => true,
    'di' => array(
        'instance' => array(
            'alias' => array(
                'exercises-index'             => 'Exercises\Controller\IndexController',
                'exercises-error'             => 'Exercises\Controller\ErrorController',
                'exercises-checkup'           => 'Exercises\Controller\CheckupController',
                'exercises-workout'           => 'Exercises\Controller\WorkoutController',
                'exercises-workout-exercise'  => 'Exercises\Controller\WorkoutExerciseController',
                'view'                        => 'Zend\View\PhpRenderer',
                'view-resolver'               => 'Zend\View\TemplatePathStack',
            ),
            'view' => array(
                'parameters' => array(
                    'resolver' => 'view-resolver',
                    'options'  => array(
                        'script_paths' => array(
                            'Exercises' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
            'view-resolver' => array(
                'parameters' => array(
                    'paths' => array(
                        'Exercises' => __DIR__ . '/../views',
                    ),
                )
            ),
            'Exercises\Controller\CheckupController' => array(
                'parameters' => array(
                    'checkup' => 'Exercises\Model\DbTable\Checkup',
                ),
            ),
            'Exercises\Controller\WorkoutController' => array(
                'parameters' => array(
                    'workout' => 'Exercises\Model\DbTable\Workout',
                    'view' => 'view',
                ),
            ),
            'Exercises\Controller\WorkoutExerciseController' => array(
                'parameters' => array(
                    'workout'  => 'Exercises\Model\DbTable\Workout',
                    'exercise' => 'Exercises\Model\DbTable\WorkoutExercise',
                    'type'     => 'Exercises\Model\DbTable\WorkoutExerciseType',
                ),
            ),
            'Exercises\Model\DbTable\Checkup' => array(
                'parameters' => array(
                	'config' => 'Zend\Db\Adapter\Mysqli',
                )
            ),
            'Exercises\Model\DbTable\Workout' => array(
                'parameters' => array(
                    'config'       => 'Zend\Db\Adapter\Mysqli',


                )
            ),
            'Exercises\Model\DbTable\WorkoutExercise' => array(
                'parameters' => array(
                    'config' => 'Zend\Db\Adapter\Mysqli',
                )
            ),
            'Exercises\Model\DbTable\WorkoutExerciseType' => array(
                'parameters' => array(
                    'config' => 'Zend\Db\Adapter\Mysqli',
                    'dependentTables' => array(
                        'Exercises\Model\DbTable\WorkoutExercise',
                    ),
                )
            ),
        ),
    ),
    'routes' => array(
        'exercises-default' => array(
            'type' => 'Regex',
            'options' => array(
                'regex' => '/exercises/.*',
                'defaults' => array(
                    'controller' => 'exercises-error',
                    'action'     => 'error',
                ),
                'spec' => '404',
            ),
        ),
        'exercises-home' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises',
                'defaults' => array(
                    'controller' => 'exercises-index',
                    'action'     => 'index',
                ),
            ),
        ),
        'exercises-checkup-home' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/checkup',
                'defaults' => array(
                    'controller' => 'exercises-checkup',
                    'action'     => 'index',
                ),
            ),
        ),
        'exercises-checkup-add' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/checkup/add',
                'defaults' => array(
                    'controller' => 'exercises-checkup',
                    'action'     => 'add',
                ),
            ),
        ),
        'exercises-checkup-edit' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/checkup/edit',
                'defaults' => array(
                    'controller' => 'exercises-checkup',
                    'action'     => 'edit',
                ),
            ),
        ),
        'exercises-checkup-delete' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/checkup/delete',
                'defaults' => array(
                    'controller' => 'exercises-checkup',
                    'action'     => 'delete',
                ),
            ),
        ),
        'exercises-workout-home' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/workout',
                'defaults' => array(
                    'controller' => 'exercises-workout',
                    'action'     => 'index',
                ),
            ),
        ),
        'exercises-workout-add' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/workout/add',
                'defaults' => array(
                    'controller' => 'exercises-workout',
                    'action'     => 'add',
                ),
            ),
        ),
        'exercises-workout-edit' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/workout/edit',
                'defaults' => array(
                    'controller' => 'exercises-workout',
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
        'exercises-workout-delete' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/workout/delete',
                'defaults' => array(
                    'controller' => 'exercises-workout',
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
        'exercises-workout-exercise-home' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/workout/exercise',
                'defaults' => array(
                    'controller' => 'exercises-workout-exercise',
                    'action'     => 'index',
                ),
            ),
        ),
        'exercises-workout-exercise-add' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/workout/exercise/add',
                'defaults' => array(
                    'controller' => 'exercises-workout-exercise',
                    'action'     => 'add',
                ),
            ),
        ),
        'exercises-workout-exercise-edit' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/workout/exercise/edit',
                'defaults' => array(
                    'controller' => 'exercises-workout-exercise',
                    'action'     => 'edit',
                ),
            ),
        ),
        'exercises-workout-exercise-delete' => array(
            'type'    => 'Literal',
            'options' => array(
                'route' => '/exercises/workout/exercise/delete',
                'defaults' => array(
                    'controller' => 'exercises-workout-exercise',
                    'action'     => 'delete',
                ),
            ),
        ),
    ),
);
