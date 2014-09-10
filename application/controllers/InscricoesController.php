<?php

class InscricoesController extends Zend_Controller_Action {

    private $evento;

    public function init() {
        $evento = new Evento();
        $e = $evento->find(intval($this->_getParam('evento')))->current();
        $this->view->evento = $e;
        $this->evento = $e;
        $this->view->divulgadores = $this->evento->findDependentRowset('Divulgador');
    }

    public function indexAction() {
        $this->view->inscricoes = $this->evento->findDependentRowset('Inscricao');
    }

    public function novoAction() {
        if ($this->_request->isPost()) {

            $data = $this->_request->getPost();

            $inscricao = new Inscricao();

            try {
                $inscricao->insert($data);
                $this->_helper->flashMessenger(array('success' => 'Inscrição gravada com sucesso!'));
                $this->_redirect('/inscricoes/evento/' . $this->evento->id);
            } catch (Zend_Db_Exception $exc) {
                $this->_helper->flashMessenger(array('error' => 'Desculpe, ocorreu um erro: ' . $exc->getMessage()));
            }
        }
    }

    public function editarAction() {
        $inscricao = new Inscricao();
        $atual = $inscricao->find(intval($this->getParam('id')))->current();
        $this->view->inscricao = $atual;

        if ($this->_request->isPost()) {

            $data = $this->_request->getPost();
            try {
                $inscricao->update($data, "id = {$atual->id}");
                $this->_helper->flashMessenger(array('success' => 'Inscrição gravada com sucesso!'));
                $this->_redirect('/inscricoes/evento/' . $this->evento->id);
            } catch (Zend_Db_Exception $exc) {
                $this->_helper->flashMessenger(array('error' => 'Desculpe, ocorreu um erro: ' . $exc->getMessage()));
            }
        }
    }

    public function removerAction() {
        $this->_helper->layout()->disableLayout();
        $this->getHelper('viewRenderer')->setNoRender();

        $inscricao = new Inscricao();
        $atual = $inscricao->find(intval($this->getParam('id')))->current();
        try {
            $atual->delete();
            $this->_helper->flashMessenger(array('success' => 'Inscrição Removida com sucesso!'));
            $this->_redirect('/inscricoes/evento/' . $this->evento->id);
        } catch (Zend_Db_Exception $exc) {
            $this->_helper->flashMessenger(array('error' => 'Desculpe, ocorreu um erro: ' . $exc->getMessage()));
        }
    }

    public function confirmarAction() {
        $this->_helper->layout()->disableLayout();
        $this->getHelper('viewRenderer')->setNoRender();
        try {
            $inscricao = new Inscricao();
            $inscricao->confirma($this->getParam('id'));
            $this->_helper->flashMessenger(array('success' => 'Inscrição Confirmada com sucesso!'));
            $this->_redirect('/inscricoes/evento/' . $this->evento->id);
        } catch (Zend_Db_Exception $exc) {
            $this->_helper->flashMessenger(array('error' => 'Desculpe, ocorreu um erro: ' . $exc->getMessage()));
        }
    }

    public function estornarAction() {
        $this->_helper->layout()->disableLayout();
        $this->getHelper('viewRenderer')->setNoRender();
        try {
            $inscricao = new Inscricao();
            $inscricao->estorna($this->getParam('id'));
            $this->_helper->flashMessenger(array('success' => 'Inscrição Estornada com sucesso!'));
            $this->_redirect('/inscricoes/evento/' . $this->evento->id);
        } catch (Zend_Db_Exception $exc) {
            $this->_helper->flashMessenger(array('error' => 'Desculpe, ocorreu um erro: ' . $exc->getMessage()));
        }
    }

}
