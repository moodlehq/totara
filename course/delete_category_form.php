<?php

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->libdir.'/formslib.php');
require_once($CFG->libdir.'/questionlib.php');
require_once($CFG->libdir. '/coursecatlib.php');

class delete_category_form extends moodleform {

    var $_category;

    function definition() {
        $mform = & $this->_form;
        $this->_category = $this->_customdata;
        $categorycontext = context_coursecat::instance($this->_category->id);

        // Check permissions, to see if it OK to give the option to delete
        // the contents, rather than move elsewhere.
        $candeletecontent = $this->_category->can_delete_full();

        // Get the list of categories we might be able to move to.
        $displaylist = $this->_category->move_content_targets_list();

    /// Are there any courses in here, can they be deleted?
        list($test, $params) = $DB->get_in_or_equal($categoryids);
        $containedcourses = $DB->get_records_sql(
                "SELECT id,1 FROM {course} c WHERE c.category $test", $params);
        $containscourses = false;
        if ($containedcourses) {
            $containscourses = true;
            foreach ($containedcourses as $courseid => $notused) {
                if ($candeletecontent && !can_delete_course($courseid)) {
                    $candeletecontent = false;
                    break;
                }
            }
        }

    // Are there any programs in here, can they be deleted?
        list($insql, $inparams) = $DB->get_in_or_equal($categoryids);
        $containedprograms = $DB->get_records_sql(
                "SELECT id,1 FROM {prog} p WHERE p.category $insql", $inparams);
        $containsprograms = false;
        if ($containedprograms) {
            $containsprograms = true;
        }

    /// Are there any questions in the question bank here?
        $containsquestions = question_context_has_any_questions($categorycontext);

    /// Get the list of categories we might be able to move to.
        $testcaps = array();
        if ($containscourses) {
            $testcaps[] = 'moodle/course:create';
        }
        if ($containsprograms) {
            $testcaps[] = 'totara/program:createprogram';
        }
        if ($containscategories || $containsquestions) {
            $testcaps[] = 'moodle/category:manage';
        }
        $displaylist = array();
        $notused = array();
        if (!empty($testcaps)) {
            make_categories_list($displaylist, $notused, $testcaps, $category->id);
        }

        // Now build the options.
        $options = array();
        if ($displaylist) {
            $options[0] = get_string('movecontentstoanothercategory');
        }
        if ($candeletecontent) {
            $options[1] = get_string('deleteallcannotundo');
        }
        if (empty($options)) {
            print_error('youcannotdeletecategory', 'error', 'index.php', $this->_category->get_formatted_name());
        }

        // Now build the form.
        $mform->addElement('header','general', get_string('categorycurrentcontents', '', $this->_category->get_formatted_name()));

/* TODO: TOTARA CODE START
        if ($containscourses || $containscategories || $containsquestions || $containsprograms) {
            if (empty($options)) {
                print_error('youcannotdeletecategory', 'error', 'index.php', format_string($category->name, true, array('context' => $categorycontext)));
            }

        /// Describe the contents of this category.
            $contents = '<ul>';
            if ($containscategories) {
                $contents .= '<li>' . get_string('subcategories') . '</li>';
            }
            if ($containscourses) {
                $contents .= '<li>' . get_string('courses') . '</li>';
            }
            if ($containsprograms) {
                $contents .= '<li>' . get_string('programs', 'totara_coursecatalog') . '</li>';
            }
            if ($containsquestions) {
                $contents .= '<li>' . get_string('questionsinthequestionbank') . '</li>';
            }
            $contents .= '</ul>';
            $mform->addElement('static', 'emptymessage', get_string('thiscategorycontains'), $contents);

        /// Give the options for what to do.
            $mform->addElement('select', 'fulldelete', get_string('whattodo'), $options);
            if (count($options) == 1) {
                $optionkeys = array_keys($options);
                $option = reset($optionkeys);
                $mform->hardFreeze('fulldelete');
                $mform->setConstant('fulldelete', $option);
            }

            if ($displaylist) {
                $mform->addElement('select', 'newparent', get_string('movecategorycontentto'), $displaylist);
                if (in_array($category->parent, $displaylist)) {
                    $mform->setDefault('newparent', $category->parent);
                }
                $mform->disabledIf('newparent', 'fulldelete', 'eq', '1');
            }
TODO: TOTARA CODE END */
        // Describe the contents of this category.
        $contents = '';
        if ($this->_category->has_children()) {
            $contents .= '<li>' . get_string('subcategories') . '</li>';
        }
        if ($this->_category->has_courses()) {
            $contents .= '<li>' . get_string('courses') . '</li>';
        }
        if (question_context_has_any_questions($categorycontext)) {
            $contents .= '<li>' . get_string('questionsinthequestionbank') . '</li>';
        }
        if (!empty($contents)) {
            $mform->addElement('static', 'emptymessage', get_string('thiscategorycontains'), html_writer::tag('ul', $contents));
        } else {
            $mform->addElement('static', 'emptymessage', '', get_string('deletecategoryempty'));
        }

        // Give the options for what to do.
        $mform->addElement('select', 'fulldelete', get_string('whattodo'), $options);
        if (count($options) == 1) {
            $optionkeys = array_keys($options);
            $option = reset($optionkeys);
            $mform->hardFreeze('fulldelete');
            $mform->setConstant('fulldelete', $option);
        }

        if ($displaylist) {
            $mform->addElement('select', 'newparent', get_string('movecategorycontentto'), $displaylist);
            if (in_array($this->_category->parent, $displaylist)) {
                $mform->setDefault('newparent', $this->_category->parent);
            }
            $mform->disabledIf('newparent', 'fulldelete', 'eq', '1');
        }

        $mform->addElement('hidden', 'deletecat');
        $mform->setType('deletecat', PARAM_ALPHANUM);
        $mform->addElement('hidden', 'sure');
        $mform->setType('sure', PARAM_ALPHANUM);
        $mform->setDefault('sure', md5(serialize($this->_category)));

//--------------------------------------------------------------------------------
        $this->add_action_buttons(true, get_string('delete'));

        $this->set_data(array('deletecat' => $this->_category->id));
    }

/// perform some extra moodle validation
    function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (empty($data['fulldelete']) && empty($data['newparent'])) {
        /// When they have chosen the move option, they must specify a destination.
            $errors['newparent'] = get_string('required');
        }

        if ($data['sure'] != md5(serialize($this->_category))) {
            $errors['categorylabel'] = get_string('categorymodifiedcancel');
        }

        return $errors;
    }
}

