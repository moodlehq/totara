<?php

// This file defines settingpages and externalpages under the "competency" category

    $ADMIN->add('competencies', new admin_externalpage('competencyframeworkmanage', get_string('competencyframeworkmanage', 'competency'), "$CFG->wwwroot/hierarchy/framework/index.php?type=competency",
            array('moodle/local:viewcompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencymanage', get_string('competencymanage', 'competency'), "$CFG->wwwroot/hierarchy/index.php?type=competency",
            array('moodle/local:viewcompetency')));
