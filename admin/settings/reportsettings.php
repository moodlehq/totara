<?php // $Id$

// * Miscellaneous settings

if ($hassiteconfig) { // speedup for non-admins, add all caps used on this page

   $ADMIN->add('reportsettings', new admin_externalpage('reportbuilder', get_string('reportbuilder','local'), "$CFG->wwwroot/local/reportbuilder/index.php"));
   $ADMIN->add('reportsettings', new admin_externalpage('activitygroups', get_string('activitygroups','local'), "$CFG->wwwroot/local/reportbuilder/groups.php"));
   $ADMIN->add('reportsettings', new admin_externalpage('reportheading', get_string('reportheading','local'), "$CFG->wwwroot/local/reportheading/index.php"));


} // end of speedup

?>
