<?php

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot.'/local/reportbuilder/cron.php');
$group = optional_param('group', 0, PARAM_INT);
if(!confirm_sesskey()) {
    print_error('confirmsesskeybad','error');
}
print '<pre>';
print "Starting cron...\n";
reportbuilder_cron($group);
print "\n...cron complete.\n";
print '</pre>';
