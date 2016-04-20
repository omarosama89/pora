<?php

class CourseController extends Zend_Controller_Action
{

	private $course_model = null;
	private $category_model = null;
    public function init()
    {
        $this->course_model = new Application_Model_DbTable_Course();
        $this->category_model = new Application_Model_DbTable_Category();
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        if($this->_request->isPost()){
            $data = $this->_request->getParams();
            
            $data['owner'] = 1;     // user_id_session
            
            var_dump($data);
            $this->course_model->addCourse($data);
            // $this->redirect("post/list");
        } else {
            $ownerId = 1;       // get user id
            $data = $this->category_model->getCategories(null,null);
            $arr = array();
            // echo getcwd();
            // exit;
            // var_dump($data);
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


}





