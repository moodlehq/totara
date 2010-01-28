<?php // $Id$

// * Miscellaneous settings

if ($hassiteconfig) { // speedup for non-admins, add all caps used on this page

   $ADMIN->add('reportsettings', new admin_externalpage('learningreports', get_string('learningreports','local'), "$CFG->wwwroot/local/learningreports/index.php"));


} // end of speedup

?>
