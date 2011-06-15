<?php
class User_Form_LogIn extends Hi_Record_Form
{
    public function init()
    {
        parent::init();
        
        $loginRow = new Hi_Record_SubForm_Row(
            array(
                'title'     => $this->_view->translate('logIn'),
                'name'      => 'loginRow',
                'view'      => $this->_view,
            )
        );
        $loginRow->addField(
            'username',
            'username',
            array(
                'length' => 64,
                'label' => $this->_view->translate('username'),
            )
        );
        $loginRow->addField(
            'password',
            'password',
            array(
                'length' => 64,
                'label' => $this->_view->translate('password'),
            )
        );
        $loginRow->addAction(
            'submitLogin',
            'submit',
            array(
                'label' => $this->_view->translate('logIn'),
                'class' => 'actionSubmit',
            )
        );

        //
        $loginRow->build();
        $this->addSubForm($loginRow, $loginRow->getName());
    }
}