<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// boot preconditions
include 'init_boot.php';

// path definitions
include 'init_path.php';

// Setup autoloading
putenv("ZF2_PATH=".ZF2_PATH);
include 'init_autoloader.php';



/*
 * Application config
 */
$configuration = include 'config/application.config.php';


try {
    // Run the application!
    Zend\Mvc\Application::init($configuration)->run();
}
catch (Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "</pre>";
    echo "<pre>";
    print_r('code:' . $e->getCode() . ' file:' . $e->getFile() . ' line: ' . $e->getLine());
    echo "</pre>";

    echo "<pre>";
    print_r($e->getTraceAsString());
    echo "<pre>";
}