<?php

function xmldb_local_totara_task_install() {
    //global $DB;

    $result = true;

    $provider = new stdClass();
    $provider->name  = 'totara_task';
    //$DB->insert_record('message_processors20', $provider);
    insert_record('message_processors20', $provider);
    return $result;
}
