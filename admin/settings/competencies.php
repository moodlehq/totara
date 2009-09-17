<?php

// This file defines settingpages and externalpages under the "competencies" category

    $ADMIN->add('competencies', new admin_externalpage('competencybrowselist', get_string('competencybrowselist', 'admin'), "$CFG->wwwroot/competencies/index.php",
            array('moodle/local:viewcompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencybulkaction', get_string('competencybulkaction', 'admin'), "$CFG->wwwroot/competencies/bulk.php",
            array('moodle/local:updatecompetencies', 'moodle/local:deletecompetenties')));

    $ADMIN->add('competencies', new admin_externalpage('competencyaddnew', get_string('competencyaddnew', 'admin'), "$CFG->wwwroot/competencies/edit.php?id=-1",
            array('moodle/local:updatecompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencyupload', get_string('competencyupload', 'admin'), "$CFG->wwwroot/competencies/upload.php",
            array('moodle/local:updatecompetencies')));

    $ADMIN->add('competencies', new admin_externalpage('competencycustomfields', get_string('competencycustomfields', 'admin'), "$CFG->wwwroot/competencies/fields/index.php",
            array('moodle/local:updatecompetencies')));
