<?php

class Application_Form_Comment extends Zend_Form
{

    /*public function __construct($ownerId,$matId){
        $this->ownerId = $ownerId;
        $this->matId = $matId;
        parent::__construct();
    }*/
    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $content = new  Zend_Form_Element_Textarea('content');
        $content->setLabel('Content : ');
        $content->setAttrib('class','form-control');
        $content->setRequired();
        
/*
        $user_id = new Zend_Form_Element_Text('user_id');
        $user_id->setLabel('User Id : ');
        $user_id->setAttrib('class','form-control');

        $post_id = new Zend_Form_Element_Text('post_id');
        $post_id->setLabel('Post Id : ');
        $post_id->setAttrib('class','form-control');*/


        $id = new Zend_Form_Element_Hidden("id");
        $submit = new Zend_Form_Element_Submit("submit");
        $submit->setAttrib('class','form-control btn-primary');

        $this->addElements(array($content,$id,$submit));
    }



}