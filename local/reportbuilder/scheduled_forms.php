<?php

/**
 * Moodle Formslib templates for scheduled reports settings forms
 *
 * @copyright Catalyst IT Limited
 * @author Alastair Munro
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once "$CFG->dirroot/lib/formslib.php";
require_once "$CFG->dirroot/calendar/lib.php";

/**
 * Formslib template for the new report form
 */
class scheduled_reports_new_form extends moodleform {
    function definition() {
        global $REPORT_BUILDER_EXPORT_OPTIONS, $REPORT_BUILDER_SCHEDULE_OPTIONS, $CALENDARDAYS, $USER;

        $REPORT_BUILDER_SCHEDULE_CODES = array_flip($REPORT_BUILDER_SCHEDULE_OPTIONS);

        $mform =& $this->_form;
        $id = $this->_customdata['id'];
        $frequency = $this->_customdata['frequency'];
        $schedule = $this->_customdata['schedule'];
        $reportid = $this->_customdata['reportid'];

        $reportname = get_field('report_builder', 'fullname', 'id', $reportid);

        $mform->addElement('hidden', 'id', $id);
        $mform->addElement('hidden', 'reportid', $reportid);

        $savedsearchselect = array();
        $savedsearchselect[0] = get_string('alldata', 'local_reportbuilder');
        if($savedsearches = get_records_select('report_builder_saved', 'reportid='.$reportid.' AND userid='.$USER->id)) {
            foreach($savedsearches as $search) {
                $savedsearchselect[$search->id] = $search->name;
            }
        }

        $exportoptions = get_config('reportbuilder', 'exportoptions');

        //Export type options
        $exportformatselect = array();
        foreach($REPORT_BUILDER_EXPORT_OPTIONS as $option => $code) {
            // bitwise operator to see if option bit is set
            if(($exportoptions & $code) == $code && ($option != 'fusion')) {
                $exportformatselect[$code] = get_string('export'.$option,'local_reportbuilder');
            }
        }

        //Report type options
        $reports = get_reports(true);
        $reportselect = array();
        foreach($reports as $report){
            $reportselect[$report->id] = $report->fullname;
        }

        //Schedule type options
        $frequencyselect = array();
        foreach($REPORT_BUILDER_SCHEDULE_OPTIONS as $option => $code) {
            $frequencyselect[$code] = get_string('schedule'.$option, 'local_reportbuilder');
        }

        //Daily selector
        $dailyselect = array();
        for($i=0; $i<24; $i++){
            $dailyselect[$i] = date('H:i', mktime($i,0,0));
        }

        //Weekly selector
        $weeklyselect = array();
        for($i=0; $i<7; $i++){
            $weeklyselect[$i] = get_string($CALENDARDAYS[$i], 'calendar');
        }

        $monthlyselect = array();
        for($i=1; $i<=31; $i++){
            $monthlyselect[$i] = date('jS', mktime(0,0,0,0,$i));
        }


        $mform->addElement('header', 'general', get_string('scheduledreportsettings', 'local_reportbuilder'));

        $mform->addElement('static', 'report', get_string('report', 'local_reportbuilder'), $reportname);
        $mform->addElement('select','savedsearchid', 'Data', $savedsearchselect);
        $mform->addElement('select','format', get_string('export','local_reportbuilder'), $exportformatselect);

        $schedulegroup = array();
        $schedulegroup[] =& $mform->createElement('select','frequency', get_string('schedule', 'local_reportbuilder'), $frequencyselect);
        $schedulegroup[] =& $mform->createElement('select','daily', null, $dailyselect);
        $schedulegroup[] =& $mform->createElement('select','weekly', null, $weeklyselect);
        $schedulegroup[] =& $mform->createElement('select','monthly', null, $monthlyselect);

        $mform->addGroup($schedulegroup, 'schedulegroup', get_string('schedule', 'local_reportbuilder'), '', false);
        $mform->disabledIf('daily', 'frequency', 'neq', $REPORT_BUILDER_SCHEDULE_OPTIONS['daily']);
        $mform->disabledIf('weekly', 'frequency', 'neq', $REPORT_BUILDER_SCHEDULE_OPTIONS['weekly']);
        $mform->disabledIf('monthly', 'frequency', 'neq', $REPORT_BUILDER_SCHEDULE_OPTIONS['monthly']);

        if($frequency){
            switch($REPORT_BUILDER_SCHEDULE_CODES[$frequency]){
            case 'daily':
                $mform->setDefault('daily', $schedule);
                break;
            case 'weekly':
                $mform->setDefault('weekly', $schedule);
                break;
            case'monthly':
                $mform->setDefault('monthly', $schedule);
                break;
            }
        }

        $this->add_action_buttons();
    }
}


class scheduled_reports_add_form extends moodleform {
    function definition() {

        $mform =& $this->_form;

        //Report type options
        $reports = get_reports(true);
        $reportselect = array();
        foreach($reports as $report){
            $reportselect[$report->id] = $report->fullname;
        }

        $mform->addElement('select','reportid', null, $reportselect);
        $mform->addElement('submit', 'submitbutton', get_string('addscheduledreport', 'local_reportbuilder'));

        $renderer =& $mform->defaultRenderer();
        $elementtemplate = '<span>{element}</span>';
        $renderer->setElementTemplate($elementtemplate, 'submitbutton');
        $renderer->setElementTemplate($elementtemplate, 'reportid');
    }
}
