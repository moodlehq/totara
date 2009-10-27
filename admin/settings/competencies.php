<?php

// This file defines settingpages and externalpages under the "competency" category

    $ADMIN->add('competencies', new admin_externalpage('competencyframeworkmanage', get_string('competencyframeworkmanage', 'competency'), "$CFG->wwwroot/competency/frameworks/index.php",
            array('moodle/local:viewcompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencymanage', get_string('competencymanage', 'competency'), "$CFG->wwwroot/competency/index.php",
            array('moodle/local:viewcompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencytemplatemanage', get_string('competencytemplatemanage', 'competency'), "$CFG->wwwroot/competency/template/index.php",
            array('moodle/local:viewcompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencybulkaction', get_string('competencybulkaction', 'competency'), "$CFG->wwwroot/competency/bulk.php",
            array('moodle/local:updatecompetency', 'moodle/local:deletecompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencyupload', get_string('competencyupload', 'competency'), "$CFG->wwwroot/competency/upload.php",
            array('moodle/local:updatecompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencydepthcustomfields', get_string('competencycustomfields', 'competency'), "$CFG->wwwroot/competency/depth/customfields/index.php",
            array('moodle/local:updatecompetency')));

    $ADMIN->add('competencies', new admin_externalpage('competencyscales', get_string('competencyscales', 'competency'), "$CFG->wwwroot/competency/scale/index.php",
            array('moodle/local:viewcompetency')));
