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
$competency_id = required_param('add', PARAM_INT);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// string of params needed in non-js url strings
$urlparams = 'nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Load course
if (!$course = get_record('course', 'id', $id)) {
    error('Course ID was incorrect');
}

// Display page

if($nojs) {
    // include header/footer for none JS version
    admin_externalpage_print_header();
    echo '<p><a href="'.$returnurl.'">'.get_string('cancelwithoutassigning','hierarchy').'</a></p>';
}
?>

<div class="selectcompetencies">

<h2>Choose an evidence type</h2>

<h3><?php echo $course->fullname ?></h3>

<?php

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
            echo '<li><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/course/save.php?competency='.$competency_id.'&type=activitycompletion&instance='.$activity->id.'&amp;'.$urlparams.'">';
            echo 'Activity completion - '.$activity->name;
            echo '</a></li>';
        }
    }
}

// Course completion
if ($completion_info->is_enabled() &&
    $completion_info->has_criteria()) {

    $available = true;
    echo '<li><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/course/save.php?competency='.$competency_id.'&type=coursecompletion&instance='.$course->id.'&amp;'.$urlparams.'">Course completion</a></li>';
}

// Course grade
$course_grade = get_record_select('grade_items', 'itemtype = \'course\' AND courseid = '.$course->id);

if ($course_grade) {
    $available = true;
    echo '<li><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/course/save.php?competency='.$competency_id.'&type=coursegrade&instance='.$course->id.'&amp;'.$urlparams.'">Course grade</a></li>';
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

if($nojs) {
    // include footer for none JS version
    print_footer();
}
