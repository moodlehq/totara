<?php

/**
 *  Collect information to be sent to register.totaralms.com
 *
 *  @return array Associative array of data to return
 */
function get_registration_data() {
    global $CFG, $SITE, $DB;
    include($CFG->dirroot . '/version.php');
    require_once($CFG->libdir . '/environmentlib.php');
    require_once($CFG->libdir . '/badgeslib.php');
    $dbinfo = $DB->get_server_info();
    $db_version = normalize_version($dbinfo['version']);

    $data['siteidentifier'] = $CFG->siteidentifier;
    $data['wwwroot'] = $CFG->wwwroot;
    $data['siteshortname'] = $SITE->shortname;
    $data['sitefullname'] = $SITE->fullname;
    $data['orgname'] = $CFG->orgname;
    $data['techsupportphone'] = $CFG->techsupportphone;
    $data['techsupportemail'] = $CFG->techsupportemail;
    $data['moodlerelease'] = $CFG->release;
    $data['totaraversion'] = $TOTARA->version;
    $data['totarabuild'] = $TOTARA->build;
    $data['totararelease'] = $TOTARA->release;
    $data['phpversion'] = phpversion();
    $data['dbtype'] = $CFG->dbfamily . ' ' . $db_version;
    $data['webserversoftware'] = $_SERVER['SERVER_SOFTWARE'];
    $data['usercount'] = $DB->count_records('user', array('deleted' => '0'));
    $data['coursecount'] = $DB->count_records_select('course', 'format <> ?', array('site'));
    $oneyearago = time() - 60*60*24*365;
    // See MDL-22481 for why currentlogin is used instead of lastlogin
    $data['activeusercount'] = $DB->count_records_select('user', "currentlogin > ?", array($oneyearago));
    $data['badgesnumber'] = $DB->count_records_select('badge', 'status <> ' . BADGE_STATUS_ARCHIVED);
    $data['issuedbadgesnumber'] = $DB->count_records('badge_issued');
    return $data;
}

/**
 * Send registration data to totaralms.com
 *
 * @param array $data Associative array of data to send
 */
function send_registration_data($data) {
    global $CFG;
    require_once($CFG->libdir . '/filelib.php');

    set_config('registrationattempted', time());

    $ch = new curl();
    $options = array(
            'FOLLOWLOCATION' => true,
            'RETURNTRANSFER' => true, // RETURN THE CONTENTS OF THE CALL
            'HEADER' => 0 // DO NOT RETURN HTTP HEADERS
    );

    $recdata = $ch->post('https://register.totaralms.com/register/report.php', $data, $options);
    if ($recdata !== false) {
        set_config('registered', time());
    }
}

/**
 * Check if registration information should be sent, and if so send it
 *
 * To be used on the cron to manage registrations
 *
 */
function registration_cron() {
    global $CFG;
    $registrationdue = $oktotry = false;
    if (empty($CFG->registered) || $CFG->registered < (time() - 60 * 60 * 24 * 30)) {
        // Register up to once a month
        $registrationdue = true;
    }
    if (empty($CFG->registrationattempted) || $CFG->registrationattempted < (time() - 60 * 60 * 24 * 7)) {
        // Try registering once a week if unsuccessful
        $oktotry = true;
    }
    if ($registrationdue && $oktotry) {
        mtrace("Performing registration update:");
        $registerdata = get_registration_data();
        send_registration_data($registerdata);
        mtrace("Registration update done");
    }
}
?>
