<?php

class Application_Form_AddCategory extends Zend_Form
{

    public function init()
    {
        $title = new Zend_Form_Element_Text("title");
        $title->setLabel('Title :');

        $desc = new Zend_Form_Element_Textarea("descr");
        $desc->setLabel('Description :');

        $submit = new Zend_Form_Element_Submit('submit');

        $this->addElements(array($title,$desc,$submit));
    }


}

