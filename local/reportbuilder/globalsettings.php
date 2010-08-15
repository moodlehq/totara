<?php // $Id$
require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
require_once($CFG->dirroot.'/local/reportbuilder/report_forms.php');

global $USER;
$notice = optional_param('notice', 0, PARAM_INT); // notice flag

admin_externalpage_setup('globalreportsettings');

$returnurl = $CFG->wwwroot."/local/reportbuilder/globalsettings.php";

// form definition
$mform =& new report_builder_global_settings_form();

// form results check
if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if ($fromform = $mform->get_data()) {

    if(empty($fromform->submitbutton)) {
        redirect($returnurl . '?notice=' .
            REPORT_BUILDER_UNKNOWN_BUTTON_CLICKED);
    }

    if(update_global_settings($fromform)) {
        redirect($returnurl . '?notice=' .
            REPORT_BUILDER_GLOBAL_CONFIRM_UPDATE);
    } else {
        redirect($returnurl . '?notice=' .
            REPORT_BUILDER_GLOBAL_FAILED_UPDATE);
    }
}

admin_externalpage_print_header();

print "<table id=\"reportbuilder-navbuttons\"><tr><td>";
print_single_button($CFG->wwwroot.'/local/reportbuilder/index.php', null, get_string('allreports','local'));
print "</td></tr></table>";

print_heading(get_string('reportbuilderglobalsettings','local'));

if($notice) {
    switch($notice) {
    case REPORT_BUILDER_UNKNOWN_BUTTON_CLICKED:
        notify(get_string('error:unknownbuttonclicked','local'));
        break;
    case REPORT_BUILDER_GLOBAL_CONFIRM_UPDATE:
        notify(get_string('globalsettingsupdated', 'local'), 'notifysuccess');
        break;
    case REPORT_BUILDER_GLOBAL_FAILED_UPDATE:
        notify(get_string('error:couldnotupdateglobalsettings','local'));
        break;
    }
}

// display the form
$mform->display();

admin_externalpage_print_footer();

/**
 * Update global report builder settings
 *
 * @param object $fromform Moodle form object containing global setting changes to apply
 *
 * @return boolean True if settings could be successfully updated
 */
function update_global_settings($fromform) {
    global $REPORT_BUILDER_EXPORT_OPTIONS;

    $exportoptions = 0;
    foreach($REPORT_BUILDER_EXPORT_OPTIONS as $option => $code) {
        $checkboxname = 'export' . $option;
        if(isset($fromform->$checkboxname) && $fromform->$checkboxname == 1) {
            $exportoptions += $code;
        }
    }
    return set_config('exportoptions', $exportoptions, 'reportbuilder');
}
?>
