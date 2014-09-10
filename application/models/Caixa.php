<?php

class Caixa extends Zend_Db_Table_Abstract {

    protected $_name = 'caixa';
    protected $_referenceMap = array(
        'Evento' => array(
            'refTableClass' => 'Evento',
            'refColumns' => array('id'),
            'columns' => array('id_evento')
        ),
        'Inscricao' => array(
            'refTableClass' => 'inscricao',
            'refColumns' => array('id'),
            'columns' => array('id_inscricao')
        )
    );

}
