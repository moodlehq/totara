<?php

// This file defines settingpages and externalpages under the "competencies" category

    $ADMIN->add('competencies', new admin_externalpage('competencyframeworkmanage', get_string('competencyframeworkmanage', 'competencies'), "$CFG->wwwroot/competencies/frameworks/index.php",
            array('moodle/local:viewcompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencymanage', get_string('competencymanage', 'competencies'), "$CFG->wwwroot/competencies/index.php",
            array('moodle/local:viewcompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencybulkaction', get_string('competencybulkaction', 'competencies'), "$CFG->wwwroot/competencies/bulk.php",
            array('moodle/local:updatecompetencies', 'moodle/local:deletecompetenties')));

    $ADMIN->add('competencies', new admin_externalpage('competencyupload', get_string('competencyupload', 'competencies'), "$CFG->wwwroot/competencies/upload.php",
            array('moodle/local:updatecompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencydepthcustomfields', get_string('competencycustomfields', 'competencies'), "$CFG->wwwroot/competencies/depth/customfields/index.php",
            array('moodle/local:updatecompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencyscales', get_string('competencyscales', 'competencies'), "$CFG->wwwroot/competencies/scale/index.php",
            array('moodle/local:viewcompetencies')));
