<?php
$string['coursecount'] = 'Number of site courses';
$string['displayerrorsset'] = 'This site is configured to display errors occurrences. <br />This setting is not recommended on production sites. <br />Uncheck <em>Display debug messages</em> in the <a href=\"$a->link\">Server/Debugging</a> section of the site admin settings block.';
$string['displayerrorswarning'] = 'Enabling the PHP setting <em>display_errors</em> is not recommended on production sites. <br />This setting can be changed in your php settings.';
$string['moodlerelease'] = 'Moodle release identifier';
$string['orgname'] = 'Organisation name';
$string['orgnamehelp'] = 'The name of your organisation.';
$string['passwordreuselimit'] = 'Password rotation limit';
$string['phpversion'] = 'PHP version';
$string['registrationinformation'] = 'Registration information to be sent';
$string['registrationdisabled'] = 'Disabled';
$string['registrationenabled'] = 'Enabled';
$string['registrationisdisabled'] = 'Registration is disabled.  Configuring your site to register basic information with Totara is recommended to assist in troubleshooting any future issues you may have.<br />
You can enable registration from the <a href=\"$a\">registration configuration page</a>';
$string['registrationisenabled'] = 'Registration is enabled.';
$string['registrationoutofdate'] = 'Registration information has not been updated for an extended period of time. Registration information should be kept up-to-date to assist possible future troubleshooting. Ensure that your webserver has unrestricted access to make https requests to register.totaralms.com';
$string['save'] = 'Save';
$string['sitefullname'] = 'Site Fullname';
$string['sitehasntregistered'] = 'This site has not yet successfully registered with Totara. Registering basic information with Totara is recommended to assist in troubleshooting any future issues you may have.  Ensure your webserver is able to make https requests to register.totaralms.com and that the Moodle cron is enabled. You can run the cron manually by <a href=\"$a\">clicking here</a>';
$string['siteidentifier'] = 'Site Identifier';
$string['siteshortname'] = 'Site Shortname';
$string['techsupportemail'] = 'Tech support email';
$string['techsupportemailhelp'] = 'Email address of persons handling most technical issues related to site hosting';
$string['techsupportphone'] = 'Tech support phone number';
$string['techsupportphonehelp'] = 'Phone number of persons handling most technical issues related to site hosting. (Include country code)';
$string['totarabuild'] = 'Totara build number';
$string['totararegistration'] = 'Totara Registration';
$string['totararegistrationinfo'] = '<p>This page configures registration updates which are sent to totaralms.com.
These updates allow Totara to know what versions of Totaralms and support software you are running.
This information will allow Totara to better examine and resolve any support issues you face in the future.</p>
<p>This information will be securely transmitted and held in confidence.</p>';
$string['checksum'] = 'Checksum';
$string['dbtype'] = 'Database type';
$string['totararelease'] = 'Totara release identifier';
$string['totaraversion'] = 'Totara version number';
$string['usercount'] = 'Number of site users';
$string['webserversoftware'] = 'Web server software identifier';
$string['wwwroot'] = 'Site www root';
$string['configpasswordreuselimit'] = 'Number of times a user must change their password before they are allowed to reuse a password';

$string['cron_settings'] = 'Cron';
$string['cron_max_time'] = 'Maximum execution time';
$string['cron_max_time_info'] = 'Specifies maximum execution time allowed for cron expressed in hours. Default is 0 which means no time limit.';
$string['cron_max_time_mail_notify'] = 'Notify Admin';
$string['cron_max_time_mail_notify_info'] = 'If checked system will notify the administrator by sending an email should the cron ever execute over maximum set time. For this to work you must setup cron watcher.';
$string['cron_execution_status'] = 'Status';
$string['cron_terminate'] = 'Terminate';
$string['cron_execute'] = 'Execute';
$string['cron_refresh'] = 'Refresh status';
$string['cron_execution_watch'] = 'Cron Execution';
$string['cron_execution_running'] = 'Cron is running';
$string['cron_execution_stopped'] = 'Cron is stopped';
$string['cron_execution_crashed'] = 'Cron crashed';
$string['cron_max_time_kill'] = 'Terminate cron automatically';
$string['cron_max_time_kill_info'] = 'If checked watching process will terminate cron if it is overdue in configured execution. For this to work you must setup cron watcher.';
$string['cron_max_time_mail_notify_title'] = 'Warning: Cron execution overdue!';
$string['cron_max_time_mail_notify_msg'] = 'The cron execution is taking more time than specified! Please check your server settings.';
$string['cron_kill_mail_notify_title'] = 'Warning: Cron execution was automatically terminated!';
$string['cron_kill_mail_notify_msg'] = 'The cron execution took longer than maximum execution time and was terminated! Please check your server settings.';
$string['cron_kill_mail_fail_notify_title'] = 'Warning: Cron execution failed to be automatically terminated!';
$string['cron_kill_mail_fail_notify_msg'] = 'The cron execution took longer than maximum execution time and automatic termination failed! Please check your server settings.';
$string['cron_watcher_info'] = 'Cron Watcher';
$string['cron_status_info'] = 'Cron Execution Status';

?>
