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

namespace HiCheckup\Model\Checkup;

//namespace Zend\Mvc\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HiCheckup\Model\Checkup;
use HiCheckup\Model\Checkup\ResultSet;
use HiCheckup\Model\Checkup\Row;

/**
 * @category   Zend
 * @package    Zend_Mvc
 * @subpackage Service
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Factory implements FactoryInterface
{
    /**
     * Create and return the feed view renderer
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return HiCheckup\Model\Checkup
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
//        \Zend\Debug::dump($serviceLocator->get('Configuration'));
        $dbAdapter = $serviceLocator->get('DbAdapter');

        if ($dbAdapter) {

            $row = new Row(
                'checkup_id', 'checkup', $dbAdapter
            );

            $resultSet = new ResultSet(
                null,
                $row
            );


            $model = new Checkup(
                'checkup',
                $dbAdapter,
                null,
                $resultSet
            );

//            \Zend\Debug::dump($model);

            return $model;

        }

        return null;
    }
}

