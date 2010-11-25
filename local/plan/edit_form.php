<?php
/**
 * Plan related form definitions
 *
 * @copyright Catalyst IT Limited
 * @author Eugene Venter
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage plan
 */

require_once("{$CFG->libdir}/formslib.php");

class plan_edit_form extends moodleform {

    function definition() {
        global $CFG, $USER;

        $mform =& $this->_form;

        // Add some hidden fields
        if ($this->_customdata['action'] != 'add') {
            $mform->addElement('hidden', 'id');
            $mform->setType('id', PARAM_INT);
        }
        $mform->addElement('hidden', 'userid', $USER->id);
        $mform->setType('userid', PARAM_INT);
        $template = dp_get_first_template();
        $mform->addElement('hidden', 'templateid', $template->id);  //@todo: HACK! we will always use the first template for now
        $mform->setType('templateid', PARAM_INT);
        $mform->addElement('hidden', 'status', 0);
        $mform->setType('status', PARAM_INT);
        $mform->addElement('hidden', 'action', $this->_customdata['action']);
        $mform->setType('action', PARAM_TEXT);

        if ($this->_customdata['action'] == 'delete') {
            // Only show delete confirmation
            $mform->addElement('html', get_string('checkplandelete', 'local_plan', $this->_customdata['plan']->name));
            $buttonarray = array();
            $buttonarray[] = $mform->createElement('submit', 'deleteyes', get_string('yes'));
            $buttonarray[] = $mform->createElement('submit', 'deleteno', get_string('no'));
            $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
            $mform->closeHeaderBefore('buttonar');

            return;
        }
        if ($this->_customdata['action'] == 'signoff') {
            // Only show complete plan confirmation
            $mform->addElement('html', get_string('checkplancomplete', 'local_plan', $this->_customdata['plan']->name));
            $buttonarray = array();
            $buttonarray[] = $mform->createElement('submit', 'signoffyes', get_string('yes'));
            $buttonarray[] = $mform->createElement('submit', 'signoffno', get_string('no'));
            $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
            $mform->closeHeaderBefore('buttonar');

            return;
        }

        $mform->addElement('date_selector', 'startdate', get_string('datestarted', 'local_plan'));
        $mform->hardFreeze('startdate');

        $mform->addElement('text', 'name', get_string('planname', 'local_plan'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', get_string('err_required', 'form'), 'required', '', 'client', false, false);
        $mform->addElement('textarea', 'description', get_string('plandescription', 'local_plan'), array('rows'=>5, 'cols'=>50));
        $mform->setType('description', PARAM_TEXT);
        $mform->addRule('description', get_string('err_required', 'form'), 'required', '', 'client', false, false);
        $mform->addElement('date_selector', 'enddate', get_string('duedate', 'local_plan'));
        $mform->setDefault('enddate', $template->enddate);
        $mform->addRule('enddate', get_string('err_required', 'form'), 'required', '', 'client', false, false);

        if ($this->_customdata['action'] == 'view') {
            $mform->hardFreeze(array('name', 'description', 'enddate'));
            $buttonarray = array();
            if ($this->_customdata['plan']->get_setting('update') == DP_PERMISSION_ALLOW && $this->_customdata['plan']->status != DP_PLAN_STATUS_COMPLETE) {;
                $buttonarray[] = $mform->createElement('submit', 'edit', get_string('editdetails', 'local_plan'));
            }
            if ($this->_customdata['plan']->get_setting('delete') == DP_PERMISSION_ALLOW) {
                $buttonarray[] = $mform->createElement('submit', 'delete', get_string('deleteplan', 'local_plan'));
            }
            if ($this->_customdata['plan']->get_setting('signoff') == DP_PERMISSION_ALLOW && $this->_customdata['plan']->status == DP_PLAN_STATUS_APPROVED) {
                $buttonarray[] = $mform->createElement('submit', 'signoff', get_string('plancomplete', 'local_plan'));
            }

            $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
            $mform->closeHeaderBefore('buttonar');
        } else {
            $this->add_action_buttons();
        }
    }

    function validation($data) {
        $errors = array();

        return $errors;
    }
}
