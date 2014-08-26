<?php

class EventosController extends Zend_Controller_Action {

    public function indexAction() {
        $evento = new Evento();
        $eventos = $evento->fetchAll();
        $this->view->eventos = $eventos;
    }

    public function novoAction() {
        if ($this->_request->isPost()) {

            $data = $this->_request->getPost();
            $data['realizacao'] = Util::dataMysql($data['realizacao']);
            $data['valor'] = Util::currencyToMysql($data['valor']);

            $evento = new Evento();

            try {
                $evento->insert($data);
                $this->_helper->flashMessenger(array('success' => 'Evento gravado com sucesso!'));
                $this->_redirect('/eventos');
            } catch (Zend_Db_Exception $exc) {
                $this->_helper->flashMessenger(array('error' => 'Desculpe, ocorreu um erro: ' . $exc->getMessage()));
            }
        }
    }

    public function editarAction() {
        $evento = new Evento();
        $atual = $evento->find(intval($this->_getParam('id')))->current();
        $this->view->evento = $atual;

        if ($this->_request->isPost()) {

            $data = $this->_request->getPost();
            $data['realizacao'] = Util::dataMysql($data['realizacao']);
            $data['valor'] = Util::currencyToMysql($data['valor']);

            try {
                $evento->update($data, "id = $atual->id");
                $this->_helper->flashMessenger(array('success' => 'Evento gravado com sucesso!'));
                $this->_redirect('/eventos');
            } catch (Zend_Db_Exception $exc) {
                $this->_helper->flashMessenger(array('error' => 'Desculpe, ocorreu um erro: ' . $exc->getMessage()));
            }
        }
    }

    public function detalhesAction() {
        $evento = new Evento();
        $this->view->evento = $evento->find(intval($this->_getParam('id')))->current();
    }

}
