<?php

class CategoryController extends Zend_Controller_Action
{

    private $category_model = null;

    public function init()
    {
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
            
            var_dump($data);
            $this->category_model->addCategory($data);
            $this->redirect("category/list");
        } else {
            $ownerId = 1;       // get user id
            
            $this->view->form = new Application_Form_AddCategory();
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





