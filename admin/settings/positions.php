<?php // $Id$

// This file defines settingpages and externalpages under the "positions" category

    $ADMIN->add('positions', new admin_externalpage('positionframeworkmanage', get_string('positionframeworkmanage', 'position'), "$CFG->wwwroot/hierarchy/framework/index.php?type=position",
            array('moodle/local:updatepositionframeworks')));

    $ADMIN->add('positions', new admin_externalpage('positionmanage', get_string('positionmanage', 'position'), $CFG->wwwroot . '/hierarchy/index.php?type=position',
            array('moodle/local:updateposition')));

?>
