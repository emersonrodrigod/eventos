<?php

class Usuario extends Zend_Db_Table_Abstract {

    protected $_name = 'usuario';

    public function acceptFromUserData($dados) {

        $validadores = array(
            'nome' => array(
                'allowEmpty' => false
            ),
            'email' => array(
                'allowEmpty' => false,
                'emailAdrress' => true
            ),
            'senha' => array(
                'allowEmpty' => false
            ),
            'role' => array(
                'allowEmpty' => false
            )
        );

        return new Zend_Filter_Input(array(), $validadores, $dados);
    }

}
