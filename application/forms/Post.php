<?php

class Form_MyForm extends Zend_Form {
      public function init() {
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('File to Upload:')->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Upload File');
        $this->assignElements(array($file, $submit));
      }
    }

?>