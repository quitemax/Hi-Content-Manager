<?php


namespace HiUser\Form\User;

use HiBase\Grid\Form,
    HiBase\Grid\SubForm\Row;

class LogIn extends Form
{
    /**
     * Title
     *
     * @var string
     */
    protected $_title = 'UserGrid';

    /**
     * Title
     *
     * @var string
     */
    protected $_name = 'UserGridForm';

    /**
     *
     *
     *
     */
    public function init()
    {
        parent::init();


        $loginRow = new Row(
            array(
                'title'     => 'logIn',
                'name'      => 'logInRow',
                'view'      => $this->_view,
            )
        );
        $loginRow->addField(
            'username',
            'username',
            array(
                'length' => 128,
                'label' => 'username',
            )
        );
        $loginRow->addField(
            'password',
            'password',
            array(
                'length' => 128,
                'label' => 'password',
            )
        );
        $loginRow->addAction(
            'submitLogin',
            'submit',
            array(
                'label' => 'logIn',
                'class' => 'actionSubmit',
            )
        );

        //
        $loginRow->build();
        $this->addSubForm($loginRow, $loginRow->getName());
    }



}