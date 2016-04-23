<?php

class Application_Form_AddCategory extends Zend_Form
{

	private $id;
	private $arr;
	public function __construct($id = null){
		$this->id = $id;
        parent::__construct();
	}

    public function init()
    {
    	$id = new Zend_Form_Element_Hidden("id");
        $id->setValue($this->id);

        $title = new Zend_Form_Element_Text("title");
        $title->setLabel('Title :');

        $desc = new Zend_Form_Element_Textarea("descr");
        $desc->setLabel('Description :');


        $submit = new Zend_Form_Element_Submit('submit');

        $this->addElements(array($title,$desc,$id,$submit));
    }


}

