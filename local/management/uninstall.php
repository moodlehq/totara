<?php

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

execute_sql("DROP TABLE IF EXISTS {$CFG->prefix}manager");

execute_sql("DELETE FROM {$CFG->prefix}config WHERE name IN ('local_management_version','local_management_cron','local_management_lastcron')");