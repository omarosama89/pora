<?php

class Application_Form_AddMaterial extends Zend_Form
{

	private $ownerId;
	private $arr;
	// private $course_model;
	public function __construct($ownerId,$arr){
		$this->ownerId = $ownerId;
		$this->arr = $arr;
        parent::__construct();
        // $this->course_model = new Application_Model_DbTable_Course();
	}

    public function init()
    {
        $title = new Zend_Form_Element_Text("title");
        $title->setLabel('Title :');

        $course = new Zend_Form_Element_Select('cid');
		$course->setMultiOptions($this->arr);
		$course->setlabel('Course name :');

        $type = new Zend_Form_Element_Select('type');
		$type->setMultiOptions(array(
		    -1 => 'Type',
		    'pdf' => 'pdf',
		    'video' => 'video',
		    'image' => 'image'
		));
		$type->setlabel('material type :');
		
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('File to Upload:');

        $submit = new Zend_Form_Element_Submit('submit');
		$this->addElements(array($title,$course,$type,$file,$submit));
    }


}

?>