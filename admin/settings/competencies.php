<?php

// This file defines settingpages and externalpages under the "competencies" category

    $ADMIN->add('competencies', new admin_externalpage('competencyframeworkmanage', get_string('competencyframeworkmanage', 'admin'), "$CFG->wwwroot/competencies/frameworks/index.php",
            array('moodle/local:viewcompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencymanage', get_string('competencymanage', 'admin'), "$CFG->wwwroot/competencies/index.php",
            array('moodle/local:viewcompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencybulkaction', get_string('competencybulkaction', 'admin'), "$CFG->wwwroot/competencies/bulk.php",
            array('moodle/local:updatecompetencies', 'moodle/local:deletecompetenties')));

    $ADMIN->add('competencies', new admin_externalpage('competencyupload', get_string('competencyupload', 'admin'), "$CFG->wwwroot/competencies/upload.php",
            array('moodle/local:updatecompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencydepthcustomfields', get_string('competencycustomfields', 'admin'), "$CFG->wwwroot/competencies/depth/customfields/index.php",
            array('moodle/local:updatecompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencyscales', get_string('competencyscales', 'admin'), "$CFG->wwwroot/competencies/scale/index.php",
            array('moodle/local:viewcompetencies')));
