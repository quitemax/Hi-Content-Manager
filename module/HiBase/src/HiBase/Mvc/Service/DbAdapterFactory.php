<?php
///**
// * Zend Framework
// *
// * LICENSE
// *
// * This source file is subject to the new BSD license that is bundled
// * with this package in the file LICENSE.txt.
// * It is also available through the world-wide-web at this URL:
// * http://framework.zend.com/license/new-bsd
// * If you did not receive a copy of the license and are unable to
// * obtain it through the world-wide-web, please send an email
// * to license@zend.com so we can send you a copy immediately.
// *
// * @category   Zend
// * @package    Zend_Mvc
// * @subpackage Service
// * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
// * @license    http://framework.zend.com/license/new-bsd     New BSD License
// */

namespace HiBase\Mvc\Service;
//namespace Zend\Mvc\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\Adapter\Adapter;

/**
 * @category   Zend
 * @package    Zend_Mvc
 * @subpackage Service
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class DbAdapterFactory implements FactoryInterface
{
    /**
     * Create and return the feed view renderer
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Zend\Db\Adapter\Adapter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Configuration');

        if (!empty($config['db'])) {

            $dbConfig = $config['db'];

            if (isset($dbConfig['database'], $dbConfig['username'], $dbConfig['password'], $dbConfig['hostname'])) {

                $dbAdapter = new Adapter(array(
                    'driver'    => 'pdo',
                    'dsn'       => 'mysql:dbname='.$dbConfig['database'].';host='.$dbConfig['hostname'],
                    'database'  => $dbConfig['database'],
                    'username'  => $dbConfig['username'],
                    'password'  => $dbConfig['password'],
                    'hostname'  => $dbConfig['hostname'],
                ));

                return $dbAdapter;

            }
        }

        return null;
    }
}

