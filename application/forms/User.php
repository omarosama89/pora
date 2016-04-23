<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

         // Set the method for the display form to POST
         $this->setMethod('post');

		$id = new Zend_Form_Element_Hidden("id");
//--------------------------------------------------------------------
        // Add an username element
        $this->addElement('text', 'uname', array(
            'label'      => ' user name :',
            'class'      => 'form-control',
            'required'   => true,
            'filters'    => array('StringTrim'),
        ));
//---------------------------------------------------------------------
 		// Add an email element
        $this->addElement('text', 'email', array(
            'label'      => ' email address:',
            'required'   => true,
            'class'      => 'form-control',
            'filters'    => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            )
        ));
//------------------------------------------------------------------------
        //add password element
        $this->addElement('password', 'pwd', array(
            'label'      => 'password:',
            'class'      => 'form-control',
            'required'   => true,
            'size'       => 20,
            'filters'    => array('StringTrim'),  
        ));
 //--------------------------------------------------------------------------
        //add fName element
        $this->addElement('text', 'fname', array(
            'label'      => ' first name :',
            'class'      => 'form-control',
            'required'   => true,
            'filters'    => array('StringTrim'),
        ));       
//---------------------------------------------------------------------------
         //add fName element
        $this->addElement('text', 'lname', array(
            'label'      => ' last name :',
            'class'      => 'form-control',
            'required'   => true,
            'filters'    => array('StringTrim'),
        ));       
//---------------------------------------------------------------------------
        //add country element
         $this->addElement('text', 'country', array(
            'label'      => ' country :',
            'class'      => 'form-control',
            'required'   => true,
            'filters'    => array('StringTrim'),
        ));
//------------------------------------------------------------------------------
      // add upload photo element
      /*  $element = new Zend_Form_Element_File('img');
        $element->setLabel('Upload an image:')
                ->setDestination("upload/user-images");
        // ensure only 1 file
		$element->addValidator('Count', false, 1);
		// limit to 100K
		$element->addValidator('Size', false, 10240000);
		// only JPEG, PNG, and GIFs
		$element->addValidator('Extension', false, 'jpg,png,gif');
		$this->addElement($element, 'image');
		$this->setAttrib('enctype', 'multipart/form-data');*/
//----------------------------------------------------------------------------------
		// add gender element
         $gender = new Zend_Form_Element_Radio('gender');
	     $gender->setLabel('Gender:')->addMultiOptions(array(
	        'male' => 'Male',
	        'female' => 'Female'
	      ))->setSeparator('');
	     $gender->setAttrib('class','radio-inline');
          $this->addElement($gender,'gender');
//-----------------------------------------------------------------------------------          
        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Signup',
        ));


    }
}