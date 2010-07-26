<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/idp/lib.php');


///
/// Setup / loading data
///

// Plan id
$revisionid = required_param('id', PARAM_INT);

// Courses to add
$rowcount = required_param('rowcount', PARAM_SEQUENCE);

// Courses to add
$add = required_param('add', PARAM_SEQUENCE);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
$plan = get_plan_for_revision($revisionid);
if ( !$plan ){
    error('Plan ID is incorrect');
}

// Users can only edit their own IDP
require_capability('moodle/local:idpeditownplan', $sitecontext);
if ( $plan->userid != $USER->id ){
    error(get_string('error:revisionnotvisible', 'idp'));
}

$str_remove = get_string('remove');

///
/// Add competencies
///

// Parse input
$add = explode(',', $add);
$time = time();

foreach ($add as $addition) {
    // Check id
    if (!is_numeric($addition)) {
        error('Supplied bad data - non numeric id');
    }

    // If the course is already present in this plan, don't add it a second
    // time
    if ( count_records('idp_revision_course', 'revision', $revisionid, 'course', $addition) ){
        continue;
    }

    // Load course
    if (!$course = get_record('course', 'id', (int)$addition)) {
        error('Could not load course');
    }

    // Load category
    if (!$category = get_record('course_categories', 'id', $course->category)) {
        error('Could not load category');
    }

    // Add idp course
    $idpcourse = new Object();
    $idpcourse->revision = $revisionid;
    $idpcourse->course = $course->id;
    $idpcourse->ctime = time();

    // Insert the course and update the modification time for the parent revision
    begin_sql();
    $dbresult = insert_record('idp_revision_course', $idpcourse, false);
    $dbresult = $dbresult && update_modification_time($revisionid);
    if (!$dbresult ){
        rollback_sql();
    } else {
        commit_sql();

        if(!$nojs) {
            // Return html
            echo '<tr class=r'.$rowcount.'>';
            echo "<td><a href=\"{$CFG->wwwroot}/course/category.php?id={$course->category}\">".format_string($category->name)."</a></td>";
            echo "<td><a href=\"{$CFG->wwwroot}/course/view.php?id={$course->id}\">".format_string($course->fullname)."</a></td>";
            echo '<td></td>';
            echo '<td width="25%"><input size="10" maxlength="10" type="text" class="idpdate" name="courseduedate['.$course->id.']" id="courseduedate'.$course->id.'"/></td>';

            echo "<td class=\"options\">";

            echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/course/idp/remove.php?id={$course->id}&revision={$revisionid}\" title=\"$str_remove\">".
                 "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

            echo "</td>";

            echo '</tr>';
            echo '<script type="text/javascript"> $(function() { $(\'[id^=courseduedate]\').datepicker( ';
            echo '{ dateFormat: \'dd/mm/yy\', showOn: \'button\', buttonImage: \'../local/js/images/calendar.gif\',';
            echo 'buttonImageOnly: true } ); }); </script>'.PHP_EOL;
            $rowcount = ($rowcount + 1) % 2;
        }
    }
}
add_to_log(SITEID, 'idp', 'add IDP courses', "revision.php?id={$plan->id}", $plan->id);

if($nojs) {
    // redirect for none JS version
    if($s == sesskey()) {
        redirect($returnurl);
    } else {
        redirect($CFG->wwwroot);
    }
}
