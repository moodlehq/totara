<?php

function xmldb_local_totara_alert_install() {
    //global $DB;

    $result = true;

    $provider = new stdClass();
    $provider->name  = 'totara_alert';
    //$DB->insert_record('message_processors20', $provider);
    //Avoid duplicate processors
    if (! record_exists('message_processors20', 'name', $provider->name)){
        insert_record('message_processors20', $provider);
    }
    return $result;
}
