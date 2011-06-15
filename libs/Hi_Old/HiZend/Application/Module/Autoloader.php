<?php
class HiZend_Application_Module_Autoloader extends Zend_Application_Module_Autoloader
{
/**
     * Initialize default resource types for module resource classes
     *
     * @return void
     */
    public function initDefaultResourceTypes()
    {
        parent::initDefaultResourceTypes();
        $this->addResourceTypes(
            array(
                'libs' => array(
                    'namespace' => 'Libs',
                    'path'      => 'libs',
                ),
            )
        );
        
    }
}