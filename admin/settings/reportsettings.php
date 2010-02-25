<?php // $Id$

// * Miscellaneous settings

if ($hassiteconfig) { // speedup for non-admins, add all caps used on this page

   $ADMIN->add('reportsettings', new admin_externalpage('reportbuilder', get_string('reportbuilder','local'), "$CFG->wwwroot/local/reportbuilder/index.php"));


} // end of speedup

?>
