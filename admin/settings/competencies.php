<?php

// This file defines settingpages and externalpages under the "competency" category

    $ADMIN->add('competencies', new admin_externalpage('competencyframeworkmanage', get_string('competencyframeworkmanage', 'competency'), "$CFG->wwwroot/hierarchy/framework/index.php?type=competency",
            array('moodle/local:viewcompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencymanage', get_string('competencymanage', 'competency'), "$CFG->wwwroot/hierarchy/index.php?type=competency",
            array('moodle/local:viewcompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencytemplatemanage', get_string('competencytemplatemanage', 'competency'), "$CFG->wwwroot/hierarchy/type/competency/template/index.php",
            array('moodle/local:viewcompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencydepthcustomfields', get_string('competencycustomfields', 'competency'), "$CFG->wwwroot/competency/depth/customfields/index.php",
            array('moodle/local:updatecompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencyscales', get_string('competencyscales', 'competency'), "$CFG->wwwroot/competency/scale/index.php",
            array('moodle/local:viewcompetency')));
