<?php

class Divulgador extends Zend_Db_Table_Abstract {

    protected $_name = "divulgador";
    protected $_dependentTables = array('Inscricao');
    protected $_referenceMap = array(
        'Evento' => array(
            'refTableClass' => 'Evento',
            'refColumns' => array('id'),
            'columns' => array('id_evento')
        )
    );

}
