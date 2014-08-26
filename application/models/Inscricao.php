<?php

class Inscricao extends Zend_Db_Table_Abstract {

    protected $_name = 'inscricao';
    protected $_rowClass = 'InscricaoRow';
    protected $_referenceMap = array(
        'Evento' => array(
            'refTableClass' => 'Evento',
            'refColumns' => array('id'),
            'columns' => array('id_evento')
        ),
        'Divulgador' => array(
            'refTableClass' => 'Divulgador',
            'refColumns' => array('id'),
            'columns' => array('id_divulgador')
        )
    );

}
