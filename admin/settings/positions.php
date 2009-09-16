<?php // $Id$

// This file defines settingpages and externalpages under the "positions" category

    $ADMIN->add('positions', new admin_externalpage('positionbrowselist', get_string('positionbrowselist', 'admin'), "$CFG->wwwroot/$CFG->admin/position.php",
            array('moodle/category:manage', 'moodle/course:create')));

    $ADMIN->add('positions', new admin_externalpage('positionbulkaction', get_string('positionbulkaction', 'admin'), $CFG->wwwroot . '/course/index.php?categoryedit=on',
            array('moodle/category:manage', 'moodle/course:create')));

    $ADMIN->add('positions', new admin_externalpage('positionaddnew', get_string('positionaddnew', 'admin'), $CFG->wwwroot . '/course/index.php?categoryedit=on',
            array('moodle/category:manage', 'moodle/course:create')));

    $ADMIN->add('positions', new admin_externalpage('positionupload', get_string('positionupload', 'admin'), "$CFG->wwwroot/$CFG->admin/uploadposition.php",
            array('moodle/category:manage', 'moodle/course:create')));

    $ADMIN->add('positions', new admin_externalpage('positioncustomfields', get_string('positioncustomfields', 'admin'), $CFG->wwwroot . '/course/index.php?categoryedit=on',
            array('moodle/category:manage', 'moodle/course:create')));
?>
