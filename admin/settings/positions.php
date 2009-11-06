<?php // $Id$

// This file defines settingpages and externalpages under the "positions" category

    $ADMIN->add('positions', new admin_externalpage('positionframeworkmanage', get_string('positionframeworkmanage', 'position'), "$CFG->wwwroot/hierarchy/framework/index.php?type=position",
            array('moodle/local:viewposition')));

    $ADMIN->add('positions', new admin_externalpage('positionmanage', get_string('positionmanage', 'position'), $CFG->wwwroot . '/hierarchy/index.php?type=position',
            array('moodle/local:updateposition')));

    $ADMIN->add('positions', new admin_externalpage('positionupload', get_string('positionupload', 'position'), "$CFG->wwwroot/$CFG->admin/position/upload.php",
            array('moodle/local:updateposition')));

    $ADMIN->add('positions', new admin_externalpage('positiondepthcustomfields', get_string('positioncustomfields', 'position'), $CFG->wwwroot . '/position/depth/customfields/index.php',
            array('moodle/local:viewposition')));
?>
