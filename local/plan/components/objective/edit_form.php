<?php
/**
 * The form for editing a plan's objective
 *
 * @copyright Catalyst IT Limited
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage plan
 */

require_once("{$CFG->libdir}/formslib.php");

class plan_objective_edit_form extends moodleform {

    /**
     * Requires the following $_customdata to be passed in to the constructor:
     * planid, objectiveid (optional), duedatemode, prioritymode, prioritylist
     *
     * @global object $CFG
     * @global object $USER
     */
    function definition() {
        global $CFG, $USER;

        $mform =& $this->_form;

        // Add some hidden fields
        if (isset($this->_customdata['objectiveid'])) {
            $mform->addElement('hidden', 'objectiveid', $this->_customdata['objectiveid']);
            $mform->setType('objectiveid', PARAM_INT);
        }
        $mform->addElement('hidden', 'userid', $USER->id);
        $mform->setType('userid', PARAM_INT);
        $mform->addElement('hidden', 'planid', $this->_customdata['planid']);
        $mform->setType('planid', PARAM_INT);

        $mform->addElement('text', 'fullname', get_string('objectivefullname', 'local_plan'));
        $mform->setType('fullname', PARAM_TEXT);
        $mform->addRule('fullname', get_string('err_required', 'form'), 'required', '', 'client', false, false);
        $mform->addElement('text', 'shortname', get_string('objectiveshortname', 'local_plan'));
        $mform->setType('shortname', PARAM_TEXT);
        $mform->addElement('textarea', 'description', get_string('objectivedescription', 'local_plan'), array('rows'=>5, 'cols'=>50));
        $mform->setType('description', PARAM_TEXT);

        // Due dates
        if ( $this->_customdata['duedatemode'] == DP_DUEDATES_OPTIONAL || $this->_customdata['duedatemode'] == DP_DUEDATES_REQUIRED ){
            $mform->addElement('date_selector', 'duedate', get_string('duedate', 'local_plan'));
            if ( $this->_customdata['duedatemode'] == DP_DUEDATES_REQUIRED ){
                $mform->addRule('duedate', get_string('err_required', 'form'), 'required', '', 'client', false, false);
            }
        }

        // Priorities
        if ( $this->_customdata['prioritymode'] == DP_PRIORITY_OPTIONAL || $this->_customdata['prioritymode'] == DP_PRIORITY_REQUIRED ){
            $mform->addElement('select', 'priority', get_string('priority', 'local_plan'), $this->_customdata['prioritylist']);
            if ( $this->_customdata['prioritymode'] == DP_PRIORITY_REQUIRED ){
                $mform->addRule('priority', get_string('err_required', 'form'), 'required', '', 'client', false, false);
            }
        }

        $this->add_action_buttons();
    }

    function validation($data) {
        $errors = array();

        return $errors;
    }
}
