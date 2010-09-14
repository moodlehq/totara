<?php  //$Id$

class customfield_define_base {

    /**
     * Prints out the form snippet for creating or editing a custom field
     * @param   object   instance of the moodleform class
     */
    function define_form(&$form, $depthid=0, $tableprefix, $categoryid=0) {
        $form->addElement('header', '_commonsettings', get_string('commonsettings', 'customfields'));
        $this->define_form_common($form, $depthid, $tableprefix, $categoryid);

        $form->addElement('header', '_specificsettings', get_string('specificsettings', 'customfields'));
        $this->define_form_specific($form);
    }

    /**
     * Prints out the form snippet for the part of creating or
     * editing a custom field common to all data types
     * @param   object   instance of the moodleform class
     */
    function define_form_common(&$form, $depthid=0, $tableprefix, $categoryid) {

        $strrequired = get_string('required');

        $form->addElement('text', 'shortname', get_string('shortname', 'customfields'), 'maxlength="100" size="25"');
        $form->addRule('shortname', $strrequired, 'required', null, 'client');
        $form->setType('shortname', PARAM_ALPHANUM);
        $form->setHelpButton('shortname', array('customfieldshortname', get_string('shortname', 'customfields')), true);

        $form->addElement('text', 'fullname', get_string('fullname'), 'size="50"');
        $form->addRule('fullname', $strrequired, 'required', null, 'client');
        $form->setType('fullname', PARAM_MULTILANG);
        $form->setHelpButton('fullname', array('customfieldfullname', get_string('fullname')), true);

        $form->addElement('htmleditor', 'description', get_string('description', 'customfields'));
        $form->setHelpButton('description', array('text', get_string('helptext')));

        $form->addElement('selectyesno', 'required', get_string('required', 'customfields'));
        $form->setHelpButton('required', array('customfieldrequired', get_string('required','customfields')), true);

        $form->addElement('selectyesno', 'locked', get_string('locked', 'customfields'));
        $form->setHelpButton('locked', array('customfieldlocked', get_string('locked','customfields')), true);

        $form->addElement('selectyesno', 'forceunique', get_string('forceunique', 'customfields'));
        $form->setHelpButton('forceunique', array('customfieldforceunique', get_string('forceunique','customfields')), true);

        $form->addElement('selectyesno', 'hidden', get_string('visible', 'customfields'));
        $form->setHelpButton('hidden', array('customfieldhidden', get_string('visible','customfields')), true);

        $choices = customfield_list_categories($depthid, $tableprefix);
        $form->addElement('select', 'categoryid', get_string('category', 'customfields'), $choices);
        $form->setHelpButton('categoryid', array('customfieldcategory', get_string('category','customfields')), true);
        if($categoryid) {
            $form->setDefault('categoryid', $categoryid);
        }
    }

    /**
     * Prints out the form snippet for the part of creating or
     * editing a custom field specific to the current data type
     * @param   object   instance of the moodleform class
     */
    function define_form_specific(&$form) {
        /// do nothing - overwrite if necessary
    }

    /**
     * Validate the data from the add/edit custom field form.
     * Generally this method should not be overwritten by child
     * classes.
     * @param   object   data from the add/edit custom field form
     * @return  array    associative array of error messages
     */
    function define_validate($data, $files, $depthid, $tableprefix) {

        $data = (object)$data;
        $err = array();

        $err += $this->define_validate_common($data, $files, $depthid, $tableprefix);
        $err += $this->define_validate_specific($data, $files, $tableprefix);

        return $err;
    }

    /**
     * Validate the data from the add/edit custom field form
     * that is common to all data types. Generally this method
     * should not be overwritten by child classes.
     * @param   object   data from the add/edit custom field form
     * @return  array    associative array of error messages
     */
    function define_validate_common($data, $files, $depthid, $tableprefix) {

        $err = array();

        /// Check the shortname was not truncated by cleaning
        if (empty($data->shortname)) {
            $err['shortname'] = get_string('required');

        } else {
        /// Fetch field-record from DB
            if($depthid) {
                $field = get_record($tableprefix.'_info_field', 'shortname', $data->shortname, 'depthid', $depthid);
            } else {
                $field = get_record($tableprefix.'_info_field', 'shortname', $data->shortname);
            }
        /// Check the shortname is unique
            if ($field and $field->id <> $data->id) {
                $err['shortname'] = get_string('shortnamenotunique', 'customfields');
            }
        }

        /// No further checks necessary as the form class will take care of it
        return $err;
    }

    /**
     * Validate the data from the add/edit custom field form
     * that is specific to the current data type
     * @param   object   data from the add/edit custom field form
     * @return  array    associative array of error messages
     */
    function define_validate_specific($data, $files, $tableprefix) {
        /// do nothing - overwrite if necessary
        return array();
    }

    /**
     * Alter form based on submitted or existing data
     * @param   object   form
     */
    function define_after_data(&$mform) {
        /// do nothing - overwrite if necessary
    }

    /**
     * Add a new custom field or save changes to current field
     * @param   object   data from the add/edit custom field form
     * @return  boolean  status of the insert/update record
     */
    function define_save($data, $tableprefix) {
        $data = $this->define_save_preprocess($data); /// hook for child classes

        $old = false;
        if (!empty($data->id)) {
            $old = get_record($tableprefix.'_info_field', 'id', $data->id);
        }

        /// check to see if the category has changed
        if (!$old or $old->categoryid != $data->categoryid) {
            $data->sortorder = count_records_select($tableprefix.'_info_field', 'categoryid='.$data->categoryid) + 1;
        } else {
            $data->sortorder = $old->sortorder;
        }


        if (empty($data->id)) {
            unset($data->id);
            if (!$data->id = insert_record($tableprefix.'_info_field', $data)) {
                error('Error creating new field');
            }
        } else {
            if (!update_record($tableprefix.'_info_field', $data)) {
                error('Error updating field');
            }
        }
    }

    /**
     * Preprocess data from the add/edit custom field form
     * before it is saved. This method is a hook for the child
     * classes to overwrite.
     * @param   object   data from the add/edit custom field form
     * @return  object   processed data object
     */
    function define_save_preprocess($data) {
        /// do nothing - overwrite if necessary
        return $data;
    }

}
