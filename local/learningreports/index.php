<?php // $Id$

    require_once('../../config.php');
    require_once($CFG->libdir.'/adminlib.php');

    admin_externalpage_setup('learningreports');
    admin_externalpage_print_header();

   print "My admin page"; 

    admin_externalpage_print_footer();


?>
