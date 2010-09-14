<?php 
require_once ($CFG->dirroot.'/course/moodleform_mod.php');
class editcategory_form extends moodleform {

    // form definition
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $category = $this->_customdata;

        // get list of categories to use as parents, with site as the first one
        $options = array(get_string('top'));
        $parents = array();
        if ($category->id) {
            // Editing an existing category.
            make_categories_list($options, $parents, 'moodle/category:manage', $category->id);
            $strsubmit = get_string('savechanges');
        } else {
            // Making a new category
            make_categories_list($options, $parents, 'moodle/category:manage');
            $strsubmit = get_string('createcategory');
        }

        $mform->addElement('select', 'parent', get_string('parentcategory'), $options);
        $mform->addElement('text', 'name', get_string('categoryname'), array('size'=>'30'));
        $mform->addRule('name', get_string('required'), 'required', null);
        $mform->addElement('htmleditor', 'description', get_string('description'));
        $mform->setType('description', PARAM_RAW);
        if (!empty($CFG->allowcategorythemes)) {
            $themes=array();
            $themes[''] = get_string('forceno');
            $themes += get_list_of_themes();
            $mform->addElement('select', 'theme', get_string('forcetheme'), $themes);
        }
        $mform->setHelpButton('description', array('writing', 'richtext'), false, 'editorhelpbutton');

        $this->set_upload_manager(new upload_manager('uploadicon', true, false, null, false, 0, true, true, false));
        $mform->addElement('static', 'currenticon', get_string('currenticon', 'local'), local_coursecategory_icon_tag($category));
        $mform->addElement('select', 'icon', get_string('icon', 'local'), local_get_stock_icons('coursecategory'));

        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $category->id);

        $this->add_action_buttons(true, $strsubmit);
    }
} 
?>
