<?php // $Id$

    $ADMIN->add('reports', new admin_category('reportbuilder', get_string('reportbuilder','local')));
// add links to report builder reports
   $ADMIN->add('reportbuilder', new admin_externalpage('managereports', get_string('managereports','local'), "$CFG->wwwroot/local/reportbuilder/index.php"));
   $ADMIN->add('reportbuilder', new admin_externalpage('activitygroups', get_string('activitygroups','local'), "$CFG->wwwroot/local/reportbuilder/groups.php"));
   $ADMIN->add('reports', new admin_externalpage('reportheading', get_string('reportheading','local'), "$CFG->wwwroot/local/reportheading/index.php"));


?>
