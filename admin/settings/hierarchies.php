<?php // $Id$

// This file defines settingpages and externalpages under the "hierarchies" category


    // Positions
    $ADMIN->add('hierarchies', new admin_category('positions', get_string('positions','position')));

    $ADMIN->add('positions', new admin_externalpage('positionmanage', get_string('positionmanage', 'position'), $CFG->wwwroot . '/hierarchy/framework/index.php?prefix=position',
            array('moodle/local:updatepositionframeworks')));

    // Organisations
    $ADMIN->add('hierarchies', new admin_category('organisations', get_string('organisations', 'organisation')));

    $ADMIN->add('organisations', new admin_externalpage('organisationmanage', get_string('organisationmanage', 'organisation'), $CFG->wwwroot . '/hierarchy/framework/index.php?prefix=organisation',
            array('moodle/local:updateorganisationframeworks')));

    // Competencies
    $ADMIN->add('hierarchies', new admin_category('competencies', get_string('competencies', 'competency')));

    $ADMIN->add('competencies', new admin_externalpage('competencymanage', get_string('competencymanage', 'competency'), "$CFG->wwwroot/hierarchy/framework/index.php?prefix=competency",
            array('moodle/local:updatecompetencyframeworks')));

    $ADMIN->add('organisations', new admin_externalpage('organisationtypemanage', get_string('manageorganisationtypes', 'organisation'), "$CFG->wwwroot/hierarchy/type/index.php?prefix=organisation",
            array('moodle/local:updateorganisationtype')));
    $ADMIN->add('positions', new admin_externalpage('positiontypemanage', get_string('managepositiontypes', 'position'), "$CFG->wwwroot/hierarchy/type/index.php?prefix=position",
            array('moodle/local:updatepositiontype')));
    $ADMIN->add('competencies', new admin_externalpage('competencytypemanage', get_string('managecompetencytypes', 'competency'), "$CFG->wwwroot/hierarchy/type/index.php?prefix=competency",
            array('moodle/local:updatecompetencytype')));

//    $ADMIN->add('competencies', new admin_externalpage('competencyglobalsettings', get_string('globalsettings', 'competency'), "$CFG->wwwroot/hierarchy/prefix/competency/adminsettings.php",
//            array('moodle/local:updatecompetency')));

    // Re-enable once backup/restore is fixed
    // Backup
    //$ADMIN->add('hierarchies', new admin_externalpage('hierarchybackup', get_string('backup'), $CFG->wwwroot . '/hierarchy/hierarchybackup.php'));

    // Restore
    //$ADMIN->add('hierarchies', new admin_externalpage('hierarchyrestore', get_string('restore'), $CFG->wwwroot . '/hierarchy/hierarchyrestore.php'));

?>
