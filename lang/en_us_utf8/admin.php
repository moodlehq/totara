<?PHP // $Id$ 
      // admin.php - created with Moodle 1.9.15 (Build: 20111128) (2007101591.07)


$string['backgroundcolour'] = 'Transparent color';
$string['configallowunenroll'] = 'If this is set \'Yes\', then students are allowed to unenroll themselves from courses whenever they like. Otherwise they are not allowed, and this process will be solely controlled by the teachers and administrators.';
$string['configdefaultcourseroleid'] = 'Users who enroll in a course will be automatically assigned this role.';
$string['configenrolmentplugins'] = 'Please choose the enrollment plugins you wish to use. Don\'t forget to configure the settings properly.<br /><br />You have to indicate which plugins are enabled, and <strong>one</strong> plugin can be set as the default plugin for <em>interactive</em> enrollment. To disable interactive enrollment, set \"enrollable\" to \"No\" in required courses.';
$string['confignonmetacoursesyncroleids'] = 'By default all role assignments from child courses are synchronized to metacourses. Roles that are selected here will not be included in the synchronization process.';
$string['configprofilesforenrolledusersonly'] = 'To prevent misuse by spammers, profile descriptions of users who are not yet enrolled in any course are hidden. New users must enroll in at least one course before they can add a profile description.';
$string['configsendcoursewelcomemessage'] = 'If enabled, users receive a welcome message via email when they self-enroll in a course.';
$string['configsessioncookie'] = 'This setting customizes the name of the cookie used for Totara sessions. This is optional, and only useful to avoid cookies being confused when there is more than one copy of Totara running within the same web site.';
$string['configsessioncookiedomain'] = 'This allows you to change the domain that the Totara cookies are available from. This is useful for Totara customizations (e.g. authentication or enrollment plugins) that need to share Totara session information with a web application on another subdomain. <strong>WARNING: it is strongly recommended to leave this setting at the default (empty) - an incorrect value will prevent all logins to the site.</strong>';
$string['configstatscatdepth'] = 'Statistics code uses simplified course enrollment logic, overrides are ignored and there is a maximum number of verified parent course categories. Number 0 means detect only direct role assignments on site and course level, 1 means detect also role assignments in parent category of course, etc. Higher numbers result in much higher database server load during stats processing.';
$string['datarootsecurityerror'] = '<p><strong>SECURITY WARNING!</strong></p><p>Your dataroot directory is in the wrong location and is exposed to the web. This means that all your private files are available to anyone in the world, and some of them could be used by a cracker to obtain unauthorized administrative access to your site!</p>
<p>You <em>must</em> move dataroot directory ($a) to a new location that is not within your public web directory, and update the <code>\$CFG->dataroot</code> setting in your config.php accordingly.</p>';
$string['helpweekenddays'] = 'Which days of the week are treated as \"weekend\" and shown with a different color?';
$string['nonmetacoursesyncroleids'] = 'Roles that are not synchronized to metacourses';
$string['orgname'] = 'Organization name';
$string['orgnamehelp'] = 'The name of your organization.';

?>
