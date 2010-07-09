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
        $mform->addElement('hidden', 'type', $datasent['type']);
        $mform->addElement('hidden', 'subtype', $datasent['subtype']);
        $mform->addElement('hidden', 'frameworkid', $datasent['frameworkid']);
        $mform->addElement('hidden', 'depthid', $datasent['depthid']);
        $mform->addElement('hidden', 'categoryid', $datasent['categoryid']);
        $mform->addElement('hidden', 'tableprefix', $datasent['tableprefix']);

        $mform->addElement('text', 'name', get_string('categorynamemustbeunique', 'customfields'), 'maxlength="255" size="30"');
        $mform->setType('name', PARAM_MULTILANG);
        $mform->addRule('name', $strrequired, 'required', null, 'client');
        $mform->setHelpButton('name', array('customfieldcategoryname', get_string('categorynamemustbeunique', 'customfields')), true);

        $this->add_action_buttons(true);

    } /// End of function

    function validation($data, $files) {
        global $CFG;
        $errors = parent::validation($data, $files);

        $data  = (object)$data;

        /// Check the name is unique to the depth level
        if (record_exists($data->tableprefix.'_info_category', 'name', $data->name, 'depthid' , $data->depthid)) {
            $errors['name'] = get_string('categorynamenotunique', 'customfields');
        }

        return $errors;
    }
}

?>
