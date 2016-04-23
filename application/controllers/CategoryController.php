<?php

class CategoryController extends Zend_Controller_Action
{

    private $category_model = null;

    public function init()
    {
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity()) {
                $this->view->user = $this->auth->getIdentity();
                
        }
        $this->category_model = new Application_Model_DbTable_Category();
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        $attr = $this->_request->getParam('attr',null);
        $val = $this->_request->getParam('val',null);
        $this->view->categories = $this->category_model->getCategories($attr,$val);
    }

    public function addAction()
    {
        if($this->_request->isPost()){
            $data = $this->_request->getParams();
            $data['owner'] = 1;     // user_id_session
            $this->category_model->addCategory($data);
            $this->redirect("category/list");
        } else {
            $ownerId = 1;       // get user id
            $this->view->form = new Application_Form_AddCategory();
        }
    }


    // public function listCRUDAction()
    // {
    //     $attr = $this->_request->getParam('attr',null);
    //     $val = $this->_request->getParam('val',null);
    //     $this->view->categories = $this->category_model->getCategories($attr,$val);
    // }

    public function editAction()
    {
        if($this->_request->isPost()){
            $data = $this->_request->getParams();
            $id = $this->_request->getParam('id',-1);
            $this->category_model->updatecategory($id,$data);
            $attr = $this->_request->getParam('attr',null);
            $val = $this->_request->getParam('val',null);
            $this->view->categories = $this->category_model->getCategories($attr,$val);
            $this->render('list');
        }else{
            $id = $this->getRequest()->getParam('id',-1);
            $record = $this->category_model->getCategory($id);
            $form = new Application_Form_AddCategory();
            $form->populate($record);
            $this->view->form = $form;
            $this->render('add');
        }

    }

    public function deleteAction()
    {
        $id = $this->_request->getParam('id',-1);
        $this->category_model->deleteCategory($id);
        $this->redirect('category/list');
    }


}








