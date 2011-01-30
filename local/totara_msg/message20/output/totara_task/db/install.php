<?php

function xmldb_local_totara_reminder_install() {
    //global $DB;

    $result = true;

    $provider = new stdClass();
    $provider->name  = 'totara_reminder';
    //$DB->insert_record('message_processors20', $provider);
    insert_record('message_processors20', $provider);
    return $result;
}
