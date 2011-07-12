<?php
require_once(dirname(__FILE__).'/../config.php');
require_once($CFG->libdir . '/pear/HTML/AJAX/JSON.php');
require_once(dirname(__FILE__).'/cron_procfile.php');

require_login();
$context = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/site:config', $context, $USER->id, true, "nopermissions");

echo json_encode(cron_status());