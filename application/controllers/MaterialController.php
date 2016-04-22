<?php

class MaterialController extends Zend_Controller_Action
{
    private $material_model = null;
    private $course_model = null;

    public function init()
    {
        $this->material_model = new Application_Model_DbTable_Material();
        $this->course_model = new Application_Model_DbTable_Course();
    }

    public function indexAction()
    {
        // action body
    }

    private function handle_file($path){
        // exit;
        $upload = new Zend_File_Transfer_Adapter_Http();
        $upload->setDestination($path);

        try {
            // This takes care of the moving and making sure the file is there
            $upload->receive();
            return $upload->getFileName();
            // Dump out all the file info
            Zend_Debug::dump($upload->getFileInfo());
        } catch (Zend_File_Transfer_Exception $e) {
            return false;
        }
    }

    public function addAction()
    {
        if($this->_request->isPost()){
            $data = $this->_request->getParams();
            
            $filePath = $this->handle_file(getcwd()."/files/".$this->course_model->getCourseTitle($data['cid']));
            $data['location'] = $filePath;
            $data['owner'] = 1;     // user_id_session
            
            var_dump($data);
            $this->material_model->addMaterial($data);
            // $this->redirect("post/list");
        } else {
            $ownerId = 1;       // get user id
            $data = $this->course_model->getCourses(null,null);
            $arr = array();
            // echo getcwd();
            // exit;
            // var_dump($data);
            foreach ($data as $value) {
                // var_dump($value);
                $arr[$value['id']] = $value['title'];
            }
            $this->view->form = new Application_Form_AddMaterial($ownerId,$arr);
        }
    }

    public function editAction()
    {
        if($this->_request->isPost()){
            $data = $this->_request->getParams();
            $id = $this->_request->getParam('id',-1);
            $cid = $this->material_model->getMaterialCourse($id);
            $this->material_model->updateMaterial($id,$data);
            $this->redirect('material/list/attr/cid/val/'.$cid);
        }else{
            $id = $this->getRequest()->getParam('id',-1);
            $record = $this->material_model->getmaterial($id);
            $ownerId = 1;       // get user id
            $data = $this->course_model->getCourses(null,null);
            $arr = array();
            foreach ($data as $value) {
                $arr[$value['id']] = $value['title'];
            }
            $form = new Application_Form_AddMaterial($ownerId,$arr);
            $form->populate($record);
            $this->view->form = $form;
            $this->render('add');
        }
    }

    public function listAction()
    {
        $attr = $this->_request->getParam('attr',null);
        $val = $this->_request->getParam('val',null);
        $this->view->materials = $this->material_model->getmaterials($attr,$val);
    }

    public function deleteAction()
    {
        $id = $this->_request->getParam('id',-1);
        $cid = $this->material_model->getMaterialCourse($id);
        $this->material_model->deleteMaterial($id);
        $this->redirect('material/list/attr/cid/val/'.$cid);
    }


}









