<?php

$settings->add(new admin_setting_configtext('block_totara_stats_minutesbetweensession', get_string('minutesbetweensession', 'block_totara_stats'),
                   get_string('minutesbetweensessiondesc', 'block_totara_stats'), 30, PARAM_INT));
$settings->add(new admin_setting_configtime('block_totara_stats_sche_hour', 'block_totara_stats_sche_minute', get_string('executeat'),
                                             get_string('executeathelp', 'block_totara_stats'), array('h' => 0, 'm' => 0)));