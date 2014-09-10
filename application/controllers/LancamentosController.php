<?php

class LancamentosController extends Zend_Controller_Action {

    private $evento;
    private $idUsuario;

    public function init() {
        $evento = new Evento();
        $e = $evento->find(intval($this->_getParam('evento')))->current();
        $this->view->evento = $e;
        $this->evento = $e;

        $usuario = new Zend_Auth_Storage_Session("usuario");
        $this->idUsuario = $usuario->read()->id;
    }
    
    public function indexAction(){
        $this->view->lancamentos = $this->evento->findDependentRowset('Lancamento');
    }

}
