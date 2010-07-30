<?php // $Id$

// This file defines settingpages and externalpages under the "organisations" category

    $ADMIN->add('organisations', new admin_externalpage('organisationframeworkmanage', get_string('organisationframeworkmanage', 'organisation'), "$CFG->wwwroot/hierarchy/framework/index.php?type=organisation",
            array('moodle/local:updateorganisationframeworks')));

    $ADMIN->add('organisations', new admin_externalpage('organisationmanage', get_string('organisationmanage', 'organisation'), $CFG->wwwroot . '/hierarchy/index.php?type=organisation',
            array('moodle/local:updateorganisation')));

?>
