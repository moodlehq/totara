<?php //$Id$

require_once($CFG->dirroot.'/lib/formslib.php');

class field_form extends moodleform {

    var $field;

/// Define the form
    function definition () {
        global $CFG;

        $mform =& $this->_form;
        $datasent = $this->_customdata;

        $type        = $datasent['type'];
        $subtype     = $datasent['subtype'];
        $depthid     = $datasent['depthid'];
        $tableprefix = $datasent['tableprefix'];
        $categoryid  = $datasent['categoryid'];

        require_once($CFG->dirroot.'/customfield/field/'.$datasent['datatype'].'/define.class.php');
        $newfield = 'customfield_define_'.$datasent['datatype'];
        $this->field = new $newfield();

        $strrequired = get_string('required');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'action', 'editfield');
        $mform->addElement('hidden', 'datatype', $datasent['datatype']);
        $mform->addElement('hidden', 'type', $datasent['type']);
        $mform->addElement('hidden', 'subtype', $datasent['subtype']);
        $mform->addElement('hidden', 'frameworkid', $datasent['frameworkid']);
        $mform->addElement('hidden', 'depthid', $datasent['depthid']);
        $mform->addElement('hidden', 'tableprefix', $datasent['tableprefix']);

        $this->field->define_form($mform, $depthid, $tableprefix, $categoryid);

        $this->add_action_buttons(true);
    }


/// alter definition based on existing or submitted data
    function definition_after_data () {
        $mform =& $this->_form;
        $this->field->define_after_data($mform);
    }


/// perform some moodle validation
    function validation($data, $files) {
        return $this->field->define_validate($data, $files, $data['depthid'], $data['tableprefix']);
    }
}

?>
