<?php //$Id$

require_once($CFG->dirroot.'/lib/formslib.php');

class category_form extends moodleform {

    // Define the form
    function definition () {
        global $CFG;

        $mform =& $this->_form;
        $datasent = $this->_customdata;

        $strrequired = get_string('required');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'action', 'editcategory');
        $mform->addElement('hidden', 'depthid', $datasent['depthid']);

        $mform->addElement('text', 'name', get_string('categorynamemustbeunique', 'customfields'), 'maxlength="255" size="30"');
        $mform->setType('name', PARAM_MULTILANG);
        $mform->addRule('name', $strrequired, 'required', null, 'client');

        $this->add_action_buttons(true);

    } /// End of function

/// perform some moodle validation,
/// NOTEL tableprefix is needed - not sure yet how it should be passed to the function!

    function validation($data, $files, $tableprefix) {
        global $CFG;
        $errors = parent::validation($data, $files);

        $data  = (object)$data;

        $category = get_record($tableprefix.'_info_category', 'id', $data->id);

        /// Check the name is unique
        if ($category and ($category->name !== $data->name) and (record_exists($tableprefix.'_info_category', 'name', $data->name))) {
            $errors['name'] = get_string('categorynamenotunique', 'customfields');
        }

        return $errors;
    }
}

?>
