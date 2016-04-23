<?php

class RequestController extends Zend_Controller_Action
{

    public function init()
    {
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity()) {
                $this->view->user = $this->auth->getIdentity(); 
        }
    }

    public function indexAction()
    {
        // action body
    }
//------------------------------------------------------------------------
    public function addAction()
   {
        // action body
        $request_form = new Application_Form_AddRequest();
        $model=new Application_Model_DbTable_Request();
        if($this->getRequest()->isPost()){
          $data = $this->getRequest()->getParams();
          $data['owner'] = $this->auth->getIdentity()->id;
          if($request_form->isValid($data)){
            if ($model->addRequest($data))
                $this->redirect('request/list');
             }
         }
       $this->view->request_form=$request_form;
    }
//------------------------------------------------------------------------
    public function listAction()
    {
        // action body
        $model=new Application_Model_DbTable_Request();
        $this->view->listrequest=$model->listRequest();
    }
//------------------------------------------------------------------------
    public function deleteAction()
    {
        // action body
        $model=new Application_Model_DbTable_Request();
        $this->view->listrequest=$model->listRequest();
        $id = $this->getRequest()->getParam('id');
            if($model->deleteRequest($id)){
                $this->redirect('request/list');
            }
            else{
                $this->redirect('request/list');
            }
    
    }
//-------------------------------------------------------------------------------
}







