<?php

require(dirname(__FILE__).'/../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once(dirname(__FILE__).'/cronsettings_form.php');

$PAGE->requires->yui2_lib('dom-event');
$PAGE->requires->yui2_lib('connection');
$PAGE->requires->yui2_lib('json');
$PAGE->requires->js('/admin/cronsettings.js');

require_login();

admin_externalpage_setup('cron_settings');

$context = get_context_instance(CONTEXT_SYSTEM);

require_capability('moodle/site:config', $context, $USER->id, true, "nopermissions");


/// Print the header stuff

echo $OUTPUT->header();

$cronsettings = new cronsettings_form();
$fromform = $cronsettings->get_data();

if (!empty($fromform)) {

    //Save settings
    $result = set_config('cron_max_time',
               isset($fromform->cron_max_time) ? $fromform->cron_max_time : 0);
    $result = set_config('cron_max_time_mail_notify',
               isset($fromform->cron_max_time_mail_notify) ? $fromform->cron_max_time_mail_notify : 0) && $result;
    $result = set_config('cron_max_time_kill',
               isset($fromform->cron_max_time_kill) ? $fromform->cron_max_time_kill : 0) && $result;

    //display confirmation
    if ($result) {
        echo $OUTPUT->notification(get_string('changessaved'), 'notifysuccess');
    } else {
        echo $OUTPUT->notification(get_string('errorwithsettings'));
    }

}

if (!$cronsettings->is_submitted()) {
    $data = array();
    $data['cron_max_time'] = isset($CFG->cron_max_time) ? $CFG->cron_max_time : 0;
    $data['cron_max_time_mail_notify'] = isset($CFG->cron_max_time_mail_notify) ? $CFG->cron_max_time_mail_notify : 0;
    $data['cron_max_time_kill'] = isset($CFG->cron_max_time_kill) ? $CFG->cron_max_time_kill : 0;
    $cronsettings->set_data($data);
}


/// Print the appropriate form
echo $OUTPUT->heading(get_string('cron_settings', 'admin'));

$cronsettings->display();

echo $OUTPUT->footer();
