<?php

// Ensure command-line-only execution
if (!empty($_SERVER['GATEWAY_INTERFACE'])){
    error_log("sync cron execution should not be called from apache!");
    exit;
}

define('CLI_SCRIPT', 1);

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot . '/admin/tool/totara_sync/lib.php');

echo 'Running totara_sync cron...';

tool_totara_sync_cron();

echo 'Done!'.PHP_EOL;
