<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi\Grid
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 */
namespace HiBase\Grid\Element;

use Zend\Form\Element\Hidden as ZendHidden;

/**
 * Hi_Record_Form
 *
 * @category   Hi
 * @package    Hi\Grid
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class Hidden extends ZendHidden
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
    protected $_sort = '';
    protected $_even = '';

    /**
     * Set form state from options array
     *
     * @param  array $options
     * @return Form
     */
    public function setOptions(array $options)
    {
        //
        if (isset($options['sort'])) {
            $this->_sort = $options['sort'];
            unset($options['sort']);
        } else {
            $this->_sort = null;;
        }

        //
        if (isset($options['viewScript'])) {
            $this->_viewScriptPath = $options['viewScript'];
            unset($options['viewScript']);
        } else {
            throw new \Exception("You must provide a viewScript path here.");
        }

        if (isset($options['even'])) {
            $this->_even = $options['even'];
            unset($options['even']);
        } else {
            throw new \Exception("You must provide a even path here.");
        }

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
                array('ViewHelper'),
                array(
                    'ViewScript',
                    array(
                        'viewScript'    => $this->_viewScriptPath,
                        'placement'     => false,
                        'sort'          => $this->_sort,
                        'even'          => $this->_even,
                    ),
                ),
            )
        );
    }
}