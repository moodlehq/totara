<?php // $Id$

/*
 * local/reportbuilder/group_forms.php
 *
 * Formslib template for creating activity groups
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package Totara
 */

require_once($CFG->libdir . '/formslib.php');

class report_builder_new_group_form extends moodleform {

    function definition() {
        global $CFG;
        $mform =& $this->_form;

        // get all feedback activities
        $sql = "SELECT f.id, f.name, c.fullname
            FROM {$CFG->prefix}feedback f
            LEFT JOIN {$CFG->prefix}course c ON c.id=f.course
            ORDER BY c.fullname, f.name";
        $activities = get_records_sql($sql);
        if(!$activities) {
            $activities = array();
        }

        // group activities by course
        $grouped_activities = array();
        foreach($activities as $activity) {
            $course = ($activity->fullname === null) ?
                get_string('notset', 'local') : $activity->fullname;
            $grouped_activities[$course][$activity->id] = $activity->name;
        }

        $mform->addElement('header', 'general', get_string('newgroup', 'local'));

        // get all official tags
        $tags = get_records_menu('tag', 'tagtype', 'official', 'id', 'id,name');
        if(!$tags) {
            $mform->addElement('html', '<p>' . get_string('notags', 'local') .
                '</p>');
            return;
        }

        $mform->addElement('text', 'name', get_string('groupname', 'local'),
            'maxlength="255"');
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required');
        $mform->setHelpButton('name', array('reportbuildergroupname',
            get_string('groupname', 'local'), 'moodle'));

        $mform->addElement('select', 'assignvalue', get_string('grouptag',
            'local'), $tags);
        // invalid if not set
        $mform->setHelpButton('assignvalue', array('reportbuildergrouptag',
            get_string('tag', 'local'), 'moodle'));

        // code to limit width of pulldown but expand when viewed
        // required for IE compatibility
        $attributes = array(
            'class' => 'totara-limited-width',
            'onMouseDown' =>
                "if(document.all) this.className='totara-expanded-width';",
            'onBlur'=>"if(document.all) this.className='totara-limited-width';",
            'onChange'=>"if(document.all) this.className='totara-limited-width';"
        );
        // create a pulldown with activities grouped by course
        $baseselect =& $mform->addElement('selectgroups', 'baseitem',
            get_string('basedon', 'local'), $grouped_activities, $attributes);
        $mform->setHelpButton('baseitem', array('reportbuilderbaseitem',
            get_string('baseitem', 'local'), 'moodle'));

        // other assignment types (like manual) may be added later
        $mform->addElement('hidden', 'assigntype', 'tag');
        // other group types may be added later
        $mform->addElement('hidden', 'preproc', 'feedback_questions');

        $this->add_action_buttons();
    }
}

