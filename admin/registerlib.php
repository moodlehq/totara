<?php

/**
 *  Collect information to be sent to register.totaralms.com
 *
 *  @return array Associative array of data to return
 */
function get_registration_data() {
    global $CFG, $SITE, $db;
    include($CFG->dirroot . '/version.php');
    require_once($CFG->dirroot.'/lib/environmentlib.php');
    $dbinfo = $db->ServerInfo();
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
    $data['usercount'] = count_records('user', 'deleted', '0');
    $data['coursecount'] = count_records('course');
    $oneyearago = time() - 60*60*24*365;
    // See MDL-22481 for why currentlogin is used instead of lastlogin
    $data['activeusercount'] = count_records_select('user', "currentlogin > {$oneyearago}");
    return $data;
}

/**
 * Send registration data to totaralms.com
 *
 * @param array $data Associative array of data to send
 */
function send_registration_data($data) {
    set_config('registrationattempted', time());
    $ch = curl_init('https://register.totaralms.com/register/report.php');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
    $recdata = curl_exec($ch);
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
