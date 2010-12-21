<?php

/*
    collect information to be sent to register.totaralms.com
    and return it as an associative array
*/
function get_registration_data() {
    global $CFG, $SITE;
    include($CFG->dirroot . '/version.php');
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
    $data['webserversoftware'] = $_SERVER['SERVER_SOFTWARE'];
    return $data;
}

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
?>
