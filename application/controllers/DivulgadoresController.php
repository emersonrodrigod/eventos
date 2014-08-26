<?php

class DivulgadoresController extends Zend_Controller_Action {

    private $evento;

    public function init() {
        $evento = new Evento();
        $e = $evento->find(intval($this->_getParam('evento')))->current();
        $this->view->evento = $e;
        $this->evento = $e;
    }

    public function indexAction() {
        $this->view->divulgadores = $this->evento->findDependentRowset('Divulgador');
    }

    public function novoAction() {
        if ($this->_request->isPost()) {

            $data = $this->_request->getPost();

            $divulgador = new Divulgador();

            try {
                $divulgador->insert($data);
                $this->_helper->flashMessenger(array('success' => 'Divulgador gravado com sucesso!'));
                $this->_redirect('/divulgadores/evento/' . $this->evento->id);
            } catch (Zend_Db_Exception $exc) {
                $this->_helper->flashMessenger(array('error' => 'Desculpe, ocorreu um erro: ' . $exc->getMessage()));
            }
        }
    }

    public function editarAction() {
        $divulgador = new Divulgador();
        $atual = $divulgador->find(intval($this->getParam('id')))->current();
        $this->view->divulgador = $atual;

        if ($this->_request->isPost()) {

            $data = $this->_request->getPost();
            try {
                $divulgador->update($data, "id = {$atual->id}");
                $this->_helper->flashMessenger(array('success' => 'Divulgador gravado com sucesso!'));
                $this->_redirect('/divulgadores/evento/' . $this->evento->id);
            } catch (Zend_Db_Exception $exc) {
                $this->_helper->flashMessenger(array('error' => 'Desculpe, ocorreu um erro: ' . $exc->getMessage()));
            }
        }
    }

    public function removerAction() {
        $this->_helper->layout()->disableLayout();
        $this->getHelper('viewRenderer')->setNoRender();

        $divulgador = new Divulgador();
        $atual = $divulgador->find(intval($this->getParam('id')))->current();
        try {
            $atual->delete();
            $this->_helper->flashMessenger(array('success' => 'Divulgador Removido com sucesso!'));
            $this->_redirect('/divulgadores/evento/' . $this->evento->id);
        } catch (Zend_Db_Exception $exc) {
            $this->_helper->flashMessenger(array('error' => 'Desculpe, ocorreu um erro: ' . $exc->getMessage()));
        }
    }

}
