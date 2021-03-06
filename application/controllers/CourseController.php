<?php

class CourseController extends Zend_Controller_Action
{

    private $course_model = null;

    private $category_model = null;
    private $user;
    public function init()
    {
        $this->auth = Zend_Auth::getInstance();
        if ($this->auth->hasIdentity()) {
            $this->view->user = $this->user = $this->auth->getIdentity();
        }else{
            $this->redirect('user/login');
        }
        $this->course_model = new Application_Model_DbTable_Course();
        $this->category_model = new Application_Model_DbTable_Category();
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        $ownerId = $this->user->id;
        if($this->_request->isPost()){
            $data = $this->_request->getParams();
            $data['owner'] = $ownerId;     // user_id_session
            $this->course_model->addCourse($data);
            mkdir(getcwd().'/files/'.$data['title']);
            $cid = $data['cid'];
            $this->redirect('course/list/attr/cid/val/'.$cid);
        } else {
            $data = $this->category_model->getCategories(null,null);
            $arr = array();
            foreach ($data as $value) {
                $arr[$value['id']] = $value['title'];
            }
            $this->view->form = new Application_Form_AddCourse($ownerId,$arr);
        }
    }

    public function listAction()
    {
    	$attr = $this->_request->getParam('attr',null);
    	$val = $this->_request->getParam('val',null);
        $this->view->courses = $this->course_model->getCourses($attr,$val);
    }

    public function editAction()
    {
        if($this->_request->isPost()){
            $data = $this->_request->getParams();
            $id = $this->_request->getParam('id',-1);
            $cid = $this->course_model->getCourseCategory($id);
            $this->course_model->updateCourse($id,$data);
            $this->redirect('course/list/attr/cid/val/'.$cid);
        }else{
            $id = $this->getRequest()->getParam('id',-1);
            $record = $this->course_model->getCourse($id);
            $ownerId = 1;       // get user id
            $data = $this->category_model->getCategories(null,null);
            $arr = array();
            foreach ($data as $value) {
                $arr[$value['id']] = $value['title'];
            }
            $form = new Application_Form_AddCourse($ownerId,$arr);
            $form->populate($record);
            $this->view->form = $form;
            $this->render('add');
        }
    }

    public function deleteAction()
    {
        $id = $this->_request->getParam('id',-1);
        $cid = $this->course_model->getCourseCategory($id);
        $this->course_model->deleteCourse($id);
        $this->redirect('course/list/attr/cid/val/'.$cid);
    }


}









