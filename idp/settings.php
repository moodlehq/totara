<?php  //$Id$

require_once($CFG->dirroot.'/idp/lib.php');

$settings->add(new admin_setting_configtextarea('idp_submitted_text',
                                    get_string('admin:submittedtext', 'idp'),
                                    get_string('admin:submittedtextdesc', 'idp'),
                                    get_string('admin:submittedtextdefault', 'idp'),
                                    PARAM_TEXT));

$settings->add(new admin_setting_configtextarea('idp_completed_text',
                                    get_string('admin:completedtext', 'idp'),
                                    get_string('admin:completedtextdesc', 'idp'),
                                    get_string('admin:completedtextdefault', 'idp'),
                                    PARAM_TEXT));

$settings->add(new admin_setting_configtextarea('idp_traineecommented_text',
                                    get_string('admin:traineecommentedtext', 'idp'),
                                    get_string('admin:traineecommentedtextdesc', 'idp'),
                                    get_string('admin:traineecommentedtextdefault', 'idp'),
                                    PARAM_TEXT));

$settings->add(new admin_setting_configtextarea('idp_managercommented_text',
                                    get_string('admin:managercommentedtext', 'idp'),
                                    get_string('admin:managercommentedtextdesc', 'idp'),
                                    get_string('admin:managercommentedtextdefault', 'idp'),
                                    PARAM_TEXT));

$settings->add(new admin_setting_configtextarea('idp_approved_text',
                                    get_string('admin:approvedtext', 'idp'),
                                    get_string('admin:approvedtextdesc', 'idp'),
                                    get_string('admin:approvedtextdefault', 'idp'),
                                    PARAM_TEXT));

$settings->add(new admin_setting_configtextarea('idp_approvedonbehalf_text',
                                    get_string('admin:approvedonbehalftext', 'idp'),
                                    get_string('admin:approvedonbehalftextdesc', 'idp'),
                                    get_string('admin:approvedonbehalftextdefault', 'idp'),
                                    PARAM_TEXT));
?>
