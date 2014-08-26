<?php

class Evento extends Zend_Db_Table_Abstract {

    protected $_name = 'evento';
    protected $_dependentTables = array('Divulgador','Inscricao');

}
