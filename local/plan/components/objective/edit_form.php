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
     * plan, objective, objectiveid (optional), and action (view, viewnobuttons, add, edit, delete)
     *
     * @global object $CFG
     * @global object $USER
     */
    function definition() {
        global $CFG, $USER;

        $mform =& $this->_form;

        // Determine permissions from objective
        $action = $this->_customdata['action'];
        $plan = $this->_customdata['plan'];
        $objective = $this->_customdata['objective'];

        switch( $action ){
            case 'delete':
                $mform->addElement('html', get_string('deleteobjectiveareyousure', 'local_plan'));
                break;
        }

        // Get workflow permissions to decide what should go on the form
        if ($objective->get_setting('setduedate') == DP_PERMISSION_ALLOW){
            $duedatemode = $objective->get_setting('duedatemode');
        } else {
            $duedatemode = DP_DUEDATES_NONE;
        }
        if ($objective->get_setting('setpriority') == DP_PERMISSION_ALLOW){
            $prioritymode = $objective->get_setting('prioritymode');
        } else {
            $prioritymode = DP_PRIORITY_NONE;
        }

        if ($prioritymode > DP_PRIORITY_NONE) {

            $scaleid = $objective->get_setting('priorityscale');
            if ( $scaleid ){
                $priorityvalues = get_records('dp_priority_scale_value','priorityscaleid', $scaleid, 'sortorder', 'id,name,sortorder');
                $select = array();
                if ( $prioritymode == DP_PRIORITY_OPTIONAL ){
                    $select[] = get_string('none','local_plan');
                }
                foreach( $priorityvalues as $pv ){
                    $select[$pv->id] = $pv->name;
                }
                $prioritylist = $select;
            } else {
                $prioritylist = array( get_string('none', 'local_plan') );
            }
        }

        // Add some hidden fields
        if (isset($this->_customdata['objectiveid'])) {
            $mform->addElement('hidden', 'itemid', $this->_customdata['objectiveid']);
            $mform->setType('itemid', PARAM_INT);
        }
        $mform->addElement('hidden', 'userid', $USER->id);
        $mform->setType('userid', PARAM_INT);
        $mform->addElement('hidden', 'id', $plan->id);
        $mform->setType('id', PARAM_INT);

        $mform->addElement('text', 'fullname', get_string('objectivefullname', 'local_plan'));
        $mform->setType('fullname', PARAM_TEXT);
        $mform->addRule('fullname', get_string('err_required', 'form'), 'required', '', 'client', false, false);
        $mform->addElement('text', 'shortname', get_string('objectiveshortname', 'local_plan'));
        $mform->setType('shortname', PARAM_TEXT);
        $mform->addElement('textarea', 'description', get_string('objectivedescription', 'local_plan'), array('rows'=>5, 'cols'=>50));
        $mform->setType('description', PARAM_TEXT);

        // Due dates
        if ( $duedatemode == DP_DUEDATES_OPTIONAL || $duedatemode == DP_DUEDATES_REQUIRED ){
            $mform->addElement('date_selector', 'duedate', get_string('duedate', 'local_plan'));
            if ( $duedatemode == DP_DUEDATES_REQUIRED ){
                $mform->addRule('duedate', get_string('err_required', 'form'), 'required', '', 'client', false, false);
            }
        }

        // Priorities
        if ( $prioritymode == DP_PRIORITY_OPTIONAL || $prioritymode == DP_PRIORITY_REQUIRED ){
            $mform->addElement('select', 'priority', get_string('priority', 'local_plan'), $prioritylist);
            if ( $prioritymode == DP_PRIORITY_REQUIRED ){
                $mform->addRule('priority', get_string('err_required', 'form'), 'required', '', 'client', false, false);
            }
        }

        switch( $action ){
            case 'viewnobuttons':
                $mform->hardFreezeAllVisibleExcept(array());
                break;
            case 'view':
                $mform->hardFreezeAllVisibleExcept(array());
                $buttonarray = array();
                if ($this->_customdata['plan']->get_setting('update') == DP_PERMISSION_ALLOW && $this->_customdata['plan']->status != DP_PLAN_STATUS_COMPLETE) {;
                    $buttonarray[] = $mform->createElement('submit', 'edit', get_string('editdetails', 'local_plan'));
                }
                if ($this->_customdata['plan']->get_setting('delete') == DP_PERMISSION_ALLOW) {
                    $buttonarray[] = $mform->createElement('submit', 'delete', get_string('deleteobjective', 'local_plan'));
                }

                $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
                $mform->closeHeaderBefore('buttonar');
                break;
            case 'delete':
                $mform->hardFreezeAllVisibleExcept(array());
                $buttonarray = array();
                $buttonarray[] = $mform->createElement('submit', 'deleteyes', get_string('yes'));
                $buttonarray[] = $mform->createElement('submit', 'deleteno', get_string('no'));
                $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
                $mform->closeHeaderBefore('buttonarr');
                break;
            default:
                $this->add_action_buttons();
        }
    }

    function validation($data) {
        $errors = array();

        return $errors;
    }
}
