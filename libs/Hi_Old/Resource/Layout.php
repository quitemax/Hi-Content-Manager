<?php
class Hi_Resource_Layout extends Zend_Application_Resource_ResourceAbstract
{
    protected $_options = array (
        'layout'    =>  'default',
        'skin'      =>  'default',
    );

    public function  init()
    {
        //
        $options = $this->getOptions();

        //
        Zend_Layout::startMvc();

        /*@var layout Zend_Layout */
        $layout = Zend_Layout::getMvcInstance();

        //
        $layout->setLayout($options['layout']);



        //
        if (isset($options['layoutPath'])) {
            $layout->setLayoutPath($options['layoutPath'] . $options['skin'] . '/layouts/');
        }

        // Return it, so that it can be stored by the bootstrap
        return $layout;
    }
}