<?php

class Lancamento extends Zend_Db_Table_Abstract {

    protected $_name = 'lancamento';
    protected $_referenceMap = array(
        'Evento' => array(
            'refTableClass' => 'Evento',
            'refColumns' => array('id'),
            'columns' => array('id_evento')
        ),
        'Usuario' => array(
            'refTableClass' => 'Usuario',
            'refColumns' => array('id'),
            'columns' => array('id_usuario')
        )
    );

}
