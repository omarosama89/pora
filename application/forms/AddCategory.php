<?php

class Application_Form_AddCategory extends Zend_Form
{

	/*private $id;
	private $arr;
	public function __construct($id = null){
		$this->id = $id;
        parent::__construct();
	}*/

    public function init()
    {
    	$id = new Zend_Form_Element_Hidden("id");
        $id->setValue($this->id);

        $title = new Zend_Form_Element_Text("title");
        $title->setLabel('Title :');

        $desc = new Zend_Form_Element_Textarea("descr");
        $desc->setLabel('Description :');


        $submit = new Zend_Form_Element_Submit('submit');

<<<<<<< HEAD

        $this->addElements(array($title,$desc,$id,$submit));

/*        $this->addElements(array($id,$title,$desc,$submit));
>>>>>>> 62fc816913d54e39fd781f7bbc3050ec1be84be1*/
=======
        $this->addElements(array($title,$desc,$id,$submit));
>>>>>>> 7e2b8f7c5f684c5cebad7b2e4285edc992c41ce8
    }


}

