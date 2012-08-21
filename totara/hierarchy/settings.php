<?php // $Id$

// This file defines settingpages and externalpages under the "hierarchies" category


    // Positions
    $ADMIN->add('hierarchies', new admin_category('positions', get_string('positions', 'totara_hierarchy')));

    $ADMIN->add('positions', new admin_externalpage('positionmanage', get_string('positionmanage', 'totara_hierarchy'), "{$CFG->wwwroot}/totara/hierarchy/framework/index.php?prefix=position",
        array('totara/hierarchy:updatepositionframeworks')));

    $ADMIN->add('positions', new admin_externalpage('positiontypemanage', get_string('managepositiontypes', 'totara_hierarchy'), "{$CFG->wwwroot}/totara/hierarchy/type/index.php?prefix=position",
            array('totara/hierarchy:updatepositiontype')));

    $ADMIN->add('positions', new admin_externalpage('positionsettings', get_string('settings'), "{$CFG->wwwroot}/totara/hierarchy/prefix/position/settings.php",
        array('moodle/site:config')));


    // Organisations
    $ADMIN->add('hierarchies', new admin_category('organisations', get_string('organisations', 'totara_hierarchy')));

    $ADMIN->add('organisations', new admin_externalpage('organisationmanage', get_string('organisationmanage', 'totara_hierarchy'), "{$CFG->wwwroot}/totara/hierarchy/framework/index.php?prefix=organisation",
            array('totara/hierarchy:updateorganisationframeworks')));
    $ADMIN->add('organisations', new admin_externalpage('organisationtypemanage', get_string('manageorganisationtypes', 'totara_hierarchy'), "{$CFG->wwwroot}/totara/hierarchy/type/index.php?prefix=organisation",
            array('totara/hierarchy:updateorganisationtype')));


    // Competencies
    $ADMIN->add('hierarchies', new admin_category('competencies', get_string('competencies', 'totara_hierarchy')));

    $ADMIN->add('competencies', new admin_externalpage('competencymanage', get_string('competencymanage', 'totara_hierarchy'), "{$CFG->wwwroot}/totara/hierarchy/framework/index.php?prefix=competency",
            array('totara/hierarchy:updatecompetencyframeworks')));

    $ADMIN->add('competencies', new admin_externalpage('competencytypemanage', get_string('managecompetencytypes', 'totara_hierarchy'), "{$CFG->wwwroot}/totara/hierarchy/type/index.php?prefix=competency",
            array('totara/hierarchy:updatecompetencytype')));

//    $ADMIN->add('competencies', new admin_externalpage('competencyglobalsettings', get_string('globalsettings', 'competency'), "$CFG->wwwroot/hierarchy/prefix/competency/adminsettings.php",
//            array('totara/hierarchy:updatecompetency')));
?>
