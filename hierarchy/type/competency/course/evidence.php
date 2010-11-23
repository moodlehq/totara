<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/completionlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/evidenceitem/lib.php');

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
$nojsparams = 'nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;

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

<p>Choose an evidence type</p>

<h3><?php echo $course->fullname ?></h3>

<?php

comp_evitem_print_course_evitems( $course, $competency_id, "{$CFG->wwwroot}/hierarchy/type/competency/course/save.php?competency={$competency_id}&course={$course->id}&{$nojsparams}" );

if($nojs) {
    // include footer for none JS version
    print_footer();
}
