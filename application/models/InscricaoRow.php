<?php

class InscricaoRow extends Zend_Db_Table_Row_Abstract {

    public function getSituacao() {
        switch ($this->situacao) {
            case 0 : return 'Pendente';
            case 1 : return 'Pago';
        }
    }

    public function getDivulgador() {
        return $this->findParentRow('Divulgador');
    }

    public function getValor() {
        return $this->findParentRow('Evento')->valor;
    }

}
