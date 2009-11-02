<?php // $Id$

// This file defines settingpages and externalpages under the "organisations" category

    $ADMIN->add('organisations', new admin_externalpage('organisationframeworkmanage', get_string('organisationframeworkmanage', 'organisation'), "$CFG->wwwroot/organisation/frameworks/index.php",
            array('moodle/local:vieworganisation')));

    $ADMIN->add('organisations', new admin_externalpage('organisationmanage', get_string('organisationmanage', 'organisation'), $CFG->wwwroot . '/organisation/index.php',
            array('moodle/local:updateorganisation')));

    $ADMIN->add('organisations', new admin_externalpage('organisationaddnew', get_string('organisationaddnew', 'organisation'), $CFG->wwwroot . '/organisation/bulk.php',
            array('moodle/local:updateorganisation', 'moodle/local:deleteorganisation')));

    $ADMIN->add('organisations', new admin_externalpage('organisationupload', get_string('organisationupload', 'organisation'), "$CFG->wwwroot/$CFG->admin/organisation/upload.php",
            array('moodle/local:updateorganisation')));

    $ADMIN->add('organisations', new admin_externalpage('organisationdepthcustomfields', get_string('organisationcustomfields', 'organisation'), $CFG->wwwroot . '/organisation/depth/customfields/index.php',
            array('moodle/local:vieworganisation')));
?>
