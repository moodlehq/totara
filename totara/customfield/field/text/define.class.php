<?php  //$Id$

class customfield_define_text extends customfield_define_base {

    function define_form_specific(&$form) {
        /// Default data
        $form->addElement('text', 'defaultdata', get_string('defaultdata', 'customfields'), 'size="50"');
        $form->setType('defaultdata', PARAM_MULTILANG);
        $form->setHelpButton('defaultdata', array('customfielddefaultdatatext', get_string('defaultdata', 'customfields')), true);

        /// Param 1 for text type is the size of the field
        $form->addElement('text', 'param1', get_string('fieldsize', 'customfields'), 'size="6"');
        $form->setDefault('param1', 30);
        $form->setType('param1', PARAM_INT);
        $form->setHelpButton('param1', array('customfieldfieldsizetext', get_string('fieldsize', 'customfields')), true);

        /// Param 2 for text type is the maxlength of the field
        $form->addElement('text', 'param2', get_string('fieldmaxlength', 'customfields'), 'size="6"');
        $form->setDefault('param2', 2048);
        $form->setType('param2', PARAM_INT);
        $form->setHelpButton('param2', array('customfieldmaxlengthtext', get_string('fieldmaxlength', 'customfields')), true);
    }

}

?>
