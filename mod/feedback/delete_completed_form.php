<?php // $Id: delete_completed_form.php,v 1.1.2.1 2008/05/15 10:33:06 agrabs Exp $
/**
* prints the form to confirm delete a completed
*
* @version $Id: delete_completed_form.php,v 1.1.2.1 2008/05/15 10:33:06 agrabs Exp $
* @author Andreas Grabs
* @license http://www.gnu.org/copyleft/gpl.html GNU Public License
* @package feedback
*/

require_once $CFG->libdir.'/formslib.php';

class mod_feedback_delete_completed_form extends moodleform {
    function definition() {
        $mform =& $this->_form;

        //headline
        //$mform->addElement('header', 'general', '');
        
        // hidden elements
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'completedid');
        $mform->addElement('hidden', 'do_show');
        $mform->addElement('hidden', 'confirmdelete');

        //-------------------------------------------------------------------------------
        // buttons
        $this->add_action_buttons(true, get_string('yes'));

    }
}
?>
