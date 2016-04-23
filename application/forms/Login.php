<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

         $this->setMethod('post');

        	$this->addElement('text', 'email', array(
            'label'      => ' email:',
            'required'   => true,
            'class'      => 'form-control',
            'filters'    => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            )
        ));



        	 $this->addElement('password', 'pwd', array(
            'label'      => 'password:',
            'class'      => 'form-control',
            'required'   => true,
            'size'       => 20,
            'filters'    => array('StringTrim'),  
        ));

        	  // Add the submit button
        $this->addElement('submit', 'login', array(
            'ignore'   => true,
            'label'    => 'login',
        ));

        // We want to display a 'failed authentication' message if necessary;
        // we'll do that with the form 'description', so we need to add that
        // decorator.
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'dl', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend')),
            'Form'
        ));
   }
}