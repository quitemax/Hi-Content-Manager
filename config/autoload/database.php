<?php
// ./config/autoload/database.config.php
$mdb = array(
    'dbname' => 'exercises',
    'user' => 'root',
    'pass' => '',
    'host' => 'localhost',
);

/**
* No need to edit below this line
* @TODO: Better support for master/slave
*/
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'masterdb' => 'PDO',
              //'slavedb' => 'PDO', // Example of adding multiple DB connections
            ),
            'masterdb' => array(
                'parameters' => array(
                    'dsn' => "mysql:dbname={$mdb['dbname']};host={$mdb['host']}",
                    'username' => $mdb['user'],
                    'passwd' => $mdb['pass'],
                    'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''),
                ),
            ),
            'Zend\Db\Adapter\Adapter' => array(
                'parameters' => array(
                    'driver' => 'Zend\Db\Adapter\Driver\Pdo\Pdo',
                ),
            ),
            'Zend\Db\Adapter\Driver\Pdo\Pdo' => array(
                'parameters' => array(
                    'connection' => 'Zend\Db\Adapter\Driver\Pdo\Connection',
                ),
            ),
            'Zend\Db\Adapter\Driver\Pdo\Connection' => array(
                'parameters' => array(
                    'connectionInfo' => 'masterdb',
                ),
            ),
            /**
            * 'slavedb' => array(
            * 'parameters' => array(
            * 'dsn' => "mysql:dbname={$sdb['dbname']};host={$sdb['host']}",
            * 'username' => $sdb['user'],
            * 'passwd' => $sdb['pass'],
            * 'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''),
            * ),
            * ),
            */
        ),
    ),
);
