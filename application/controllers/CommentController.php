<?php

class CommentController extends Zend_Controller_Action
{
	private $comment_model;
    private $material_model;

    public function init()
    {
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity()) {
            $this->view->user = $this->user = $this->auth->getIdentity();
        }else{
            $this->redirect('user/login');
        }
    	$this->comment_model = new Application_Model_DbTable_Comment();
        $this->material_model = new Application_Model_DbTable_Material();
    	
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
    public function addAction(){
        $ownerId = $this->user->id;
        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getParams();
            $data['owner']= $ownerId;
            $mid = $data['mid'];
            $this->comment_model->addComment($data);
            $this->redirect('comment/list/attr/mid/val/'.$mid);

        }
            //$ownerId = 1; ///will get by session
            //$matId = 1; /// get the mat id
        $mid = $this->_request->getParam('mid',-1);
        $this->view->form = new Application_Form_Comment($mid);
        $this->view->flag = 1;
    }

    public function listAction(){
        $mid = $this->_request->getParam('val',-1);
        $this->view->comments = $this->comment_model->listComments($mid);

    }

    public function deleteAction(){
        $id = $this->getRequest()->getParam('id');
        if($id){
            if($this->comment_model->deleteComment($id)){
                $this->redirect('comment/list');    
            }
        }
        else{
            $this->redirect('comment/list');
        }

    }

    public function editAction(){
        $id = $this->getRequest()->getParam('id');
        $comment = $this->comment_model->getCommentById($id);
        $form = new Application_Form_Comment();
        $form->populate($comment[0]);
        $this->view->form = $form;
        $this->render('add');
        
        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getParams();
            $id = $this->getRequest()->getParam('id');
            $editcomment = $this->comment_model->editComment($data,$id);
            $this->redirect('comment/list');
        };
    }

}

