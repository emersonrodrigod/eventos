<?php

class Inscricao extends Zend_Db_Table_Abstract {

    protected $_name = 'inscricao';
    protected $_rowClass = 'InscricaoRow';
    protected $_dependentTables = array('Caixa');
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

    public function confirma($id) {
        $inscricao = $this->find(intval($id))->current();
        $evento = $inscricao->findParentRow('Evento');
        $usuario = new Zend_Auth_Storage_Session("usuario");

        $dadosCaixa = array(
            'id_evento' => $evento->id,
            'id_inscricao' => $inscricao->id,
            'id_usuario' => $usuario->read()->id,
            'valor' => $evento->valor,
            'historico' => 'Valor ref. Pagamento de Inscricao do(a) ' . $inscricao->nome
        );

        $caixa = new Caixa();

        if ($caixa->insert($dadosCaixa)) {
            $inscricao->situacao = 1;
            $inscricao->save();
            return true;
        }

        return false;
    }

    public function estorna($id) {
        $inscricao = $this->find(intval($id))->current();
        $evento = $inscricao->findParentRow('Evento');
        $usuario = new Zend_Auth_Storage_Session("usuario");

        $dadosCaixa = array(
            'id_evento' => $evento->id,
            'id_inscricao' => $inscricao->id,
            'id_usuario' => $usuario->read()->id,
            'valor' => -1 * $evento->valor,
            'historico' => 'Valor ref. Estorno de pagamento de Inscricao do(a) ' . $inscricao->nome
        );
        
        $caixa = new Caixa();

        if ($caixa->insert($dadosCaixa)) {
            $inscricao->situacao = 0;
            $inscricao->save();
            return true;
        }

        return false;
    }

}
