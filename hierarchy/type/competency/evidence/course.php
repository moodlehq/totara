<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/completionlib.php');


///
/// Setup / loading data
///

// course id
$id = required_param('id', PARAM_INT);
// competency id
$competency_id = required_param('competency', PARAM_INT);

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Load course
if (!$course = get_record('course', 'id', $id)) {
    error('Course ID was incorrect');
}

echo '<h3>'.$course->fullname.'</h3>';

// Evidence type available
$available = false;

echo '<ul>';

// Activity completion
$completion_info = new completion_info($course);
if ($completion_info->is_enabled()) {
    $evidence = $completion_info->get_activities();

    if ($evidence) {
        $available = true;
        foreach ($evidence as $activity) {
            echo '<li><a href="../type/competency/evidence/add.php?competency='.$competency_id.'&type=activitycompletion&instance='.$activity->id.'">';
            echo 'Activity completion - '.$activity->name;
            echo '</a></li>';
        }
    }
}

// Course completion
if ($completion_info->is_enabled() &&
    $completion_info->has_criteria()) {

    $available = true;
    echo '<li><a href="../type/competency/evidence/add.php?competency='.$competency_id.'&type=coursecompletion&instance='.$course->id.'">Course completion</a></li>';
}

// Course grade
$course_grade = get_record_select('grade_items', 'itemtype = \'course\' AND courseid = '.$course->id);

if ($course_grade) {
    $available = true;
    echo '<li><a href="../type/competency/evidence/add.php?competency='.$competency_id.'&type=coursegrade&instance='.$course->id.'">Course grade</a></li>';
}
/*
echo '<h3>Activity Grade</h3><p>Unavailable</p></h3>';
echo '<h3>Activity Outcome</h3><p>Unavailable</p></h3>';
echo '<h3>File</h3><p>Unavailable</p></h3>';
 */

if (!$available) {
    echo '<li><em>'.get_string('noevidencetypesavailable', 'competency').'</em></li>';
}

echo '</ul>';
