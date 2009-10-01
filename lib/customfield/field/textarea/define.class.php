<?php  //$Id$

class customfield_define_textarea extends customfield_define_base {

    function define_form_specific(&$form) {
        /// Default data
        $form->addElement('htmleditor', 'defaultdata', get_string('defaultdata', 'customfields'));
        $form->setType('defaultdata', PARAM_CLEAN);

        /// Param 1 for textarea type is the number of columns
        $form->addElement('text', 'param1', get_string('fieldcolumns', 'customfields'), 'size="6"');
        $form->setDefault('param1', 30);
        $form->setType('param1', PARAM_INT);

        /// Param 2 for text type is the number of rows
        $form->addElement('text', 'param2', get_string('fieldrows', 'customfields'), 'size="6"');
        $form->setDefault('param2', 10);
        $form->setType('param2', PARAM_INT);
    }

}

?>
