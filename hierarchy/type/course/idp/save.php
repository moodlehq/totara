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
$add = required_param('add', PARAM_SEQUENCE);

// Indicates whether current related items, not in $add list, should be deleted
$deleteexisting = optional_param('deleteexisting', 0, PARAM_BOOL);

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

// Parse input
$add = $add ? explode(',', $add) : array();
$time = time();

$currentlyassigned = idp_get_user_courses($plan->userid, $revisionid);
if (!is_array($currentlyassigned)) {
    $currentlyassigned = array();
}

///
/// Delete removed assignments (if specified)
///

if ($deleteexisting) {
    $removeditems = array_diff(array_keys($currentlyassigned), $add);

    foreach ($removeditems as $rid) {
        delete_records('idp_revision_course', 'revision', $revisionid, 'course', $rid);
        add_to_log(SITEID, 'idpcourse', 'deleteassignment', "revision.php?id={$plan->id}", "IDP (ID {$plan->id})");

        echo " ~~~RELOAD PAGE~~~ ";  // Indicate (to js) that a page reload is required
    }
}

///
/// Add competencies
///

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

    $default_priority = idp_get_default_scale_value($plan->id);
    $default_priority = isset($default_priority->id) ? $default_priority->id : 0;
    $idpcourse->priority = $default_priority;

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
            echo '<tr>';
            echo "<td><a href=\"{$CFG->wwwroot}/course/view.php?id={$course->id}\">".format_string($course->fullname)."</a></td>";
            echo '<td></td>';

            if(get_config(NULL, 'idp_priorities')==2) {
                $priorities = idp_get_priority_scale_values_menu($plan->id);
                $prioritycell = '<select class="idppriority" name="comppriority['.$course->id.']" id="comppriority'.$course->id.'">';
                foreach($priorities as $priority){
                    $selected = $priority->id == $default_priority ? 'selected="selected"' : '';
                    $prioritycell .= '<option value="'.$priority->id.'" '.$selected.'>'.$priority->name.'</option>';
                }
                $prioritycell .= '</select>';
                echo "<td>{$prioritycell}</td>";
            }

            echo "<td class=\"options\">";

            echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/course/idp/remove.php?id={$course->id}&revision={$revisionid}\" title=\"$str_remove\">".
                 "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

            echo "</td>";

            echo '</tr>';
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
