<?php // $Id: mod_form.php,v 1.3.2.3 2008/05/03 21:23:54 agrabs Exp $
/**
* print the form to add or edit a feedback-instance
*
* @version $Id: mod_form.php,v 1.3.2.3 2008/05/03 21:23:54 agrabs Exp $
* @author Andreas Grabs
* @license http://www.gnu.org/copyleft/gpl.html GNU Public License
* @package feedback
*/

require_once ($CFG->dirroot.'/course/moodleform_mod.php');

class mod_feedback_mod_form extends moodleform_mod {

    function definition() {
        global $COURSE, $CFG; 

        $mform    =& $this->_form;

        //-------------------------------------------------------------------------------
        $mform->addElement('header', 'general', get_string('general', 'form'));
        
        $mform->addElement('text', 'name', get_string('name', 'feedback'), array('size'=>'64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEAN);
        }
        $mform->addRule('name', null, 'required', null, 'client');

        $mform->addElement('htmleditor', 'summary', get_string("description", "feedback"), array('rows' => 20));
        $mform->setType('summary', PARAM_RAW);
        $mform->addRule('summary', null, 'required', null, 'client');
        $mform->setHelpButton('summary', array('writing', 'questions', 'richtext'), false, 'editorhelpbutton');

        //-------------------------------------------------------------------------------
        $mform->addElement('header', 'timinghdr', get_string('timing', 'form'));
        
        $enableopengroup = array();
        $enableopengroup[] =& $mform->createElement('checkbox', 'openenable', get_string('feedbackopen', 'feedback'));
        $enableopengroup[] =& $mform->createElement('date_time_selector', 'timeopen', '');
        $mform->addGroup($enableopengroup, 'enableopengroup', get_string('feedbackopen', 'feedback'), ' ', false);
        $mform->setHelpButton('enableopengroup', array('timeopen', get_string('feedbackopens', 'feedback'), 'feedback'));
        $mform->disabledIf('enableopengroup', 'openenable', 'notchecked');
        
        $enableclosegroup = array();
        $enableclosegroup[] =& $mform->createElement('checkbox', 'closeenable', get_string('feedbackclose', 'feedback'));
        $enableclosegroup[] =& $mform->createElement('date_time_selector', 'timeclose', '');
        $mform->addGroup($enableclosegroup, 'enableclosegroup', get_string('feedbackclose', 'feedback'), ' ', false);
        $mform->setHelpButton('enableclosegroup', array('timeclose', get_string('feedbackcloses', 'feedback'), 'feedback'));
        $mform->disabledIf('enableclosegroup', 'closeenable', 'notchecked');
        
        //-------------------------------------------------------------------------------
        $mform->addElement('header', 'feedbackhdr', get_string('feedback_options', 'feedback'));
        
        $options=array();
        $options[1]  = get_string('anonymous', 'feedback');
        $options[2]  = get_string('non_anonymous', 'feedback');
        $mform->addElement('select', 'anonymous', get_string('anonymous_edit', 'feedback'), $options);
        
        $mform->addElement('selectyesno', 'publish_stats', get_string('publish_stats_on_students', 'feedback'));
        $mform->addElement('selectyesno', 'email_notification', get_string('email_notification', 'feedback'));
        $mform->setHelpButton('email_notification', array('emailnotification', get_string('email_notification', 'feedback'), 'feedback'));
        
        // check if there is existing responses to this feedback
        if (is_numeric($this->_instance) AND $feedback = get_record("feedback", "id", $this->_instance)) {
            $completedFeedbackCount = feedback_get_completeds_group_count($feedback);
        } else {
            $completedFeedbackCount = false;
        }
        
        if($completedFeedbackCount) {
            $multiple_submit_value = $feedback->multiple_submit ? get_string('yes') : get_string('no');
            $mform->addElement('text', 'multiple_submit_static', get_string('multiple_submit', 'feedback'), array('size'=>'4','disabled'=>'disabled', 'value'=>$multiple_submit_value));
            $mform->addElement('hidden', 'multiple_submit', '');
        }else {
            $mform->addElement('selectyesno', 'multiple_submit', get_string('multiple_submit', 'feedback'));
        }
        $mform->setHelpButton('multiple_submit', array('multiplesubmit', get_string('multiple_submit', 'feedback'), 'feedback'));
        
        //-------------------------------------------------------------------------------
        $mform->addElement('header', 'aftersubmithdr', get_string('after_submit', 'feedback'));
        
        $mform->addElement('htmleditor', 'page_after_submit', get_string("page_after_submit", "feedback"), array('rows' => 20));
        $mform->setType('page_after_submit', PARAM_RAW);
        $mform->setHelpButton('page_after_submit', array('writing', 'questions', 'richtext'), false, 'editorhelpbutton');
        //-------------------------------------------------------------------------------
        $mform->addElement('header', 'reportinghdr', get_string('reporting', 'feedback'));

        $modinfo = unserialize($COURSE->modinfo);
        foreach ($modinfo as $cm_id => $mod) {
            if ($mod->mod == 'facetoface') {
                $availablemods[$cm_id] = urldecode($mod->name);
            }
        }

        if (empty($availablemods)) {
            $noneavailable = get_string('noneavailable', 'feedback');
            $mform->addElement('text', 'facetofacecmid_static', get_string('facetofaceactivity', 'feedback'), array('size'=>'20','disabled'=>'disabled', 'value'=>$noneavailable));
            $mform->addElement('hidden', 'facetofacecmid', '0');
            $mform->setHelpButton('facetofacecmid_static', array('facetofaceactivity', get_string('facetofaceactivity', 'feedback'), 'feedback'));
        } else {
            $availablemods['0'] = get_string('none');
            ksort($availablemods);
            $mform->addElement('select', 'facetofacecmid', get_string('facetofaceactivity', 'feedback'), $availablemods);
            $mform->setDefault('facetofacecmid', '0');
            $mform->setType('facetofacecmid', PARAM_TEXT);
            $mform->setHelpButton('facetofacecmid', array('facetofaceactivity', get_string('facetofaceactivity', 'feedback'), 'feedback'));
        }
        
        //-------------------------------------------------------------------------------
        $this->standard_coursemodule_elements();
        //-------------------------------------------------------------------------------
        // buttons
        $this->add_action_buttons();
    }

    function data_preprocessing(&$default_values){
        if (empty($default_values['timeopen'])) {
            $default_values['openenable'] = 0;
        } else {
            $default_values['openenable'] = 1;
        }
        if (empty($default_values['timeclose'])) {
            $default_values['closeenable'] = 0;
        } else {
            $default_values['closeenable'] = 1;
        }

    }

    function validation($data){

    }

}
?>