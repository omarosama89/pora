<?php

class Application_Form_AddCourse extends Zend_Form
{

	private $ownerId;
	private $arr;
	public function __construct($ownerId,$arr){
		$this->ownerId = $ownerId;
		$this->arr = $arr;
        parent::__construct();
	}

    public function init()
    {
        $title = new Zend_Form_Element_Text("title");
        $title->setLabel('Title :');

        $category = new Zend_Form_Element_Select('cid');
		$category->setMultiOptions($this->arr);
		$category->setlabel('Category :');

        $desc = new Zend_Form_Element_Textarea("descr");
        $desc->setLabel('Description :');

        $submit = new Zend_Form_Element_Submit('submit');

		$this->addElements(array($title,$category,$desc,$submit));
    }


}

