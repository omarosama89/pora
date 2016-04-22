<?php

class Application_Form_AddCategory extends Zend_Form
{
	private $ownerId;
	public function __construct($ownerId){
		$this->ownerId = $ownerId;
        parent::__construct();
	}

    public function init()
    {
        $title = new Zend_Form_Element_Text("title");
        $title->setLabel('Title :');

        $desc = new Zend_Form_Element_Textarea("descr");
        $desc->setLabel('Description :');

        $id = new Zend_Form_Element_Hidden("id");

        $submit = new Zend_Form_Element_Submit('submit');

        $this->addElements(array($title,$desc,$id,$submit));
    }


}

