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
<<<<<<< HEAD
            
            $this->view->form = new Application_Form_AddCategory($ownerId);
        }
    }

    public function deleteAction(){
        $id = $this->getRequest()->getParam('id');
        if($id){
            if($this->category_model->deleteCategory($id)){
                $this->redirect('category/list');    
            }
        }
        else{
            $this->redirect('category/list');
        }
    }

    public function editAction(){
        $id = $this->getRequest()->getParam('id');
        $category = $this->category_model->getCategories("id",$id);
        $form = new Application_Form_AddCategory();
        $form->populate($category[0]);
        $this->view->form = $form;
        $this->render('add');
        
        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getParams();
            $id = $this->getRequest()->getParam('id');
            $editcategory = $this->category_model->editCategory($id,$data);
            $this->redirect('category/list');
        };
    }
}

    /*public function listCRUDAction()
    {
        $attr = $this->_request->getParam('attr',null);
        $val = $this->_request->getParam('val',null);
        $this->view->categories = $this->category_model->getCategories($attr,$val);
    }*/
=======
            $this->view->form = new Application_Form_AddCategory();
        }
    }


    // public function listCRUDAction()
    // {
    //     $attr = $this->_request->getParam('attr',null);
    //     $val = $this->_request->getParam('val',null);
    //     $this->view->categories = $this->category_model->getCategories($attr,$val);
    // }
>>>>>>> 7e2b8f7c5f684c5cebad7b2e4285edc992c41ce8

/*    public function editAction()
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



}*/








