<?php // $Id$

// This file defines settingpages and externalpages under the "reports" category

$ADMIN->add('reports', new admin_category('learningrecords', get_string('learningrecords','learningrecords')));

if ($hassiteconfig
    or has_capability('moodle/site:backup', $systemcontext)
    or has_capability('report/courseoverview:view', $systemcontext)
    or has_capability('coursereport/log:view', $systemcontext)
    or has_capability('coursereport/log:viewlive', $systemcontext)
    or has_capability('moodle/site:config', $systemcontext)
    or has_capability('report/security:view', $systemcontext)
    or has_capability('coursereport/stats:view', $systemcontext)
    or has_capability('report/unittest:view', $systemcontext)
    ) { // speedup for non-admins, add all caps used on this page

    // stuff under the "learning records" subcategory
    $ADMIN->add('learningrecords', new admin_externalpage('course_completion', get_string('coursecompletion','learningrecords'), "$CFG->wwwroot/$CFG->admin/learningrecords/course_report.php", 'moodle/site:viewreports') );

    $ADMIN->add('learningrecords', new admin_externalpage('competency_evidence', get_string('competencyevidence','learningrecords'), "$CFG->wwwroot/$CFG->admin/learningrecords/competency_report.php", 'moodle/site:viewreports'));


} // end of speedup

?>
