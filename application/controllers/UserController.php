<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_User();
        $model=new Application_Model_DbTable_User();
        if($this->getRequest()->isPost()){
          $data = $this->getRequest()->getParams();
          if($form->isValid($data)){
            if ($model->addUser($data))
                $this->redirect('user/list');
             }
        }
       $this->view->form=$form;
    }

    public function editAction()
    {
        // action body
      $model=new Application_Model_DbTable_User();
        $data = $this->getRequest()->getParams();
        $id = $this->getRequest()->getParam('id');
        $form = new Application_Form_User();
        $user = $model->getUserById($id);
        $form->populate($user[0]);
        $this->view->form = $form;
        if($this->getRequest()->isPost()){
            if($form->isValid($data)){
                if($model->editUser($id,$data)){
                    $this->redirect('user/list');
                }
            }
        }
        $this->render('add');
    }

    public function listAction()
    {
        // action body
        $model=new Application_Model_DbTable_User();
        $this->view->listusers=$model->listUsers();
    }

    public function deleteAction()
    {
        // action body
        $model=new Application_Model_DbTable_User();
        $this->view->listusers=$model->listUsers();
        $id = $this->getRequest()->getParam('id');
            if($model->deleteUser($id)){
                $this->redirect('user/list');
            }
            else{
                $this->redirect('user/list');

            }
    
    }

    public function banAction()
    {
        // action body
        $model=new Application_Model_DbTable_User();
        $this->view->listusers=$model->listUsers();
        $id = $this->getRequest()->getParam('id');
            if($model->banUser($id)){
                $this->redirect('user/list');
            }
            else{
                $this->redirect('user/list');

            }
    
    }

    public function listbanAction()
    {
        // action body
        $model=new Application_Model_DbTable_User();
        $this->view->listusers=$model->listUsers();
        
    }

      public function activeAction()
    {
        // action body
        $model=new Application_Model_DbTable_User();
        $this->view->listusers=$model->listUsers();
        $id = $this->getRequest()->getParam('id');
            if($model->activeUser($id)){
                $this->redirect('user/listban');
            }
            else{
                $this->redirect('user/listban');

            }
     
        
    }

}

