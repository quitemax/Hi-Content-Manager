<?php
class Hi_Resource_Db_Profiler extends Zend_Application_Resource_ResourceAbstract
{
    protected $_options = array (
        'module'        =>  'default',
        'controller'    =>  'error',
        'action'        =>  'index',
    );

    public function  init()
    {
        //
        $bootstrap = $this->getBootstrap();
        $bootstrap->bootstrap('db');

        //
        $db = $bootstrap->getResource('db');

        $profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
        $profiler->setEnabled(true);

        $db->setProfiler($profiler);

//        Zend_Debug::dump($db);

        // Return it, so that it can be stored by the bootstrap
        return $profiler;
    }
}