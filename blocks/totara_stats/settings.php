<?php

$settings->add(new admin_setting_configtext('block_totara_stats_minutesbetweensession', get_string('minutesbetweensession', 'block_totara_stats'),
                   get_string('minutesbetweensessiondesc', 'block_totara_stats'), 30, PARAM_INT));
