<?php

class Application_Form_AddRequest extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $this->setMethod('post');

       // Add the Request element
        $this->addElement('textarea', 'content', array(
            'label'      => 'Add Request:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 300))
            )
        ));

         // Add the submit button
        $this->addElement('submit', 'send', array(
            'ignore'   => true,
            'label'    => 'send',
        ));
    }
}