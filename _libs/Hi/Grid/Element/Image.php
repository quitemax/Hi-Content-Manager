<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi\Grid
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 */
namespace Hi\Grid\Element;

use Zend\Form\Element\Image as ZendImage;

/**
 * Hi_Record_Form
 *
 * @category   Hi
 * @package    Hi\Grid
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class Image extends ZendImage
{
    /**
     * Should we disable loading the default decorators?
     * @var bool
     */
    protected $_disableLoadDefaultDecorators = true;

    /**
     * Should we disable loading the default decorators?
     * @var bool
     */
    protected $_viewScriptPath = '';

    /**
     * Set form state from options array
     *
     * @param  array $options
     * @return Form
     */
    public function setOptions(array $options)
    {
        //
//        if (isset($options['viewScript'])) {
//            $this->_viewScriptPath = $options['viewScript'];
//            unset($options['viewScript']);
//        } else {
//            throw new \Exception("You must provide a viewScript path here.");
//        }

        return parent::setOptions($options);
    }

    /**
     * Builds the form from form elements and adds everything needed
     *
     * @return Zend_Form
     */
    public function init()
    {
        $this->setDecorators(
            array(
                array('ViewHelper')
            )
        );
    }
}