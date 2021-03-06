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

use Zend\Form\Element\Text as ZendText;

/**
 * Hi_Record_Form
 *
 * @category   Hi
 * @package    Hi\Grid
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class Custom extends ZendText
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
    protected $_viewScriptOptions = array();
    protected $_viewScriptPath = '';
    protected $_sort = '';
    protected $_even = '';
    protected $_values = '';
    protected $_row = '';

    /**
     * Set form state from options array
     *
     * @param  array $options
     * @return Form
     */
    public function setOptions(array $options)
    {

        $this->_viewScriptOptions = array_merge($this->_viewScriptOptions, $options);
      //
//        if (isset($options['row'])) {
//            $this->_row = $options['row'];
//            unset($options['row']);
//        } else {
//            $this->_row = null;;
//        }
//
//        if (isset($options['sort'])) {
//            $this->_sort = $options['sort'];
//            unset($options['sort']);
//        } else {
//            $this->_sort = null;;
//        }
//
//        //
//        if (isset($options['values'])) {
//            $this->_values = $options['values'];
//            unset($options['values']);
//        } else {
//            $this->_values = null;;
//        }
//
//        //
//        if (isset($options['viewScript'])) {
//            $this->_viewScriptPath = $options['viewScript'];
//            unset($options['viewScript']);
//        } else {
//            throw new \Exception("You must provide a viewScript path here.");
//        }
//
//        if (isset($options['even'])) {
//            $this->_even = $options['even'];
//            unset($options['even']);
//        } else {
//            throw new \Exception("You must provide a even path here.");
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
        $this->_viewScriptOptions = array_merge($this->_viewScriptOptions, array('placement'     => false));

//        \Zend\Debug::dump($this->_viewScriptOptions);
//        \Zend\Debug::dump(array(
//                        'viewScript'    => $this->_viewScriptPath,
//                        'placement'     => false,
//                        'sort'          => $this->_sort,
//                        'even'          => $this->_even,
//                        'values'        => $this->_values,
//                        'row'           => $this->_row,
//                    ));

        $this->setDecorators(
            array(
                array(
                    'ViewScript',
                    $this->_viewScriptOptions,
                ),
            )
        );
    }
}