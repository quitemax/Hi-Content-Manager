<?php
/**
 * Hi CMS
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 */
namespace Hi\Grid;

use Zend\Form\SubForm as ZendSubForm;

/**
 * Hi_Record_Form
 *
 * @category   Hi
 * @package    Hi_Grid
 * @copyright  Copyright (c) 2010 Piotr Maxymilian Socha
 * @license
 * @version    2.0
 */
class SubForm extends ZendSubForm
{
    /**
     * Should we disable loading the default decorators?
     * @var bool
     */
    protected $_disableLoadDefaultDecorators = true;

    /**
     * Set form state from options array
     *
     * @param  array $options
     * @return Form
     */
    public function setOptions(array $options)
    {
        //
        if (isset($options['view'])) {
            $this->setView($options['view']);
        }

        return parent::setOptions($options);
    }
}