<?php // $Id$

    // add link to report heading block
    $ADMIN->add('reports', new admin_externalpage('reportheading', get_string('reportheading','local'), "$CFG->wwwroot/local/reportheading/index.php"));

?>
