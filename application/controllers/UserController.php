<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity()) {
                $identity = $auth->getIdentity();
                $this->view->email = $auth->getIdentity()->email;
                $this->view->pwd = $auth->getIdentity()->pwd;
        }
        $this->model=new Application_Model_DbTable_User();
    }
//---------------------------------------------------------------------------------
    public function indexAction()
    {
        // action body
    }
//------------------------------Add Action-----------------------------------------
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
//---------------------------------Edit Action--------------------------------------
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
//------------------------------------List Action----------------------------------
    public function listAction()
    {
        // action body
        $model=new Application_Model_DbTable_User();
        $this->view->listusers=$model->listUsers();
    }
//----------------------------------------delete Action-----------------------------
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
//--------------------------------------Ban Action---------------------------------
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
//----------------------------------------List Ban---------------------------------
    public function listbanAction()
    {
        // action body
        $model=new Application_Model_DbTable_User();
        $this->view->listusers=$model->listUsers();
        
    }
//----------------------------------------Active Action-----------------------------
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
//----------------------------------------login Action-----------------------------
    public function loginAction()
    {

    
}

//----------------------------------------logout Action-----------------------------
public function logoutAction(){

      /*  Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy();
        $this->_redirect('index/index');*/
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();
        $this->render('home');
}
//-----------------------------------------------------------------------------------
}

